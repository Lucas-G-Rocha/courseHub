<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $laravel = Course::where(
            'name',
            'Laravel do Básico ao Avançado'
        )->firstOrFail();

        $php = Course::where(
            'name',
            'PHP Orientado a Objetos'
        )->firstOrFail();

        // Aulas do curso de Laravel

        Lesson::create([
            'name' => 'Introdução ao Laravel',
            'description' => 'Conhecendo o framework e sua estrutura básica.',
            'content' => 'Nesta aula você aprenderá os fundamentos do Laravel, sua arquitetura e os principais diretórios de um projeto.',
            'course_id' => $laravel->id,
        ]);

        Lesson::create([
            'name' => 'Rotas',
            'description' => 'Aprendendo a criar e configurar rotas.',
            'content' => 'Nesta aula veremos como criar rotas GET, POST, PUT e DELETE, além de trabalhar com parâmetros e nomes de rotas.',
            'course_id' => $laravel->id,
        ]);

        Lesson::create([
            'name' => 'Controllers',
            'description' => 'Organizando a lógica da aplicação com Controllers.',
            'content' => 'Nesta aula você aprenderá a criar Controllers e utilizar seus métodos para processar requisições.',
            'course_id' => $laravel->id,
        ]);

        Lesson::create([
            'name' => 'Models e Eloquent',
            'description' => 'Trabalhando com Models e banco de dados.',
            'content' => 'Nesta aula você aprenderá a utilizar o Eloquent ORM para consultar, criar, atualizar e excluir registros.',
            'course_id' => $laravel->id,
        ]);

        // Aulas do curso de PHP

        Lesson::create([
            'name' => 'Introdução à Orientação a Objetos',
            'description' => 'Conhecendo os fundamentos da programação orientada a objetos.',
            'content' => 'Nesta aula serão apresentados os conceitos de classes, objetos, atributos e métodos.',
            'course_id' => $php->id,
        ]);

        Lesson::create([
            'name' => 'Herança',
            'description' => 'Aprendendo a reutilizar código através de herança.',
            'content' => 'Nesta aula você aprenderá como criar classes que herdam comportamentos e características de outras classes.',
            'course_id' => $php->id,
        ]);

        Lesson::create([
            'name' => 'Interfaces',
            'description' => 'Utilizando interfaces para definir contratos.',
            'content' => 'Nesta aula veremos como criar interfaces e como utilizá-las para definir comportamentos que devem ser implementados pelas classes.',
            'course_id' => $php->id,
        ]);

        Lesson::create([
            'name' => 'Polimorfismo',
            'description' => 'Entendendo o polimorfismo na programação orientada a objetos.',
            'content' => 'Nesta aula você aprenderá como diferentes objetos podem responder de maneiras diferentes à mesma chamada de método.',
            'course_id' => $php->id,
        ]);

    }
}
