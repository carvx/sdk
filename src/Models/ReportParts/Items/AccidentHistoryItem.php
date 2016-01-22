<?php

namespace Carvx\Models\ReportParts\Items;

use Carvx\Models\AbstractModel;

class AccidentHistoryItem extends AbstractModel
{
    const DATE_FIELD = 'date';
    const SOURCE_FIELD = 'source';
    const PROBLEM_SCALE_FIELD = 'problem_scale';
    const AIRBAG_FIELD = 'airbag';

    public $date;
    public $source;
    public $problemScale;
    public $airbag;

    public function __construct($accidentHistoryItemData)
    {
        $this->init($accidentHistoryItemData);
    }

    protected function mappings()
    {
        return [
            self::DATE_FIELD => 'date',
            self::SOURCE_FIELD => 'source',
            self::PROBLEM_SCALE_FIELD => 'problemScale',
            self::AIRBAG_FIELD => 'airbag',
        ];
    }
}
