<?php

namespace Carvx\utils;

class HttpRequest
{
    const HTTP_VERSION_1_0 = CURL_HTTP_VERSION_1_0;
    const HTTP_VERSION_1_1 = CURL_HTTP_VERSION_1_1;

    public $url;
    public $httpVersion = self::HTTP_VERSION_1_0;
    public $connectTimeout = 60;
    public $timeout = 0;

    public function __construct($options)
    {
        if (empty($options['url'])) {
            throw new CarvxApiException('URL not set.');
        }
        $this->url = $options['url'];
        foreach (['httpVersion', 'connectTimeout', 'timeout'] as $attribute) {
            if (!empty($options[$attribute])) {
                $this->$attribute = $options[$attribute];
            }
        }
    }
}
