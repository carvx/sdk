<?php

namespace Carvx\Models\ReportParts;

use Carvx\Models\AbstractModel;

class VehicleDetails extends AbstractModel
{
    const CHASSIS_NUMBER_FIELD = 'chassis_number';
    const MAKE_FIELD = 'make';
    const MODEL_FIELD = 'model';
    const GRADE_FIELD = 'grade';
    const MANUFACTURE_DATE_FIELD = 'manufacture_date';
    const BODY_FIELD = 'body';
    const ENGINE_FIELD = 'engine';
    const DRIVE_FIELD = 'drive';
    const TRANSMISSION_FIELD = 'transmission';

    public $chassisNumber;
    public $make;
    public $model;
    public $grade;
    public $manufactureDate;
    public $body;
    public $engine;
    public $drive;
    public $transmission;

    public function __construct($vehicleDetailsData)
    {
        $this->init($vehicleDetailsData);
    }

    protected function mappings()
    {
        return [
            self::CHASSIS_NUMBER_FIELD => 'chassisNumber',
            self::MAKE_FIELD => 'make',
            self::MODEL_FIELD => 'model',
            self::GRADE_FIELD => 'grade',
            self::MANUFACTURE_DATE_FIELD => 'manufactureDate',
            self::BODY_FIELD => 'body',
            self::ENGINE_FIELD => 'engine',
            self::DRIVE_FIELD => 'drive',
            self::TRANSMISSION_FIELD => 'transmission',
        ];
    }
}
