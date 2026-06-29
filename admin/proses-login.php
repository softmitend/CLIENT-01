<?php
session_start();
include "../koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

if (mysqli_num_rows($query) > 0) {
    $_SESSION['admin'] = true;
    header("Location: dashboard.php");
    exit;
} else {
    header("Location: login.php?error=1");
    exit;
}
