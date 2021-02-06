<div class="row">
    <div class="form-group col-md-4">
        <label for="search">Localizar</label>
        <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}"
               placeholder="{{ isset($_placeholder_) ? $_placeholder_ : 'Digite algo para realizar sua busca' }}">
    </div>
    <div class="form-group col-md-6">

    </div>
    <div class="form-group col-sm-2 text-right">
        <label>&nbsp;</label>
        <button type="submit" class="btn btn-primary form-control" id="btn_search">
            <i class="fa fa-search"></i> Pesquisar
        </button>
    </div>
</div>
