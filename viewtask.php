<?php
include_once('connection.php');
session_start(); 


//echo($_SESSION['srole']);
//echo($_SESSION['suser']);
//echo($_SESSION['suserid']);

//fetches data from table
$stmt = $conn->prepare("SELECT tsk.taskname, tsk.date, tsk.time, tsk.notes, tsk.userid as userid, tsk.taskid as tsktaskid, tg.tagid as tgtagid, tg.tagname, tg.colour, tstg.taskid as tstgtaskid, tstg.tagid as tstgtagid 
FROM tbltask as tsk, tbltag as tg, tbltasktag as tstg");
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


<form  action="updateorders.php" method="post">
    <table id="tasktable">
        <thead>
        <?php 
        
            echo("<th>Task Name</th> <th>Date due</th> <th>Time due</th> <th>Notes</th> <th>Tags</th> <th>Complete?</th>");

        ?>
        </thead>
        
        <tbody>
            <?php
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                echo("a");
                if ($row['userid']==$_SESSION['suserid']){
                    echo("<tr><td>".$row['taskname']."</td> <td>".$row['date']."</td> <td>".$row['time']."</td><td>".$row['notes']."</td><td>tags</td><td>complete?</td></tr>");  
                }
            }
            ?>
        </tbody>
        
    </table>

    <input type="submit" value="Update Tasks">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#tasktable').DataTable();
    });
    </script>
</form>
</body>
</html> 