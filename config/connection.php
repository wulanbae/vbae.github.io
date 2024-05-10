<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db_tphp";

$db = new mysqli($host, $username, $password, $database);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
