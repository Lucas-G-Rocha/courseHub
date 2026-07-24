<?php

namespace App\Http\Controllers;

use App\Models\Course;
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

        return view('admin.professorEdit', compact('professor'));
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
        }else{
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

