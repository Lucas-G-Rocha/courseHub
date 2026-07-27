@extends('layout.main')

@section('title', 'Editar Aluno: ' . $aluno->name)

@section('content')

    <div class="container-fluid mt-5 ps-5" style="padding-bottom: 40px">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h1>Editar Aluno</h1>

            <a
                href="{{ url()->previous() }}"
                class="btn btn-outline-secondary"
            >
                Cancelar
            </a>

        </div>


        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('adminStudentEditPage', $aluno->id) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            {{-- Dados do aluno --}}
            <div class="card mb-4">

                <div class="card-header">

                    <h5 class="mb-0">
                        Dados do Aluno
                    </h5>

                </div>


                <div class="card-body">

                    {{-- Nome --}}
                    <div class="mb-3">

                        <label
                            for="student_name"
                            class="form-label"
                        >
                            Nome
                        </label>

                        <input
                            type="text"
                            id="student_name"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $aluno->name) }}"
                            required
                        >

                    </div>


                    {{-- Email --}}
                    <div class="mb-3">

                        <label
                            for="student_email"
                            class="form-label"
                        >
                            Email
                        </label>

                        <input
                            type="email"
                            id="student_email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $aluno->email) }}"
                            required
                        >

                    </div>


                    {{-- Data de nascimento --}}
                    <div>

                        <label
                            for="birth_date"
                            class="form-label"
                        >
                            Data de nascimento
                        </label>

                        <input
                            type="date"
                            id="birth_date"
                            name="birth_date"
                            class="form-control"
                            value="{{ old('birth_date', $aluno->birth_date) }}"
                            required
                        >

                    </div>

                </div>

            </div>


            {{-- Dados do usuário --}}
            <div class="card mb-4">

                <div class="card-header">

                    <h5 class="mb-0">
                        Usuário
                    </h5>

                </div>


                <div class="card-body">

                    @if ($aluno->user)

                        {{-- Nome do usuário --}}
                        <div class="mb-3">

                            <label
                                for="user_name"
                                class="form-label"
                            >
                                Nome
                            </label>

                            <input
                                type="text"
                                id="user_name"
                                name="user_name"
                                class="form-control"
                                value="{{ old('user_name', $aluno->user->name) }}"
                                required
                            >

                        </div>


                        {{-- Email do usuário --}}
                        <div class="mb-3">

                            <label
                                for="user_email"
                                class="form-label"
                            >
                                Email
                            </label>

                            <input
                                type="email"
                                id="user_email"
                                name="user_email"
                                class="form-control"
                                value="{{ old('user_email', $aluno->user->email) }}"
                                required
                            >

                        </div>


                        {{-- Senha --}}
                        <div class="mb-3">

                            <label
                                for="password"
                                class="form-label"
                            >
                                Nova senha
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                            >

                            <div class="form-text">
                                Deixe em branco para manter a senha atual.
                            </div>

                        </div>


                        {{-- Confirmação da senha --}}
                        <div>

                            <label
                                for="password_confirmation"
                                class="form-label"
                            >
                                Confirmar nova senha
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                            >

                        </div>

                    @else

                        <div class="alert alert-secondary mb-0">
                            Este aluno não possui um usuário associado.
                        </div>

                    @endif

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