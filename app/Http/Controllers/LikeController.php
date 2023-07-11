<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Likes; // Import the Like model

class LikeController extends Controller
{
    public function likeSong(Request $request, $songId)
    {
        // Check if the user has already liked the song
        $existingLike = Likes::where('User_id', auth()->user()->id)
            ->where('Song_id', $songId)
            ->first();

        if ($existingLike) {
            // User has already liked the song, so remove the like
            $existingLike->delete();
        } else {
            // User has not liked the song, so save the like
            $like = new Likes();
            $like->User_id = auth()->user()->id;
            $like->Song_id = $songId;
            $like->save();
        }

        return response()->json(['success' => true]);
    }
}
