<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = $request->route()->getName();
        $routeRequirements = [
            // =========================
            // ADMIN
            // =========================

            'adminInicio' => [
                'permissions' => [
                    'read_admin',
                    'read_professor',
                    'read_student',
                    'read_course'
                ],
                'roles' => ['admin']
            ],

            'adminPerfil' => [
                'permissions' => [
                    'read_admin',
                    'update_admin'
                ],
                'roles' => ['admin']
            ],

            // Professores
            'adminProfessores' => [
                'permissions' => [
                    'read_professor'
                ],
                'roles' => ['admin']
            ],

            'adminProfessorCreatePage' => [
                'permissions' => [
                    'create_professor'
                ],
                'roles' => ['admin']
            ],

            'adminProfessorCreate' => [
                'permissions' => [
                    'create_professor'
                ],
                'roles' => ['admin']
            ],

            'adminProfessor' => [
                'permissions' => [
                    'read_professor',
                    'read_course',
                ],
                'roles' => ['admin']
            ],

            'adminProfessorEditPage' => [
                'permissions' => [
                    'read_professor',
                    'update_professor'
                ],
                'roles' => ['admin']
            ],

            'adminProfessorEdit' => [
                'permissions' => [
                    'read_professor',
                    'update_professor'
                ],
                'roles' => ['admin']
            ],

            'adminProfessorDestroy' => [
                'permissions' => [
                    'delete_professor'
                ],
                'roles' => ['admin']
            ],


            // Cursos
            'adminCursos' => [
                'permissions' => [
                    'read_course',
                ],
                'roles' => ['admin']
            ],

            'adminCursoCreatePage' => [
                'permissions' => [
                    'create_course'
                ],
                'roles' => ['admin']
            ],

            'adminCursoCreate' => [
                'permissions' => [
                    'create_course'
                ],
                'roles' => ['admin']
            ],

            'adminCurso' => [
                'permissions' => [
                    'read_course',
                    'read_lesson',
                    'read_enrollment',
                ],
                'roles' => ['admin']
            ],

            'adminCursoEditPage' => [
                'permissions' => [
                    'read_course',
                    'update_course'
                ],
                'roles' => ['admin']
            ],

            'adminCursoEdit' => [
                'permissions' => [
                    'read_course',
                    'update_course'
                ],
                'roles' => ['admin']
            ],

            'adminCursoDestroy' => [
                'permissions' => [
                    'delete_course'
                ],
                'roles' => ['admin']
            ],


            // Lessons
            'adminLessonCreate' => [
                'permissions' => [
                    'create_lesson'
                ],
                'roles' => ['admin']
            ],

            'adminLessonDestroy' => [
                'permissions' => [
                    'delete_lesson'
                ],
                'roles' => ['admin']
            ],

            'adminLessonEdit' => [
                'permissions' => [
                    'read_lesson',
                    'update_lesson'
                ],
                'roles' => ['admin']
            ],


            // Alunos
            'adminStudents' => [
                'permissions' => [
                    'read_student',
                ],
                'roles' => ['admin']
            ],

            'adminStudentCreatePage' => [
                'permissions' => [
                    'create_student'
                ],
                'roles' => ['admin']
            ],

            'adminStudent' => [
                'permissions' => [
                    'read_student',
                    'read_enrollment',
                ],
                'roles' => ['admin']
            ],

            'adminStudentEditPage' => [
                'permissions' => [
                    'read_student',
                    'update_student'
                ],
                'roles' => ['admin']
            ],

            'adminStudentEdit' => [
                'permissions' => [
                    'read_student',
                    'update_student'
                ],
                'roles' => ['admin']
            ],

            'adminStudentDestroy' => [
                'permissions' => [
                    'delete_student'
                ],
                'roles' => ['admin']
            ],


            // Matrículas
            'adminEnrollmentCreate' => [
                'permissions' => [
                    'create_enrollment'
                ],
                'roles' => ['admin']
            ],

            'adminEnrollmentDestroy' => [
                'permissions' => [
                    'delete_enrollment'
                ],
                'roles' => ['admin']
            ],


            // =========================
            // PROFESSOR
            // =========================

            'professorInicio' => [
                'permissions' => [
                    'read_professor',
                    'read_course',
                ],
                'roles' => ['professor']
            ],

            'professorPerfil' => [
                'permissions' => [
                    'read_professor',
                    'update_professor'
                ],
                'roles' => ['professor']
            ],

            'professorMeusCursos' => [
                'permissions' => [
                    'read_course',
                ],
                'roles' => ['professor']
            ],

            'professorMeuCursoCreatePage' => [
                'permissions' => [
                    'create_course'
                ],
                'roles' => ['professor']
            ],

            'professorMeuCursoCreate' => [
                'permissions' => [
                    'create_course'
                ],
                'roles' => ['professor']
            ],

            'professorMeuCurso' => [
                'permissions' => [
                    'read_course',
                    'read_lesson',
                    'read_student'
                ],
                'roles' => ['professor']
            ],

            'professorMeuCursoEditPage' => [
                'permissions' => [
                    'read_course',
                    'update_course'
                ],
                'roles' => ['professor']
            ],

            'professorMeuCursoEdit' => [
                'permissions' => [
                    'read_course',
                    'update_course'
                ],
                'roles' => ['professor']
            ],

            'professorMeuCursoDestroy' => [
                'permissions' => [
                    'delete_course'
                ],
                'roles' => ['professor']
            ],


            // Lessons
            'professorLessonCreate' => [
                'permissions' => [
                    'create_lesson'
                ],
                'roles' => ['professor']
            ],

            'professorLessonEditPage' => [
                'permissions' => [
                    'read_lesson',
                    'update_lesson'
                ],
                'roles' => ['professor']
            ],

            'professorLessonEdit' => [
                'permissions' => [
                    'read_lesson',
                    'update_lesson'
                ],
                'roles' => ['professor']
            ],

            'professorLessonDestroy' => [
                'permissions' => [
                    'delete_lesson'
                ],
                'roles' => ['professor']
            ],


            // Alunos
            'professorStudent' => [
                'permissions' => [
                    'read_student'
                ],
                'roles' => ['professor']
            ],


            // =========================
            // ALUNO
            // =========================

            'studentInicio' => [
                'permissions' => [
                    'read_student',
                    'read_course'
                ],
                'roles' => ['student']
            ],

            'studentPerfil' => [
                'permissions' => [
                    'read_student',
                    'update_student'
                ],
                'roles' => ['student']
            ],

            'studentMeusCursos' => [
                'permissions' => [
                    'read_course'
                ],
                'roles' => ['student']
            ],

            'studentMeuCurso' => [
                'permissions' => [
                    'read_course',
                    'read_lesson',
                ],
                'roles' => ['student']
            ],

            'studentCursos' => [
                'permissions' => [
                    'read_course'
                ],
                'roles' => ['student']
            ],

            'studentCurso' => [
                'permissions' => [
                    'read_course',
                ],
                'roles' => ['student']
            ],


            // Matrículas
            'studentEnrollmentCreate' => [
                'permissions' => [
                    'create_enrollment'
                ],
                'roles' => ['student']
            ],

            'studentEnrollmentDestroy' => [
                'permissions' => [
                    'delete_enrollment'
                ],
                'roles' => ['student']
            ],
        ];



        if (!isset($routeRequirements[$routeName])) {
            return $next($request);
        } elseif (!Auth::check()) {
            return redirect()->back()->with('fail', 'Não possui permissão');
        }

        $user = auth()->user();
        $role = $user->role;
        $permissions = $user->role->permissions->pluck('name')->toArray();


        $protectedRoute = isset($routeRequirements[$routeName]);



        if (!$protectedRoute) {
            return $next($request);
        }

        $requirements = $routeRequirements[$routeName];

        if (in_array($role->name, $requirements['roles']) && empty(array_diff($requirements['permissions'], $permissions))) {
            return $next($request);
        }

        return redirect()->back()->with('fail', 'Usuário não autorizado');

    }

}
