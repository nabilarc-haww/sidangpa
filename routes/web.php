<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyekAkhirController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\RisetGroupController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\DataProyekAkhirController;
use App\Http\Controllers\AuthController;

Route::get('/',function () {
    return view('home');
});

Route::get('/proyek-akhir/generate/{id_header}', [ProyekAkhirController::class, 'generate'])->name('proyek-akhir.generate');
Route::get('/proyek-akhir/generate-hasil/{id_header}', [ProyekAkhirController::class, 'getData'])->name('proyek-akhir.getdata');
Route::post('/store-header', [HeaderController::class, 'store'])->name('header.store');
Route::post('/proyek-akhir/import', [ProyekAkhirController::class, 'import'])->name('proyek-akhir.import');
Route::get('/hasil-proyek-akhir',[ProyekAkhirController::class, 'getDataGenerate']);
Route::get('/proyek-akhir/edit/{id_jadwal_generate}', [ProyekAkhirController::class, 'edit'])->name('proyek-akhir.edit');
Route::post('/proyek-akhir/update/{id_jadwal_generate}', [ProyekAkhirController::class, 'update'])->name('proyek-akhir.update');
Route::delete('/proyek-akhir/delete/{id_jadwal_generate}', [ProyekAkhirController::class, 'destroy'])->name('proyek-akhir.delete');
Route::get('/proyek-akhir/download-pdf/{id_header}', [ProyekAkhirController::class, 'downloadPdf'])->name('proyek-akhir.downloadPdf');

Route::get('/proyek-akhir/jadwal',function () {
return view('jadwal');
});

Route::get('/riset-group', [RisetGroupController::class, 'getAllData']);
Route::get('/pengumuman',function () {
    return view('announce/announce');
});

Route::get('/pengumuman', [PengumumanController::class, 'getDataAnnounce']);

Route::get('/pengumuman/edit',function () {
    return view('announce/edit_ann');
});
Route::post('/pengumuman/tambah-pengumuman', [PengumumanController::class, 'tambahPengumuman'])->name('pengumuman.tambahPengumuman');
Route::get('/pengumuman/edit-pengumuman/{id}', [PengumumanController::class, 'editPengumuman'])->name('pengumuman.editPengumuman');
Route::post('/pengumuman/update-pengumuman/{id}', [PengumumanController::class, 'updatePengumuman'])->name('pengumuman.updatePengumuman');
Route::delete('/pengumuman/delete-penguman/{id}', [PengumumanController::class, 'deletePengumuman'])->name('pengumuman.deletePengumuman');

Route::get('/pengumuman/tambah',function () {
    return view('announce/tambah_ann');
});

Route::get('/pengumuman/public',function () {
    return view('announce/public');
});

Route::get('/pengumuman/public/detail',function () {
    return view('announce/detail_public');
});

Route::get('/proyek-akhir/data/{id_master}', [DataProyekAkhirController::class, 'getDataProyek'])->name('proyek-akhir.data');
Route::post('/proyek-akhir/data/tambah/{id_master}', [DataProyekAkhirController::class, 'tambahDataProyek'])->name('proyek-akhir.data.tambahDataProyek');
Route::get('/proyek-akhir/data/edit/{id}', [DataProyekAkhirController::class, 'showEditForm'])->name('proyek-akhir.data.editDataProyek');
Route::post('/proyek-akhir/data/update/{id}', [DataProyekAkhirController::class, 'updateDataProyek'])->name('proyek-akhir.data.updateDataProyek');
Route::delete('/proyek-akhir/data/delete/{id}', [DataProyekAkhirController::class, 'deleteDataProyek'])->name('proyek-akhir.data.deleteDataProyek');
Route::get('/proyek-akhir/data/tambah_pa/{id_master}', [DataProyekAkhirController::class, 'dosenDropdown'])->name('proyek-akhir.data.tambah_pa');
Route::get('/proyek-akhir',[DataProyekAkhirController::class, 'getDataMasterPA']);
Route::get('/proyek-akhir/form', [DataProyekAkhirController::class, 'showForm']);

Route::get('/register',function () {
    return view('user/register');
});

Route::get('/login',function () {
    return view('user/login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

// Route::get('/proyek-akhir/jadwal',function () {
//     return view('jadwal');
// });
// Route::get('/proyek-akhir/jadwal', function () {
//     return view('/proyek-akhir/generate');
// });
// Route::get('/proyek-akhir',function () {
//     return view('proyek_akhir/card_pa');
// });
// Route::get('/hasil-proyek-akhir',function () {
//     return view('card');
// });


// Route::get('/proyek-akhir/data',function () {
//     return view('/proyek_akhir/public_pa');
// });
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware(['auth.check', 'role:admin'])->group(function () {
//     Route::get('/', function () {
//         return view('home');
//     });
// });

// Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('register', [AuthController::class, 'register']);

// Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('login', [AuthController::class, 'login']);

// Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('dashboard', function () {
//     return view('dashboard');
// })->middleware('auth:supabase');
