<?php
session_start(); 
$uid=$_SESSION['suserid'];
include_once('connection.php');
//print_r($_POST);
$tagid=$_POST['tagid'];
$stmt = $conn->prepare("SELECT tagname, colour, tagid FROM tbltag WHERE tagid=$tagid");
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit tag</title>
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
<h1>Edit Tag</h1>
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
