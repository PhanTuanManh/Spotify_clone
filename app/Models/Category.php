<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";

    protected $primaryKey = 'category_id';

    public $timestamps = false;


    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }



    protected $fillable = [

        'category_name', 'category_description',

    ];
}
