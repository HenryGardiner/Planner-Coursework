<?php
include_once('connection.php');
session_start(); 


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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My tasks</title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="pupilhome.php">Home</a>
    </div>
</nav>
</body>

<!-- creates the table using javascript-->
<table id="tasktable">
    <thead>
    <?php 
    
        echo("<th>Task Name</th> <th>Date due</th> <th>Time due</th> <th>Notes</th> <th>Tags</th> <th>Edit</th>");

    ?>
    </thead>
    
    <tbody>
        <?php
            
while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
    $tagarray=array();
    //checks if the task is associated with the user
    if ($row1['userid']==$_SESSION['suserid']){
        $taskid=$row1['tsktaskid'];
        while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC))
        {
            //fetches the tag info associated with the task
            if ($row3['tstgtaskid']==$taskid){
                $tagid=$row3['tstgtagid'];
                $stmt2->execute();
                
                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                {
                    //to do - this needs to get the tag tagname and colour associated
                    if ($row3['tstgtagid']==$row2['tgtagid']){
                        
                        //take the tagname associated with the tagid and add it as a key to tagarray and the colour associated with the tagid
                        $tagarray[$row2['tagname']]=$row2['colour'];     
                    }
                }
            }
        }
        //prints the data into the table
        echo("<tr><td>".$row1['taskname']."</td> <td>".$row1['date']."</td> <td>".$row1['time']."</td><td>".$row1['notes']."</td>
        <td>");
        $keys=array_keys($tagarray);
        //prints the tags associated with a task
        foreach($keys as $value){
            echo($value.", ");
        }
        echo("</td><td>");
        ?>
        <!-- adds an edit task button that will post the associated taskid-->
        <form action="edittask.php" method = "post">
            <input name='<?php echo($row1['tsktaskid']);?>' type='hidden' value="<?php echo($row1['tsktaskid']);?>">
            <input type="submit" value="Edit Task">
        </form><?php
        echo("</td></tr>");
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