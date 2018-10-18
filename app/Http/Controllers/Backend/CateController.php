<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Backend;
use App\Cate;

class CateController extends Controller
{
    public function index() {

    	Backend::permissionToAccess('backend.cate.access');

        # Get all cates
        $cates = Backend::cates();

        # Return the view
        return view('backend/cates/index', ['cates' => $cates]);

    }

    public function create() {
    	
    	Backend::permissionToAccess('backend.cate.access');
       # Check permissions
        Backend::permissionToAccess('backend.cate.create');
    	 # Get all the data
        $data_index = 'cates';
        require('Data/Create/Get.php');
         # Get all the cate choice id,parent_id,name
      $parent =Cate::select('id','name','parent_id')->get()->toArray();
        # Return the view
        return view('backend/cates/create', [
        	'parent'    =>  $parent,
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

    	Backend::permissionToAccess('backend.cate.access');
    	# Check permissions
        Backend::permissionToAccess('backend.cate.create');

       # create the Cates
        $row = Backend::newCate();
          # Save the data
        $data_index = 'cates';
        require('Data/Create/Save.php');

        $row->alias=Backend::stripUnicode( $request->name);
        $row->parent_id= $request->parent_id;
        $row->save();

        # Return the admin to the blogs page with a success message
        return redirect()->route('backend::cates')->with('success', "The cates has been created");
    	
    }

    public function edit($id) {

    	Backend::permissionToAccess('backend.cate.access');
    	# Check permissions
        Backend::permissionToAccess('backend.cate.edit');

        $row = Backend::cate('id', $id);

    	 # Get all the data
        $data_index = 'cates';
        require('Data/Create/Get.php');
         # Get all the cate choice id,parent_id,name
      $parent =Cate::select('id','name','parent_id')->get()->toArray();
        # Return the view
        return view('backend/cates/edit', [
        	'row'       =>  $row,
        	'parent'    =>  $parent,
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

    	Backend::permissionToAccess('backend.cate.access');
    	# Check permissions
        Backend::permissionToAccess('backend.cate.edit');
        
        $row = Backend::cate('id', $id);
        
        $row->alias=Backend::stripUnicode( $request->name);
        $row->parent_id= $request->parent_id;
            # Save the data
            $data_index = 'cates';
            require('Data/Edit/Save.php');

            # Return the admin to the blogs page with a success message
            return redirect()->route('backend::cates')->with('success', "The cates has been edited");
        
    }

    	
    

    public function destroy($id) {

    	Backend::permissionToAccess('backend.cate.access');
    	# Check permissions
        Backend::permissionToAccess('backend.cate.delete');

        $row = Backend::cate('id', $id);
        $cates = Cate::where('parent_id', $row->id)->get();
        foreach($cates as $cate) {
            $cate->delete();
        }

       
        $row->delete();
   

        return redirect()->route('backend::cates')->with('success', "The cate has been deleted");
    	
    }

}
