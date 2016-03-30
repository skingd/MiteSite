<html>
<head></head>
<body>

<a href="dependancies/php/download.php">Download Excel File</a>
<?php

require "dependancies/php/dbcon.php";

//Create db connection
$conn = writeDatabase();

$stmt = $conn->prepare("SELECT hive_id, num_mites, collection_date FROM samples"); 
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


$db = null;
?>
   


    </body>
</html>