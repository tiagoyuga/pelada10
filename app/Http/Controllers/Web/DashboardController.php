<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Api\ApiBaseController;
//use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DashboardController extends ApiBaseController
{

    private $service;
    private $label;

    public function __construct(/*DashboardService $service*/)
    {

        #$this->service = $service;
        $this->label = 'Dashboard';
    }

    public function dashboard(): View
    {

        #return view('panel.home.dashboard');
        return view('home');
    }

    public function iframe()
    {
        Debugbar::disable();
        return view('panel.home.iframe');
    }
}

