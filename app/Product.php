<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';    

    public function cate() 
    {
    	return $this->belongTo('App\Cate');
    }

   public function user() 
    {
        return $this->belongTo('App\User','user_id');
    }

    public function product_details() 
    {
    	return $this->hasMany('App\Product_details');
    }
}
