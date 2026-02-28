<?php

class Auth extends Base
{
    public function signIn($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = :paramEmail AND deleted_at IS NULL LIMIT 1";
        $statement = $this->connection->prepare($query);
        $statement->execute(['paramEmail' => $email]);
        
        $user = $statement->fetch();

        if ($user && password_verify($password, $user['password'])){
            $_SESSION['user'] = $user;
            return true;
        }

        return false;
    }

    public function signOut()
    {
        session_destroy();
    }
}