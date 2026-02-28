<?php

class Base
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }
}