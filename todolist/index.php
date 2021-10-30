<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "function.php";

if (isset($_POST["add_post"])) {
    $name_task = mysqli_real_escape_string($con, $_POST['name_task']);
    $query = mysqli_query($con, "INSERT INTO tasks (name_task, status_task, date_task)  VALUES ('$name_task', 'Pending', now())");
    header("Location: index.php");
}

if (isset($_GET['edit'])) {
    $id_task = $_GET['edit'];
    $query = mysqli_query($con, "UPDATE tasks SET status_task = 'Selesai' Where id_task = '$id_task'");
    header("Location: index.php");
}

if (isset($_GET['delete'])) {
    $id_task = $_GET['delete'];
    $query = mysqli_query($con, "DELETE FROM tasks WHERE id_task = '$id_task'");
    header("Location: index.php");
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
    <title>Todo List Dicky</title>
</head>

<body>

    <header>
        <?php include "header.php" ?>
    </header>

    <!-- navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TODO LIST</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                </ul>
                <a href="logout.php">
                    <button class="btn btn-danger" type="submit">logout</button>
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row g-1">
                <div class="col-md-6">
                    <!-- add todolist -->
                    <div class="card bg-warning shadow-lg border-0 text-center">
                        <div class="card-body">
                            <h3>Form Tambah Todo List</h3>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name_task" placeholder="Input Todo list">
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" name="add_post" class="btn btn-primary">Tambah Todo List</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>

                    <!-- pending todolist -->
                    <div class="card bg-danger shadow-lg border-0 text-center">
                        <div class="card-body">
                            <h3 class="text-light">List Pending Todo List</h3>
                            <ul class="list-group text-start">
                                <?php
                                $query = mysqli_query($con, "SELECT * FROM tasks WHERE status_task = 'Pending'");

                                while ($row = mysqli_fetch_array($query)) {
                                    $id_task = $row['id_task'];
                                    $name_task = $row['name_task'];

                                ?>
                                    <li class="list-group-item">
                                        <?php echo $name_task; ?>
                                        <div style="float: right;">
                                            <a href="index.php?edit=<?php echo $id_task ?>" class="btn btn-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
                                                    <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z" />
                                                    <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                                </svg>
                                            </a>
                                            <a href="index.php?delete=<?php echo $id_task ?>" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- todolist selesai -->
                <div class="col-md-6">
                    <div class="card bg-primary shadow-lg border-0">
                        <div class="card-body">
                            <h3 class="text-light text-center">Todo List Selesai</h3>
                            <ul class="list-group">
                                <?php
                                $query = mysqli_query($con, "SELECT * FROM tasks WHERE status_task = 'Selesai'");

                                while ($row = mysqli_fetch_array($query)) {
                                    $id_task = $row['id_task']
                                ?>
                                    <li class="list-group-item">
                                        <?php echo $row['name_task'] ?>
                                        <div style="float: right;">
                                            <span class="badge bg-primary">Selesai</span>
                                            <a href="index.php?delete=<?php echo $id_task ?>" class="btn btn-danger badge bg-danger">Hapus</a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.js" crossorigin="anonymous"></script>


</body>

</html>