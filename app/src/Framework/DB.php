<?php

namespace App\Framework;

use PDO;
use PDOException;

class DB{

       // static PDO $connection ;
        private static $pdo= null;
        public static function connect(){

            $host = '192.168.0.114';
            $host = 'localhost';
            $host = 'db';
            $db = 'mvc_demo';
            $user = 'mvc_demo';
            $pass = 'mvc_demo2024';
            $charset = 'utf8mb4';

//
//            $user = 'root';
//            $pass = 'root';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

            try {
                // Create a new PDO instance with error mode set to exceptions
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //  echo "Connected successfully!";
            } catch (PDOException $e) {
                // Catch any PDO exceptions and display the error message
                echo "Connection failed: " . $e->getMessage();
                throw $e;
            }

            self::$pdo= $pdo;
            return $pdo;

        }




        public static function exec($sql, array $params = []){

//            trace($sql);
//            trace($params);

            self::connect();

            $stmt = self::$pdo->prepare($sql);

            foreach($params as $key => $value) {
                $key = ":$key";
                $stmt->bindValue($key, $value);

            }


          //  $stmt->debugDumpParams();
            // Execute the statement and check for errors
            if (!$stmt->execute()) {
                echo "\nPDO::errorInfo():\n";
                print_r($stmt->errorInfo()); // Use stmt's errorInfo to get specific error details
                return false; // Return false on failure
            }

            if (!$stmt) {
                echo "\nPDO::errorInfo():\n";
                print_r(self::$pdo->errorInfo());
            }

            return $stmt;
        }

        public static function query($sql, array $params = []){
            $stmt= self::exec($sql, $params);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }

        public static function getByID($sql, $id){
            $stmt= self::exec($sql, $params=['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

    public static function insert($sql, array $params)
    {
        self::exec($sql, $params );
        return self::$pdo->lastInsertId();
    }

    public static function update(string $qry, array $params, $id)
    {
         self::exec($qry, $params );
    }
}