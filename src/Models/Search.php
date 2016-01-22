<?php

namespace Carvx\Models;

class Search extends AbstractModel
{
    const UID_FIELD = 'uid';
    const CARS_FIELD = 'cars';

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

    protected function mappings()
    {
        return [
            self::UID_FIELD => 'uid',
            self::CARS_FIELD => 'cars'
        ];
    }
}
