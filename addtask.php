<!DOCTYPE html>
<html>
<head>
    
  <title>Add task</title>
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


<h1>Add task</h1>

<form action="addtaskprocess.php" method = "post">
  <!-- the user inputs the details of the task-->
  Taskname:<input type="text" name="taskname" maxlength="25" minlength="5" required> <br>
  Date:<input type="date" name="date" min=<?php echo date('Y-m-d');?> required><br>
  Time:<input type="time" name="time" min="00:01" max="23:59" required><br>
  Notes:<textarea type="text" name="notes" rows="4" cols="50"></textarea> <br>
  <!--here, the user chooses from a list of available tags, including their own and the default tags, but they can't mark it as complete immediatley-->
  Tags:
	<?php
  include_once('connection.php');
  session_start();
  $uid=$_SESSION['suserid'];
	$stmt = $conn->prepare("SELECT * FROM tbltag WHERE userid=$uid OR userid=99999 AND tagname!='Complete'");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo('<input type="checkbox" name='.$row["tagid"].'>'.$row["tagname"]);
	}
	?>
	
  <input type="submit" value="Add Task">
</form>

</body>
</html>
<!-- value='.$row["tagid"].'