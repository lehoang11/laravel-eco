<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Backend;

class DashboardController extends Controller
{
    public function index()
    {     Backend::permissionToAccess('backend.access');
    	return view('backend/dashboard/index');
    }

    public function setting()
    {

         Backend::permissionToAccess('backend.access');

    	return view('backend/dashboard/setting');
    }
    public function media()
    {

         Backend::permissionToAccess('backend.access');
    	return view('backend/dashboard/media');
    }

    public function ecommerce()
    {
         Backend::permissionToAccess('backend.access');
         
        return view('backend/dashboard/ecommerce');
    }
   
}
