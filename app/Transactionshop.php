<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactionshop extends Model
{
     protected $table = 'transactions';

     public function order() 
    {
    	return $this->hasMany('App\Order');
    }
}
