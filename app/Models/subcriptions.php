<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcription extends Model
{
    public function users()
    {
        return $this->hasMany(User::class, 'Plan_id');
    }

    protected $fillable = ['Plan_name', 'Price', 'Duration', 'Start_date', 'End_date', 'Status'];
}
