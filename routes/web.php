<?php

use App\Http\Controllers\EntryController;
use App\Http\Controllers\PasswordUpdateController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UploadController;
use App\Models\Client;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


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
Route::get('/', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sessions', [SessionsController::class, 'store'])->middleware('guest')->name('sessions');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('entries', [EntryController::class, 'index'])->middleware('auth')->name('entries');

Route::get('{entryId}/edit', [UploadController::class, 'edit'])->middleware('auth')->name('upload.edit');
Route::post('{entryId}/edit', [UploadController::class, 'postEdit'])->middleware('auth')->name('upload.post.edit');

Route::get('register', [RegisterController::class, 'create'])->middleware('guest')->name('register.create');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest')->name('register.store');

Route::get('upload', [UploadController::class, 'create'])->middleware('auth')->name('upload.create');
Route::post('upload', [UploadController::class, 'store'])->middleware('auth')->name('upload.store');
Route::delete('{entryId}/delete', [UploadController::class, 'destroy'])->middleware('auth')->name('upload.delete');

Route::get('forgot-password', [PasswordResetController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('forgot-password', [PasswordResetController::class, 'store'])->middleware('guest')->name('password.email');

Route::get('reset-password/{token}', [PasswordUpdateController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('reset-password', [PasswordUpdateController::class, 'store'])->middleware('guest')->name('password.update');

Route::get('getProduct/{id}', function ($id) {
    $product = App\Models\Product::where('client_id', $id)->get();
    return response()->json($product);
});

Route::get('clients/{client:name}', function (Client $client) {
    return view('entries', [
        'clients' => Client::all(),
        'currentClient' => $client,
        'entries' => $client->entries,
        'sortOrder' => 'desc',
    ]);
})->middleware('auth')->name('clients');

Route::get('{client:name}/{product:name}', function (string $client, Product $product) {
    return view('entries', [
        'clients' => Client::all(),
        'products' => Product::all(),
        'entries' => $product->entries,
        'sortOrder' => 'desc',
    ]);
})->middleware('auth')->name('products');

Route::get('{user:id}', function (User $user) {
    return view('entries', [
        'clients' => Client::all(),
        'products' => Product::all(),
        'users' => User::all(),
        'entries' => $user->entries,
        'sortOrder' => 'desc',
    ]);
})->middleware('auth')->name('users');

//Route::get('cache', function () {
//    Artisan::call('cache:clear');
//});
