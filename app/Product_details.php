<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_details extends Model
{
    protected $table = 'product_details';

    protected $fillable =['image','product_id'];


    public function product() 
    {
    	return $this->belongTo('App\Product');
    }

     public $timestamps = false;
}
