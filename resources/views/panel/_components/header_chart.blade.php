<div class="ibox-title" style="padding-right: 10px;">
    <div class="row">
        <div class="col-md-6"><h5>{{ isset($title) ? $title : "Gráfico" }}</h5></div>
        <div class="col-md-6 text-right">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button"
                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <span class="fa fa-filter"></span> Filtros
                </button>
                <div class="dropdown-menu col-md-12">
                    <form class="px-4 py-3">
                       {{$slot}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
