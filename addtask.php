<!DOCTYPE html>
<html>
<head>
    
    <title>Add task</title>
    
</head>

<body>

<h1>Add task</h1>

<form action="addtaskprocess.php" method = "post">
  Taskname:<input type="text" name="taskname" maxlength="25" minlength="5" required> <br>
  Date:<input type="date" id="date" name="date" min=<?php echo date('Y-m-d');?> required><br>
  Time:<input type="time" name="time" min="00:01" max="23:59" required><br>
  Notes:<textarea id="notes" name="notes" rows="4" cols="50"></textarea> <br>
  <input type="submit" value="Add Task">
</form>

<br>
<?php
include_once("connection.php");
$stmt = $conn->prepare("SELECT * FROM tbluser");
$stmt->execute();
?>
</body>
</html>
