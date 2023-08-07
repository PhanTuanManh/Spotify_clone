<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Albums;
use Illuminate\Support\Facades\File;
use App\Models\Tracks;
use App\Models\AlbumTrack;
use Illuminate\Support\Facades\Validator;

class TrackController extends Controller
{

    public function index()
    {
        $tracks = Tracks::with('albums')->get();
        $albums = Albums::all();
        return view('admin.track', compact('tracks', 'albums'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'album_id' => 'required|array', // Trường album_id phải là một mảng
            'album_id.*' => 'exists:albums,Album_id', // Kiểm tra từng phần tử của mảng album_id có tồn tại trong bảng albums
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $fileName = 'noname.jpg';
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $path = public_path('track_thumbnails');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $fileName);
        }

        $track = new Tracks();
        $track->Name = $request->input('name');
        $track->Thumbnail = $fileName;
        $track->save();

        $albumIds = $request->input('album_id');

        if (!empty($albumIds)) {
            foreach ($albumIds as $albumId) {
                $trackAlbum = new AlbumTrack(); // Corrected the model name to TrackAlbum
                $trackAlbum->album_id = $albumId; // Use $albumId instead of $album->Album_id
                $trackAlbum->track_id = $track->Track_id; // Assuming 'id' is the primary key of the 'Tracks' model
                $trackAlbum->save();
            }
        }

        return redirect('/track')->with('success', 'Track added successfully');
    }

    public function edit(Request $request, $id)
    {
        $track = Tracks::with('albums')->find($id);
        $albums = Albums::all();
        $selectedAlbums = $track->albums->pluck('Album_id')->toArray();
        return view('admin.track-edit', compact('track', 'albums', 'selectedAlbums'));
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'album_id' => 'required|array', // Trường album_id phải là một mảng
            'album_id.*' => 'exists:albums,Album_id', // Kiểm tra từng phần tử của mảng album_id có tồn tại trong bảng albums
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $track = Tracks::find($id);
        $track->Name = $request->name;

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail file
            if ($track->Thumbnail) {
                $thumbnailPath = public_path('track_thumbnails/' . $track->Thumbnail);
                if (File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('track_thumbnails'), $thumbnailName);
            $track->Thumbnail = $thumbnailName;
        }

        $track->save();
        $albums = $request->input('album_id');
        $track->albums()->sync($albums);

        return redirect('/track')->with('success', 'Album updated successfully!');
    }

    public function delete($id)
    {
        $track = Tracks::find($id);

        // Delete thumbnail file
        if ($track->Thumbnail) {
            $thumbnailPath = public_path('track_thumbnails/' . $track->Thumbnail);
            if (File::exists($thumbnailPath)) {
                File::delete($thumbnailPath);
            }
        }

        $track->delete();

        return redirect('/track')->with('success', 'Album deleted successfully!');
    }
}
