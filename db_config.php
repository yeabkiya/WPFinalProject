<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'ylegesse2'); 
define('DB_PASS', 'ylegesse2'); 
define('DB_NAME', 'ylegesse2'); 

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
