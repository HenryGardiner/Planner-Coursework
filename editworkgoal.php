<?php
session_start(); 
$uid=$_SESSION['suserid'];
include_once('connection.php');
$stmt = $conn->prepare("SELECT workgoal FROM tbluser WHERE userid=$uid");
$stmt->execute();
function convert($secs){
    global $h;
    global $m;
    global $s;
    $h=0;
    $m=0;
    $s=0;
    $h=floor($secs/3600);
    $secs=$secs-$h*3600;
    $m=floor($secs/60);
    $s=$secs-60*$m;
    //$f=":";
    //printf("%1\$'02s %4\$s %2\$'02s %4\$s %3\$'02s",$h,$m,$s,$f);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Task</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="pupilhome.php">Home</a>
    </div>
</nav>
<h1>Edit Work Goal</h1>
<?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    convert($row["workgoal"])
    ?>
    <form action="editworkgoalprocess.php" method = "post">
    New Work goal: - <br>
    Hours:<input name='hours' type='text' value="<?php echo($h) ?>"required><br>
    Minutes:<input name='minutes' type='text' value="<?php echo($m) ?>"required><br>
    Seconds<input name='seconds' type='text' value="<?php echo($s) ?>"required><br>
    <input type="submit" value="Update Work Goal">
    </form>

<?php
}
?>
</body>
</html> 