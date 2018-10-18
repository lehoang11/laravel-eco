<?php
namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cate;
use App\Product;
use App\Product_details;
use Backend;
use Request;
use DB;
use Cart;



class AjaxController extends Controller
{
    public function updatecart($id){

	      if(Request::ajax()){
	      	$id=Request::get('id');
	      	$qty=Request::get('qty');
	      	Cart::update($id,$qty);
	      	echo "oke";
	      }
    }
}
