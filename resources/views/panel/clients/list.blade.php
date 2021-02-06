<div class="table-responsive">

    @if($data->count())

        <table class="table table-striped table-bordered table-hover">

            <thead>
            <tr>
                <th style="width: 100px; text-align: center">Ações</th>

                <th>Nome</th>
                <th>E-mail</th>
                <th>Imagem</th>
                <th class="hidden-xs hidden-sm" style="width: 150px;">Criado em</th>
            </tr>
            </thead>
            <tbody>

            @if($data->count())
                @foreach($data as $item)
                    <tr id="{{ 'tr-'.$item->id }}">
                        <td style="text-align: center">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button"
                                        class="btn btn-default dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    Ações
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                    <a class="dropdown-item"
                                       href="{{ route('administrators.profiles', [$item->id]) }}">Perfis</a>
                                    <a class="dropdown-item"
                                       href="{{ route('clients.edit', [$item->id]) }}">Editar</a>
                                    <link-destroy-component
                                        line-id="{{ 'tr-'.$item->id }}"
                                        link="{{ route('clients.destroy', [$item->id]) }}">
                                    </link-destroy-component>
                                </div>
                            </div>
                        </td>

                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>

                        <td class="text-center">
                            @if($item->image)
                                <a href="{{ asset('images/'.$item->image) }}"
                                   target="_blank">
                                    <img src="{{ asset('images/100/'.$item->image) }}">
                                </a>
                                <br/>
                                <a href="{{ route('clients.imageCrop', [$item->id]) }}">
                                    <i class="fa fa-crop"></i>
                                    Recortar
                                </a>
                            @endif
                        </td>

                        <td class="hidden-xs hidden-sm">{{ $item->created_at->format('d/m/Y H:i') }}</td>

                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

        @include('panel._assets.paginate')

    @else
        <div class="alert alert-danger">
            Não temos nada para exibir. Caso tenha realizado uma busca você pode realizar
            uma nova com outros termos ou
            <a class="alert-link" href="{{ route('clients.index') }}">
                limpar sua pesquisa.
            </a>
        </div>
    @endif
</div>
