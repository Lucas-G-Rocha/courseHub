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

                <button type="submit" class="btn btn-outline-primary ms-2">
                    Buscar
                </button>
            </form>

            {{-- Cadastrar --}}
            <a href="{{ route('adminCursoCreatePage') }}" class="btn btn-primary">
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

        <div class="row g-4">

            @foreach ($cursos as $curso)

                <div class="col-12 col-md-6 col-lg-4">

                    <div class="card h-100 shadow-sm">

                        <div class="card-body d-flex flex-column">

                            {{-- Informações --}}
                            <h5 class="card-title">
                                {{ $curso->name }}
                            </h5>

                            <p class="card-text mb-1">
                                <strong>Professor:</strong>
                                {{ $curso->professor->name }}
                            </p>

                            <p class="card-text mb-1">
                                <strong>Aulas:</strong>
                                {{ $curso->lessons->count() }}
                            </p>

                            <p class="card-text mb-1">
                                <strong>Matriculados:</strong>
                                {{ $curso->enrollments->count() }}
                            </p>

                            {{-- Link para página individual --}}
                            <a
                                href="{{ route('adminCurso', $curso->id) }}"
                                class="btn btn-outline-primary mt-3"
                            >
                                Ver curso
                            </a>

                            {{-- Botões --}}
                            <div class="d-flex gap-2 mt-2">

                                <a
                                    href="{{ route('adminCursoEditPage', $curso->id) }}"
                                    class="btn btn-outline-warning flex-grow-1"
                                >
                                    Editar
                                </a>

                                <form
                                    action="{{ route('adminCursoDestroy', $curso->id) }}"
                                    method="POST"
                                    class="flex-grow-1"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-outline-danger w-100"
                                        onclick="return confirm('Tem certeza que deseja deletar este curso?')"
                                    >
                                        Deletar
                                    </button>
                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

        {{-- Paginação --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $cursos->links() }}
        </div>

    @endif

</div>

@endsection