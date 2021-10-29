<?php
$con = mysqli_connect("localhost", "root", "", "db_todolist");
if (!$con) {
    die("koneksi gagal");
}
