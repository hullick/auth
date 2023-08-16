<?php

namespace Tests\StaticData;

use App\Exceptions\JsonEncodeErrorException;
use App\Traits\JsonSerializable;

trait RequestData
{
    use JsonSerializable;

    /**
     * Return all data in array format
     * @return array
     */
    public function asArray(): array
    {
        try {
            return (array)self::fromJsonStringToObject($this->toJsonString());
        } catch (JsonEncodeErrorException $e) {
            error_log($e);
            die();
        }
    }

    /**
     * Returns all data in string format
     * @return string
     */
    public function asString(): string
    {
        try {
            return $this->toJsonString();
        } catch (JsonEncodeErrorException $e) {
            error_log($e);
            die();
        }
    }
}