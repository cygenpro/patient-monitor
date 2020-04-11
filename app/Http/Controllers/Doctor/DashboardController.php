<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPatientRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * DoctorDashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        // todo: add middlewares
    }

    public function index()
    {

    }
}
