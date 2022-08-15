<?php

namespace Carvx\Models;

class Search extends AbstractModel
{
    const UID_FIELD = 'uid';
    const CARS_FIELD = 'cars';
    const ADDITIONAL_DATA_AVAILABLE_FIELD = 'additional_data_available';

    public $uid;
    public $cars;
    public $additionalDataAvailable;

    public function __construct($uid, $carsData, $additionalDataAvailable = false)
    {
        $this->uid = $uid;
        $this->cars = [];
        foreach ($carsData as $carId => $carData) {
            $this->cars[] = new Car($carId, $carData);
        }
        $this->additionalDataAvailable = $additionalDataAvailable;
    }

    protected function mappings()
    {
        return [
            self::UID_FIELD => 'uid',
            self::CARS_FIELD => 'cars',
            self::ADDITIONAL_DATA_AVAILABLE_FIELD => 'additionalDataAvailable'
        ];
    }
}
