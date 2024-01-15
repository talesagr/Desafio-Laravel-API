<?php

use App\Http\Controllers\api\PessoaController;
use App\Http\Controllers\api\PessoaTermController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/pessoas', [PessoaController::class, 'store']);
Route::get('/pessoas/{uuid}', [PessoaController::class, 'show']);
Route::get('/pessoas', [PessoaTermController::class, 'find']);
Route::get('contagem-pessoas',[PessoaController::class, 'count']);
