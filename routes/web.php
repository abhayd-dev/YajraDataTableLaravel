<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('employee', [EmpController::class, 'index']);
Route::get('emp/listing', [EmpController::class, 'getEmployee'])->name('emp.listing');

Route::delete('employee/{id}', [EmpController::class, 'destroy'])->name('emp.delete');
Route::get('emp/edit/{id}', [EmpController::class, 'edit'])->name('emp.edit');
Route::post('employee/update', [EmpController::class, 'update'])->name('emp.update');
Route::post('employee/store', [EmpController::class, 'store'])->name('emp.store');
Route::post('emp/bulk-delete',[EmpController::class, 'bulkDelete'] )->name('emp.bulk-delete');