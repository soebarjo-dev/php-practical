<?php 

class Database
{
    private static $connection = null; 
    private static $env = [];

    public static function getConnection()
    {
        if (self::$connection === null){
            self::loadEnv();
            self::connect();
        }

        return self::$connection;
    }

    public static function connect()
    {
        try {
            $callEnv = self::$env;
            $dsn = "{$callEnv['DB_TYPE']}:host={$callEnv['DB_HOST']};port={$callEnv['DB_PORT']};dbname={$callEnv['DB_NAME']}";
            self::$connection = new PDO($dsn);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return self::$connection;
        } catch(PDOException $e){
            error_log($e->getMessage());
            die('Database connection failed ' . $e->getMessage());            
        }
    }

    private static function loadEnv()
    {
        try {
            $pathToEnv = dirname(__DIR__) . DIRECTORY_SEPARATOR . ".env";
            if (!file_exists($pathToEnv)){
                throw new Exception(".env file not found");
            }

            $envLines = file($pathToEnv, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            foreach($envLines as $envLine){
                $envLine = trim($envLine);

                if ($envLine === "" OR str_starts_with($envLine, "#")){
                    continue;
                }

                if (!str_contains($envLine, "=")){
                    throw new Exception("Invalid .env format" . $envLine);
                }

                list($key, $value) = explode("=", $envLine, 2);
                $key = trim($key);
                $value = trim ($value);
                self::$env[$key] = $value;
            }

            $required = ["DB_HOST", "DB_PORT", "DB_USERNAME", "DB_PASSWORD", "DB_TYPE", "DB_NAME"];
            foreach ($required as $key){
                if (!isset(self::$env[$key])){
                    throw new Exception("Missing required env variable" . $key);
                }
            }
        } catch(Exception $e){
            die("ENV Error :". $e->getMessage());
        }
    }
}