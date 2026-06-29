<?php
session_start();
include "../koneksi.php";

$nik = $_POST['nik'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM user WHERE nik='$nik'");

if (mysqli_num_rows($query) === 0) {
    echo "<script>
        alert('NIK tidak ditemukan!');
        window.location = 'login.html';
    </script>";
    exit;
}

$data = mysqli_fetch_assoc($query);

if ($password == $data['password']) {

    $_SESSION['nik'] = $data['nik'];
    $_SESSION['nama'] = $data['nama_lengkap'];

    echo "<script>
        alert('Login berhasil!');
        window.location = 'dashboard.html';
    </script>";
    exit;
} else {
    echo "<script>
        alert('Password salah!');
        window.location = 'login.html';
    </script>";
    exit;
}
