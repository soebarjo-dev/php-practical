<?php 
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

    spl_autoload_register(function ($className){
        $directories = [
            __DIR__ . '/../config/',
            __DIR__ . '/../classes/',
            __DIR__ . '/../controllers/',
        ];

        foreach ($directories as $dir){
            $file = $dir . $className . '.php';
            if (file_exists($file)){
                require_once $file;
                return;
            }
        }
    });

    require_once __DIR__ . '/../helpers/helpers.php';
    require_once __DIR__ . '/../config/Env.php';
    Env::load();
    require_once __DIR__ . '/../config/General.php';