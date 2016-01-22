<?php

namespace Carvx\Models\ReportParts;

use Carvx\Models\AbstractModel;
use Carvx\Models\ReportParts\Items\AccidentHistoryItem;

class AccidentHistory extends AbstractModel
{
    const COLLISION_FIELD = 'collision';
    const MALFUNCTION_FIELD = 'malfunction';
    const THEFT_FIELD = 'theft';
    const FIRE_DAMAGE_FIELD = 'fire_damage';
    const WATER_DAMAGE_FIELD = 'water_damage';
    const HAIL_DAMAGE_FIELD = 'hail_damage';

    public $collision = [];
    public $malfunction = [];
    public $theft = [];
    public $fireDamage = [];
    public $waterDamage = [];
    public $hailDamage = [];

    public function __construct($accidentHistoryData)
    {
        foreach ($accidentHistoryData as $type => $items) {
            $attribute = $this->mappings()[$type];
            foreach ($items as $itemData) {
                $this->{$attribute}[] = new AccidentHistoryItem($itemData);
            }
        }
    }

    protected function mappings()
    {
        return [
            self::COLLISION_FIELD => 'collision',
            self::MALFUNCTION_FIELD => 'malfunction',
            self::THEFT_FIELD => 'theft',
            self::FIRE_DAMAGE_FIELD => 'fireDamage',
            self::WATER_DAMAGE_FIELD => 'waterDamage',
            self::HAIL_DAMAGE_FIELD => 'hailDamage',
        ];
    }
}
