@extends('layout.main')

@section('title', 'Alunos')

@section('content')

<div class="container-fluid mt-5 px-4" style="padding-bottom: 40px">

    {{-- Cabeçalho --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <h1 class="mb-0">Alunos</h1>

        <div class="d-flex gap-2">

            {{-- Search --}}
            <form action="{{ route('adminStudents') }}" method="GET" class="d-flex">
                <input
                    type="search"
                    name="search"
                    class="form-control"
                    placeholder="Buscar aluno..."
                    value="{{ request('search') }}"
                >

                <button type="submit" class="btn btn-outline-primary ms-2">
                    Buscar
                </button>
            </form>

            {{-- Cadastrar --}}
            <a href="{{ route('adminStudentCreatePage') }}" class="btn btn-primary">
                Cadastrar Aluno
            </a>

        </div>

    </div>


    {{-- Lista de alunos --}}
    @if ($students->isEmpty())

        <div class="alert alert-info">
            Nenhum aluno encontrado.
        </div>

    @else

        <ul class="container-fluid d-flex flex-column list-group p-0">

            @foreach ($students as $aluno)

                <a
                    href="{{ route('adminStudent', $aluno->id) }}"
                    class="list-group-item list-group-item-action py-4 text-decoration-none"
                >

                    <div class="row align-items-center">

                        {{-- Nome --}}
                        <div class="col-12 col-md-3 fw-semibold">
                            {{ $aluno->name }}
                        </div>

                        {{-- Email --}}
                        <div class="col-12 col-md-3 text-secondary">
                            {{ $aluno->email }}
                        </div>

                        {{-- Data de nascimento --}}
                        <div class="col-12 col-md-2 text-secondary">
                            {{ $aluno->birth_date }}
                        </div>

                        {{-- Quantidade de cursos --}}
                        <div class="col-12 col-md-3 text-secondary">
                            <strong>Cursos:</strong>
                            {{ $aluno->enrollments->count() }}
                        </div>

                        {{-- Ícone --}}
                        <div class="col text-end fs-4">
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>

                    </div>

                </a>

            @endforeach

        </ul>

        {{-- Paginação --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $students->links() }}
        </div>

    @endif

</div>

@endsection