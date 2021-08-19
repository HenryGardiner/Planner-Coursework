<?php 
header("Location: viewtags.php");
include_once("connection.php");

//print_r($_POST);

$id=$_POST['tagid'];
try{  
    $stmt = $conn->prepare("UPDATE tbltag SET tagname=:name, colour=:colour WHERE tagid=$id");
    $stmt->bindParam(':name', $_POST['tagname']);
    $stmt->bindParam(':colour', $_POST['colour']);
    $stmt->execute();
    $conn=null;
}
catch(PDOException $e)
{
	echo "error".$e->getMessage();
}
$conn=null;
?>
