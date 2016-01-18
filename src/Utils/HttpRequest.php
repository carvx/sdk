<?php

namespace Carvx\Utils;

class HttpRequest
{
    public $url;
    public $timeout = 90;

    public function __construct($options)
    {
        if (empty($options['url'])) {
            throw new CarvxApiException('URL not set.');
        }
        $this->url = $options['url'];
        if (!empty($options['timeout'])) {
            $this->timeout = $options['timeout'];
        }
    }
}
