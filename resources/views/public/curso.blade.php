@extends('layout.main')

@section('title', $curso->name)


@section('content')

    <div class="container-fluid d-flex flex-column row-gap-lg-4 mt-5 ps-5 row-gap-4">
        <div class="">
            <h3 class="fs-2">{{ $curso->name }}</h3>
            <p class="text-capitalize fs-5">Professor: {{ $curso->professor->name }}</p>
            <p class="text-capitalize fs-5">Carga Horária: {{ $curso->workload }} horas</p>
            <p class="text-capitalize fs-5">Valor: {{ $curso->price}} R$</p>
        </div>

        <div>
            <p class="card-title">Descrição</p>
            <div class="alert alert-secondary" style="max-width: max-content;">
                <p class="fs-6 card-body">{{ $curso->description }}</p>
            </div>
        </div>

        <div>
            <h5>Lições - {{ count($curso->lessons) }}</h5>
            <hr>
        </div>

        <ul class="container-fluid d-flex flex-column list-group">
            @foreach($curso->lessons as $lesson)



                <button type="button" class="list-group-item list-group-item-action py-4" data-bs-toggle="modal" data-bs-target="#lessonModal">
                    <div class="row align-items-center">

                        <div class="col-1 text-center">
                            {{ $loop->index + 1 }}
                        </div>

                        <div class="col-3 fw-semibold">
                            {{$lesson->name}}
                        </div>

                        <div class="col text-secondary">
                            {{$lesson->description}}
                        </div>

                        <div class="col-auto fs-4">
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>

                    </div>

                </button>

                <div id="lessonModal" class="modal fade" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $lesson->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body py-4">
                                <p class="fs-6">{{ $lesson->content }}</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button data-bs-dismiss="modal" class="btn btn-primary">Fechar</button>
                            </div>
                        </div>
                    </div>

                </div>

            @endforeach
        </ul>

    </div>

@endsection