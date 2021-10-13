<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Ambassador;
use App\Contact;
use App\District;
use App\Http\Controllers\Controller;
use App\Mark;
use App\Rules\MatchOldPassword;
use App\Union;
use App\Upazila;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use function Matrix\trace;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'ambassadors' => Ambassador::count(),
            'users' => User::count(),
            'todayApp' => Ambassador::where('created_at', 'like', "%" . date('Y-m-d') . "%")->count(),
            'verified' => User::whereNotNull('email_verified_at')->count()
        ];
        $ambassadors = Ambassador::orderBy('id', 'desc')->limit(6)->get();
        return view('admin.index', compact('data','ambassadors'));
    }

      public function users(Request $request)
    {
        $user = new User();
        if ($request->filled('name')) {
            $user = $user->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $user = $user->where('email', $request->email);
        }
        if ($request->filled('ban')) {
            $user = $user->where('is_ban', $request->ban);
        }
        if ($request->filled('n_ord')) {
            $user = $user->orderBy('name',$request->n_ord);
        }
        if ($request->filled('e_ord')) {
            $user = $user->orderBy('email',$request->e_ord);
        }
        if ($request->filled('verify')) {
            if ($request->verify == "1") {
                $user = $user->whereNotNull('email_verified_at');
            } else {
                $user = $user->whereNull('email_verified_at');
            }
        }
        if (!$request->filled('e_ord') && !$request->filled('n_ord')
            && !$request->filled('name') && !$request->filled('ban') && !$request->filled('email')
            && !$request->filled('verify'))
            {
                $users = $user->orderBy('id', 'desc')->paginate(10);
            }
        else
            {
            $users = $user->paginate(10)->appends([
                'n_ord' => $request->n_ord,
                'e_ord' => $request->e_ord,
                'name' => $request->name,
                'ban' => $request->ban,
                'email' => $request->email,
                'verify' => $request->verify
            ]);
        }

        return view('admin.user.index', compact('users'));
    }
    
    
    public function userEdit(Request $request, $id)
    {
        $id = unlock($id);
        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => 'required|email|unique:users,email, ' . $id . ',id',
                /* 'password' => 'nullable| min:8',
                 'confirm_password' => ['same:password'],*/
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            /*if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }*/

            $user->save();
            return redirect()->back()->with('success', 'User info has been updated.');

        } else {
            $user = User::findOrFail($id);
            return view('admin.user.edit', compact('user'));
        }
    }

    public function userDelete($id)
    {
        $id = unlock($id);
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'User has been deleted.');
    }

    public function userStatus($id, $status)
    {
        $id = unlock($id);
        $status = unlock($status);

        if ($status == 0) {
            User::where('id',$id)->update(array('is_active' => $status,'is_ban' => 1));
            $message = 'User has been deactivated.';
        } else {
            User::where('id',$id)->update(array('is_active' => $status,'is_ban' => 0));
            $message = 'User has been activated.';
        }

        return redirect()->back()->with('success', $message);

    }

    public function userShow($id)
    {
        $id = unlock($id);
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    public function feedback()
    {
        $feedbacks = Contact::orderBy('id','desc')->paginate(10);
        return view('admin.pages.feedback',compact('feedbacks'));
    }

    public function showFeedback($id)
    {
        $feedback = Contact::findOrFail(unlock($id));
        return view('admin.pages.feedback-show',compact('feedback'));
    }

    public function replyFeedback(Request $request,$id)
    {
        if($request->isMethod('POST'))
        {
            return redirect()->back()->with('danger', 'Developer Still working on this method.');
        }else{
            $feedback = Contact::findOrFail(unlock($id));
            return view('admin.pages.reply-feedback',compact('feedback'));
        }
    }

    public function feedbackDestroy($id)
    {

        Contact::findOrFail(unlock($id))->delete();
        return redirect()->back()->with('success', 'Feedback has been deleted.');

    }


    public function profile(Request $request)
    {
        if ($request->isMethod('POST')) {
            $id = Auth('admin')->id();
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => 'required|email|unique:admins,email, ' . $id . ',id',
                /*'password' => 'nullable| min:8',
                'confirm_password' => ['same:password'],*/
                'photo' => 'nullable|mimes:png,jpg,jpeg|max:200'
            ]);

            $admin = Admin::findOrFail($id);
            $admin->name = $request->name;
            $admin->email = $request->email;
            if ($request->hasFile('photo')) {
                $extension = $request->photo->getClientOriginalExtension();
                $photo = 'pp_' . generateRandomString(22) . '.' . $extension;
                $request->photo->move(public_path("uploads/profile/"), $photo);
                $admin->photo = $photo;
            }
            /* if (!empty($request->password)) {
                 $admin->password = Hash::make($request->password);
             }*/

            $admin->save();

            return redirect()->back()->with([
                'success' => 'Profile has been updated.',
                'data' => 'profile'
            ]);


        } else {
            $profile = Admin::findOrFail(Auth('admin')->id());
            return view('admin.pages.profile', compact('profile'));
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'confirm_password' => ['same:password'],
        ]);
        Admin::find(auth('admin')->user()->id)->update(['password' => Hash::make($request->password)]);

        $data = [
            'data' => 'setting',
            'success' => 'Password has been changed successfully.'
        ];
        return redirect()->back()->with($data);
    }

    public function unionWard(Request $request)
    {
        $union = new Union();
        if ($request->filled('upazila')) {
            $union = $union->where('upazila_id', $request->upazila);
        }
        if (!$request->filled('district') && !$request->filled('upazila')) {
            $unions = $union->with('upazila')->orderBy('id', 'desc')->paginate(10);
        } else {
            $unions = $union->with('upazila')->orderBy('id', 'desc')->paginate(10)->appends([
                'district' => $request->district,
                'upazila' => $request->upazila
            ]);
        }
        $districts = District::orderBy('name', 'asc')->get();
        $upazilas = Upazila::where('district_id', $request->district)->get();
        return view('admin.union.index', compact('unions', 'districts', 'upazilas'));
    }

    public function createUnion(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'district' => 'required',
                'upazila' => 'required',
                'union' => 'required|max:255',
                'bn_union' => 'required|max:255'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'errors' => true,
                    'message' => $validator->errors()->toArray(),
                    'additional' => 'Happy Coding'
                ]);
            } else {
                $union = new Union();
                $union->upazila_id = $request->upazila;
                $union->name = $request->union;
                $union->bn_name = $request->bn_union;
                $union->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Success',
                    'additional' => 'Happy Coding'
                ]);
            }
        } else {
            $districts = District::orderBy('name', 'asc')->get();
            return view('admin.union.create', compact('districts'));
        }
    }

    public function deleteUnion($id)
    {
        $id = unlock($id);
        Union::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Union/Ward has been deleted');
    }


    public function banUser($id)
    {
        $id = unlock($id);
        User::where('id',$id)->update(['is_ban'=>1]);
        Mark::where('user_id',$id)->update(['is_ban'=>1]);
        $data = [
            'success' => 'Ban successfully.'
        ];
        return redirect()->back()->with($data);
    }

}
