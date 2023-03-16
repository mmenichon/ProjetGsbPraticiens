<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\PraticienController;
use App\Http\Controllers\SpecialiteController;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/getLogin', [VisiteurController::class, 'getLogin']);
Route::post('/login', [VisiteurController::class, 'signIn']);
Route::get('/getLogout', [VisiteurController::class, 'signOut']);

Route::get('/getListeFrais', [PraticienController::class, 'getListePraticiens']);

Route::get('/listerSpecialites/{id}', [SpecialiteController::class, 'getListeSpecialite']);




Route::post('/validerFrais',
    [
        'as' => 'validerFrais',
        'uses' => 'App\Http\Controllers\FraisController@validateFrais'
    ]);

Route::get('/ajouterFrais', [FraisController::class, 'addFrais']);

Route::get('/supprimerFrais/{id}', [FraisController::class, 'supprimerFrais']);
