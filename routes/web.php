<?php

use App\Http\Controllers\LayananController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::get('/about', function () {
//     return view('about');
// })->name('about');

// Chatbot
// Route::post('/chatbot', [ChatbotController::class, 'handle']);

// Midtrans webhook (jangan pakai middleware auth!)
Route::post('/midtrans/notification', [ReservasiController::class, 'handleNotification'])
    // Penting biar gak nerima token csrf 
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class)
    ->name('midtrans.notification');

// Galeri Foto
Route::get('/galeri/foto', function () {
    return view('galeri.foto');
})->name('galeri.foto');

//  Galeri Video
Route::get('/galeri/video', function () {
    return view('galeri.video');
})->name('galeri.video');


Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

// Layanan
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/layanan/{slug}', [LayananController::class, 'show'])->name('layanan.show');

// Fasilitas
Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');
Route::get('/fasilitas/{slug}', [FasilitasController::class, 'show'])->name('fasilitas.show');

// Form reservasi
Route::get('/reservasi', function () {
    return view('auth.payment.reservasi'); // Ganti jika file blade-nya beda
})->name('reservasi');

Route::get('/reservasi', [ReservasiController::class, 'showForm'])->name('reservasi');

// Proses reservasi dan Midtrans Snap
Route::post('/reservasi/proses', [ReservasiController::class, 'proses'])->name('reservasi.proses');

// Halaman redirect setelah sukses / gagal / pending
Route::get('/reservasi/thank-you', [ReservasiController::class, 'thankYou'])->name('reservasi.thankyou');
Route::get('/reservasi/failed', [ReservasiController::class, 'failed'])->name('reservasi.failed');
Route::get('/reservasi/pending', [ReservasiController::class, 'pending'])->name('reservasi.pending');

Route::get('/payment/riwayat', [ReservasiController::class, 'history'])->name('payment.riwayat');
Route::get('/detail/{id}', [ReservasiController::class, 'detail'])->name('payment.detail');

// Logout Admin 
Route::post('/admin/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/'); // redirect ke homepage setelah logout
})->name('filament.admin.auth.logout');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
