@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edição' : 'Cadastro') . ' de '.$label)

@section('content')

    @include('panel.users.nav')

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
                              action="{{ isset($item) ? route('users.update', $item->id) : route('users.store') }}">
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

                                <div class="form-group col-md-3 @if ($errors->has('email')) has-error @endif">
                                    <label for="email">E-mail</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                    		value="{{ old('email', (isset($item) ? $item->email : '')) }}">
                                    {!! $errors->first('email','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('nickname')) has-error @endif">
                                    <label for="nickname">Apelido</label>
                                    <input type="text" name="nickname" id="nickname" class="form-control"
                                    		value="{{ old('nickname', (isset($item) ? $item->nickname : '')) }}">
                                    {!! $errors->first('nickname','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('shirt_number')) has-error @endif">
                                    <label for="shirt_number">Número da Camisa</label>
                                    <input type="text" name="shirt_number" id="shirt_number" class="form-control"
                                    		value="{{ old('shirt_number', (isset($item) ? $item->shirt_number : '')) }}">
                                    {!! $errors->first('shirt_number','<span class="help-block m-b-none">:message</span>') !!}
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

                                <div class="form-group col-md-3 @if ($errors->has('whatsapp')) has-error @endif">
                                    <label for="whatsapp">Whatsapp</label>
                                    <input type="text" name="whatsapp" id="whatsapp" class="form-control"
                                    		value="{{ old('whatsapp', (isset($item) ? $item->whatsapp : '')) }}">
                                    {!! $errors->first('whatsapp','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('image')) has-error @endif">
                                    <label for="image">Imagem</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    {!! $errors->first('image','<span class="help-block m-b-none">:message</span>') !!}
                                    @if(isset($item) && $item->image)
                                        <br/>
                                        <label> <input type="checkbox" value="1" name="delete_image">
                                            Remover image?
                                        </label>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('birth')) has-error @endif">
                                    <label for="birth">Data de nascimento</label>
                                    <input type="text" name="birth" id="birth" class="form-control"
                                    		value="{{ old('birth', (isset($item) ? $item->birth : '')) }}">
                                    {!! $errors->first('birth','<span class="help-block m-b-none">:message</span>') !!}
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
                                <a class="btn btn-default" id="ln_listar_form" href="{{ route('users.index') }}">
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
