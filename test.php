
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

      
while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
    $z=0;
    $x=0;
    $tagarray=array();
    if ($row1['userid']==$_SESSION['suserid']){
        $taskid=$row1['tsktaskid'];
        while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC))
        {
            if ($row3['tstgtaskid']==$taskid){
                //$tagid=$row3['tstgtagid'];
                $stmt2->execute();
                
                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                {
                    if ($row3['tstgtagid']==$row2['tgtagid']){
                        //echo("tagid success");
                        array_push($tagarray, $row2['tagname']);
                        //$tagarray[$z]=($row2['tagname']);
                        $z+=1;   
                    }
                    
                }
            }
        }
        echo("<tr><td>".$row1['taskname']."</td> <td>".$row1['date']."</td> <td>".$row1['time']."</td><td>".$row1['notes']."</td>
        <td>"
        //create a string of the colours before the table begins
        "</td><td>complete?</td></tr>");  
        
    }    
}
?>

