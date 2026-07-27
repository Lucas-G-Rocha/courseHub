@extends('layout.main')

@section('title', 'Editar Curso: ' . $curso->name)

@section('content')

    <div class="container-fluid mt-5 ps-5" style="padding-bottom: 40px">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h1>Editar Curso</h1>

            <a
                href="{{ url()->previous() }}"
                class="btn btn-outline-secondary"
            >
                Cancelar
            </a>

        </div>


        {{-- Erros de validação --}}
        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('adminCursoEdit', $curso->id) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            {{-- Dados do curso --}}
            <div class="card mb-4">

                <div class="card-header">

                    <h5 class="mb-0">
                        Dados do Curso
                    </h5>

                </div>


                <div class="card-body">

                    {{-- Nome --}}
                    <div class="mb-3">

                        <label
                            for="course_name"
                            class="form-label"
                        >
                            Nome
                        </label>

                        <input
                            type="text"
                            id="course_name"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $curso->name) }}"
                            required
                        >

                    </div>


                    {{-- Professor --}}
                    <div class="mb-3">

                        <label
                            for="professor_id"
                            class="form-label"
                        >
                            Professor
                        </label>

                        <select
                            id="professor_id"
                            name="professor_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Selecione um professor
                            </option>

                            @foreach ($professores as $professor)

                                <option
                                    value="{{ $professor->id }}"
                                    {{ old('professor_id', $curso->professor_id) == $professor->id ? 'selected' : '' }}
                                >
                                    {{ $professor->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Carga horária --}}
                    <div class="mb-3">

                        <label
                            for="workload"
                            class="form-label"
                        >
                            Carga Horária
                        </label>

                        <div class="input-group">

                            <input
                                type="number"
                                id="workload"
                                name="workload"
                                class="form-control"
                                value="{{ old('workload', $curso->workload) }}"
                                min="1"
                                required
                            >

                            <span class="input-group-text">
                                horas
                            </span>

                        </div>

                    </div>


                    {{-- Preço --}}
                    <div class="mb-3">

                        <label
                            for="price"
                            class="form-label"
                        >
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
                                class="form-control"
                                value="{{ old('price', $curso->price) }}"
                                min="0"
                                step="0.01"
                                required
                            >

                        </div>

                    </div>


                    {{-- Descrição --}}
                    <div>

                        <label
                            for="description"
                            class="form-label"
                        >
                            Descrição
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            class="form-control"
                            rows="5"
                        >{{ old('description', $curso->description) }}</textarea>

                    </div>

                </div>

            </div>


            {{-- Botões --}}
            <div class="d-flex gap-2">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Salvar alterações
                </button>

                <a
                    href="{{ url()->previous() }}"
                    class="btn btn-outline-secondary"
                >
                    Cancelar
                </a>

            </div>

        </form>

    </div>

@endsection