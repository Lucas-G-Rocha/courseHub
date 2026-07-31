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

                    <input type="search" name="search" class="form-control" placeholder="Buscar aluno..."
                        value="{{ request('search') }}">

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

                    @php
                        $id = "deleteAlunoModal_" . $aluno->id;
                        $title = "Deletar Aluno";
                        $ariaLabelId = "deleteAlunoModalLabel_" . $aluno->id;
                        $description = "Tem certeza que deseja deletar o aluno";
                        $dados = $aluno;
                        $dependanceDescription = "Este aluno possui";
                        $countDependances = [
                            [
                                "name" => "matrículas",
                                "count" => $aluno->enrollments->count()
                            ]
                        ];
                        $formRoute = route('adminStudentDestroy', $aluno->id);
                    @endphp

                    <x-student-card :aluno="$aluno" />
                    <x-modal.confirmation-delete 
                        id="{{$id}}"
                        title="{{$title}}"
                        ariaLabelId="{{ $ariaLabelId }}"
                        description="{{ $description }}"
                        :dados="$dados"
                        :countDependances="$countDependances"
                        dependanceDescription="{{ $dependanceDescription }}"
                        formRoute="{{ $formRoute }}"

                    />

                    <!-- {{-- Modal de exclusão do aluno --}}
                                <div class="modal fade" id="deleteStudentModal_{{ $aluno->id }}" tabindex="-1"
                                    aria-labelledby="deleteStudentModalLabel_{{ $aluno->id }}" aria-hidden="true">

                                    <div class="modal-dialog">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5 class="modal-title" id="deleteStudentModalLabel_{{ $aluno->id }}">
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

                                </div> -->

                @endforeach

            </ul>


            {{-- Paginação --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $students->links() }}
            </div>

        @endif

    </div>

@endsection