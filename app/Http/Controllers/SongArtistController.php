<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artists;
use App\Models\Songs;
use App\Models\SongArtist;
use Illuminate\Support\Facades\Validator;

class SongArtistController extends Controller
{
    // 
    public function index()
    {
        // Lấy danh sách album artist
        $songArtists = SongArtist::all();
        $artists = Artists::all();
        $songs = Songs::all();

        return view('admin.artist-song', compact('songArtists', 'artists', 'songs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'artist_id' => 'required|exists:artists,Artist_id',
            'song_id' => 'required|exists:songs,Song_id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $artistId = $request->input('artist_id');
        $songId = $request->input('song_id');

        // Lưu dữ liệu vào bảng trung gian album_artist
        SongArtist::create([
            'artist_id' => $artistId,
            'song_id' => $songId,
        ]);

        return redirect('/artist-song')->with('success', 'Album-Artist added successfully!');
    }

    public function delete($songId, $artistId)
    {
        $songArtists = SongArtist::where('song_id', $songId)
            ->where('artist_id', $artistId)
            ->first();

        if ($songArtists) {
            $songArtists->delete();
            return redirect('/artist-song')->with('success', 'Data deleted successfully.');
        } else {
            return redirect('/artist-song')->with('error', 'Data not found.');
        }
    }
}
