@extends('layout.main')

@section('title', 'CouseHub')


@section('content')

    <div class="container">

        {{-- Hero --}}
        <div class="py-5 text-center">
            <h1 class="display-4 fw-bold">
                Bem-vindo ao <span class="text-primary">CourseHub</span>
            </h1>

            <p class="lead text-muted mt-3">
                Aprenda novas habilidades, acompanhe seu progresso
                e evolua com cursos desenvolvidos para você.
            </p>

            <div class="mt-4">
                <a href="{{ route('cursosPublic') }}" class="btn btn-primary btn-lg">
                    Explorar cursos
                </a>

                @guest
                    <a href="{{ route('loginPage') }}" class="btn btn-outline-secondary btn-lg ms-2">
                        Entrar
                    </a>
                @endguest
            </div>
        </div>

        {{-- Destaques --}}
        <div class="row g-4 py-5">

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center p-4">
                        <h3 class="h5">📚 Cursos de qualidade</h3>

                        <p class="text-muted mt-3 mb-0">
                            Encontre cursos organizados para aprender
                            de forma simples e progressiva.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center p-4">
                        <h3 class="h5">🎯 Aprenda no seu ritmo</h3>

                        <p class="text-muted mt-3 mb-0">
                            Acesse suas aulas e avance pelo conteúdo
                            de acordo com o seu próprio ritmo.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center p-4">
                        <h3 class="h5">🚀 Evolua constantemente</h3>

                        <p class="text-muted mt-3 mb-0">
                            Desenvolva seus conhecimentos e conquiste
                            novas habilidades através do aprendizado.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Chamada final --}}
        <div class="bg-light rounded-3 p-5 text-center my-5">
            <h2 class="fw-bold">Comece a aprender hoje</h2>

            <p class="text-muted mt-3">
                Explore nosso catálogo de cursos e encontre
                o próximo assunto que você quer dominar.
            </p>

            <a href="{{ route('cursosPublic') }}" class="btn btn-primary mt-2">
                Ver cursos
            </a>
        </div>

        {{-- Contato --}}
        <div class="row justify-content-center my-5">
            <div class="col-lg-8">

                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">

                        <div class="text-center mb-4">
                            <h2 class="fw-bold">Entre em contato</h2>
                            <p class="text-muted mb-0">
                                Tem alguma dúvida, sugestão ou encontrou algum problema?
                                Envie uma mensagem para nossa equipe.
                            </p>
                        </div>

                        <form action="{{ route('sendPublicMail') }}" method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nome</label>

                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">E-mail</label>

                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" required>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Assunto</label>

                                <input type="text" class="form-control" id="subject" name="subject"
                                    value="{{ old('subject') }}" placeholder="Ex.: Dúvida sobre um curso" required>
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label">Mensagem</label>

                                <textarea class="form-control" id="message" name="message" rows="6"
                                    placeholder="Escreva sua mensagem..." required>{{ old('message') }}</textarea>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    Enviar mensagem
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection