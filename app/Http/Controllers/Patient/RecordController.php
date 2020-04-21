<?php

namespace App\Http\Controllers\Patient;

use App\Events\RecordSubmitted;
use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StoreRecordRequest;
use App\Repositories\RecordRepository;
use App\Services\Record;
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
        $request->merge(['patient_id' => $request->user()->id]);

        try {
            $recordsToSubmit = Record::mapRequest($request->all());
            $submittedRecords = [];

            foreach ($recordsToSubmit as $item)
            {
                $record = $this->_recordRepo->save($item);
                $submittedRecords[] = $record->toArray();
            }

            event(new RecordSubmitted($submittedRecords));

            return response()->json([
                'records' => $submittedRecords,
                'message' => 'Record submitted successfully.'
            ], 201);

        } catch (\Exception $exception) {
            Log::error($exception->getTraceAsString());

            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}
