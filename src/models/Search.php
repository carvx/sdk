<?php

namespace Carvx\models;

class Search implements \JsonSerializable
{
    private $uid;
    private $cars;

    public static function fromJson($json)
    {
        $searchData = json_decode($json, true);
        return new Search($searchData['uid'], $searchData['cars']);
    }

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
