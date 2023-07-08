<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artists;
use App\Models\Albums;
use App\Models\AlbumArtist;
use Illuminate\Support\Facades\Validator;

class AlbumArtistController extends Controller
{
    public function index()
    {
        // Lấy danh sách album artist
        $albumArtists = AlbumArtist::all();
        $artists = Artists::all();
        $albums = Albums::all();

        return view('admin.artist-album', compact('albumArtists', 'artists', 'albums'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'artist_id' => 'required|exists:artists,Artist_id',
            'album_id' => 'required|exists:albums,Album_id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $artistId = $request->input('artist_id');
        $albumId = $request->input('album_id');

        // Lưu dữ liệu vào bảng trung gian album_artist
        AlbumArtist::create([
            'artist_id' => $artistId,
            'album_id' => $albumId,
        ]);

        return redirect('/artist-album')->with('success', 'Album-Artist added successfully!');
    }

    public function delete($albumId, $artistId)
    {
        $albumArtist = AlbumArtist::where('album_id', $albumId)
            ->where('artist_id', $artistId)
            ->first();

        if ($albumArtist) {
            $albumArtist->delete();
            return redirect('/artist-album')->with('success', 'Data deleted successfully.');
        } else {
            return redirect('/artist-album')->with('error', 'Data not found.');
        }
    }
}
