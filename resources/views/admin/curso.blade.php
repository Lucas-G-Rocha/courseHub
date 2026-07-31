@extends('layout.main')

@section('title', $curso->name)

@section('content')

    <div class="container-fluid d-flex flex-column row-gap-lg-4 mt-5 py-5 row-gap-4">

        {{-- Informações do curso --}}
        <div class="d-flex justify-content-between align-items-start">

            <div>

                <h3 class="fs-2">
                    {{ $curso->name }}
                </h3>

                <p class="text-capitalize fs-5">
                    Professor: {{ $curso->professor->name }}
                </p>

                <p class="text-capitalize fs-5">
                    Carga Horária: {{ $curso->workload }} horas
                </p>

                <p class="text-capitalize fs-5">
                    Valor: R$ {{ number_format($curso->price, 2, ',', '.') }}
                </p>

            </div>


            {{-- Ações --}}
            <div class="d-flex gap-2">

                {{-- Editar --}}
                <a href="{{ route('adminCursoEditPage', $curso->id) }}" class="btn btn-primary">
                    <i class="fa-solid fa-pen-to-square me-1"></i>
                    Editar
                </a>

                {{-- Deletar --}}
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCursoModal">
                    <i class="fa-solid fa-trash me-1"></i>
                    Deletar
                </button>

            </div>

        </div>


        {{-- Descrição --}}
        <div>

            <p class="card-title">
                Descrição
            </p>

            <div class="alert alert-secondary" style="max-width: max-content;">

                <p class="fs-6 card-body">
                    {{ $curso->description ?: 'Nenhuma descrição cadastrada.' }}
                </p>

            </div>

        </div>


        {{-- Lições --}}
        <div>

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    Lições - {{ $curso->lessons->count() }}
                </h5>

                {{-- Cadastrar lição --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createLessonModal">
                    <i class="fa-solid fa-plus me-1"></i>
                    Cadastrar Lição
                </button>

            </div>

            <hr>

        </div>


        {{-- Lista de lições --}}
        @if ($curso->lessons->isEmpty())

            <div class="alert alert-secondary">
                Este curso não possui lições cadastradas.
            </div>

        @else

            <ul class="container-fluid d-flex flex-column list-group">

                @foreach($curso->lessons as $lesson)

                    {{-- Item da lição --}}
                    <li class="list-group-item py-4">

                        <div class="row align-items-center">

                            {{-- Número --}}
                            <div class="col-1 text-center">
                                {{ $loop->iteration }}
                            </div>

                            {{-- Nome --}}
                            <div class="col-3 fw-semibold" role="button" data-bs-toggle="modal"
                                data-bs-target="#lessonModal{{ $lesson->id }}">
                                {{ $lesson->name }}
                            </div>

                            {{-- Descrição --}}
                            <div class="col text-secondary" role="button" data-bs-toggle="modal"
                                data-bs-target="#lessonModal{{ $lesson->id }}">
                                {{ $lesson->description }}
                            </div>

                            {{-- Ações --}}
                            <div class="col-auto d-flex align-items-center gap-2">

                                {{-- Editar --}}
                                <button type="button" class="btn btn-outline-warning" title="Editar lição" data-bs-toggle="modal"
                                    data-bs-target="#editLessonModal{{ $lesson->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                {{-- Deletar --}}
                                <button type="button" class="btn btn-outline-danger" title="Deletar lição" data-bs-toggle="modal"
                                    data-bs-target="#deleteLessonModal_{{ $lesson->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                {{-- Visualizar --}}
                                <button type="button" class="btn btn-outline-primary" title="Visualizar lição"
                                    data-bs-toggle="modal" data-bs-target="#lessonModal{{ $lesson->id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>

                            </div>

                        </div>

                    </li>


                    @php
                        $id = "deleteLessonModal_" . $lesson->id;
                        $title = "Deletar Lição";
                        $ariaLabelId = "deleteLessonModalLabel_" . $lesson->id;
                        $description = "Tem certeza que deseja deletar a Lição";
                        $dados = $lesson;
                        $dependanceDescription = "Esta lição possui";
                        $countDependances = [];
                        $formRoute = route('adminLessonDestroy', $lesson->id);
                    @endphp

                    <x-modal.confirmation-delete 
                        id="{{$id}}"
                        title="{{$title}}"
                        ariaLabelId="{{ $ariaLabelId }}"
                        description="{{ $description }}"
                        :dados="$dados"
                        :countDependances="$countDependances"
                        dependanceDescription="{{ $dependanceDescription }}"
                        formRoute="{{ $formRoute }}"

                    />

                    {{-- Modal para visualizar a lição --}}
                                <div id="lessonModal{{ $lesson->id }}" class="modal fade" tabindex="-1"
                                    aria-labelledby="lessonModalLabel{{ $lesson->id }}" aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5 class="modal-title" id="lessonModalLabel{{ $lesson->id }}">
                                                    {{ $lesson->name }}
                                                </h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

                                            </div>

                                            <div class="modal-body py-4">

                                                <p class="fs-6">
                                                    {{ $lesson->content }}
                                                </p>

                                            </div>

                                            <div class="modal-footer justify-content-center">

                                                <button data-bs-dismiss="modal" class="btn btn-primary">
                                                    Fechar
                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </div>


                    {{-- Modal para editar a lição --}}
                    <div id="editLessonModal{{ $lesson->id }}" class="modal fade" tabindex="-1"
                        aria-labelledby="editLessonModalLabel{{ $lesson->id }}" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="editLessonModalLabel{{ $lesson->id }}">
                                        Editar Lição
                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

                                </div>

                                <form action="{{ route('adminLessonEdit', $lesson->id) }}" method="POST">

                                    @csrf
                                    @method('PUT')

                                    <div class="modal-body">

                                        {{-- Nome --}}
                                        <div class="mb-3">

                                            <label for="edit_lesson_name_{{ $lesson->id }}" class="form-label">
                                                Nome
                                            </label>

                                            <input type="text" id="edit_lesson_name_{{ $lesson->id }}" name="name"
                                                class="form-control" value="{{ $lesson->name }}" required>

                                        </div>


                                        {{-- Descrição --}}
                                        <div class="mb-3">

                                            <label for="edit_lesson_description_{{ $lesson->id }}" class="form-label">
                                                Descrição
                                            </label>

                                            <textarea id="edit_lesson_description_{{ $lesson->id }}" name="description"
                                                class="form-control" rows="3">{{ $lesson->description }}</textarea>

                                        </div>


                                        {{-- Conteúdo --}}
                                        <div>

                                            <label for="edit_lesson_content_{{ $lesson->id }}" class="form-label">
                                                Conteúdo
                                            </label>

                                            <textarea id="edit_lesson_content_{{ $lesson->id }}" name="content" class="form-control"
                                                rows="7" required>{{ $lesson->content }}</textarea>

                                        </div>

                                    </div>


                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancelar
                                        </button>

                                        <button type="submit" class="btn btn-primary">
                                            Salvar alterações
                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>


                    {{-- Modal para deletar a lição --}}
                    <!-- <div id="deleteLessonModal{{ $lesson->id }}" class="modal fade" tabindex="-1"
                        aria-labelledby="deleteLessonModalLabel{{ $lesson->id }}" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="deleteLessonModalLabel{{ $lesson->id }}">
                                        Deletar Lição
                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

                                </div>

                                <div class="modal-body">

                                    Tem certeza que deseja deletar a lição
                                    <strong>{{ $lesson->name }}</strong>?

                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Não
                                    </button>

                                    <form action="{{ route('adminLessonDestroy', $lesson->id) }}" method="POST" class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            Sim, deletar
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div> -->

                @endforeach

            </ul>

        @endif


        {{-- Modal para cadastrar lição --}}
        <div class="modal fade" id="createLessonModal" tabindex="-1" aria-labelledby="createLessonModalLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="createLessonModalLabel">
                            Cadastrar Lição
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

                    </div>


                    <form action="{{ route('adminLessonCreate', $curso->id) }}" method="POST">

                        @csrf

                        <div class="modal-body">

                            {{-- Nome --}}
                            <div class="mb-3">

                                <label for="lesson_name" class="form-label">
                                    Nome
                                </label>

                                <input type="text" id="lesson_name" name="name" class="form-control"
                                    value="{{ old('name') }}" required>

                            </div>


                            {{-- Descrição --}}
                            <div class="mb-3">

                                <label for="lesson_description" class="form-label">
                                    Descrição
                                </label>

                                <textarea id="lesson_description" name="description" class="form-control"
                                    rows="3">{{ old('description') }}</textarea>

                            </div>


                            {{-- Conteúdo --}}
                            <div>

                                <label for="lesson_content" class="form-label">
                                    Conteúdo
                                </label>

                                <textarea id="lesson_content" name="content" class="form-control" rows="7"
                                    required>{{ old('content') }}</textarea>

                            </div>

                        </div>


                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>

                            <button type="submit" class="btn btn-primary">
                                Cadastrar Lição
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- Alunos matriculados --}}
        <div class="mt-3">

            {{-- Cabeçalho da seção --}}
            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    Alunos matriculados - {{ $curso->enrollments->count() }}
                </h5>

                {{-- Matricular aluno --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#createEnrollmentModal">
                    <i class="fa-solid fa-plus me-1"></i>
                    Matricular aluno
                </button>

            </div>

            <hr>


            {{-- Lista de alunos --}}
            @if ($curso->enrollments->isEmpty())

                <div class="alert alert-secondary">
                    Este curso não possui alunos matriculados.
                </div>

            @else

                <ul class="container-fluid d-flex flex-column list-group">

                    @foreach ($curso->enrollments as $enrollment)

                        <li class="list-group-item py-3">

                            <div class="row align-items-center">

                                {{-- Número --}}
                                <div class="col-1 text-center">
                                    {{ $loop->iteration }}
                                </div>

                                {{-- Nome --}}
                                <div class="col-4 fw-semibold">

                                    <a href="{{ route('adminStudent', $enrollment->student_id) }}" class="text-decoration-none">
                                        {{ $enrollment->student->name }}
                                    </a>

                                </div>

                                {{-- Email --}}
                                <div class="col text-secondary">
                                    {{ $enrollment->student->email }}
                                </div>

                                {{-- Status --}}
                                <div class="col-auto">

                                    @if ($enrollment->status)

                                        <span class="badge text-bg-success">
                                            Ativo
                                        </span>

                                    @else

                                        <span class="badge text-bg-secondary">
                                            Inativo
                                        </span>

                                    @endif

                                </div>

                                {{-- Ações --}}
                                <div class="col-auto d-flex align-items-center gap-2">

                                    {{-- Ver aluno --}}
                                    <a href="{{ route('adminStudent', $enrollment->student_id) }}" class="btn btn-outline-primary"
                                        title="Visualizar aluno">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    {{-- Deletar matrícula --}}
                                    <button type="button" class="btn btn-outline-danger" title="Remover matrícula"
                                        data-bs-toggle="modal" data-bs-target="#deleteEnrollmentModal{{ $enrollment->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                </div>

                            </div>

                        </li>


                        {{-- Modal para deletar matrícula --}}
                        <div class="modal fade" id="deleteEnrollmentModal{{ $enrollment->id }}" tabindex="-1"
                            aria-labelledby="deleteEnrollmentModalLabel{{ $enrollment->id }}" aria-hidden="true">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="deleteEnrollmentModalLabel{{ $enrollment->id }}">
                                            Remover matrícula
                                        </h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Fechar"></button>

                                    </div>

                                    <div class="modal-body">

                                        Tem certeza que deseja remover a matrícula de
                                        <strong>{{ $enrollment->student->name }}</strong>
                                        do curso
                                        <strong>{{ $curso->name }}</strong>?

                                    </div>

                                    <div class="modal-footer">

                                        {{-- Não --}}
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Não
                                        </button>

                                        {{-- Sim --}}
                                        <form action="{{ route('adminEnrollmentDestroy', $enrollment->id) }}" method="POST"
                                            class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">
                                                Sim, remover
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </ul>

            @endif

        </div>


        {{-- Modal para matricular aluno --}}
        <div class="modal fade" id="createEnrollmentModal" tabindex="-1" aria-labelledby="createEnrollmentModalLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="createEnrollmentModalLabel">
                            Matricular aluno
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

                    </div>


                    <form action="{{ route('adminEnrollmentCreate') }}" method="POST">

                        @csrf

                        <div class="modal-body">

                            {{-- Curso --}}
                            <div class="mb-3">

                                <label class="form-label">
                                    Curso
                                </label>

                                <input type="text" class="form-control" value="{{ $curso->name }}" disabled>

                                {{-- O curso é enviado pelo formulário --}}
                                <input type="hidden" name="course_id" value="{{ $curso->id }}">

                            </div>


                            {{-- Aluno --}}
                            <div>

                                <label for="student_id" class="form-label">
                                    Aluno
                                </label>

                                <select id="student_id" name="student_id" class="form-select" required>

                                    <option value="">
                                        Selecione um aluno
                                    </option>

                                    @foreach ($alunos as $aluno)

                                        <option value="{{ $aluno->id }}">
                                            {{ $aluno->name }}
                                            — {{ $aluno->email }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>

                            <button type="submit" class="btn btn-primary">
                                Matricular aluno
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    {{-- Modal de exclusão do curso --}}
    <div class="modal fade" id="deleteCursoModal" tabindex="-1" aria-labelledby="deleteCursoModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="deleteCursoModalLabel">
                        Deletar curso
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

                </div>

                <div class="modal-body">

                    Tem certeza que deseja deletar o curso
                    <strong>{{ $curso->name }}</strong>?

                    @if ($curso->lessons->isNotEmpty() || $curso->enrollments->isNotEmpty())

                        <div class="alert alert-warning mt-3 mb-0">

                            <i class="fa-solid fa-triangle-exclamation me-1"></i>

                            Este curso possui:

                            <ul class="mb-0 mt-2">

                                @if ($curso->lessons->isNotEmpty())

                                    <li>
                                        <strong>{{ $curso->lessons->count() }}</strong>
                                        lição(ões) associada(s).
                                    </li>

                                @endif

                                @if ($curso->enrollments->isNotEmpty())

                                    <li>
                                        <strong>{{ $curso->enrollments->count() }}</strong>
                                        aluno(s) matriculado(s).
                                    </li>

                                @endif

                            </ul>

                        </div>

                    @endif

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Não
                    </button>

                    <form action="{{ route('adminCursoDestroy', $curso->id) }}" method="POST" class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            Sim, deletar
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection