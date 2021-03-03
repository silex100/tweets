<?php 

namespace App\Database;

trait Db
{
    protected static $connection = null; 

    public static function connection()
    {
        global $param;

        $db = new DbConnection(
            new DbConfiguration(
                $param['driver'], $param['host'], $param['port'], 
                $param['username'], $param['password'], 
                $param['database'], $param['charset']
            )
        );
        try{
            self::$connection = new \PDO(
                $db->dsn(), $db->username(), 
                $db->password()
            );
        }catch(\PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        return self::$connection;
    }
}

