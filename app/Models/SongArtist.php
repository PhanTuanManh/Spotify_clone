<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongArtist extends Model
{
    use HasFactory;
    protected $table = 'song_artist';
    public $incrementing = false;
    protected $fillable = [
        'song_id',
        'artist_id',
    ];

    protected $primaryKey = ['song_id', 'artist_id'];

    public function song()
    {
        return $this->belongsTo(Songs::class, 'song_id', 'Song_id');
    }

    public function artist()
    {
        return $this->belongsTo(Artists::class, 'artist_id', 'Artist_id');
    }
}
