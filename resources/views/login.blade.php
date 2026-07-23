@extends('layout.main')

@section('title', 'Login')


@section('content')

    <div class="content-fluid d-flex justify-content-center align-items-center">

        <div class="bg-light w-75 d-flex flex-column gap-3 text-center">
            <h1 class="fs-3 text-secondary">Login</h1>

            <form action="#" class="container d-flex flex-column row-gap-2 align-items-center justify-content-center">
                <div>
                    <label for="">Email</label>
                    <input type="email" required placeholder="Seu email">
                </div>
                <div>
                    <label for="">Senha</label>
                    <input type="password" required placeholder="Sua senha">
                </div>
                <input type="submit" class="btn btn-primary" value="Entrar">
            </form>
        </div>

    </div>

@endsection