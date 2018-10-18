<?php

namespace App\Http\Controllers\Backend;

//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Backend;
use Storage;
use File,Input;
use App\Cate;
use App\Product;
use App\Product_details;
use Request;

class ProductController extends Controller
{
 public function index() {

        Backend::permissionToAccess('backend.product.access');

        # Get all cates
        $products = Backend::products();

        # Return the view
        return view('backend/products/index', ['products' => $products]);

    }

    public function create() {
        
        Backend::permissionToAccess('backend.product.access');
       # Check permissions
        Backend::permissionToAccess('backend.product.create');
         # Get all the data
        $data_index = 'products';
        require('Data/Create/Get.php');
         # Get all the cate choice id,parent_id,name
      $cate =Cate::select('id','name','parent_id')->get()->toArray();
        # Return the view
        return view('backend/products/create', [
            'cate'      =>  $cate,
            'fields'    =>  $fields,
            'confirmed' =>  $confirmed,
            'encrypted' =>  $encrypted,
            'hashed'    =>  $hashed,
            'masked'    =>  $masked,
            'table'     =>  $table,
            'code'      =>  $code,
            'wysiwyg'   =>  $wysiwyg,
            'relations' =>  $relations,
        ]);
    }

    public function store(Request $request) {

        Backend::permissionToAccess('backend.product.access');
        # Check permissions
        Backend::permissionToAccess('backend.product.create');

       # create the Cates
        $row = Backend::newProduct();
   
        $row->name     =Request::input('name');
        $row->alias =Backend::stripUnicode(Request::input('name'));
        $row->cate_id     =Request::input('cate_id');
        $row->price     =Request::input('price');
        $row->content     =Request::input('content');
        $row->keywords    =Request::input('keywords');
        $row->description    =Request::input('description');


        $row->user_id = Backend::loggedInUser()->id;

     

        # Check the file size for each file before uploading any of them
         $file_main = Request::file('image');
            $file_name_main = $file_main->getClientOriginalName();
            $max_upload = $file_main->getMaxFilesize() / 1000000;
            $max_upload = (string)$max_upload;
            if($file_main->getClientSize() == 0 or $file_main->getClientSize() > $file_main->getMaxFilesize()) {
                return redirect()->route('backend::files_upload')->with('error', trans('backend.msg_max_file_size', ['image' => $file_name_main, 'number' => substr($max_upload, 0, 4)]));
            }
           
            $file_name_main = $file_main->getClientOriginalName();
            Storage::put($file_name_main, File::get($file_main));

        $row->image=$file_name_main;

        $row->save();
        $product_id = $row->id;

            if ($files = Request::file('files')) {
              foreach($files as $file) {
                $file_name = $file->getClientOriginalName();
                $max_upload = $file->getMaxFilesize() / 1000000;
                $max_upload = (string)$max_upload;
                if($file->getClientSize() == 0 or $file->getClientSize() > $file->getMaxFilesize()) {
                    return redirect()->route('backend::files_upload')->with('error', trans('backend.msg_max_file_size', ['file' => $file_name, 'number' => substr($max_upload, 0, 4)]));
                }
            }

            foreach($files as $file) {
            $product_details = new Product_details();

            $file_name = $file->getClientOriginalName();
            $product_details->image=$file_name;
            $product_details->product_id = $product_id;
            $file->move('storage/app/detail/',$file->getClientOriginalName());

            $product_details->save();
            }  
      # Return the admin to the blogs page with a success message
        return redirect()->route('backend::products')->with('success', "The products has been created"); 
            }

      
        
    }

    public function edit($id) {

        Backend::permissionToAccess('backend.product.access');
        # Check permissions
        Backend::permissionToAccess('backend.product.edit');

        $row = Backend::product('id', $id);

        $pro_details =$row->product_details;
         # Get all the data
        $data_index = 'products';
        require('Data/Create/Get.php');
         # Get all the cate choice id,parent_id,name
      $cate =Cate::select('id','name','parent_id')->get()->toArray();
        # Return the view
        return view('backend/products/edit', [
            'row'       =>  $row,
         'pro_details'  =>  $pro_details,
            'cate'      =>  $cate,
            'fields'    =>  $fields,
            'confirmed' =>  $confirmed,
            'encrypted' =>  $encrypted,
            'hashed'    =>  $hashed,
            'masked'    =>  $masked,
            'table'     =>  $table,
            'code'      =>  $code,
            'wysiwyg'   =>  $wysiwyg,
            'relations' =>  $relations,
        ]);
        
    }

    public function update($id, Request $request) {

        Backend::permissionToAccess('backend.product.access');
        # Check permissions
        Backend::permissionToAccess('backend.product.edit');
        
        $row = Backend::product('id', $id);
            
       
        $row->name     =Request::input('name');
        $row->alias =Backend::stripUnicode(Request::input('name'));
        $row->cate_id     =Request::input('cate_id');
        $row->price     =Request::input('price');
        $row->content     =Request::input('content');
        $row->keywords    =Request::input('keywords');
        $row->description    =Request::input('description');


        $row->user_id = Backend::loggedInUser()->id;


 if(!empty($file_tp = Request::file('file'))){
         $file_name_tp = $file_tp->getClientOriginalName();
            $max_upload = $file_tp->getMaxFilesize() / 1000000;
            $max_upload = (string)$max_upload;
            if($file_tp->getClientSize() == 0 or $file_tp->getClientSize() > $file_tp->getMaxFilesize()) {
                return redirect()->route('backend::files_upload')->with('error', trans('backend.msg_max_file_size', ['file' => $file_name_tp, 'number' => substr($max_upload, 0, 4)]));
            }
          $imagedl = 'storage/app/'.Request::input('filedl');
            $file_name_tp = $file_tp->getClientOriginalName();
             $row->image=$file_name_tp;
            Storage::put($file_name_tp, File::get($file_tp));
            if(File::exists($imagedl)){
               File::delete($imagedl);
          }
         }else {
          echo "not fle";
         }
        $row->save();

            if ($files = Request::file('files')) {
              foreach($files as $file) {
                $file_name = $file->getClientOriginalName();
                $max_upload = $file->getMaxFilesize() / 1000000;
                $max_upload = (string)$max_upload;
                if($file->getClientSize() == 0 or $file->getClientSize() > $file->getMaxFilesize()) {
                    return redirect()->route('backend::files_upload')->with('error', trans('backend.msg_max_file_size', ['file' => $file_name, 'number' => substr($max_upload, 0, 4)]));
                }
            }

            foreach($files as $file) {
            $product_details = new Product_details();

            $file_name = $file->getClientOriginalName();
            $product_details->image=$file_name;
            $product_details->product_id =$id;
            $file->move('storage/app/detail/',$file->getClientOriginalName());

            $product_details->save();
            }  
           }

        

            # Return the admin to the blogs page with a success message
            return redirect()->route('backend::products')->with('success', "The products has been edited");
        
    }

        
    

    public function destroy($id) {

        Backend::permissionToAccess('backend.product.access');
        # Check permissions
        Backend::permissionToAccess('backend.product.delete');

        $row = Backend::product('id', $id);
               # Delete product_details
          foreach($row->product_details as $p_detail) {
       File::delete('storage/app/detail/'.$p_detail["image"]) ;
                $p_detail->delete();
            }
        File::delete('storage/app/'.$row->image); 
   
        $row->delete();

        return redirect()->route('backend::products')->with('success', "The product has been deleted");
        
    }

     public function imgdetail($id, Request $request){
       
   

      if($request::ajax()) {
        $idFILE =(int)Request::get('idFILE');
        $image_detail = Product_details::find($idFILE);
        if(!empty($image_detail)) {
          $img ='storage/app/detail/'.$image_detail->image;
          if (File::exists($img)) {
           File::delete($img);
          }
           $image_detail->delete();
        }
          return "Oke";
      }
}

}
