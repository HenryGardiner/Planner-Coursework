<!DOCTYPE html>
<html>
<head>
    
    <title>Add user</title>
    
</head>

<body>


<form action="adduserprocess.php" method = "post">
  Username:<input type="text" name="username" maxlength="25" minlength="6"> <br>
  Password:<input type="password" name="password" maxlength="25" minlength="8"> <br>
  Tutorgroup:<input type="text" name="tutorgroup" maxlength="5" minlength="3"><br>
  <input type="radio" name="role" value="Pupil" > Pupil<br>
  <input type="radio" name="role" value="Staff"> Staff<br>
  <input type="radio" name="role" value="Admin"> Admin<br>
  <input type="submit" value="Add User">
</form>

<br>
<?php
include_once("connection.php");
$stmt = $conn->prepare("SELECT * FROM tbluser");
$stmt->execute();
?>
</body>
</html>