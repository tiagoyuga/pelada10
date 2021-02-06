@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Dashboard')

@section('content')
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    @component("panel._components.header_chart")
                        @slot('title', 'Pedidos por dia')
                        <div class="form-group">
                            <label for="payment_form_id">Status do pedido</label>
                            <select data-callback="drawChart_sales_day" id="status_sale_id"
                                    name="status_sale_id"
                                    class="filter form-control">
                                <option value="">Todos</option>
                                @foreach (\App\Models\StatusSale::all() as $statusSale)
                                    <option value="{{ $statusSale->id }}"
                                            @if ($statusSale->id == request('status_sale_id'))
                                            selected="selected"
                                        @endif
                                    >{{ $statusSale->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @component('panel._components.input_datepicker_range', ['id' => 'sales_day_period'])@endcomponent
                    @endcomponent
                    <div class="ibox-content">
                        <div class="text-center">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <div class="chartjs-render-monitor" id="sales_day"
                                 style="min-width: 310px; height: 400px; max-width: 100%; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox ">
                    @component("panel._components.header_chart")
                        @slot('title', 'Pedidos por categoria')
                        @component('panel._components.input_datepicker_range', ['id' => 'sales_category_period'])@endcomponent
                    @endcomponent

                    <div class="ibox-content">
                        <div>
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <div class="chartjs-render-monitor" id="sales_category"
                                 style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox ">
                    @component("panel._components.header_chart")
                        @slot('title', 'Cadastro de usuário por dia')
                        @component('panel._components.input_datepicker_range', ['id' => 'users_registration_day_period'])@endcomponent
                    @endcomponent
                    <div class="ibox-content">
                        <div>
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <div class="chartjs-render-monitor" id="users_registration_day"
                                 style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox ">
                    @component("panel._components.header_chart")
                        @slot('title', 'Status do pedido')
                        @component('panel._components.input_datepicker_range', ['id' => 'sales_status_sale_period'])@endcomponent
                    @endcomponent

                    <div class="ibox-content">
                        <div>
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <div class="chartjs-render-monitor" id="sales_status_sale"
                                 style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox ">
                    @component("panel._components.header_chart")
                        @slot('title', 'Pedidos por opção de entrega')
                        @component('panel._components.input_datepicker_range', ['id' => 'sales_status_delivery_period'])@endcomponent
                    @endcomponent
                    <div class="ibox-content">
                        <div>
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <div class="chartjs-render-monitor" id="sales_status_delivery"
                                 style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox ">
                    @component("panel._components.header_chart")
                        @slot('title', 'Pedidos por opção de pagamento')
                        @component('panel._components.input_datepicker_range', ['id' => 'sales_option_payment_period'])@endcomponent
                    @endcomponent
                    <div class="ibox-content">
                        <div>
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <div class="chartjs-render-monitor" id="sales_option_payment"
                                 style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')

@endsection

@section('scripts')
    @include('panel._assets.scripts-daterangepicker')

    @include('panel._assets.scripts-highcharts')

    <script>
        Highcharts.setOptions({
            lang: {
                months: [
                    'Janeiro', 'Fevereiro', 'Março', 'Abril',
                    'Maio', 'Junho', 'Julho', 'Agosto',
                    'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ],
                shortMonths: [
                    'Jan', 'Fev', 'Mar', 'Abr',
                    'Mai', 'Jun', 'Jul', 'Ago',
                    'Set', 'Out', 'Nov', 'Dez'
                ],
            }
        });

        inputDatePickerRange("#sales_day_period");
        inputDatePickerRange("#sales_category_period");
        inputDatePickerRange("#users_registration_day_period");
        //inputDatePickerRange("#sales_payment_form_period");
        inputDatePickerRange("#sales_option_payment_period");
        inputDatePickerRange("#sales_status_sale_period");
        inputDatePickerRange("#sales_status_delivery_period");

        $(function () {
            drawChart_sales_day();
            drawChart_sales_category();
            drawChart_users_registration_day();
            //drawChart_sales_payment_form();
            drawChart_sales_option_payment();
            drawChart_sales_status_sale();
            drawChart_sales_status_delivery();

            $(".filter").change(function (e) {
                (new Function($(this).attr("data-callback") + "()"))()
            });

            $("#sales_day_period").on('apply.daterangepicker', function (ev, picker) {
                drawChart_sales_day();
            });

            $("#sales_category_period").on('apply.daterangepicker', function (ev, picker) {
                drawChart_sales_category();
            });

            $("#users_registration_day_period").on('apply.daterangepicker', function (ev, picker) {
                drawChart_users_registration_day();
            });

            $("#sales_payment_form_period").on('apply.daterangepicker', function (ev, picker) {
                drawChart_sales_payment_form();
            });

            $("#sales_option_payment_period").on('apply.daterangepicker', function (ev, picker) {
                drawChart_sales_option_payment();
            });

            $("#sales_status_sale_period").on('apply.daterangepicker', function (ev, picker) {
                drawChart_sales_status_sale();
            });

            $("#sales_status_delivery_period").on('apply.daterangepicker', function (ev, picker) {
                drawChart_sales_status_delivery();
            });

        })

        function drawChart_sales_day() {

            block("#sales_day");

            $.getJSON('{{ route('report.sales.day') }}', {
                period: $("#sales_day_period").val(),
                payment_form_id: $("#payment_form_id").val(),
                status_sale_id: $("#status_sale_id").val()
            })
                .done(function (result) {
                    let series = result.data.map(item => [Date.UTC(item.year, item.month - 1, item.day), item.count]);
                    Highcharts.chart('sales_day', {

                        chart: {
                            type: 'spline'
                        },
                        title: {
                            text: ''
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            type: 'datetime',
                            dateTimeLabelFormats: {
                                month: '%e. %b',
                                year: '%b'
                            },
                            title: {
                                text: 'Dias'
                            },
                        },
                        yAxis: {
                            title: {
                                text: 'Número de pedidos'
                            },
                            min: 0
                        },
                        tooltip: {
                            headerFormat: '<b>{series.name}</b><br>',
                            pointFormat: '{point.x:%e. %b}: <b>{point.y}</b> pedido(s)'
                        },

                        plotOptions: {
                            series: {
                                marker: {
                                    enabled: true
                                }
                            }
                        },

                        colors: ['#6CF', '#39F', '#06C', '#036', '#000'],

                        series: [{
                            name: $("#sales_day_period").val(),
                            data: series
                        }],

                        responsive: {
                            rules: [{
                                condition: {
                                    maxWidth: 500
                                },
                                chartOptions: {
                                    plotOptions: {
                                        series: {
                                            marker: {
                                                radius: 2.5
                                            }
                                        }
                                    }
                                }
                            }]
                        }
                    });
                })
                .always(function () {
                    unBlock('#sales_day');
                });
        }

        function drawChart_sales_category() {

            block("#sales_category");

            $.getJSON('{{ route('report.sales.category') }}', {
                period: $("#sales_category_period").val(),
            })
                .done(function (result) {
                    result.data.map(item => item["y"] = parseFloat(item.y));
                    Highcharts.chart('sales_category', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.y:.2f}%</b> <br> Total de itens vendidos: {point.count}'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Categorias',
                            colorByPoint: true,
                            data: result.data
                        }]
                    });
                })
                .always(function () {
                    unBlock('#sales_category');
                });
        }

        function drawChart_users_registration_day() {

            block("#users_registration_day");

            $.getJSON('{{ route('report.sales.userRegistration') }}', {
                period: $("#users_registration_day_period").val(),
            })
                .done(function (result) {
                    let series = result.data.map(item => [Date.UTC(item.year, item.month - 1, item.day), item.count]);
                    Highcharts.chart('users_registration_day', {

                        chart: {
                            type: 'spline'
                        },
                        title: {
                            text: ''
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            type: 'datetime',
                            dateTimeLabelFormats: {
                                month: '%e. %b',
                                year: '%b'
                            },
                            title: {
                                text: 'Dias'
                            },
                        },
                        yAxis: {
                            title: {
                                text: 'Número de usuários'
                            },
                            min: 0
                        },
                        tooltip: {
                            headerFormat: '<b>{series.name}</b><br>',
                            pointFormat: '{point.x:%e. %b}: <b>{point.y}</b> usuários(s)'
                        },

                        plotOptions: {
                            series: {
                                marker: {
                                    enabled: true
                                }
                            }
                        },

                        colors: ['#6CF', '#39F', '#06C', '#036', '#000'],

                        series: [{
                            name: $("#sales_day_period").val(),
                            data: series
                        }],

                        responsive: {
                            rules: [{
                                condition: {
                                    maxWidth: 500
                                },
                                chartOptions: {
                                    plotOptions: {
                                        series: {
                                            marker: {
                                                radius: 2.5
                                            }
                                        }
                                    }
                                }
                            }]
                        }
                    });
                })
                .always(function () {
                    unBlock('#users_registration_day');
                });
        }

        function drawChart_sales_payment_form() {

            block("#sales_payment_form");
            $.getJSON('{{ route('report.sales.paymentForm') }}', {
                period: $("#sales_payment_form").val(),
            })
                .done(function (result) {
                    result.data.map(item => item["y"] = parseFloat(item.y));
                    Highcharts.chart('sales_payment_form', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.y:.2f}%</b> <br> Total de pedidos: {point.count}'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Meios de pagamentos',
                            colorByPoint: true,
                            data: result.data
                        }]
                    });
                })
                .always(function () {
                    unBlock('#sales_payment_form');
                });
        }

        function drawChart_sales_option_payment() {

            block("#sales_option_payment");
            $.getJSON('{{ route('report.sales.optionPayment') }}', {
                period: $("#sales_option_payment").val(),
            })
                .done(function (result) {
                    result.data.map(item => item["y"] = parseFloat(item.y));
                    Highcharts.chart('sales_option_payment', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.y:.2f}%</b> <br> Total de pedidos: {point.count}'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Opção de pagamento',
                            colorByPoint: true,
                            data: result.data
                        }]
                    });
                })
                .always(function () {
                    unBlock('#sales_option_payment');
                });
        }

        function drawChart_sales_status_sale() {

            block("#sales_status_sale");
            $.getJSON('{{ route('report.sales.statusSale') }}', {
                period: $("#sales_status_sale").val(),
            })
                .done(function (result) {
                    result.data.map(item => item["y"] = parseFloat(item.y));
                    Highcharts.chart('sales_status_sale', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.y:.2f}%</b> <br> Total de pedidos: {point.count}'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Status do pedido',
                            colorByPoint: true,
                            data: result.data
                        }]
                    });
                })
                .always(function () {
                    unBlock('#sales_status_sale');
                });
        }

        function drawChart_sales_status_delivery() {

            block("#sales_status_delivery");
            $.getJSON('{{ route('report.sales.optionDelivery') }}', {
                period: $("#sales_status_delivery_period").val(),
            })
                .done(function (result) {
                    result.data.map(item => item["y"] = parseFloat(item.y));
                    Highcharts.chart('sales_status_delivery', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.y:.2f}%</b> <br> Total de pedidos: {point.count}'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Pedidos por opção de entrega',
                            colorByPoint: true,
                            data: result.data
                        }]
                    });
                })
                .always(function () {
                    unBlock('#sales_status_delivery');
                });
        }


    </script>

@endsection
