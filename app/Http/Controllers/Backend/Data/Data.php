
<?php


/*
+---------------------------------------------------------------------------+
| Backend Data Configuration												|
+---------------------------------------------------------------------------+
|                                                               			|
| * Available settings:                  									|
|																			|
| table: The table name 												    +-------------+
| hidden: Columns that will not be displayed in the edit form, and they won't be updated +----------------------------+
| empty: Columns that will not have their current value when editing them (eg: password field is hidden in the model) |
| confirmed: fields that will need to be confirmed twice                                                              +-+
| encrypted: Fields that will be encrypted using: Crypt::encrypt(); when they are saved and decrypted when editing them +---------------------------+
| hashed: Fields that will be hashed when they are saved in the database, will be empty on editing, and if saved as empty they will not be modified |
| masked: Fields that will be displayed as a type='password', so their content when beeing modified won't be visible +------------------------------+
| default_random: Fields that if no data is set, they will be randomly generated (10 characters) +-------------------+
| su_hidden: Columns that will be added to the hidden array if the user is su +------------------+
| code: Fields that can be edited using a code editor                       +-+
| wysiwyg: Fields that can be edited using a wysiwyg editor                 |
| validator: validator settings when executing: $this->validate();          |
| relations: a relationship between a column and a table, or a dropdown     |
|																			|
| Note: Do not change the first index               						|
|																			|
+---------------------------------------------------------------------------+
|																			|
| This file allows you to setup all the information                         |
| to be able to manage your app without problems            				|
|																			|
+---------------------------------------------------------------------------+
*/

if(!isset($row)){
    # the row will be the user logged in if no row is set
    $row = Auth::user();
}

$data = [


    'users' =>  [

        'table'     =>  'users',
        'create'    =>  [
            'hidden'            =>  ['id', 'su', 'active', 'banned', 'register_ip', 'activation_key', 'locale', 'remember_token', 'created_at', 'updated_at'],
            'default_random'    =>  ['password'],
            'confirmed'         =>  ['password'],
            'encrypted'         =>  [],
            'hashed'            =>  ['password'],
            'masked'            =>  ['password'],
            'code'              =>  [],
            'wysiwyg'           =>  [],
            'validator'         =>  [
                'name'              => 'required|max:255',
                'email'             => '  required|email|unique:users',
                'password'          => 'confirmed|min:6',
                 'country_code'      => 'required',
                
            ],
        ],
        'edit'      =>  [
            'hidden'            =>  ['id', 'su', 'email', 'register_ip', 'activation_key', 'locale', 'remember_token', 'created_at', 'updated_at'],
            'su_hidden'         =>  ['name', 'active', 'banned', 'password', 'country_code'],
            'empty'             =>  ['password'],
            'default_random'    =>  [],
            'confirmed'         =>  ['password'],
            'encrypted'         =>  [],
            'hashed'            =>  ['password'],
            'masked'            =>  ['password'],
            'code'              =>  [],
            'wysiwyg'           =>  [],
            'validator'         =>  [
                'name'              => 'sometimes|required|max:255',
                'password'          => 'sometimes|confirmed|min:6',
                'country_code'      => 'sometimes|required',
               
            ],
        ],
    ],

    'profile' =>  [

        'table'     =>  'users',
        'edit'      =>  [
            'hidden'            =>  ['id', 'su', 'email', 'register_ip', 'active', 'banned', 'activation_key', 'locale', 'remember_token', 'created_at', 'updated_at'],
            'empty'             =>  ['password'],
            'default_random'    =>  [],
            'confirmed'         =>  ['password'],
            'encrypted'         =>  [],
            'hashed'            =>  ['password'],
            'masked'            =>  ['password'],
            'code'              =>  [],
            'wysiwyg'           =>  [],
            'validator'         =>  [
                'name'              => 'sometimes|required|max:255',
                'password'          => 'sometimes|confirmed|min:6',
                 'country_code'      => 'sometimes|required',
             
            ],
        ],
    ],


    'users_settings' => [

        'table' =>  'users_settings',
        'edit'      =>  [
            'hidden'            =>  ['id', 'created_at', 'updated_at'],
            'empty'             =>  [],
            'default_random'    =>  [],
            'confirmed'         =>  [],
            'encrypted'         =>  [],
            'hashed'            =>  [],
            'masked'            =>  [],
            'code'              =>  [],
            'wysiwyg'           =>  [],
            'relations'         =>  [
                    'default_role'  =>  [
                        'data'  =>  Backend::roles(),
                        'value' =>  'id',
                        'show'  =>  'name',
                    ],
                    'default_active'    =>  [
                        'data'  =>  Backend::dropdown('users_default_active'),
                        'value' =>  'value',
                        'show'  =>  'show',
                    ],
            ],
            'validator'         =>  [
                'default_role'      => 'sometimes|required',
                'location'          => 'sometimes|required',
                'register_enabled'  => 'sometimes|required',
                'default_active'    => 'sometimes|required',
                'welcome_email'     => 'sometimes|required',
            ],
        ],

    ],


    'roles' =>  [

        'table'     =>  'roles',
        'create'    =>  [
            'hidden'            =>  ['id', 'su','color', 'created_at', 'updated_at'],
            'default_random'    =>  [],
            'confirmed'         =>  [],
            'encrypted'         =>  [],
            'hashed'            =>  [],
            'masked'            =>  [],
            'code'              =>  [],
            'wysiwyg'           =>  [],
            'relations'         =>  [
                'color'      =>  [
                    'data'  =>  Backend::dropdown('colors_name'),
                    'value' =>  'value',
                    'show'  =>  'show',
                ],
            ],
            'validator'         =>  [
                'name'  => 'required|unique:roles',
                
            ],
        ],
        'edit'      =>  [
            'hidden'            =>  ['id', 'su','color', 'created_at', 'updated_at'],
            'su_hidden'         =>  ['name'],
            'empty'             =>  [],
            'default_random'    =>  [],
            'confirmed'         =>  [],
            'encrypted'         =>  [],
            'hashed'            =>  [],
            'masked'            =>  [],
            'code'              =>  [],
            'wysiwyg'           =>  [],
            'relations'         =>  [
                'color'      =>  [
                    'data'  =>  Backend::dropdown('colors_name'),
                    'value' =>  'value',
                    'show'  =>  'show',
                ],
            ],
            'validator'         =>  [
                'name' => 'sometimes|required|unique:roles,name,'.$row->id,
              
            ],
        ],
    ],


    'permissions'   => [
        'table'     =>  'permissions',
        'create'    =>  [
            'hidden'            =>  ['id', 'su', 'created_at', 'updated_at'],
            'default_random'    =>  [],
            'confirmed'         =>  [],
            'encrypted'         =>  [],
            'hashed'            =>  [],
            'masked'            =>  [],
            'code'              =>  [],
            'wysiwyg'           =>  [],
            'validator'         =>  [
                'slug'  => 'required|max:255|unique:permissions',
            ],
        ],
        'edit'      =>  [
            'hidden'            =>  ['id', 'su', 'created_at', 'updated_at'],
            'su_hidden'         =>  ['slug'],
            'empty'             =>  [],
            'default_random'    =>  [],
            'confirmed'         =>  [],
            'encrypted'         =>  [],
            'hashed'            =>  [],
            'masked'            =>  [],
            'code'              =>  [],
            'wysiwyg'           =>  [],
            'validator'         =>  [
                'slug'  => 'sometimes|required|max:255|unique:permissions,slug,'.$row->id,
            ],
        ],
    ],


   
   
    'documents'  =>  [

        'table'     =>  'documents',
        'create'    =>  [
            'hidden'            =>  ['id', 'slug', 'downloads', 'name', 'user_id', 'created_at', 'updated_at'],
            'default_random'    =>  [],
            'confirmed'         =>  [],
            'encrypted'         =>  ['password'],
            'hashed'            =>  [],
            'masked'            =>  [],
            'code'              =>  [],
            'wysiwyg'           =>  [],
            'validator'         =>  [],
        ],
        'edit'      =>  [
            'hidden'            =>  ['id', 'slug', 'downloads', 'name', 'user_id', 'created_at', 'updated_at'],
            'default_random'    =>  [],
            'default_random'    =>  [],
            'confirmed'         =>  [],
            'encrypted'         =>  ['password'],
            'hashed'            =>  [],
            'masked'            =>  [],
            'code'              =>  [],
            'wysiwyg'           =>  [],
            'validator'         =>  [],
        ],
    ],

    'cates'  =>  [

        'table'     =>  'cates',
        'create'    =>  [
            'hidden'            =>  ['id','parent_id', 'alias', 'created_at', 'updated_at'],
            
            'default_random'    =>  [],
            'confirmed'         =>  [],
            'encrypted'         =>  [],
            'hashed'            =>  [],
            'masked'            =>  [],
            'code'              =>  [],
            'wysiwyg'           =>  [],
            'relations'         =>  ['parent_id'],
        
            'validator'         =>  [
                'name' => 'required|max:255||unique:cates,name',

                
            ],
        ],
        'edit'      =>  [
            'hidden'            =>   ['id', 'parent_id','alias','created_at', 'updated_at'],
            'empty'             =>  [],
            'default_random'    =>  [],
            'confirmed'         =>  [],
            'encrypted'         =>  [],
            'hashed'            =>  [],
            'masked'            =>  [],
            'code'              =>  [],
            'wysiwyg'           =>  [],
            'validator'         =>  [
                'name' => 'sometimes|required|max:255',
                
            ],
        ],
    ],

#product
'products'  =>  [

        'table'     =>  'products',
        'create'    =>  [
            'hidden'            =>  ['id', 'alias','cate_id','user_id','image', 'created_at', 'updated_at'],
            
            'default_random'    =>  [],
            'confirmed'         =>  [],
            'encrypted'         =>  [],
            'hashed'            =>  [],
            'masked'            =>  [],
            'code'              =>  [],
            'wysiwyg'           =>  [],
            'relations'         =>  ['parent_id'],
        
            'validator'         =>  [
                'name' => 'sometimes|required|max:255',
                
                
                
            ],
        ],
        'edit'      =>  [
            'hidden'            =>   ['id', 'alias','user_id', 'cate_id','image','created_at', 'updated_at'],
            'empty'             =>  [],
            'default_random'    =>  [],
            'confirmed'         =>  [],
            'encrypted'         =>  [],
            'hashed'            =>  [],
            'masked'            =>  [],
            'code'              =>  [],
            'wysiwyg'           =>  [],
            'validator'         =>  [
                'name' => 'sometimes|required|max:255',
                
                
            ],
        ],
    ],

 


];
