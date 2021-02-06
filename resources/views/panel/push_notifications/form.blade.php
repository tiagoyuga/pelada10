@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edição' : 'Cadastro') . ' de '.$label)

@section('content')

    @include('panel.push_notifications.nav')

    <div class="wrapper wrapper-content animated fadeIn">
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

                        <div class="m-b-lg">

                            @php
                                $urlSearch = route('push_notifications.create')
                            @endphp
                            @include('panel.push_notifications.search')

                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Enviar notificação
                            </div>
                            <div class="panel-body">

                                <div class="table-responsive">

                                    @if($data->count())

                                        <form method="post" class="form-horizontal" id="frm_save" autocomplete="off"
                                              action="{{ route('push_notifications.store') }}">
                                        {{ method_field('POST') }}
                                        {{ csrf_field() }}

                                        <!-- inicio dos campos -->

                                            <input type="hidden" name="filters"
                                                   value="{{ json_encode(request()->all()) }}">

                                            <div class="form-row">
                                                <div
                                                    class="form-group col-md-12 @if ($errors->has('message')) has-error @endif">
                                                    <label for="answer">Título</label>
                                                    <input type="text" name="title" id="title"
                                                           class="form-control"
                                                           value="{{ old('title', (isset($item) ? $item->title : '')) }}"
                                                    >
                                                    {!! $errors->first('message','<span class="help-block m-b-none">:message</span>') !!}
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div
                                                    class="form-group col-md-12 @if ($errors->has('message')) has-error @endif">
                                                    <label for="answer">Mensagem</label>
                                                    <textarea type="textarea" name="message" id="message"
                                                              class="form-control">{{ old('message', (isset($item) ? $item->message : '')) }}</textarea>
                                                    {!! $errors->first('message','<span class="help-block m-b-none">:message</span>') !!}
                                                </div>
                                            </div>

                                            <!-- fim dos campos -->

                                            <input id="routeTo" name="routeTo" type="hidden"
                                                   value="{{ old('routeTo', 'index') }}">
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
                                                   href="{{ route('push_notifications.index') }}">
                                                    <i class="fa fa-list-ul"></i>
                                                    Listar
                                                </a>
                                        @endif
                                        <!-- FIM -->
                                        </form>

                                        <hr>

                                        <table class="table table-striped table-bordered table-hover">

                                            <thead>
                                            <tr>
                                                <th>Usuário</th>
                                                <th>Email</th>
                                                <th class="hidden-xs hidden-sm" style="width: 150px;">Criado em</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            @if($data->count())
                                                @foreach($data as $item)
                                                    <tr>
                                                        <td>
                                                    <span>
                                                        @if($item->image)
                                                            <img src="{{ asset('images/'.$item->image) }}"
                                                                 class="img img-preview-sm img-circle img-md">
                                                        @else
                                                            <img src="{{ asset('img/default-user-avatar.jpeg') }}"
                                                                 class="img img-preview-sm img-circle img-md">
                                                        @endif

                                                        {{ $item->name }}
                                                    </span>
                                                        </td>
                                                        <td>{{ $item->email }}</td>
                                                        <td class="hidden-xs hidden-sm">{{ $item->created_at->format('d/m/Y H:i') }}</td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>

                                        @include('panel._assets.paginate')

                                    @else
                                        <div class="alert alert-danger">
                                            Não temos nada para exibir. Caso tenha realizado uma busca você pode
                                            realizar
                                            uma nova com outros termos ou
                                            <a class="alert-link" href="{{ route('push_notifications.index') }}">
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
        </div>

    </div>

@endsection


@section('styles')

@endsection


@section('scripts')
    @include('panel._assets.scripts-form')
    @include('panel._assets.scripts-select2')
    {!! $validator->selector('#frm_save') !!}
    <script>
        $().ready(function () {

            performRemoteSearch({
                element: '#user_id',
                url: '{{ route('users.find') }}',
                textOption: function (item) {
                    return item.name + " - " + item.document_number;
                }
            });

            performRemoteSearch({
                element: '#city_id',
                url: '{{ route('cities.find') }}',
                textOption: function (item) {
                    return item.city + " - " + item.state;
                }
            });

        });
    </script>
@endsection
