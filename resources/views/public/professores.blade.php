@extends('layout.main')

@section('title', 'Professores')


@section('content')

    <div class="container-fluid d-flex flex-column row-gap-5 align-items-center">
        <h1>Nossos Professores</h1>
        <div class="container">
            <div class="row g-4">

                @foreach($professors as $professor)

                    <div class="col-12 col-sm-6 col-lg-4 g-4">
                        <div class="card container h-100" style="max-width: 450px; min-width: 300px">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center gap-3">
                                <h5 class="card-title">{{ $professor->name }}</h5>
                                <p class="card-text d-flex flex-column row-gap-1 text-center"><span
                                        class="text-secondary">Email</span> {{ $professor->email }}</p>

                                <p class="card-text d-flex flex-column row-gap-1 text-center"><span
                                        class="text-secondary">Bio</span> {{ $professor->bio }}</p>
                                

                            </div>
                            <div class="card-footer py-3 text-center">
                                <a href="{{ route('professorPublic', $professor->id) }} " class="btn btn-primary">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

@endsection