@php
    $isDev = Auth::user()->is_dev;
    $isAdmin = (Auth::user()->is_dev || Auth::user()->isAdminOfSelectedEvent());
@endphp

<div class="row border-bottom white-bg">
    <nav class="navbar navbar-expand-lg navbar-static-top" role="navigation">
        {{--<nav class="navbar-default navbar-static-side" role="navigation">--}}

        <a href="{{ route('home') }}" class="navbar-brand text-center">
            {{ env('APP_NAME') }}
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-reorder"></i>
        </button>

        <!--</div>-->
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav mr-auto">

                <li class="{{ isActiveRoute('home') }}">
                    <a aria-expanded="false" role="button" href="{{ route('home') }}">
                        <i class="fa fa-home"></i>
                        <span class="nav-label">Início</span>
                    </a>
                </li>

                @if($isAdmin)

                    <li class="dropdown {{ isActiveRoute(['users.*', 'configurations.*']) }}">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                            Configurações
                        </a>
                        <ul role="menu" class="dropdown-menu">

                            <li class="bg-muted">
                                <a href="{{ route('configuration.edit', Auth::user()->selectedEventConfig ? Auth::user()->selectedEventConfig->id : 0) }}">Configurações</a>
                            </li>

                            <li class="bg-muted">
                                <a href="{{ route('users.index') }}">Usuários</a>
                            </li>

                            <li class="bg-muted">
                                <a href="#">Advertências</a>
                            </li>

                            <li class="bg-muted">
                                <a href="#">Histórico de participação</a>
                            </li>

                            <li class="bg-muted">
                                <a href="#">Regulamentos</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="dropdown {{ isActiveRoute(['events.*']) }}">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bar-chart-o"></i>
                        Grupos de Futebol
                    </a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="{{ route('events.index') }}">Grupos (Eventos)</a></li>
                        <li><a href="{{ route('games_days.index') }}">Dias de Futebol</a>
                        <li><a href="#">Lista de Atletas</a>
                        <li><a href="#">Histórico de Jogos</a>
                        <li><a href="#">Participantes</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown {{ isActiveRoute(['banners.*', 'coupons.*']) }}">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bar-chart-o"></i>
                        Outros
                    </a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#">Regulamentos</a></li>
                        <li><a href="#">Comunicados</a></li>
                        <li><a href="#">Avaliar</a></li>
                        <li><a href="#">Suporte</a></li>
                        <li><a href="#">Sair do Futebol</a></li>
                    </ul>
                </li>

                <li class="{{ isActiveRoute('ratings.*') }}">
                    <a aria-expanded="false" role="button" href="#">
                        <i class="fa fa-list-ul"></i>
                        <span class="nav-label">Jogos</span>
                    </a>
                </li>

                <li class="{{ isActiveRoute('ratings.*') }}">
                    <a aria-expanded="false" role="button" href="#">
                        <i class="fa fa-list-ul"></i>
                        <span class="nav-label">Convidar Amigos</span>
                    </a>
                </li>

                <li class="{{ isActiveRoute('ratings.*') }}">
                    <a aria-expanded="false" role="button" href="#">
                        <i class="fa fa-list-ul"></i>
                        <span class="nav-label">Sobre</span>
                    </a>
                </li>

                <li class="{{ isActiveRoute('ratings.*') }}">
                    <a aria-expanded="false" role="button" href="#">
                        <i class="fa fa-list-ul"></i>
                        <span class="nav-label">Notificações</span>
                    </a>
                </li>

            </ul>

            <form name="frm_new_users_notifications" id="frm_new_users_notifications">
                {{ method_field('POST') }}
                {{ csrf_field() }}
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="{{ route('profile') }}">
                            <i class="fa fa-user"></i>Perfil
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Sair
                        </a>
                    </li>
                </ul>
            </form>

        </div>
    </nav>
</div>
