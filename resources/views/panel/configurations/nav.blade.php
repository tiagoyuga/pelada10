<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ $label }}</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Início</a>
            </li>
            <li class="breadcrumb-item active">
                <strong><a href="{{ route('configurations.index') }}">{{ $label }}</a></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">

    </div>
</div>
