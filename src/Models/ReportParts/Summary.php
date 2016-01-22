<?php

namespace Carvx\Models\ReportParts;

use Carvx\Models\AbstractModel;

class Summary extends AbstractModel
{
    const REGISTERED_FIELD = 'registered';
    const ACCIDENT_FIELD = 'accident';
    const ODOMETER_FIELD = 'odometer';
    const RECALL_FIELD = 'recall';
    const SAFETY_GRADE_FIELD = 'safety_grade';
    const AVERAGE_PRICE_FIELD = 'average_price';
    const BUYBACK_FIELD = 'buyback';
    const CONTAMINATION_RISK_FIELD = 'contamination_risk';
    const FILLING_TIME_FIELD = 'filling_time';

    public $registered;
    public $accident;
    public $odometer;
    public $recall;
    public $safetyGrade;
    public $averagePrice;
    public $buyback;
    public $contaminationRisk;
    public $fillingTime;

    public function __construct($summaryData)
    {
        $this->init($summaryData);
    }

    protected function mappings()
    {
        return [
            self::REGISTERED_FIELD => 'registered',
            self::ACCIDENT_FIELD => 'accident',
            self::ODOMETER_FIELD => 'odometer',
            self::RECALL_FIELD => 'recall',
            self::SAFETY_GRADE_FIELD => 'safetyGrade',
            self::AVERAGE_PRICE_FIELD => 'averagePrice',
            self::BUYBACK_FIELD => 'buyback',
            self::CONTAMINATION_RISK_FIELD => 'contaminationRisk',
            self::FILLING_TIME_FIELD => 'fillingTime',
        ];
    }
}
