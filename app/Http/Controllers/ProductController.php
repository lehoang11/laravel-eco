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
class ProductController extends Controller
{

    public function details($id) {
     

        # Get all products
        $products = Backend::product('id', $id);
        $p_details = Product_details::where('product_id', $products->id)->get();

       $data_recom1 = DB::table('products')->orderBy('id','DESC')->skip(0)->take(3)->get();
      $data_recom2 = DB::table('products')->orderBy('id','ASC')->skip(0)->take(3)->get();
        # Return the view
        return view('ecommerce/products/details',
                   [
                     'products'  => $products,
                     'p_details' => $p_details,
                     'data_recom1' =>$data_recom1,
                     'data_recom2' =>$data_recom2,
                   ]);
    }

    public function cates($id) {
     

        # Get all products
        $products = Product::where('cate_id', $id)->paginate(20);
      
        # Return the view
        return view('ecommerce/products/cate',
                   [
                     'products'  => $products,
                     
                   ]);
    }
    public function subcates($id) {
     

        # Get all products
        $products = Product::where('cate_id', $id)->paginate(20);
      
        # Return the view
        return view('ecommerce/products/subcate',
                   [
                     'products'  => $products,
                     
                   ]);
    }
    public function search(Request $request) {
           $this->validate($request, [
                                    'search' => 'required'
                                     ]);
          $search = $request->get('search');

        $data = Product::where('name', 'like', "%$search%")
            ->orWhere('keywords', 'like', "%$search%")
            ->paginate(10);
        
            return view('ecommerce.products.search',
                     [
                     'search'  => $search,
                    'data'  => $data,   
                     ]);            
    
    }


}
