@php
    $userIsDev = Auth::user()->is_dev;
    $userIsAdmin = true
@endphp

<div class="row border-bottom white-bg">
    <nav class="navbar navbar-expand-lg navbar-static-top" role="navigation">
    {{--<nav class="navbar-default navbar-static-side" role="navigation">--}}

        <a href="{{ route('dashboard') }}" class="navbar-brand text-center">
            {{ env('APP_NAME') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-reorder"></i>
        </button>

        <!--</div>-->
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav mr-auto">

                <li class="{{ isActiveRoute('dashboard') }}">
                    <a aria-expanded="false" role="button" href="{{ route('dashboard') }}">
                        <i class="fa fa-home"></i>
                        <span class="nav-label">Início</span>
                    </a>
                </li>
                @if($userIsDev || $userIsAdmin)
                    <li class="dropdown {{ isActiveRoute(['types.*', 'configurations.*', 'banner_types.*', 'payment_methods.*', 'payment_options.*', 'administrators.*', 'categories.*', 'cashback_campaigns.*']) }}">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                            Configurações
                        </a>
                        <ul role="menu" class="dropdown-menu">
                            @if($userIsDev)
                                {{--<li class="bg-muted">
                                    <a href="{{ route('types.index') }}">Tipos de Usuários</a>
                                </li>
                                <li class="bg-muted">
                                    <a href="{{ route('configurations.index') }}">Configurações</a>
                                </li>
                                <li class="bg-muted">
                                    <a href="{{ route('banner_types.index') }}">Tipos de Banners</a>
                                </li>
                                <li class="bg-muted">
                                    <a href="{{ route('payment_options.index') }}">Opções de Pagamento</a>
                                </li>
                                <li class="bg-muted">
                                    <a href="{{ route('payment_methods.index') }}">Meios de Pagamento</a>
                                </li>
                                <li class="bg-muted">
                                    <a href="{{ route('push_notifications.index') }}">Notificações de usuários</a>
                                </li>--}}

                            @endif
                            {{--<li><a href="{{ route('administrators.index') }}">Administradores</a></li>
                            <li><a href="{{ route('categories.index') }}">Categorias de Produtos</a></li>
                            <li><a href="{{ route('cashback_campaigns.index') }}">Cashback</a></li>
                            <li><a href="{{ route('management_indications.index') }}">Gerenciamento de indicações</a>
                            </li>
                            <li><a href="{{ route('pickup_addresses.index') }}">Locais para retiradas</a>
                            </li>
                            <li><a href="{{ route('first_purchase.index') }}">Pontuação de indicações</a></li>
                            <li><a href="{{ route('ratings.index') }}">Avaliação de vendas</a></li>--}}
                        </ul>
                    </li>
                @endif

                {{--<li class="{{ isActiveRoute('products.*') }}">
                    <a aria-expanded="false" role="button" href="{{ route('banners.index') }}">
                        <i class="fa fa-image"></i>
                        <span class="nav-label">Banners</span>
                    </a>
                </li>
                <li class="{{ isActiveRoute('products.*') }}">
                    <a aria-expanded="false" role="button" href="{{ route('coupons.index') }}">
                        <i class="fa fa-ticket"></i>
                        <span class="nav-label">Cupons</span>
                    </a>
                </li>
                <li class="{{ isActiveRoute('products.*') }}">
                    <a aria-expanded="false" role="button" href="{{ route('products.index') }}">
                        <i class="fa fa-product-hunt"></i>
                        <span class="nav-label">Produtos</span>
                    </a>
                </li>
                <li class="{{ isActiveRoute('clients.*') }}">
                    <a aria-expanded="false" role="button" href="{{ route('clients.index') }}">
                        <i class="fa fa-user"></i>
                        <span class="nav-label">Clientes</span>
                    </a>
                </li>
                <li class="{{ isActiveRoute('sales.*') }}">
                    <a aria-expanded="false" role="button" href="{{ route('sales.index') }}">
                        <i class="fa fa-sort-numeric-asc"></i>
                        <span class="nav-label">Vendas</span>
                    </a>
                </li>
                <li class="{{ isActiveRoute('ratings.*') }}">
                    <a aria-expanded="false" role="button" href="{{ route('ratings.index') }}">
                        <i class="fa fa-list-ul"></i>
                        <span class="nav-label">Avaliações</span>
                    </a>
                </li>
                <li class="dropdown {{ isActiveRoute(['banners.*', 'coupons.*']) }}">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bar-chart-o"></i>
                        Relatórios
                    </a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="{{ route('reports.ratings') }}">Avaliações</a></li>

                        <li><a href="{{ route('reports.rating-sales.analytic') }}">Avaliações de vendas (Analítico)</a>
                        </li>
                    </ul>
                </li>--}}

                <li class="dropdown {{ isActiveRoute(['banners.*', 'coupons.*']) }}">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bar-chart-o"></i>
                        Eventos
                    </a>
                    {{--<ul role="menu" class="dropdown-menu">
                        <li><a href="{{ route('reports.ratings') }}">Avaliações</a></li>

                        <li><a href="{{ route('reports.rating-sales.analytic') }}">Avaliações de vendas (Analítico)</a>
                        </li>
                    </ul>--}}
                </li>
            </ul>

            <form name="frm_new_users_notifications" id="frm_new_users_notifications">
                {{ method_field('POST') }}
                {{ csrf_field() }}
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="{{ route('administrators.profile') }}">
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
