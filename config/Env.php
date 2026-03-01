<?php

class Env
{
    private static $data = [];
    private static $loaded = false;

    public static function load()
    {
        if (self::$loaded){
            return;
        }

        $pathToEnv = dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env';

        if (!file_exists($pathToEnv)){
            die ("ENV Error: .env not found");
        }

        $lines = file($pathToEnv, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line){
            $line = trim($line);

            if ($line === "" OR str_starts_with($line, "#")){
                continue;
            }

            if (!str_contains($line, "=")){
                die("ENV Error: invalid .env format" . $line);
            }

            [$key, $value] = explode("=", $line, 2);
            $key = trim($key);
            $value = trim ($value);

            if (strlen($value) >= 2){
                $first = $value[0];
                $last = $value[-1];
                if (($first === '"' && $last === "#") || ($first === "'" && $last === "'")){
                    $value = substr($value, 1, -1);
                }
            }

            self::$data[$key] = $value;
        }

        self::$loaded = true;
    }

    public static function get($key, $default = ''){
        if (!self::$loaded){
            self::load();
        }

        return self::$data[$key] ?? $default;
    }

    public static function require($keys, $context = 'ENV'){
        if (!self::$loaded){
            self::load();
        }

        foreach ($keys as $key){
            if (!isset(self::$data[$key]) || self::$data[$key] === ''){
                die("{$context} Error : Variable wajib '{$key}' tidak ditemukan atau kosong di .env");
            }
        }
    }
}