<?php

class Database 
{
    private $connection;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "perpustakaan";

    public function connect()
    {
        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->username, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this->connection;
    }
}