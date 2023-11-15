<?php

namespace Carvx\Models\ReportParts\Items;

use Carvx\Models\AbstractModel;

class AuctionHistoryItem extends AbstractModel
{
    const DATE_FIELD = 'date';
    const LOT_NUMBER_FIELD = 'lot_number';
    const AUCTION_FIELD = 'auction';
    const BRAND_FIELD = 'make';
    const MODEL_FIELD = 'model';
    const REGISTRATION_DATE_FIELD = 'registration_date';
    const MILEAGE_FIELD = 'mileage';
    const VOLUME_FIELD = 'displacement';
    const TRANSMISSION_FIELD = 'transmission';
    const COLOR_FIELD = 'color';
    const MODEL_BODY_FIELD = 'body';
    const PRICE_FIELD = 'final_price';
    const RESULT_FIELD = 'result';
    const ASSESSMENT_FIELD = 'assessment';
    const IMAGES_FIELD = 'images';
    const REGION_FIELD = 'region';
    const PROBLEM_TYPE_FIELD = 'problem_type';
    const PROBLEM_SCALE_FIELD = 'problem_scale';
    const AIRBAG_FIELD = 'airbag';
    const IS_CONTAMINATED_FIELD = 'is_contaminated';
    const AUCTION_LOT_URL_FIELD = 'auction_lot_url';

    public $date;
    public $lotNumber;
    public $auction;
    public $auctionLotUrl;
    public $make;
    public $model;
    public $registrationDate;
    public $mileage;
    public $displacement;
    public $transmission;
    public $color;
    public $body;
    public $finalPrice;
    public $result;
    public $assessment;
    public $region;
    public $problemType;
    public $problemScale;
    public $airbag;
    public $isContaminated;
    public $images = [];

    public function __construct($auctionHistoryData)
    {
        $this->init($auctionHistoryData);
    }

    protected function mappings()
    {
        return [
            self::DATE_FIELD => 'date',
            self::LOT_NUMBER_FIELD => 'lotNumber',
            self::AUCTION_FIELD => 'auction',
            self::AUCTION_LOT_URL_FIELD => 'auctionLotUrl',
            self::BRAND_FIELD => 'make',
            self::MODEL_FIELD => 'model',
            self::REGISTRATION_DATE_FIELD => 'registrationDate',
            self::MILEAGE_FIELD => 'mileage',
            self::VOLUME_FIELD => 'displacement',
            self::TRANSMISSION_FIELD => 'transmission',
            self::COLOR_FIELD => 'color',
            self::MODEL_BODY_FIELD => 'body',
            self::PRICE_FIELD => 'finalPrice',
            self::RESULT_FIELD => 'result',
            self::ASSESSMENT_FIELD => 'assessment',
            self::REGION_FIELD => 'region',
            self::PROBLEM_TYPE_FIELD => 'problemType',
            self::PROBLEM_SCALE_FIELD => 'problemScale',
            self::AIRBAG_FIELD => 'airbag',
            self::IS_CONTAMINATED_FIELD => 'isContaminated',
            self::IMAGES_FIELD => 'images',
        ];
    }
}
