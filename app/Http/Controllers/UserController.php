<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subcription;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function index()
    {
        $users = User::all();
        return view(
            'admin.user',
            ['users' => $users]
        );
    }
    public function edit(Request $request, $users)
    {
        // Lấy thông tin người dùng dựa trên $id từ cơ sở dữ liệu
        $users = User::findOrFail($users);
        $subscriptions = Subcription::all();
        // Trả về view edit.blade.php với dữ liệu người dùng
        return view('admin.edit', compact('users', 'subscriptions'));
    }
}
