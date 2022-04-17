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

   Route::get('farmer/pdf/{id}', [App\Http\Controllers\FarmerPDFController::class, 'generatePDF'])->name('farmer.pdf');
   

   Route::get('farmer/extra-payment/{id}', [App\Http\Controllers\FarmerController::class, 'extraPayment'])->name('farmer.extra-payment');

   Route::post('farmer/extra-store', [App\Http\Controllers\FarmerController::class, 'extraSave'])->name('farmer.extra-store');
   Route::get('farmer/extra-list/{id}',  [App\Http\Controllers\FarmerController::class, 'extraList'])->name('farmer.extra-list');
   Route::get('farmer/extra-delete/{id}', [App\Http\Controllers\FarmerController::class, 'extraDelete'])->name('farmer.extra-delete');





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
   Route::get('farmer-log/',  [App\Http\Controllers\FarmerTransactionController::class, 'flog'])->name('flog');
   Route::get('farmer-transaction/view/{id?}', [App\Http\Controllers\FarmerTransactionController::class, 'viewHistroy'])->name('ftransaction.view');

   /** Truck Charges module */
   Route::get('truck-charges/',  [App\Http\Controllers\TruckChargesController::class, 'index'])->name('truck.charges');
   Route::get('truck-charges/add', [App\Http\Controllers\TruckChargesController::class, 'add'])->name('truck.charges.add');
   Route::post('truck-charges/store', [App\Http\Controllers\TruckChargesController::class, 'save'])->name('truck.charges.store');
   Route::get('truck-charges/edit/{id?}', [App\Http\Controllers\TruckChargesController::class, 'add'])->name('truck.charges.edit');
   Route::get('truck-charges/delete/{id}', [App\Http\Controllers\TruckChargesController::class, 'delete'])->name('truck.charges.delete');

    /*get village farmar cost for truck charges findout*/
    Route::post('/gettruckdetails',[App\Http\Controllers\TruckChargesController::class, 'getVillagecost'])->name('truck.charges.getvillagecost');
   // Route::get('truck-charges/',  [App\Http\Controllers\FarmerTransactionController::class, 'index'])->name('index');

   /** Profit loss */
    Route::get('profit-loss/',  [App\Http\Controllers\ProfitLossController::class, 'index'])->name('profit.loss');

   // Report Module
   Route::get('sales-report/',  [App\Http\Controllers\ReportController::class, 'index'])->name('sales.report');


     /** Outside Payment module */
   Route::get('outside-payment/',  [App\Http\Controllers\OutsidePaymentController::class, 'index'])->name('outsidep');
   Route::get('outside-payment/add', [App\Http\Controllers\OutsidePaymentController::class, 'add'])->name('outsidep.add');
   Route::post('outside-payment/store', [App\Http\Controllers\OutsidePaymentController::class, 'save'])->name('outsidep.store');
   Route::get('outside-payment/edit/{id?}', [App\Http\Controllers\OutsidePaymentController::class, 'add'])->name('outsidep.edit');
   Route::get('outside-payment/delete/{id}', [App\Http\Controllers\OutsidePaymentController::class, 'delete'])->name('outsidep.delete');

    Route::get('outside-payment/export', [App\Http\Controllers\OutsidePaymentController::class, 'export'])->name('outsidep.export');
    Route::get('outside-log/',  [App\Http\Controllers\OutsidePaymentController::class, 'flog'])->name('oplog');
<<<<<<< HEAD
=======

>>>>>>> 4046d18... New extra payment changes
   Route::get('outside-payment/view/{id?}', [App\Http\Controllers\OutsidePaymentController::class, 'viewHistroy'])->name('outsidep.view');

<<<<<<< HEAD
=======
    Route::get('outside-payment/view/{id?}', [App\Http\Controllers\OutsidePaymentController::class, 'viewHistroy'])->name('outsidep.view');
   

    /** Salary Payment module */
    Route::get('salary/',  [App\Http\Controllers\SalaryController::class, 'index'])->name('salary');
    Route::get('salary/add', [App\Http\Controllers\SalaryController::class, 'add'])->name('salary.add');
    Route::post('salary/store', [App\Http\Controllers\SalaryController::class, 'save'])->name('salary.store');
    Route::get('salary/edit/{id?}', [App\Http\Controllers\SalaryController::class, 'add'])->name('salary.edit');
    Route::get('salary/delete/{id}', [App\Http\Controllers\SalaryController::class, 'delete'])->name('salary.delete');
<<<<<<< HEAD

<<<<<<< HEAD
>>>>>>> 4046d18... New extra payment changes
=======
=======
  
    
>>>>>>> a2e3777... Pdf Farmer


>>>>>>> d5dcf15... new changes
});
