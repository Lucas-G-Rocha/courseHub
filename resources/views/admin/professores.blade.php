@extends('layout.main')

@section('title', 'Professores')

@section('content')

<div class="container-fluid mt-5 px-4">

    {{-- Cabeçalho --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <h1 class="mb-0">Professores</h1>

        <div class="d-flex gap-2">
            {{-- Search --}}
            <form action="{{ route('adminProfessores') }}" method="GET" class="d-flex">
                <input
                    type="search"
                    name="search"
                    class="form-control"
                    placeholder="Buscar professor..."
                    value="{{ request('search') }}"
                >

                <button type="submit" class="btn btn-outline-primary ms-2">
                    Buscar
                </button>
            </form>

            {{-- Cadastrar --}}
            <a href="{{ route('adminProfessorCreatePage') }}" class="btn btn-primary">
                Cadastrar Professor
            </a>
        </div>

    </div>


    {{-- Lista de professores --}}
    @if ($professores->isEmpty())

        <div class="alert alert-info">
            Nenhum professor encontrado.
        </div>

    @else

        <div class="row g-4">

            @foreach ($professores as $professor)

                <div class="col-12 col-md-6 col-lg-4">

                    <div class="card h-100 shadow-sm">

                        <div class="card-body d-flex flex-column">

                            {{-- Informações --}}
                            <h5 class="card-title">
                                {{ $professor->name }}
                            </h5>

                            <p class="card-text mb-1">
                                <strong>Email:</strong>
                                {{ $professor->email }}
                            </p>

                            {{-- Exemplo de relacionamento --}}
                            {{-- 
                            <p class="card-text mb-1">
                                <strong>Cursos:</strong>
                                {{ $professor->courses->count() }}
                            </p>
                            --}}

                            {{-- Link para página individual --}}
                            <a
                                href="{{ route('adminProfessor', $professor->id) }}"
                                class="btn btn-outline-primary mt-3"
                            >
                                Ver perfil
                            </a>

                            {{-- Botões --}}
                            <div class="d-flex gap-2 mt-2">

                                <a
                                    href="{{ route('adminProfessorEditPage', $professor->id) }}"
                                    class="btn btn-outline-warning flex-grow-1"
                                >
                                    Editar
                                </a>

                                <form
                                    action="{{ route('adminProfessorDestroy', $professor->id) }}"
                                    method="POST"
                                    class="flex-grow-1"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-outline-danger w-100"
                                        onclick="return confirm('Tem certeza que deseja deletar este professor?')"
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
            {{ $professores->links() }}
        </div>

    @endif

</div>

@endsection