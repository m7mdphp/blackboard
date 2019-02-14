<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    public function up()
    {
        // create roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        // add admin role
        $admin_role = app(config('laraback.models.role'))->create(['name' => 'Admin']);

        // create role user relation table
        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // attach admin user role
        app(config('auth.providers.users.model'))->where('email', 'admin@example.com')->first()->roles()->attach($admin_role->id);

        // create permissions table
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group');
            $table->string('name');
            $table->timestamps();
        });

        // create permission role relation table
        Schema::create('permission_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        // add user & role permissions
        app(config('laraback.models.permission'))->createGroup('Users', ['Browse Users', 'Read Users', 'Edit Users', 'Add Users', 'Delete Users']);
        app(config('laraback.models.permission'))->createGroup('Roles', ['Browse Roles', 'Read Roles', 'Edit Roles', 'Add Roles', 'Delete Roles']);
    }

    public function down()
    {
        // drop permissions tables
        Schema::dropIfExists('roles');
        Schema::dropIfExists('user_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_permission');
    }
}