<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPatientRequest;
use Illuminate\Http\Request;

class DoctorDashboardController extends Controller
{
    /**
     * DoctorDashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }

    public function getPatient( $patientId )
    {

    }

    public function addPatient( AddPatientRequest $request )
    {

    }
}
