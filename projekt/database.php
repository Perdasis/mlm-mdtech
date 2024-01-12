<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "registration-login";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Nem sikerült kapcsolódni az adatbázishoz.");
}
?>