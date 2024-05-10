<?php
session_start();
require 'config/connection.php';

$username = $_POST["username"];
$password = md5($_POST["password"]);

$login = mysqli_query($db, "SELECT * FROM tb_login WHERE username='$username'");
$row = mysqli_fetch_assoc($login);

if ($row && password_verify($password, $row["password"])) {
    $_SESSION["username"] = $row["username"];
    $_SESSION["level"] = $row["level"];
    echo "<script>alert('Anda Berhasil Login');window.location.href='menu.php';</script>";
} else {
    echo "<script>alert('Anda Gagal Login. Periksa kembali username dan password!!');window.location.href='index.php';</script>";
}
