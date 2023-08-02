<?php

namespace App\Http\Controllers;

use App\Models\Artists;
use Illuminate\Http\Request;
use App\Models\Albums;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\AlbumArtist;


class AlbumController extends Controller
{
    public function index()
    {
        $albums = Albums::all();
        $artists = Artists::all();
        return view('admin.album', compact('albums', 'artists'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'release_date' => 'required|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'artist_id' => 'required|array',
            'artist_id.*' => 'exists:artists,Artist_id',
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


        $album->artists()->attach($request->Artist_id); // Lưu danh sách nghệ sĩ vào bảng song_artist

        $artists = $request->input('artist_id');
        if (!empty($artists)) {
            foreach ($artists as $artistId) {
                $albumArtist = new AlbumArtist();
                $albumArtist->album_id = $album->Album_id;
                $albumArtist->artist_id = $artistId;
                $albumArtist->save();
            }
        }

        return redirect()->route('album.index')
            ->with('success', 'Album added successfully!');
    }

    public function edit($id)
    {
        $album = Albums::with('artists')->find($id);
        $artists = Artists::all();
        $selectedArtists = $album->artists->pluck('Artist_id')->toArray();
        return view('admin.album-edit', compact('album', 'artists', 'selectedArtists'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'release_date' => 'required|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'artist_id' => 'required|array',
            'artist_id.*' => 'exists:artists,Artist_id',
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
        $artists = $request->input('artist_id');
        $album->artists()->sync($artists);

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
