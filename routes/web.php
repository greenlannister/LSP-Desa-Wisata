<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\SiginController;
use App\Http\Controllers\RegisController;
use App\Http\Middleware\UserAkses;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::resource('/', App\Http\Controllers\HomeController::class);
Route::resource('/home', App\Http\Controllers\HomeController::class);
Route::resource('/about-%-dwp', App\Http\Controllers\AboutController::class);
Route::resource('/service-%-dwp', App\Http\Controllers\ServicesController::class);
Route::resource('/package-%-dwp', App\Http\Controllers\PackagesController::class);
Route::resource('/news-%-dwp', App\Http\Controllers\NewsController::class);
Route::resource('/contact-%-dwp', App\Http\Controllers\ContactController::class);
Route::resource('/regis-%-dwp', App\Http\Controllers\RegisController::class);
Route::post('/regis-%-dwp', [RegisController::class, 'store'])->name('register-pelanggan');
Route::resource('/discount-%-dwp', App\Http\Controllers\DiscountController::class);
     

// Middleware guest (hanya untuk yang belum login)
Route::middleware(['guest'])->group(function() {
    Route::get('/login', [SiginController::class, 'index'])->name('login');
    Route::post('/login', [SiginController::class, 'login'])->name('login.post');
});


// Middleware auth (hanya untuk yang sudah login)
Route::middleware(['auth'])->group(function(){
    Route::post('/logout', [SiginController::class, 'logout'])->name('logout');
    Route::get('/profile-kar', [ProfileController::class, 'ProfileKar'])->name('profilekar');
    Route::get('/profile', [ProfileController::class, 'Profile'])->name('profile');

// Middleware karyawan

    // Middleware Owner
    Route::middleware(['userAkses:pemilik'])->group(function(){
        Route::resource('/owner-%-dwp', OwnerController::class);
    });

    // Middleware Admin
    Route::middleware(['userAkses:admin'])->group(function(){
        
        // User Management
        Route::get('/admin-%-dwp/con1', [AdminController::class, 'con1'])->name('admin.user.management');
        Route::post('/user-management', [AdminController::class, 'store'])->name('admin.user.store');
        Route::put('/admin/user/{id}/update', [AdminController::class, 'update'])->name('admin.user.update');
        Route::put('/karyawan/{id}/ban', [AdminController::class, 'ban'])->name('admin.karyawan.ban');

        // News Management
        Route::get('/admin-%-dwp/con2', [AdminController::class, 'con2'])->name('news.management');
        Route::post('/news-management', [AdminController::class, 'kategoriBerita'])->name('news-management');
        Route::post('/kategori-berita/update/{id}', [AdminController::class, 'updateKategori'])->name('kategori-berita.update');
        Route::delete('/kategori-berita/delete/{id}', [AdminController::class, 'destroyKategori'])->name('kategori-berita.destroy');

        // News Management 2
        Route::get('/admin-%-dwp/con3', [AdminController::class, 'con3'])->name('manage.news');
        Route::post('/news-manage', [AdminController::class, 'Berita'])->name('news.manage');
        Route::put('/berita/{id}', [AdminController::class, 'BerUpdate'])->name('berita.update');
        Route::delete('/berita/{id}', [AdminController::class, 'destroyBerita'])->name('berita.destroy');

        Route::resource('/admin-%-dwp', AdminController::class)->except(['edit', 'update']);
    });

    // Middleware Bendahara
    Route::middleware(['userAkses:bendahara'])->group(function(){
        Route::resource('/bendahara-%-dwp', BendaharaController::class);

        // Homestay
        Route::get('/bendahara-%-dwp/cont1', [BendaharaController::class, 'cont1'])->name('homestay');
        Route::post('/homestay-manage', [BendaharaController::class, 'Homestay'])->name('homestay-management');
        Route::put('/homestay/{id}', [BendaharaController::class, 'HomestayUpdate'])->name('homestay.update');
        Route::delete('/homestay/{id}', [BendaharaController::class, 'destroyHomestay'])->name('homestay.destroy');

        // Paket Wisata
        Route::get('/bendahara-%-dwp/cont2', [BendaharaController::class, 'cont2'])->name('paket');
        Route::post('/paket-manage', [BendaharaController::class, 'PaketWisata'])->name('paket.management');
        Route::put('/paket-wisata/update/{id}', [BendaharaController::class, 'PaketUpdate'])->name('paket-wisata.update');
        Route::delete('/paket-wisata/delete/{id}', [BendaharaController::class, 'PaketDestroy'])->name('paket-wisata.destroy');

        // Objek Wisata
        Route::get('/bendahara-%-dwp/cont3', [BendaharaController::class, 'cont3'])->name('obta');
        Route::post('/obta-manage', [BendaharaController::class, 'objekWisata'])->name('obta.management');
        Route::put('/obta-wisata/update/{id}', [BendaharaController::class, 'ObtaUpdate'])->name('obta-wisata.update');
        Route::delete('/obta-wisata/delete/{id}', [BendaharaController::class, 'ObtaDestroy'])->name('obta-wisata.destroy');

        // Confirmation
        Route::get('/bendahara-%-dwp/cont4', [BendaharaController::class, 'cont4']);

        // Kategori Wisata
        Route::get('/bendahara-%-dwp/cont5', [BendaharaController::class, 'cont5'])->name('katwis');
        Route::post('/katwis-manage', [BendaharaController::class, 'kategoriWisata'])->name('katwis.management');
        Route::put('/kategori-wisata/update/{id}', [BendaharaController::class, 'updateKatwis'])->name('katwis-wisata.update');
        Route::delete('/kategori-wisata/delete/{id}', [BendaharaController::class, 'destroyKatwis'])->name('katwis-wisata.destroy');

        // Jenis Pembayaran
        Route::get('/bendahara-%-dwp/cont6', [BendaharaController::class, 'cont6'])->name('jenpe');
        Route::post('/jenpe-manage', [BendaharaController::class, 'JenisPembayaran'])->name('jenpe.management');
        Route::put('/jenis-pembayaran/update/{id}', [BendaharaController::class, 'updateJenpe'])->name('jenis-pembayaran.update');
        Route::delete('/jenis-pembayaran/delete/{id}', [BendaharaController::class, 'destroyJenpe'])->name('jenis-pembayaran.destroy');

        // Diskon
        Route::get('/bendahara-%-dwp/cont7', [BendaharaController::class, 'cont7'])->name('diskon');
        Route::post('/diskon-manage', [BendaharaController::class, 'Diskon'])->name('diskon.management');
        Route::put('/diskon/update/{id}', [BendaharaController::class, 'updateDiskon'])->name('diskon.update');
        Route::delete('/diskon/delete/{id}', [BendaharaController::class, 'destroyDiskon'])->name('diskon.destroy');
    });
});


// Route umum
Route::resource('/home', HomeController::class);


// Route::resource('/', App\Http\Controllers\HomeController::class);
