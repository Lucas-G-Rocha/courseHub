<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Professor;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professor = Professor::where('name', 'João Silva')->firstOrFail();

        Course::create([
            'name' => 'Laravel do Básico ao Avançado',
            'description' => 'Aprenda Laravel desde os fundamentos até recursos avançados do framework.',
            'price' => 199.90,
            'workload' => 40,
            'professor_id' => $professor->id,
        ]);

        Course::create([
            'name' => 'PHP Orientado a Objetos',
            'description' => 'Aprenda os principais conceitos de programação orientada a objetos com PHP.',
            'price' => 149.90,
            'workload' => 30,
            'professor_id' => $professor->id,
        ]);

    }
}
