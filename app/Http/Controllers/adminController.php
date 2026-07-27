<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Professor;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use DB;
use Hash;
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
    public function adminProfessorCreate(Request $request)
    {
        // 1. Trata o checkbox/flag corretamente (retorna true ou false)
        $createUser = $request->boolean('create_user');

        // 2. Monta as regras de validação dinamicamente
        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email'],
            'bio' => ['nullable', 'string', 'max:255'],
        ];

        if ($createUser) {
            $rules['password'] = ['required', 'min:5', 'max:12', 'confirmed'];
        }

        $credentials = $request->validate($rules);

        // 3. Transaction tratada com try/catch
        try {
            DB::transaction(function () use ($credentials, $createUser) {
                $userId = null;

                // Se for para criar o usuário primeiro
                if ($createUser) {

                    $roleId = Role::where('name', 'professor')->firstOrFail()->id;
                    $user = User::create([
                        'name' => $credentials['name'],
                        'email' => $credentials['email'],
                        'password' => Hash::make($credentials['password']),
                        'role_id' => $roleId,
                    ]);

                    $userId = $user->id;
                }

                // Cria o professor
                Professor::create([
                    'name' => $credentials['name'],
                    'email' => $credentials['email'],
                    'bio' => $credentials['bio'] ?? null,
                    'user_id' => $userId,
                ]);
            });

            return back()->with('success', 'Professor Cadastrado com Sucesso');

        } catch (\Throwable $e) {
            return back()->with('fail', 'Erro ao Cadastrar Professor.' . $e->getMessage())->withInput();
        }
    }

    public function adminProfessor($id)
    {
        $professor = Professor::findOrFail($id);


        return view('admin.professor', compact('professor'));
    }

    public function adminProfessorEditPage($id)
    {
        $professor = Professor::findOrFail($id);

        if ($professor) {
            return view('admin.professorEdit', compact('professor'));

        } else {
            return redirect()->route('adminProfessor', $id)->with('fail', 'Professor não encontrado');
        }
    }

    public function adminProfessorEdit(Request $request, $id)
    {
        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email'],
            'bio' => ['nullable', 'string', 'max:255'],
        ];

        $professor = Professor::findOrFail($id);

        if ($professor->user) {
            $rules['password'] = ['nullable', 'min:5', 'max:12', 'confirmed'];
            $rules['user_name'] = ['required', 'string', 'min:3', 'max:100'];
            $rules['user_email'] = ['required', 'email'];
        }

        $credentials = $request->validate($rules);


        try {
            DB::transaction(function () use ($credentials, $professor) {
                $professor->update([
                    'name' => $credentials['name'] ?? $professor->name,
                    'email' => $credentials['email'] ?? $professor->email,
                    'bio' => $credentials['bio'] ?? $professor->bio,
                ]);
                if ($professor->user) {
                    $userData = [
                        'name' => $credentials['user_name'] ?? $professor->user->name,
                        'email' => $credentials['user_email'] ?? $professor->user->email,
                    ];

                    if (!empty($credentials['password'])) {
                        $userData['password'] = Hash::make($credentials['password']);
                    }

                    $professor->user->update($userData);
                }

            });

            return redirect()->route('adminProfessor', $professor->id)->with('success', 'Professor Editado com Sucesso');

        } catch (\Exception $e) {

        }
    }

    public function adminProfessorDestroy($id)
    {
        $professor = Professor::destroy($id);
        if ($professor) {

            return redirect()->route('adminProfessores')->with('success', 'Professor e seus cursos deletados com sucesso!');
        } else {
            return back()->with('fail', 'Erro ao deletar professor e seus cursos');
        }
    }

    public function adminCursos(Request $request)
    {
        $cursos = Course::query()->when($request->search, function ($query) use ($request) {
            $query->where("name", "like", "%{$request->search}%");
        })->simplePaginate(10);

        $cursos->appends($request->query());
        return view('admin.cursos', compact('cursos'));
    }

    public function adminCurso($id)
    {
        $curso = Course::find($id);
        $alunos = Student::all();
        if ($curso) {
            return view('admin.curso', compact('curso', 'alunos'));
        } else {
            return redirect()->route('adminCursos')->with('fail', 'Curso não encontrado!');
        }
    }

    public function adminCursoCreatePage()
    {
        $professores = Professor::all();

        return view('admin.cursoCreate', compact('professores'));
    }

    public function adminCursoCreate(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'professor_id' => ['required', 'integer', 'min:1'],
            'workload' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string']
        ]);

        $professorExists = Professor::where('id', $request->professor_id)->exists();
        if (!$professorExists) {
            return back()->with('fail', 'Professor inválido')->withInput();
        }
        try {

            $createdCourse = Course::create([
                'name' => $credentials['name'],
                'professor_id' => $credentials['professor_id'],
                'workload' => $credentials['workload'],
                'price' => $credentials['price'],
                'description' => $credentials['description'] ?? null,
            ]);

            return redirect()->route('adminCursos')->with('success', 'Curso criado com Sucesso');
        } catch (\Exception $e) {
            return back()->with('fail', 'Erro ao criar curso')->withInput();

        }
    }

    public function adminCursoEditPage($id)
    {
        $curso = Course::find($id);
        $professores = Professor::all();
        if ($curso) {
            return view('admin.cursoEdit', compact(['curso', 'professores']));
        } else {
            return redirect()->route('adminCurso', $id)->with('fail', 'Curso não encontrado!');

        }
    }

    public function adminCursoEdit(Request $request, $id)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['required'],
            'workload' => ['required'],
            'professor_id' => ['nullable']
        ]);

        $professorExists = Professor::where('id', $id)->exists();

        if (!$professorExists) {
            return back()->with('fail', 'ID do professor inválido')->withInput();
        }

        $updatedCourse = Course::where('id', $id)->update([
            'name' => $credentials['name'],
            'description' => $credentials['description'],
            'price' => $credentials['price'],
            'workload' => $credentials['workload'],
            'professor_id' => $credentials['professor_id'],
        ]);

        if ($updatedCourse) {
            return redirect()->route('adminCurso', $id)->with('success', 'Curso Editado com Sucesso');
        } else {
            return back()->with('fail', 'Erro ao editar curso')->withInput();

        }
    }

    public function adminCursoDestroy($id)
    {
        $delete = Course::destroy($id);
        if ($delete) {
            return redirect()->route('adminCursos')->with('success', 'Curso e associados deletados com sucesso');
        } else {
            return back()->with('fail', 'Erro ao deletar curso e associados');
        }

    }

    public function adminLessonCreate(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return back()->with('fail', 'Curso não encontrado');
        }

        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'content' => ['required', 'string']
        ]);
        try {
            Lesson::create([
                'name' => $credentials['name'],
                'description' => $credentials['description'] ?? null,
                'content' => $credentials['content'],
                'course_id' => $course->id,
            ]);

            return back()->with('success', 'Lição criada com sucesso!');
        } catch (\Exception $e) {

            return back()->with('fail', 'Erro ao criar Lição')->withInput();
        }

    }

    public function adminLessonDestroy($id)
    {
        $delete = Lesson::destroy($id);
        if ($delete) {
            return back()->with('success', 'Lição deletada com sucesso!');
        } else {
            return back()->with('fail', 'Erro ao deletar Lição');
        }

    }

    public function adminLessonEdit(Request $request, $id)
    {
        $lesson = Lesson::where('id', $id)->exists();

        if (!$lesson) {
            return back()->with('fail', 'Lição não existe');
        }

        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'content' => ['required', 'string']
        ]);

        $updatedLesson = Lesson::where('id', $id)->update([
            'name' => $credentials['name'],
            'description' => $credentials['description'] ?? null,
            'content' => $credentials['content']
        ]);

        if ($updatedLesson) {
            return back()->with('success', 'Lição atualizada!');
        } else {
            return back()->with('fail', 'Falha ao atualizar lição');
        }

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
        $aluno = Student::find($id);
        if (!$aluno) {
            return redirect()->route('adminStudents')->with('fail', 'Aluno inválido');
        }

        return view('admin.aluno', compact('aluno'));
    }

    public function adminStudentCreatePage()
    {

    }

    public function adminStudentEditPage($id)
    {
        $aluno = Student::find($id);

        if (!$aluno) {
            return redirect()->route('adminStudents')->with('fail', 'Estudante Não encontrado!');
        }

        return view('admin.alunoEdit', compact('aluno'));
    }

    public function adminStudentEdit(Request $request, $id)
    {
        $aluno = Student::find($id);

        if (!$aluno) {
            return back()->with('fail', 'Estudante Não encontrado!')->withInput();
        }

        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'birth_date' => ['required'],
        ]);

        $updatedStudent = Student::where('id', $id)->update([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'birth_date' => $credentials['birth_date']
        ]);

        if ($updatedStudent) {
            return redirect()->route('adminStudent', $id)->with('success', 'Aluno atualizado!');
        } else {
            return back()->with('fail', 'Erro ao atualizar Aluno')->withinput();
        }
    }

    public function adminStudentDestroy($id)
    {
        $deletedStudent = Student::destroy($id);

        if ($deletedStudent) {
            return redirect()->route('adminStudents')->with('success', 'Aluno e matriculas deletadas!');
        } else {
            return back()->with('fail', 'Ocorreu um erro ao deletar aluno');
        }
    }

    public function adminEnrollmentCreate(Request $request)
    {

        $credentials = $request->validate([
            'student_id' => ['required', 'integer', 'min:1'],
            'course_id' => ['required', 'integer', 'min:1'],
        ]);

        $student = Student::find($credentials['student_id']);
        if (!$student) {
            return back()->with('fail', 'Estudante Inválido');
        }

        $course = Course::find($credentials['course_id']);
        if (!$course) {
            return back()->with('fail', 'Curso Inválido');
        }

        $isCreated = Enrollment::create([
            'student_id' => $credentials['student_id'],
            'course_id' => $credentials['course_id']
        ]);

        if (!$isCreated) {
            return back()->with('fail', 'Erro ao cadastrar Inscrição!');
        }

        return back()->with('success', 'Inscrição Cadastrada!');
    }

    public function adminEnrollmentDestroy($id)
    {
        $isDestroyed = Enrollment::destroy($id);

        if ($isDestroyed) {
            return back()->with('success', 'Inscrição Deletada');
        } else {
            return back()->with('fail', 'Erro ao deletar inscrição');
        }
    }

}
