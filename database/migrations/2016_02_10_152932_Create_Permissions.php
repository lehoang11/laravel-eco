<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->boolean('assignable');
            $table->boolean('su');
            $table->timestamps();
        });

        $permissions = [
            'backend.access',
            'backend.users.access',
            'backend.users.create',
            'backend.users.edit',
            'backend.users.roles',
            'backend.users.delete',
            'backend.users.settings',
            'backend.roles.access',
            'backend.roles.create',
            'backend.roles.edit',
            'backend.roles.permissions',
            'backend.roles.delete',
            'backend.permissions.access',
            'backend.permissions.create',
            'backend.permissions.edit',
            'backend.permissions.delete',
            'backend.files.access',
            'backend.files.upload',
            'backend.files.download',
            'backend.files.delete',
            'backend.documents.create',
            'backend.documents.edit',
            'backend.documents.delete',
            'backend.CRUD.access',
            'backend.setting.access',
            'backend.media.access',
            'backend.cate.access',
            'backend.cate.create',
            'backend.cate.edit',
            'backend.cate.delete',
            'backend.product.access',
            'backend.product.create',
            'backend.product.edit',
            'backend.product.delete',
            'backend.ecommerce.access',
        ];

        foreach($permissions as $permission) {
            $perm = \Backend::newPermission();
            $perm->slug = $permission;
            $perm->assignable = true;
            $perm->su = true;
            $perm->save();
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permissions');
    }
}
