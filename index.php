<!DOCTYPE html>

<html>
    <head>
        
    </head>
    <body>
        <form action="record.php" method="post">
           Hive Name <br>
            <input type="text" name="hivename"><br><br>
             Observation Date <br>
             <input type="date" name="observationdate"><br><br>
            Duration of the Observation (in Days) <br>
             <input type="number" name="duration"><br><br>
             Mite Count <br>
             <input type="number" name="mitecount"><br><br>
             <input type="submit" value="Enter Data">
        </form>
        <a href="dependancies/admin.php">View All</a> &nbsp;
        <a href="dependancies/php/download.php">Download Excel File</a>
    </body>
    
</html>