@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edição' : 'Cadastro') . ' de '.$label)

@section('content')

    @include('panel.events_user.nav')

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
                              action="{{ isset($item) ? route('events_user.update', $item->id) : route('events_user.store') }}">
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

                                <div class="form-group col-md-3 @if ($errors->has('event_id')) has-error @endif">
                                    <label for="event_id">Event_id</label>
                                    <input type="text" name="event_id" id="event_id" class="form-control"
                                    		value="{{ old('event_id', (isset($item) ? $item->event_id : '')) }}">
                                    {!! $errors->first('event_id','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('is_admin')) has-error @endif">
                                    <label for="is_admin">Is_admin</label>
                                    <input type="text" name="is_admin" id="is_admin" class="form-control"
                                    		value="{{ old('is_admin', (isset($item) ? $item->is_admin : '')) }}">
                                    {!! $errors->first('is_admin','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('expiration_date')) has-error @endif">
                                    <label for="expiration_date">Expiration_date</label>
                                    <div class="input-group date_calendar">
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control mask_date" name="expiration_date"
                                                   id="expiration_date"
                                                   value="{{ old('expiration_date', (isset($item) ? $item->expiration_date : '')) }}">
                                        </div>
                                    </div>
                                    {!! $errors->first('expiration_date','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('owner_id')) has-error @endif">
                                    <label for="owner_id">Owner_id</label>
                                    <input type="text" name="owner_id" id="owner_id" class="form-control"
                                    		value="{{ old('owner_id', (isset($item) ? $item->owner_id : '')) }}">
                                    {!! $errors->first('owner_id','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 @if ($errors->has('updated_user_id')) has-error @endif">
                                    <label for="updated_user_id">Updated_user_id</label>
                                    <input type="text" name="updated_user_id" id="updated_user_id" class="form-control"
                                    		value="{{ old('updated_user_id', (isset($item) ? $item->updated_user_id : '')) }}">
                                    {!! $errors->first('updated_user_id','<span class="help-block m-b-none">:message</span>') !!}
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
                                <a class="btn btn-default" id="ln_listar_form" href="{{ route('events_user.index') }}">
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
