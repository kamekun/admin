<?php

use Sokeio\Admin\Crud\PermissionCrud;
use Sokeio\Admin\Crud\RoleCrud;
use Sokeio\Admin\Crud\UserCrud;
use Illuminate\Support\Facades\Route;


Route::group(['as' => 'admin.'], function () {
    UserCrud::RoutePage('user');
    RoleCrud::RoutePage('role');
    PermissionCrud::RoutePage('permission');
});
