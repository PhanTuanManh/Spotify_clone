<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artists extends Model
{
    use HasFactory;
    protected $primaryKey = 'Artist_id';
    protected $fillable = ['Name', 'Descriptions', 'Avatar'];

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'song_artist', 'song_id', 'artist_id');
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_artist', 'artist_id', 'album_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'Artist_id', 'User_id');
    }
}
