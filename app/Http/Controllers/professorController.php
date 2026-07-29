<?php

namespace App\Http\Controllers;

use App\Http\Requests\professorLessonCreateRequest;
use App\Http\Requests\professorLessonEditRequest;
use App\Http\Requests\professorMeuCursoCreateRequest;
use App\Http\Requests\professorMeuCursoEditRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Professor;
use App\Models\Student;
use Illuminate\Http\Request;

class professorController extends Controller
{
    // Início
    public function professorInicio()
    {
        $user = auth()->user();
        $professor = $user->professor;
        $cursos = Course::count();
        $meusCursos = $professor->courses->count();

        return view('professor.inicio', compact('professor', 'cursos', 'meusCursos'));
    }

    // Perfil
    public function professorPerfil()
    {
        $user = auth()->user();
        $professor = $user->professor;
        return view('professor.perfil', compact('professor'));
    }

    // Cursos
    public function professorCursos()
    {
        return view('professor.cursos');
    }

    // Meus cursos
    public function professorMeusCursos()
    {
        $user = auth()->user();
        $professor = $user->professor;
        $cursos = Course::where('professor_id', $professor->id)->simplePaginate(15);
        return view('professor.meusCursos', compact('cursos'));
    }

    public function professorMeuCurso($id)
    {
        $user = auth()->user();
        $professor = $user->professor;
        $curso = $professor->courses()->where('id', $id)->first();
        if (!$curso) {
            return redirect()->route('professorMeusCursos')->with('fail', 'Curso não encontrado ou não autorizado');
        }
        return view('professor.meuCurso', compact('curso'));
    }

    // Página de criação de curso
    public function professorMeuCursoCreatePage()
    {
        return view('professor.meuCursoCreate');
    }

    // Criar curso
    public function professorMeuCursoCreate(professorMeuCursoCreateRequest $request)
    {
        $professor = auth()->user()->professor;
        $credentials = $request->validated();

        try {

            $createdCourse = Course::create([
                'name' => $credentials['name'],
                'professor_id' => $professor->id,
                'workload' => $credentials['workload'],
                'price' => $credentials['price'],
                'description' => $credentials['description'] ?? null,
            ]);

            return redirect()->route('professorMeusCursos')->with('success', 'Curso criado com Sucesso');
        } catch (\Exception $e) {
            return back()->with('fail', 'Erro ao criar curso')->withInput();

        }
    }

    // Página de edição de curso
    public function professorMeuCursoEditPage($id)
    {
        $curso = auth()->user()->professor->courses()->where('id', $id)->first();
        if ($curso) {
            return view('professor.meuCursoEdit', compact(['curso']));
        } else {
            return redirect()->route('professorMeuCursoEditPage', $id)->with('fail', 'Curso não encontrado!');
        }
    }

    // Editar curso
    public function professorMeuCursoEdit(professorMeuCursoEditRequest $request, $id)
    {
        $professor = auth()->user()->professor;
        $credentials = $request->validated();

        $updatedCourse = $professor->courses()->where(['id' => $id])->update([
            'name' => $credentials['name'],
            'description' => $credentials['description'],
            'price' => $credentials['price'],
            'workload' => $credentials['workload']
        ]);

        if ($updatedCourse) {
            return redirect()->route('professorMeuCurso', $id)->with('success', 'Curso Editado com Sucesso');
        } else {
            return back()->with('fail', 'Erro ao editar curso')->withInput();

        }
    }

    // Deletar curso
    public function professorMeuCursoDestroy($id)
    {
        $professor = auth()->user()->professor;
        $curso = $professor->courses()->where('id', $id)->first();

        if (!$curso) {

            return back()->with('fail', 'Curso não encontrado');
        }

        $isDeleted = $curso->destroy($id);

        if (!$isDeleted) {
            return back()->with('fail', 'Erro ao deletar Curso');
        }

        return redirect()->route('professorMeusCursos')->with('success', 'Curso deletado com sucesso!');
    }

    public function professorLessonCreate(professorLessonCreateRequest $request, $id)
    {
        $professor = auth()->user()->professor;

        $course = $professor->courses()
            ->where('id', $id)
            ->first();

        if (!$course) {
            return back()->with('fail', 'Curso não encontrado');
        }

        $credentials = $request->validated();

        try {

            $course->lessons()->create([
                'name' => $credentials['name'],
                'description' => $credentials['description'] ?? null,
                'content' => $credentials['content']
            ]);

            return back()->with('success', 'Lição criada com sucesso!');

        } catch (\Exception $e) {

            return back()
                ->with('fail', 'Erro ao criar lição')
                ->withInput();

        }
    }

    public function professorLessonEdit(professorLessonEditRequest $request, $id)
    {
        $professor = auth()->user()->professor;

        $lesson = Lesson::where('id', $id)
            ->whereHas('course', function ($query) use ($professor) {
                $query->where('professor_id', $professor->id);
            })
            ->first();

        if (!$lesson) {
            return back()->with('fail', 'Lição não encontrada');
        }

        $credentials = $request->validated();

        $updatedLesson = $lesson->update([
            'name' => $credentials['name'],
            'description' => $credentials['description'] ?? null,
            'content' => $credentials['content'],
        ]);

        if ($updatedLesson) {
            return back()->with('success', 'Lição atualizada!');
        }

        return back()->with('fail', 'Falha ao atualizar lição');
    }

    public function professorLessonDestroy($id)
    {
        $professor = auth()->user()->professor;

        $lesson = Lesson::where('id', $id)
            ->whereHas('course', function ($query) use ($professor) {
                $query->where('professor_id', $professor->id);
            })
            ->first();

        if (!$lesson) {
            return back()->with('fail', 'Lição não encontrada');
        }

        $deleted = $lesson->delete();

        if ($deleted) {
            return back()->with('success', 'Lição deletada com sucesso!');
        }

        return back()->with('fail', 'Erro ao deletar lição');
    }



    public function professorStudent($id)
    {
        $professor = auth()->user()->professor;

        $student = Student::where('id', $id)->whereHas('enrollments.course', function ($query) use ($professor) {
            $query->where('professor_id', $professor->id);
        })->first();

        if (!$student) {
            return back()->with('fail', 'Estudante não existe ou não está matriculado em seu curso');
        }

        $enrollments = $student->enrollments()->whereHas('course', function ($query) use ($professor) {
            $query->where('professor_id', $professor->id);
        })->get();
        return view('professor.student', compact('student', 'enrollments'));
    }
}

