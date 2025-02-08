<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PricelistController;
use App\Http\Controllers\RolepermissionController;
use App\Http\Controllers\ServiceItemController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WorkorderController;
use App\Http\Controllers\ServiceController;
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
Auth::routes();

// In web.php routes file

// Tambahkan di bawah route yang sudah ada
Route::get('/service-ac-jakarta', [ServiceController::class, 'jakarta'])->name('service.jakarta');
Route::get('/service-ac-tangerang', [ServiceController::class, 'tangerang'])->name('service.tangerang');
Route::get('/service-ac-jakarta/{area}', [ServiceController::class, 'jakartaArea'])->name('service.jakarta.area');

Route::get('/', [UserController::class, 'index']);
Route::get('/jasa-service-ac-tangerang', [UserController::class, 'tangerang']);
Route::get('/services', [ServiceItemController::class, 'index'])->name('services.index');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
    Route::get('/blog/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/blog/show/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/blog/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/blog/store', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/blog/delete', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/pricelist', [PricelistController::class, 'index'])->name('pricelist.index');
    Route::get('/pricelist/create', [PricelistController::class, 'create'])->name('pricelist.create');
    Route::get('/pricelist/show', [PricelistController::class, 'show'])->name('pricelist.show');
    Route::get('/pricelist/edit/{id}', [PricelistController::class, 'edit'])->name('pricelist.edit');
    Route::post('/pricelist/store', [PricelistController::class, 'store'])->name('pricelist.store');
    Route::delete('/pricelist/delete/{id}', [PricelistController::class, 'destroy'])->name('pricelist.destroy');

    //wo
    Route::get('/workorder', [WorkorderController::class, 'index'])->name('workorder.index');
    Route::get('/workorder/create', [WorkorderController::class, 'create'])->name('workorder.create');
    Route::get('/workorder/show', [WorkorderController::class, 'show'])->name('workorder.show');
    Route::get('/workorder/edit/{id}', [WorkorderController::class, 'edit'])->name('workorder.edit');
    Route::post('/workorder/store', [WorkorderController::class, 'store'])->name('workorder.store');
    Route::delete('/workorder/delete/{id}', [WorkorderController::class, 'destroy'])->name('workorder.destroy');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

	Route::get('/count/notif', [ServiceItemController::class, 'index'])->name('count.notif');


    Route::get('/users', [UserController::class, 'users'])->name('users.index');

    //setting role
		Route::get('/rolepreset', [RolepermissionController::class, 'indexrole'])->name('rolepreset.index');
		Route::get('/permissionpreset', [RolepermissionController::class, 'indexpermission'])->name('permission.index');
		Route::get('/rolepreset/edit/{role}', [RolepermissionController::class, 'edit']);
		Route::post('/rolepreset/add', [RolepermissionController::class, 'storeRole'])->name('rolepreset.store');
		Route::post('/permissionpreset/add', [RolepermissionController::class, 'storePermission'])->name('permission.store');
		Route::get('/permission/edit/{permission}', [RolepermissionController::class, 'permissionedit']);
		Route::delete('/rolepreset/delete/{role}', [RolepermissionController::class, 'destroy']);
		Route::delete('/permission/delete/{role}', [RolepermissionController::class, 'permissiondestroy']);

});


