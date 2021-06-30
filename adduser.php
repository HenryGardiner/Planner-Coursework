<!DOCTYPE html>
<html>
<head>
    
    <title>Add user</title>
    
</head>

<body>


<form action="addusertodatabase.php" method = "post">
  Username:<input type="text" name="username"><br>
  First name:<input type="text" name="forename"><br>
  Last name:<input type="text" name="surname"><br>
  Password:<input type="password" name="password"><br>
  <!--Creates a drop down list-->
  House:<select name="house">
		<option value="St. Anthony">St. Anthony</option>
		<option value="Crosby">Crosby</option>
		<option value="Fisher">Fisher</option>
		<option value="Grafton">Grafton</option>
		<option value="School">School</option>
		<option value="Sidney">Sidney</option>
		<option value="Bramston">Bramston</option>
		<option value="Laundimer">Laundimer</option>
		<option value="Laxton">Laxton</option>
		<option value="Wyatt">Wyatt</option>
		<option value="Kirkby">Kirkby</option>
		<option value="New">New</option>
		<option value="Sanderson">Sanderson</option>
		<option value="Dryden">Dryden</option>
		<option value="Berrystead">Berrystead</option>
		<option value="Scott">Scott</option>
		<option value="Laxton Junior">Laxton Junior</option>
		<option value="Staff">Staff</option>
	</select>
  <br>
  Year:<select name="year">
		<option value=1>First Form</option>
		<option value=2>Second Form</option>
		<option value=3>Third Form</option>
		<option value=4>Fourth Form</option>
		<option value=5>Fifth Form</option>
		<option value=6>Lower Sixth</option>
		<option value=7>Upper Sixth</option>
		<option value=0>Staff</option>
	</select>
  <br>
  <input type="radio" name="role" value="Pupil" > Pupil<br>
  <input type="radio" name="role" value="Staff"> Staff<br>
  <input type="radio" name="role" value="Admin"> Admin<br>
  <input type="submit" value="Add User">
</form>

<br>
<?php
include_once("connection.php");
$stmt = $conn->prepare("SELECT * FROM tbluserinfo");
$stmt->execute();
/*
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
  echo($row["forename"].' '.$row["surname"]." - ".$row["house"]."<br>");
}
*/
?>
</body>
</html>