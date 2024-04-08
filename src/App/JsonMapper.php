<?php

namespace Bcchicr\Framework\App;

class JsonMapper
{
    private array $value = [];

    public function __construct(
        private string $path
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
        array_splice($this->value, $id, 1);
        $this->processChanges();
    }
    public function addRecord(object $record)
    {
        $this->value[] = $record;
        $this->processChanges();
    }
    private function processChanges(): void
    {
        file_put_contents(
            $this->path,
            json_encode($this->value)
        );
    }
}
