<?php

namespace App\Rlustosa;

class ChartHelper
{

    public static $elements = [];

    public static function drawHtml($id)
    {

        self::$elements[] = $id;

        return '
	    <div id="report_range_' . $id . '"
             style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
            <i class="fa fa-calendar"></i>&nbsp;
            <span></span> <i class="fa fa-caret-down"></i>
        </div>
        ';
    }

    public static function drawJS()
    {
        $html = '';

        foreach (self::$elements as $element) {

            $id = $element;
            $html .= '
        <script type="text/javascript">
        
            $(window).on(\'load\', function() {
            //$(function () {
        
                drawChart_' . $id . '(start.format(\'YYYY-MM-DD\'), end.format(\'YYYY-MM-DD\'));
        
                function cb_' . $id . '(start, end) {
                    $(\'#report_range_' . $id . ' span\').html(start.format(\'DD/MM/YYYY\') + \' - \' + end.format(\'DD/MM/YYYY\'));
                }
        
                $(\'#report_range_' . $id . '\').daterangepicker({
                    startDate: start,
                    endDate: end,
                    minDate: minDate,
                    maxDate: end,
                    ranges: {
                        \'Hoje\': [moment(), moment()],
                        \'Ontem\': [moment().subtract(1, \'days\'), moment().subtract(1, \'days\')],
                        \'Últimos 7 dias\': [moment().subtract(6, \'days\'), moment()],
                        \'Últimos 30 dias\': [moment().subtract(29, \'days\'), moment()],
                        \'Esse mês\': [moment().startOf(\'month\'), moment().endOf(\'month\')],
                        \'Últimos 2 meses\': [moment().subtract(1,\'months\').startOf(\'month\'), moment().endOf(\'month\')],
                        \'Últimos 3 meses\': [moment().subtract(2,\'months\').startOf(\'month\'), moment().endOf(\'month\')],
                        \'Últimos 6 meses\': [moment().subtract(5,\'months\').startOf(\'month\'), moment().endOf(\'month\')],
                        \'Últimos 9 meses\': [moment().subtract(8,\'months\').startOf(\'month\'), moment().endOf(\'month\')],
                        \'Últimos 12 meses\': [moment().subtract(11,\'months\').startOf(\'month\'), moment().endOf(\'month\')],
                        \'Últimos 18 meses\': [moment().subtract(17,\'months\').startOf(\'month\'), moment().endOf(\'month\')],
                        \'Tudo\': [moment(minDate), moment(end)]
                    },
                    format: \'DD/MM/YYYY\',
                    separator: \' até \',
                    locale: {
                        applyLabel: \'Aplicar\',
                        cancelLabel: \'Limpar\',
                        fromLabel: \'De\',
                        toLabel: \'Até\',
                        customRangeLabel: \'Personalizado\',
                        daysOfWeek: [\'Dom\', \'Seg\', \'Ter\', \'Qua\', \'Qui\', \'Sex\', \'Sáb\'],
                        monthNames: [\'Janeiro\', \'Fevereiro\', \'Março\', \'Abril\', \'Maio\', \'Junho\', \'Julho\', \'Agosto\', \'Setembro\', \'Outubro\', \'Novembro\', \'Dezembro\'],
                        firstDay: 1
                    }
        
                }, cb_' . $id . ');
        
                cb_' . $id . '(start, end);        
        
                $(\'#report_range_' . $id . '\').on(\'apply.daterangepicker\', function (ev, picker) {
        
                    var start = picker.startDate.format(\'YYYY-MM-DD\');
                    var end = picker.endDate.format(\'YYYY-MM-DD\');
                    drawChart_' . $id . '(start, end);
                });
        
            });
        </script>
        ';
        }
        return $html;
    }
}
