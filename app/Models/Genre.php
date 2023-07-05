<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['Name', 'Description'];
    protected $primaryKey = 'Genre_id';

    public function songs()
    {
        return $this->hasMany(Songs::class, 'Genre_id');
    }
}
