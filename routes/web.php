<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CarsController;
use App\Http\Controllers\Customer\TransactionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class, 'index'])->name('/');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'role:customer'])->name('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified', 'role:customer')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Rent
    Route::get('/detail-cars/{id}', [HomeController::class, 'detailCars'])->name('detail.cars');
    Route::post('/create-rent-transaction', [TransactionController::class, 'addTransaction'])->name('add.customer.transaction'); 
    Route::get('/dashboard', [TransactionController::class, 'showTransaction'])->name('dashboard');
    Route::post('/paid-rent/{id}', [TransactionController::class, 'custPaid'])->name('customer.paid');
    Route::post('/get-car/{id}', [TransactionController::class, 'custGetCar'])->name('customer.get.car');
    Route::post('/return-car/{id}', [TransactionController::class, 'custReturnCar'])->name('customer.return.car');
    Route::get('/search-transaction-history', [TransactionController::class, 'searchTransactionHistory'])->name('customer.search.history');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified', 'role:admin'])->group(function() {
    //Cars
    Route::get('/admin/cars', [AdminController::class, 'index'])->name('admin.cars');
    Route::get('/admin/cars/add', [CarsController::class, 'addCar'])->name('admin.add.cars');
    Route::post('/admin/cars/store', [CarsController::class, 'storeCar'])->name('admin.store.cars');
    Route::get('/admin/cars/edit/{id}', [CarsController::class, 'editCar'])->name('admin.edit.cars');
    Route::post('/admin/cars/update/{id}', [CarsController::class, 'updateCar']);
    Route::delete('/admin/cars/delete/{id}', [CarsController::class, 'deleteCars']);
    Route::get('/admin/cars/search', [CarsController::class, 'searchCars'])->name('admin.search.cars');

    //Customer Data
    Route::get('/admin/customer-data', [AdminController::class, 'showCustomerData'])->name('admin.customer');    
    Route::delete('/admin/customer-data/delete/{id}', [AdminController::class, 'deleteCustomerData']);
    Route::get('/admin/customer-data/search', [AdminController::class, 'searchCustomerData'])->name('admin.search.customer');

    //Transaction Data
    Route::get('/admin/transaction-data', [AdminController::class, 'showTransactionData'])->name('admin.transcation');    
    Route::post('/admin/transaction-data/validate/{id}', [AdminController::class, 'validateTransactionData'])->name('admin.transcation.validate');    
    Route::post('/admin/transaction-data/return-validate/{id}', [AdminController::class, 'returnValidateTransactionData'])->name('admin.transcation.return.validate');    
});
