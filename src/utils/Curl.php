<?php

namespace Carvx\utils;

class Curl
{
    private $curl;

    /**
     * Curl constructor.
     * @param HttpRequest $request
     */
    public function __construct($request)
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_URL, $request->url);
        // Disable 100-Continue expectation
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, ['Expect:']);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $request->timeout);
        curl_setopt($this->curl, CURLOPT_HEADER, true);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    }

    public function post($params)
    {
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $params);
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
