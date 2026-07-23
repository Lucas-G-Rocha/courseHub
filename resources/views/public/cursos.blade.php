@extends('layout.main')

@section('title', 'Cursos')


@section('content')

    <div class=" w-100 container d-flex flex-column align-items-center mt-5 row-gap-5">
        <h2 class="title">Nossos Cursos</h2>
        <div class="container-fluid d-flex flex-wrap justify-content-center gap-5 w-100">
            @foreach($cursos as $curso)
                <div class="card container d-flex flex-column align-items-center w-50" data-id="{{ $curso->id }}"
                    style="min-width: 300px; max-width:450px">

                    <div class="card-header py-3 bg-white">
                        <h5 class="text-uppercase card-title mb-0">{{ $curso->name }}</h5>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center text-center py-5">
                        <p class="fs-6">{{ $curso->description }}</p>

                    </div>
                    <div class="card-footer d-flex flex-row justify-content-around align-items-center w-100 py-3">
                        <p class="mb-0 text-secondary">{{ $curso->professor->name }}</p>
                        <a href="{{ route('cursoPublic', $curso->id) }}" role="button" class="btn btn-primary">Ver detalhes</a>
                        <p class="text-secondary">{{ $curso->workload }}h</p>
                    </div>
                </div>

            @endforeach
        </div>
    </div>

@endsection