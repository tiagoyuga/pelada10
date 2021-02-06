<div class="row">
    @if($data->count())
        @foreach($data as $item)
            <div class="col-md-4 mb-4">
                <div class="widget-head-color-box  {{--navy-bg--}} p-2 text-center "
                     style="background-color: #f3f3f3">
                    <div class="{{--m-b-md--}}">
                        <h3 class="font-bold no-margins">
                            {{ $item->name }}
                        </h3>
                        <span>{{ $item->email  }}</span>
                    </div>
                    <div>
                        <span>Data Nascimento: <strong>{{ $item->birth }}</strong></span>
                        |
                        <span>Pontos: <strong>0</strong></span>
                    </div>
                </div>
                <div class="ibox-content">

                </div>
            </div>

            <br>
        @endforeach

    @else
        <div class="col-12">
            <div class="alert alert-danger">
                Não temos nada para exibir. Caso tenha realizado uma busca você pode
                realizar
                uma nova com outros termos ou
                <a class="alert-link" href="{{ route('clients.index') }}">
                    limpar sua pesquisa.
                </a>
            </div>
        </div>
    @endif
</div>
@if($data->count())
    <div class="row">
        <div class="col-12">
            @include('panel._assets.paginate')
        </div>
    </div>
@endif
