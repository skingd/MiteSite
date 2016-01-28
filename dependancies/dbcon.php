<?php


function readDatabase(){
    
    $servername = "localhost";

    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=tps_bee_database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn; 
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }
}
?>
