@extends('layout.main')

@section('title', 'Meus Cursos')

@section('content')

    <div class="container-fluid mt-5 px-4" style="padding-bottom: 40px">

        {{-- Cabeçalho --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

            <h1 class="mb-0">Meus Cursos</h1>

            <a href="{{ route('studentCursos') }}" class="btn btn-primary">
                Ver cursos disponíveis
            </a>

        </div>


        {{-- Lista de cursos --}}
        @if ($cursos->isEmpty())

            <div class="alert alert-info">
                Você ainda não está matriculado em nenhum curso.
            </div>

        @else

            <ul class="container-fluid d-flex flex-column list-group p-0">

                @foreach ($cursos as $curso)

                    <li class="list-group-item py-4">

                        <div class="row align-items-center">

                            {{-- Nome --}}
                            <div class="col-12 col-md-4 fw-semibold">
                                {{ $curso->name }}
                            </div>

                            {{-- Professor --}}
                            <div class="col-12 col-md-3 text-secondary">
                                <strong>Professor:</strong>
                                {{ $curso->professor->name }}
                            </div>

                            {{-- Aulas --}}
                            <div class="col-12 col-md-3 text-secondary">
                                <strong>Aulas:</strong>
                                {{ $curso->lessons->count() }}
                            </div>

                            {{-- Ações --}}
                            <div class="col-12 col-md-2 d-flex justify-content-md-end gap-2 mt-3 mt-md-0">

                                {{-- Ver curso --}}
                                <a href="{{ route('studentMeuCurso', $curso->id) }}" class="btn btn-outline-primary"
                                    title="Visualizar curso">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                            </div>

                        </div>

                    </li>

                @endforeach

            </ul>


            {{-- Paginação --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $cursos->links() }}
            </div>

        @endif

    </div>

@endsection 