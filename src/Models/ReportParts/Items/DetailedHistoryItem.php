<?php

namespace Carvx\Models\ReportParts\Items;

use Carvx\Models\AbstractModel;

class DetailedHistoryItem extends AbstractModel
{
    const DATE_FIELD = 'date';
    const SOURCE_FIELD = 'source';
    const MILEAGE_FIELD = 'mileage';
    const ACTION_FIELD = 'action';
    const LOCATION_FIELD = 'location';

    public $date;
    public $source;
    public $mileage;
    public $action;
    public $location;

    public function __construct($detailedHistoryItemData)
    {
        $this->init($detailedHistoryItemData);
    }

    protected function mappings()
    {
        return [
            self::DATE_FIELD => 'date',
            self::SOURCE_FIELD => 'source',
            self::MILEAGE_FIELD => 'mileage',
            self::ACTION_FIELD => 'action',
            self::LOCATION_FIELD => 'location',
        ];
    }
}
