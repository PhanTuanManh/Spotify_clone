<?php

namespace App\Http\Controllers;

use App\Models\Songs;
use App\Models\Albums;
use App\Models\AlbumSong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SongAlbumController extends Controller
{
    public function index()
    {
        // Lấy danh sách album song
        $albumSongs = AlbumSong::all();
        $songs = Songs::all();
        $albums = Albums::all();

        return view('admin.song-album', compact('albumSongs', 'songs', 'albums'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'song_id' => 'required|exists:songs,Song_id',
            'album_id' => 'required|exists:albums,Album_id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $songId = $request->input('song_id');
        $albumId = $request->input('album_id');

        // Lưu dữ liệu vào bảng trung gian album_song
        AlbumSong::create([
            'song_id' => $songId,
            'album_id' => $albumId,
        ]);

        $songs = Songs::all();
        $albums = Albums::all();

        return redirect('/song-album')->with('success', 'Album-Song added successfully!')
            ->with('songs', $songs)
            ->with('albums', $albums);
    }


    // public function edit($id)
    // {
    //     $albumSong = AlbumSong::where('song_id', $id)->firstOrFail();
    //     $songs = Songs::all();
    //     $albums = Albums::all();

    //     return view('admin.song-album-edit', compact('albumSong', 'songs', 'albums'));
    // }

    public function edit(AlbumSong $albumSong)
    {
        $songs = Songs::pluck('Name', 'Song_id');
        $albums = Albums::pluck('Name', 'Album_id');

        return view('admin.song-album-edit', compact('albumSong', 'songs', 'albums'));
    }


    public function update(Request $request, AlbumSong $albumSong)
    {
        $albumSong->song_id = $request->input('song_id');
        $albumSong->album_id = $request->input('album_id');
        $albumSong->save();

        return redirect('/song-album')->with('success', 'Album song updated successfully');
    }

    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'song_id' => 'required|exists:songs,Song_id',
    //         'album_id' => 'required|exists:albums,Album_id',
    //     ]);


    //     return redirect('/song-album')->with('success', 'Album-Song updated successfully!');
    // }


    public function delete($albumId, $songId)
    {
        $album = Albums::find($albumId);

        if ($album) {
            $album->songs()->detach($songId);
            return redirect('/song-album')->with('success', 'Dữ liệu đã được xóa thành công.');
        } else {
            return redirect('/song-album')->with('error', 'Không tìm thấy dữ liệu.');
        }
    }
}
