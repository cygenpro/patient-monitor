<?php

namespace App\Http\Controllers\Doctor;

use App\Events\PatientAssignedToDoctor;
use App\Http\Requests\Doctor\AssignDoctorRequest;
use App\Http\Controllers\Controller;
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
    public function addPatient( AssignDoctorRequest $request )
    {
        $patient = $this->_patientRepo->getByPhone( $request->input('phone') );
        $doctor  = Auth::user();

        try {
            if( $patient )
            {
                if($doctor->hasPatient($patient->id))
                {
                    return response()->json([
                        'message' => "Patient already exists in your list."
                    ], 422);
                }

                $doctor->patients()->create([
                    'doctor_id'  => $doctor->id,
                    'patient_id' => $patient->id
                ]);

                event(new PatientAssignedToDoctor($patient, $doctor));
            }

            return response()->json([
                'message' => "We will send a notification if the patient exist in our system. Patient will be added to your list when the request accepted."
            ], 200);
        } catch (\Exception $exception) {
            Log::error($exception->getTraceAsString());

            return response()->json([
                'message' => 'Something went wrong'
            ], 501);
        }
    }
}
