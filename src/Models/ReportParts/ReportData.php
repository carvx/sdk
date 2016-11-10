<?php

namespace Carvx\Models\ReportParts;

use Carvx\Models\AbstractModel;
use Carvx\Models\ReportParts\Items\AuctionHistoryItem;
use Carvx\Models\ReportParts\Items\DetailedHistoryItem;
use Carvx\Models\ReportParts\Items\OdometerHistoryItem;
use Carvx\Models\ReportParts\Items\RecallHistoryItem;

class ReportData extends AbstractModel
{
    const VEHICLE_DETAILS_FIELD = 'vehicle_details';
    const ACCIDENT_HISTORY_FIELD = 'accident_history';
    const ODOMETER_HISTORY_FIELD = 'odometer_history';
    const USAGE_HISTORY_FIELD = 'usage_history';
    const DETAILED_HISTORY_FIELD = 'detailed_history';
    const RECALL_HISTORY_FIELD = 'recall_history';
    const VEHICLE_ASSESSMENT_FIELD = 'vehicle_assessment';
    const VEHICLE_SPECIFICATION_FIELD = 'vehicle_specification';
    const SUMMARY_FIELD = 'summary';
    const AUCTION_IMAGES_FIELD = 'auction_images';
    const AUCTION_HISTORY_FIELD = 'auction_history';

    public $vehicleDetails;
    public $accidentHistory;
    public $odometerHistory = [];
    public $usageHistory;
    public $detailedHistory = [];
    public $recallHistory = [];
    public $vehicleAssessment;
    public $vehicleSpecification;
    public $summary;
    public $auctionImages = [];
    public $auctionHistory = [];

    public function __construct($reportData)
    {
        $this->vehicleDetails = new VehicleDetails($reportData[self::VEHICLE_DETAILS_FIELD]);
        $this->accidentHistory = new AccidentHistory($reportData[self::ACCIDENT_HISTORY_FIELD]);
        foreach ($reportData[self::ODOMETER_HISTORY_FIELD] as $odometerHistoryItem) {
            $this->odometerHistory[] = new OdometerHistoryItem($odometerHistoryItem);
        }
        $this->usageHistory = new UsageHistory($reportData[self::USAGE_HISTORY_FIELD]);
        foreach ($reportData[self::DETAILED_HISTORY_FIELD] as $detailedHistoryItem) {
            $this->detailedHistory[] = new DetailedHistoryItem($detailedHistoryItem);
        }
        foreach ($reportData[self::RECALL_HISTORY_FIELD] as $recallHistoryItem) {
            $this->recallHistory[] = new RecallHistoryItem($recallHistoryItem);
        }
        $this->vehicleAssessment = new VehicleAssessment($reportData[self::VEHICLE_ASSESSMENT_FIELD]);
        $this->vehicleSpecification = new VehicleSpecification($reportData[self::VEHICLE_SPECIFICATION_FIELD]);
        $this->summary = new Summary($reportData[self::SUMMARY_FIELD]);
        $this->auctionImages = $reportData[self::AUCTION_IMAGES_FIELD];
        foreach ($reportData[self::AUCTION_HISTORY_FIELD] as $auctionHistoryItem) {
            $this->auctionHistory[] = new AuctionHistoryItem($auctionHistoryItem);
        }
    }

    protected function mappings()
    {
        return [
            self::VEHICLE_DETAILS_FIELD => 'vehicleDetails',
            self::ACCIDENT_HISTORY_FIELD => 'accidentHistory',
            self::ODOMETER_HISTORY_FIELD => 'odometerHistory',
            self::USAGE_HISTORY_FIELD => 'usageHistory',
            self::DETAILED_HISTORY_FIELD => 'detailedHistory',
            self::RECALL_HISTORY_FIELD => 'recallHistory',
            self::VEHICLE_ASSESSMENT_FIELD => 'vehicleAssessment',
            self::VEHICLE_SPECIFICATION_FIELD => 'vehicleSpecification',
            self::SUMMARY_FIELD => 'summary',
            self::AUCTION_IMAGES_FIELD => 'auctionImages',
            self::AUCTION_HISTORY_FIELD => 'auctionHistory',
        ];
    }
}
