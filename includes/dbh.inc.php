<?php
$dBServername = "35.227.39.83";
$dBUsername = "root";
$dBPassword = "upsorn";
$dBName = "pokemon";

// Create connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
