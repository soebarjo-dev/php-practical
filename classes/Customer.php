<?php

class Customer extends Base
{
    public function getAll()
    {
        $query = "SELECT * FROM {$this->tableName()} WHERE deleted_at IS NULL ORDER BY name ASC";
        return $this->connection->query($query)->fetchAll();
    }

    public function create($name, $email, $createdBy)
    {
        $query = "
            INSERT INTO {$this->tableName()} (name, email, created_by) 
            VALUES(:paramName, :paramEmail, :paramCreatedBy)
        ";
        $statement = $this->connection->prepare($query);

        return $statement->execute([
            'paramName' => $name, 
            'paramEmail' => $email,
            'paramCreatedBy' => $createdBy
        ]);
    }

    public function update($id, $name, $email, $updatedBy)
    {
        $query = "
            UPDATE {$this->tableName()}
            SET name = :paramName, email = :paramEmail, updated_by = :paramUpdatedBy
            WHERE id = :paramID AND deleted_at IS NULL
        ";

        $statement = $this->connection->prepare($query);

        return $statement->execute([
            'paramName' => $name,
            'paramEmail' => $email,
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

    private function tableName(){
        return "customers";
    }
}