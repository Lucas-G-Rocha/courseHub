<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $maria = Student::where(
            'email',
            'maria.santos@example.com'
        )->firstOrFail();

        $pedro = Student::where(
            'email',
            'pedro.almeida@example.com'
        )->firstOrFail();

        $laravel = Course::where(
            'name',
            'Laravel do Básico ao Avançado'
        )->firstOrFail();

        $php = Course::where(
            'name',
            'PHP Orientado a Objetos'
        )->firstOrFail();

        // Maria está matriculada em Laravel
        Enrollment::create([
            'student_id' => $maria->id,
            'course_id' => $laravel->id,
            'status' => true,
            'enrolled_at' => now()->subDays(20),
        ]);

        // Maria também está matriculada em PHP
        Enrollment::create([
            'student_id' => $maria->id,
            'course_id' => $php->id,
            'status' => true,
            'enrolled_at' => now()->subDays(10),
        ]);

        // Pedro está matriculado em Laravel
        Enrollment::create([
            'student_id' => $pedro->id,
            'course_id' => $laravel->id,
            'status' => true,
            'enrolled_at' => now()->subDays(15),
        ]);

        // Pedro possui uma matrícula inativa
        Enrollment::create([
            'student_id' => $pedro->id,
            'course_id' => $php->id,
            'status' => false,
            'enrolled_at' => now()->subDays(30),
        ]);

    }
}
