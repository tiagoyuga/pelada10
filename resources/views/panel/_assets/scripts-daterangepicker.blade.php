<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    function inputDatePickerRange(element, startDate = false, endDate = false, minDate = false) {

        var minDate = minDate ? minDate : moment("{{ \Illuminate\Support\Carbon::createFromDate('2018')->format('Ymd') }}", "YYYYMMDD");
        var startDate = startDate ? startDate : moment().subtract(15, 'days');
        var endDate = endDate ? endDate : moment("{{ date('Ymd') }}", "YYYYMMDD");

        $(element).daterangepicker({

            startDate: startDate,
            endDate: endDate,
            minDate: minDate,
            maxDate: endDate,
            autoUpdateInput: false,
            ranges: {
                'Hoje': [moment(), moment()],
                'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
                'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
                'Esse mês': [moment().startOf('month'), moment().endOf('month')],
                'Tudo': [moment(minDate), moment(endDate)]
            },
            format: 'DD/MM/YYYY',
            separator: ' até ',
            locale: {
                applyLabel: 'Aplicar',
                cancelLabel: 'Cancelar',
                fromLabel: 'De',
                toLabel: 'Até',
                customRangeLabel: 'Personalizado',
                daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                firstDay: 1
            }

        });

        $(element).on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });
    }
</script>
