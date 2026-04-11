<?php 
    define("HOST", "localhost"); 
    define("DBNAME", "forum-admin-panel");
    define("USER", "root");
    define("PASSWORD", "Huy_22092005");
     try{
        $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";", USER, PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(!$conn){
            echo "Connection failed";
        }
    }catch(PDOException $e){
        echo "Database connection failed".$e->getMessage();
    }
?>