<?php

class AuthController
{
    public function signIn()
    {
        if (isset($_SESSION['user'])){
            redirect('/public/?page=dashboard');
        }

        $error = null;
        
        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)){
                $error = 'Email dan password wajib diisi.';
            } else {
                $result = App::auth()->signIn($email, $password);

                if (!$result){
                    $error = "Email atau password salah";
                } else {
                    redirect("/public/?page=dashboard");
                }
            }
        }

        require_once __DIR__ . '/../templates/login_view.php';
    }
}