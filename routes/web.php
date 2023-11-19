<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use BytePlatform\Admin\Livewire\ShortcodeSetting;
use Illuminate\Support\Facades\Route;
use BytePlatform\Admin\Livewire\Auth\ForgotPassword;
use BytePlatform\Admin\Livewire\Auth\Login;
use BytePlatform\Admin\Livewire\Auth\Signup;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::post('shortcode-setting/', ShortcodeSetting::class)->name('shortcode-setting');
});

Route::prefix(adminUrl())->middleware(\BytePlatform\Middleware\ThemeAdmin::class)->group(function () {
    Route::name('admin.')->prefix('auth')->middleware('themelayout:none')->group(function () {
        Route::get('login', route_theme(Login::class))->name('login');
        Route::get('logout', route_theme(function () {
            auth()->logout();
            return redirect(route('admin.login'));
        }))->name('logout');
        Route::get('sign-up', route_theme(Signup::class))->name('sign-up');
        Route::get('forgot-password', route_theme(ForgotPassword::class))->name('forgot-password');
    });
});

Route::get('routes', function () {
    $routeCollection = Route::getRoutes();

    echo "<table style='width:100%'>";
    echo "<tr>";
    echo "<td width='10%'><h4>HTTP Method</h4></td>";
    echo "<td width='10%'><h4>Route</h4></td>";
    echo "<td width='10%'><h4>Name</h4></td>";
    echo "<td width='70%'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $value) {
        
        echo "<tr>";
        echo "<td>" . $value->methods()[0] . "</td>";
        echo "<td>" . $value->uri() . "</td>";
        echo "<td>" . $value->getName() . "</td>";
        echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
});