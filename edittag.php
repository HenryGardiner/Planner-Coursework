<?php
session_start(); 
$uid=$_SESSION['suserid'];
include_once('connection.php');
$stmt = $conn->prepare("SELECT tagname, colour, tagid FROM tbltag WHERE userid=$uid");
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
    <form action="edittagprocess.php" method = "post">
    Tagname:<input name='tagname' type='text' value="<?php echo($row['tagname']) ?>"required><br>
    Colour:<input name='colour' type='color' value="<?php echo($row['colour']) ?>"required><br>
    <input name='tagid' type='hidden' value="<?php echo($row['tagid']) ?>" ><br>
    <input type="submit" value="Update Tag">
    </form>
    <form action="viewtags.php" method="get">
    <input type="submit" value="Cancel">
    </form> 

<?php
}
?>
</body>
</html> 
