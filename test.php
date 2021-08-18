
<?php
include_once('connection.php');
session_start(); 


//echo($_SESSION['srole']);
//echo($_SESSION['suser']);
echo($_SESSION['suserid']);

//fetches data from table
$stmt1 = $conn->prepare("SELECT tsk.taskname, tsk.date, tsk.time, tsk.notes, tsk.userid, tsk.taskid as tsktaskid
FROM tbltask as tsk");
$stmt1->execute();



$stmt2 = $conn->prepare("SELECT tagid as tgtagid, tagname, colour
FROM tbltag");
$stmt2->execute();


$stmt3 = $conn->prepare("SELECT taskid as tstgtaskid, tagid as tstgtagid 
FROM tbltasktag
");
$stmt3->execute();

      
while ($row = $stmt1->fetch(PDO::FETCH_ASSOC))
{

    if ($row['userid']==$_SESSION['suserid']){

        //echo("<tr><td>".$row['taskname']."</td> <td>".$row['date']."</td> <td>".$row['time']."</td><td>".$row['notes']."</td>
        //<td>".
        $taskid=$row['taskid'];
        while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC))
        {
            if ($row3['tstgtaskid']==$taskid){
            print_r($row); 
        }   
        
        
        
        //+"</td><td>complete?</td></tr>");  
        
    }
}

/*while ($row = $stmt2->fetch(PDO::FETCH_ASSOC))
{
    print_r($row); 
}


while ($row = $stmt3->fetch(PDO::FETCH_ASSOC))
{
    print_r($row); 
}
*/
?