<?php

namespace App\Repositories;

use App\Record;

class ReportRepository
{
    /**
     * @var Record
     */
    private Record $_model;

    /**
     * ReportRepository constructor.
     * @param Record $report
     */
    public function __construct(Record $report)
    {
        $this->_model = $report;
    }

    /**
     * @param array $data
     * @param int|null $reportId
     * @return Record
     */
    public function save(array $data, int $reportId = null): Record
    {
        $model = $this->_model->find($reportId);

        if ($model)
        {
            $model->update($data);
        }
        else
        {
            $model = $this->_model->create($data);
        }

        return $model;
    }
}
