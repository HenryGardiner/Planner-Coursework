
<?php
include_once('connection.php');


session_start();
//print_r($_POST);

//header('Location: addtask.php');
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

?>