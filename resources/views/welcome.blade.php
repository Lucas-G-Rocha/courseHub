@extends('layout.main')

@section('title', 'CouseHub')


@section('content')

<div class="container">

    {{-- Hero --}}
    <div class="py-5 text-center">
        <h1 class="display-4 fw-bold">
            Bem-vindo ao <span class="text-primary">CourseHub</span>
        </h1>

        <p class="lead text-muted mt-3">
            Aprenda novas habilidades, acompanhe seu progresso
            e evolua com cursos desenvolvidos para você.
        </p>

        <div class="mt-4">
            <a href="{{ route('cursosPublic') }}" class="btn btn-primary btn-lg">
                Explorar cursos
            </a>

            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg ms-2">
                    Entrar
                </a>
            @endguest
        </div>
    </div>

    {{-- Destaques --}}
    <div class="row g-4 py-5">

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <h3 class="h5">📚 Cursos de qualidade</h3>

                    <p class="text-muted mt-3 mb-0">
                        Encontre cursos organizados para aprender
                        de forma simples e progressiva.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <h3 class="h5">🎯 Aprenda no seu ritmo</h3>

                    <p class="text-muted mt-3 mb-0">
                        Acesse suas aulas e avance pelo conteúdo
                        de acordo com o seu próprio ritmo.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <h3 class="h5">🚀 Evolua constantemente</h3>

                    <p class="text-muted mt-3 mb-0">
                        Desenvolva seus conhecimentos e conquiste
                        novas habilidades através do aprendizado.
                    </p>
                </div>
            </div>
        </div>

    </div>

    {{-- Chamada final --}}
    <div class="bg-light rounded-3 p-5 text-center my-5">
        <h2 class="fw-bold">Comece a aprender hoje</h2>

        <p class="text-muted mt-3">
            Explore nosso catálogo de cursos e encontre
            o próximo assunto que você quer dominar.
        </p>

        <a href="{{ route('cursosPublic') }}" class="btn btn-primary mt-2">
            Ver cursos
        </a>
    </div>

</div>

@endsection