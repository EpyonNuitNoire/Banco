<?php

    function getBanco() {
        $host = 'localhost';
        $dbname = 'Banco';
        $nombre = 'root';
        $contraseña = '';
    
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $nombre, $contraseña);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error connecting to the database: " . $e->getMessage());
        }
   }


?>