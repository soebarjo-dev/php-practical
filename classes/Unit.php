<?php

class Unit extends Base
{
    public function getAll()
    {
        $query = "SELECT * FROM units ORDER BY name ASC";
        return $this->connection->query($query)->fetchAll();
    }

    public function create($name, $symbol)
    {
        $query = "INSERT INTO units (name, symbol, created_by) VALUES(:paramName, :paramSymbol, :paramCreatedBy)";
        $statement = $this->connection->prepare($query);

        return $statement->execute([
            'paramName' => $name, 
            'paramSymbol' => $symbol, 
            'paramCreatedBy' => $_SESSION['name']
        ]);
    }
}