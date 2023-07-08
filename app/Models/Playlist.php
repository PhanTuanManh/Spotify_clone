<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'thumbnail'];

    protected $primaryKey = 'Playlist_id';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'User_id', 'User_id');
    }

    public function songs()
    {
        return $this->belongsToMany(Songs::class, 'song_playlist', 'slaylist_id', 'song_id');
    }
}
