<?php

class Product extends Base
{
    public function getAll()
    {
        $query = "
            SELECT 
                products.name, 
                products.price, 
                products.created_at,
                units.name, 
                units.symbol
            FROM products 
            JOIN units ON units.id = products.unit_id
            WHERE products.deleted_at IS NULL
            ORDER BY products.name ASC
        ";
        return $this->connection->query($query)->fetchAll();
    }

    public function create($name, $unitID, $price)
    {
        $query = "
            INSERT INTO products (name, unit_id, price, created_by) 
            VALUES(:paramName, :paramUnitID, :paramPrice, :paramCreatedBy)
        ";
        $statement = $this->connection->prepare($query);

        return $statement->execute([
            'paramName' => $name, 
            'paramUnitID' => $unitID, 
            'paramPrice' => $price, 
            'paramCreatedBy' => $_SESSION['name']
        ]);
    }
}