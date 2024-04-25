<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyekAkhirController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\RisetGroupController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

Route::get('/',function () {
    return view('home');
});

// Route::get('/proyek-akhir/jadwal',function () {
//     return view('jadwal');
// });
Route::get('/proyek-akhir/generate', [ProyekAkhirController::class, 'getData'])->name('proyek-akhir.getData');
Route::post('/store-header', [HeaderController::class, 'store'])->name('header.store');

Route::post('/proyek-akhir/import', [ProyekAkhirController::class, 'import'])->name('proyek-akhir.import');

// Route::get('/proyek-akhir/jadwal', function () {
//     return view('/proyek-akhir/generate');
// });

Route::get('/proyek-akhir/jadwal',function () {
    return view('jadwal');
});

Route::get('/riset-group', [RisetGroupController::class, 'getAllData']);

// Route::get('/dosen', [DosenController::class, 'getAllData']);
