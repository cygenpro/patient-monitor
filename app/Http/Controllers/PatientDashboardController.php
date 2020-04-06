<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use Illuminate\Http\Request;

class PatientDashboardController extends Controller
{
    /**
     * PatientDashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }

    public function report( ReportRequest $request )
    {

    }
}
