<?php
session_start(); 
$uid=$_SESSION['suserid'];
include_once('connection.php');
$taskid=reset($_POST);
$stmt = $conn->prepare("SELECT taskname, date, time, notes, taskid FROM tbltask WHERE taskid=$taskid");
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<body>
<?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{

    //print_r($row);
    ?>
    <form action="edittaskprocess.php" method = "post">
    Taskname:<input name='taskname' type='text' value="<?php echo($row['taskname']) ?>"required><br>
    Date:<input name='date' type='date' value="<?php echo($row['date']) ?>"required><br>
    Time:<input name='time' type='time' value="<?php echo($row['time']) ?>" required><br>
    Notes:<textarea name='notes' type='text'rows="4" cols="50" required><?php echo($row['notes']) ?></textarea> <br>
    <input name='taskid' type='hidden' value="<?php echo($row['taskid']) ?>" ><br>
    <?php
    $uid=$_SESSION['suserid'];
	$stmt2 = $conn->prepare("SELECT * FROM tbltag WHERE userid=$uid OR userid=99999 AND tagname!='Complete'");
	$stmt2->execute();
	while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC))
	{
        echo("hek");
		echo('<input type="checkbox" value='.$row["tagname"].'>'.$row["tagname"]);
        $tskid=$row["taskid"];
        $stmt1 = $conn->prepare("SELECT * FROM tbltasktag WHERE taskid=$tskid");
	    $stmt1->execute();
        while ($row1 = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            if ($row1["tagid"]==$row["tagid"]){
                echo(".'checked'");
            }
        }
	}
	?>
    <input type="submit" value="Update Task">
    </form>
    
    <form action="viewtask.php" method="get">
    <input type="submit" value="Cancel">
    </form> 

<?php
}
?>
</body>
</html> 
