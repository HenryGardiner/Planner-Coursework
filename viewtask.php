<?php
include_once('connection.php');
session_start(); 


//echo($_SESSION['srole']);
echo($_SESSION['suser']);

//fetches data from table
$stmt = $conn->prepare("SELECT taskname, date, time, notes, userid FROM tbltask");
$stmt->execute(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My tasks</title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
</head>

<table id="tasktable">
    <thead>
    <?php 
    
        echo("<th>Task Name</th> <th>Date due</th> <th>Time due</th> <th>Notes</th>");

    ?>
    </thead>
    
    <tbody>
        <?php

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            if ($row['userid']==$_SESSION['suserid']){
                echo("<tr><td>".$row['taskname']."</td> <td>".$row['date']."</td> <td>".$row['time']."</td><td>".$row['notes']."</td></tr>");
            }
            
        }
        ?>
    </tbody>
    
</table>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#tasktable').DataTable();
});
</script>

</body>
</html> 