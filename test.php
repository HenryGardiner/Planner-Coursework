<?php
session_start();#
include_once("connection.php");
//echo($_SESSION['srole']);
function convert($secs){
    $h=0;
    $m=0;
    $s=0;
    $h=floor($secs/3600);
    $secs=$secs-$h*3600;
    $m=floor($secs/60);
    $s=$secs-60*$m;
    $f=":";
    printf("%1\$'02s %4\$s %2\$'02s %4\$s %3\$'02s",$h,$m,$s,$f);
}
?>  
<!DOCTYPE html>
<html lang="en">
<head>
<title>test</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <?php
    $uid=$_SESSION['suserid'];
    $stmt = $conn->prepare("SELECT workgoal FROM tbluser WHERE userid=$uid");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $workgoal=$row["workgoal"];
    }
    //echo($workgoal);
    if ($_SESSION['srole']==1){
      ?>
    <div class="navbar-header">
      <a class="navbar-brand" href="pupilhome.php">Home</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Work goal: <?php echo(convert($workgoal)) ?> </a></li>
    </ul>
    <ul class="nav navbar-nav">
      <li class="active"><a href="editworkgoal.php">Edit Work goal</a></li>
    </ul>
    <?php
    }else{
      ?>
    <div class="navbar-header">
      <a class="navbar-brand" href="tutorhome.php">Home</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Work goal:</a></li>
    </ul>
    <?php
    }
    ?>
  </div>
</nav>
</body>
</html>