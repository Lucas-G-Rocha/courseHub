@extends('layout.main')

@section('title', 'Cadastrar Aluno')

@section('content')

<div class="container d-flex justify-content-center mt-5 pb-5">


<div class="card shadow-sm w-100" style="max-width: 700px;">

    <div class="card-body p-4 p-md-5">

        <h1 class="mb-4 text-center">Cadastrar Aluno</h1>

        <form action="{{ route('adminStudentCreate') }}" method="POST">

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

            {{-- Data de nascimento --}}
            <div class="mb-3">
                <label for="birth_date" class="form-label">
                    Data de Nascimento
                </label>

                <input
                    type="date"
                    id="birth_date"
                    name="birth_date"
                    class="form-control @error('birth_date') is-invalid @enderror"
                    value="{{ old('birth_date') }}"
                    required
                >

                @error('birth_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="form-label">
                    E-mail
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    required
                >

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Criar usuário --}}
            <div class="border rounded p-3 mb-4">

                <div class="form-check">
                    <input
                        type="checkbox"
                        id="create_user"
                        name="create_user"
                        value="1"
                        class="form-check-input"
                        {{ old('create_user') ? 'checked' : '' }}
                    >

                    <label for="create_user" class="form-check-label fw-semibold">
                        Criar usuário para este aluno
                    </label>
                </div>

                <div class="text-secondary small mt-2">
                    O usuário será criado utilizando o mesmo nome e e-mail informados acima.
                </div>

                {{-- Senha --}}
                <div class="mt-3">
                    <label for="password" class="form-label">
                        Senha do usuário
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                    >

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Confirmar senha --}}
                <div class="mt-3">
                    <label for="password_confirmation" class="form-label">
                        Confirmar senha
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                    >
                </div>

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
                    Cadastrar Aluno
                </button>

            </div>

        </form>

    </div>

</div>


</div>

@endsection

@push('scripts')

<script>
    const createUser = document.getElementById('create_user');

    function togglePasswordFields() {
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');

        password.disabled = !createUser.checked;
        passwordConfirmation.disabled = !createUser.checked;

        password.required = createUser.checked;
        passwordConfirmation.required = createUser.checked;
    }

    createUser.addEventListener('change', togglePasswordFields);

    togglePasswordFields();
</script>

@endpush
