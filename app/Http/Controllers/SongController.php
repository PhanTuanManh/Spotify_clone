<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Songs;
use App\Models\Genre;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SongController extends Controller
{
    public function index()
    {
        $songs = Songs::all();
        $genres = Genre::all();
        return view('admin.song', compact('songs', 'genres'));
    }


    public function create()
    {
        $genres = Genre::all();
        return view('admin.song', ['genres' => $genres]);
    }


    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'lyrics' => 'required|string',
                'song_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'song_audio' => 'required|mimes:audio/mpeg,mpga,mp3,wav',
                'descriptions' => 'required|string',
                'genre_id' => 'required|exists:genres,Genre_id'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $fileName = 'noname.jpg';
            if ($request->hasFile('song_img')) {
                $file = $request->file('song_img');
                $path = public_path('song_images');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move($path, $fileName);
            }

            $fileNameAudio = 'noname.mp3';
            if ($request->hasFile('song_audio')) {
                $file = $request->file('song_audio');
                $path = public_path('song_audio');
                $fileNameAudio = time() . '_' . $file->getClientOriginalName();
                $file->move($path, $fileNameAudio);
            }

            $newSong = new Songs();
            $newSong->Name = $request->name;
            $newSong->Lyrics = $request->lyrics;
            $newSong->Song_IMG = $fileName;
            $newSong->Song_Audio = $fileNameAudio;
            $newSong->Descriptions = $request->descriptions;
            $newSong->Genre_id = $request->genre_id;
            $newSong->save();

            $genres = Genre::all();
            return redirect('/song')->with(compact('genres'))->with('success', 'Song added successfully!');
        }
    }

    public function edit($id)
    {
        $song = Songs::find($id);
        $genres = Genre::all();
        return view('admin.song-edit', compact('song', 'genres'));
    }

    public function update(Request $request, $id)
    {
        $song = Songs::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'lyrics' => 'required|string',
            'song_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'song_audio' => 'nullable|mimes:audio/mpeg,mpga,mp3,wav',
            'descriptions' => 'required|string',
            'genre_id' => 'required|exists:genres,Genre_id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $song->Name = $request->name;
        $song->Lyrics = $request->lyrics;
        $song->Descriptions = $request->descriptions;
        $song->Genre_id = $request->genre_id;

        // Handle file upload for song image
        if ($request->hasFile('song_img')) {
            $songImg = $request->file('song_img');
            $songImgName = time() . '_' . $songImg->getClientOriginalName();
            $songImg->move(public_path('song_images'), $songImgName);
            $song->Song_IMG = $songImgName;
        }

        // Handle file upload for song audio
        if ($request->hasFile('song_audio')) {
            $songAudio = $request->file('song_audio');
            $songAudioName = time() . '_' . $songAudio->getClientOriginalName();
            $songAudio->move(public_path('song_audio'), $songAudioName);
            $song->Song_Audio = $songAudioName;
        }

        $song->save();

        return redirect('/song')->with('success', 'Song updated successfully!');
    }

    public function delete($id)
    {
        $song = Songs::find($id);
        $song->delete();

        return redirect('/song')->with('success', 'Song deleted successfully!');
    }
}
