@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Lista de '.$label)

@section('content')

    @include('panel.users.nav')

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
                            @if(Auth::user()->can('create', \App\Models\User::class))
                                <a href="{{ route('users.create') }}" class="btn btn-primary {{--btn-xs--}}">
                                    <i class="fa fa-plus"></i> Cadastrar
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="ibox-content">

                        <div class="m-b-lg">
                            <form method="get" id="frm_search" action="{{ route('users.index') }}">
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
                                        <th>E-mail</th>
                                        <th>Apelido</th>
                                        <th>Número da Camisa</th>
                                        <th>Telefone 1</th>
                                        <th>Telefone 2</th>
                                        <th>Whatsapp</th>
                                        <th>Imagem</th>
                                        <th>Data de nascimento</th>
                                        <th class="hidden-xs hidden-sm" style="width: 150px;">Criado em</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($data->count())
                                        @foreach($data as $item)
                                            <tr id="tr-{{ $item->id }}">
                                                <td style="text-align: center">
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button"
                                                                class="btn btn-default dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            Ações
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            <a class="dropdown-item" href="{{ route('users.edit', [$item->id]) }}">Editar</a>
                                                            <link-destroy-component
                                                                line-id="{{ 'tr-'.$item->id }}"
                                                                link="{{ route('users.destroy', [$item->id]) }}">
                                                            </link-destroy-component>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->nickname }}</td>
                                                <td>{{ $item->shirt_number }}</td>
                                                <td>{{ $item->phone1 }}</td>
                                                <td>{{ $item->phone2 }}</td>
                                                <td>{{ $item->whatsapp }}</td>

                                                <td class="text-center">
                                                    @if($item->image)
                                                        <a href="{{ asset('images/'.$item->image) }}" target="_blank">
                                                            <img src="{{ asset('images/100/'.$item->image) }}">
                                                        </a>
                                                        <br/>
                                                        <a href="{{ route('users.imageCrop', [$item->id]) }}">
                                                            <i class="fa fa-crop"></i>
                                                            Recortar
                                                        </a>
                                                    @endif
                                                </td>

                                                <td>{{ $item->birth }}</td>
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
                                    <a class="alert-link" href="{{ route('users.index') }}">
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
