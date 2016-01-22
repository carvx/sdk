<?php

namespace Carvx\Models;

abstract class AbstractModel implements \JsonSerializable
{
    public function jsonSerialize()
    {
        $result = [];
        foreach ($this->mappings() as $jsonKey => $attribute) {
            $result[$jsonKey] = $this->$attribute;
        }
        return $result;
    }

    abstract protected function mappings();

    protected function init($data, $default = '')
    {
        foreach ($this->mappings() as $jsonKey => $attribute) {
            $this->$attribute = $this->getValueOrDefault($data, $jsonKey, $default);
        }
    }

    protected function getValueOrDefault($data, $key, $default)
    {
        return array_key_exists($key, $data) ? $data[$key] : $default;
    }
}
