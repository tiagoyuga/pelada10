@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edição' : 'Cadastro') . ' de '.$label)

@section('content')

    @include('panel.events.nav')

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
                              action="{{ isset($item) ? route('events.update', $item->id) : route('events.store') }}">
                        {{ method_field(isset($item) ? 'PUT' : 'POST') }}
                        {{ csrf_field() }}

                        <!-- inicio dos campos -->
                        
                            <div class="form-row">
                                <div class="form-group col-md-3 @if ($errors->has('name')) has-error @endif">
                                    <label for="name">Nome</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                    		value="{{ old('name', (isset($item) ? $item->name : '')) }}">
                                    {!! $errors->first('name','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('address')) has-error @endif">
                                    <label for="address">Endereço</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                    		value="{{ old('address', (isset($item) ? $item->address : '')) }}">
                                    {!! $errors->first('address','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('neighborhood')) has-error @endif">
                                    <label for="neighborhood">Bairro</label>
                                    <input type="text" name="neighborhood" id="neighborhood" class="form-control"
                                    		value="{{ old('neighborhood', (isset($item) ? $item->neighborhood : '')) }}">
                                    {!! $errors->first('neighborhood','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('number')) has-error @endif">
                                    <label for="number">Número</label>
                                    <input type="text" name="number" id="number" class="form-control"
                                    		value="{{ old('number', (isset($item) ? $item->number : '')) }}">
                                    {!! $errors->first('number','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('phone1')) has-error @endif">
                                    <label for="phone1">Telefone 1</label>
                                    <input type="text" name="phone1" id="phone1" class="form-control"
                                    		value="{{ old('phone1', (isset($item) ? $item->phone1 : '')) }}">
                                    {!! $errors->first('phone1','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('phone2')) has-error @endif">
                                    <label for="phone2">Telefone 2</label>
                                    <input type="text" name="phone2" id="phone2" class="form-control"
                                    		value="{{ old('phone2', (isset($item) ? $item->phone2 : '')) }}">
                                    {!! $errors->first('phone2','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('city_name')) has-error @endif">
                                    <label for="city_name">Localidade</label>
                                    <input type="text" name="city_name" id="city_name" class="form-control"
                                    		value="{{ old('city_name', (isset($item) ? $item->city_name : '')) }}">
                                    {!! $errors->first('city_name','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-row">                            </div>

                            <div class="form-row">                            </div>

                            <div class="form-row">                            </div>

                            <div class="form-row">                            </div>

                            <div class="form-row">                            </div>

                            <div class="form-row">                            </div>

                            <div class="form-row">                            </div>

                            <div class="form-row">                            </div>

                            <div class="form-row">                            </div>

                            <div class="form-row">
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
                                <a class="btn btn-default" id="ln_listar_form" href="{{ route('events.index') }}">
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
