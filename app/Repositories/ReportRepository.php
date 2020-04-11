<?php

namespace App\Repositories;

use App\Report;

class ReportRepository
{
    /**
     * @var Report
     */
    private Report $_model;

    /**
     * ReportRepository constructor.
     * @param Report $report
     */
    public function __construct(Report $report)
    {
        $this->_model = $report;
    }

    /**
     * @param array $data
     * @param int|null $reportId
     * @return Report
     */
    public function save(array $data, int $reportId = null): Report
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
