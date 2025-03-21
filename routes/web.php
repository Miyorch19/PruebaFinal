<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación.
| Estas rutas son cargadas por el RouteServiceProvider y todas estarán
| asignadas al grupo de middleware "web". ¡Haz algo grandioso!
|
*/

// Ruta principal de la página de inicio
Route::get('/', function () {
    return view('home');
})->name('home');

// Ruta para la vista de Login
Route::view('/login', 'login')->name('login');

// Ruta para la vista de Registro
Route::view('/register', 'Registrar')->name('register');

// Rutas para la autenticación
Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');

// Ruta para cerrar sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::view('/homeLog', 'homeLog')->name('privada');
    Route::view('/Categorias', 'Categorias')->name('Categorias');

    Route::get('/productos/search', [ProductController::class, 'search'])->name('productos.search');


    Route::get('/Productos', [ProductController::class, 'index'])->name('Productos');
    Route::post('/Productos', [ProductController::class, 'store'])->name('product.store');
    Route::put('/Productos/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/Productos/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/messages/{user_id}', [MessageController::class, 'getMessages']);
    Route::get('/conversations', [MessageController::class, 'getUserConversations'])->name('conversations');

    // Rutas para Usuarios
    Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
    Route::get('/usuarios/crear', [UserController::class, 'create'])->name('users.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('users.store');
    Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // <-- Ruta agregada
});



