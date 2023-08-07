<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Artists;
use App\Models\Songs;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        // Tìm kiếm genres dựa trên keyword
        $genres = Genre::where('Name', 'like', '%' . $keyword . '%')->get();

        return view('home.search', ['genres' => $genres]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Sử dụng câu truy vấn để tìm kiếm bài hát theo tên
        $songs = Songs::where('Name', 'like', '%' . $searchTerm . '%')->get();

        return view('home.search-result', compact('songs'));
    }
}
