<?php

namespace Carvx\Models;

class Car extends AbstractModel
{
    const CAR_ID_FIELD = 'car_id';
    const CHASSIS_NUMBER_FIELD = 'chassis_number';
    const MAKE_FIELD = 'make';
    const MODEL_FIELD = 'model';
    const GRADE_FIELD = 'grade';
    const MANUFACTURE_DATE_FIELD = 'manufacture_date';
    const BODY_FIELD = 'body';
    const ENGINE_FIELD = 'engine';
    const DRIVE_FIELD = 'drive';
    const TRANSMISSION_FIELD = 'transmission';

    public $carId;
    public $chassisNumber = '';
    public $make = '';
    public $model = '';
    public $grade = '';
    public $manufactureDate = '';
    public $body = '';
    public $engine = '';
    public $drive = '';
    public $transmission = '';

    public function __construct($carId, $carData)
    {
        $this->carId = $carId;
        $this->chassisNumber = $carData[self::CHASSIS_NUMBER_FIELD];
        $this->make = $carData[self::MAKE_FIELD];
        $this->model = $carData[self::MODEL_FIELD];
        $this->grade = $carData[self::GRADE_FIELD];
        $this->manufactureDate = $carData[self::MANUFACTURE_DATE_FIELD];
        $this->body = $carData[self::BODY_FIELD];
        $this->engine = $carData[self::ENGINE_FIELD];
        $this->drive = $carData[self::DRIVE_FIELD];
        $this->transmission = $carData[self::TRANSMISSION_FIELD];
    }

    protected function mappings()
    {
        return [
            self::CAR_ID_FIELD => 'carId',
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
