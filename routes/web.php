<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

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

Route::get('/images/{path}', [\App\Http\Controllers\ImageController::class,'show'])->where('path','.*');
// Formulaire de contact
Route::post('/biens/{property}/contact',[PropertyController::class,'contact'])
    ->name('property.contact')
    ->where([
       'property' => $idRegex
    ]);


// Formulaire d'authentification
/*
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
*/

// Ce groupe de route concerne tout ce qui touche à la partie administration du site
Route::prefix('admin')->name('admin.')->middleware(['auth','verified'])->group(function () use ($idRegex) {

    // Redirection lorsqu'on arrive sur admin/
    Route::get('', function () {
       return to_route('admin.property.index');
    })->name('redirect');

    // CRUD des properties
    Route::resource('property', \App\Http\Controllers\Admin\PropertyController::class)->except(['show']);

    /*
     * Restaure une property
     * withTrashed() permet de récupérer les properties
     * soft deleted. Sinon cela ne fonctionne pas
     */
    Route::post('property/restore/{property}', [\App\Http\Controllers\Admin\PropertyController::class, 'restore'])
        ->name('property.restore')->withTrashed();

    // CRUD des options
    Route::resource('option', \App\Http\Controllers\Admin\OptionController::class)->except(['show']);

    // Suppression d'une image
    Route::delete('picture/{picture}', [\App\Http\Controllers\Admin\PictureController::class, 'destroy'])
        ->name('picture.destroy')
        ->where([
            'picture' => $idRegex,
        ])
        ->can('delete','picture');
});
