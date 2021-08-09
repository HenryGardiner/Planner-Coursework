<?php 
session_start()
try{
    include_once("connection.php");
    //print_r($_POST);
	header('Location: addtask.php');
	
	
	array_map("htmlspecialchars", $_POST);
	$stmt = $conn->prepare("INSERT INTO tbltask(taskname,date,time,userid,taskid,notes)VALUES (:taskname, :date, :time, :userid,NULL,:notes)");
	$stmt->bindParam(':username', $_POST['taskname']);
	$stmt->bindParam(':date', $_POST['date']);
	$stmt->bindParam(':time', $_POST['time']);
	$stmt->bindParam(':userid', $_SESSION['suserid']);
	$stmt->bindParam(':notes', $_POST['notes']);
	$stmt->execute();
	

	}
catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}
$conn=null;

?>