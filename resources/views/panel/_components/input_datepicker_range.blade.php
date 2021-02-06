@php
    $id =  isset($id) ? $id : 'input_date_picker';
@endphp
<div class="form-group">
    <label for="{{$id}}">Período</label>
    <input autocomplete="off" class="form-control" type="text"
           id="{{$id}}"
           value=" {{ request('period') ? request('period') : \Carbon\Carbon::now()->subWeek(1)->format("d/m/Y") .' - '. \Carbon\Carbon::now()->format("d/m/Y") }}">
</div>
