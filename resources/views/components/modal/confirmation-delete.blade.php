<div class="modal fade" id="{{$id}}" tabindex="-1" aria-labelledby="{{$ariaLabelId}}" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="{{ $ariaLabelId }}">
                    {{$title}}
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

            </div>

            <div class="modal-body">
                {{ $description }}
                <strong>{{ $dados->name }}</strong>?

                @if ($countDependances)
                    <div class="alert alert-warning mt-3 mb-0">
                        
                        @foreach($countDependances as $countDependance)
                            <div>
                                {{ $dependanceDescription }}
                                <strong>{{ $countDependance['count'] }}</strong>
                                {{ $countDependance['name'] }}
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Não
                </button>

                <form action="{{ $formRoute }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Sim, Deletar
                    </button>
                </form>
            </div>



        </div>

    </div>

</div>