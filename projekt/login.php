<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="user/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="registration-login.css">
    <link rel="stylesheet" type="text/css" href="footer.css">
    <title>Login Form</title>
</head>

<body class="bg-dark text-white">
    <div class="container" style="margin-top: 5%;">
        <?php
        require_once "database.php";
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $stmt = mysqli_stmt_init($conn);
            $sql = "SELECT * FROM users WHERE email = ?";
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            }

            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Helytelen jelszó!</div>";
                }

            } else {
                echo "<div class='alert alert-danger'>Helytelen e-mail cím!</div>";
            }
        }
        ?>

        <div style="float: left; margin-right: auto;">
            <a href="user/home.html">
                <img src="user/backarrow.png" alt="Vissza" style="width: 20px; height: 20px;">
            </a>

        </div>

        <form action="login.php" method="post">
            <div class="form-group">
                <h2 style="text-align: center; margin-bottom: 25px">Bejelentkezés</h2>
                <input type="email" placeholder="E-mail:" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Jelszó:" name="password" class="form-control">
            </div>
            <div class="form-btn text-center">
                <input type="submit" value="BEJELENTKEZÉS" name="login" class="btn btn-primary">
            </div>
        </form>
        <br>
        <div class="text-center">
            <h6>Elfelejtett jelszó esetén kattints <a href="">ide.</a></h6>
        </div>
        <br>
        <div class="text-center">
            <h6>Ha még nincs fiókod, regisztrálj!</h6>
        </div>
        <br>
        <form action="registration.php" method="post">
            <div class="form-btn text-center">
                <input type="submit" value="REGISZTRÁCIÓ" name="registration" class="btn btn-warning">
            </div>
        </form>

        <script>
            function registration() {
                window.location.href = "registration.php";
            }
        </script>

    </div>

    <footer class="footer">
        <p>&copy; 2024 MDTech. Minden jog fenntartva.</p>
    </footer>
</body>

</html