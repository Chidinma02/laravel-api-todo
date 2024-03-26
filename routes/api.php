<?php

use App\Http\Controllers\Api\TodoController;
use App\Models\Todo;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('todo')->group(function(){
 Route::get('/',[TodoController::class,'index']);
   
});

Route::post('todo',[TodoController::class,'store']);

// Route::delete('/todos/{id}', [TodoController::class, 'destroy']);

