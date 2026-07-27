@extends('layout.main')

@section('title', 'Cursos')

@section('content')

    <div class="container-fluid mt-5 px-4" style="padding-bottom: 40px">

        {{-- Cabeçalho --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

            <h1 class="mb-0">Cursos</h1>

            <div class="d-flex gap-2">

                {{-- Search --}}
                <form action="{{ route('adminCursos') }}" method="GET" class="d-flex">

                    <input
                        type="search"
                        name="search"
                        class="form-control"
                        placeholder="Buscar curso..."
                        value="{{ request('search') }}"
                    >

                    <button
                        type="submit"
                        class="btn btn-outline-primary ms-2"
                    >
                        Buscar
                    </button>

                </form>

                {{-- Cadastrar --}}
                <a
                    href="{{ route('adminCursoCreatePage') }}"
                    class="btn btn-primary"
                >
                    Cadastrar Curso
                </a>

            </div>

        </div>


        {{-- Lista de cursos --}}
        @if ($cursos->isEmpty())

            <div class="alert alert-info">
                Nenhum curso encontrado.
            </div>

        @else

            <ul class="container-fluid d-flex flex-column list-group p-0">

                @foreach ($cursos as $curso)

                    <li class="list-group-item py-4">

                        <div class="row align-items-center">

                            {{-- Nome --}}
                            <div class="col-12 col-md-3 fw-semibold">
                                {{ $curso->name }}
                            </div>

                            {{-- Professor --}}
                            <div class="col-12 col-md-3 text-secondary">
                                <strong>Professor:</strong>
                                {{ $curso->professor->name }}
                            </div>

                            {{-- Aulas --}}
                            <div class="col-12 col-md-2 text-secondary">
                                <strong>Aulas:</strong>
                                {{ $curso->lessons->count() }}
                            </div>

                            {{-- Matriculados --}}
                            <div class="col-12 col-md-2 text-secondary">
                                <strong>Matriculados:</strong>
                                {{ $curso->enrollments->count() }}
                            </div>

                            {{-- Ações --}}
                            <div class="col-12 col-md-2 d-flex justify-content-md-end gap-2 mt-3 mt-md-0">

                                {{-- Ver curso --}}
                                <a
                                    href="{{ route('adminCurso', $curso->id) }}"
                                    class="btn btn-outline-primary"
                                    title="Visualizar curso"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                {{-- Editar --}}
                                <a
                                    href="{{ route('adminCursoEditPage', $curso->id) }}"
                                    class="btn btn-outline-warning"
                                    title="Editar curso"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                {{-- Deletar --}}
                                <button
                                    type="button"
                                    class="btn btn-outline-danger"
                                    title="Deletar curso"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteCursoModal_{{ $curso->id }}"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                            </div>

                        </div>

                    </li>


                    {{-- Modal de confirmação --}}
                    <div
                        class="modal fade"
                        id="deleteCursoModal_{{ $curso->id }}"
                        tabindex="-1"
                        aria-labelledby="deleteCursoModalLabel_{{ $curso->id }}"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5
                                        class="modal-title"
                                        id="deleteCursoModalLabel_{{ $curso->id }}"
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
                                    <strong>{{ $curso->name }}</strong>?

                                    @if ($curso->lessons->isNotEmpty() || $curso->enrollments->isNotEmpty())

                                        <div class="alert alert-warning mt-3 mb-0">

                                            <i class="fa-solid fa-triangle-exclamation me-1"></i>

                                            Este curso possui:

                                            <ul class="mb-0 mt-2">

                                                @if ($curso->lessons->isNotEmpty())

                                                    <li>
                                                        <strong>{{ $curso->lessons->count() }}</strong>
                                                        aula(s) associada(s).
                                                    </li>

                                                @endif

                                                @if ($curso->enrollments->isNotEmpty())

                                                    <li>
                                                        <strong>{{ $curso->enrollments->count() }}</strong>
                                                        aluno(s) matriculado(s).
                                                    </li>

                                                @endif

                                            </ul>

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
                                        action="{{ route('adminCursoDestroy', $curso->id) }}"
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


            {{-- Paginação --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $cursos->links() }}
            </div>

        @endif

    </div>

@endsection