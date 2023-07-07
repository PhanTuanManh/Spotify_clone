<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumSong extends Model
{
    use HasFactory;
    protected $table = 'album_song';
    public $incrementing = false;
    protected $fillable = [
        'song_id',
        'album_id'
    ];

    protected $primaryKey = ['song_id', 'album_id'];

    public function song()
    {
        return $this->belongsTo(Songs::class, 'song_id', 'Song_id');
    }

    public function album()
    {
        return $this->belongsTo(Albums::class, 'album_id', 'Album_id');
    }
}
