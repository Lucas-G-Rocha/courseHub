@extends('layout.main')

@section('title', 'Aluno: ' . $aluno->name)

@section('content')

    <div class="container-fluid d-flex flex-column row-gap-4 mt-5 ps-5">

        {{-- Cabeçalho --}}
        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h3 class="fs-2 mb-2">
                    {{ $aluno->name }}
                </h3>

                <p class="fs-5 mb-1">
                    Email: {{ $aluno->email }}
                </p>

                <p class="fs-5 mb-1">
                    Data de nascimento:
                    {{ \Carbon\Carbon::parse($aluno->birth_date)->format('d/m/Y') }}
                </p>

                <p class="fs-5 mb-0">
                    Cursos matriculados: {{ $aluno->enrollments->count() }}
                </p>

            </div>


            {{-- Ações do aluno --}}
            <div class="d-flex gap-2">

                {{-- Editar --}}
                <a href="{{ route('adminStudentEditPage', $aluno->id) }}" class="btn btn-primary">
                    <i class="fa-solid fa-pen-to-square me-1"></i>
                    Editar
                </a>

                {{-- Deletar --}}
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteStudentModal">
                    <i class="fa-solid fa-trash me-1"></i>
                    Deletar
                </button>

            </div>

        </div>


        {{-- Cursos matriculados --}}
        <div>

            <h5>
                Cursos matriculados - {{ $aluno->enrollments->count() }}
            </h5>

            <hr>

        </div>


        {{-- Lista de cursos --}}
        @if ($aluno->enrollments->isEmpty())

            <div class="alert alert-secondary">
                Este aluno não possui matrículas cadastradas.
            </div>

        @else

            <ul class="container-fluid d-flex flex-column list-group">

                @foreach ($aluno->enrollments as $enrollment)

                    <li class="list-group-item py-4">

                        <div class="row align-items-center">

                            {{-- Número --}}
                            <div class="col-1 text-center">
                                {{ $loop->iteration }}
                            </div>

                            {{-- Nome do curso --}}
                            <div class="col-3 fw-semibold">

                                <a href="{{ route('adminCurso', $enrollment->course->id) }}" class="text-decoration-none">
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

                            {{-- Ações --}}
                            <div class="col-auto d-flex gap-2">

                                {{-- Ver curso --}}
                                <a href="{{ route('adminCurso', $enrollment->course->id) }}" class="btn btn-outline-primary"
                                    title="Visualizar curso">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                {{-- Excluir matrícula --}}
                                <button type="button" class="btn btn-outline-danger" title="Remover matrícula"
                                    data-bs-toggle="modal" data-bs-target="#deleteEnrollmentModal{{ $enrollment->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                            </div>

                        </div>

                    </li>

                    {{-- Modal de exclusão da matrícula --}}
                    <div class="modal fade" id="deleteEnrollmentModal{{ $enrollment->id }}" tabindex="-1"
                        aria-labelledby="deleteEnrollmentModalLabel{{ $enrollment->id }}" aria-hidden="true">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="deleteEnrollmentModalLabel{{ $enrollment->id }}">
                                        Remover matrícula
                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

                                </div>

                                <div class="modal-body">

                                    Tem certeza que deseja remover a matrícula de
                                    <strong>{{ $aluno->name }}</strong>
                                    do curso
                                    <strong>{{ $enrollment->course->name }}</strong>?

                                </div>

                                <div class="modal-footer">

                                    {{-- Não --}}
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Não
                                    </button>

                                    {{-- Sim --}}
                                    <form action="{{ route('adminEnrollmentDestroy', $enrollment->id) }}" method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            Sim, remover
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </ul>

        @endif

    </div>


    {{-- Modal de exclusão do aluno --}}
    <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel"
        aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="deleteStudentModalLabel">
                        Deletar aluno
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

                </div>


                <div class="modal-body">

                    Tem certeza que deseja deletar o aluno
                    <strong>{{ $aluno->name }}</strong>?

                    @if ($aluno->enrollments->isNotEmpty())

                        <div class="alert alert-warning mt-3 mb-0">

                            <i class="fa-solid fa-triangle-exclamation me-1"></i>

                            Este aluno possui
                            <strong>{{ $aluno->enrollments->count() }}</strong>
                            matrícula(s) associada(s).

                        </div>

                    @endif

                </div>


                <div class="modal-footer">

                    {{-- Não --}}
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Não
                    </button>


                    {{-- Sim --}}
                    <form action="{{ route('adminStudentDestroy', $aluno->id) }}" method="POST" class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            Sim, deletar
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection