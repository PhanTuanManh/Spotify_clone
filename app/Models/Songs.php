<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Songs extends Model
{
    use HasFactory;
    protected $primaryKey = 'Song_id';
    public $timestamps = true;

    protected $fillable = ['Name', 'Lyrics', 'Song_IMG', 'Song_Audio', 'Descriptions'];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'Genre_id');
    }

    public function likes()
    {
        return $this->belongsToMany(Songs::class, 'likes', 'User_id', 'Song_id');
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'song_playlist', 'song_id', 'playlist_id');
    }

    public function artists()
    {
        return $this->belongsToMany(Artists::class, 'song_artist', 'song_id', 'Artist_id');
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_song', 'song_id', 'album_id');
    }
}
