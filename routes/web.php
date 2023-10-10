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

// Home
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

// Liste des biens
Route::get('/biens', [PropertyController::class, 'index'])
    ->name('property.index');

// Affichage d'un bien
Route::get('/biens/{slug}-{property}', [PropertyController::class, 'show'])
    ->name('property.show')
    ->where([
        'property' => $idRegex,
        'slug' => $slugRegex
]);

// Formulaire de contact
Route::post('/biens/{property}/contact',[PropertyController::class,'contact'])
    ->name('property.contact')
    ->where([
       'property' => $idRegex
    ]);


// Formulaire d'authentification
Route::get('/login',[\App\Http\Controllers\AuthController::class,'login'])
    ->middleware('guest')
    ->name('login');

// Post du formulaire et login
Route::post('/login',[\App\Http\Controllers\AuthController::class,'doLogin'])
    ->middleware('guest');

// Se déconnecter
Route::delete('/logout',[\App\Http\Controllers\AuthController::class,'logout'])
    ->middleware('auth')
    ->name('logout');

// Ce groupe de route concerne tout ce qui touche à la partie administration du site
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Redirection lorsqu'on arrive sur admin/
    Route::get('', function () {
       return to_route('admin.property.index');
    })->name('redirect');

    // CRUD des properties
    Route::resource('property', \App\Http\Controllers\Admin\PropertyController::class)->except(['show']);

    // CRUD des options
    Route::resource('option', \App\Http\Controllers\Admin\OptionController::class)->except(['show']);

});
