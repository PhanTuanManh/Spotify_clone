<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artists;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artists::all();
        return view('admin.artist', ['artists' => $artists]);
    }

    public function xxxxxxxxxxxxxxxxxx  (Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'descriptions' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . $avatar->getClientOriginalName();
            $avatar->move(public_path('avatars'), $avatarName);
            $validatedData['Avatar'] = $avatarName;
        }

        // Create new artist
        Artists::create([
            'Name' => $validatedData['name'],
            'Descriptions' => $validatedData['descriptions'],
            'Avatar' => $validatedData['Avatar'] ?? null,
        ]);

        // Redirect or return a response
        return redirect()->back()->with('success', 'Artist added successfully!');
    }




    public function edit($id)
    {
        $artist = Artists::find($id);
        return view('admin.artist-edit', ['artist' => $artist]);
    }

    public function update(Request $request, $id)
    {
        $artist = Artists::find($id);

        // Cập nhật thông tin nghệ sĩ
        $artist->Name = $request->input('name');
        $artist->Descriptions = $request->input('descriptions');

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . $avatar->getClientOriginalName();
            $avatar->move(public_path('avatars'), $avatarName);
            $artist->Avatar = $avatarName;
        }

        // Lưu thông tin nghệ sĩ đã được cập nhật vào cơ sở dữ liệu
        $artist->save();

        // Chuyển hướng người dùng đến trang danh sách nghệ sĩ hoặc trang chi tiết nghệ sĩ đã được cập nhật
        return redirect('/artist')->with('status', 'Your data has been saved');
    }


    public function delete($id)
    {
        $artist = Artists::findOrFail($id);
        $artist->delete();

        return redirect('/artist')->with('status', 'Your data has been deleted');
    }
}
