<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Songs;
use App\Models\Artists;

class DashboardController extends Controller
{


    public function index()
    {
        $userCount = User::count();
        $songCount = Songs::count();
        $artistCount = Artists::count();

        $users = User::take(4)->get();

        return view('admin.dashboard', compact('userCount', 'songCount', 'artistCount', 'users'));
    }
}
