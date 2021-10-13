<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Http\Controllers\Controller;
use App\Photos;
use Illuminate\Http\Request;
use File;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::paginate(10);
        return view('admin.album.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'description' => 'required|max:700',
            'image' => 'required|mimes:png,jpg,jpeg,svg|max:1024',
            'status' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $fileName = 'album_' . time() . generateRandomString(22) . '.' . $extension;
            $request->image->move(public_path("uploads/album/"), $fileName);
        }
        $album = new Album;
        $album->title = $request->name;
        $album->description = $request->description;
        $album->thumbnail = $fileName;
        $album->status = $request->status;
        $album->save();
        return redirect()->back()->with('success', 'Album has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = unlock($id);
        $album = Album::findOrFail($id);
        return view('admin.album.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = unlock($id);
        $album = Album::findOrFail($id);
        return view('admin.album.edit', compact('album'));
    }

    public function albumPhotoAdd($id)
    {
        $id = unlock($id);
        $album = Album::findOrFail($id);
        return view('admin.album.addPhoto', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = unlock($id);
        $request->validate([
            'name' => 'required|max:200',
            'description' => 'required|max:700',
            'image' => 'mimes:png,jpg,jpeg,svg|max:1024',
            'status' => 'required',
        ]);
        $album = Album::findOrFail($id);
        $album->title = $request->name;
        $album->description = $request->description;
        if ($request->hasFile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $fileName = generateRandomString(22) . '.' . $extension;
            $request->image->move(public_path("uploads/album/"), $fileName);
            $album->thumbnail = $fileName;
        }
        $album->status = $request->status;
        $album->save();

        return redirect()->back()->with('success', 'Album has been updated.');
    }

    public function photoStore(Request $request)
    {
        $request->validate([
            'description' => 'max:700',
            'image' => 'required|mimes:png,jpg,jpeg,svg|max:1024',
            'album' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $fileName = generateRandomString(22) . '.' . $extension;
            $request->image->move(public_path("uploads/photo/"), $fileName);
        }

        $album = new Photos();
        $album->album_id = $request->album;
        $album->description = $request->description;
        $album->photo = $fileName;
        $album->save();
        return redirect()->back()->with('success','Photo added in album successfully.');
    }

    public function destroy($id)
    {
        $id = unlock($id);
        $photo = Album::findOrFail($id);
        if (File::exists(public_path("uploads/album/$photo->thumbnail"))) {
            File::delete(public_path("uploads/album/$photo->thumbnail"));
        }
        Album::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Thank You ! Image has been deleted.');
    }

    public function photoDestroy($id)
    {
        $id = unlock($id);
        $photo = Photos::findOrFail($id);
        if (File::exists(public_path("uploads/photo/$photo->photo"))) {
            File::delete(public_path("uploads/photo/$photo->photo"));
        }
        Photos::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Thank You ! Photo has been deleted.');
    }
}
