<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\authController;
use App\Http\Controllers\cursosController;
use App\Http\Controllers\generalController;
use App\Http\Controllers\professorController;
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



Route::middleware('authorization')->group(function () {
    Route::get('/', [generalController::class, 'index'])->name('home');

    Route::get('/testeguzzle', function () {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts')->json();

        return view('testeguzzle', compact('response'));
    });

    // Auth
    Route::get('/login', [authController::class, 'loginPage'])->name('loginPage'); 
    Route::post('/api/login', [authController::class, 'login'])->name('login');      
    Route::post('/api/logout', [authController::class, 'logout'])->name('logout'); 


    //Cursos
    Route::get('/cursos', [cursosController::class, 'getPublicCursos'])->name('cursosPublic');
    Route::get('/curso/{id}', [cursosController::class, 'getPublicCurso'])->name('cursoPublic');

    // Administrador
    Route::get('/admin/inicio', [adminController::class, 'adminInicio'])->name('adminInicio');
    Route::get('/admin/perfil', [adminController::class, 'adminPerfil'])->name('adminPerfil');

    Route::get('/admin/professores', [adminController::class, 'adminProfessores'])->name('adminProfessores');
    Route::get('/admin/professor/create', [adminController::class, 'adminProfessorCreatePage'])->name('adminProfessorCreatePage');
    Route::post('/api/admin/professor/create', [adminController::class, 'adminProfessorCreate'])->name('adminProfessorCreate');
    Route::get('admin/professor/{id}', [adminController::class, 'adminProfessor'])->name('adminProfessor');
    Route::get('/admin/professor/edit/{id}', [adminController::class, 'adminProfessorEditPage'])->name('adminProfessorEditPage');
    Route::put('/admin/professor/edit/{id}', [adminController::class, 'adminProfessorEdit'])->name('adminProfessorEdit');
    Route::delete('/admin/professor/destroy/{id}', [adminController::class, 'adminProfessorDestroy'])->name('adminProfessorDestroy');

    Route::get('/admin/cursos', [adminController::class, 'adminCursos'])->name('adminCursos');
    Route::get('/admin/curso/create', [adminController::class, 'adminCursoCreatePage'])->name('adminCursoCreatePage');
    Route::post('/admin/curso/create', [adminController::class, 'adminCursoCreate'])->name('adminCursoCreate');
    Route::get('admin/curso/{id}', [adminController::class, 'adminCurso'])->name('adminCurso');
    Route::get('/admin/curso/edit/{id}', [adminController::class, 'adminCursoEditPage'])->name('adminCursoEditPage');
    Route::put('/admin/curso/edit/{id}', [adminController::class, 'adminCursoEdit'])->name('adminCursoEdit');
    Route::delete('/admin/curso/destroy/{id}', [adminController::class, 'adminCursoDestroy'])->name('adminCursoDestroy');

    Route::post('/admin/lesson/create/{id}', [adminController::class, 'adminLessonCreate'])->name('adminLessonCreate');
    Route::delete('/admin/lesson/destroy/{id}', [adminController::class, 'adminLessonDestroy'])->name('adminLessonDestroy');
    Route::put('/admin/lesson/{id}', [adminController::class, 'adminLessonEdit'])->name('adminLessonEdit');

    Route::get('/admin/alunos', [adminController::class, 'adminStudents'])->name('adminStudents');
    Route::get('/admin/alunos/create', [adminController::class, 'adminStudentCreatePage'])->name('adminStudentCreatePage');
    Route::get('/admin/aluno/{id}', [adminController::class, 'adminStudent'])->name('adminStudent');
    Route::get('/admin/aluno/edit/{id}', [adminController::class, 'adminStudentEditPage'])->name('adminStudentEditPage');
    Route::put('/admin/aluno/edit/{id}', [adminController::class, 'adminStudentEdit'])->name('adminStudentEdit');

    Route::delete('/admin/aluno/destroy/{id}', [adminController::class, 'adminStudentDestroy'])->name('adminStudentDestroy');

    Route::post('/admin/enrollment/create', [adminController::class, 'adminEnrollmentCreate'])->name('adminEnrollmentCreate');
    Route::delete('/admin/enrollment/destroy/{id}', [adminController::class, 'adminEnrollmentDestroy'])->name('adminEnrollmentDestroy');


    // Professores
    Route::get('/professor/inicio', [professorController::class, 'professorInicio'])->name('professorInicio');
    Route::get('/professor/perfil', [professorController::class, 'professorPerfil'])->name('professorPerfil');
    Route::get('/professor/meus-cursos', [professorController::class, 'professorMeusCursos'])->name('professorMeusCursos');
    Route::get('/professor/meu-curso/create', [professorController::class, 'professorMeuCursoCreatePage'])->name('professorMeuCursoCreatePage');
    Route::post('/professor/meu-curso/create', [professorController::class, 'professorMeuCursoCreate'])->name('professorMeuCursoCreate');
    Route::get('/professor/meu-curso/{id}', [professorController::class, 'professorMeuCurso'])->name('professorMeuCurso');
    Route::get('/professor/meus-cursos/edit/{id}', [professorController::class, 'professorMeuCursoEditPage'])->name('professorMeuCursoEditPage');
    Route::put('/professor/meus-cursos/edit/{id}', [professorController::class, 'professorMeuCursoEdit'])->name('professorMeuCursoEdit');
    Route::delete('/professor/meus-cursos/destroy/{id}', [professorController::class, 'professorMeuCursoDestroy'])->name('professorMeuCursoDestroy');

    Route::post('/professor/lesson/create/{id}', [professorController::class, 'professorLessonCreate'])->name('professorLessonCreate');
    Route::get('/professor/lesson/edit/{id}', [professorController::class, 'professorLessonEditPage'])->name('professorLessonEditPage');
    Route::put('/professor/lesson/edit/{id}', [professorController::class, 'professorLessonEdit'])->name('professorLessonEdit');
    Route::delete('/professor/lesson/destroy/{id}', [professorController::class, 'professorLessonDestroy'])->name('professorLessonDestroy');

    Route::get('/professor/student/{id}', [professorController::class, 'professorStudent'])->name('professorStudent');

    // Alunos
    Route::get('/aluno/inicio', [studentController::class, 'studentInicio'])->name('studentInicio');
    Route::get('/aluno/perfil', [studentController::class, 'studentPerfil'])->name('studentPerfil');
    Route::get('/aluno/meus-cursos', [studentController::class, 'studentMeusCursos'])->name('studentMeusCursos');
    Route::get('/aluno/meu-curso/{id}', [studentController::class, 'studentMeuCurso'])->name('studentMeuCurso');
    Route::get('/aluno/cursos', [studentController::class, 'studentCursos'])->name('studentCursos');
    Route::get('/aluno/curso/{id}', [studentController::class, 'studentCurso'])->name('studentCurso');

    Route::post('/aluno/matricula/{id}', [studentController::class, 'studentEnrollmentCreate'])->name('studentEnrollmentCreate');
    Route::delete('/aluno/matricula/destroy/{id}', [studentController::class, 'studentEnrollmentDestroy'])->name('studentEnrollmentDestroy');


    // -----------------------------------------------------------------------------------------------------------------------------------------------------

    // Professores
    Route::get('/professores', [professorsController::class, 'getPublicProfessors'])->name('professoresPublic');
    Route::get('/professor/{id}', [professorsController::class, 'getPublicProfessor'])->name('professorPublic');
});