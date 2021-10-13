<?php

use Illuminate\Support\Facades\Mail;


function wish()
{
    date_default_timezone_set('Asia/Dhaka');
    $b = time();
    $hour = date("g", $b);
    $m    = date("A", $b);
    if ($m == "AM") {
        if ($hour == 12) {
            echo "Good Evening!";
        } elseif ($hour < 4) {
            echo "Good Evening!";
        } elseif ($hour > 3) {
            echo "Good Morning!";
        }
    }
    elseif ($m == "PM") {
        if ($hour == 12) {
            echo "Good Afternoon!";
        } elseif ($hour < 6) {
            echo "Good Afternoon!";
        } elseif ($hour > 5) {
            echo "Good Evening!";
        }
    }
}

function convertuTubeEmbed($string)
{
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
        $string
    );
}

function lock($string)
{
    return \Illuminate\Support\Facades\Crypt::encryptString($string);
}
function addHttp($url)
{
    // Search the pattern
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        // If not exist then add http
        $url = "http://" . $url;
    }
    // Return the URL
    return $url;
}
function caseId(){
    $code="";
    for ($i=0; $i<=10; $i++){
        $uniqid = rand(1000000,9999999);
        $code='DSA-'.$uniqid;
        $exist1=\App\Complain::where('case_id',$code)->count();
        if ($exist1==0) $i=10;
    }
    return $code;
}
function unlock($string)
{
    return \Illuminate\Support\Facades\Crypt::decryptString($string);
}


function language($english, $bangla)
{
    if (app()->getLocale() == 'en') {
        return $english;
    } elseif (app()->getLocale() == 'bn') {
        return $bangla;
    }
}

function generateRandomString($length = 20)
{

    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateRandomNumber($length = 20)
{

    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



function limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}



function uTubeId($url)
{
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    return $match[1];
}

function removeElement($array, $value)
{
    return array_diff($array, (is_array($value) ? $value : array($value)));
}
function category($id)
{
    return \App\Category::find($id);
}
function submitExam()
{
    $exams = \App\Mark::whereNull('end_time')->get();
    foreach ($exams as $exam)
    {
        $quiz = \App\Quiz::find($exam->quiz_id)->first();
        $endTime = date( "Y-m-d h:i:s", strtotime($exam->start_time)+(60*$quiz->qz_time));
        if($endTime < date("Y-m-d h:i:s")){

        }else{
            echo 'nai';
        }
    }
}
function EnToBn ($number){
    $bn= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    $en= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    return str_replace($en, $bn, $number);
}
function BnToEn ($number){
    $bn= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    $en= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    return str_replace($bn, $en, $number);
}

function BnDate($date){
    $engArray = array(
        1,2,3,4,5,6,7,8,9,0,
        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',
        'am', 'pm'
    );
    $bangArray = array(
        '১','২','৩','৪','৫','৬','৭','৮','৯','০',
        'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর',
        'সকাল', 'দুপুর'
    );

    $converted = str_replace($engArray, $bangArray, $date);
    return $converted;
}

/*function diffDateTime($start,$end)
{
    try {
        $start_date = new DateTime($start);
    } catch (Exception $e) {
    }
    try {
        $since_start = $start_date->diff(new DateTime($end));
    } catch (Exception $e) {
    }
    return $start_date->i.'m'.$since_start->s.';

}*/


function description_shortener($string, $length = null)
{
    if (empty($length)) $length = config('constants.stringLimit.default');
    return Illuminate\Support\Str::limit($string, $length);
}

