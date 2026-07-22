<?php

use App\Http\Controllers\generalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Not Logged
Route::get('/', [generalController::class, 'index'])->name('home');
Route::get('/cursos', [generalController::class,'getCursos'])->name('cursosPublic');
Route::get('/professores', [generalController::class,'getProfessores'])->name('professoresPublic');
Route::get('/login', [generalController::class,'login'])->name('login');

// Administrador
Route::get('/admin/');

// Professor
Route::get('/professor');

// Aluno
Route::get('aluno');
