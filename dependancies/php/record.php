<?php

require "dbcon.php";

$hivename = $_POST['hivename'];
$observationdate = $_POST['observationdate'];
$duration = $_POST['duration'];
$mitecount = $_POST['mitecount'];

//Establish database connection
$conn = writeDatabase();


$stmt = $conn->prepare("INSERT INTO samples(hive_id, collection_date, sample_period, num_mites)VALUES(:name, :observationdate, :duration, :mitecount)");
                      
                      $stmt->bindParam(':name', $hivename);
                      $stmt->bindParam(':observationdate', $observationdate);
                      $stmt->bindParam(':duration', $duration);
                      $stmt->bindParam(':mitecount', $mitecount);
        
        //Execute query
        $stmt->execute();
        

        //$stmt->close();
        //$connection->close();
        //if the query is successful, notify the user
           echo $hivename . " Data Recorded Successfully!";

    $stmt = $conn->prepare("SELECT hive_id, num_mites, collection_date FROM samples WHERE hive_id = '{$hivename}'"); 
    $stmt->execute();

echo "<table>";
 echo "<tr>";
echo    "<th>Hive ID</th>";
echo    "<th>Mites</th>"; 
echo    "<th>Sample Date</th>";
echo  "</tr>";

   while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
       echo "<tr>";
       echo "<td>" . $row['hive_id'] . "</td>";
       echo "<td>" . $row['num_mites'] . "</td>";
       echo "<td>" . $row['collection_date'] . "</td>";
       echo "</tr>";
}
echo "</table>";


?>