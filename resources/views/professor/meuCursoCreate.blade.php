@extends('layout.main')

@section('title', 'Cadastrar Curso')

@section('content')

<div class="container d-flex justify-content-center mt-5 pb-5">

    <div class="card shadow-sm w-100" style="max-width: 700px;">

        <div class="card-body p-4 p-md-5">

            <h1 class="mb-4 text-center">
                Cadastrar Curso
            </h1>

            <form
                action="{{ route('professorMeuCursoCreate') }}"
                method="POST"
            >

                @csrf


                {{-- Nome --}}
                <div class="mb-3">

                    <label for="name" class="form-label">
                        Nome
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        required
                    >

                    @error('name')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Carga horária --}}
                <div class="mb-3">

                    <label for="workload" class="form-label">
                        Carga Horária
                    </label>

                    <div class="input-group">

                        <input
                            type="number"
                            id="workload"
                            name="workload"
                            class="form-control @error('workload') is-invalid @enderror"
                            value="{{ old('workload') }}"
                            min="1"
                            required
                        >

                        <span class="input-group-text">
                            horas
                        </span>

                    </div>

                    @error('workload')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Preço --}}
                <div class="mb-3">

                    <label for="price" class="form-label">
                        Preço
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            R$
                        </span>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price', 0) }}"
                            min="0"
                            step="0.01"
                            required
                        >

                    </div>

                    @error('price')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Descrição --}}
                <div class="mb-4">

                    <label for="description" class="form-label">
                        Descrição
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="form-control @error('description') is-invalid @enderror"
                    >{{ old('description') }}</textarea>

                    @error('description')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Botões --}}
                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ url()->previous() }}"
                        class="btn btn-outline-secondary"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Cadastrar Curso
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection