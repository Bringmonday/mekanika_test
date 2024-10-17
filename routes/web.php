<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModelPartController;
use App\Http\Controllers\InputPartController;
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

Route::get('/', function () {
    return view('produksi.model');
});

Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

Route::get('/model', [ModelPartController::class,'index'])->name('model');
Route::get('/model-part', [ModelPartController::class,'getModels'])->name('model.part');
Route::post('/model/add', [ModelPartController::class,'store'])->name('model.add');
Route::get('/model/edit/{id}', [ModelPartController::class, 'edit'])->name('model.edit');
Route::post('/model/update', [ModelPartController::class, 'update'])->name('model.update');
Route::post('/model/delete/{id}', [ModelPartController::class, 'destroy'])->name('model.delete');

Route::get('/part', [InputPartController::class,'index'])->name('part');
Route::get('/part-input', [InputPartController::class,'getModels'])->name('part.input');
Route::post('/part/add', [InputPartController::class,'store'])->name('part.add');
Route::get('/part/edit/{id}', [InputPartController::class, 'edit'])->name('part.edit');
Route::post('/part/update', [InputPartController::class, 'update'])->name('part.update');
Route::post('/part/delete/{id}', [InputPartController::class, 'destroy'])->name('part.delete');


