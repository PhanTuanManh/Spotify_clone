<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;


class PopController extends Controller
{
    public function show($name)
    {
        $genre = Genre::where('Name', $name)->firstOrFail();
        $songs = $genre->songs;
        // Xử lý logic để xác định view tương ứng dựa trên $name
        if ($name === 'Hip-Hop') {
            return view('home.hip-hop', compact('songs', 'genre'));
        } elseif ($name === 'Pop') {
            return view(
                'home.pop',
                compact('songs', 'genre')
            );
        } elseif ($name === 'R&B') {
            return view(
                'home.rnb',
                compact('songs', 'genre')
            );
        } elseif ($name === 'EDM') {
            return view(
                'home.edm',
                compact('songs', 'genre')
            );
        } elseif ($name === 'V-Pop') {
            return view(
                'home.vpop',
                compact('songs', 'genre')
            );
        } elseif ($name === 'K-Pop') {
            return view(
                'home.kpop',
                compact('songs', 'genre')
            );
        }
    }
}
