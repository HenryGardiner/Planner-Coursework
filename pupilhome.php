<?php
session_start(); 
//echo($_SESSION['srole']);
//echo($_SESSION['suser']);
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Pupil Home</title>
    
</head>
<body>

<h1>Pupil Home</h1>


<form action="addtask.php" method="get">
    <input type="submit" value="Add a task">
</form>
<br>

<form action="addtag.php" method="get">
    <input type="submit" value="Add a tag">
</form>
<br>

<form action="viewtasks.php" method="get">
    <input type="submit" value="View tasks">
</form>
<br>

</body>
</html>
