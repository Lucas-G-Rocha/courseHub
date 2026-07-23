<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\cursosController;
use App\Http\Controllers\generalController;
use App\Http\Controllers\professorsController;
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


Route::get('/', [generalController::class, 'index'])->name('home');
Route::get('/login', [authController::class, 'loginPage'])->name('login');

//Cursos
Route::get('/cursos', [cursosController::class, 'getPublicCursos'])->name('cursosPublic');
Route::get('/cursos/{id}', [cursosController::class, 'getPublicCurso'])->name('cursoPublic');

// Administrador
Route::get('/admin/');

// Professores
Route::get('/professores', [professorsController::class, 'getPublicProfessors'])->name('professoresPublic');
Route::get('/professores/{id}', [professorsController::class, 'getPublicProfessor'])->name('professorPublic');

// Aluno
Route::get('aluno');
