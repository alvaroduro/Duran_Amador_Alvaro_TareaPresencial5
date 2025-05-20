<?php

use App\Http\Controllers\Admin\SearchController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TareaController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});


Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "✅ Conexión exitosa a la base de datos: " . DB::connection()->getDatabaseName();
    } catch (QueryException $e) {
        return "❌ No se pudo conectar a la base de datos. Error: " . $e->getMessage();
    }
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('tareas.buscar', [SearchController::class, 'buscarTareas'])->name('tareas.buscar');
     Route::get('tareas/exportar-pdf', [TareaController::class, 'exportarPdf'])->name('tareas.exportarPdf');
    Route::get('tareas/completadas', [TareaController::class, 'tareasCompletadas'])->name('tareas.completadas');
    Route::get('tareas/pendientes', [TareaController::class, 'tareasPendientes'])->name('tareas.pendientes');

    Route::get('tareas/filtrar-por-fecha', [TareaController::class, 'filtrarPorFecha'])->name('tareas.filtrarPorFecha');
    Route::resource('categorias', CategoriaController::class);
    Route::resource('tareas', TareaController::class);
});

require __DIR__.'/auth.php';
