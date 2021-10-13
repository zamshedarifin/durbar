<?php

namespace App\Http\Controllers;

use App\Mark;
use App\Answer;
use App\Question;
use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Pusher\Pusher;
session_start();

class QuizController extends Controller
{
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

    public function Question(Request $request, $id)
    {
        $quizId = unlock($id);
        $quiz = Quiz::with('questions')->findOrFail($quizId);

        $isParticipate=Mark::where('user_id',Auth::id())->where('quiz_id',$quizId)->first();
            if($isParticipate)
            {
                if($isParticipate['is_submit'] == 0) {
                    if ($request->session()->exists('question_id')) {
                        $question = Question::where('quiz_id', $quizId)->inRandomOrder()->whereNotIn('id', session('question_id'))->first();
                    } else {
                        $question = Question::where('quiz_id', $quizId)->inRandomOrder()->limit(1)->first();
                    }
                    return view('user-panel.quiz.quiz', compact('question', 'quiz'));
                }
                else
                {
                    return redirect(route('user.quiz'))->with('error', 'আপনি ইতিমধ্যে পরীক্ষা সম্পন্ন করেছেন।');
                }
            }
            else
            {
                Mark::updateOrCreate([
                    'user_id' => Auth::id(),
                    'quiz_id' => $quizId,
                ],[
                    'start_time' => date('Y-m-d H:i:s'),
                ]);
                $question = Question::where('quiz_id', $quizId)->inRandomOrder()->limit(1)->first();
                return view('user-panel.quiz.quiz', compact( 'question','quiz'));

            }

    }

    public function participate(Request $request)
    {
            $isParticipate = Mark::where([
                'user_id' => Auth::id(),
                'quiz_id' => $request->quiz
            ])->first();

        $quiz = Quiz::with('questions')->findOrFail($request->quiz);

            if($isParticipate['is_submit'] == 0)
            {
                $questionId = array();
                array_push($questionId, $request->question_id);
                Session::push('question_id', $questionId);
                $ans = Question::find($request->question_id);

                if ($request->answer == $ans->answer)
                {
                    if ($request->session()->exists('score')) {
                        $value = Session('score');
                        $value++;
                        Session(['score' => $value]);
                    } else {
                        Session(['score' => 1]);
                    }
                    Answer::create([
                        'question_id'=>$request->question_id,
                        'user_id'=>Auth::id(),
                        'option'=>$request->answer,
                    ]);
                }

                if(@count(Session('question_id')) == 20)
                {
                    $currentDateTime = date('Y-m-d H:i:s');
                    Mark::where('user_id',Auth::id())->where('quiz_id',$request->quiz)->update([
                        'mark' => $request->session()->get('score'),
                        'is_submit' => 1,
                        'start_time' => $isParticipate->start_time,
                        'end_time' => $currentDateTime,
                        'seconds' => strtotime($currentDateTime) - strtotime($isParticipate->start_time)
                    ]);
                    $request->session()->forget(['score','question_id']);
                    return redirect(route('user.quiz'))->with('success', 'আপনার পরীক্ষা সফলভাবে সম্পন্ন হয়েছে।');
                }
                else
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
                            $currentDateTime = date('Y-m-d H:i:s');
                            Mark::where('user_id',Auth::id())->where('quiz_id',$request->quiz)->update([
                                'mark' => $request->session()->get('score'),
                                'is_submit' => 1,
                                'start_time' => $isParticipate->start_time,
                                'end_time' => $currentDateTime,
                                'seconds' => strtotime($currentDateTime) - strtotime($isParticipate->start_time)
                            ]);
                            $request->session()->forget(['score','question_id']);
                            return redirect(route('user.quiz'))->with('success', 'নির্ধারিত সময় শেষ হয়ে যাওয়ার ফলে আপনার পরিক্ষা সফলভাবে সম্পন্ন হয়েছে।');
                        }
                        else
                        {
                            return back()->with([
                                Quiz::with('questions')->findOrFail($request->quiz),
                            ]);
                        }
                    }
//                    return back()->with([
//                        Quiz::with('questions')->findOrFail($request->quiz),
//                    ]);
                }
            }
            else
            {
                return redirect(route('user.quiz'))->with('error', 'আপনি ইতিমধ্যে পরীক্ষা সম্পন্ন করেছেন।');
            }
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



    public function result()
    {
       $results=Mark::where('user_id',Auth::user()->id)->get();
       return view('user-panel.quiz.result',compact('results'));
    }

    public function resultView($id)
    {
        $explode = explode('-',unlock($id));
        $data['result']=Mark::where('quiz_id',$explode[0])->where('user_id',$explode[1])->first();
        $data['activeQuiz'] = Quiz::where('id',$data['result']->quiz_id)->first();
        return view('user-panel.quiz.show-result',compact('data'));
    }

}
