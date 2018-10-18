<?php

namespace App\Http\Controllers\Backend;

use Request;
use Auth;
use Storage;
use Schema;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Users_Settings;
use App\Role;
use App\Permission;
use App\Document;
use App\Cate;
use App\Product;
use App\Product_details;
use App\Order;
use App\Transactionshop;
use App\Social;
use Location;
use URL;




/**
 * The Backend class
 *
 * The main Backend class contains diferent elements to help you develop faster
 *
 */

class Backend extends Controller
{
    public static function websiteTitle(){

        return 'websiteTitle';
    }

    public static function users($type = null, $data = null)
    {
        if($type and $data) {
            return User::where($type, $data)->get();
        }
        return User::all();
    }

    public static function roles($type = null, $data = null)
    {
        if($type and $data) {
            return Role::where($type, $data)->get();
        }
        return Role::all();
    }

    public static function permissions($type = null, $data = null)
    {
        if($type and $data) {
            return Permission::where($type, $data)->get();
        }
        return Permission::all();
    }



    public static function documents($type = null, $data = null)
    {
        if($type and $data) {
            return Document::where($type, $data)->get();
        }
        return Document::all();
    }

    public static function socials($type = null, $data = null)
    {
        if($type and $data) {
            return Social::where($type, $data)->get();
        }
        return Social::all();
    }
    public static function cates($type = null, $data = null)
    {
        if($type and $data) {
            return Cate::where($type, $data)->get();
        }
        return Cate::all();
    }
    public static function products($type = null, $data = null)
    {
        if($type and $data) {
            return Product::where($type, $data)->get();
        }
        return Product::all();
    }

    public static function transactionshops($type = null, $data = null)
    {
        if($type and $data) {
            return Transactionshop::where($type, $data)->get();
        }
        return Transactionshop::all();
    }

    public static function user($type, $data)
    {
        if($type == 'id') {
            return User::findOrFail($data);
        }
        return User::where($type, $data)->first();
    }

    public static function role($type, $data)
    {
        if($type == 'id') {
            return Role::findOrFail($data);
        }
        return Role::where($type, $data)->first();
    }

    public static function permission($type, $data)
    {
        if($type == 'id') {
            return Permission::findOrFail($data);
        }
        return Permission::where($type, $data)->first();
    }




    public static function document($type, $data)
    {
        if($type == 'id') {
            return Document::findOrFail($data);
        }
        return Document::where($type, $data)->first();
    }

    public static function social($type, $data)
    {
        if($type == 'id') {
            return Social::findOrFail($data);
        }
        return Social::where($type, $data)->first();
    }

    public static function cate($type, $data)
    {
        if($type == 'id') {
            return Cate::findOrFail($data);
        }
        return Cate::where($type, $data)->first();
    }

    public static function product($type, $data)
    {
        if($type == 'id') {
            return Product::findOrFail($data);
        }
        return Product::where($type, $data)->first();
    }

    public static function transactionshop($type, $data)
    {
        if($type == 'id') {
            return Transactionshop::findOrFail($data);
        }
        return Transactionshop::where($type, $data)->first();
    }

    public static function newUser()
    {
        return new User;
    }

    public static function newRole()
    {
        return new Role;
    }

    public static function newPermission()
    {
        return new Permission;
    }



    public static function newDocument()
    {
        return new Document;
    }

    public static function newSocial()
    {
        return new Social;
    }



    public static function userSettings()
    {
        return Users_Settings::first();
    }

     public static function newCate()
    {
        return new Cate;
    }

    public static function newProduct()
    {
        return new Product;
    }

    public static function defaultRole()
    {
        return Backend::role('id', Backend::userSettings()->default_role);
    }

    public static function getIP()
    {
        # Get Real IP
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip=$_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    public static function permissionToAccess($slug)
    {
        if(!Backend::loggedInUser()->hasPermission($slug)) {
            abort(401, "You don't have permissions to access this area");
        }
    }

    public static function scanFiles($directory){
        return scandir($directory);
    }

    public static function files() 
    {
        $files = Storage::files();
        $ignore = ['.gitignore'];
        $final_files = [];
        foreach($files as $file) {
            $add = true;
            foreach($ignore as $ign){
                if($ign == $file) {
                    $add = false;
                }
            }
            if($add) {
                array_push($final_files, $file);
            }
        }
        $files = $final_files;

        return $files;
    }

    public static function isDocument($file_name)
    {
        if(Backend::document('name', $file_name)) {
            return true;
        } else {
            return false;
        }
    }

    public static function addDownload($file_name)
    {
        if(Backend::isDocument($file_name)) {
            $file = Document::where('name', $file_name)->first();
            $file->downloads = $file->downloads + 1;
            $file->save();
        }
    }

    public static function downloadLink($file_name)
    {
        $link = url('/');
        if(Backend::isDocument($file_name)) {
            $document = Document::where('name', $file_name)->first();
            $link = route('backend::document_downloader', ['slug' => $document->slug]);
        }
        return $link;
    }

    public static function downloadFile($file_name)
    {
        # Add a new download to the file if it's a document
        if(Backend::isDocument($file_name)) {
            Backend::addDownload($file_name);
        }
        return response()->download(storage_path('app/' . $file_name));
    }

    public static function isFile($file_name)
    {
        $files = Backend::files();
        if(in_array($file_name, $files)) {
            return true;
        } else {
            return false;
        }
    }

    public static function mustBeFile($file_name)
    {
        if(!Backend::isFile($file_name)) {
            abort(404);
        }
    }

    public static function fileExtension($file_name)
    {
        return pathinfo($file_name, PATHINFO_EXTENSION);
    }

    public static function imageFormats()
    {
        return ['png', 'jpg', 'jpeg', 'gif', 'bmp'];
    }

    public static function checkInstalled()
    {
        if(env('Backend_INSTALLED', false)){
            return true;
        }
        return false;
    }

    public static function checkDocumentOwner($type, $data){
        if(Auth::user()->id == Backend::document($type, $data)->author->id) {
            return true;
        } else {
            return false;
        }
    }

    public static function deleteFile($file_name)
    {
        Backend::mustBeFile($file_name);

        Storage::delete($file_name);
    }

    public static function loggedInUser() {
        return Auth::user();
    }

    public static function noFlags()
    {
        return ['FF', 'BL', 'BQ', 'JE', 'GG', 'MF', 'XK', 'CW', 'SX', 'SS', 'AQ'];
    }

    public static function countryCodeField()
    {
        return 'country_code';
    }

    public static function allowEditingField()
    {
        return 'allow_editing';
    }

    public static function dropdown($slug, $array = null)
    {
        require('Data/Dropdowns.php');
        if($array) {
            return $dropdowns[$slug];
        } else {
            $dropdowns_object = [];
            foreach($dropdowns[$slug] as $drop) {
                array_push($dropdowns_object, Backend::rettype($drop, 'object'));
            }
            return $dropdowns_object;
        }
    }

    public static function checkValueInRelation($data, $value, $value_index)
    {
        foreach($data as $dta) {
            if($dta->$value_index == $value) {
                return true;
            }
        }
        return false;
    }

    public static function rettype($mixed, $type = NULL) {
        $type === NULL || settype($mixed, $type);
        return $mixed;
    }

    public static function getCountryCode($ip)
    {
        return Location::get($ip)->countryCode;
    }

    public static function mustBeAdmin($user)
    {
        if(!Backend::isAdmin($user)) {
            abort(403, trans('backend.error_must_be_admin'));
        }
    }

    public static function mustNotBeAdmin($user)
    {
        if(Backend::isAdmin($user) and !Backend::loggedInUser()->su) {
            abort(403, trans('backend.error_no_rights_against_admin'));
        }
    }

    public static function isAdmin($user)
    {
        return $user->isAdmin();
    }

    public static function permissionName($slug)
    {
        $perm_file = 'permissions';
        $trans = trans($perm_file.'.'.$slug);
        if($perm_file.'.'.$slug == $trans) {
            return $slug;
        } else {
            return $trans;
        }
    }

    public static function permissionDescription($slug)
    {
        $perm_file = 'permissions';
        $trans = trans($perm_file.'.'.$slug.'_desc');
        $slug = $slug . '_desc';
        if($perm_file.'.'.$slug == $trans) {
            return "No description";
        } else {
            return $trans;
        }
    }

    /**
     * Formats a string date into a fancy, human readable date
     *
     * Returns a date formatted for human readable
     *
     * @param string $date_string The date in string format
     *
     * @return date
     */

    public static function fancyDate($date_string)
    {
        return date('F j, Y, g:i A',strtotime($date_string));
    }

    /**
     * Returns the default avatar URL
     *
     * When using this function it will return the default avatar URL
     *
     *
     * @return url
     */




    public static function currentURL()
    {
        return Request::url();
    }

    public static function previousURL()
    {
        return URL::previous();
    }



    public static function publicPath()
    {
        return 'public/backend';
    }

    public static function countries()
    {
        $json = file_get_contents(Backend::publicPath() . '/assets/countries/names.json');
        return json_decode($json, true);
    }

    public static function widget($name)
    {
        require('Data/Widgets.php');
        if($widgets and array_key_exists($name, $widgets)){
            return $widgets[$name];
        } else {
            return "<span style='color:red;'>ERROR: </span> Unknown widget";
        }
    }


    public static function locales()
    {
        require('Data/Locales.php');
        if($locales){
            return $locales;
        }
    }

    public static function dataPath()
    {
        return app_path() . '/Http/Controllers/Backend/Data';
    }

    public static function apiData()
    {
        require('Data/API.php');
        if($api){
            return $api;
        }
    }

    public static function avatarsLocation()
    {
        return 'avatars';
    }

    public static function stripUnicode($str) 
    { 
        if(!$str) return false; 
         
        $str = str_replace(', ', ',', $str); 
        $str = str_replace('-', '', $str); 
        $str = trim($str); 

        $unicode = array( 
        'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ', 
                'Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ'), 
        'd'=>array('đ', 'Đ'), 
        'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ', 
                'É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','Ể','Ễ','Ệ'), 
        'i'=>array('í','ì','ỉ','ĩ','ị', 'Í','Ì','Ỉ','Ĩ','Ị'), 
        'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ', 
                'Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','Ợ'), 
        'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự', 
                'Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ','Ử','Ữ','Ự'), 
        'y'=>array('ý','ỳ','ỷ','ỹ','ỵ','Ý','Ỳ','Ỷ','Ỹ','Ỵ'), 
        ''=>array('`', '~', '!', '#', '$', '%', '^', '&', '(',')', '=', '[', ']', '*', 
                '{', '}', ';', ':', '\'', '"', '<', '>', '|'), 
        '-'=>array('\\', ','), 
        '+'=>array('/') 
        ); 
        foreach($unicode as $nonUnicode=>$uni) 
        { 
        foreach($uni as $value) 
        $str = str_replace($value,$nonUnicode,$str); 
        } 
        $str = str_replace(' ', '-', $str); 
        $str = str_replace('--', '-', $str); 
        $str = strtolower($str); 

        return $str; 
    } 

    public static  function MenuMulti($data,$parent_id = 0,$str="---|",$select=0){

     foreach ($data as  $val) {
        $id =$val["id"];
        $name = $val["name"];
        if($val["parent_id"] ==$parent_id){
            if ($select != 0 && $id == $select) {
          echo '<option value ="'.$id.'" selected>'.$str."". $name.'</option>';
            }else{
                echo '<option value ="'.$id.'">'.$str."".$name.'</option>';
            }
           // MenuMulti($data,$id,$str."---|",$select);
        }
     }

    }





}
