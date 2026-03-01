<?php 

function redirect($url){
    header("Location: $url");
    exit;
}

function current_user($field=null){
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

    $user = $_SESSION['user'] ?? null;

    if ($field !== null){
        return $user[$field] ?? null;
    }

    return $user;
}

function auth_guard(){
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

    if (!isset($_SESSION['user'])){
        redirect('/public/login.php');
    }
}