<?php

namespace Carvx;

use Carvx\models\Search;
use Carvx\utils\CarvxApiException;
use Carvx\utils\Curl;
use Carvx\utils\HttpRequest;

class CarvxService
{
    private $url;
    private $uid;
    private $signature;

    public function __construct($url, $uid, $signature)
    {
        $this->url = $url;
        $this->uid = $uid;
        $this->signature = $signature;
    }

    public function createSearch($chassisNumber)
    {
        $request = new HttpRequest([
            'url' => sprintf('%s/api/v1/search', $this->url),
            'timeout' => '150',
        ]);
        $curl = new Curl($request);
        try {
            $response = $curl->post(['chassis_number' => $chassisNumber]);
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
