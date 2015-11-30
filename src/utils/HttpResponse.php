<?php

namespace Carvx\utils;

class HttpResponse
{
    public $headers;
    public $body;

    public function __construct($curlResponse, $headerSize)
    {
        $this->headers = $this->parseHeader(substr($curlResponse, 0, $headerSize));
        $this->body = substr($curlResponse, $headerSize);
    }

    private function parseHeader($header)
    {
        $headers = explode("\r\n", $header);

        # Remove two last empty strings
        unset($headers[count($headers) - 1]);
        unset($headers[count($headers) - 1]);

        # Remove status line
        unset($headers[0]);

        return $this->parseHeaders(array_values($headers));
    }

    private function parseHeaders($headers)
    {
        $parsedHeaders = [];
        foreach ($headers as $header) {
            $parts = explode(': ', $header);
            $parsedHeaders[$parts[0]] = $parts[1];
        }
        return $parsedHeaders;
    }
}
