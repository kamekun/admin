<?php

use BytePlatform\Admin\Crud\PermissionCrud;
use BytePlatform\Admin\Crud\RoleCrud;
use BytePlatform\Admin\Crud\UserCrud;
use Illuminate\Support\Facades\Route;


Route::group(['as' => 'admin.'], function () {
    UserCrud::RoutePage('user');
    RoleCrud::RoutePage('role');
    PermissionCrud::RoutePage('permission');
});
