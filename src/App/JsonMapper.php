<?php

namespace Bcchicr\Framework\App;

class JsonMapper
{
    private mixed $value;

    public function __construct(
        public string $path
    ) {
        $jsonString = file_get_contents($path);
        $this->value = json_decode($jsonString);
    }
    public function getValue()
    {
        return $this->value;
    }
    public function deleteRecord(int $id)
    {
        $this->value = array_slice($this->value, $id, 1);
        json_encode($this->value);
    }
}
