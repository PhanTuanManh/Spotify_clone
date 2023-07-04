<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table ='product';
    protected $primaryKey = 'product_id';

  
 
    public function category(){
        return $this -> belongsTo('App\Models\Category');
    }
    
    protected $fillable =[
        'product_name','product_price','quantity','product_description','category_id', 'audio', 'lyric', 'img'
    ];

}
