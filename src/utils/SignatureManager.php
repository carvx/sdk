<?php

namespace Carvx\utils;

class SignatureManager
{
    const SIGNATURE_PARAM = 'signature';

    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function addSignature($params)
    {
        $params[self::SIGNATURE_PARAM] = $this->createHash($params);
        return $params;
    }

    public function checkSignature($params)
    {
        $attrib = self::SIGNATURE_PARAM;
        if (is_array($params) && array_key_exists($attrib, $params)) {
            $signature = $params[$attrib];
            unset($params[$attrib]);
            return ($this->createHash($params) === $signature);
        }
        return false;
    }

    private function createHash($params)
    {
        $data = $this->transformToString($params);
        return base64_encode(hash_hmac('sha256', $data, $this->key, true));
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
}
