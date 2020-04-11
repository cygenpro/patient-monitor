<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * PatientDashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        // todo: add middlewares
    }

    public function index()
    {

    }

    public function report( ReportRequest $request )
    {

    }
}
