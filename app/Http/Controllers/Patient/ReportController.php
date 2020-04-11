<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StoreReportRequest;
use Illuminate\Http\Request;
use App\Repositories\ReportRepository;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    /**
     * @var ReportRepository
     */
    protected ReportRepository $_reportRepo;

    /**
     * ReportController constructor.
     * @param ReportRepository $reportRepository
     */
    public function __construct(ReportRepository $reportRepository)
    {
        $this->_reportRepo = $reportRepository;

        // todo: add middlewares
    }

    /**
     * @param StoreReportRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store( StoreReportRequest $request )
    {
        $patientId = $request->user()->id;
        $doctorId = $request->input('doctor_id');
        $reportTypeId = $request->input('report_type_id');
        $value = $request->input('value');

        try {
            $this->_reportRepo->save([
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
