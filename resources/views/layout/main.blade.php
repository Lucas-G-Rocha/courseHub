<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css"
        integrity="sha512-ApSLB1Pd3/bZN8fWB/RG9YhN/7bd9Hkf3AGaE2mPfebjrxagjuBtx2GcgdqIlJkUzwylBo61r9Xa9NmgBI0swA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/css/style.css">

    <title>@yield('title')</title>
</head>

<body class="position-relative">

    <nav class="navbar position-fixed fixed-top navbar-expand-lg bg-secondary-subtle z-2">
        <div class="container">
            <a class="navbar-brand text-primary-emphasis" href="/">CourseHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav w-100 justify-content-center column-gap-3">

                    @auth
                        @php 
                            $role = auth()->user()->role->name
                        @endphp
                    @if($role === 'admin')
                        <a class="nav-link active" aria-current="page" href="{{route('adminInicio')}}">Início</a>
                        <a class="nav-link" href="{{ route('adminCursos') }}">Cursos</a>
                        <a class="nav-link" href="{{ route('adminProfessores') }}">Professores</a>
                        <a class="nav-link" href="{{ route('adminStudents') }}">Alunos</a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-primary px-3">Logout</button>
                        </form>
                    @elseif($role === 'professor')

                        <a class="nav-link active" aria-current="page" href="{{route('professorInicio')}}">Início</a>
                        <a class="nav-link" href="{{ route('professorMeusCursos') }}">Meus Cursos</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-primary px-3">Logout</button>
                        </form>

                    @elseif($role === 'student')
                        <a class="nav-link active" aria-current="page" href="{{route('studentInicio')}}">Início</a>
                        <a class="nav-link" href="{{ route('studentMeusCursos') }}">Meus Cursos</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-primary px-3">Logout</button>
                        </form>
                    @else
                        <a class="nav-link active" aria-current="page" href="/">Início</a>
                        <a class="nav-link" href="/cursos">Cursos</a>
                        <a class="nav-link" href="/professores">Professores</a>
                        <a class="nav-link btn btn-primary px-3" href="{{ route('loginPage') }}" role="button">Login</a>

                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    @if(session('success'))
        <div class="alert alert-success position-fixed end-0 w-25 z-3" style="top: 80px;">
            <p class="fs-5">{{ session('success') }}</p>
        </div>

    @elseif(session('fail'))
        <div class="alert alert-danger position-fixed end-0 w-25 z-3" style="top: 80px;>
            <p class="fs-5">{{ session('fail') }}</p>
        </div>
    @endif

    <main style="margin-top: 100px;">
        @yield('content')
    </main>

    <footer>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>