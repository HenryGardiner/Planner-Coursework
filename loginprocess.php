<?php
//removes any existing session and starts a new one
session_start(); 
session_destroy();
session_start();

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
    echo($hash);
    echo($attempt);
    if (password_verify($attempt,$hash)) { //this checks the hash of the inputted 
        //password against the hash of the actual password in the database
        echo("password correct");
        //sets session variables
        $_SESSION['srole']=$row['role']; 
        $_SESSION['suser']=$row['username'];
        $_SESSION['suserid']=$row['userid'];
        
        //sends user to respective home pages
        if($row['role']== 1){
            header('Location: pupilhome.php');
        }elseif($row['role']== 2){
            header('Location: tutorhome.php');
        }else{
            header('Location: adminhome.php');
        }
    }else{
        //echo('incorrect password ');
        header('Location: login.php');
    }
}
if(empty($row) and !isset($_SESSION['suser'])){
    //echo('incorrect username ');
    header('Location: login.php');
}







$conn=null; //closes connection to database to ensure security and prevent errors
?>