<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Answer;
use App\CampaignEnroll;
use App\Mark;
use App\Question;
use App\Quiz;
use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function quiz()
    {
        if(Auth::user()->father_name != null || Auth::user()->mother_name != null || Auth::user()->mobile != null || Auth::user()->avatar != null || Auth::user()->facebook != null || Auth::user()->address != null)
        {
            $data = [
                'activeQuiz' => Quiz::orderBy('id', 'desc')->where('status', '1')->first(),
                'quizzes' => Quiz::orderBy('id', 'desc')->where('status', '0')->limit(3)->get()
            ];
            if($data['activeQuiz'] != null)
            {
                $mark = Mark::where(['user_id' => Auth::id(), 'quiz_id' => $data['activeQuiz']->id])->first();
                return view('user-panel.quiz.quiz-list', compact('data', 'mark'));
            }
            else
            {
                $data = [
                    'end_Quiz' => Quiz::orderBy('id', 'desc')->first(),
                    'quizzes' => Quiz::orderBy('id', 'desc')->where('status', '0')->limit(3)->get()
                ];
                return view('user-panel.quiz.quiz-list', compact('data'));
            }
        }
        else
        {
            return redirect()->route('user.profile');
        }
    }
    public function index()
    {
        if(Auth::user()->father_name == null || Auth::user()->mother_name == null || Auth::user()->mobile == null || Auth::user()->avatar == null || Auth::user()->facebook == null || Auth::user()->address == null)
        {
            $data = [
                'error' => 'বর্তমানে আপনার প্রোফাইলটি  অসম্পূর্ণ আছে,ক্যাম্পেইনে অংশগ্রহণ করতে হলে আপনার এই তথ্যগুলো দিয়ে সহায়তা করতে হবে। ধন্যবাদ।'
            ];
            return redirect()->route('user.profile')->with($data);
        }
        else
        {
            $quiz=Quiz::latest()->first();
            return view('user-panel.home',compact('quiz'));
        }

    }

    public function participate(Request $request, $id)
    {
        $quizId = unlock($id);
        $quiz = Quiz::with('questions')->findOrFail($quizId);

        $isParticipate = Mark::where([
            'user_id' => Auth::id(),
            'quiz_id' => $quizId
        ])->first();

        if ($request->isMethod('POST')) {
            if($isParticipate['mark'] == 0 && $isParticipate['end_time'] == null)
            {
                    $name = 0;
                    $correct_answer = 0;
                    $wr_answer = 0;
                    foreach ($quiz['questions'] as $question) {
                        $name++;
                        $post_arr = $_POST;
                        unset($post_arr['_token']);
                        if(!empty($post_arr["radio_" . $name])) {
                            if (($post_arr["radio_" . $name]) == $question->answer) {
                                $correct_answer++;
                            } else {
                                $wr_answer++;
                            }
                        }
                        Answer::create([
                            'question_id'=>$question->id,
                            'user_id'=>Auth::id(),
                            'option'=>$post_arr["radio_" . $name],
                        ]);
                    }
                    $currentDateTime = date('Y-m-d H:i:s');
                    Mark::updateOrCreate([
                        'user_id' => Auth::id(),
                        'quiz_id' => $quizId
                    ], [
                        'mark' => $correct_answer,
                        'is_submit' => 1,
                        'end_time' => $currentDateTime,
                        'seconds' => strtotime($currentDateTime) - strtotime($isParticipate->start_time)
                    ]);
                    return redirect(route('user.quiz'))->with('success', 'আপনার পরীক্ষা সফলভাবে সম্পন্ন হয়েছে।');
            }
            else
            {
                return redirect(route('user.quiz'))->with('error', 'আপনি ইতিমধ্যে পরীক্ষা সম্পন্ন করেছেন।');
            }
        }

        else {
            if (@count($isParticipate) > 0)
                {
                    $endTime = date("Y-m-d H:i:s", strtotime($isParticipate->start_time) + (60 * $quiz->qz_time));
                    if ($isParticipate->is_submit == 1)
                        {
                            return redirect(route('user.quiz'))->with('error', 'আপনি ইতিমধ্যে পরীক্ষা সম্পন্ন করেছেন।');
                        }
                    else
                        {
                            if ($endTime <= date("Y-m-d H:i:s"))
                                {
                                    Mark::updateOrCreate([
                                        'user_id' => Auth::id(),
                                        'quiz_id' => $quizId
                                    ], [
                                        'is_submit' => 1,
                                    ]);
                                    return redirect(route('user.quiz'))->with('error', 'আপনি ইতিমধ্যে পরীক্ষা সম্পন্ন করেছেন।');
                                }
                            else
                                {
                                    return view('user-panel.quiz.quiz', compact('quiz'));
                                }
                        }
                }
            else
                {
                    Mark::updateOrCreate([
                        'user_id' => Auth::id(),
                        'quiz_id' => $quizId
                    ], [
                        'start_time' => date('Y-m-d H:i:s'),
                    ]);
                    return view('user-panel.quiz.quiz', compact('quiz'));
                }
        }
    }

    public function campaignEnroll($id)
    {
        $campaignId = unlock($id);
        $isExist = CampaignEnroll::where([
            'user_id' => Auth::id(),
            'campaign_id' => $campaignId
        ])->count();

        if ($isExist > 0) {
            $type = 'error';
            $message = "আপনি ইতিমধ্যে ক্যাম্পেইনে অংশগ্রণ করেছেন।";
        } else {
            $enroll = new CampaignEnroll();
            $enroll->campaign_id = $campaignId;
            $enroll->user_id = Auth::id();
            $enroll->save();
            $type = 'success';
            $message = "আপনি সফলভাবে ক্যাম্পেইনে অংশগ্রহন করেছেন ।";
        }
        return redirect()->back()->with($type, $message);
    }

    public function previousQuiz($id)
    {
        $data = [
            'activeQuiz' => Quiz::where('id',unlock($id))->orderBy('id', 'desc')->where('status', '0')->first(),
            'quizzes' => Quiz::orderBy('id', 'desc')->where('status', '0')->limit(3)->get()
        ];
        $quiz = Quiz::with('questions')->findOrFail(unlock($id));
        return view('user-panel.quiz.old-quiz', compact('quiz','data'));
    }

    public function profile(Request $request)
    {
        $user = Auth::id();
        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required|max:200',
                'facebook' => 'required|max:255',
                'mobile' => 'required|min:11|max:11',
                'avatar' => 'mimes:png,jpg,jpeg|max:1024',
            ]);
            $album = User::findOrFail($user);
            $album->name = $request->name;
            $album->mobile = $request->mobile;
            $album->father_name = $request->father_name;
            $album->mother_name = $request->mother_name;
            $album->facebook = $request->facebook;
            $album->address = $request->address;

            $image = $request->file('avatar');
            if ($image) {
                $image_name = time().'_'.$request->name;
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $upload_path = 'public/uploads/profile/';
                $image_url = $upload_path . $image_full_name;
                $success = $image->move($upload_path, $image_full_name);
                if ($success) {
                    $album->avatar = $image_url;
                }
            }
            $album->save();
            return redirect()->back()->with('success', 'Profile has been updated.');
        } else {
            return view('user-panel.profile');
        }
    }

    public function changePassword(Request $request)
    {

        $request->validate([
            'current_password' => ['required', Hash::check($request->password,Auth::user()->password)],
            'password' => ['required'],
            'confirm_password' => ['same:password'],
        ]);
        User::find(Auth::user()->id)->update(['password' => Hash::make($request->password)]);
        $data = [
            'data' => 'setting',
            'success' => 'Password has been changed successfully.'
        ];
        return redirect()->back()->with($data);
    }
}
