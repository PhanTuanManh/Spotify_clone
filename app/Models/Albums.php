<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    use HasFactory;
    protected $fillable = ['Name', 'Release_date', 'Thumbnail'];

    protected $primaryKey = 'Album_id';
    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'album_artist', 'album_id', 'artist_id');
    }

    public function songs()
    {
        return $this->belongsToMany(Songs::class, 'album_song', 'album_id', 'song_id');
    }
}
