<?php

namespace Carvx\Utils;

class SignatureManager
{
    const SIGNATURE_PARAM = 'signature';
    const API_KEY_PARAM = 'api_key';

    private $key;
    private $needSignature;

    public function __construct($key, $needSignature)
    {
        $this->key = $key;
        $this->needSignature = $needSignature;
    }

    public function addSignature($params)
    {
        if ($this->needSignature) {
            $params[self::SIGNATURE_PARAM] = $this->createHash($params);
        } else {
            $params[self::API_KEY_PARAM] = $this->key;
        }
        return $params;
    }

    public function checkSignature($params)
    {
        if ($this->needSignature) {
            $attrib = self::SIGNATURE_PARAM;
            $p = function ($value, $params) {
                return ($this->createHash($params) === $value);
            };
        } else {
            $attrib = self::API_KEY_PARAM;
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
        if (is_array($params) && array_key_exists($attrib, $params)) {
            $value = $params[$attrib];
            unset($params[$attrib]);
            return $p($value, $params);
        }
        return false;
    }
}
