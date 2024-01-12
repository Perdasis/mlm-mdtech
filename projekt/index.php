<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="user/logo.png">
    <link rel="shortcut icon" type="x-icon" href="logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="registration-login.css">
    <title>Bejelentkezés</title>

    <meta http-equiv="refresh" content="2; url = ./user/home.html" />

</head>

<body class="bg-dark text-white">
    <div class="container" style="margin-top: 5%">
        <h1 class="mb-5 text-center">Sikeres bejelentkezés!</h1>
        <p class="mb-3 text-center">Átírányítás folyamatban.</p>
    </div>
</body>

</html>