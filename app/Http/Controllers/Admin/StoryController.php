<?php

namespace App\Http\Controllers\Admin;

use App\Campaign;
use App\CampaignStory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        $stories = CampaignStory::orderBy('id', 'desc')->paginate(10);
        return view('admin.story.index', compact('stories'));
    }

    public function create(Request $request)
    {

        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required|max:255',
                'title_bn' => 'max:255',
                'description' => 'required',
                'description_bn' => 'nullable',
                'date' => 'required|date',
                'cover' => 'required|max:1024|mimes:png,jpg,jpeg',
                'status' => 'required|numeric',
                'campaign' => 'required|numeric'
            ]);

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

            if ($request->has('cover')) {
                $extension = $request->cover->getClientOriginalExtension();
                $cover = 'story_' . generateRandomString(22) . '.' . $extension;
                $request->cover->move(public_path("uploads/story/"), $cover);
            }
            $story = new CampaignStory();
            $story->campaign_id = $request->campaign;
            $story->title = $request->title;
            $story->title_bn = $request->title_bn;
            $story->description = $description;
            $story->description_bn = $description_bn;
            $story->cover = $cover;
            $story->published_date = date('Y-m-d', strtotime($request->date));
            $story->status = $request->status;
            $story->save();
            return redirect()->back()->with('success', 'Story has been added.');
        } else {
            $campaigns = Campaign::orderBy('id', 'desc')->get();
            return view('admin.story.create', compact('campaigns'));
        }

    }

    public function edit(Request $request, $id)
    {
        $id = unlock($id);
        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required|max:255',
                'title_bn' => 'max:255',
                'description' => 'required',
                'description_bn' => 'nullable',
                'date' => 'required|date',
                'cover' => 'max:1024|mimes:png,jpg,jpeg',
                'status' => 'required|numeric',
                'campaign' => 'required|numeric'
            ]);

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


            $story = CampaignStory::findOrFail($id);
            $story->campaign_id = $request->campaign;
            $story->title = $request->title;
            $story->title_bn = $request->title_bn;
            $story->description = $description;
            $story->description_bn = $description_bn;
            if ($request->has('cover')) {
                $extension = $request->cover->getClientOriginalExtension();
                $cover = 'story_' . generateRandomString(22) . '.' . $extension;
                $request->cover->move(public_path("uploads/story/"), $cover);
                $story->cover = $cover;
            }
            $story->published_date = date('Y-m-d', strtotime($request->date));
            $story->status = $request->status;
            $story->save();
            return redirect()->back()->with('success', 'Story has been updated.');

        } else {
            $campaigns = Campaign::orderBy('id', 'desc')->get();
            $story = CampaignStory::findOrFail($id);
            return view('admin.story.edit', compact('campaigns', 'story'));
        }
    }
}
