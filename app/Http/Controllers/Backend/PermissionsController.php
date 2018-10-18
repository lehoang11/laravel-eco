<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission_Role;
use Backend;

class PermissionsController extends Controller
{
    public function index()
    {
        Backend::permissionToAccess('backend.permissions.access');

    	# Get all the permissions
    	$permissions = Backend::permissions();

    	# Return the view
    	return view('backend/permissions/index', ['permissions' => $permissions]);
    }

    public function create()
    {
        Backend::permissionToAccess('backend.permissions.access');

        # Check permissions
        Backend::permissionToAccess('backend.permissions.create');


        $data_index = 'permissions';
        require('Data/Create/Get.php');

    	# Return the creation view
    	return view('backend/permissions/create', [
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

    public function store(Request $request)
    {
        Backend::permissionToAccess('backend.permissions.access');

        # Check permissions
        Backend::permissionToAccess('backend.permissions.create');

		# Create the permission
		$row = Backend::newPermission();
        $data_index = 'permissions';
		require('Data/Create/Save.php');

		# return a redirect
		return redirect()->route('backend::permissions')->with('success', trans('backend.msg_permission_created'));
    }

    public function edit($id)
    {
        Backend::permissionToAccess('backend.permissions.access');

        # Check permissions
        Backend::permissionToAccess('backend.permissions.edit');

    	# Get the permission
    	$row = Backend::permission('id', $id);

        $data_index = 'permissions';
		require('Data/Edit/Get.php');


    	# Return the view
    	return view('backend/permissions/edit', [
            'row'       =>  $row,
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

    public function update($id, Request $request)
    {
        Backend::permissionToAccess('backend.permissions.access');

        # Check permissions
        Backend::permissionToAccess('backend.permissions.edit');

        # Get the permission
    	$row = Backend::permission('id', $id);

        $data_index = 'permissions';
		require('Data/Edit/Save.php');

		# return a redirect
		return redirect()->route('backend::permissions')->with('success', trans('backend.msg_permission_updated'));
    }

    public function destroy($id)
    {
        Backend::permissionToAccess('backend.permissions.access');
        
        # Check permissions
        Backend::permissionToAccess('backend.permissions.delete');

    	# Get the permission
    	$perm = Backend::permission('id', $id);

        # Check if it's su
        if($perm->su) {
            abort(403, trans('backend.error_security_reasons'));
        }

    	# Delete relationships
    	$rels = Permission_Role::where('permission_id', $perm->id)->get();
    	foreach($rels as $rel) {
    		$rel->delete();
    	}

    	# Delete Permission
    	$perm->delete();

    	# Return a redirect
    	return redirect()->route('backend::permissions')->with('success', trans('backend.msg_permission_deleted'));
    }

}
