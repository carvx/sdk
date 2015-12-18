<?php

namespace Carvx;

use Carvx\models\Search;
use Carvx\utils\CarvxApiException;
use Carvx\utils\Curl;
use Carvx\utils\HttpRequest;
use Carvx\utils\SignatureManager;

class CarvxService
{
    const USER_UID_PARAM = 'user_uid';
    const API_KEY_PARAM = 'api_key';

    private $url;
    private $uid;
    private $key;

    private $needSignature = true;

    public function __construct($url, $uid, $key, $options = [])
    {
        // Force usage of HTTPS.
        $this->url = preg_replace('/^http:/', 'https:', strtolower($url));
        $this->uid = $uid;
        $this->key = $key;

        if (array_key_exists('needSignature', $options)
            && is_bool($options['needSignature'])) {
            $this->needSignature = $options['needSignature'];
        }
    }

    public function createSearch($chassisNumber)
    {
        $request = new HttpRequest([
            'url' => sprintf('%s/api/v1/createSearch', $this->url),
            'timeout' => '150',
        ]);
        $curl = new Curl($request);
        try {
            $params = $this->prepareParams(['chassis_number' => $chassisNumber]);
            $response = $curl->post($params);
            $searchData = $this->parseResponse($response);
            if (!empty($searchData)) {
                return new Search($searchData['uid'], $searchData['cars']);
            }
        } catch (CarvxApiException $ex) {
            // TODO: add logging
            //echo($ex->getMessage() . "\n");
        }
        return null;
    }

    public function createReport($searchId, $carId)
    {
        $request = new HttpRequest([
            'url' => sprintf('%s/api/v1/createReport', $this->url),
        ]);
        $curl = new Curl($request);
        try {
            $params = $this->prepareParams([
                'search_id' => $searchId,
                'car_id' => $carId
            ]);
            $response = $curl->post($params);
            $reportId = $this->parseResponse($response);
            if (!empty($reportId)) {
                return $reportId;
            }
        } catch (CarvxApiException $ex) {
            // TODO: add logging
            //echo($ex->getMessage() . "\n");
        }
        return null;
    }

    private function prepareParams($params)
    {
        $params[self::USER_UID_PARAM] = $this->uid;
        if ($this->needSignature) {
            $signManager = new SignatureManager($this->key);
            return $signManager->addSignature($params);
        } else {
            $params[self::API_KEY_PARAM] = $this->key;
            return $params;
        }
    }

    private function parseResponse($response)
    {
        $parsedBody = json_decode($response->body, true);
        if (!empty($parsedBody['error'])) {
            // TODO: add logging
            //echo($parsedBody['error'] . "\n");
        }
        return $parsedBody['data'];
    }
}
