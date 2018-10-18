<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cate;
use App\Product;
use App\Product_details;
use Backend;
use DB;
use Cart;
use Input;
use URL;
use App\Transactionshop;
use App\Order;



class WelcomeController extends Controller
{
   public function index() {
     

        # Get all products
      $products = DB::table('products')->orderBy('id','DESC')->skip(0)->take(6)->get();
      $data_recom1 = DB::table('products')->orderBy('id','DESC')->skip(0)->take(3)->get();
      $data_recom2 = DB::table('products')->orderBy('id','ASC')->skip(0)->take(3)->get();

      

        # Return the view
        return view('ecommerce/index/index',
                   [
                     'products'   => $products,
                     'data_recom1' =>$data_recom1,
                     'data_recom2' =>$data_recom2,

                   ]);
    }

    public function addcart($id){

   	    $product_buy=DB::table('products')->where('id',$id)->first();
   	    Cart::add(array('id'=>$id,'name'=>$product_buy->name,'qty'=>1,'price'=>$product_buy->price,'options'=>array('img'=>$product_buy->image)));

   	       $content=Cart::content();

          return redirect(URL::previous());

           

       }


    public function shopcart(){

		       $content=Cart::content();
		       $total = Cart::total();

		   	   return view('ecommerce/carts/shopcart',
		   	                [
		                     'content' => $content,
		                     'total' => $total,

		   	                ]);
	}
    

    public function deletecart($id){

       Cart::remove($id);
       # Return the admin to the cart  success message
        return redirect()->route('shopcart')->with('success', "The cart has been deleted");
    }


    public function blog() {

      return view('ecommerce.blog.index');

        }

    public function CheckAddress(){

           $content=Cart::content();
           $total = Cart::total();

           return view('ecommerce/carts/checkaddress',
                        [
                         'content' => $content,
                         'total' => $total,

                        ]);
  }

      public function storeCheckAddress(Request $request){
          
           $content=Cart::content();
           $total = Cart::total();

           $row = new Transactionshop();

           $row->user_email = $request->email ;
           $row->user_name = $request->firstname.' '.$request->lastname ;
           $row->user_phone = $request->phone ;
           $row->address = $request->address ;
           $row->message = $request->message ;
           $row->amount = $total ;
           $row->save();

           $transaction_id = $row->id;

           foreach ($content as $item) {
             
            $order = new Order();
            $order ->transaction_id = $transaction_id;
            $order ->product_id = $item->id;
            $order ->qty = $item->qty;
            $order ->unprice = $item->price;
            $order->save();

           }
           
           return redirect()->route('order')->with('success', "The cart has been created"); 
  }

      public function order() {
          
          Cart::destroy();
        
      return view('ecommerce.carts.order');

        }


}
