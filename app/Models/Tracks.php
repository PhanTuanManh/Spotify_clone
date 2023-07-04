<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracks extends Model
{
    protected $fillable = ['Name'];

    public function album()
    {
        return $this->belongsTo(Album::class, 'Album_id');
    }
}
