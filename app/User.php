<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backend;
use Mail;
use File;
use App\Notifications\WelcomeMessage;
use App\Notifications\AccountActivation;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active', 'activation_key', 'register_ip', 'country_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'activation_key',
    ];

    /**
    * Mutator to capitalize the name
    *
    * @param mixed $value
    */
    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }

    /**
    * Returns all the roles from the user
    *
    */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    /**
    * Returns true if the user has access to Backend
    *
    */
    public function isAdmin()
    {
        return $this->hasPermission('Backend.access');
    }

    /**
    * Returns true if the user has the permission slug
    *
    * @param string $slug
    */
    public function hasPermission($slug)
    {
        foreach($this->roles as $role) {
            foreach($role->permissions as $perm) {
                if($perm->slug == $slug) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
    * Returns true if the user has the role
    *
    * @param string $name
    */
    public function hasRole($name)
    {
        foreach($this->roles as $role) {
            if($role->name == $name) {
                return true;
            }
        }
        return false;
    }

    /**
    * Returns all the blogs owned by the user
    *
    */
 
    public function product()
    {
        return $this->hasMany('App\Product');
    }
    
    /**
    * Returns the user avatar from Gavatar
    *
    * @param number $size
    */
    public function avatar($size = null)
    {
        $file = Backend::avatarsLocation() . '/' . md5($this->email);
        $file_url = asset($file);
        if(File::exists($file)){
            return $file_url;
        } else {
            return Backend::defaultAvatar();
        }
    }

    /**
    * Returns all the documents from the user
    *
    */
    public function documents()
    {
        return $this->hasMany('App\Document');
    }

    /**
    * Returns all the social accounts from the user
    *
    */
    public function socials()
    {
        return $this->hasMany('App\Social');
    }

    /**
    * Returns true if the user has the social account
    *
    * @param string $provider
    */
    public function hasSocial($provider)
    {
        foreach($this->socials as $social){
            if($social->provider == $provider){
                return true;
            }
        }
        return false;
    }

    /**
    * Sends the welcome email notification to the user
    *
    */
    public function sendWelcomeEmail()
    {
        return $this->notify(new WelcomeMessage($this));
    }

    /**
    * Sends the activation email notification to the user
    *
    */
    public function sendActivationEmail()
    {
        return $this->notify(new AccountActivation($this));
    }
}
