<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Imports\QuestionImport;
use App\Option;
use App\Question;
use App\Quiz;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('id', 'desc')->paginate(50);
        return view('admin.question.index', compact('questions'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'question' => 'required|max:255',
                'option_one' => 'required|max:255',
                'option_two' => 'required|max:255',
                'option_three' => 'required|max:255',
                'option_four' => 'required|max:255',
                'quiz' => 'required',
                'answer' => 'required',
            ], [
                'option_one.required' => 'The option 1 field is required.',
                'option_two.required' => 'The option 2 field is required.',
                'option_three.required' => 'The option 3 field is required.',
                'option_four.required' => 'The option 4 field is required.',
            ]);

            $question = new Question();
            $question->quiz_id = $request->quiz;
            $question->question = $request->question;
            $question->option_one = $request->option_one;
            $question->option_two = $request->option_two;
            $question->option_three = $request->option_three;
            $question->option_four = $request->option_four;

            if($request->answer[4] == 1)
            {
                $question->answer = 1;
            }
            elseif ($request->answer[4] == 2){
                $question->answer = 2;
            }
            elseif ($request->answer[4] == 3){
                $question->answer = 3;
            }
            elseif ($request->answer[4] == 4){
                $question->answer = 4;
            }


            $question->save();

            return redirect()->back()->with('success', 'Question has been saved.');
        } else {
            $quizzes = Quiz::orderBy('id', 'desc')->where('status', 1)->get();
            return view('admin.question.create', compact('quizzes'));
        }
    }

    public function edit(Request $request, $id)
    {
        $id = unlock($id);
        if ($request->isMethod('POST')) {
            $request->validate([
                'question' => 'required|max:255',
                'option_one' => 'required|max:255',
                'option_two' => 'required|max:255',
                'option_three' => 'required|max:255',
                'option_four' => 'required|max:255',
                'quiz' => 'required',
                'answer' => 'required'
            ], [
                'option_one.required' => 'The option 1 field is required.',
                'option_two.required' => 'The option 2 field is required.',
                'option_three.required' => 'The option 3 field is required.',
                'option_four.required' => 'The option 4 field is required.',
            ]);

//            return $request->all();
            $question = Question::findOrFail($id);
            $question->quiz_id = $request->quiz;
            $question->question = $request->question;
            $question->option_one = $request->option_one;
            $question->option_two = $request->option_two;
            $question->option_three = $request->option_three;
            $question->option_four = $request->option_four;
            if($request->answer[4] == 1)
            {
                $question->answer = 1;
            }
            elseif ($request->answer[4] == 2){

                $question->answer = 2;
            }
            elseif ($request->answer[4] == 3){

                $question->answer = 3;
            }
            elseif ($request->answer[4] == 4){

                $question->answer = 4;
            }
//          $question->answer = $request->answer;
            $question->save();

            return redirect()->back()->with('success', 'Question has been updated.');
        }
        else
        {
            $quizzes = Quiz::orderBy('id', 'desc')->get();
            $question = Question::findOrFail($id);
            return view('admin.question.edit', compact('quizzes', 'question'));
        }
    }

    public function destroy($id)
    {
        $id = unlock($id);
        Question::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Question has been deleted.');
    }

    public function ImportCSV(Request $request)
    {

        if($request->isMethod('POST'))
        {
            $data=array();
            $quiz_id=$request->quiz_id;
            $rows = Excel::toArray(new QuestionImport(), $request->file('file'));
            foreach ($rows as $value)
            {
                foreach($value as $arr)
                {
                    $data['quiz_id']=$quiz_id;
                    //Value Receive from excel sheet
                    $data['question']=$arr['question'];
                    $data['option_one']=$arr['option_one'];
                    $data['option_two']=$arr['option_two'];
                    $data['option_three']=$arr['option_three'];
                    $data['option_four']=$arr['option_four'];
                    $data['answer']=$arr['answer'];
                    Question::create($data);
                }
            }
            return redirect()->back()->with('success', 'Question has been imported.');
        }
        else {
            $quizzes = Quiz::orderBy('id', 'desc')->where('status',1)->get();
            return view('admin.question.csv-import', compact('quizzes'));
        }
    }
}
