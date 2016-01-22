<?php

namespace Carvx\Models;

use Carvx\Models\ReportParts\ReportData;

class Report extends AbstractModel
{
    const NEW_STATUS = 3;
    const IN_PROGRESS_STATUS = 4;
    const COMPLETED_STATUS = 5;
    const CANCELED_STATUS = 6;

    const REPORT_ID_FIELD = 'report_id';
    const STATUS_FIELD = 'status';
    const DATA_FIELD = 'data';

    public $reportId;
    public $status;
    public $data;

    public function __construct($reportData)
    {
        $this->reportId = $this->getValueOrDefault(
            $reportData,
            self::REPORT_ID_FIELD,
            ''
        );
        $this->status = $this->getValueOrDefault(
            $reportData,
            self::STATUS_FIELD,
            ''
        );
        $this->data = $this->isCompleted()
            ? new ReportData($reportData[self::DATA_FIELD])
            : null;
    }

    public function isCompleted()
    {
        return (self::COMPLETED_STATUS === $this->status);
    }

    protected function mappings()
    {
        return [
            self::REPORT_ID_FIELD => 'reportId',
            self::STATUS_FIELD => 'status',
            self::DATA_FIELD => 'data'
        ];
    }
}
