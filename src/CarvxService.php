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

    private $url;
    private $uid;
    private $key;

    public function __construct($url, $uid, $key)
    {
        $this->url = $url;
        $this->uid = $uid;
        $this->key = $key;
    }

    public function createSearch($chassisNumber)
    {
        $request = new HttpRequest([
            'url' => sprintf('%s/api/v1/search', $this->url),
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

    private function prepareParams($params)
    {
        $params[self::USER_UID_PARAM] = $this->uid;
        $signManager = new SignatureManager($this->key);
        return $signManager->addSignature($params);
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
