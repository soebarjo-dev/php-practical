<?php

class JSONStorage 
{
    private string $file;
    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function all(): array {
        $JSONFile = file_get_contents($this->file);
        $toArray = json_decode($JSONFile, true);

        return $toArray ?? [];
    }

    public function save(array $data): void {
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }
}