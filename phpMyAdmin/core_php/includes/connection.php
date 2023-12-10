<?php 
 
 $DBhost ="localhost"; 
 $DBuser = "root";
 $DBpass = "~hMSy}R?>V5+&y[E"; 
 $DBName = "medhero";

$conn = mysqli_connect($DBhost,$DBuser,$DBpass,$DBName);

if(!$conn)
{
    die('Could not connect to database: ' . mysqli_error());
}

?>