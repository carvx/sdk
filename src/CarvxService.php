<?php

namespace Carvx;

use Carvx\Models\Report;
use Carvx\Models\Search;
use Carvx\Utils\CarvxApiException;
use Carvx\Utils\Curl;
use Carvx\Utils\HttpRequest;
use Carvx\Utils\SignatureManager;

class CarvxService
{
    const USER_UID_HEADER = 'Carvx-User-Uid';

    private $url;
    private $uid;
    private $key;

    private $needSignature = true;
    private $raiseExceptions = false;
    private $isTest = false;

    /**
     * CarvxService constructor.
     * @param string $url URL of the CAR VX site.
     * @param string $uid User ID (can be found in the API Settings section of
     * the site).
     * @param string $key API key (can be found in the API Settings section of
     * the site).
     * @param array $options Available options are:
     * - needSignature bool sign requests or pass plain API key (default true)
     * - raiseException bool handle exception internally or not (default false)
     * - isTest bool create test reports or not (default false).
     */
    public function __construct($url, $uid, $key, $options = [])
    {
        $this->url = $url;
        $this->uid = $uid;
        $this->key = $key;

        $this->parseOptions(
            [
                'needSignature' => 'is_bool',
                'raiseExceptions' => 'is_bool',
                'isTest' => 'is_bool',
            ],
            $options
        );
    }

    /**
     * Search the car by its chassis number.
     * @param string $chassisNumber Chassis number of the car to be searched.
     * @return Search|null Created search object on success, null on failure.
     */
    public function createSearch($chassisNumber)
    {
        return $this->handleRequest(function () use ($chassisNumber) {
            $curl = new Curl($this->createRequest(
                '/api/v1/create-search',
                ['chassis_number' => $chassisNumber]
            ));
            $response = $curl->post();
            $searchData = $this->parseResponse($response);
            return new Search($searchData['uid'], $searchData['cars'], $searchData['additional_data_available']);
        });
    }

    /**
     * Order the CAR VX report by search result.
     * @param string $searchId ID of the search returned by createSearch method.
     * @param int $carId ID of the car in cars array of the search object.
     * @return string|null ID of the created report on success, null on failure.
     * @see createSearch()
     */
    public function createReport($searchId, $carId)
    {
        return $this->handleRequest(function () use ($searchId, $carId) {
            $curl = new Curl($this->createRequest(
                '/api/v1/create-report',
                [
                    'search_id' => $searchId,
                    'car_id' => $carId,
                    'is_test' => $this->getTestValue(),
                ]
            ));
            $response = $curl->post();
            return $this->parseResponse($response);
        });
    }

    /**
     * Order the CAR VX report by chassis number or VIN-code.
     * @param string $chassisNumber chassis number or VIN-code.
     * @return string|null ID of the created report on success, null on failure.
     */
    public function createReportByChassisNumber($chassisNumber)
    {
        return $this->handleRequest(function () use ($chassisNumber) {
            $curl = new Curl($this->createRequest(
                '/api/v1/create-report-by-chassis-number',
                [
                    'chassis_number' => $chassisNumber,
                    'is_test' => $this->getTestValue(),
                ]
            ));
            $response = $curl->post();
            return $this->parseResponse($response);
        });
    }

    /**
     * Get report information.
     * @param string $reportId ID of the report returned by createReport method.
     * @return Report|null Report object on success, null on failure.
     * @see createReport()
     */
    public function getReport($reportId)
    {
        return $this->handleRequest(function () use ($reportId) {
            $curl = new Curl($this->createRequest(
                '/api/v1/get-report',
                ['report_id' => $reportId]
            ));
            $response = $curl->get();
            return new Report($this->parseResponse($response));
        });
    }

    /**
     * Get due date of the report.
     * @param int $creationTime Optional timestamp of the report creation time.
     * If it is omitted current time will be used.
     * @return int|null Timestamp of the report's due date on success, null on error.
     */
    public function getReportDueDate($creationTime = null)
    {
        return $this->handleRequest(function () use ($creationTime) {
            $creationTime = $creationTime ?: time();
            $curl = new Curl($this->createRequest(
                '/api/v1/get-report-due-date',
                ['creation_time' => $creationTime]
            ));
            $response = $curl->get();
            return intval($this->parseResponse($response));
        });
    }

    private function handleRequest(\Closure $handler, $defaultValue = null)
    {
        try {
            return $handler();
        } catch (CarvxApiException $ex) {
            if ($this->raiseExceptions) {
                throw $ex;
            }
        }
        return $defaultValue;
    }

    private function parseOptions($allowedOptions, $options) {
        foreach ($allowedOptions as $attribute => $predicate) {
            if (array_key_exists($attribute, $options)
                && $predicate($options[$attribute])) {
                $this->$attribute = $options[$attribute];
            }
        }
    }

    private function createRequest($path, $params)
    {
        $signManager = new SignatureManager($this->key, $this->needSignature);
        $headers = $signManager->addSignature(
            [self::USER_UID_HEADER => $this->uid],
            $params
        );
        return new HttpRequest([
            'url' => $this->url . $path,
            'headers' => $headers,
            'params' => $params,
        ]);
    }

    private function parseResponse($response)
    {
        $parsedBody = json_decode($response->body, true);
        if (!empty($parsedBody['error'])) {
            throw new CarvxApiException($parsedBody['error']);
        }
        return $parsedBody['data'];
    }

    private function getTestValue()
    {
        return $this->isTest ? '1' : '0';
    }
}
