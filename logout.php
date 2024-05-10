<?php
session_start();
SESSION_DESTROY();
echo "<script>alert('Anda Berhasil Logout');window.location.href='index.php';</script>";
