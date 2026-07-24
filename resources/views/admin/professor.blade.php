@extends('layout.main')

@section('title', 'Professor: ' . $professor->name)

@section('content')

    <div class="container-fluid d-flex flex-column row-gap-4 mt-5 ps-5">

        {{-- Cabeçalho --}}
        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h3 class="fs-2 mb-2">
                    {{ $professor->name }}
                </h3>

                <p class="fs-5 mb-1">
                    Email: {{ $professor->email }}
                </p>

                <p class="fs-5 mb-0">
                    Cursos: {{ $professor->courses->count() }}
                </p>
            </div>

            {{-- Ações do professor --}}
            <div class="d-flex gap-2">

                {{-- Editar --}}
                <a href="{{ route('adminProfessorEditPage', $professor->id) }}" class="btn btn-primary">
                    <i class="fa-solid fa-pen-to-square me-1"></i>
                    Editar
                </a>

                {{-- Botão para abrir modal de exclusão --}}
                <button
                    type="button"
                    class="btn btn-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteProfessorModal"
                >
                    <i class="fa-solid fa-trash me-1"></i>
                    Deletar
                </button>

            </div>

        </div>


        {{-- Biografia --}}
        <div>

            <p class="card-title">
                Sobre o professor
            </p>

            <div class="alert alert-secondary" style="max-width: max-content;">
                <p class="fs-6 mb-0">
                    {{ $professor->bio ?: 'Nenhuma biografia cadastrada.' }}
                </p>
            </div>

        </div>


        {{-- Cursos --}}
        <div>

            <h5>
                Cursos - {{ $professor->courses->count() }}
            </h5>

            <hr>

        </div>


        {{-- Lista de cursos --}}
        @if ($professor->courses->isEmpty())

            <div class="alert alert-secondary">
                Este professor não possui cursos cadastrados.
            </div>

        @else

            <ul class="container-fluid d-flex flex-column list-group">

                @foreach ($professor->courses as $course)

                    <li class="list-group-item py-4">

                        <div class="row align-items-center">

                            {{-- Número --}}
                            <div class="col-1 text-center">
                                {{ $loop->iteration }}
                            </div>

                            {{-- Nome --}}
                            <div class="col-3 fw-semibold">

                                <a
                                    href="{{ route('cursoPublic', $course->id) }}"
                                    class="text-decoration-none"
                                >
                                    {{ $course->name }}
                                </a>

                            </div>

                            {{-- Descrição --}}
                            <div class="col text-secondary">
                                {{ $course->description }}
                            </div>

                            {{-- Ações --}}
                            <div class="col-auto d-flex align-items-center gap-3">

                                {{-- Ver curso --}}
                                <a
                                    href="{{ route('cursoPublic', $course->id) }}"
                                    class="btn btn-outline-primary"
                                    title="Visualizar curso"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                {{-- Botão para abrir modal de exclusão --}}
                                <button
                                    type="button"
                                    class="btn btn-outline-danger"
                                    title="Deletar curso"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteCourseModal{{ $course->id }}"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                            </div>

                        </div>

                    </li>


                    {{-- Modal de exclusão do curso --}}
                    <div
                        class="modal fade"
                        id="deleteCourseModal{{ $course->id }}"
                        tabindex="-1"
                        aria-labelledby="deleteCourseModalLabel{{ $course->id }}"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5
                                        class="modal-title"
                                        id="deleteCourseModalLabel{{ $course->id }}"
                                    >
                                        Deletar curso
                                    </h5>

                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Fechar"
                                    ></button>
                                </div>

                                <div class="modal-body">
                                    Tem certeza que deseja deletar o curso
                                    <strong>{{ $course->name }}</strong>?
                                </div>

                                <div class="modal-footer">

                                    {{-- Não --}}
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                    >
                                        Não
                                    </button>

                                    {{-- Sim --}}
                                    <form
                                        action="{{ route('adminCursoDestroy', $course->id) }}"
                                        method="POST"
                                        class="d-inline"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger"
                                        >
                                            Sim, deletar
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


    {{-- Modal de exclusão do professor --}}
    <div
        class="modal fade"
        id="deleteProfessorModal"
        tabindex="-1"
        aria-labelledby="deleteProfessorModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">

                    <h5
                        class="modal-title"
                        id="deleteProfessorModalLabel"
                    >
                        Deletar professor
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fechar"
                    ></button>

                </div>

                <div class="modal-body">

                    Tem certeza que deseja deletar o professor
                    <strong>{{ $professor->name }}</strong>?

                    @if ($professor->courses->isNotEmpty())
                        <div class="alert alert-warning mt-3 mb-0">
                            <i class="fa-solid fa-triangle-exclamation me-1"></i>

                            Este professor possui
                            <strong>{{ $professor->courses->count() }}</strong>
                            curso(s) associado(s).
                        </div>
                    @endif

                </div>

                <div class="modal-footer">

                    {{-- Não --}}
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Não
                    </button>

                    {{-- Sim --}}
                    <form
                        action="{{ route('adminProfessorDestroy', $professor->id) }}"
                        method="POST"
                        class="d-inline"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger"
                        >
                            Sim, deletar
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection