<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Backend;
use Auth;

class DocumentsController extends Controller
{
    public function showCreate($file)
    {
        Backend::permissionToAccess('backend.files.access');

        # Check permissions
        Backend::permissionToAccess('backend.documents.create');

        Backend::mustBeFile($file);

        if(Backend::isDocument($file)) {
            abort(404);
        }

        # Get all the data
        $data_index = 'documents';
        require('Data/Create/Get.php');

        # Return the view
        return view('backend/documents/create', [
            'file'      =>  $file,
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

    public function createDocument($file, Request $request)
    {
        Backend::permissionToAccess('backend.files.access');

        # Check permissions
        Backend::permissionToAccess('backend.documents.create');

        Backend::mustBeFile($file, '/admin/files');

        # create the document
        $row = Backend::newDocument();

        # Save all the data
        $data_index = 'documents';
        require('Data/Create/Save.php');

        $row->user_id = Backend::loggedInUser()->id;
        $row->name = $file;
        while(true) {
            $slug = rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
            if(!Backend::document('slug', $slug)) {
                $row->slug = $slug;
                break;
            }
        }
        $row->save();

        return redirect()->route('backend::files')->with('success', trans('backend.msg_document_created'));
    }

    public function edit($slug)
    {
        Backend::permissionToAccess('backend.files.access');

        # Check permissions
        Backend::permissionToAccess('backend.documents.edit');

        # Check if it's the owner or su
        if(!Backend::checkDocumentOwner('slug', $slug) and !Backend::loggedInUser()->su) {
            abort(403, trans('backend.error_not_allowed'));
        }

        $file = Backend::document('slug', $slug);
        if($file) {
            $row = $file;
            $data_index = 'documents';
            require('Data/Edit/Get.php');

            return view('backend/documents/edit', [
                'file'      =>  $file,
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

        } else {
            abort(404);
        }
    }

    public function update($slug, Request $request)
    {
        Backend::permissionToAccess('backend.files.access');

        # Check permissions
        Backend::permissionToAccess('backend.documents.edit');

        # Check if it's the owner or su
        if(!Backend::checkDocumentOwner('slug', $slug) and !Auth::user()->su) {
            abort(403, trans('backend.error_not_allowed'));
        }

        $file = Backend::document('slug', $slug);

        if($file) {

            $row = $file;
            $data_index = 'documents';
            require('Data/Edit/Save.php');

            return redirect()->route('backend::files')->with('success', trans('backend.msg_document_created'));

        } else {
            abort(404);
        }
    }

    public function delete($slug)
    {
        Backend::permissionToAccess('backend.files.access');
        
        # Check permissions
        Backend::permissionToAccess('backend.documents.delete');

        # Check if it's the owner or su
        if(!Backend::checkDocumentOwner('slug', $slug) and !Auth::user()->su) {
            abort(403, trans('backend.error_not_allowed'));
        }

        # Delete the document
        Backend::document('slug', $slug)->delete();

        return redirect()->route('backend::files')->with('success', trans('backend.msg_document_deleted'));
    }
}
