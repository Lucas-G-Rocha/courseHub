<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;

class studentController extends Controller
{
    // Início
    public function studentInicio()
    {
        $user = auth()->user();
        $student = $user->student;

        $cursos = Course::count();
        $meusCursos = $student->enrollments->count();

        return view('student.inicio', compact('student', 'cursos', 'meusCursos'));
    }

    // Perfil
    public function studentPerfil()
    {
        $user = auth()->user();
        $student = $user->student;

        return view('student.perfil', compact('student'));
    }

    // Cursos
    public function studentCursos()
    {
        $cursos = Course::simplePaginate(10);
        return view('student.cursos', compact('cursos'));
    }

    public function studentCurso($id)
    {
        $curso = Course::find($id);
        $matricula = auth()->user()->student->enrollments()->where('course_id', $id)->first();

        if (!$curso) {
            return redirect()->back()->with('fail', 'Curso não encontrado');
        }

        return view('student.curso', compact('curso', 'matricula'));
    }

    // Meus cursos
    public function studentMeusCursos()
    {
        $user = auth()->user();
        $student = $user->student;

        $cursos = Course::whereHas('enrollments', function ($query) use ($student) {
            $query->where('student_id', $student->id);
        })->simplePaginate(15);

        return view('student.meusCursos', compact('cursos'));
    }

    // Meu curso
    public function studentMeuCurso($id)
    {
        $user = auth()->user();
        $student = $user->student;

        $curso = Course::whereHas('enrollments', function ($query) use ($student) {
            $query->where('student_id', $student->id);
        })->where('id', $id)->first();

        $matricula = $student->enrollments()->where([['course_id', $id], ['student_id', $student->id]])->first();


        if (!$curso) {
            return redirect()
                ->route('studentMeusCursos')
                ->with('fail', 'Curso não encontrado ou não autorizado');
        }

        return view('student.meuCurso', compact('curso', 'matricula'));
    }

    public function studentEnrollmentCreate($id)
    {
        if(!$id){
            return back()->with('fail', 'Ocorreu um erro inesperado');
        }

        $student = auth()->user()->student;
        if (!$student) {
            return back()->with('fail', 'Falha ao identificar usuário');
        }

        $curso = Course::find($id);

        if (!$curso) {
            return back()->with('fail', 'Curso Inválido');
        }

        $enrollmented = Enrollment::create([
            'course_id' => $curso->id,
            'student_id' => $student->id
        ]);

        if (!$enrollmented) {
            return back()->with('fail', 'Falha ao se matricular');
        }

        return back()->with('success', 'Matrícula realizada com sucesso');
    }

    public function studentEnrollmentDestroy($id)
    {
        $student = auth()->user()->student;

        if (!$student) {
            return back()->with('fail', 'Erro ao identificar usuário');
        }

        $isDestroyed = $student->enrollments()->where('course_id', $id)->delete();
        if (!$isDestroyed) {
            return back()->with('fail', 'Erro ao deletar matrícula');
        }

        return redirect()->route('studentMeusCursos')->with('success', 'Matricula deletada com sucesso!');
    }
}
