<?php

namespace App\Repositories;

use App\Record;
use Illuminate\Support\Collection;

class RecordRepository
{
    /**
     * @var Record
     */
    private Record $_model;

    /**
     * RecordsRepository constructor.
     * @param Record $record
     */
    public function __construct(Record $record)
    {
        $this->_model = $record;
    }

    /**
     * @param int $doctorId
     * @param int $patientId
     * @return Collection
     */
    public function getByDoctorAndPatientIds(int $doctorId, int $patientId): Collection
    {
        return $this->_model
            ->where('to_id', $doctorId)
            ->where('from_id', $patientId)
            ->orderBy('id', 'DESC')
            ->get();
    }

    /**
     * @param int $doctorId
     * @param int $patientId
     * @return Collection
     */
    public function getNotSeenByDoctorAndPatientId(int $doctorId, int $patientId): Collection
    {
        return $this->_model
            ->where('to_id', $doctorId)
            ->where('from_id', $patientId)
            ->whereNull('seen_at')
            ->orderBy('id', 'DESC')
            ->get();
    }

    /**
     * @param array $data
     * @param int|null $recordId
     * @return Record|null
     */
    public function save(array $data, int $recordId = null): ?Record
    {
        if( is_null($recordId) )
        {
            $model = $this->_model->create($data);
        }
        else
        {
            $model = $this->_model->find($recordId);

            if($model)
            {
                $model->update($data);
            }
        }

        return $model;
    }

    /**
     * @param int $doctorId
     * @param int $patientId
     * @return int
     */
    public function updateSeenAtByDoctorAndPatientIds(int $doctorId, int $patientId): int
    {
        return $this->_model
            ->where('to_id', $doctorId)
            ->where('from_id', $patientId)
            ->whereNull('seen_at')
            ->update([
                'seen_at' => date('Y-m-d H:i:s')
            ]);
    }
}
