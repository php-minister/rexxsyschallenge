<?php

ini_set('display_errors', 'On');
error_reporting(-1);

// Create database connection
$conn = new mysqli("localhost","root","","rexxsystest");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>