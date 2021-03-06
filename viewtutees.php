<?php
include_once('connection.php');
session_start(); 

$uid=$_SESSION['suserid'];
$tgroup=$_SESSION['stgroup'];


$stmt = $conn->prepare("SELECT username,userid FROM tbluser WHERE tutorgroup='$tgroup' AND role=1");
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
</body>
<?php try{ ?>
    <table id="tagtable">
        <thead>
        <?php 
            echo("<th>Username</th><th>View</th>");
        ?>
        </thead>
        <tbody>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                echo("<tr><td>".$row['username']."</td><td>");
                ?>
                <!-- adds an edit task button that will post the associated taskid-->
                <form action="tutorview.php" method = "post">
                    <input name='tutuserid' type='hidden' value="<?php echo($row['userid']);?>">
                    <input type="submit" value="View tutee">
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