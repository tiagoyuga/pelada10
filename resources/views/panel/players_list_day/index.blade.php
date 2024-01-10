@extends('panel._layouts.panel')

@section('_titulo_pagina_', ''.$label)

@section('content')

    @include('panel.players_list_day.nav')

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
                            <a href="#" class="btn btn-primary {{--btn-xs--}}" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">
                                <i class="fa fa-plus"></i> Adicionar
                            </a>
{{--                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button>--}}
                        </div>
                    </div>

                    <div class="ibox-content">

                        <div class="card">

                            <div class="card-header">

                                <div class="form-group">
                                    <label>Selecione uma lista</label>
                                    <select class="form-control" name="teste" id="gamesDays">
                                        <option value="">Selecione</option>
                                        @foreach($eventsDays as $days)
                                            <option value="{{ $days->id }}">{{ \Carbon\Carbon::parse($days->game_day)->format('d/m/Y - H:i') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>Ordem</tr>
                                            <tr>Nome</tr>
                                            <tr>Status</tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>asda</td>
                                            <td>asdsad</td>
                                            <td>asdsa</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selecione o atleta que deseja inserir na lista</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Atleta:</label>

                            <select class="form-control">
                                <option value="">Default select</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')

@endsection

@section('scripts')

    @include('panel._assets.scripts-select2')

    <script>
        $("#gamesDays").select2();
    </script>


@endsection
