<?php 
session_start();
try{
    include_once("connection.php");
    print_r($_POST);
	header('Location: pupilhome.php');
	//counts the length of array and extracts the tags
	$length=count($_POST);
	$keys=array_keys($_POST);
	$tags=array();
	$z=0;
	foreach($keys as $id):{
		if ($_POST[$id]=="on"){
			$tags[$z]=$id;
			$z++;
		}else{
			echo("");
		}
	}
	endforeach;
	
	//writes the task details to the database
	array_map("htmlspecialchars", $_POST);
	$stmt = $conn->prepare("INSERT INTO tbltask(taskname,date,time,userid,taskid,notes)VALUES (:taskname, :date, :time, :userid,NULL,:notes)");
	$stmt->bindParam(':taskname', $_POST['taskname']);
	$stmt->bindParam(':date', $_POST['date']);
	$stmt->bindParam(':time', $_POST['time']);
	$stmt->bindParam(':userid', $_SESSION['suserid']);
	$stmt->bindParam(':notes', $_POST['notes']);
	$stmt->execute();
	//gets the id of the newly inserted task
	$last_id=$conn->lastInsertId();
	
	//adds each tag associated with the task to tbltasktag 
	foreach($tags as $tag):{
		echo("last_id= ".$last_id);
		echo("tag= ".$tag);
		array_map("htmlspecialchars", $tags);
		$stmt1 = $conn->prepare("INSERT INTO tbltasktag (taskid,tagid) VALUES (:taskid, :tagid)");
		$stmt1->bindParam(':taskid', $last_id);
		$stmt1->bindParam(':tagid', $tag);
		$stmt1->execute();
	}
	endforeach;

}
catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}
$conn=null;
?>