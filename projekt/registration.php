<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="user/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="registration-login.css">
    <link rel="stylesheet" type="text/css" href="footer.css">
    <title>Regisztráció</title>
</head>

<body class="bg-dark text-white">
    <div class="container" style="margin-top: 5%;">
        <?php

        require_once "database.php";

        if (isset($_POST["submit"])) {
            $fullname = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $errors = array();

            if (empty($fullname) || empty($email) || empty($password) || empty($passwordRepeat)) {
                array_push($errors, "Minden mező kitöltése kötelező!");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Helytelen e-mail cím!");
            }

            if (strlen($password) < 8) {
                array_push($errors, "A jelszónak legalább 8 karakternek kell lenni!");
            }

            if ($password !== $passwordRepeat) {
                array_push($errors, "A jelszónak egyeznie kell!");
            }

            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount > 0) {
                    array_push($errors, "Az e-mail cím már létezik. Használj másikat vagy jelentkezz be!");
                }
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>A regisztráció megtörtént!</div>";

                    header("Location: login.php");
                    exit();

                } else {
                    die("Valami hiba történt!");
                }
            }
        }
        ?>

        <div style="float: left; margin-right: auto;">
            <a href="login.php">
                <img src="user/backarrow.png" alt="Vissza" style="width: 20px; height: 20px;">
            </a>

        </div>

        <form action="registration.php" method="post">
            <div class="form-group">
                <h2 style="text-align: center; margin-bottom: 25px">Regisztráció</h2>
                <input type="text" class="form-control" name="fullname" placeholder="Teljes Név:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Jelszó:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Jelszó újra:">
            </div>
            <div class="form-btn" style="text-align: center">
                <input type="submit" class="btn btn-primary" value="Regisztráció" name="submit">
            </div>
        </form>

        <br>
        <div>
            <p style="text-align: center">Ha már van fiókod, jelentkezz be <a href="login.php">itt.</a></p>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 MDTech. Minden jog fenntartva.</p>
    </footer>
</body>

</html>