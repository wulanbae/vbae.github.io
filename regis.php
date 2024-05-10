<?php
session_start();
require 'config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST["username"];
  $password = md5($_POST["password"]);
  $confirmPassword = md5($_POST["confirmPassword"]);
  $nama = $_POST["nama"];
  $level = $_POST["level"];

  $query = mysqli_query($db, "SELECT MAX(id) as max_id FROM tb_login");
  $result = mysqli_fetch_assoc($query);
  $lastId = $result['max_id'];

  $nomor = $lastId + 1;

  if ($password !== $confirmPassword) {
    $errorMsg = "Password dan Ulang Password harus sama";
  } else {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $insertQuery = "INSERT INTO tb_login (id, username, password, nama, level) VALUES ('$nomor', '$username', '$hashedPassword', '$nama', '$level')";

    if (mysqli_query($db, $insertQuery)) {
      echo "<script>alert('Registrasi Berhasil');window.location.href='index.php';</script>";
      exit();
    } else {
      echo "<script>alert(Terjadi kesalahan. Silahkan coba lagi!!');window.location.href='regist.php';</script>";
    }
  }
}
