@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Lista de '.$label)

@section('content')

    @include('panel.events.nav')

    @php

        //$_placeholder_ = "Localize por ''";
    @endphp

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">

                <div class="ibox">

                    <div class="ibox-title">

                        <h5>@yield('_titulo_pagina_')</h5>

                        <div class="ibox-tools">
                            @if(Auth::user()->can('create', \App\Models\Event::class))
                                <a href="{{ route('events.create') }}" class="btn btn-primary {{--btn-xs--}}">
                                    <i class="fa fa-plus"></i> Cadastrar
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="ibox-content">

                        <div class="m-b-lg">
                            <form method="get" id="frm_search" action="{{ route('events.index') }}">
                                @include('panel._assets.basic-search')
                            </form>
                        </div>

                        <div class="table-responsive">

                            @if($data->count())

                                <table class="table table-striped table-bordered table-hover">

                                    <thead>
                                    <tr>
                                        <th style="width: 100px; text-align: center">Ações</th>
                                        <th>Nome</th>
                                        <th>Endereço</th>
                                        <th>Bairro</th>
                                        <th>Número</th>
                                        <th>Telefone 1</th>
                                        <th>Telefone 2</th>
                                        <th>Localidade</th>
                                        <th>Criado por:</th>
                                        <th>Atualizado por:</th>
                                        <th>Quem removeu:</th>
                                        <th class="hidden-xs hidden-sm" style="width: 150px;">Criado em</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($data->count())
                                        @foreach($data as $item)

                                            <tr id="tr-{{ $item->id }}"
                                                class="{{ \Illuminate\Support\Facades\Auth::user()->selected_event == $item->id ? 'bg-primary' : '' }}">
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
                                                               href="{{ route('events.select', [$item->id]) }}">Selecionar</a>

                                                            @can('update', $item)
                                                                <a class="dropdown-item"
                                                                   href="{{ route('events.edit', [$item->id]) }}">Editar</a>
                                                                <link-destroy-component
                                                                    line-id="{{ 'tr-'.$item->id }}"
                                                                    link="{{ route('events.destroy', [$item->id]) }}">
                                                                </link-destroy-component>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->address }}</td>
                                                <td>{{ $item->neighborhood }}</td>
                                                <td>{{ $item->number }}</td>
                                                <td>{{ $item->phone1 }}</td>
                                                <td>{{ $item->phone2 }}</td>
                                                <td>{{ $item->city_name }}</td>
                                                <td>{{ $item->user_creator_id }}</td>
                                                <td>{{ $item->user_updater_id }}</td>
                                                <td>{{ $item->user_eraser_id }}</td>
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
                                    <a class="alert-link" href="{{ route('events.index') }}">
                                        limpar sua pesquisa.
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection
