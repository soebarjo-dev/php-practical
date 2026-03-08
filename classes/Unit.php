<?php

class Unit extends Base
{
    public function getAll()
    {
        $query = "SELECT * FROM units ORDER BY name ASC";
        return $this->connection->query($query)->fetchAll();
    }

    public function create($name, $symbol, $createdBy)
    {
        $query = "INSERT INTO {$this->tableName()} (name, symbol, created_by) VALUES(:paramName, :paramSymbol, :paramCreatedBy)";
        $statement = $this->connection->prepare($query);

        return $statement->execute([
            'paramName' => $name, 
            'paramSymbol' => $symbol, 
            'paramCreatedBy' => $createdBy
        ]);
    }

    public function update($id, $name, $symbol)
    {
        $query = "
            UPDATE {$this->tableName()}
            SET name = :paramName, symbol = :paramSymbol
            WHERE id = :paramID
        ";

        $statement = $this->connection->prepare($query);

        return $statement->execute([
            'paramName' => $name,
            'paramSymbol' => $symbol,
            'paramID' => $id,
        ]);
    }

    public function delete($id)
    {
        $query = "
            DELETE FROM {$this->tableName()} WHERE id = :paramID
        ";

        $paramBind = [
            'paramID' => $id
        ];

        $statement = $this->connection->prepare($query);
        
        return $statement->execute($paramBind);
    }

    private function tableName(){
        return "units";
    }
}