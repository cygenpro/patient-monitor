<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StoreRecordRequest;
use App\Repositories\RecordRepository;
use Illuminate\Support\Facades\Log;

class RecordController extends Controller
{
    /**
     * @var RecordRepository
     */
    protected RecordRepository $_recordRepo;

    /**
     * ReportController constructor.
     * @param RecordRepository $recordRepository
     */
    public function __construct(RecordRepository $recordRepository)
    {
        $this->_recordRepo = $recordRepository;

        // todo: add middlewares....
    }

    /**
     * @param StoreRecordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRecordRequest $request )
    {
        $patientId = $request->user()->id;
        $doctorId = $request->input('doctor_id');
        $reportTypeId = $request->input('report_type_id');
        $value = $request->input('value');

        try {
            $this->_recordRepo->save([
                'from_id' => $patientId,
                'to_id' => $doctorId,
                'report_type_id' => $reportTypeId,
                'value' => $value
            ]);

            return response()->json([
                'message' => 'Report submitted successfully.'
            ], 201);

        } catch (\Exception $exception) {
            Log::error($exception->getTraceAsString());

            return response()->json([
                'message' => 'Something went wrong. Please contact support.'
            ], 500);
        }
    }
}
