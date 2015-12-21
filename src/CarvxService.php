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
    private $raiseExceptions = false;

    public function __construct($url, $uid, $key, $options = [])
    {
        // Force usage of HTTPS.
        $this->url = preg_replace('/^http:/', 'https:', strtolower($url));
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
            $request = new HttpRequest([
                'url' => $this->createUrl('/api/v1/createSearch'),
            ]);
            $curl = new Curl($request);
            $params = $this->prepareParams(['chassis_number' => $chassisNumber]);
            $response = $curl->post($params);
            $searchData = $this->parseResponse($response);
            return new Search($searchData['uid'], $searchData['cars']);
        });
    }

    public function createReport($searchId, $carId)
    {
        return $this->handleRequest(function () use ($searchId, $carId) {
            $request = new HttpRequest([
                'url' => $this->createUrl('/api/v1/createReport'),
            ]);
            $curl = new Curl($request);
            $params = $this->prepareParams([
                'search_id' => $searchId,
                'car_id' => $carId
            ]);
            $response = $curl->post($params);
            return $this->parseResponse($response);
        });
    }

    private function handleRequest(\Closure $handler, $defaultValue = null)
    {
        try {
            return $handler();
        } catch (CarvxApiException $ex) {
            // TODO: add logging
            //echo($ex->getMessage() . "\n");
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

    private function createUrl($path)
    {
        return sprintf('%s%s', $this->url, $path);
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
            throw new CarvxApiException($parsedBody['error']);
        }
        return $parsedBody['data'];
    }
}
