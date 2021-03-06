@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edição' : 'Cadastro') . ' de '.$label)

@section('content')

    @include('panel.configuration.nav')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>@yield('_titulo_pagina_')</h5>
                    </div>
                    <div class="ibox-content">

                        @if (Auth::user()->is_dev && count($errors) > 0)
                            <div class="alert alert-danger dev-mod">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="post" class="form-horizontal" id="frm_save" autocomplete="off"
                              action="{{ isset($item) ? route('configuration.update', $item->id) : route('configuration.store') }}">
                        {{ method_field(isset($item) ? 'PUT' : 'POST') }}
                        {{ csrf_field() }}

                        <!-- inicio dos campos -->

                            <div class="form-row">
                                <div class="form-group col-md-3 @if ($errors->has('players')) has-error @endif">
                                    <label for="players">Players</label>
                                    <input type="text" name="players" id="players" class="form-control"
                                           value="{{ old('players', (isset($item) ? $item->players : '')) }}">
                                    {!! $errors->first('players','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('game_duration')) has-error @endif">
                                    <label for="game_duration">Game_duration</label>
                                    <input type="text" name="game_duration" id="game_duration" class="form-control"
                                           value="{{ old('game_duration', (isset($item) ? $item->game_duration : '')) }}">
                                    {!! $errors->first('game_duration','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('team1_name')) has-error @endif">
                                    <label for="team1_name">Team1_name</label>
                                    <input type="text" name="team1_name" id="team1_name" class="form-control"
                                           value="{{ old('team1_name', (isset($item) ? $item->team1_name : '')) }}">
                                    {!! $errors->first('team1_name','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('team2_name')) has-error @endif">
                                    <label for="team2_name">Team2_name</label>
                                    <input type="text" name="team2_name" id="team2_name" class="form-control"
                                           value="{{ old('team2_name', (isset($item) ? $item->team2_name : '')) }}">
                                    {!! $errors->first('team2_name','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div
                                    class="form-group col-md-3 @if ($errors->has('max_players_list_limit')) has-error @endif">
                                    <label for="max_players_list_limit">Max_players_list_limit</label>
                                    <input type="text" name="max_players_list_limit" id="max_players_list_limit"
                                           class="form-control"
                                           value="{{ old('max_players_list_limit', (isset($item) ? $item->max_players_list_limit : '')) }}">
                                    {!! $errors->first('max_players_list_limit','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div
                                    class="form-group col-md-3 @if ($errors->has('count_players_leave_both')) has-error @endif">
                                    <label for="count_players_leave_both">Count_players_leave_both</label>
                                    <input type="text" name="count_players_leave_both" id="count_players_leave_both"
                                           class="form-control"
                                           value="{{ old('count_players_leave_both', (isset($item) ? $item->count_players_leave_both : '')) }}">
                                    {!! $errors->first('count_players_leave_both','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                            </div>

                            <!-- fim dos campos -->

                            <input id="routeTo" name="routeTo" type="hidden" value="{{ old('routeTo', 'index') }}">
                            <button class="btn btn-primary" id="bt_salvar" type="submit">
                                <i class="fa fa-save"></i>
                                {{ isset($item) ? 'Salvar Alterações' : 'Salvar' }}
                            </button>

                            @if(!isset($item))
                                <button class="btn btn-default" id="bt_salvar_adicionar" type="submit">
                                    <i class="fa fa-save"></i>
                                    Salvar e adicionar novo
                                </button>
                            @else
<!--                                <a class="btn btn-default" id="ln_listar_form"
                                   href=" route('configuration.index') ">
                                    <i class="fa fa-list-ul"></i>
                                    Listar
                                </a>-->
                        @endif
                        <!-- FIM -->
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('styles')

@endsection


@section('scripts')
    @include('panel._assets.scripts-form')
    {!! $validator->selector('#frm_save') !!}
@endsection
