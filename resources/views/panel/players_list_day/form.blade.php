@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edição' : 'Cadastro') . ' de '.$label)

@section('content')

    @include('panel.players_list_day.nav')

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
                              action="{{ isset($item) ? route('players_list_day.update', $item->id) : route('players_list_day.store') }}">
                        {{ method_field(isset($item) ? 'PUT' : 'POST') }}
                        {{ csrf_field() }}

                        <!-- inicio dos campos -->
                        
                            <div class="form-row">
                                <div class="form-group col-md-3 @if ($errors->has('user_id')) has-error @endif">
                                    <label for="user_id">Usuário</label>
                                    <input type="text" name="user_id" id="user_id" class="form-control"
                                    		value="{{ old('user_id', (isset($item) ? $item->user_id : '')) }}">
                                    {!! $errors->first('user_id','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('order')) has-error @endif">
                                    <label for="order">Ordem</label>
                                    <input type="text" name="order" id="order" class="form-control"
                                    		value="{{ old('order', (isset($item) ? $item->order : '')) }}">
                                    {!! $errors->first('order','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('active')) has-error @endif">
                                    <label for="active">Ativo?</label>
                                    <select name="active" id="active" class="form-control">
                                        @foreach(config('enums.boolean') as $i => $v)
                                            <option value="{{ $i }}" {{ old('active', (isset($item) ? $item->active : '1')) == $i ? 'selected' : '' }}>{{ $v }} </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('active','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-3 @if ($errors->has('payment')) has-error @endif">
                                    <label for="payment">Payment</label>
                                    <input type="text" name="payment" id="payment" class="form-control"
                                    		value="{{ old('payment', (isset($item) ? $item->payment : '')) }}">
                                    {!! $errors->first('payment','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('goals')) has-error @endif">
                                    <label for="goals">Goals</label>
                                    <input type="text" name="goals" id="goals" class="form-control"
                                    		value="{{ old('goals', (isset($item) ? $item->goals : '')) }}">
                                    {!! $errors->first('goals','<span class="help-block m-b-none">:message</span>') !!}
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
                                <a class="btn btn-default" id="ln_listar_form" href="{{ route('players_list_day.index') }}">
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
@endsection
