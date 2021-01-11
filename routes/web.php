<?php

use App\Http\Controllers\Admin\AuthorsController;
use App\Http\Controllers\Admin\JournalsController;
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

Route::group([
    'prefix' => 'admin',
], function(){
    Route::resource('journals', JournalsController::class, [
        'names' => [
            'index' => 'admin.journals.index',
            'store' => 'admin.journals.store',
            'create' => 'admin.journals.create',
            'destroy' => 'admin.journals.destroy',
            'update' => 'admin.journals.update',
            'show' => 'admin.journals.show',
            'edit' => 'admin.journals.edit',
        ]
    ]);

    Route::resource('authors', AuthorsController::class, [
        'names' => [
            'index' => 'admin.authors.index',
            'store' => 'admin.authors.store',
            'create' => 'admin.authors.create',
            'destroy' => 'admin.authors.destroy',
            'update' => 'admin.authors.update',
            'show' => 'admin.authors.show',
            'edit' => 'admin.authors.edit',
        ]
    ]);
});

Route::get('/', function () {
    return view('welcome');
});
