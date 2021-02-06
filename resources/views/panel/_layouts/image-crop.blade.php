@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Ajuste de imagem')

@section('content')

    @if(!request('iframe'))

        @include('panel.'. $cropModule .'.nav')

    @endif

    <div class="wrapper wrapper-content">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    {{--<div class="ibox-title">
                        <h5>@yield('_titulo_pagina_')</h5>
                    </div>--}}
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    <h2>Ajuste a imagem abaixo:</h2>
                                </div>

                                {{--<div class="float-e-margins p-md">
                                    <!-- <span>Por motivos de segurança essa remoção será associada ao seu login. Data, hora e IP do momento da remoção serão adicionados ao nosso LOG.</span> -->
                                </div>--}}

                                <form method="post" class="form-horizontal" id="frm_apagar"
                                      action="{{ $url }}">
                                    {{ method_field('put') }}
                                    {{ csrf_field() }}
                                    <div class="form-group">

                                        @if(request('iframe'))
                                            <input id="iframe" name="iframe" type="hidden" value="true">
                                    @endif

                                    <!-- Content -->
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- <h3>Demo:</h3> -->
                                                    <div class="img-container">
                                                        <img id="image"
                                                             src="{{ url('/') }}/images/original/{{ config('upload.tamanhoExibicaoDoCrop') }}/{{ $image }}"
                                                             alt="Imagem para crop" class="rounded">
                                                    </div>
                                                </div>
                                            </div>


                                            <div id="ocultos" style="display: none">

                                                <div class="col-md-3 docs-toggles">
                                                    <!-- <h3>Toggles:</h3> -->
                                                    <div class="btn-group d-flex flex-nowrap" data-toggle="buttons">
                                                        <label class="btn btn-primary active">
                                                            <input type="radio" class="sr-only" id="aspectRatio0"
                                                                   name="aspectRatio" value="1.7777777777777777">
                                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                                  data-animation="false" title="aspectRatio: 16 / 9">
              16:9
            </span>
                                                        </label>
                                                        <label class="btn btn-primary">
                                                            <input type="radio" class="sr-only" id="aspectRatio1"
                                                                   name="aspectRatio" value="1.3333333333333333">
                                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                                  data-animation="false" title="aspectRatio: 4 / 3">
              4:3
            </span>
                                                        </label>
                                                        <label class="btn btn-primary">
                                                            <input type="radio" class="sr-only" id="aspectRatio2"
                                                                   name="aspectRatio" value="1">
                                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                                  data-animation="false" title="aspectRatio: 1 / 1">
              1:1
            </span>
                                                        </label>
                                                        <label class="btn btn-primary">
                                                            <input type="radio" class="sr-only" id="aspectRatio3"
                                                                   name="aspectRatio" value="0.6666666666666666">
                                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                                  data-animation="false" title="aspectRatio: 2 / 3">
              2:3
            </span>
                                                        </label>
                                                        <label class="btn btn-primary">
                                                            <input type="radio" class="sr-only" id="aspectRatio4"
                                                                   name="aspectRatio" value="NaN">
                                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                                  data-animation="false" title="aspectRatio: NaN">
              Free
            </span>
                                                        </label>
                                                    </div>

                                                    <div class="btn-group d-flex flex-nowrap" data-toggle="buttons">
                                                        <label class="btn btn-primary active">
                                                            <input type="radio" class="sr-only" id="viewMode0"
                                                                   name="viewMode" value="0" checked>
                                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                                  data-animation="false" title="View Mode 0">
              VM0
            </span>
                                                        </label>
                                                        <label class="btn btn-primary">
                                                            <input type="radio" class="sr-only" id="viewMode1"
                                                                   name="viewMode" value="1">
                                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                                  data-animation="false" title="View Mode 1">
              VM1
            </span>
                                                        </label>
                                                        <label class="btn btn-primary">
                                                            <input type="radio" class="sr-only" id="viewMode2"
                                                                   name="viewMode" value="2">
                                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                                  data-animation="false" title="View Mode 2">
              VM2
            </span>
                                                        </label>
                                                        <label class="btn btn-primary">
                                                            <input type="radio" class="sr-only" id="viewMode3"
                                                                   name="viewMode" value="3">
                                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                                  data-animation="false" title="View Mode 3">
              VM3
            </span>
                                                        </label>
                                                    </div>

                                                    <div class="dropdown dropup docs-options">
                                                        <button type="button"
                                                                class="btn btn-primary btn-block dropdown-toggle"
                                                                id="toggleOptions" data-toggle="dropdown"
                                                                aria-expanded="true">
                                                            Toggle Options
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="toggleOptions"
                                                            role="menu">
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="responsive" checked>
                                                                    responsive
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="restore" checked>
                                                                    restore
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="checkCrossOrigin" checked>
                                                                    checkCrossOrigin
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="checkOrientation" checked>
                                                                    checkOrientation
                                                                </label>
                                                            </li>

                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="modal" checked>
                                                                    modal
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="guides" checked>
                                                                    guides
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="center" checked>
                                                                    center
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="highlight" checked>
                                                                    highlight
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="background" checked>
                                                                    background
                                                                </label>
                                                            </li>

                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="autoCrop" checked>
                                                                    autoCrop
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="movable" checked>
                                                                    movable
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="rotatable" checked>
                                                                    rotatable
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="scalable" checked>
                                                                    scalable
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="zoomable" checked>
                                                                    zoomable
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="zoomOnTouch" checked>
                                                                    zoomOnTouch
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="zoomOnWheel" checked>
                                                                    zoomOnWheel
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="cropBoxMovable" checked>
                                                                    cropBoxMovable
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="cropBoxResizable" checked>
                                                                    cropBoxResizable
                                                                </label>
                                                            </li>
                                                            <li class="form-check" role="presentation">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="toggleDragModeOnDblclick" checked>
                                                                    toggleDragModeOnDblclick
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </div><!-- /.dropdown -->

                                                </div><!-- /.docs-toggles -->


                                                <div class="col-md-3">
                                                    <!-- <h3>Preview:</h3> -->
                                                    <div class="docs-preview clearfix">
                                                        <div class="img-preview preview-lg"></div>
                                                        <div class="img-preview preview-md"></div>
                                                        <div class="img-preview preview-sm"></div>
                                                        <div class="img-preview preview-xs"></div>
                                                    </div>

                                                    <!-- <h3>Data:</h3> -->
                                                    <div class="docs-data">
                                                        <div class="input-group input-group-sm">
                                                            <label class="input-group-addon" for="dataX">X</label>
                                                            <input type="text" class="form-control" id="dataX"
                                                                   name="dataX"
                                                                   placeholder="x">
                                                            <span class="input-group-addon">px</span>
                                                        </div>
                                                        <div class="input-group input-group-sm">
                                                            <label class="input-group-addon" for="dataY">Y</label>
                                                            <input type="text" class="form-control" id="dataY"
                                                                   name="dataY"
                                                                   placeholder="y">
                                                            <span class="input-group-addon">px</span>
                                                        </div>
                                                        <div class="input-group input-group-sm">
                                                            <label class="input-group-addon"
                                                                   for="dataWidth">Width</label>
                                                            <input type="text" class="form-control" id="dataWidth"
                                                                   name="dataWidth"
                                                                   placeholder="width">
                                                            <span class="input-group-addon">px</span>
                                                        </div>
                                                        <div class="input-group input-group-sm">
                                                            <label class="input-group-addon"
                                                                   for="dataHeight">Height</label>
                                                            <input type="text" class="form-control" id="dataHeight"
                                                                   name="dataHeight"
                                                                   placeholder="height">
                                                            <span class="input-group-addon">px</span>
                                                        </div>
                                                        <div class="input-group input-group-sm">
                                                            <label class="input-group-addon"
                                                                   for="dataRotate">Rotate</label>
                                                            <input type="text" class="form-control" id="dataRotate"
                                                                   name="dataRotate"
                                                                   placeholder="rotate">
                                                            <span class="input-group-addon">deg</span>
                                                        </div>
                                                        <div class="input-group input-group-sm">
                                                            <label class="input-group-addon"
                                                                   for="dataScaleX">ScaleX</label>
                                                            <input type="text" class="form-control" id="dataScaleX"
                                                                   name="dataScaleX"
                                                                   placeholder="scaleX">
                                                        </div>
                                                        <div class="input-group input-group-sm">
                                                            <label class="input-group-addon"
                                                                   for="dataScaleY">ScaleY</label>
                                                            <input type="text" class="form-control" id="dataScaleY"
                                                                   name="dataScaleY"
                                                                   placeholder="scaleY">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="d-flex justify-content-center col-12 docs-buttons">
                                            <!-- <h3>Toolbar:</h3> -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default"
                                                        data-method="setDragMode" data-option="move"
                                                        title="Move">
                                                    <span class="fa fa-arrows"></span>
                                                    </span>
                                                </button>
                                                <button type="button" class="btn btn-default"
                                                        data-method="setDragMode" data-option="crop"
                                                        title="Crop">
                                                    <span class="fa fa-crop"></span>
                                                    </span>
                                                </button>
                                            </div>

                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default" data-method="zoom"
                                                        data-option="0.1" title="Zoom In">
                                                    <span class="fa fa-search-plus"></span>
                                                    </span>
                                                </button>
                                                <button type="button" class="btn btn-default" data-method="zoom"
                                                        data-option="-0.1" title="Zoom Out">
                                                    <span class="fa fa-search-minus"></span>
                                                    </span>
                                                </button>
                                            </div>

                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default"
                                                        data-method="rotate" data-option="-45"
                                                        title="Rotate Left">
                                                    <span class="fa fa-rotate-left"></span>
                                                    </span>
                                                </button>
                                                <button type="button" class="btn btn-default"
                                                        data-method="rotate" data-option="45"
                                                        title="Rotate Right">
                                                    <span class="fa fa-rotate-right"></span>
                                                    </span>
                                                </button>
                                            </div>

                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default"
                                                        data-method="scaleX" data-option="-1"
                                                        title="Flip Horizontal">
                                                    <span class="fa fa-arrows-h"></span>
                                                    </span>
                                                </button>
                                                <button type="button" class="btn btn-default"
                                                        data-method="scaleY" data-option="-1"
                                                        title="Flip Vertical">
                                                    <span class="fa fa-arrows-v"></span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div><!-- /.docs-buttons -->


                                        <div class="col-12 d-flex justify-content-center btn-group"
                                             style="margin-top: 20px;">

                                            <div class="col-2 d-flex justify-content-center btn-group">
                                                <button class="btn btn-primary" id="bt_apagar" data-method="crop"
                                                        type="submit">
                                                    <span class="fa fa-check"></span>
                                                    Recortar
                                                </button>

                                                @if(!request('iframe'))

                                                    <a class="btn btn-default" id="ln_nao"
                                                       href="{{ route(''. $cropModule .'.index') }}">
                                                        <i class="fa fa-list-ul"></i>
                                                        Listar
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <input type="hidden" name="image" value="{{ $image }}">
                                    <input type="hidden" name="ordemImagem" value="{{ $ordemImagem }}">
                                </form>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('styles')

    <link href="{{ asset('vendor/cropper/cropper.css') }}?{{ date('His') }}" rel="stylesheet">
    <style>
        /* Content */

        .img-container,
        .img-preview {
            background-color: #f7f7f7;
            width: 100%;
            text-align: center;
        }

        .img-container {
            min-height: 200px;
            max-height: 500px;
            margin-bottom: 1rem;
        }

        @media (min-width: 768px) {
            .img-container {
                min-height: 469px;
            }
        }

        .img-container > img {
            max-width: 100%;
        }
    </style>
@endsection


@section('scripts')

    <script type="text/javascript" src="{{ asset('vendor/cropper/cropper.min.js')}}"></script>
    <script>
        $(function () {

            'use strict';

            var console = window.console || {
                log: function () {
                }
            };
            var URL = window.URL || window.webkitURL;
            var $image = $('#image');
            var $download = $('#download');
            var $dataX = $('#dataX');
            var $dataY = $('#dataY');
            var $dataHeight = $('#dataHeight');
            var $dataWidth = $('#dataWidth');
            var $dataRotate = $('#dataRotate');
            var $dataScaleX = $('#dataScaleX');
            var $dataScaleY = $('#dataScaleY');
            var options = {
                aspectRatio: {{ $aspectRatio }},
                preview: '.img-preview',
                crop: function (e) {
                    $dataX.val(Math.round(e.x));
                    $dataY.val(Math.round(e.y));
                    $dataHeight.val(Math.round(e.height));
                    $dataWidth.val(Math.round(e.width));
                    $dataRotate.val(e.rotate);
                    $dataScaleX.val(e.scaleX);
                    $dataScaleY.val(e.scaleY);
                }
            };
            var originalImageURL = $image.attr('src');
            var uploadedImageType = 'image/jpeg';
            var uploadedImageURL;

            // Cropper
            $image.on({
                ready: function (e) {
                    //console.log(e.type);
                },
                cropstart: function (e) {
                    //console.log(e.type, e.action);
                },
                cropmove: function (e) {
                    //console.log(e.type, e.action);
                },
                cropend: function (e) {
                    //console.log(e.type, e.action);
                },
                crop: function (e) {
                    //console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
                },
                zoom: function (e) {
                    //console.log(e.type, e.ratio);
                }
            }).cropper(options);


            // Options
            $('.docs-toggles').on('change', 'input', function () {
                var $this = $(this);
                var name = $this.attr('name');
                var type = $this.prop('type');
                var cropBoxData;
                var canvasData;

                if (!$image.data('cropper')) {
                    return;
                }

                if (type === 'checkbox') {
                    options[name] = $this.prop('checked');
                    cropBoxData = $image.cropper('getCropBoxData');
                    canvasData = $image.cropper('getCanvasData');

                    options.ready = function () {
                        $image.cropper('setCropBoxData', cropBoxData);
                        $image.cropper('setCanvasData', canvasData);
                    };
                } else if (type === 'radio') {
                    options[name] = $this.val();
                }

                $image.cropper('destroy').cropper(options);
            });


            // Methods
            $('.docs-buttons').on('click', '[data-method]', function () {
                var $this = $(this);
                var data = $this.data();
                var $target;
                var result;

                if ($this.prop('disabled') || $this.hasClass('disabled')) {
                    return;
                }

                if ($image.data('cropper') && data.method) {
                    data = $.extend({}, data); // Clone a new one

                    if (typeof data.target !== 'undefined') {
                        $target = $(data.target);

                        if (typeof data.option === 'undefined') {
                            try {
                                data.option = JSON.parse($target.val());
                            } catch (e) {
                                console.log(e.message);
                            }
                        }
                    }

                    switch (data.method) {
                        case 'rotate':
                            $image.cropper('clear');
                            break;

                        case 'getCroppedCanvas':
                            if (uploadedImageType === 'image/jpeg') {
                                if (!data.option) {
                                    data.option = {};
                                }

                                data.option.fillColor = '#fff';
                            }

                            break;
                    }

                    result = $image.cropper(data.method, data.option, data.secondOption);

                    switch (data.method) {
                        case 'rotate':
                            $image.cropper('crop');
                            break;

                        case 'scaleX':
                        case 'scaleY':
                            $(this).data('option', -data.option);
                            break;

                        case 'getCroppedCanvas':
                            if (result) {
                                // Bootstrap's Modal
                                $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

                                if (!$download.hasClass('disabled')) {
                                    $download.attr('href', result.toDataURL(uploadedImageType));
                                }
                            }

                            break;

                        case 'destroy':
                            if (uploadedImageURL) {
                                URL.revokeObjectURL(uploadedImageURL);
                                uploadedImageURL = '';
                                $image.attr('src', originalImageURL);
                            }

                            break;
                    }

                    if ($.isPlainObject(result) && $target) {
                        try {
                            $target.val(JSON.stringify(result));
                        } catch (e) {
                            //console.log(e.message);
                        }
                    }

                }
            });


            // Keyboard
            $(document.body).on('keydown', function (e) {

                if (!$image.data('cropper') || this.scrollTop > 300) {
                    return;
                }

                switch (e.which) {
                    case 37:
                        e.preventDefault();
                        $image.cropper('move', -1, 0);
                        break;

                    case 38:
                        e.preventDefault();
                        $image.cropper('move', 0, -1);
                        break;

                    case 39:
                        e.preventDefault();
                        $image.cropper('move', 1, 0);
                        break;

                    case 40:
                        e.preventDefault();
                        $image.cropper('move', 0, 1);
                        break;
                }

            });


        });
    </script>
@endsection
