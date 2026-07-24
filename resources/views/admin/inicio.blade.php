@extends('layout.main')

@section('title', 'Admin | CourseHub')


@section('content')

    <div class="container py-5">

        <h1 class="mb-5">Dashboard Administrativo</h1>

        <div class="row g-4">

            {{-- Admin --}}
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h4">Admin</h2>

                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1">
                                    <strong>Nome:</strong> {{ $admin->name }}
                                </p>

                                <p class="mb-3">
                                    <strong>Email:</strong> {{ $admin->email }}
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('adminPerfil') }}" class="btn btn-primary">
                            Ver perfil
                        </a>
                    </div>
                </div>
            </div>


            {{-- Professores --}}
            <div class="col-12 col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">

                        <h2 class="card-title h4">Professores</h2>

                        <p class="text-muted">
                            Gerencie os professores cadastrados na plataforma.
                        </p>

                        <div class="mb-4">
                            <p class="mb-1">
                                <strong>Total de professores:</strong>
                                {{ $professores }}
                            </p>

                        </div>

                        <div class="mt-auto d-flex gap-2 flex-wrap">
                            <a href="{{ route('adminProfessores') }}"
                               class="btn btn-primary">
                                Ver professores
                            </a>

                            <a href="{{ route('adminProfessorCreatePage') }}"
                               class="btn btn-success">
                                Cadastrar professor
                            </a>
                        </div>

                    </div>
                </div>
            </div>


            {{-- Cursos --}}
            <div class="col-12 col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">

                        <h2 class="card-title h4">Cursos</h2>

                        <p class="text-muted">
                            Gerencie os cursos disponíveis na plataforma.
                        </p>

                        <div class="mb-4">
                            <p class="mb-1">
                                <strong>Total de cursos:</strong>
                                {{ $cursos }}
                            </p>

                            
                        </div>

                        <div class="mt-auto d-flex gap-2 flex-wrap">
                            <a href="{{ route('adminCursos') }}"
                               class="btn btn-primary">
                                Ver cursos
                            </a>

                            <a href="{{ route('adminCursoCreatePage') }}"
                               class="btn btn-success">
                                Cadastrar curso
                            </a>
                        </div>

                    </div>
                </div>
            </div>


            {{-- Alunos --}}
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h2 class="card-title h4">Alunos</h2>

                        <p class="text-muted">
                            Consulte e gerencie os alunos cadastrados na plataforma.
                        </p>

                        <div class="row mb-4">

                            <div class="col-md-4">
                                <p class="mb-1">
                                    <strong>Total de alunos:</strong>
                                    {{ $alunos }}
                                </p>
                            </div>

                            <div class="col-md-4">
                                <p class="mb-1">
                                    <strong>Alunos ativos:</strong>
                                    {{ $alunosAtivos ?? 0 }}
                                </p>
                            </div>

                            <div class="col-md-4">
                                <p class="mb-1">
                                    <strong>Novos alunos:</strong>
                                    {{ $novosAlunos ?? 0 }}
                                </p>
                            </div>

                        </div>

                        <div class="d-flex gap-2 flex-wrap">

                            <a href="{{ route('adminStudents') }}"
                               class="btn btn-primary">
                                Ver alunos
                            </a>

                            <a href="{{ route('adminStudentCreatePage') }}"
                               class="btn btn-success">
                                Cadastrar aluno
                            </a>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection