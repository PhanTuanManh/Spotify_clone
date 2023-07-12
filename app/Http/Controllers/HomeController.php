<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Artists;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $genres = Genre::with('songs.artists')->get();
        $artists = Artists::inRandomOrder()->take(6)->get();

        return view('home.index', compact('genres', 'artists'));
    }
}
