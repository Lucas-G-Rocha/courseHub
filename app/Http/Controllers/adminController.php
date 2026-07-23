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
        $professores = Professor::query()->when($request->name, function ($query) use ($request) {
            $query->where("name", "like", "%{$request->name}%");
        })->simplePaginate(15);

        $professores->appends($request->query());
        return view('admin.professores', compact(['professores']));
    }

    public function adminProfessorCreatePage()
    {

    }

    public function adminProfessor($id)
    {

    }

    public function adminProfessorEditPage($id){
        
    }

    public function adminCursos()
    {

    }

    public function adminStudents()
    {

    }

    public function adminStudentCreate()
    {

    }
}
