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

Route::get('/listePraticiens', [PraticienController::class, 'listePraticiens']);

Route::get('/specialitesPraticien/{id}', [SpecialiteController::class, 'listeSpecialitesParPraticien']);

Route::get('/deleteSpecialite/{id}', [SpecialiteController::class, 'deleteSpecialite']);

Route::post('/addSpecialite', [SpecialiteController::class, 'postAddSpecialite']);

//Route::post('/validerFrais',
//    [
//        'as' => 'validerFrais',
//        'uses' => 'App\Http\Controllers\FraisController@validateFrais'
//    ]);
//

