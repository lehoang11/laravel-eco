<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Backend;
use Storage;
use App\Product;
use App\Order;
use App\Transactionshop;
use DB;

class OrderController extends Controller
{
    public function index() {

        Backend::permissionToAccess('backend.order.access');

        # Get all cates
        $order = Backend::transactionshops();

        # Return the view
        return view('backend/order/index', ['order' => $order]);

    }

    public function details($id) {

    	 Backend::permissionToAccess('backend.order.access');

    	 $row = Backend::transactionshop('id', $id);

$order = DB::table('orders')
 ->join('products', 'products.id','=','orders.product_id')
    ->select('orders.*', 'products.name', 'products.image')
    ->where('orders.transaction_id', '=', $id)
    ->get();
  

        return view('backend/order/details',
                 [
                 'row' => $row,
                 'order' => $order,
                 ]);
    }

    public function destroy($id) {

        Backend::permissionToAccess('backend.order.access');

        Backend::permissionToAccess('backend.order.delete');

        $row = Backend::transactionshop('id', $id);

        $datas = Order::where('transaction_id', $row->id)->get();
        foreach($datas as $data) {
            $data->delete();
        }

        $row->delete();
         return redirect()->route('backend::order')->with('success', "The order has been deleted");
 	
    }

}
