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

    public function __construct($url, $uid, $key, $options = [])
    {
        $this->url = $url;
        $this->uid = $uid;
        $this->key = $key;

        $this->parseOptions(
            [
                'needSignature' => 'is_bool',
                'raiseExceptions' => 'is_bool',
            ],
            $options
        );
    }

    public function createSearch($chassisNumber)
    {
        return $this->handleRequest(function () use ($chassisNumber) {
            $curl = new Curl($this->createRequest(
                '/api/v1/create-search',
                ['chassis_number' => $chassisNumber]
            ));
            $response = $curl->post();
            $searchData = $this->parseResponse($response);
            return new Search($searchData['uid'], $searchData['cars']);
        });
    }

    public function createReport($searchId, $carId)
    {
        return $this->handleRequest(function () use ($searchId, $carId) {
            $curl = new Curl($this->createRequest(
                '/api/v1/create-report',
                ['search_id' => $searchId, 'car_id' => $carId]
            ));
            $response = $curl->post();
            return $this->parseResponse($response);
        });
    }

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
}
