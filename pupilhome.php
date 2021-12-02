<?php
session_start();
include_once("connection.php");
//echo($_SESSION['srole']);
//echo($_SESSION['suser']);
function convert($secs){ //converts seconds to hh:mm:ss
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
<html>
<head>
<title>Pupil Home</title>
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
    $stmt = $conn->prepare("SELECT workgoal FROM tbluser WHERE userid=$uid"); //get the workgoal of the user
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $workgoal=$row["workgoal"];//write the work goal to a variable to make it easier to process
    }
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
</nav>

<h1>Pupil Home</h1>


<form action="addtask.php" method="get">
    <input type="submit" value="Add a task">
</form>
<br>

<form action="addtag.php" method="get">
    <input type="submit" value="Add a tag">
</form>
<br>

<form action="viewtask.php" method="get">
    <input type="submit" value="View tasks">
</form>
<br>

<form action="viewtags.php" method="get">
    <input type="submit" value="View tags">
</form>
<br>

</body>
</html>