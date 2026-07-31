<li class="list-group-item py-4">

    <div class="row align-items-center">

        {{-- Nome --}}
        <div class="col-12 col-md-3 fw-semibold">
            {{ $aluno->name }}
        </div>

        {{-- Email --}}
        <div class="col-12 col-md-3 text-secondary">
            {{ $aluno->email }}
        </div>

        {{-- Data de nascimento --}}
        <div class="col-12 col-md-2 text-secondary">
            {{ $aluno->birth_date }}
        </div>

        {{-- Quantidade de cursos --}}
        <div class="col-12 col-md-2 text-secondary">
            <strong>Cursos:</strong>
            {{ $aluno->enrollments->count() }}
        </div>

        {{-- Ações --}}
        <div class="col-12 col-md-2 d-flex justify-content-md-end gap-2 mt-3 mt-md-0">

            {{-- Visualizar --}}
            <a href="{{ route('adminStudent', $aluno->id) }}" class="btn btn-outline-primary" title="Visualizar aluno">
                <i class="fa-solid fa-eye"></i>
            </a>

            {{-- Editar --}}
            <a href="{{ route('adminStudentEditPage', $aluno->id) }}" class="btn btn-outline-warning"
                title="Editar aluno">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>

            {{-- Deletar --}}
            <button type="button" class="btn btn-outline-danger" title="Deletar aluno" data-bs-toggle="modal"
                data-bs-target="#deleteAlunoModal_{{ $aluno->id }}">
                <i class="fa-solid fa-trash"></i>
            </button>

        </div>

    </div>

</li>