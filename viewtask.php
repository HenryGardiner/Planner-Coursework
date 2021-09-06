<?php
include_once('connection.php');
session_start(); 


//echo($_SESSION['srole']);
//echo($_SESSION['suser']);
//echo($_SESSION['suserid']);

//fetches data from table
$stmt1 = $conn->prepare("SELECT tsk.taskname, tsk.date, tsk.time, tsk.notes, tsk.userid, tsk.taskid as tsktaskid
FROM tbltask as tsk");
$stmt1->execute();



$stmt2 = $conn->prepare("SELECT tagid as tgtagid, tagname, colour
FROM tbltag");



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
                        
                        //take the tagname associated with the tagid and 
                        
                        $tagarray[$row2['tagname']]=$row2['colour'];
                            
                    }
                    
                }
            
            }
        }
        //prints the data into the table
        echo("<tr><td>".$row1['taskname']."</td> <td>".$row1['date']."</td> <td>".$row1['time']."</td><td>".$row1['notes']."</td>
        <td>");
        $keys=array_keys($tagarray);
        foreach($keys as $value){
            echo($value." ");
        }
        echo("</td>
        <td>complete?</td></tr>");
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