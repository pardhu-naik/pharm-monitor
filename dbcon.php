<?php
// Cloud-ready database connection using environment variables
$host = getenv('DB_HOST') ?: "localhost";
$user = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASS') ?: "";
$dbname = getenv('DB_NAME') ?: "pharm_monitor";
$port = getenv('DB_PORT') ?: "3306";

$con = mysqli_connect($host, $user, $password, $dbname, $port);

if (!$con) {
    die("Database Connection Error: " . mysqli_connect_error());
}
?>