@extends('layout.main');

@section('title', 'Perfil | CourseHub');

@section('content')

    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-body p-4">

                <h2 class="mb-4">Meu Perfil</h2>

                <div class="mb-4">
                    <label class="form-label fw-bold">Nome</label>

                    <div class="d-flex justify-content-between align-items-center">
                        <span>{{ $admin->name }}</span>

                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">E-mail</label>

                    <div class="d-flex justify-content-between align-items-center">
                        <span>{{ $admin->email }}</span>

                    </div>
                </div>
                
                <button type="button" class="btn btn-primary px-4 btn-sm" data-bs-toggle="modal"
                    data-bs-target="#editEmailModal">
                    Editar
                </button>

            </div>
        </div>
    </div>


@endsection