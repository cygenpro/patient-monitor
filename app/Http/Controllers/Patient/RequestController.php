<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcceptDoctorRequestRequest;
use App\Http\Requests\DeclineDoctorRequestRequest;
use App\Repositories\DoctorPatientRepository;
use App\Services\DoctorRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RequestController extends Controller
{
    /**
     * @var DoctorRequest
     */
    protected DoctorRequest $_doctorRequest;
    /**
     * @var DoctorPatientRepository
     */
    protected DoctorPatientRepository $_doctorPatientRepo;

    /**
     * RequestController constructor.
     * @param DoctorRequest $doctorRequest
     * @param DoctorPatientRepository $doctorPatientRepository
     */
    public function __construct(DoctorRequest $doctorRequest, DoctorPatientRepository $doctorPatientRepository)
    {
        $this->_doctorRequest = $doctorRequest;
        $this->_doctorPatientRepo = $doctorPatientRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function pendingRequest()
    {
        $doctorPatient = $this->_doctorRequest->getPendingRequest(Auth::id());

        return response()->json([
            'doctorRequest' => $doctorPatient
        ], 200);
    }

    /**
     * @param AcceptDoctorRequestRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function accept(AcceptDoctorRequestRequest $request)
    {
        try {
            $doctorPatient = $this->_doctorRequest->accept($request->input('doctor_id'), Auth::id());

            return response()->json([
                'message' => 'Request accepted.',
                'doctor' => $doctorPatient->doctor
            ], 200);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return response()->json([
                'message' => 'Something went wrong.'
            ], 500);
        }
    }

    /**
     * @param DeclineDoctorRequestRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function decline(DeclineDoctorRequestRequest $request)
    {
        try {
            $this->_doctorRequest->decline($request->input('doctor_id'), Auth::id());

            return response()->json([
                'message' => 'Request declined.',
            ], 200);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return response()->json([
                'message' => 'Something went wrong.'
            ], 500);
        }
    }
}
