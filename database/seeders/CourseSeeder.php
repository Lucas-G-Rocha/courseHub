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
        
        $professorId = Professor::where('name', '!=', 'João Silva')->take(10)->get();

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

        // 

        Course::create([
            'name' => 'PHP para Iniciantes',
            'description' => 'Aprenda os fundamentos da linguagem PHP e comece a desenvolver aplicações web.',
            'price' => 149.90,
            'workload' => 30,
            'professor_id' => $professorId[1]->id,
        ]);

        Course::create([
            'name' => 'JavaScript Moderno',
            'description' => 'Aprenda JavaScript moderno e desenvolva aplicações web interativas.',
            'price' => 179.90,
            'workload' => 35,
            'professor_id' => $professorId[2]->id,
        ]);

        Course::create([
            'name' => 'Banco de Dados com MySQL',
            'description' => 'Aprenda a modelar, criar e consultar bancos de dados relacionais utilizando MySQL.',
            'price' => 129.90,
            'workload' => 25,
            'professor_id' => $professorId[3]->id,
        ]);

        Course::create([
            'name' => 'Desenvolvimento de APIs REST',
            'description' => 'Aprenda a criar APIs RESTful utilizando boas práticas de desenvolvimento.',
            'price' => 219.90,
            'workload' => 40,
            'professor_id' => $professorId[4]->id,
        ]);

        Course::create([
            'name' => 'HTML e CSS do Zero',
            'description' => 'Aprenda a criar páginas web modernas utilizando HTML5 e CSS3.',
            'price' => 99.90,
            'workload' => 20,
            'professor_id' => $professorId[5]->id,
        ]);

        Course::create([
            'name' => 'Git e GitHub',
            'description' => 'Aprenda controle de versão com Git e gerenciamento de projetos utilizando GitHub.',
            'price' => 89.90,
            'workload' => 15,
            'professor_id' => $professorId[6]->id,
        ]);

        Course::create([
            'name' => 'Programação Orientada a Objetos',
            'description' => 'Aprenda os principais conceitos de orientação a objetos e sua aplicação no desenvolvimento de software.',
            'price' => 159.90,
            'workload' => 30,
            'professor_id' => $professorId[7]->id,
        ]);

        Course::create([
            'name' => 'Estruturas de Dados e Algoritmos',
            'description' => 'Aprenda estruturas de dados e algoritmos fundamentais para desenvolver soluções eficientes.',
            'price' => 189.90,
            'workload' => 40,
            'professor_id' => $professorId[8]->id,
        ]);

        Course::create([
            'name' => 'Engenharia de Software',
            'description' => 'Conheça os principais conceitos, metodologias e boas práticas da engenharia de software.',
            'price' => 169.90,
            'workload' => 35,
            'professor_id' => $professorId[9]->id,
        ]);


    }
}
