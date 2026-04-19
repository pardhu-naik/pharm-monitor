<?php
// Cloud-ready database connection
// Supports generic (Railway/Render) and Clever Cloud specific variables
$host = getenv('MYSQL_ADDON_HOST') ?: getenv('DB_HOST') ?: "localhost";
$user = getenv('MYSQL_ADDON_USER') ?: getenv('DB_USER') ?: "root";
$password = getenv('MYSQL_ADDON_PASSWORD') ?: getenv('DB_PASS') ?: "";
$dbname = getenv('MYSQL_ADDON_DB') ?: getenv('DB_NAME') ?: "pharm_monitor";
$port = getenv('MYSQL_ADDON_PORT') ?: getenv('DB_PORT') ?: "3306";

$con = mysqli_connect($host, $user, $password, $dbname, $port);

if (!$con) {
    die("Database Connection Error: " . mysqli_connect_error());
}
?>