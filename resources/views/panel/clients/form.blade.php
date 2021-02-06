@extends('panel._layouts.panel')

@section('_titulo_pagina_', (isset($item) ? 'Edição' : 'Cadastro') . ' de '.$label)

@section('content')

    @include('panel.clients.nav')

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
                              enctype="multipart/form-data"
                              action="{{ isset($item) ? route('clients.update', $item->id) : route('clients.store') }}">
                        {{ method_field(isset($item) ? 'PUT' : 'POST') }}
                        {{ csrf_field() }}

                        <!-- inicio dos campos -->

                            <div class="form-row">
                                <div class="form-group col-md-12 @if ($errors->has('name')) has-error @endif">
                                    <label for="name">Nome *</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           value="{{ old('name', (isset($item) ? $item->name : '')) }}">
                                    {!! $errors->first('name','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 @if ($errors->has('document_number')) has-error @endif">
                                    <label for="document_number">CPF</label>
                                    <input type="text" name="document_number" id="document_number"
                                           class="form-control mask_cpf"
                                           value="{{ old('document_number', (isset($item) ? $item->document_number : '')) }}">
                                    {!! $errors->first('document_number','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-6 @if ($errors->has('rg')) has-error @endif">
                                    <label for="rg">Rg</label>
                                    <input type="text" name="rg" id="rg" class="form-control"
                                           value="{{ old('rg', (isset($item) ? $item->rg : '')) }}">
                                    {!! $errors->first('rg','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 @if ($errors->has('gender')) has-error @endif">
                                    <label for="gender">Gênero</label>
                                    <select name="gender" id="gender" class="form-control">
                                        @foreach(config('enums.genders') as $key=>$gender)
                                            <option value="{{$key}}">{{ $gender }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('gender','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-6 @if ($errors->has('birth')) has-error @endif">
                                    <label for="birth">Data de nascimento</label>
                                    <input type="text" name="birth" id="birth" class="form-control mask_date"
                                           value="{{ old('birth', (isset($item) && $item->birth ? $item->birth->format('d/m/Y'): '')) }}">
                                    {!! $errors->first('birth','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 @if ($errors->has('phone1')) has-error @endif">
                                    <label for="phone1">Telefone 1</label>
                                    <input type="text" name="phone1" id="phone1"
                                           class="form-control mask_phone_with_ddd"
                                           value="{{ old('phone1', (isset($item) ? $item->phone1 : '')) }}">
                                    {!! $errors->first('phone1','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-6 @if ($errors->has('phone2')) has-error @endif">
                                    <label for="phone2">Telefone 2</label>
                                    <input type="text" name="phone2" id="phone2"
                                           class="form-control mask_phone_with_ddd"
                                           value="{{ old('phone2', (isset($item) ? $item->phone2 : '')) }}">
                                    {!! $errors->first('phone2','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12 @if ($errors->has('image')) has-error @endif">
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
                            </div>


                            <div class="form-row">
                                <h5 class="col-md-12 p-1" style="border-bottom: 1px solid #f0f0f0">Dados de Acesso</h5>
                                <div class="form-group col-md-6 @if ($errors->has('email')) has-error @endif">
                                    <label for="email">E-mail *</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                           value="{{ old('email', (isset($item) ? $item->email : '')) }}">
                                    {!! $errors->first('email','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 @if ($errors->has('password')) has-error @endif">
                                    <label for="password">Senha *</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                           value="">
                                    {!! $errors->first('password','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                                <div
                                    class="form-group col-md-6 @if ($errors->has('password_confirmation')) has-error @endif">
                                    <label for="password_confirmation">Confirmar Senha *</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control"
                                           value="">
                                    {!! $errors->first('password_confirmation','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                            </div>
                            @php $address = isset($item) ? $item->address: null @endphp

                            <div class="form-row">
                                <h5 class="col-md-12 p-1" style="border-bottom: 1px solid #f0f0f0">Endereço
                                    Principal</h5>
                                <div class="form-group col-md-6 @if ($errors->has('postal_code')) has-error @endif">
                                    <label for="postal_code">CEP *</label>
                                    <input type="text" name="postal_code" id="postal_code" class="form-control mask_cep"
                                           value="{{ old('postal_code', (isset($item) && $address ? $address->postal_code : '')) }}">
                                    {!! $errors->first('postal_code','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12 @if ($errors->has('address')) has-error @endif">
                                    <label for="address">Endereço</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                           value="{{ old('address', (isset($item)  && $address ?  $address->address : '')) }}">
                                    {!! $errors->first('address','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4 @if ($errors->has('number')) has-error @endif">
                                    <label for="number">Número</label>
                                    <input type="text" name="number" id="number" class="form-control"
                                           value="{{ old('number', (isset($item)  && $address ?  $address->number : '')) }}">
                                    {!! $errors->first('number','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-8 @if ($errors->has('complement')) has-error @endif">
                                    <label for="complement">Complemento</label>
                                    <input type="text" name="complement" id="complement" class="form-control"
                                           value="{{ old('complement', (isset($item)  && $address ?  $address->complement : '')) }}">
                                    {!! $errors->first('complement','<span class="help-block m-b-none">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 @if ($errors->has('neighborhood')) has-error @endif">
                                    <label for="neighborhood">Bairro</label>
                                    <input type="text" name="neighborhood" id="neighborhood" class="form-control"
                                           value="{{ old('neighborhood', (isset($item)  && $address ?  $address->neighborhood : '')) }}">
                                    {!! $errors->first('neighborhood','<span class="help-block m-b-none">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-6 @if ($errors->has('city_id')) has-error @endif">
                                    <label for="city_id">Cidade *</label>
                                    <select class="form-control form-control-lg" style="width: 100%"
                                            name="city_id"
                                            id="city_id">
                                        <option value="">Selecione uma cidade</option>
                                        @foreach($cityList as $i)
                                            <option
                                                value="{{ $i->id }}" {{ old('city_id', (isset($item)  && $address ? $address->city_id : '')) == $i->id ? 'selected' : null }}>
                                                {{ $i->city . ' - ' . $i->state }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('city_id','<span class="help-block m-b-none">:message</span>') !!}
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
                                <a class="btn btn-default" id="ln_listar_form" href="{{ route('clients.index') }}">
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
    <script src="{{ file_version(asset('js/custom-select2.js')) }}"></script>
    <script src="{{ file_version(asset('vendor/postal_code.js')) }}" type="text/javascript"></script>

    <script>
        $().ready(function () {

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
