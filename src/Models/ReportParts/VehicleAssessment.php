<?php

namespace Carvx\Models\ReportParts;

use Carvx\Models\AbstractModel;

class VehicleAssessment extends AbstractModel
{
    const DRS_POINTS_FIELD = 'drs_points';
    const DRS_EVALUATION_FIELD = 'drs_evaluation';
    const DRS_GOAL_AVERAGE_FIELD = 'drs_goal_average';
    const FRS_POINTS_FIELD = 'frs_points';
    const FRS_EVALUATION_FIELD = 'frs_evaluation';
    const FRS_GOAL_AVERAGE_FIELD = 'frs_goal_average';
    const DRY_STOP_DISTANCE_FIELD = 'dry_stop_distance';
    const WET_STOP_DISTANCE_FIELD = 'wet_stop_distance';
    const SAFETY_GRADE_FIELD = 'safety_grade';

    public $driverSeatPoints;
    public $driverSeatEvaluation;
    public $driverSeatGoalAverage;
    public $frontPassengerSeatPoints;
    public $frontPassengerSeatEvaluation;
    public $frontPassengerSeatGoalAverage;
    public $dryRoadStoppingDistance;
    public $wetRoadStoppingDistance;
    public $safetyGrade;

    public function __construct($usageHistoryData)
    {
        $this->init($usageHistoryData);
    }

    protected function mappings()
    {
        return [
            self::DRS_POINTS_FIELD => 'driverSeatPoints',
            self::DRS_EVALUATION_FIELD => 'driverSeatEvaluation',
            self::DRS_GOAL_AVERAGE_FIELD => 'driverSeatGoalAverage',
            self::FRS_POINTS_FIELD => 'frontPassengerSeatPoints',
            self::FRS_EVALUATION_FIELD => 'frontPassengerSeatEvaluation',
            self::FRS_GOAL_AVERAGE_FIELD => 'frontPassengerSeatGoalAverage',
            self::DRY_STOP_DISTANCE_FIELD => 'dryRoadStoppingDistance',
            self::WET_STOP_DISTANCE_FIELD => 'wetRoadStoppingDistance',
            self::SAFETY_GRADE_FIELD => 'safetyGrade',
        ];
    }
}
