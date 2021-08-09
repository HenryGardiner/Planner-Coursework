<?php 
try{
    include_once("connection.php");
    //print_r($_POST);
	header('Location: adduser.php');
	switch($_POST["role"]){
		case "Pupil":
			$role=1;
			break;
		case "Staff":
			$role=2;
			break;
		case "Admin":
			$role=0;
			break;
	}
    $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
	array_map("htmlspecialchars", $_POST);
	$stmt = $conn->prepare("INSERT INTO tbluser(username,userid,password,tutorgroup,role)VALUES (:username, NULL,:password,:tutorgroup,:role)");
	$stmt->bindParam(':username', $_POST['username']);
	$stmt->bindParam(':password', $hash);
	$stmt->bindParam(':tutorgroup', $_POST['tutorgroup']);
	$stmt->bindParam(':role', $role);
	$stmt->execute();
	

	}
catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}
$conn=null;

?>