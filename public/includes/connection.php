<?php 
 
 $DBhost ="localhost"; 
 $DBuser = "root";
 $DBpass = ""; 
 $DBName = "medhero";

$conn = mysqli_connect($DBhost,$DBuser,$DBpass,$DBName);

if(!$conn)
{
    die('Could not connect to database: ' . mysqli_error());
}

?>