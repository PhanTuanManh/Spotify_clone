<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);

        return view('home.profile', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('home.profile-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        // Handle file upload for avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . $avatar->getClientOriginalName();
            $avatar->move(public_path('user_avatar'), $avatarName);
            $user->avatar = $avatarName;
        }

        $user->save();

        return redirect()->route('profile.index', ['id' => $id])->with('success', 'Profile updated successfully!');
    }
}
