<?php

class User extends Base
{
    public function getAll()
    {
        $query = "SELECT * FROM users ORDER BY name ASC";
        return $this->connection->query($query)->fetchAll();
    }

    public function create($name, $email, $password, $createdBy)
    {
        $query = "
            INSERT INTO users (name, email, password, created_by) 
            VALUES(:paramName, :paramEmail, :paramPassword, :paramCreatedBy)
        ";
        $statement = $this->connection->prepare($query);

        return $statement->execute([
            'paramName' => $name, 
            'paramEmail' => $email, 
            'paramPassword' => password_hash($password, PASSWORD_BCRYPT), 
            'paramCreatedBy' => $createdBy
        ]);
    }

    public function update($id, $name, $email, $updatedBy)
    {
        $query = "
            UPDATE users
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
}