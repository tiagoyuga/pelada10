@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Lista de '.$label)

@section('content')

    @include('panel.management_indications.nav')

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">

                <div class="ibox">

                    <div class="ibox-content">

                        <div class="m-b-lg">

                            <form method="get" id="frm_search" action="{{ route('management_indications.index') }}">

                                <div class="row">

                                    <div class="form-group col-sm-6">
                                        <label for="client">Cliente</label>
                                        <select class="form-control form-control-lg" name="client_id" id="client_id">
                                            <option value="">Todo os clientes</option>
                                            @foreach($clientList as $i)
                                                <option
                                                    value="{{ $i->id }}" {{ request('client_id') == $i->id ? 'selected' : null }}>
                                                    {{ $i->name . ' - ' . $i->document_number }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Datas entre</label>
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

                                </div>

                                <div class="row">

                                    <div class="form-group col-sm-5">
                                        <label for="code">Código</label>
                                        <input type="text" id="code" name="code" class="form-control"
                                               value="{{ request('code') }}">
                                    </div>

                                    <div class="form-group col-sm-5">
                                        <label for="link">Link</label>
                                        <input type="text" id="link" name="link" class="form-control"
                                               value="{{ request('link') }}">
                                    </div>


                                    <div class="form-group col-sm-2 text-right">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary form-control" id="btn_search">
                                            <i class="fa fa-search"></i> Pesquisar
                                        </button>
                                    </div>

                                </div>

                            </form>

                        </div>

                        <div class="table-responsive">

                            @if($data->count())

                                <table class="table table-striped table-bordered table-hover">

                                    <thead>
                                    <tr>
                                        {{--<th style="width: 100px; text-align: center">Ações</th>--}}
                                        <th>Usuário</th>
                                        <th>Link</th>
                                        <th>Cadastros</th>
                                        <th>Visualizações</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($data->count())

                                        @foreach($data as $item)

                                            <tr>

                                                <td>{{ $item->management->name }}</td>
                                                <td>
                                                    <strong>Url: </strong>{{ $item->management->indication_url }}
                                                    <br>
                                                    <strong>Código de
                                                        indicação:</strong> {{ $item->management->indication_code }}
                                                </td>
                                                <td>
                                                    @if($item->management->totalRegisters > 0)
                                                        <a href="{{ route('users.index') }}?indication_id={{$item->management->user_id}}"
                                                           class="">
                                                            <i class="fa fa-external-link"> </i> {{ $item->management->totalRegisters }}
                                                        </a>
                                                    @else
                                                        {{ $item->management->totalRegisters }}
                                                    @endif
                                                </td>
                                                <td>{{ $item->management->totalViews }}</td>

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
                                    <a class="alert-link" href="{{ route('management_indications.index') }}">
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

    @include('panel._assets.scripts-datepicker')
    @include('panel._assets.scripts-select2')

    <script>
        $().ready(function () {

            performRemoteSearch({
                element: '#client_id',
                url: '{{ route('users.find') }}',
                textOption: function (item) {

                    return item.name + " - " + item.document_number;
                }
            });

        });
    </script>
@endsection
