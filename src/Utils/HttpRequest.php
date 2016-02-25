<?php

namespace Carvx\Utils;

class HttpRequest
{
    public $url;
    public $headers = [];
    public $params = [];
    public $timeout = 90;

    public function __construct($options)
    {
        if (empty($options['url'])) {
            throw new CarvxApiException('URL not set.');
        }
        $this->url = $options['url'];

        if (isset($options['timeout'])) {
            $this->timeout = $options['timeout'];
        }
        if (isset($options['headers'])) {
            $this->headers = $options['headers'];
        }
        if (isset($options['params'])) {
            $this->params = $options['params'];
        }
    }
}
