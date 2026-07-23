@extends('layout.main')

@section('title', 'Professor: {{ $professor->name }}')


@section('content')

    <div class="container-fluid d-flex flex-column row-gap-4 mt-5 ps-5">

        {{-- Informações do professor --}}
        <div>
            <h3 class="fs-2">{{ $professor->name }}</h3>

            <p class="fs-5">
                Email: {{ $professor->email }}
            </p>

            <p class="fs-5">
                Cursos: {{ $professor->courses->count() }}
            </p>
        </div>


        {{-- Biografia --}}
        <div>
            <p class="card-title">Sobre o professor</p>

            <div class="alert alert-secondary" style="max-width: max-content;">
                <p class="fs-6 mb-0">
                    {{ $professor->bio }}
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
        <ul class="container-fluid d-flex flex-column list-group">

            @foreach($professor->courses as $course)

                <a href="{{ route('cursoPublic', $course->id) }}" class="list-group-item list-group-item-action py-4">

                    <div class="row align-items-center">

                        {{-- Número --}}
                        <div class="col-1 text-center">
                            {{ $loop->iteration }}
                        </div>

                        {{-- Nome --}}
                        <div class="col-3 fw-semibold">
                            {{ $course->name }}
                        </div>

                        {{-- Descrição --}}
                        <div class="col text-secondary">
                            {{ $course->description }}
                        </div>

                        {{-- Seta --}}
                        <div class="col-auto fs-4">
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>

                    </div>

                </a>

            @endforeach

        </ul>

    </div>

@endsection