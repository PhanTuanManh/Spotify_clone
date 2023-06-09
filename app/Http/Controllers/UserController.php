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
        return view('admin.user-edit', compact('users', 'subscriptions'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        // Cập nhật thông tin người dùng
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->user_type = $request->input('user_type');
        $user->Plan_id = $request->input('plan_id');

        // Lưu thông tin người dùng đã được cập nhật vào cơ sở dữ liệu
        $user->save();

        // Chuyển hướng người dùng đến trang danh sách người dùng hoặc trang chi tiết người dùng đã được cập nhật
        return redirect('/user')->with('status', 'Your data has been saved');
    }
    // UserController.php
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/user')->with('status', 'Your data has been deleted');
    }
}
