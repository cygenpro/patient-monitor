<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Repositories\RecordRepository;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    /**
     * @var RecordRepository
     */
    protected RecordRepository $_recordRepo;

    /**
     * DoctorController constructor.
     * @param RecordRepository $recordRepository
     */
    public function __construct(RecordRepository $recordRepository)
    {
        $this->_recordRepo = $recordRepository;
    }

    /**
     * @param $doctorId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($doctorId)
    {
        $records = $this->_recordRepo->getByDoctorAndPatientIds($doctorId, Auth::id());

        return response()->json([
            'records' => $records
        ], 200);
    }
}
