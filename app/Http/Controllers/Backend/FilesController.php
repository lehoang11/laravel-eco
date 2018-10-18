<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Backend;
use Storage;
use File;

class FilesController extends Controller
{

    public function fileDownload($file_name)
    {
        Backend::permissionToAccess('backend.files.access');

        Backend::permissionToAccess('backend.files.download');

        return Backend::downloadFile($file_name);
    }

    public function files()
    {
        Backend::permissionToAccess('backend.files.access');

        $files = Backend::files();

        return view('backend/files/index', ['files' => $files]);
    }

    public function showUpload()
    {
        Backend::permissionToAccess('backend.files.access');

        # Check permissions
        Backend::permissionToAccess('backend.files.upload');

        return view('backend/files/upload');
    }

    public function upload(Request $request)
    {
        Backend::permissionToAccess('backend.files.access');

        # Check permissions
        Backend::permissionToAccess('backend.files.upload');

        $files = $request->file('files');

        # Check the file size for each file before uploading any of them
        foreach($files as $file) {
            $file_name = $file->getClientOriginalName();
            $max_upload = $file->getMaxFilesize() / 1000000;
            $max_upload = (string)$max_upload;
            if($file->getClientSize() == 0 or $file->getClientSize() > $file->getMaxFilesize()) {
                return redirect()->route('backend::files_upload')->with('error', trans('backend.msg_max_file_size', ['file' => $file_name, 'number' => substr($max_upload, 0, 4)]));
            }
        }

        foreach($files as $file) {
            $file_name = $file->getClientOriginalName();

            Storage::put($file_name, File::get($file));
        }

        return redirect()->route('backend::files')->with('success', trans('backend.msg_files_uploaded'));

    }

    public function delete($file)
    {
        Backend::permissionToAccess('backend.files.access');
        
        # Check permissions
        Backend::permissionToAccess('backend.files.delete');

        # Check if it's a file
        Backend::mustBeFile($file);

        # Check if it's a document
        if(Backend::isDocument($file)){
            # Delete the document
            Backend::document('name', $file)->delete();
        }

        # Delete the file
        Backend::deleteFile($file);

        return redirect()->route('backend::files')->with('success', trans('backend.msg_file_deleted'));
    }
}
