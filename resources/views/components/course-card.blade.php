<li class="list-group-item py-4">

    <div class="row align-items-center">

        {{-- Nome --}}
        <div class="col-12 col-md-3 fw-semibold">
            {{ $curso->name }}
        </div>

        {{-- Professor --}}
        <div class="col-12 col-md-3 text-secondary">
            <strong>Professor:</strong>
            {{ $curso->professor->name }}
        </div>

        {{-- Aulas --}}
        <div class="col-12 col-md-2 text-secondary">
            <strong>Aulas:</strong>
            {{ $curso->lessons->count() }}
        </div>

        {{-- Matriculados --}}
        <div class="col-12 col-md-2 text-secondary">
            <strong>Matriculados:</strong>
            {{ $curso->enrollments->count() }}
        </div>

        {{-- Ações --}}
        <div class="col-12 col-md-2 d-flex justify-content-md-end gap-2 mt-3 mt-md-0">

            {{-- Ver curso --}}
            <a href="{{ route('adminCurso', $curso->id) }}" class="btn btn-outline-primary" title="Visualizar curso">
                <i class="fa-solid fa-eye"></i>
            </a>

            {{-- Editar --}}
            <a href="{{ route('adminCursoEditPage', $curso->id) }}" class="btn btn-outline-warning"
                title="Editar curso">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>

            {{-- Deletar --}}
            <button type="button" class="btn btn-outline-danger" title="Deletar curso" data-bs-toggle="modal"
                data-bs-target="#deleteCursoModal_{{ $curso->id }}">
                <i class="fa-solid fa-trash"></i>
            </button>

        </div>

    </div>

</li>