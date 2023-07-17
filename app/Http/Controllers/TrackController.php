<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Albums;
use App\Models\Tracks;
use Illuminate\Support\Facades\Validator;

class TrackController extends Controller
{

    public function index()
    {
        $tracks = Tracks::all();
        $albums = Albums::all();
        return view('admin.track', compact('tracks', 'albums'));
    }

    public function edit(Request $request, $id)
    {
        $track = Tracks::findOrFail($id);
        $albums = Albums::all();
        return view('admin.track-edit', compact('track', 'albums'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'album_id' => 'required|array', // Trường album_id phải là một mảng
            'album_id.*' => 'exists:albums,Album_id', // Kiểm tra từng phần tử của mảng album_id có tồn tại trong bảng albums
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $fileName = 'noname.jpg';
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $path = public_path('track_thumbnails');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $fileName);
        }

        $albumIds = $request->input('album_id'); // Lấy giá trị của trường album_id trong một mảng
        $albumIdsString = implode(',', $albumIds); // Chuyển đổi mảng albumIds thành chuỗi được phân tách bằng dấu phẩy

        $track = new Tracks();
        $track->Name = $request->input('name');
        $track->Thumbnail = $fileName;
        $track->Album_id = $albumIdsString; // Lưu chuỗi albumIdsString vào trường Album_id
        $track->save();

        return redirect('/track')->with('success', 'Track added successfully');
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'album_id' => 'required|exists:albums,Album_id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $track = Tracks::find($id);

        $track->Name = $request->input('name');
        $track->Album_id = $request->input('album_id');

        // Handle file upload for track thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('track_thumbnails'), $thumbnailName);
            $track->Thumbnail = $thumbnailName;
        }

        $track->save();

        return redirect('/track')->with('success', 'Track updated successfully');
    }

    public function delete($id)
    {
        $track = Tracks::findOrFail($id);
        $track->delete();

        return redirect('/track')->with('success', 'Track deleted successfully');
    }
}
