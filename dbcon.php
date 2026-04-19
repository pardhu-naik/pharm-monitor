<?php


$host ="localhost";
$user ="root";
$password= "";
$dbname = "pharm_monitor";


$con =mysqli_connect($host,$user,$password,$dbname);

if(!$con){

	echo mysqli_connect_error($con);
}

?> 