<?php
session_start();

function checkLoginStatus() {
    if (isset($_SESSION["user"])) {
        echo json_encode(["isLoggedIn" => true]);
    } else {
        echo json_encode(["isLoggedIn" => false]);
    }
}
checkLoginStatus();
?>


