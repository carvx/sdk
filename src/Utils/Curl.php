<?php

namespace Carvx\Utils;

class Curl
{
    private $url;
    private $curl;

    /**
     * Curl constructor.
     * @param HttpRequest $request
     */
    public function __construct($request)
    {
        $this->url = $request->url;
        $this->curl = curl_init();
        // Disable 100-Continue expectation
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, ['Expect:']);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $request->timeout);
        curl_setopt($this->curl, CURLOPT_HEADER, true);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    }

    public function post($params)
    {
        curl_setopt($this->curl, CURLOPT_URL, $this->url);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $params);
        return $this->execute();
    }

    public function get($params)
    {
        $stringParams = array_map(
            function ($key) use ($params) {
                return sprintf('%s=%s', $key, $params[$key]);
            },
            array_keys($params)
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
}
