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
        'Album_id',
        'Name',
    ];

    public function album()
    {
        return $this->belongsTo(Albums::class, 'Album_id', 'Album_id');
    }
}
