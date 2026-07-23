@extends('layout.main')

@section('title', 'Login')


@section('content')

    <div class="content-fluid d-flex justify-content-center align-items-center h-100 bg-secondary" style="margin-top: -100px">

        <div class="bg-light w-50 d-flex flex-column gap-4 text-center py-5 rounded-3 container" style="max-width: 550px">
            <h1 class="fs-3 text-secondary">Login</h1>

            <form action="/api/login" method="POST" class="container d-flex flex-column row-gap-2 align-items-center justify-content-center w-75">
                @csrf

                <div class="w-100">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" required placeholder="Seu email" class="form-control text-center w-100" value="{{ old('email') }}">
                </div>
                <div class="w-100">
                    <label for="password">Senha</label>
                    <input id="password" type="password" name="password" required placeholder="Sua senha" class="form-control text-center w-100">
                </div>
                <input type="submit" class="btn btn-primary mt-4 px-5 py-2" value="Entrar">
            </form>
        </div>

    </div>

@endsection