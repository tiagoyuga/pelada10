@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Lista de '.$label)

@section('content')

    @include('panel.clients.nav')

    @php

        //$_placeholder_ = "Localize por ''";
    @endphp

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">

                <div class="ibox">

                    <div class="ibox-title">

                        {{--<h5>@yield('_titulo_pagina_')</h5>--}}

                        <div class="ibox-tools">
                            @if(Auth::user()->can('create', \App\Models\User::class))
                                <a href="{{ route('clients.create') }}" class="btn btn-primary {{--btn-xs--}}">
                                    <i class="fa fa-plus"></i> Cadastrar
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="ibox-content">

                        <div class="m-b-lg">
                            <form method="get" id="frm_search" action="{{ route('clients.index') }}">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="name">Nome</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                               value="{{ request('name') }}"
                                               placeholder="Localizar por nome">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" name="email" class="form-control"
                                               value="{{ request('email') }}"
                                               placeholder="Localizar por email">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="document_number">CPF</label>
                                        <input type="text" name="document_number" id="document_number"
                                               class="form-control mask_cpf"
                                               value="{{ request('document_number')}}">
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
                        <div class="form-row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2 text-right">
                                <div class="btn-group" role="group" aria-label="">
                                    <button onclick="showStyle('list')" type="button" class="btn btn-default">Lista
                                    </button>
                                    <button onclick="showStyle('card')" type="button" class="btn btn-default">Card
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if($showStyle == 'card')
                            @include('panel.clients.card')
                        @else
                            @include('panel.clients.list')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')

@endsection

@section('scripts')
    <script>
        function showStyle(type) {
            if (type != $('#show_style').val) {
                $('#show_style').val(type);
                $('#frm_search').append('<input type="hidden" name="show_style" id="show_style" value="' + type + '">');
                $('#frm_search').submit()
            }
        }
    </script>
@endsection
