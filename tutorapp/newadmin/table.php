<?php
@ob_start();
include_once 'dbConnection.php';
$qry="CREATE TABLE `initialass` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`title` VARCHAR( 255 ) NOT NULL ,
`student` VARCHAR( 100 ) NOT NULL
)";
mysqli_query($qry);

$qry="CREATE TABLE `diagnostic` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`title` VARCHAR( 255 ) NOT NULL ,
`student` VARCHAR( 100 ) NOT NULL
)";
mysqli_query($qry);


$qry="CREATE TABLE `resources` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`title` VARCHAR( 255 ) NOT NULL ,
`student` VARCHAR( 100 ) NOT NULL
)";
mysqli_query($qry);

$qry="CREATE TABLE `pretest` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`title` VARCHAR( 255 ) NOT NULL ,
`student` VARCHAR( 100 ) NOT NULL
)";
mysqli_query($qry);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

								
						
</body>
</html>
