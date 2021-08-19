<?php 
header("Location: viewtask.php");
include_once("connection.php");

//print_r($_POST);

$id=$_POST['taskid'];
try{  
    $stmt = $conn->prepare("UPDATE tbltask SET taskname=:name, date=:date, time=:time, notes=:notes WHERE taskid=$id");
    $stmt->bindParam(':name', $_POST['taskname']);
    $stmt->bindParam(':date', $_POST['date']);       
    $stmt->bindParam(':time', $_POST['time']);   
    $stmt->bindParam(':notes', $_POST['notes']);   
    $stmt->execute();
    $conn=null;
}
catch(PDOException $e)
{
	echo "error".$e->getMessage();
}
$conn=null;
?>
