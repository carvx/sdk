<?php

namespace Carvx\Utils;

class Curl
{
    private $url;
    private $params;
    private $curl;

    /**
     * Curl constructor.
     * @param HttpRequest $request
     */
    public function __construct($request)
    {
        $this->url = $request->url;
        $this->params = $request->params;

        $this->curl = curl_init();
        curl_setopt(
            $this->curl,
            CURLOPT_HTTPHEADER,
            $this->prepareHeaders($request->headers)
        );
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $request->timeout);
        curl_setopt($this->curl, CURLOPT_HEADER, true);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    }

    public function post()
    {
        curl_setopt($this->curl, CURLOPT_URL, $this->url);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->params);
        return $this->execute();
    }

    public function get()
    {
        $stringParams = array_map(
            function ($key) {
                return sprintf('%s=%s', $key, $this->params[$key]);
            },
            array_keys($this->params)
        );
        $url = sprintf('%s?%s', $this->url, implode('&', $stringParams));
        curl_setopt($this->curl, CURLOPT_URL, $url);
        return $this->execute();
    }

    private function execute()
    {
        $response = curl_exec($this->curl);
        if (false === $response) {
            throw new CarvxApiException("No response from the server.");
        }
        if (curl_getinfo($this->curl, CURLINFO_HTTP_CODE) !== 200) {
            throw new CarvxApiException("Bad server response.\n$response");
        }
        $headerSize = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
        return new HttpResponse($response, $headerSize);
    }

    private function prepareHeaders($headers)
    {
        // Disable 100-Continue expectation
        $headers['Expect'] = '';
        return array_map(
            function ($name) use ($headers) {
                return sprintf('%s: %s', $name, $headers[$name]);
            },
            array_keys($headers)
        );
    }
}
