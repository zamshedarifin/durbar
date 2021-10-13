<?php

namespace App\Http\Controllers\Admin;

use App\Campaign;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\Mark;
use App\User;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::orderBy('id', 'desc')->paginate(10);
        return view('admin.quiz.index', compact('quizzes'));
    }

    public function create(Request $request)
    {
        $date = explode('-',$request->date);

        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required|max:255|unique:quizzes',
                'rules' => 'nullable',
                'time' => 'required|numeric',
                'status' => 'required'
            ]);

            $quiz = new Quiz();
            $quiz->title = $request->title;
            $quiz->campaign_id = $request->campaign;
            $quiz->title_bn = $request->title_bn;
            $quiz->rules = $request->quiz_rules;
            $quiz->rules_bn = $request->quiz_rules_bn;
            $quiz->start_date = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$date[0])));
            $quiz->end_date = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$date[1])));
            $quiz->qz_time = $request->time;
            $quiz->status = $request->status;
            $quiz->save();
            return redirect()->back()->with('success', 'Quiz has been added');
        } else {

            $campaigns=Campaign::orderBy('id','desc')->get();
            return view('admin.quiz.create',compact('campaigns'));
        }
    }

    public function edit(Request $request, $id)
    {
        $id = unlock($id);
        $date = explode('-',$request->date);
        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required|max:255|unique:quizzes,title,' . $id,
                'rules' => 'nullable',
                'time' => 'required|numeric',
                'status' => 'required'
            ]);

            $quiz = Quiz::findOrFail($id);
            $quiz->title = $request->title;
            $quiz->campaign_id = $request->campaign;
            $quiz->title_bn = $request->title_bn;
            $quiz->rules = $request->quiz_rules;
            $quiz->rules_bn = $request->quiz_rules_bn;
            $quiz->start_date = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$date[0])));
            $quiz->end_date = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$date[1])));
            $quiz->qz_time = $request->time;
            $quiz->status = $request->status;
            $quiz->save();
            return redirect()->back()->with('success', 'Quiz has been Updated');
        } else {
            $quiz = Quiz::findOrFail($id);
            $campaigns=Campaign::orderBy('id','desc')->get();
            return view('admin.quiz.edit',compact('quiz','campaigns'));
        }
    }

    public function Mark(Request $request,$id)
    {
        $id=unlock($id);
        $data['quiz']=Quiz::findOrFail($id);
        $data['count']=Mark::where('quiz_id',$id)->whereNotNull('end_time')->count();
        $data['marks']=Mark::where('quiz_id',$id)->orderBy('mark','desc')->orderBy('seconds','asc')->whereNotNull('end_time')->get();;
        return view('admin.quiz.mark',compact('data'));
    }




//    public function Mark_2ndway(Request $request,$id)
//    {
//        $id=unlock($id);
//        $data['quiz']=Quiz::findOrFail($id);
//        $marksheet= new Mark();
//        $limit=100;
//
//        if ($request->filled('email')) {
//            $marksheet = $marksheet->where('email', $request->email);
//        }
//        if ($request->filled('name')) {
//            $marksheet = $marksheet->where('name','LIKE','%'.$request->name.'%');
//        }
//        if ($request->filled('mobile')) {
//            $marksheet = $marksheet->where('mobile',(int) $request->mobile);
//        }
//
//        if (!$request->filled('name') && !$request->filled('email') && !$request->filled('mobile') ) {
//            $data['marks'] = $marksheet->orderBy('mark','desc')->orderBy('seconds','asc')->whereNotNull('end_time')->paginate($limit);
//        } else {
//            $data['marks'] = $marksheet->orderBy('mark','desc')->orderBy('seconds','asc')->whereNotNull('end_time')->paginate($limit)
//                ->appends([
//                    'name' => $request->name,
//                    'email' => $request->email,
//                    'mobile' => $request->mobile,
//                ]);
//        }
//        return view('admin.quiz.mark',compact('data'));
//
//    }


    public function marksheetDelete($id)
    {
        Mark::destroy(unlock($id));
        return redirect()->back()->with('success', 'user has been deleted');
    }

}
