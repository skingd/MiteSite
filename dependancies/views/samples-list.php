<!DOCTYPE html>

<html>

<head>

</head>

<body>

    <?php


echo "<table>";
 echo "<tr>";
echo    "<th>Hive ID</th>";
echo    "<th>Mites</th>"; 
echo    "<th>Sample Date</th>";
echo  "</tr>";

   while ($row = $sampleList->fetch(PDO::FETCH_ASSOC)){
       
       echo "<tr>";
       echo "<td>" . $row['hive_id'] . "</td>";
       echo "<td>" . $row['num_mites'] . "</td>";
       echo "<td>" . $row['collection_date'] . "</td>";
       echo "</tr>";
}
echo "</table>";
?>


</body>

</html>