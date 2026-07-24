<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\authController;
use App\Http\Controllers\cursosController;
use App\Http\Controllers\generalController;
use App\Http\Controllers\professorsController;
use App\Http\Controllers\studentController;
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

// Auth
Route::get('/login', [authController::class, 'loginPage'])->name('loginPage');
Route::post('/api/login', [authController::class, 'login'])->name('login');
Route::post('/api/logout', [authController::class, 'logout'])->name('logout');


//Cursos
Route::get('/cursos', [cursosController::class, 'getPublicCursos'])->name('cursosPublic');
Route::get('/curso/{id}', [cursosController::class, 'getPublicCurso'])->name('cursoPublic');

// Administrador
Route::get('/admin/');
Route::get('/admin/inicio', [adminController::class, 'adminInicio'])->name('adminInicio');
Route::get('/admin/perfil', [adminController::class, 'adminPerfil'])->name('adminPerfil');

Route::get('/admin/professores', [adminController::class, 'adminProfessores'])->name('adminProfessores');
Route::get('/admin/professor/create', [adminController::class, 'adminProfessorCreatePage'])->name('adminProfessorCreatePage');
Route::post('/api/admin/professor/create', [adminController::class, 'adminProfessorCreate'])->name('adminProfessorCreate');
Route::get('admin/professor/{id}', [adminController::class, 'adminProfessor'])->name('adminProfessor');
Route::get('/admin/professor/edit/{id}', [adminController::class, 'adminProfessorEditPage'])->name('adminProfessorEditPage');
Route::get('/admin/professor/destroy/{id}', [adminController::class, 'adminProfessorDestroy'])->name('adminProfessorDestroy');

Route::get('/admin/cursos', [adminController::class, 'adminCursos'])->name('adminCursos');
Route::get('admin/curso/{id}', [adminController::class, 'adminCurso'])->name('adminCurso');
Route::get('/admin/curso/create', [adminController::class, 'adminCursoCreatePage'])->name('adminCursoCreatePage');
Route::get('/admin/curso/edit/{id}', [adminController::class, 'adminCursoEditPage'])->name('adminCursoEditPage');
Route::get('/admin/curso/destroy/{id}', [adminController::class, 'adminCursoDestroy'])->name('adminCursoDestroy');


Route::get('/admin/alunos', [adminController::class, 'adminStudents'])->name('adminStudents');
Route::get('/admin/aluno/{id}', [adminController::class, 'adminStudent'])->name('adminStudent');
Route::get('/admin/alunos/create', [adminController::class, 'adminStudentCreatePage'])->name('adminStudentCreatePage');
Route::get('/admin/aluno/edit/{id}', [adminController::class, 'adminStudentEditPage'])->name('adminStudentoEditPage');
Route::get('/admin/aluno/destroy/{id}', [adminController::class, 'adminStudentDestroy'])->name('adminStudentDestroy');

// -----------------------------------------------------------------------------------------------------------------------------------------------------


// Professores
Route::get('/professores', [professorsController::class, 'getPublicProfessors'])->name('professoresPublic');
Route::get('/professor/{id}', [professorsController::class, 'getPublicProfessor'])->name('professorPublic');
Route::get('/professor/inicio', [professorsController::class, 'professorInicio'])->name('professorInicio');

// Aluno
Route::get('aluno');
Route::get('aluno/inicio', [studentController::class, 'studentInicio'])->name('alunoInicio');