<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\AdminDashboard;
use App\Livewire\PetugasDashboard;
use App\Livewire\PublicDisplay;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'ADMIN') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('petugas.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/petugas', PetugasDashboard::class)->name('petugas.dashboard');
    Route::get('/admin', AdminDashboard::class)->name('admin.dashboard');
});

Route::get('/display', PublicDisplay::class)->name('public.display');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
