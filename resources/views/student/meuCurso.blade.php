@extends('layout.main')

@section('title', $curso->name)

@section('content')

    <div class="container-fluid d-flex flex-column row-gap-lg-4 mt-5 py-5 row-gap-4">

        {{-- Informações do curso --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-4">

            <div>

                <h3 class="fs-2">
                    {{ $curso->name }}
                </h3>

                <p class="text-capitalize fs-5">
                    Professor: {{ $curso->professor->name }}
                </p>

                <p class="text-capitalize fs-5">
                    Carga Horária: {{ $curso->workload }} horas
                </p>

                <p class="text-capitalize fs-5">
                    Valor: R$ {{ number_format($curso->price, 2, ',', '.') }}
                </p>

            </div>


            {{-- Ação de matrícula --}}
            <div>

                @if ($matricula)

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelEnrollmentModal">
                        <i class="fa-solid fa-xmark me-1"></i>
                        Cancelar Matrícula
                    </button>

                @else

                    <form action="{{ route('studentEnrollmentCreate', $curso->id) }}" method="POST">

                        @csrf

                        <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-plus me-1"></i>
                            Me Matricular
                        </button>

                    </form>

                @endif

            </div>

        </div>


        {{-- Descrição --}}
        <div>

            <p class="card-title">
                Descrição
            </p>

            <div class="alert alert-secondary" style="max-width: max-content;">

                <p class="fs-6 card-body">
                    {{ $curso->description ?: 'Nenhuma descrição cadastrada.' }}
                </p>

            </div>

        </div>


        {{-- Lições --}}
        <div>

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    Lições - {{ $curso->lessons->count() }}
                </h5>

            </div>

            <hr>

        </div>


        {{-- Lista de lições --}}
        @if ($curso->lessons->isEmpty())

            <div class="alert alert-secondary">
                Este curso não possui lições cadastradas.
            </div>

        @else

            <ul class="container-fluid d-flex flex-column list-group">

                @foreach ($curso->lessons as $lesson)

                    <li class="list-group-item py-4">

                        <div class="row align-items-center">

                            {{-- Número --}}
                            <div class="col-1 text-center">
                                {{ $loop->iteration }}
                            </div>

                            {{-- Nome --}}
                            <div class="col-12 col-md-3 fw-semibold" role="button" data-bs-toggle="modal"
                                data-bs-target="#lessonModal{{ $lesson->id }}">
                                {{ $lesson->name }}
                            </div>

                            {{-- Descrição --}}
                            <div class="col text-secondary" role="button" data-bs-toggle="modal"
                                data-bs-target="#lessonModal{{ $lesson->id }}">
                                {{ $lesson->description ?: 'Sem descrição.' }}
                            </div>

                            {{-- Visualizar --}}
                            <div class="col-auto d-flex align-items-center gap-2">

                                <button type="button" class="btn btn-outline-primary" title="Visualizar lição"
                                    data-bs-toggle="modal" data-bs-target="#lessonModal{{ $lesson->id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>

                            </div>

                        </div>

                    </li>


                    {{-- Modal para visualizar a lição --}}
                    <div id="lessonModal{{ $lesson->id }}" class="modal fade" tabindex="-1"
                        aria-labelledby="lessonModalLabel{{ $lesson->id }}" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="lessonModalLabel{{ $lesson->id }}">
                                        {{ $lesson->name }}
                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

                                </div>

                                <div class="modal-body py-4">

                                    <p class="fs-6">
                                        {{ $lesson->content }}
                                    </p>

                                </div>

                                <div class="modal-footer justify-content-center">

                                    <button data-bs-dismiss="modal" class="btn btn-primary">
                                        Fechar
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </ul>

        @endif


        {{-- Alunos matriculados --}}
        <div class="mt-3">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    Alunos matriculados - {{ $curso->enrollments->count() }}
                </h5>

            </div>

            <hr>

            @if ($curso->enrollments->isEmpty())

                <div class="alert alert-secondary">
                    Este curso não possui alunos matriculados.
                </div>

            @else

                <div class="alert alert-info">
                    Este curso possui
                    <strong>{{ $curso->enrollments->count() }}</strong>
                    aluno(s) matriculado(s).
                </div>

            @endif

        </div>

    </div>


    {{-- Modal de confirmação para cancelar matrícula --}}
    @if ($matricula)

        <div class="modal fade" id="cancelEnrollmentModal" tabindex="-1" aria-labelledby="cancelEnrollmentModalLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="cancelEnrollmentModalLabel">
                            Cancelar matrícula
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

                    </div>


                    <div class="modal-body">

                        Tem certeza que deseja cancelar sua matrícula no curso
                        <strong>{{ $curso->name }}</strong>?

                    </div>


                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Não
                        </button>


                        <form action="{{ route('studentEnrollmentDestroy', $curso->id) }}" method="POST" class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                Sim, cancelar matrícula
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    @endif

@endsection