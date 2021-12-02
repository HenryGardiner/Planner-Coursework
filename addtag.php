<?php
session_start(); 
//echo($_SESSION['srole']);
echo($_SESSION['suser']);
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Add tag</title>
    
</head>

<body>

<h1>Add tag</h1>

<form action="addtagprocess.php" method = "post">
  Taskname:<input type="text" name="tagname" maxlength="25" minlength="3" required> <br>
  Colour:<input type="color" name="colour" required>
  <input type="submit" value="Add Tag">
</form>

</body>
</html>