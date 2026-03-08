<?php

class Product extends Base
{
    public function getAll()
    {
        $query = "
            SELECT 
                product.id, 
                product.name productName, 
                product.price, 
                product.created_at,
                unit.id unitID, 
                unit.name unitName, 
                unit.symbol
            FROM {$this->tableName()} product
            JOIN {$this->tableName('units')} unit ON unit.id = product.unit_id
            WHERE product.deleted_at IS NULL
            ORDER BY product.name ASC
        ";
        return $this->connection->query($query)->fetchAll();
    }

    public function create($name, $unitID, $price, $createdBy)
    {
        $query = "
            INSERT INTO {$this->tableName()} (name, unit_id, price, created_by) 
            VALUES(:paramName, :paramUnitID, :paramPrice, :paramCreatedBy)
        ";
        $statement = $this->connection->prepare($query);

        return $statement->execute([
            'paramName' => $name, 
            'paramUnitID' => $unitID, 
            'paramPrice' => $price, 
            'paramCreatedBy' => $createdBy
        ]);
    }

    public function update($id, $name, $unitID, $price, $updatedBy)
    {
        $query = "
            UPDATE {$this->tableName()}
            SET name = :paramName, unit_id = :paramUnitID, price = :paramPrice, updated_by = :paramUpdatedBy
            WHERE id = :paramID AND deleted_at IS NULL
        ";

        $statement = $this->connection->prepare($query);

        return $statement->execute([
            'paramName' => $name,
            'paramUnitID' => $unitID,
            'paramPrice' => $price,
            'paramID' => $id,
            'paramUpdatedBy' => $updatedBy,
        ]);
    }

    public function delete($id, $deletedBy, $isSoftDelete=true)
    {
        $query = "
            UPDATE {$this->tableName()} SET deleted_at = now(), deleted_by = :paramDeletedBy
            WHERE id = :paramID AND deleted_at IS NULL
        ";

        $paramBind = [
            'paramDeletedBy' => $deletedBy,
            'paramID' => $id
        ];

        if (!$isSoftDelete){
            $query = "
                DELETE FROM {$this->tableName()} WHERE id = :paramID
            ";

            $paramBind = [
                'paramID' => $id
            ];
        }

        $statement = $this->connection->prepare($query);
        
        return $statement->execute($paramBind);
    }

    private function tableName($name='products'){
        return $name;
    }
}