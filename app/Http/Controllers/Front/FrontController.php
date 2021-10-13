<?php

namespace App\Http\Controllers\Front;

use App\Album;
use App\Ambassador;
use App\Answer;
use App\Campaign;
use App\CampaignEnroll;
use App\CampaignStory;
use App\CampQuiz;
use App\CareerCamp;
use App\Competition;
use App\Contact;
use App\Event;
use App\Http\Controllers\Controller;
use App\Mark;
use App\Photos;
use App\Question;
use App\Quiz;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Session;
session_start();
use Validator;
use DateTime;

class FrontController extends Controller
{
    public function index()
    {
        $campaignId = Campaign::orderBy('cam_date', 'asc')
            ->where('status', '1')->limit(3)->get('id');
        $data = [
            'campaigns' => Campaign::orderBy('cam_date', 'asc')
                ->where('status', '1')->limit(3)->get(),

            'previous_campaigns' => Campaign::orderBy('cam_date', 'asc')
                ->where('status','4')->limit(3)->get(),

            'upcomingCampaign'=>Campaign::orderBy('cam_date','asc')->where('status',3)->first(),
            'event' => Event::orderBy('event_date', 'asc')
                ->where('event_date', '>=', date('Y-m-d'))->first(),
            'photos' => Photos::inRandomOrder()->limit(5)->get(),
            'gallery' => Album::orderBy('id','desc')->where('status',1)->first(),

            'competitions'=>Competition::orderBy('id', 'desc')
                ->where('status', 1)
                ->whereIn('campaign_id',$campaignId)
                ->get()
        ];
        return view('frontEnd.index', compact('data'));
    }

    public function campaign()
    {
        $campaigns = Campaign::orderBy('id','desc')->whereNotIn('status', [2])->paginate(10);
        return view('frontEnd.pages.campaign', compact('campaigns'));
    }


    public function campaignDetails($slug)
    {
        $campaign = Campaign::with(['stories' => function ($query) {
            $query->orderBy('id', 'desc');
            $query->where('status', 1);
        }],['competitions' => function ($cquery) {
            $cquery->groupBy('start_date');
            $cquery->orderBy('id', 'asc');
            $cquery->where('status', 1);
        }])->where('slug', $slug)->firstOrFail();

        $competitionDate=Competition::groupBy('start_date')
                        ->where('campaign_id',$campaign['id'])
                        ->where('status',1)->get();

        $quiz = Quiz::where('campaign_id',$campaign['id'])->where('status',1)->get();

        return view('frontEnd.pages.story', compact('campaign','competitionDate','quiz'));
    }



    public function ambassador(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:150',
                'gender' => 'required|max:20',
                'age' => 'required|max:100',
                'address' => 'nullable|max:255',
                'email' => 'required|email|unique:ambassadors,email',
                'cell_phone' => 'required|numeric|unique:ambassadors,cell_phone|digits:11',
//                'fb_profile_link' => 'required|max:150|regex:/(https?:\/\/)?([\w\.]*)facebook\.com\/([a-zA-Z0-9_]*)$/',
                'fb_profile_link' => 'required|max:150',
                'profession' => 'required|max:150',
                'is_work' => 'required|numeric',
                'send_mail' => 'required|numeric',
                'district' => 'required|numeric',
                'upazila' => 'required|numeric',
                'question_1' => 'required',
                'question_2' => 'required',
                'question_3' => 'required',
//                'question_4' => 'required',
//                'question_5' => 'required',
                'question_6' => 'required',
                'question_7' => 'required',
                'question_8' => 'required',
                'question_10' => 'required',
                'question_11' => 'required',
                'question_12' => 'required',
                'question_13' => 'required',
                'question_14' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => true,
                    'message' => $validator->errors()->toArray(),
                    'additional' => 'Happy Coding'
                ]);
            } else {

                $ambassador = new Ambassador();
                $ambassador->name = $request->name;
                $ambassador->gender = $request->gender;
                $ambassador->age = $request->age;
                $ambassador->address = $request->address;
                $ambassador->email = $request->email;
                $ambassador->fb_profile_link = $request->fb_profile_link;
                $ambassador->cell_phone = $request->cell_phone;
                $ambassador->profession = $request->profession;
                $ambassador->is_work = $request->is_work;
                $ambassador->district_id = $request->district;
                $ambassador->upazila_id = $request->upazila;
                $ambassador->union_id = $request->union;

                $ambassador->send_mail = $request->send_mail;
                $ambassador->question_1 = $request->question_1;
                $ambassador->question_2 = $request->question_2;
                $ambassador->question_3 = $request->question_3;
                $ambassador->question_4 = $request->question_4;
                $ambassador->question_5 = $request->question_5;
                $ambassador->question_6 = $request->question_6;
                $ambassador->question_7 = $request->question_7;
                $ambassador->question_8 = $request->question_8;
                $ambassador->question_9 = $request->question_9;
                $ambassador->question_10 = $request->question_10;
                $ambassador->question_11 = $request->question_11;
                $ambassador->question_12 = $request->question_12;
                $ambassador->question_13 = $request->question_13;
                $ambassador->question_14 = $request->question_14;
                $ambassador->save();


                $subject = 'আপনি দুর্বার প্লাটফর্মের অ্যাম্বাসেডর হিসাবে প্রাথমিকভাবে নির্বাচিত হয়েছেন';
                $data = array('email' => $request->email, 'subject' => $subject, 'name' => $request->name);
                Mail::send('email', ['data' => $data], function ($message) use ($data) {
                    $message->from('no-reply@durbar21.org', 'দুর্বার');
                    $message->to($data['email']);
//                    $message->bcc('16173203069@cse.bubt.edu.bd');
                    $message->subject($data['subject']);
                });

                Ambassador::where('email',$request->email)->update([
                    'is_sent'=>1
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Success',
                    'additional' => 'Happy Coding'
                ]);
            }
        } else {
            $districts = DB::table('districts')->orderBy('bn_name', 'asc')->get();
//            return view('frontEnd.pages.ambassador', compact('districts'));
            return view('frontEnd.pages.registration_stop', compact('districts'));
        }
    }



    public function careerCamp(Request $request)
    {
        $data['quiz']=CampQuiz::get();
        $currentDateTime = date('Y-m-d H:i:s');
        $isParticipate = CareerCamp::where([
            'id' => session('id'),
        ])->first();

            if ($request->isMethod('POST')) {
                $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'age' => 'required|max:100',
                'gender' => 'required|max:20',
                'divison' => 'nullable|max:255',
                'email' => 'required|email|unique:careercampes,email',
                'cell_phone' => 'required|numeric|unique:careercampes,cell_phone|digits:11',
    //                'fb_profile_link' => 'required|max:150|regex:/(https?:\/\/)?([\w\.]*)facebook\.com\/([a-zA-Z0-9_]*)$/',
                'address' => 'required|max:150',
                'fb_profile_link' => 'required|max:150',
                'profession' => 'required',
                'question_1' => 'required',
                'question_2' => 'required',
                'question_3' => 'required',
                'question_4' => 'required',
                'question_5' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => true,
                    'message' => $validator->errors()->toArray(),
                    'additional' => 'Happy Coding'
                ]);
            } else {
                $name = 0;
                $correct_answer = 0;
                $wr_answer = 0;
                foreach ($data['quiz'] as $question) {
                    $name++;
                    $post_arr = $_POST;
                    unset($post_arr['_token']);
                    if(!empty($post_arr["question_" . $name])) {
                        if (($post_arr["question_" . $name]) == $question->answer) {
                            $correct_answer++;
                        } else {
                            $wr_answer++;
                        }
                    }
                }
                CareerCamp::updateorcreate([
                    'id'=>session('id'),
                ],[
                    'name'=>$request->name,
                    'age'=>$request->age,
                    'gender'=> $request->gender,
                    'divison'=>$request->divison,
                    'email'=>$request->email,
                    'cell_phone'=>$request->cell_phone,
                    'mark' => $correct_answer,
                    'end_time' => $currentDateTime,
                    'seconds' => strtotime($currentDateTime) - strtotime($isParticipate->start_time),
                    'address'=>$request->address,
                    'fb_profile_link'=>$request->fb_profile_link,
                    'profession'=>$request->profession,
                    'join_with'=>$request->join_with,
                ]);

                $subject = 'আইসিটি ক্যারিয়ার ক্যাম্প';
                $data = array('email' => $request->email, 'subject' => $subject, 'name' => $request->name);
                Mail::send('camp_email', ['data' => $data], function ($message) use ($data) {
                    $message->from('no-reply@durbar21.org', 'দুর্বার');
                    $message->to($data['email']);
                    $message->subject($data['subject']);
                });


                return response()->json([
                    'success' => true,
                    'message' => 'Success',
                    'additional' => 'Happy Coding'
                ]);
            }
        }
            else
            {
                // if(!session('id')){
                //     $create=CareerCamp::create([
                //         'start_time' => date('Y-m-d H:i:s'),
                //     ]);
                //     $session=session::put('id',$create->id);
                // }
                // $data['quiz']=CampQuiz::get();
                // return view('frontEnd.pages.events_registration',compact('data'));
                return view('frontEnd.pages.camp_reg_off');
            }
    }


    public function training()
    {
        return view('frontEnd.pages.training');
    }

    public function photoGallery()
    {
        $albums = Album::orderBy('id','desc')->where('status',1)->paginate(12);
        return view('frontEnd.pages.album',compact('albums'));
    }

    public function albumDetails($slug){
        $album = Album::where('slug',$slug)->firstOrFail();
        return view('frontEnd.pages.album-details',compact('album'));
    }

    public function loginRegistration()
    {
        return view('frontEnd.pages.login-registration');
    }

    public function testing(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            if ($input['field'] != null) {
                foreach ($input['field'] as $key => $value) {
                    $data[] = [
                        $key => $value
                    ];
                }
            }

            $campaign = new CampaignEnroll();
            $campaign->campaign_id = 1;
            $campaign->form_data = \GuzzleHttp\json_encode($data);
            $campaign->save();
            return 'success';
//           return json_encode($data);
        } else {
            $enrolls = CampaignEnroll::all();
            foreach ($enrolls as $en) {
                foreach (\GuzzleHttp\json_decode($en->form_data) as $key => $value) {
                    foreach ($value as $v => $val) {
                        echo $v . '=>' . $val . '<br>';
                    }
                }
            }
//            return view('welcome');
        }
    }


    public function story($slug)
    {
        $story = CampaignStory::where('slug', $slug)->firstOrFail();
        return view('frontEnd.pages.story-details', compact('story'));
    }

   public function competition($slug)
    {
        $competition = Competition::where('slug', $slug)->firstOrFail();
        return view('frontEnd.pages.competition-details', compact('competition'));
    }

    public function event()
    {
        $events = Event::orderBy('event_date', 'asc')->where('status', 1)->paginate(10);
        return view('frontEnd.pages.event', compact('events'));
    }

    public function eventDetails($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('frontEnd.pages.event-details', compact('event'));
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required|max:150',
                'email' => 'required|email|max:150',
                'subject' => 'required|max:230',
                'message' => 'required'
            ]);
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->save();
            return redirect()->back()->with('success', 'আপনার বার্তাটি সফলভাবে প্রেরণ হয়েছে।');
        } else {
            return view('frontEnd.pages.contact');
        }
    }


    public function about()
    {
        return view('frontEnd.pages.about');
    }


    public function upazila($id)
    {
        $upazilas = DB::table('upazilas')
            ->orderBy('name', 'asc')
            ->where('district_id', $id)->get();
        return response()->json($upazilas);
    }

    public function union($id)
    {
        $unions = DB::table('unions')
            ->orderBy('name', 'asc')
            ->where('upazila_id', $id)->get();
        return response()->json($unions);
    }


    public function sendMail(Request $request)
    {

        $take = $request->limit + 100;
        $ambassadors = Ambassador::orderBy('id', 'asc')->where('is_sent',0)/*->skip($request->limit)->take(100)*/->get();

//        return count($ambassadors);
//        exit();

        foreach ($ambassadors as $mail) {
            $subject = 'আপনি দুর্বার প্লাটফর্মের অ্যাম্বাসেডর হিসাবে প্রাথমিকভাবে নির্বাচিত হয়েছেন';
            $data = array('email' => $mail['email'], 'subject' => $subject, 'name' => $mail['name']);
            Mail::send('email', ['data' => $data], function ($message) use ($data) {
                $message->from('no-reply@durbar21.org', 'দুর্বার');
                $message->to($data['email']);
                $message->bcc('16173203069@cse.bubt.edu.bd');
                $message->subject($data['subject']);
            });
            Ambassador::where('email',$mail['email'])->update([
               'is_sent'=>1
            ]);
        }
    }

    public function shareResult($id)
    {
        $explode = explode('-',unlock($id));
        $user=User::findOrFail($explode[1]);
        $data['result']=Mark::where('quiz_id',$explode[0])->where('user_id',$explode[1])->first();
        $data['activeQuiz'] = Quiz::where('id',$data['result']->quiz_id)->first();
        return view('user-panel.quiz.share-result',compact('data','user'));
    }

    public function our_backup_database(){

        //ENTER THE RELEVANT INFO BELOW
        $mysqlHostName      = env('DB_HOST');
        $mysqlUserName      = env('DB_USERNAME');
        $mysqlPassword      = env('DB_PASSWORD');
        $DbName             = env('DB_DATABASE');
        $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';


        $queryTables = \DB::select(\DB::raw('SHOW TABLES'));
        foreach ( $queryTables as $table )
        {
            foreach ( $table as $tName)
            {
                $tables[]= $tName ;
            }
        }

        return $tables;

        exit();
        // $tables  = array("users","products","categories"); //here your tables...

        $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();
        $output = '';
        foreach($tables as $table)
        {
            $show_table_query = "SHOW CREATE TABLE " . $table . "";
            $statement = $connect->prepare($show_table_query);
            $statement->execute();
            $show_table_result = $statement->fetchAll();

            foreach($show_table_result as $show_table_row)
            {
                $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }
            $select_query = "SELECT * FROM " . $table . "";
            $statement = $connect->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();

            for($count=0; $count<$total_row; $count++)
            {
                $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                $table_column_array = array_keys($single_result);
                $table_value_array = array_values($single_result);
                $output .= "\nINSERT INTO $table (";
                $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                $output .= "'" . implode("','", $table_value_array) . "');\n";
            }
        }

        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_name));
        ob_clean();
        flush();
        readfile($file_name);
        unlink($file_name);

    }
}
