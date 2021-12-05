<?php
session_start(); 

include_once('connection.php');
$taskid=reset($_POST);
$stmt = $conn->prepare("SELECT taskname, date, time, notes, taskid FROM tbltask WHERE taskid=$taskid");
$stmt->execute();
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
<h1>Edit Task</h1>
<?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{

    //print_r($row);
    ?>
    <form action="edittaskprocess.php" method = "post">
    Taskname:<input name='taskname' type='text' value="<?php echo($row['taskname']) ?>"required><br>
    Date:<input name='date' type='date' value="<?php echo($row['date']) ?>"required><br>
    Time:<input name='time' type='time' value="<?php echo($row['time']) ?>" required><br>
    Notes:<textarea name='notes' type='text'rows="4" cols="50" ><?php echo($row['notes']) ?></textarea> <br>
    <input name='taskid' type='hidden' value="<?php echo($row['taskid']) ?>" ><br>
    Tags:
    <br>
    <?php
    $uid=$_SESSION['suserid'];
	$stmt2 = $conn->prepare("SELECT * FROM tbltag WHERE userid=$uid OR userid=99999 AND tagname!='Complete'");
    $stmt2->execute();
    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
    {
        $stmt1 = $conn->prepare("SELECT tagid as tsktag, taskid as tsktask FROM tbltasktag WHERE taskid=$taskid");
        $stmt1->execute();
        $found=False;
        while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
        {
            if($row1["tsktag"]=$row2["tagid"]){
            $found=True;
            }else{}
        }
        
        if ($found=True){
            echo('<input type="checkbox" name="'.$row2["tagname"].'" value="'.$row2["tagname"].'"checked><label for="'.$row2["tagname"].'">'.$row2["tagname"].'</label><br>');
        }else{
            echo('<input type="checkbox" name="'.$row2["tagname"].'" value="'.$row2["tagname"].'"><label for="'.$row2["tagname"].'">'.$row2["tagname"].'</label><br>');
        }
    }
}?>
    
<input type="submit" value="Update Task">
</form>

<form action="viewtask.php" method="get">
<input type="submit" value="Cancel">
</form> 
    



</body>
</html> 
