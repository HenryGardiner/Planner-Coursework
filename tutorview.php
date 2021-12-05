<?php
include_once('connection.php');
session_start(); 
//print_r($_POST);
$tuteeid=$_POST['tutuserid'];
//fetches task data from tbltask
$stmt1 = $conn->prepare("SELECT tsk.taskname, tsk.date, tsk.time, tsk.notes, tsk.userid, tsk.taskid as tsktaskid
FROM tbltask as tsk");
$stmt1->execute();
//fetches data from tbltag
$stmt2 = $conn->prepare("SELECT tagid as tgtagid, tagname, colour
FROM tbltag");
//fetches data from tbltasktag
$stmt3 = $conn->prepare("SELECT taskid as tstgtaskid, tagid as tstgtagid 
FROM tbltasktag
");
$stmt3->execute();
//fetches data from tbluser
$stmt4 = $conn->prepare("SELECT username FROM tbluser WHERE userid=$tuteeid
");
$stmt4->execute();
//sets $tuteename to be the username associated with the posted userid. As we are only viewing one tutee at a time, we can set it to be a single variable rather than an array
while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC))
{
    $tuteename=$row4['username'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tutee Task</title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<!-- creates the table using javascript-->
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="tutorhome.php">Home</a>
    </div>
</nav>
<h1>
    Tasks: <?php echo($tuteename) ?>
</h1>
<table id="tuteetasktable">
    <thead>
    <?php 
        echo("<th>Task Name</th> <th>Date due</th> <th>Time due</th>");
    ?>
    </thead>
    <tbody>
        <?php 
while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
    $tagarray=array();
    //checks if the task is associated with the user
    if ($row1['userid']==$tuteeid){
        $taskid=$row1['tsktaskid'];
        while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC))
        {
            //fetches the tag info associated with the task
            if ($row3['tstgtaskid']==$taskid){
                $tagid=$row3['tstgtagid'];
                $stmt2->execute();
                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                {
                    //i left this blank as i know that to remove tasks from the planner i need to check if it has been tagged with complete
                }
            }
        }
        //prints the data into the table
        echo("<tr><td>".$row1['taskname']."</td> <td>".$row1['date']."</td> <td>".$row1['time']."</td></tr>");
    }    
}
        ?>
        </tbody>
        
</table>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#tuteetasktable').DataTable();
    });
    </script>
</body>
</html> 