<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Professor;
use App\Models\Student;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function adminInicio()
    {
        $admin = auth()->user();

        $professores = Professor::count();
        $cursos = Course::count();
        $alunos = Student::count();

        return view('admin.inicio', compact(['admin', 'professores', 'cursos', 'alunos']));
    }

    public function adminPerfil()
    {
        $admin = auth()->user();

        return view('admin.perfil', compact(['admin']));

    }

    public function adminProfessores(Request $request)
    {
        $professores = Professor::query()->when($request->search, function ($query) use ($request) {
            $query->where("name", "like", "%{$request->search}%");
        })->simplePaginate(15);

        $professores->appends($request->query());
        return view('admin.professores', compact(['professores']));
    }

    public function adminProfessorCreatePage()
    {
        return view('admin.professorCreate');
    }
    public function adminProfessorCreate()
    {

    }

    public function adminProfessor($id)
    {

    }

    public function adminProfessorEditPage($id)
    {

    }

    public function adminCursos(Request $request)
    {
        $cursos = Course::query()->when($request->search, function ($query) use ($request) {
            $query->where("name", "like", "%{$request->search}%");
        })->simplePaginate(10);

        $cursos->appends($request->query());
        return view('admin.cursos', compact('cursos'));
    }

    public function adminCurso()
    {

    }

    public function adminCursoEditPage($id)
    {

    }

    public function adminCursoDestroy($id)
    {

    }

    public function adminStudents(Request $request)
    {
        $students = Student::query()->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->search}%");
        })->simplePaginate(10);

        $students->appends($request->query());
        return view('admin.alunos', compact('students'));
    }

    public function adminStudent($id)
    {
        $student = Student::findOrFail($id)->firstOrFail();

        return view('admin.aluno', compact('student'));
    }

    public function adminStudentCreatePage()
    {

    }

    public function adminStudentEditPage()
    {

    }

}

