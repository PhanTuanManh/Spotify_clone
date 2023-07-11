<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;
    protected $table = 'likes';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'User_id',
        'Song_id'
    ];

    protected $primaryKey = null;

    public function user()
    {
        return $this->belongsTo(User::class, 'User_id', 'User_id');
    }

    public function song()
    {
        return $this->belongsTo(Songs::class, 'Song_id', 'Song_id');
    }
}
