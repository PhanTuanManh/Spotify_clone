<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $genres = Genre::with('songs.artists')->get();

        return view('home.index', compact('genres'));
    }
}
