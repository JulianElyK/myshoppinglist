<?php

use App\Http\Controllers\ShoppinglistsController;
use App\Http\Controllers\ShoppinglistdetailsController;
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

Route::get('/shoppinglists', [ShoppinglistsController::class, 'index'])->name('Home');
Route::get('/shoppinglists/{shoppinglist_id}', [ShoppinglistsController::class, 'details']);
Route::get('/shoppinglists/{id}/edit', [ShoppinglistsController::class, 'updateForm']);
Route::delete('/shoppinglists/{shoppinglist_id}', [ShoppinglistsController::class, 'deleteList']);
Route::put('/shoppinglists/{shoppinglist_id}', [ShoppinglistsController::class, 'updateList']);

Route::get('/shoppinglist/add', [ShoppinglistdetailsController::class, 'index'])->name('FormAdd');
Route::post('/shoppinglist/add', [ShoppinglistdetailsController::class, 'store']);