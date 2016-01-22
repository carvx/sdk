<?php

namespace Carvx\Models\ReportParts;

use Carvx\Models\AbstractModel;

class VehicleSpecification extends AbstractModel
{
    const FIRST_GEAR_RATIO_FIELD = 'first_gear_ratio';
    const SECOND_GEAR_RATIO_FIELD = 'second_gear_ratio';
    const THIRD_GEAR_RATIO_FIELD = 'third_gear_ratio';
    const FOURTH_GEAR_RATIO_FIELD = 'fourth_gear_ratio';
    const FIFTH_GEAR_RATIO_FIELD = 'fifth_gear_ratio';
    const SIXTH_GEAR_RATIO_FIELD = 'sixth_gear_ratio';
    const ADDITIONAL_NOTES_FIELD = 'additional_notes';
    const AIRBAG_POSITION_FIELD = 'airbag_position';
    const BODY_REAR_OVERHANG_FIELD = 'body_rear_overhang';
    const BODY_TYPE_FIELD = 'body_type';
    const CHASSIS_NUMBER_EMBOSSING_POSITION_FIELD = 'chassis_number_embossing_position';
    const CLASSIFICATION_CODE_FIELD = 'classification_code';
    const CYLINDERS_FIELD = 'cylinders';
    const DISPLACEMENT_FIELD = 'displacement';
    const ELECTRIC_ENGINE_TYPE_FIELD = 'electric_engine_type';
    const ELECTRIC_ENGINE_MAXIMUM_OUTPUT_FIELD = 'electric_engine_maximum_output';
    const ELECTRIC_ENGINE_MAXIMUM_TORQUE_FIELD = 'electric_engine_maximum_torque';
    const ELECTRIC_ENGINE_POWER_FIELD = 'electric_engine_power';
    const ENGINE_MAXIMUM_POWER_FIELD = 'engine_maximum_power';
    const ENGINE_MAXIMUM_TORQUE_FIELD = 'engine_maximum_torque';
    const ENGINE_MODEL_FIELD = 'engine_model';
    const FRAME_TYPE_FIELD = 'frame_type';
    const FRONT_SHAFT_WEIGHT_FIELD = 'front_shaft_weight';
    const FRONT_SHOCK_ABSORBER_TYPE_FIELD = 'front_shock_absorber_type';
    const FRONT_STABILIZER_TYPE_FIELD = 'front_stabilizer_type';
    const FRONT_TIRES_SIZE_FIELD = 'front_tires_size';
    const FRONT_TREAD_FIELD = 'front_tread';
    const FUEL_CONSUMPTION_FIELD = 'fuel_consumption';
    const FUEL_TANK_EQUIPMENT_FIELD = 'fuel_tank_equipment';
    const GRADE_DATA_FIELD = 'grade_data';
    const HEIGHT_FIELD = 'height';
    const LENGTH_FIELD = 'length';
    const MAIN_BRAKES_TYPE_FIELD = 'main_brakes_type';
    const DATA_MAKE_FIELD = 'data_make';
    const MAXIMUM_SPEED_FIELD = 'maximum_speed';
    const MINIMUM_GROUND_CLEARANCE_FIELD = 'minimum_ground_clearance';
    const MINIMUM_TURNING_RADIUS_FIELD = 'minimum_turning_radius';
    const MODEL_DATA_FIELD = 'model_data';
    const MODEL_CODE_FIELD = 'model_code';
    const MUFFLERS_NUMBER_FIELD = 'mufflers_number';
    const REAR_SHAFT_WEIGHT_FIELD = 'rear_shaft_weight';
    const REAR_SHOCK_ABSORBER_TYPE_FIELD = 'rear_shock_absorber_type';
    const REAR_STABILIZER_TYPE_FIELD = 'rear_stabilizer_type';
    const REAR_TIRES_SIZE_FIELD = 'rear_tires_size';
    const REAR_TREAD_FIELD = 'rear_tread';
    const REVERSE_RATIO_FIELD = 'reverse_ratio';
    const RIDING_CAPACITY_FIELD = 'riding_capacity';
    const SIDE_BRAKES_TYPE_FIELD = 'side_brakes_type';
    const SPECIFICATION_CODE_FIELD = 'specification_code';
    const STOPPING_DISTANCE_FIELD = 'stopping_distance';
    const TRANSMISSION_TYPE_FIELD = 'transmission_type';
    const WEIGHT_FIELD = 'weight';
    const WHEEL_ALIGNMENT_FIELD = 'wheel_alignment';
    const WHEELBASE_FIELD = 'wheelbase';
    const WIDTH_FIELD = 'width';

    public $firstGearRatio;
    public $secondGearRatio;
    public $thirdGearRatio;
    public $fourthGearRatio;
    public $fifthGearRatio;
    public $sixthGearRatio;
    public $additionalNotes;
    public $airbagPosition;
    public $bodyRearOverhang;
    public $bodyType;
    public $chassisNumberEmbossingPosition;
    public $classificationCode;
    public $cylinders;
    public $displacement;
    public $electricEngineType;
    public $electricEngineMaximumOutput;
    public $electricEngineMaximumTorque;
    public $electricEnginePower;
    public $engineMaximumPower;
    public $engineMaximumTorque;
    public $engineModel;
    public $frameType;
    public $frontShaftWeight;
    public $frontShockAbsorberType;
    public $frontStabilizerType;
    public $frontTiresSize;
    public $frontTread;
    public $fuelConsumption;
    public $fuelTankEquipment;
    public $gradeData;
    public $height;
    public $length;
    public $mainBrakesType;
    public $dataMake;
    public $maximumSpeed;
    public $minimumGroundClearance;
    public $minimumTurningRadius;
    public $modelData;
    public $modelCode;
    public $mufflersNumber;
    public $rearShaftWeight;
    public $rearShockAbsorberType;
    public $rearStabilizerType;
    public $rearTiresSize;
    public $rearTread;
    public $reverseRatio;
    public $ridingCapacity;
    public $sideBrakesType;
    public $specificationCode;
    public $stoppingDistance;
    public $transmissionType;
    public $weight;
    public $wheelAlignment;
    public $wheelbase;
    public $width;

    public function __construct($vehicleSpecification)
    {
        $this->init($vehicleSpecification);
    }

    protected function mappings()
    {
        return [
            self::FIRST_GEAR_RATIO_FIELD => 'firstGearRatio',
            self::SECOND_GEAR_RATIO_FIELD => 'secondGearRatio',
            self::THIRD_GEAR_RATIO_FIELD => 'thirdGearRatio',
            self::FOURTH_GEAR_RATIO_FIELD => 'fourthGearRatio',
            self::FIFTH_GEAR_RATIO_FIELD => 'fifthGearRatio',
            self::SIXTH_GEAR_RATIO_FIELD => 'sixthGearRatio',
            self::ADDITIONAL_NOTES_FIELD => 'additionalNotes',
            self::AIRBAG_POSITION_FIELD => 'airbagPosition',
            self::BODY_REAR_OVERHANG_FIELD => 'bodyRearOverhang',
            self::BODY_TYPE_FIELD => 'bodyType',
            self::CHASSIS_NUMBER_EMBOSSING_POSITION_FIELD => 'chassisNumberEmbossingPosition',
            self::CLASSIFICATION_CODE_FIELD => 'classificationCode',
            self::CYLINDERS_FIELD => 'cylinders',
            self::DISPLACEMENT_FIELD => 'displacement',
            self::ELECTRIC_ENGINE_TYPE_FIELD => 'electricEngineType',
            self::ELECTRIC_ENGINE_MAXIMUM_OUTPUT_FIELD => 'electricEngineMaximumOutput',
            self::ELECTRIC_ENGINE_MAXIMUM_TORQUE_FIELD => 'electricEngineMaximumTorque',
            self::ELECTRIC_ENGINE_POWER_FIELD => 'electricEnginePower',
            self::ENGINE_MAXIMUM_POWER_FIELD => 'engineMaximumPower',
            self::ENGINE_MAXIMUM_TORQUE_FIELD => 'engineMaximumTorque',
            self::ENGINE_MODEL_FIELD => 'engineModel',
            self::FRAME_TYPE_FIELD => 'frameType',
            self::FRONT_SHAFT_WEIGHT_FIELD => 'frontShaftWeight',
            self::FRONT_SHOCK_ABSORBER_TYPE_FIELD => 'frontShockAbsorberType',
            self::FRONT_STABILIZER_TYPE_FIELD => 'frontStabilizerType',
            self::FRONT_TIRES_SIZE_FIELD => 'frontTiresSize',
            self::FRONT_TREAD_FIELD => 'frontTread',
            self::FUEL_CONSUMPTION_FIELD => 'fuelConsumption',
            self::FUEL_TANK_EQUIPMENT_FIELD => 'fuelTankEquipment',
            self::GRADE_DATA_FIELD => 'gradeData',
            self::HEIGHT_FIELD => 'height',
            self::LENGTH_FIELD => 'length',
            self::MAIN_BRAKES_TYPE_FIELD => 'mainBrakesType',
            self::DATA_MAKE_FIELD => 'dataMake',
            self::MAXIMUM_SPEED_FIELD => 'maximumSpeed',
            self::MINIMUM_GROUND_CLEARANCE_FIELD => 'minimumGroundClearance',
            self::MINIMUM_TURNING_RADIUS_FIELD => 'minimumTurningRadius',
            self::MODEL_DATA_FIELD => 'modelData',
            self::MODEL_CODE_FIELD => 'modelCode',
            self::MUFFLERS_NUMBER_FIELD => 'mufflersNumber',
            self::REAR_SHAFT_WEIGHT_FIELD => 'rearShaftWeight',
            self::REAR_SHOCK_ABSORBER_TYPE_FIELD => 'rearShockAbsorberType',
            self::REAR_STABILIZER_TYPE_FIELD => 'rearStabilizerType',
            self::REAR_TIRES_SIZE_FIELD => 'rearTiresSize',
            self::REAR_TREAD_FIELD => 'rearTread',
            self::REVERSE_RATIO_FIELD => 'reverseRatio',
            self::RIDING_CAPACITY_FIELD => 'ridingCapacity',
            self::SIDE_BRAKES_TYPE_FIELD => 'sideBrakesType',
            self::SPECIFICATION_CODE_FIELD => 'specificationCode',
            self::STOPPING_DISTANCE_FIELD => 'stoppingDistance',
            self::TRANSMISSION_TYPE_FIELD => 'transmissionType',
            self::WEIGHT_FIELD => 'weight',
            self::WHEEL_ALIGNMENT_FIELD => 'wheelAlignment',
            self::WHEELBASE_FIELD => 'wheelbase',
            self::WIDTH_FIELD => 'width',
        ];
    }
}
