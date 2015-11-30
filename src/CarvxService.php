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
            'url' => sprintf('%s/v1/search', $this->url),
            'connectTimeout' => '150',
        ]);
        $curl = new Curl($request);
        $response = $curl->post(['chassis_number' => $chassisNumber]);
        return Search::fromJson($response->body);
    }
}
