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

            <ul class="container-fluid d-flex flex-column list-group p-0">

                @foreach ($professores as $professor)

                    @php
                        $id = "deleteProfessorModal_" . $professor->id;
                        $title = "Deletar Professor";
                        $ariaLabelId = "deleteProfessorModalLabel_" . $professor->id;
                        $description = "Tem certeza que deseja deletar o professor";
                        $dados = $professor;
                        $dependanceDescription = "Este professor possui";
                        $countDependances = [
                            [
                            "name" => "cursos",
                            "count" => $professor->courses->count()
                            ]
                        ];
                        $formRoute = route('adminProfessorDestroy', $professor->id);
                    @endphp
                    
                    <x-professor-card :professor="$professor" />
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


                @endforeach

            </ul>


            {{-- Paginação --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $professores->links() }}
            </div>

        @endif

    </div>

@endsection