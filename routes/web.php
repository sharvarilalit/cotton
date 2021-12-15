<?php

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

Route::get('/', function () {
   // return view('welcome');
   return redirect(route('login'));
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
   Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
   Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
   Route::post('/edit-profile', [App\Http\Controllers\HomeController::class, 'update'])->name('profile.edit');
   Route::get('/change-password', function () {
      return view('auth.passwords.reset');
   })->name('change.password');

   /** Truck module */
   Route::get('truck/',  [App\Http\Controllers\TruckController::class, 'index'])->name('truck');
   Route::get('truck/add', [App\Http\Controllers\TruckController::class, 'add'])->name('truck.add');
   Route::post('truck/store', [App\Http\Controllers\TruckController::class, 'save'])->name('truck.store');
   Route::get('truck/edit/{id?}', [App\Http\Controllers\TruckController::class, 'add'])->name('truck.edit');
   Route::get('truck/delete/{id}', [App\Http\Controllers\TruckController::class, 'delete'])->name('truck.delete');

   /** Farmer module */
   Route::get('farmer/',  [App\Http\Controllers\FarmerController::class, 'index'])->name('farmer');
   Route::get('farmer/add', [App\Http\Controllers\FarmerController::class, 'add'])->name('farmer.add');
   Route::post('farmer/store', [App\Http\Controllers\FarmerController::class, 'save'])->name('farmer.store');
   Route::get('farmer/edit/{id?}', [App\Http\Controllers\FarmerController::class, 'add'])->name('farmer.edit');
   Route::get('farmer/delete/{id}', [App\Http\Controllers\FarmerController::class, 'delete'])->name('farmer.delete');

   /** Market module */
   Route::get('market/',  [App\Http\Controllers\MarketController::class, 'index'])->name('market');
   Route::get('market/add', [App\Http\Controllers\MarketController::class, 'add'])->name('market.add');
   Route::post('market/store', [App\Http\Controllers\MarketController::class, 'save'])->name('market.store');
   Route::get('market/edit/{id?}', [App\Http\Controllers\MarketController::class, 'add'])->name('market.edit');
   Route::get('market/delete/{id}', [App\Http\Controllers\MarketController::class, 'delete'])->name('market.delete');


   /** Farmer Transaction module */
   Route::get('farmer-transaction/',  [App\Http\Controllers\FarmerTransactionController::class, 'index'])->name('ftransaction');
   Route::get('farmer-transaction/add', [App\Http\Controllers\FarmerTransactionController::class, 'add'])->name('ftransaction.add');
   Route::post('farmer-transaction/store', [App\Http\Controllers\FarmerTransactionController::class, 'save'])->name('ftransaction.store');
   Route::get('farmer-transaction/edit/{id?}', [App\Http\Controllers\FarmerTransactionController::class, 'add'])->name('ftransaction.edit');
   Route::get('farmer-transaction/delete/{id}', [App\Http\Controllers\FarmerTransactionController::class, 'delete'])->name('ftransaction.delete');
   //Route::get('farmer-transaction/filter', [App\Http\Controllers\FarmerTransactionController::class, 'filter'])->name('ftransaction.filter');
   Route::get('farmer-transaction/export', [App\Http\Controllers\FarmerTransactionController::class, 'export'])->name('ftransaction.export');

   /** Truck Charges module */
   Route::get('truck-charges/',  [App\Http\Controllers\TruckChargesController::class, 'index'])->name('truck.charges');
   Route::get('truck-charges/add', [App\Http\Controllers\TruckChargesController::class, 'add'])->name('truck.charges.add');
   Route::post('truck-charges/store', [App\Http\Controllers\TruckChargesController::class, 'save'])->name('truck.charges.store');
   Route::get('truck-charges/edit/{id?}', [App\Http\Controllers\TruckChargesController::class, 'add'])->name('truck.charges.edit');
   Route::get('truck-charges/delete/{id}', [App\Http\Controllers\TruckChargesController::class, 'delete'])->name('truck.charges.delete');
});
