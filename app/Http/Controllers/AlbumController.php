<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Albums;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Albums::all();
        return view('admin.album', compact('albums'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'release_date' => 'required|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $album = new Albums();
        $album->Name = $request->name;
        $album->Release_date = $request->release_date;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('album_thumbnails'), $thumbnailName);
            $album->Thumbnail = $thumbnailName;
        }

        $album->save();

        return redirect()->route('album.index')
            ->with('success', 'Album added successfully!');
    }

    public function edit($id)
    {
        $album = Albums::find($id);
        return view('admin.album-edit', compact('album'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'release_date' => 'required|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $album = Albums::find($id);
        $album->Name = $request->name;
        $album->Release_date = $request->release_date;

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail file
            if ($album->Thumbnail) {
                $thumbnailPath = public_path('album_thumbnails/' . $album->Thumbnail);
                if (File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('album_thumbnails'), $thumbnailName);
            $album->Thumbnail = $thumbnailName;
        }

        $album->save();

        return redirect('/album')->with('success', 'Album updated successfully!');
    }

    public function delete($id)
    {
        $album = Albums::find($id);

        // Delete thumbnail file
        if ($album->Thumbnail) {
            $thumbnailPath = public_path('album_thumbnails/' . $album->Thumbnail);
            if (File::exists($thumbnailPath)) {
                File::delete($thumbnailPath);
            }
        }

        $album->delete();

        return redirect('/album')->with('success', 'Album deleted successfully!');
    }
}
