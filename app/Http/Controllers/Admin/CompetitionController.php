<?php

namespace App\Http\Controllers\Admin;

use App\Campaign;
use App\Competition;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index()
    {
        $competitions = Competition::orderBy('id', 'desc')->paginate(10);
        return view('admin.competition.index', compact('competitions'));
    }

    public function create(Request $request)
    {

        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required|max:255',
                'title_bn' => 'required|max:255',
                'description' => 'required',
                'description_bn' => 'required',
                'date' => 'required|max:100',
                'location' => 'required|max:200',
                'thumbnail' => 'required|max:1024|mimes:png,jpg,jpeg',
                'status' => 'required|numeric',
                'campaign' => 'required|numeric'
            ]);

            $date = explode('-',$request->date);

            $description = $request->description;
            $dom = new \DomDocument('1.0', 'UTF-8');
            libxml_use_internal_errors(true);
            $dom->loadHtml(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'),
                LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            $bs64 = 'base64';//variable to check the image is base64 or not
            foreach ($images as $k => $img) {
                $data = $img->getAttribute('src');
                if (strpos($data, $bs64) == true)//if the Image is base 64
                {
                    $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
                    $image_name = "/uploads/" . generateRandomString() . time() . $k . '.png';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                } else {
                    $image_name = $data;
                    $img->setAttribute('src', $image_name);
                }
            };

            $description = $dom->saveHTML();

            $description_bn = $request->description;
            $dom = new \DomDocument('1.0', 'UTF-8');
            libxml_use_internal_errors(true);
            $dom->loadHtml(mb_convert_encoding($description_bn, 'HTML-ENTITIES', 'UTF-8'),
                LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            $bs64 = 'base64';//variable to check the image is base64 or not
            foreach ($images as $k => $img) {
                $data = $img->getAttribute('src');
                if (strpos($data, $bs64) == true)//if the Image is base 64
                {
                    $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
                    $image_name = "/uploads/" . generateRandomString() . time() . $k . '.png';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                } else {
                    $image_name = $data;
                    $img->setAttribute('src', $image_name);
                }
            };

            $description_bn = $dom->saveHTML();

            if ($request->has('thumbnail')) {
                $extension = $request->thumbnail->getClientOriginalExtension();
                $thumbnail = 'competition_' . generateRandomString(22) . '.' . $extension;
                $request->thumbnail->move(public_path("uploads/competition/"), $thumbnail);
            }
            $competition = new Competition();
            $competition->campaign_id = $request->campaign;
            $competition->title = $request->title;
            $competition->title_bn = $request->title_bn;
            $competition->location = $request->location;
            $competition->description = $description;
            $competition->description_bn = $description_bn;
            $competition->cover = $thumbnail;
            $competition->start_date = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$date[0])));
            $competition->end_date = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$date[1])));
            $competition->status = $request->status;
            $competition->save();
            return redirect()->back()->with('success', 'Competition has been added.');
        } else {
            $campaigns = Campaign::orderBy('id', 'desc')->get();
            return view('admin.competition.create', compact('campaigns'));
        }

    }

    public function edit(Request $request, $id)
    {
        $id = unlock($id);
        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required|max:255',
                'title_bn' => 'required|max:255',
                'description' => 'required',
                'description_bn' => 'required',
                'date' => 'required|max:100',
                'location' => 'required|max:200',
                'thumbnail' => 'max:1024|mimes:png,jpg,jpeg',
                'status' => 'required|numeric',
                'campaign' => 'required|numeric'
            ]);
            $date = explode('-',$request->date);
            $description = $request->description;
            $dom = new \DomDocument('1.0', 'UTF-8');
            libxml_use_internal_errors(true);
            $dom->loadHtml(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'),
                LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            $bs64 = 'base64';//variable to check the image is base64 or not
            foreach ($images as $k => $img) {
                $data = $img->getAttribute('src');
                if (strpos($data, $bs64) == true)//if the Image is base 64
                {
                    $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
                    $image_name = "/uploads/" . generateRandomString() . time() . $k . '.png';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                } else {
                    $image_name = $data;
                    $img->setAttribute('src', $image_name);
                }
            };

            $description = $dom->saveHTML();

            $description_bn = $request->description_bn;
            $dom = new \DomDocument('1.0', 'UTF-8');
            libxml_use_internal_errors(true);
            $dom->loadHtml(mb_convert_encoding($description_bn, 'HTML-ENTITIES', 'UTF-8'),
                LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            $bs64 = 'base64';//variable to check the image is base64 or not
            foreach ($images as $k => $img) {
                $data = $img->getAttribute('src');
                if (strpos($data, $bs64) == true)//if the Image is base 64
                {
                    $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
                    $image_name = "/uploads/" . generateRandomString() . time() . $k . '.png';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                } else {
                    $image_name = $data;
                    $img->setAttribute('src', $image_name);
                }
            };

            $description_bn = $dom->saveHTML();


            $competition = Competition::findOrFail($id);

            $competition->campaign_id = $request->campaign;
            $competition->title = $request->title;
            $competition->title_bn = $request->title_bn;
            $competition->location = $request->location;
            $competition->description = $description;
            $competition->description_bn = $description_bn;
            if ($request->has('thumbnail')) {
                $extension = $request->thumbnail->getClientOriginalExtension();
                $thumbnail = 'competition_' . generateRandomString(22) . '.' . $extension;
                $request->thumbnail->move(public_path("uploads/competition/"), $thumbnail);
                $competition->cover = $thumbnail;

            }

            $competition->start_date = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$date[0])));
            $competition->end_date = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$date[1])));
            $competition->status = $request->status;
            $competition->save();
            return redirect()->back()->with('success', 'Competition has been updated.');

        } else {
            $campaigns = Campaign::orderBy('id', 'desc')->get();
            $competition = Competition::findOrFail($id);
            return view('admin.competition.edit', compact('campaigns', 'competition'));
        }
    }
}
