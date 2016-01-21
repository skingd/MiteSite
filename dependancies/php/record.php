<?php

require "dbcon.php";

$hivename = $_POST['hivename'];
$observationdate = $_POST['observationdate'];
$duration = $_POST['duration'];
$mitecount = $_POST['mitecount'];

echo $hivename . " " . $observationdate;
//Establish database connection
$connection = writeDatabase();


$stmt = $connection->prepare("INSERT INTO samples(hive_id, collection_date, sample_period, num_mites)VALUES(:name, :observationdate, :duration, :mitecount)");
                      
                      $stmt->bindParam(':name', $hivename);
                      $stmt->bindParam(':observationdate', $observationdate);
                      $stmt->bindParam(':duration', $duration);
                      $stmt->bindParam(':mitecount', $mitecount);
        
        //Execute query
        $stmt->execute();
        

        //$stmt->close();
        //$connection->close();
        //if the query is successful, notify the user
           echo '<script> window.location.href = "success.php";</script>';


?>