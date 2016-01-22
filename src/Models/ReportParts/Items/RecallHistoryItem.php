<?php

namespace Carvx\Models\ReportParts\Items;

use Carvx\Models\AbstractModel;

class RecallHistoryItem extends AbstractModel
{
    const DATE_FIELD = 'date';
    const SOURCE_FIELD = 'source';
    const AFFECTED_PART_FIELD = 'affected_part';
    const DETAILS_FIELD = 'details';

    public $date;
    public $source;
    public $affected_part;
    public $details;

    public function __construct($recallHistoryItemData)
    {
        $this->init($recallHistoryItemData);
    }

    protected function mappings()
    {
        return [
            self::DATE_FIELD => 'date',
            self::SOURCE_FIELD => 'source',
            self::AFFECTED_PART_FIELD => 'affected_part',
            self::DETAILS_FIELD => 'details',
        ];
    }
}
