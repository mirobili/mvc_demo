<?php

namespace App\Framework;

use PDO;
use PDOException;

class DB
{

    // static PDO $connection ;
    private static $pdo = null;

    public static function connect()
    {

        # Set db conn parameters in /config/config.php
       // $conn = DB_CONNECTION;

        $db_host = DB_CONNECTION['host'];
        $db_port = DB_CONNECTION['port'];
        $db_name = DB_CONNECTION['db'];
        $db_user = DB_CONNECTION['user'];
        $db_pass = DB_CONNECTION['pass'];
        $db_charset = DB_CONNECTION['charset']  ;

//            $user = 'root';
//            $pass = 'root';


        $dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=$db_charset";

        try {
            // Create a new PDO instance with error mode set to exceptions
            $pdo = new PDO($dsn, $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //  echo "Connected successfully!";
        } catch (PDOException $e) {
            // Catch any PDO exceptions and display the error message
            echo "Connection failed: " . $e->getMessage();
            throw $e;
        }

        self::$pdo = $pdo;
        return $pdo;

    }


    public static function exec($sql, array $params = [])
    {

        self::connect();

        $stmt = self::$pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $key = ":$key";
            $stmt->bindValue($key, $value);

        }


        try{
             $stmt->execute();
             if (!$stmt) {
                 echo "\nPDO::errorInfo():\n";
                 print_r(self::$pdo->errorInfo());
             }

            return $stmt;

        }catch (PDOException $e) {

            trace($e->getMessage());
            throw $e;
        }
    }

    public static function query($sql, array $params = [])
    {
        $stmt = self::exec($sql, $params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public static function getByID($sql, $id)
    {
        try{
            $stmt = self::exec($sql, $params = ['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }catch(PDOException $e){

            trace($e->getMessage());
            //throw $e;
        }
    }

    public static function insert($sql, array $params)
    {
        self::exec($sql, $params);
        return self::$pdo->lastInsertId();
    }

    public static function update(string $qry, array $params)
    {
        self::exec($qry, $params);
    }
}