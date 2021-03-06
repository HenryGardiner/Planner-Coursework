<?php
$servername = 'localhost';
$username = 'root';
$password= '';

try {
 $conn = new PDO("mysql:host=$servername", $username, $password);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sql = "CREATE DATABASE IF NOT EXISTS courseworkplanner";
 $conn->exec($sql);
 //next 3 lines optional only needed really if you want to go on an do more SQL here!
 $sql = "USE courseworkplanner";
 $conn->exec($sql);
 echo "DB created successfully";
}
catch(PDOException $e)
{
 echo $sql . "<br>" . $e->getMessage();
}

//creates tbluser
$stmt = $conn->prepare("DROP TABLE IF EXISTS tbluser;
CREATE TABLE tbluser 
(username VARCHAR(25) NOT NULL,
userid INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
password VARCHAR(255) NOT NULL,
tutorgroup VARCHAR(5) NOT NULL,
role TINYINT(1),
workgoal INT(6))");
$stmt->execute();
$stmt->closeCursor();

//creates tbltask
$stmt = $conn->prepare("DROP TABLE IF EXISTS tbltask;
CREATE TABLE tbltask 
(taskid INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
taskname VARCHAR(25) NOT NULL,
date DATE NOT NULL,
time TIME,
userid INT (5),
notes TEXT(255))");
$stmt->execute();
$stmt ->closeCursor();
 
//creates tbltag
$stmt = $conn->prepare("DROP TABLE IF EXISTS tbltag;
CREATE TABLE tbltag
(tagid INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tagname VARCHAR(20),
colour VARCHAR(7),
userid INT(5))");
$stmt->execute();
$stmt->closeCursor();

//creates tbltasktag
$stmt = $conn->prepare("DROP TABLE IF EXISTS tbltasktag;
CREATE TABLE tbltasktag
(taskid INT(5),
tagid INT(5),
PRIMARY KEY(taskid,tagid))");
$stmt->execute();
$stmt->closeCursor();

$adminpassword = password_hash('%_admin%', PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO tbluser(username,userid,password,tutorgroup, role)VALUES 
    ('_admin', NULL,'$adminpassword','admin',0)");
$stmt->execute();
$stmt->closeCursor(); 

$stmt = $conn->prepare("INSERT INTO tbltag(tagid,tagname,colour,userid)VALUES 
    (NULL,'Important','ff0000',99999)");
$stmt->execute();
$stmt->closeCursor(); 

$stmt = $conn->prepare("INSERT INTO tbltag(tagid,tagname,colour,userid)VALUES 
    (NULL,'Complete','00ff00',99999)");
$stmt->execute();
$stmt->closeCursor(); 

?>
