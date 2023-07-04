<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fllowers extends Model
{
    use HasFactory;
    protected $table = 'fllowers';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = true;
}
