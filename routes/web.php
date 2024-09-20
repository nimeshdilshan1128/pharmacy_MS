<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\PurchasesController;


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

Route::get('/', [AuthController::class, 'login']);

Route::get('forgot', [AuthController::class, 'forgot']);

Route::post('login_post', [AuthController::class, 'login_post']);

Route::post('forgot_post', [AuthController::class, 'forgot_post']);

Route::get('reset/{token}', [AuthController::class, 'getReset']);
Route::get('reset/{token}', [AuthController::class, 'postReset']);


Route::group(['middleware' => 'admin'], function(){

    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('admin/customers', [CustomersController::class, 'customers']);

    Route::get('admin/customers/add', [CustomersController::class, 'add_customers']);

    Route::post('admin/customers/add', [CustomersController::class, 'insert_add_customers']);

    Route::get('admin/customers/edit/{id}', [CustomersController::class, 'edit_customers']);

    Route::post('admin/customers/edit/{id}', [CustomersController::class, 'update_customers']);

    Route::get('admin/customers/delete/{id}', [CustomersController::class, 'delete_customers']);

    Route::get('admin/medicines', [MedicinesController::class, 'medicines']);

    Route::get('admin/medicines/add', [MedicinesController::class, 'add_medicines']);

    Route::post('admin/medicines/add_M', [MedicinesController::class, 'add_update_M']);

    Route::get('admin/medicines/edit/{id}', [MedicinesController::class, 'edit_medicines']);
    Route::post('admin/medicines/edit/{id}', [MedicinesController::class, 'add_update_edit']);
    Route::get('admin/medicines/delete/{id}', [MedicinesController::class, 'medicines_delete']);

    Route::get('admin/medicines_stock', [MedicinesController::class, 'medicines_stock_list']);

    Route::get('admin/medicines_stock/add', [MedicinesController::class, 'medicines_stock_add']);

    Route::post('admin/medicines_stock/add', [MedicinesController::class, 'medicines_stock_store']);

    Route::get('admin/medicines_stock/delete/{id}',[MedicinesController::class, 'medicines_stock_delete']);

    Route::get('admin/medicines_stock/edit/{id}', [MedicinesController::class, 'medicines_stock_edit']);

    Route::post('admin/medicines_stock/edit/{id}', [MedicinesController::class, 'medicines_stock_edit_update']);

    //supplier start
    Route::get('admin/suppliers', [SuppliersController::class, 'index']);

    Route::get('admin/suppliers/add', [SuppliersController::class, 'create']);

    Route::post('admin/suppliers/add', [SuppliersController::class, 'store']);

    Route::get('admin/suppliers/edit/{id}', [SuppliersController::class, 'edit']);

    Route::post('admin/suppliers/edit/{id}', [SuppliersController::class, 'update']);

    Route::get('admin/suppliers/delete/{id}',[SuppliersController::class, 'delete']);

     //supplier end

     //invoice start
    Route::get('admin/invoices',[InvoicesController::class, 'index']);

    Route::get('admin/invoices/add', [InvoicesController::class, 'create']);

    Route::post('admin/invoices/add', [InvoicesController::class, 'store']);

    Route::get('admin/invoices/delete/{id}',[InvoicesController::class, 'delete']);

    Route::get('admin/invoices/edit/{id}', [InvoicesController::class, 'edit']);

    Route::post('admin/invoices/edit/{id}', [InvoicesController::class, 'update']);

     //invoice end

     //purchases start

     Route::prefix('admin/purchases')->group(function(){

        Route::get('',[PurchasesController::class, 'index']);

        Route::get('add', [PurchasesController::class, 'create']);

        Route::post('add', [PurchasesController::class, 'store']);

   
     });


     //purchases end



});

Route::get('logout', [AuthController::class, 'logout']);