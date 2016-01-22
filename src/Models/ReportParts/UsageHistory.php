<?php

namespace Carvx\Models\ReportParts;

use Carvx\Models\AbstractModel;

class UsageHistory extends AbstractModel
{
    const CONTAMINATED_REGION_FIELD = 'contaminated_region';
    const CONTAMINATION_TEST_FIELD = 'contamination_test';
    const COMMERCIAL_USAGE_FIELD = 'commercial_usage';

    public $contaminatedRegion;
    public $contaminationTest;
    public $commercialUsage;

    public function __construct($usageHistoryData)
    {
        $this->init($usageHistoryData);
    }

    protected function mappings()
    {
        return [
            self::CONTAMINATED_REGION_FIELD => 'contaminatedRegion',
            self::CONTAMINATION_TEST_FIELD => 'contaminationTest',
            self::COMMERCIAL_USAGE_FIELD => 'commercialUsage',
        ];
    }
}
