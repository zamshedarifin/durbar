<?php

namespace App\Http\Controllers\Admin;

use App\Ambassador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AmbassadorController extends Controller
{
    public function index(Request $request)
    {
        $ambassador = new Ambassador();
        $limit = 10;
        if ($request->filled('email')) {
            $ambassador = $ambassador->where('email', $request->email);
        }
        if ($request->filled('name')) {
            $ambassador = $ambassador->where('name','LIKE','%'.$request->name.'%');
        }
        if ($request->filled('mobile')) {
            $ambassador = $ambassador->where('cell_phone',(int) $request->mobile);
        }
        if ($request->filled('status')) {
            $ambassador = $ambassador->where('status', $request->status);
        }

        if (!$request->filled('name') && !$request->filled('email') && !$request->filled('mobile') && !$request->filled('status')) {
            $ambassadors = $ambassador->orderBy('id', 'desc')->paginate($limit);
        } else {
            $ambassadors = $ambassador->orderBy('id', 'desc')->paginate($limit)
                ->appends([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'status' => $request->status
                ]);
        }

//        $ambassadors = Ambassador::orderBy('id', 'desc')->paginate(10);
        return view('admin.ambassador.index', compact('ambassadors'));
    }

    public function show($id)
    {
        $id = unlock($id);
        $ambassador = Ambassador::findOrFail($id);
        return view('admin.ambassador.show', compact('ambassador'));
    }

    public function status($status, $id)
    {
        $id = unlock($id);
        $status = unlock($status);

        Ambassador::findOrFail($id)->update([
            'status' => $status
        ]);

        if ($status == 2) {
            $data = [
                'error' => 'Application has been rejected.'
            ];
        } else {
            $data = [
                'success' => 'Application has been Approved.'
            ];
        }
        return redirect()->back()->with($data);
    }
}
