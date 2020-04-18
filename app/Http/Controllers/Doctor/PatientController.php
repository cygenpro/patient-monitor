<?php

namespace App\Http\Controllers\Doctor;

use App\Events\PatientAssignedToDoctor;
use App\Http\Requests\Doctor\AssignDoctorRequest;
use App\Http\Controllers\Controller;
use App\Repositories\PatientRepository;
use App\Repositories\DoctorPatientRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    /**
     * @var PatientRepository
     */
    protected PatientRepository $_patientRepo;

    /**
     * @var DoctorPatientRepository
     */
    protected DoctorPatientRepository $_doctorPatientRepo;

    /**
     * PatientController constructor.
     * @param PatientRepository $patientRepo
     * @param DoctorPatientRepository $doctorPatientRepo
     */
    public function __construct(PatientRepository $patientRepo, DoctorPatientRepository $doctorPatientRepo)
    {
        $this->_patientRepo = $patientRepo;
        $this->_doctorPatientRepo = $doctorPatientRepo;
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
        $phoneNumber = $request->input('phone');
        $patient = $this->_patientRepo->getByPhone( $phoneNumber );
        $doctor = Auth::user();

        try {
            if( $patient )
            {
                if($doctor->hasPatient($patient->id))
                {
                    return response()->json([
                        'message' => "Patient already exists in your list."
                    ], 422);
                }

                $this->_doctorPatientRepo->save([
                    'doctor_id'  => $doctor->id,
                    'patient_id' => $patient->id
                ]);

                event(new PatientAssignedToDoctor($doctor, $patient));
            }
            elseif($phoneNumber == $doctor->phone)
            {
                // todo: investigate self-monitoring features
                return response()->json([
                    'message' => "You can not add yourself to your patient list."
                ], 422);
            }

            return response()->json([
                'message' => "We will send a notification if the patient exist in our system. Patient will be added to your list when the request accepted."
            ], 200);
        } catch (\Exception $exception) {
//            Log::error($exception->getMessage() . "\n" . $exception->getTraceAsString());
            Log::error($exception->getMessage());

            return response()->json([
                'message' => 'Something went wrong'
            ], 501);
        }
    }
}
