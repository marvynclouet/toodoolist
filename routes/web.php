<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Assurez-vous que Auth est importé

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;

// Routes publiques
Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::put('/tasks/{task}/toggleComplete', [TaskController::class, 'toggleComplete'])->name('tasks.toggleComplete');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy'); // Nouvelle route pour la suppression
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');




Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::put('/tasks/{task}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggleComplete');


Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');


// Routes nécessitant une authentification
Route::middleware('auth')->group(function () {
    // Route pour afficher le tableau de bord
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    
    // Route pour gérer la création de nouvelles tâches
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
});

// Routes générées par Auth::routes() pour l'authentification
Auth::routes();

// Route /home pour la redirection après connexion
Route::get('/home', [HomeController::class, 'index'])->name('home');

