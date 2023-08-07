<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumTrack extends Model
{
    use HasFactory;
    protected $table = 'track_album';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'album_id',
        'track_id',
    ];

    public function albums()
    {
        return $this->belongsTo(Albums::class, 'album_id', 'Album_id');
    }

    public function tracks()
    {
        return $this->belongsTo(Tracks::class, 'track_id', 'Track_id');
    }
}
