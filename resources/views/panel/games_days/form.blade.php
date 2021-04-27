@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edição' : 'Cadastro') . ' de '.$label)

@section('content')

    @include('panel.games_days.nav')

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
                              action="{{ isset($item) ? route('games_days.update', $item->id) : route('games_days.store') }}">
                        {{ method_field(isset($item) ? 'PUT' : 'POST') }}
                        {{ csrf_field() }}

                        <!-- inicio dos campos -->

                            <div class="form-row">
                                <div class="form-group col-md-3 @if ($errors->has('game_day')) has-error @endif">
                                    <label for="game_day">Dia</label>
                                    <input type="text" name="game_day" id="game_day" class="form-control"
                                           value="{{ old('game_day', (isset($item) ? $item->game_day->format('d/m/Y') : '')) }}">
                                    {!! $errors->first('game_day','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('game_day')) has-error @endif">
                                    <label for="hour">Hora</label>
                                    <input type="time" name="hour" id="hour" class="form-control"
                                           value="{{ old('hour', (isset($item) ? $item->game_day->format('H:i') : '')) }}">
                                    {!! $errors->first('game_day','<span class="help-block m-b-none">:message</span>') !!}
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
                                <a class="btn btn-default" id="ln_listar_form" href="{{ route('games_days.index') }}">
                                    <i class="fa fa-list-ul"></i>
                                    Listar
                                </a>
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

    <script>
        $("#game_day").datepicker();
        //$("#hour").datetimepicker();
    </script>

@endsection
