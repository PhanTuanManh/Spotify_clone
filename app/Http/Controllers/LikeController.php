<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function toggleLike(Request $request, $songId)
    {
        $userId = auth()->user()->id;

        $like = Likes::where('User_id', $userId)
            ->where('Song_id', $songId)
            ->first();

        if ($like) {
            $like->delete();
            $isLiked = false;
        } else {
            Likes::create([
                'User_id' => $userId,
                'Song_id' => $songId
            ]);
            $isLiked = true;
        }

        return response()->json(['isLiked' => $isLiked]);
    }
}
