<li class="list-group-item py-4">

    <div class="row align-items-center">

        {{-- Nome --}}
        <div class="col-12 col-md-3 fw-semibold">
            {{ $professor->name }}
        </div>

        {{-- Email --}}
        <div class="col-12 col-md-3 text-secondary">
            {{ $professor->email }}
        </div>

        {{-- Quantidade de cursos --}}
        <div class="col-12 col-md-3 text-secondary">

            <strong>Cursos:</strong>
            {{ $professor->courses->count() }}

        </div>

        {{-- Ações --}}
        <div class="col-12 col-md-3 d-flex justify-content-md-end gap-2 mt-3 mt-md-0">

            {{-- Ver perfil --}}
            <a href="{{ route('adminProfessor', $professor->id) }}" class="btn btn-outline-primary"
                title="Visualizar perfil">
                <i class="fa-solid fa-eye"></i>
            </a>

            {{-- Editar --}}
            <a href="{{ route('adminProfessorEditPage', $professor->id) }}" class="btn btn-outline-warning"
                title="Editar professor">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>

            {{-- Deletar --}}
            <button type="button" class="btn btn-outline-danger" title="Deletar professor" data-bs-toggle="modal"
                data-bs-target="#deleteProfessorModal_{{ $professor->id }}">
                <i class="fa-solid fa-trash"></i>
            </button>

        </div>

    </div>

</li>

