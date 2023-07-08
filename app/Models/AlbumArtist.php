<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumArtist extends Model
{
    protected $table = 'album_artist';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'album_id',
        'artist_id',
    ];

    public function album()
    {
        return $this->belongsTo(Albums::class, 'album_id', 'Album_id');
    }

    public function artist()
    {
        return $this->belongsTo(Artists::class, 'artist_id', 'Artist_id');
    }
}
