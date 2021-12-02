<?php 
header("Location: pupilhome.php");
include_once("connection.php");
session_start();

//print_r($_POST);

try{  
    $total = $_POST["seconds"]+$_POST["minutes"]*60+$_POST["hours"]*3600;
    //echo$total;
    $uid=$_SESSION['suserid'];
    $stmt = $conn->prepare("UPDATE tbluser SET workgoal=:workgoal WHERE userid=$uid");
    $stmt->bindParam(':workgoal', $total);
    $stmt->execute();
    $conn=null;
}
catch(PDOException $e)
{
	echo "error".$e->getMessage();
}
$conn=null;
?>
