@extends('layout.main')

@section('title', 'Aluno | CourseHub')

@section('content')

    <div class="container py-5">

        <h1 class="mb-5">Dashboard do Aluno</h1>

        <div class="row g-4">

            {{-- Perfil --}}
            <div class="col-12">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <h2 class="card-title h4">Meu Perfil</h2>

                        <div class="row">

                            <div class="col-md-6">

                                <p class="mb-1">
                                    <strong>Nome:</strong> {{ $student->name }}
                                </p>

                                <p class="mb-3">
                                    <strong>Email:</strong> {{ $student->email }}
                                </p>

                            </div>

                        </div>

                        <a href="{{ route('studentPerfil') }}" class="btn btn-primary">
                            Ver perfil
                        </a>

                    </div>

                </div>

            </div>


            {{-- Cursos no geral --}}
            <div class="col-12 col-lg-6">

                <div class="card shadow-sm h-100">

                    <div class="card-body d-flex flex-column">

                        <h2 class="card-title h4">Cursos</h2>

                        <p class="text-muted">
                            Consulte os cursos disponíveis na plataforma.
                        </p>

                        <div class="mb-4">

                            <p class="mb-1">
                                <strong>Total de cursos:</strong>
                                {{ $cursos }}
                            </p>

                        </div>

                        <div class="mt-auto d-flex gap-2 flex-wrap">

                            <a href="{{ route('studentCursos') }}" class="btn btn-primary">
                                Ver cursos
                            </a>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Meus Cursos --}}
            <div class="col-12 col-lg-6">

                <div class="card shadow-sm h-100">

                    <div class="card-body d-flex flex-column">

                        <h2 class="card-title h4">Meus Cursos</h2>

                        <p class="text-muted">
                            Acesse os cursos em que você está matriculado.
                        </p>

                        <div class="mb-4">

                            <p class="mb-1">
                                <strong>Total de cursos:</strong>
                                {{ $meusCursos }}
                            </p>

                        </div>

                        <div class="mt-auto d-flex gap-2 flex-wrap">

                            <a href="{{ route('studentMeusCursos') }}" class="btn btn-primary">
                                Ver meus cursos
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection