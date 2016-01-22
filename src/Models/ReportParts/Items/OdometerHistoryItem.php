<?php

namespace Carvx\Models\ReportParts\Items;

use Carvx\Models\AbstractModel;

class OdometerHistoryItem extends AbstractModel
{
    const DATE_FIELD = 'date';
    const SOURCE_FIELD = 'source';
    const MILEAGE_FIELD = 'mileage';

    public $date;
    public $source;
    public $mileage;

    public function __construct($odometerHistoryItemData)
    {
        $this->init($odometerHistoryItemData);
    }

    protected function mappings()
    {
        return [
            self::DATE_FIELD => 'date',
            self::SOURCE_FIELD => 'source',
            self::MILEAGE_FIELD => 'mileage',
        ];
    }
}
