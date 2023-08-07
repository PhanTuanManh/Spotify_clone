<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracks extends Model
{
    protected $table = 'tracks';
    protected $primaryKey = 'Track_id';
    public $timestamps = true;

    protected $fillable = [
        'Name', 'Thumbnail',
    ];

    public function albums()
    {
        return $this->belongsToMany(Albums::class, 'track_album', 'track_id', 'album_id');
    }
}
