<?php

class MahasiswaService
{
    private JSONStorage $jsonStorage;

    public function __construct($storage){
        $this->jsonStorage = $storage;
    }

    public function getAll(): array {
        return $this->jsonStorage->all();
    }

    public function add(array $data): void {
        $all = $this->jsonStorage->all();
        $all[] = $data;
        $this->jsonStorage->save($all);
    }

    public function update(int $id, array $data): void {
        $all = $this->jsonStorage->all();
        $all[$id] = $data;
        $this->jsonStorage->save($all);
    }

    public function delete(int $id){
        $all = $this->jsonStorage->all();
        unset($all[$id]);
        $this->jsonStorage->save(array_values($all));
    }
}