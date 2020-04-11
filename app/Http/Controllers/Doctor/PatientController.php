<?php

namespace App\Http\Controllers\Doctor;

use App\Events\PatientAssignedToDoctor;
use App\Http\Requests\Doctor\AssignDoctorRequest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Repositories\PatientRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    /**
     * @var PatientRepository
     */
    protected PatientRepository $_patientRepo;

    /**
     * PatientController constructor.
     * @param PatientRepository $patientRepo
     */
    public function __construct(PatientRepository $patientRepo)
    {
        $this->_patientRepo = $patientRepo;

        // todo: add middlewares
    }

    /**
     * @param $patientId
     */
    public function show( $patientId )
    {

    }

    /**
     * @param AssignDoctorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignDoctor( AssignDoctorRequest $request )
    {
        $patient = $this->_patientRepo->getByPhone( $request->input('phone') );
        $doctor  = Auth::user();

        if( $patient )
        {
            try {
                $doctor->patients()->create([
                    'patient_id' => $patient->id
                ]);

                event(new PatientAssignedToDoctor($patient, $doctor));

                return response()->json([
                    'message' => "Patient will appear in your list when the request accepted."
                ], 201);
            } catch (\Exception $exception) {
                Log::error($exception->getTraceAsString());
            }
        }

        return response()->json([
            'message' => "Patient doesn't exist"
        ], 404);
    }
}
