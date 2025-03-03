<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LivroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('livros', LivroController::class)->middleware(['auth', 'verified']);
Route::resource('autores', AutorController::class)->middleware(['auth', 'verified']);
Route::resource('assuntos', AssuntoController::class)->middleware(['auth', 'verified']);

Route::get('/relatorios/livros', [RelatorioController::class, 'index'])->middleware(['auth', 'verified'])->name('relatorios.livros.index');
Route::get('/relatorios/livros/pdf', [RelatorioController::class, 'gerarPDF'])->middleware(['auth', 'verified'])->name('relatorios.livros.pdf');


Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);