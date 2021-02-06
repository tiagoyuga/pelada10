<div class="panel panel-default">
    <div class="panel-heading">
        Filtros
    </div>
    <div class="panel-body">

        <form method="get" id="frm_search" action="{{ $urlSearch }}">

            <div class="row">

                <div class="form-group col-sm-4">
                    <label for="client_group">Tipo de usuário</label>
                    <select class="form-control form-control-lg" name="type_id"
                            id="type_id">
                        <option value="">Todos</option>
                        @foreach($types as $i)
                            <option
                                value="{{ $i->id }}" {{ request('type_id') == $i->id ? 'selected' : null }}>
                                {{ $i->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{--<div class="form-group col-sm-4">
                    <label for="min_points">Pontuação entre</label>
                    <div class="input-group date_calendar">
                        <input type="number" class="form-control" name="min_points"
                               id="min_points" value="{{ request('min_points') }}">
                        <span class="input-group-addon">e</span>
                        <input type="number" class="form-control" name="max_points"
                               id="max_points" value="{{ request('max_points') }}">
                    </div>
                </div>--}}

                <div class="form-group col-sm-4">
                    <label for="min_points">Gênero</label>
                    <select name="gender" id="antifraud" class="form-control">
                        <option value="">Selecione</option>
                        @foreach(config('enums.genders') as $i => $v)
                            <option
                                value="{{ $i }}" {{ request('gender') == $i ? 'selected' : '' }}>
                                {{ $v }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-sm-4">
                    <label for="city_id">Cidade</label>
                    <select class="form-control form-control-lg" name="city_id" id="city_id">
                        <option value="">Selecione</option>
                        @foreach($cityList as $i)
                            <option
                                value="{{ $i->id }}" {{ request('city_id') == $i->id ? 'selected' : null }}>
                                {{ $i->city . ' - ' . $i->state }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-sm-4">
                    <label for="client">Usuários</label>
                    <select class="form-control form-control-lg" name="user_id" id="user_id">
                        <option value="">Todos os usuários</option>
                        @foreach([] as $i)
                            <option
                                value="{{ $i->id }}" {{ request('user_id') == $i->id ? 'selected' : null }}>
                                {{ $i->name . ' - ' . $i->document_number }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{--<div class="form-group col-sm-7">

                </div>--}}
                <div class="form-group col-sm-1 text-right">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary form-control" id="btn_search">
                        <i class="fa fa-search"></i> Pesquisar
                    </button>
                </div>
            </div>

        </form>

    </div>

</div>


