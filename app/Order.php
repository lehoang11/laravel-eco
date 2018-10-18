<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{    
	protected $table = 'orders';

    

    public function transactionshop() 
    {
    	return $this->belongsTo('App\Transactionshop');
    }


}
