<?php
session_start(); 
//echo($_SESSION['srole']);
//echo($_SESSION['suser']);
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Tutor Home</title>
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
      <a class="navbar-brand" href="tutorhome.php">Home</a>
    </div>
</nav>
<h1>Tutor Home</h1>

<!-- button linking to a table of tutees-->
<form action="viewtutees.php" method="get">
    <input type="submit" value="View tutees">
</form>
<br>

</body>
</html>
