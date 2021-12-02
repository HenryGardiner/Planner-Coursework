<?php 
session_start();
try{
    include_once("connection.php");
    //print_r($_POST);
	header('Location: addtag.php');
	
	
	array_map("htmlspecialchars", $_POST);
	$stmt = $conn->prepare("INSERT INTO tbltag(tagname,tagid,colour,userid)VALUES (:tagname, NULL, :colour,:userid)");
	$stmt->bindParam(':tagname', $_POST['tagname']);
	$stmt->bindParam(':colour', $_POST['colour']);
	$stmt->bindParam(':userid', $_SESSION['suserid']);
	$stmt->execute();
	

	}
catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}
$conn=null;
?>