<?php

print_r($_POST); //prints the posted values - useful for debugging

include_once ("connection.php"); //connects to the database

array_map("htmlspecialchars", $_POST);
$stmt = $conn->prepare("SELECT * FROM tbluser WHERE username =:username ;" );
$stmt->bindParam(':username', $_POST['username']);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{ 
    $hash=$row['password'];
    $attempt=$_POST['password'];
    if (password_verify($attempt,$hash)) { //this checks the hash of the inputted 
        //password against the hash of the actual password in the database

        echo('login successful');
    }else{
        echo('incorrect password ');
        
    }
}





$conn=null; //closes connection to database to ensure security and prevent errors
?>