<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Artists;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        // Tìm kiếm genres dựa trên keyword
        $genres = Genre::where('Name', 'like', '%' . $keyword . '%')->get();

        return view('home.search', ['genres' => $genres]);
    }
}
