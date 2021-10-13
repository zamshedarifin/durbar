<?php

namespace App\Http\Controllers\Admin;

use Excle;
use App\CareerCamp;
use App\Exports\CareerCampExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Sesssion;
session_start();

class CareercampController extends Controller
{
    public function index(Request $request)
    {
        $count=CareerCamp::whereNotNull('name')->count();
        $careerCamps = CareerCamp::orderBy('mark','desc')->orderBy('seconds','asc')->whereNotNull('name')->get();

        return view('admin.careerCamp.index', compact('careerCamps','count'));
    }

    public function show($id)
    {
        $id = unlock($id);
        $careerCamp = CareerCamp::findOrFail($id);
        return view('admin.careerCamp.show', compact('careerCamp'));
    }

    public function careercampDestroy($id)
    {
        $id = unlock($id);
        $careerCamp = CareerCamp::destroy($id);
        $data = [
            'success' => 'Data has been Deleted.'
        ];
        return redirect()->back()->with($data);
    }




    public function SendMail($id)
    {
        $id = unlock($id);
        $careerCamp = CareerCamp::findOrFail($id);


            $subject = 'আইসিটি ক্যারিয়ার ক্যাম্প';
                $data = array('email' => $careerCamp->email, 'subject' => $subject, 'name' => $careerCamp->name);
                Mail::send('camp_email', ['data' => $data], function ($message) use ($data) {
                    $message->from('no-reply@durbar21.org', 'দুর্বার');
                    $message->to($data['email']);
                    $message->subject($data['subject']);
                });

        $data = [
            'success' => 'Mail has been Send.'
        ];
        return redirect()->back()->with($data);
    }

//    public function export_old(Request $request)
//    {
//        $student=$request->studentId;
//        return Excel::download(new CareerCampExport($student),'custom_report.xlsx');
//    }


    public function export(Request $request)
    {
        $student=$request->studentId;
        $data=array();
        switch ($request->input('action')) {
            case 'save':
                if($student == null)
                {
                    $data = [
                        'error' => 'Please Select member'
                    ];
                    return redirect()->back()->with($data);
                }
                else{
                    return Excel::download(new CareerCampExport($student),'custom_report.xlsx');
                }
            break;

            case 'mail':
                
                //   $data = [
                //             'error' => 'this action currently not available.please Contact with Zamshed.'
                //         ];
                //         return redirect()->back()->with($data);
                        
                        
                if($student == null)
                {
                    $data = [
                        'error' => 'Please Select a member'
                    ];
                    return redirect()->back()->with($data);
                }
                else
                    {
                        foreach ($student as $std_id)
                        {
                            $careerCamp = CareerCamp::find($std_id);
                            $subject = 'আইসিটি ক্যারিয়ার ক্যাম্প';
                            $data = array('email' => $careerCamp->email, 'subject' => $subject, 'name' => $careerCamp->name);
                            Mail::send('winner_email', ['data' => $data], function ($message) use ($data) {
                                $message->from('no-reply@durbar21.org', 'দুর্বার');
                                $message->to($data['email']);
                                $message->subject($data['subject']);
                            });
                        }
                        $data = [
                            'success' => 'Mail has been Send.'
                        ];
                        return redirect()->back()->with($data);
                    }
                
                
                break;

        }
    }

}
