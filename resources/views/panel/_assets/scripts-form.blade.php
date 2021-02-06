<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<script>
    $().ready(function () {

        @if (count($errors) > 0)
        showMessage(
            'e',
            '{{ count($errors)==1 ? 'Existe um erro de validação' : 'Existem '.count($errors).' erros de validação' }}',
            8
        );
        @endif

        $('#bt_salvar_adicionar').on('click', function () {
            $('#routeTo').val('create');
        });

        $('#bt_salvar').on('click', function () {
            $('#routeTo').val('index');
        });
    });
</script>
