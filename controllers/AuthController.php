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

    public function register()
    {
        $message = null;
        
        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password) || empty($name)){
                $message = 'Nama Lengkap, email dan password wajib diisi.';
            } else {
                $result = App::user()->create($name, $email, $password, 0);

                if (!$result){
                    $message = "Proses pendafataran gagal";
                } else {
                    $message = "Proses pendaftaran sukses";
                    redirect("/public/login.php");
                }
            }
        }

        require_once __DIR__ . '/../templates/register_view.php';
    }

    public function signOut()
    {
        session_destroy();

        redirect('/public/login.php');
    }
}