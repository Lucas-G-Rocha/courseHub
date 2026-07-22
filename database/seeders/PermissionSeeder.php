<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        Permission::create([
            'name' => 'create_admin',
            'description' => 'Cadastrar um administrador',
        ]);

        Permission::create([
            'name' => 'read_admin',
            'description' => 'Visualizar administradores',
        ]);

        Permission::create([
            'name' => 'update_admin',
            'description' => 'Atualizar dados de um administrador',
        ]);

        Permission::create([
            'name' => 'delete_admin',
            'description' => 'Excluir um administrador',
        ]);

        // Professor
        Permission::create([
            'name' => 'create_professor',
            'description' => 'Cadastrar um professor',
        ]);

        Permission::create([
            'name' => 'read_professor',
            'description' => 'Visualizar professores',
        ]);

        Permission::create([
            'name' => 'update_professor',
            'description' => 'Atualizar dados de um professor',
        ]);

        Permission::create([
            'name' => 'delete_professor',
            'description' => 'Excluir um professor',
        ]);

        // Student
        Permission::create([
            'name' => 'create_student',
            'description' => 'Cadastrar um aluno',
        ]);

        Permission::create([
            'name' => 'read_student',
            'description' => 'Visualizar alunos',
        ]);

        Permission::create([
            'name' => 'update_student',
            'description' => 'Atualizar dados de um aluno',
        ]);

        Permission::create([
            'name' => 'delete_student',
            'description' => 'Excluir um aluno',
        ]);

        // Course
        Permission::create([
            'name' => 'create_course',
            'description' => 'Cadastrar um curso',
        ]);

        Permission::create([
            'name' => 'read_course',
            'description' => 'Visualizar cursos',
        ]);

        Permission::create([
            'name' => 'update_course',
            'description' => 'Atualizar dados de um curso',
        ]);

        Permission::create([
            'name' => 'delete_course',
            'description' => 'Excluir um curso',
        ]);

        // Lesson
        Permission::create([
            'name' => 'create_lesson',
            'description' => 'Cadastrar uma aula',
        ]);

        Permission::create([
            'name' => 'read_lesson',
            'description' => 'Visualizar aulas',
        ]);

        Permission::create([
            'name' => 'update_lesson',
            'description' => 'Atualizar dados de uma aula',
        ]);

        Permission::create([
            'name' => 'delete_lesson',
            'description' => 'Excluir uma aula',
        ]);

        // Enrollment
        Permission::create([
            'name' => 'create_enrollment',
            'description' => 'Realizar uma matrícula',
        ]);

        Permission::create([
            'name' => 'read_enrollment',
            'description' => 'Visualizar matrículas',
        ]);

        Permission::create([
            'name' => 'update_enrollment',
            'description' => 'Atualizar uma matrícula',
        ]);

        Permission::create([
            'name' => 'delete_enrollment',
            'description' => 'Cancelar ou excluir uma matrícula',
        ]);
    }
}
