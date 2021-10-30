<?php

require "function.php";

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        $success = true;
    } else {
        $error = true;
        echo mysqli_error($con);
    }
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
                    <!-- alert untuk success -->
                    <?php if (isset($success)) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Registrasi Berhasil</strong> Silakan <a href="login.php">Login</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- alert untuk error -->
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-warning alert-dismissible fade show text-danger" role="alert">
                            <strong>Email sudah terdaftar</strong> Silakan <a href="login.php"><button class="badge btn-primary">Login</button></a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <form action="" method="POST">
                        <div class="text-center">
                            <h1>REGISTER</h1>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="register">Submit</button>
                    </form>
                    <div align="center">
                        <p>sudah punya akun ? </p>
                        <a href="login.php"><button class="btn btn-danger">Login</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.js" crossorigin="anonymous"></script>

</body>

</html>