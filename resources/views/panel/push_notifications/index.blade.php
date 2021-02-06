@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Lista de '.$label)

@section('content')

    @include('panel.push_notifications.nav')

    <div class="wrapper wrapper-content animated fadeIn">

        <div class="row">
            <div class="col-lg-12">

                <div class="ibox">

                    <div class="ibox-title">

                        {{--<h5>@yield('_titulo_pagina_')</h5>--}}

                        <div class="ibox-tools">
                            {{--@if(Auth::user()->can('create', \App\Models\PushNotification::class))--}}
                                <a href="{{ route('push_notifications.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Cadastrar
                                </a>
                            {{--@endif--}}
                        </div>

                    </div>

                    <div class="ibox-content">

                        {{--<div class="m-b-lg">
                            <form method="get" id="frm_search" action="{{ route('push_notifications.index') }}">
                                @include('panel._assets.basic-search')
                            </form>
                        </div>--}}

                        <div class="m-b-lg">

                            {{--@php
                                $urlSearch = route('push_notifications.index')
                            @endphp
                            @include('panel.push_notifications.search')--}}

                            <form method="get" id="frm_search" action="{{ route('push_notifications.index') }}">

                                <div class="row">

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Cadastrado entre</label>
                                            <div class="input-group date_calendar">
                                                <input type="text" class="form-control mask_date datepicker"
                                                       name="start_date"
                                                       id="start_date" value="{{ request('start_date') }}">
                                                <span class="input-group-addon">e</span>
                                                <input type="text" class="form-control mask_date datepicker"
                                                       name="end_date"
                                                       id="end_date" value="{{ request('end_date') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-1 text-right">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary form-control" id="btn_search">
                                            <i class="fa fa-search"></i> Pesquisar
                                        </button>
                                    </div>
                                </div>

                            </form>


                            <div class="table-responsive">

                                @if($data->count())

                                    <table class="table table-striped table-bordered table-hover">

                                        <thead>
                                        <tr>
                                            <th>Mensagem</th>
                                            <th>Filtros</th>
                                            <th>Quantidade de usuários</th>
                                            <th class="hidden-xs hidden-sm" style="width: 150px;">Criado em</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        @if($data->count())
                                            @foreach($data as $item)
                                                <tr>
                                                    <td>
                                                        <strong>Título: </strong>{{ $item->title }}<br>
                                                        <strong>Mensagem: </strong>{{ $item->message }}
                                                    </td>

                                                    {{--<td>{{ $item->filters }}</td>--}}
                                                    <td>
                                                        @foreach($item->translatedFilters as $key=>$val)
                                                            <strong>{{ $key }}: </strong> {{ $val }} <br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ count(json_decode($item->users)) }}</td>

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
                                        <a class="alert-link" href="{{ route('push_notifications.index') }}">
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

    </div>
@endsection

@section('styles')

@endsection

@section('scripts')

    @include('panel._assets.scripts-datepicker')

@endsection
