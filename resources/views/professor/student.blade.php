@extends('layout.main')

@section('title', 'Aluno: ' . $student->name)

@section('content')

    <div class="container-fluid d-flex flex-column row-gap-4 mt-5 ps-5">

        {{-- Cabeçalho --}}
        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h3 class="fs-2 mb-2">
                    {{ $student->name }}
                </h3>

                <p class="fs-5 mb-1">
                    Email: {{ $student->email }}
                </p>

                <p class="fs-5 mb-1">
                    Data de nascimento:
                    {{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}
                </p>

                <p class="fs-5 mb-0">
                    Cursos matriculados: {{ $student->enrollments->count() }}
                </p>

            </div>

        </div>


        {{-- Cursos matriculados --}}
        <div>

            <h5>
                Cursos matriculados - {{ $student->enrollments->count() }}
            </h5>

            <hr>

        </div>


        {{-- Lista de cursos --}}
        @if ($student->enrollments->isEmpty())

            <div class="alert alert-secondary">
                Este aluno não possui matrículas cadastradas.
            </div>

        @else

            <ul class="container-fluid d-flex flex-column list-group">

                @foreach ($enrollments as $enrollment)

                    <li class="list-group-item py-4">

                        <div class="row align-items-center">

                            {{-- Número --}}
                            <div class="col-1 text-center">
                                {{ $loop->iteration }}
                            </div>


                            {{-- Nome do curso --}}
                            <div class="col-4 fw-semibold">

                                <a
                                    href="{{ route('professorMeuCurso', $enrollment->course->id) }}"
                                    class="text-decoration-none"
                                >
                                    {{ $enrollment->course->name }}
                                </a>

                            </div>


                            {{-- Professor --}}
                            <div class="col text-secondary">

                                Professor:
                                {{ $enrollment->course->professor->name }}

                            </div>


                            {{-- Status --}}
                            <div class="col-auto">

                                @if ($enrollment->status)

                                    <span class="badge text-bg-success">
                                        Ativo
                                    </span>

                                @else

                                    <span class="badge text-bg-secondary">
                                        Inativo
                                    </span>

                                @endif

                            </div>


                            {{-- Visualizar curso --}}
                            <div class="col-auto">

                                <a
                                    href="{{ route('professorMeuCurso', $enrollment->course->id) }}"
                                    class="btn btn-outline-primary"
                                    title="Visualizar curso"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                            </div>

                        </div>

                    </li>

                @endforeach

            </ul>

        @endif

    </div>

@endsection