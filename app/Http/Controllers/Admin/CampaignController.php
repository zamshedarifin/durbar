<?php

namespace App\Http\Controllers\Admin;

use App\Campaign;
use App\CampaignEnroll;
use App\CampaignStory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $campaign = new Campaign();
        if ($request->filled('title')) {
            $campaign = $campaign->where('title', 'like', '%' . $request->title . '%');
        }
        if ($request->filled('date')) {
            $campaign = $campaign->where('cam_date', date('Y-m-d', strtotime($request->date)));
        }
        if ($request->filled('status')) {
            $campaign = $campaign->where('status', $request->status);
        }
        if (!$request->filled('title') && !$request->filled('date') && !$request->filled('status')) {
            $campaigns = $campaign->orderBy('id', 'desc')->paginate(10);
        } else {
            $campaigns = $campaign->orderBy('id', 'desc')->paginate(10)->appends([
                'title' => $request->title,
                'date' => $request->date,
                'status' => $request->status
            ]);
        }
        return view('admin.campaign.index', compact('campaigns'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required|max:200',
                'title_bn' => 'max:255',
                'short_desc' => 'required|max:800',
                'description' => 'required',
                'short_desc_bn' => 'max:1000',
                'cam_date' => 'required|date',
                'cover' => 'required|mimes:png,jpg,jpeg,svg|max:1024',
                'status' => 'required|numeric'
            ], [
                'short_desc.required' => 'The short description field is required.',
                'cam_date.required' => 'The date field is required.',
            ]);

            if ($request->has('cover')) {
                $extension = $request->cover->getClientOriginalExtension();
                $cover = 'campaign_' . generateRandomString(22) . '.' . $extension;
                $request->cover->move(public_path("uploads/campaign/"), $cover);
            }

            $campaign = new Campaign();
            $campaign->title = $request->title;
            $campaign->title_bn = $request->title_bn;
            $campaign->short_desc = $request->short_desc;
            $campaign->short_desc_bn = $request->short_desc_bn;
            $campaign->description = $request->description;
            $campaign->description_bn = $request->description_bn;
            $campaign->cam_date = date('Y-m-d', strtotime($request->cam_date));
            $campaign->cover = $cover;
            $campaign->status = $request->status;
            $campaign->save();

            return redirect()->back()->with('success', 'Campaign has been created.');

        } else {
            return view('admin.campaign.create');
        }
    }

    public function edit(Request $request, $id)
    {
        $id = unlock($id);
        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required|max:200',
                'title_bn' => 'max:255',
                'short_desc' => 'required|max:800',
                'description' => 'required',
                'short_desc_bn' => 'max:1000',
                'cam_date' => 'required|date',
                'cover' => 'mimes:png,jpg,jpeg,svg|max:1024',
                'status' => 'required|numeric'
            ], [
                'short_desc.required' => 'The short description field is required.',
                'cam_date.required' => 'The date field is required.',
            ]);

            $campaign = Campaign::findOrFail($id);
            $campaign->title = $request->title;
            $campaign->title_bn = $request->title_bn;
            $campaign->short_desc = $request->short_desc;
            $campaign->short_desc_bn = $request->short_desc_bn;
            $campaign->description = $request->description;
            $campaign->description_bn = $request->description_bn;
            $campaign->cam_date = date('Y-m-d', strtotime($request->cam_date));
            if ($request->has('cover')) {
                $extension = $request->cover->getClientOriginalExtension();
                $cover = 'campaign_' . generateRandomString(22) . '.' . $extension;
                $request->cover->move(public_path("uploads/campaign/"), $cover);
                $campaign->cover = $cover;
            }
            $campaign->status = $request->status;
            $campaign->save();

            return redirect()->back()->with('success', 'Campaign has been updated successfully.');

        } else {
            $campaign = Campaign::findOrFail($id);
            return view('admin.campaign.edit', compact('campaign'));
        }
    }

    public function addStory(Request $request, $id)
    {
        $id = unlock($id);

        if ($request->isMethod('POST')) {
            $request->validate([
                'title' => 'required|max:255',
                'title_bn' => 'max:255',
                'description' => 'required',
                'description_bn' => 'nullable',
                'date' => 'required|date',
                'cover' => 'required|max:1024|mimes:png,jpg,jpeg',
                'status' => 'required|numeric'
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
            $story->campaign_id = $id;
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
            $campaign = Campaign::findOrFail($id);
            return view('admin.campaign.add-story', compact('campaign'));
        }
    }

    public function campaignEnroll($id)
    {
        $id = unlock($id);
        /*$enrolls = CampaignEnroll::with(['user','campaign' => function ($query) {
            $query->select('id', 'title');
        }])->orderBy('id', 'desc')->paginate(10);*/
        $enrolls = CampaignEnroll::orderBy('id','desc')->where('campaign_id', $id)->paginate(10);
        $campaign = Campaign::findOrFail($id);
        return view('admin.campaign.enroll', compact('enrolls', 'campaign'));
    }

}
