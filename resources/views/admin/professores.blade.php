@extends('layout.main')

@section('title', 'Professores')

@section('content')

    <div class="container-fluid mt-5 px-4" style="padding-bottom: 40px">

        {{-- Cabeçalho --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

            <h1 class="mb-0">Professores</h1>

            <div class="d-flex gap-2">
                {{-- Search --}}
                <form action="{{ route('adminProfessores') }}" method="GET" class="d-flex">
                    <input type="search" name="search" class="form-control" placeholder="Buscar professor..."
                        value="{{ request('search') }}">

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
                                <a href="{{ route('adminProfessor', $professor->id) }}" class="btn btn-outline-primary mt-3">
                                    Ver perfil
                                </a>

                                {{-- Botões --}}
                                <div class="d-flex gap-2 mt-2">

                                    <a href="{{ route('adminProfessorEditPage', $professor->id) }}"
                                        class="btn btn-outline-warning flex-grow-1">
                                        Editar
                                    </a>

                                    <button type="button" class="btn btn-outline-danger flex-grow-1"
                                        data-bs-toggle="modal" data-bs-target="#deleteProfessorModal_{{ $professor->id }}">
                                        Deletar
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal fade" id="deleteProfessorModal_{{ $professor->id }}" tabindex="-1" aria-labelledby="deleteProfessorModalLabel_{{ $professor->id }}"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="deleteProfessorModalLabel_{{ $professor->id }}">
                                        Deletar professor
                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Não
                                    </button>

                                    {{-- Sim --}}
                                    <form action="{{ route('adminProfessorDestroy', $professor->id) }}" method="POST"
                                        class="d-inline">
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

                @endforeach

            </div>

            {{-- Paginação --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $professores->links() }}
            </div>

        @endif

    </div>

@endsection