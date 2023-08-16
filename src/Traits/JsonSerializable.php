<?php


namespace Mkoders\Auth\Traits;


trait JsonSerializable
{
    /**
     * Get object's data as json string
     * @return string
     * @throws JsonEncodeErrorException
     */
    public function toJsonString(): string
    {
        $encode = json_encode($this);

        if (!$encode) {
            throw new JsonEncodeErrorException();
        }

        return $encode;
    }

    /**
     * Instantiate an object based the string data
     * @param string $data
     * @return mixed
     */
    public static function fromJsonStringToObject(string $data): mixed
    {
        return json_decode($data);
    }
}