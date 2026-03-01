<?php 

class Database
{
    private static $connection = null; 

    public static function getConnection()
    {
        if (self::$connection === null){
            self::connect();
        }

        return self::$connection;
    }

    public static function connect()
    {
        try {
            Env::require(['DB_HOST','DB_PORT','DB_USERNAME', 'DB_PASSWORD', 'DB_TYPE', 'DB_NAME'], 'Database');
            
            $dsn = Env::get('DB_TYPE')
                . ':host=' . Env::get('DB_HOST')
                . ';port=' . Env::get('DB_PORT')
                . ';dbname=' . Env::get('DB_NAME');

            self::$connection = new PDO($dsn);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return self::$connection;
        } catch(PDOException $e){
            error_log($e->getMessage());
            die('Database connection failed ' . $e->getMessage());            
        }
    }
}