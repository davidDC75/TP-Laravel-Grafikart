<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$idRegex = '[0-9]+';
$slugRegex = '[a-z0-9\-]+';

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

Route::get('/biens', [PropertyController::class, 'index'])
    ->name('property.index');

Route::get('/biens/{slug}-{property}', [PropertyController::class, 'show'])
    ->name('property.show')
    ->where([
        'property' => $idRegex,
        'slug' => $slugRegex
]);

Route::post('/biens/{property}/contact',[PropertyController::class,'contact'])
    ->name('property.contact')
    ->where([
       'property' => $idRegex
    ]);


Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('property', \App\Http\Controllers\Admin\PropertyController::class)->except(['show']);

    Route::resource('option', \App\Http\Controllers\Admin\OptionController::class)->except(['show']);

});
