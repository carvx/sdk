<?php

namespace Carvx\Utils;

class SignatureManager
{
    const SIGNATURE_HEADER = 'Carvx-Signature';
    const API_KEY_HEADER = 'Carvx-Api-Key';

    private $key;
    private $needSignature;

    public function __construct($key, $needSignature)
    {
        $this->key = $key;
        $this->needSignature = $needSignature;
    }

    public function addSignature($headers, $params)
    {
        if ($this->needSignature) {
            $headers[self::SIGNATURE_HEADER] = $this->createHash($params);
        } else {
            $headers[self::API_KEY_HEADER] = $this->key;
        }
        return $headers;
    }

    public function checkSignature($params)
    {
        if ($this->needSignature) {
            $attrib = self::SIGNATURE_HEADER;
            $p = function ($value, $params) {
                return ($this->createHash($params) === $value);
            };
        } else {
            $attrib = self::API_KEY_HEADER;
            $p = function ($value) {
                return ($this->key === $value);
            };
        }
        return $this->checkSignatureImpl($params, $attrib, $p);
    }

    private function createHash($params)
    {
        return hash('sha256', $this->transformToString($params) . $this->key);
    }

    private function transformToString($params)
    {
        ksort($params);
        return array_reduce(
            array_keys($params),
            function ($carry, $key) use ($params) {
                return $carry . $key . $params[$key];
            },
            ''
        );
    }

    private function checkSignatureImpl($params, $attrib, \Closure $p)
    {
        if ($value = $this->getHeaderValue($attrib)) {
            return $p($value, $params);
        }
        return false;
    }

    private function getHeaderValue($name)
    {
        $headerName = strtoupper('http_' . str_replace('-', '_', $name));
        return isset($headerName, $_SERVER)
            ? $_SERVER[$headerName]
            : null;
    }
}
