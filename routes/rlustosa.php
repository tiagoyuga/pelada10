<?php

Route::namespace('Rlustosa')
    #->middleware(['auth.basic'])
    ->prefix('rlustosa')
    ->group(function ($rls) {

        $rls->get('/', 'GenerateController@inicio');
        $rls->post('/', 'GenerateController@mapa');
        $rls->post('organizaVisual', 'GenerateController@organizaVisual');
        $rls->post('gera', 'GenerateController@gera');
        $rls->get('fillable/{tabela}', 'GenerateController@escreveFillable');
        $rls->get('criaObservers', 'GenerateController@criaObservers');
        $rls->get('criaApi/{tabela}', 'GenerateController@criaApi');
    });
