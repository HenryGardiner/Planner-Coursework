<?php
session_start(); 
//echo($_SESSION['srole']);
//echo($_SESSION['suser']);
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Tutor Home</title>
    
</head>
<body>

<h1>Tutor Home</h1>

<!-- button linking to a table of tutees-->
<form action="viewtutees.php" method="get">
    <input type="submit" value="View tutees">
</form>
<br>

</body>
</html>
