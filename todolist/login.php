<?php

session_start();
if (isset($_SESSION["login"])) {
    header("Location: index.php");
}

require "function.php";

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($con, "SELECT * FROM user WHERE email = '$email'");

    // cek email
    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            $_SESSION["login"] = true;

            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm bg-dark text-light rounded ">
                    <!-- alert untuk error -->
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-warning alert-dismissible fade show text-danger" role="alert">
                            <strong>Login Gagal</strong> Email atau Password salah
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <form action="" method="POST">
                        <div class="text-center">
                            <h1>Login</h1>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                    </form>
                    <div align="center">
                        <p>belum punya akun ? </p>
                        <a href="register.php"><button class="btn btn-danger">Register</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.js" crossorigin="anonymous"></script>

</body>

</html>