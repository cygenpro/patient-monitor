<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorDashboardController extends Controller
{
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

    public function addPatient( Request $request )
    {

    }
}
