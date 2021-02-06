@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edição' : 'Cadastro') . ' de '.$label)

@section('content')

    @include('panel.configurations.nav')

    <div class="wrapper-content">
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
                              action="{{ isset($item) ? route('configurations.update', $item->id) : route('configurations.store') }}">
                        {{ method_field(isset($item) ? 'PUT' : 'POST') }}
                        {{ csrf_field() }}

                        <!-- inicio dos campos -->

                            <div class="form-row">
                                <div class="form-group col-md-12 @if ($errors->has('name')) has-error @endif">
                                    <label for="name">Nome</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           value="{{ old('name', (isset($item) ? $item->name : '')) }}">
                                    {!! $errors->first('name','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-12 @if ($errors->has('key')) has-error @endif">
                                    <label for="key">Chave</label>
                                    <input type="text" name="key" id="key" class="form-control"
                                           value="{{ old('key', (isset($item) ? $item->key : '')) }}">
                                    {!! $errors->first('key','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-12 @if ($errors->has('value')) has-error @endif">
                                    <label for="value">Valor</label>
                                    <input type="text" name="value" id="value" class="form-control"
                                           value="{{ old('value', (isset($item) ? $item->value : '')) }}">
                                    {!! $errors->first('value','<span class="help-block m-b-none">:message</span>') !!}
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
                                <a class="btn btn-default" id="ln_listar_form"
                                   href="{{ route('configurations.index') }}">
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
