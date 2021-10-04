
<?php
include_once('connection.php');
session_start(); 


//echo($_SESSION['srole']);
//echo($_SESSION['suser']);
echo($_SESSION['suserid']);


$uid=$_SESSION['suserid'];
$stmt = $conn->prepare("SELECT * FROM tbltag WHERE userid=$uid ");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
      echo("<option value=".$row['tagname"'].'</option>');
  }
?>