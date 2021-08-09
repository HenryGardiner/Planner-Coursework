<?php

$adminpassword = password_hash('%_admin%', PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO tbluser(username,userid,password,tutorgroup,role)VALUES 
    ('_admin', NULL,'$adminpassword','admin',0)");
$stmt->execute();
$stmt->closeCursor(); 
echo("done")

?>