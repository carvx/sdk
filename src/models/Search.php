<?php

namespace Carvx\models;

class Search implements \JsonSerializable
{
    public $uid;
    public $cars;

    public function __construct($uid, $carsData)
    {
        $this->uid = $uid;
        $this->cars = [];
        foreach ($carsData as $carId => $carData) {
            $this->cars[] = new Car($carId, $carData);
        }
    }

    function jsonSerialize()
    {
        return ['uid' => $this->uid, 'cars' => $this->cars];
    }
}
