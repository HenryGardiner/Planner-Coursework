<?php
include_once('connection.php');
session_start(); 

$uid=$_SESSION['suserid'];
$stmt = $conn->prepare("SELECT tagname, colour, tagid FROM tbltag WHERE userid=$uid OR userid=99999");
$stmt->execute(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My tasks</title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
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
</body>
<?php try{ ?>
    <table id="tagtable">
        <thead>
        <?php 
            echo("<th>Tag Name</th> <th>Colour</th><th>Edit</th>");
        ?>
        </thead>
        <tbody>
            <?php 
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                echo("<tr><td>".$row['tagname']."</td>
                <td style=background-color:".$row['colour'].">".$row['colour']."</td>
                <td>");
            ?>
            <!-- adds an edit tag button that will post the associated tagid-->
            <form action="edittag.php" method = "post">
                <input name='tagid' type='hidden' value="<?php echo($row['tagid']);?>">
                <input type="submit" value="Edit Tag">
            </form><?php
            echo("</td></tr>");  
                }
            ?>
        </tbody>
        </table>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#tagtable').DataTable();
    });
    </script>
<?php
}
catch(PDOException $e)
{
	echo "error".$e->getMessage();
}
$conn=null;
?>
</body>
</html> 