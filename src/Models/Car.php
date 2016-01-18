<?php

namespace Carvx\Models;

class Car implements \JsonSerializable
{
    public $carId;
    public $chassisNumber = '';
    public $make = '';
    public $model = '';
    public $grade = '';
    public $year = '';
    public $body = '';
    public $engine = '';
    public $drive = '';
    public $transmission = '';

    public function __construct($carId, $carData)
    {
        $this->carId = $carId;
        $this->chassisNumber = $carData['chassis_number'];
        $this->make = $carData['make'];
        $this->model = $carData['model'];
        $this->grade = $carData['grade'];
        $this->year = $carData['year'];
        $this->body = $carData['body'];
        $this->engine = $carData['engine'];
        $this->drive = $carData['drive'];
        $this->transmission = $carData['transmission'];
    }

    public function jsonSerialize()
    {
        return [
            'car_id' => $this->carId,
            'chassis_number' => $this->chassisNumber,
            'make' => $this->make,
            'model' => $this->model,
            'grade' => $this->grade,
            'year' => $this->year,
            'body' => $this->body,
            'engine' => $this->engine,
            'drive' => $this->drive,
            'transmission' => $this->transmission,
        ];
    }
}
