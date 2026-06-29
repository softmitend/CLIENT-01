<?php
session_start();
include "../koneksi.php";

$nik = $_POST['nik'] ?? ($_SESSION['nik'] ?? '');
$nama = $_POST['nama_lengkap'] ?? ($_SESSION['nama_lengkap'] ?? '');

if (empty($nik) || empty($nama)) {
    echo "<script>
        alert('Lengkapi data diri terlebih dahulu!');
        window.location='daftar.php';
    </script>";
    exit;
}

$tempat = $_POST['tempat_lahir'] ?? ($_SESSION['tempat_lahir'] ?? '');
$tanggal_input = $_POST['tanggal_lahir'] ?? ($_SESSION['tanggal_lahir'] ?? '');
$tanggal = !empty($tanggal_input) ? $tanggal_input : null;
$kelamin = $_POST['kelamin'] ?? ($_SESSION['kelamin'] ?? '');
$alamat = $_POST['alamat'] ?? ($_SESSION['alamat'] ?? '');
$rt = $_POST['rt'] ?? ($_SESSION['rt'] ?? '');
$rw = $_POST['rw'] ?? ($_SESSION['rw'] ?? '');
$kelurahan = $_POST['kelurahan'] ?? ($_SESSION['kelurahan'] ?? '');
$email = $_POST['email_registrasi'] ?? '';
$password = $_POST['password'] ?? '';
$konfirmasi = $_POST['konfirmasi_password'] ?? '';

$nik = mysqli_real_escape_string($conn, $nik);
$nama = mysqli_real_escape_string($conn, $nama);
$tempat = mysqli_real_escape_string($conn, $tempat);
$tanggal = $tanggal ? mysqli_real_escape_string($conn, $tanggal) : null;
$kelamin = mysqli_real_escape_string($conn, $kelamin);
$alamat = mysqli_real_escape_string($conn, $alamat);
$rt = mysqli_real_escape_string($conn, $rt);
$rw = mysqli_real_escape_string($conn, $rw);
$kelurahan = mysqli_real_escape_string($conn, $kelurahan);
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

if ($password !== $konfirmasi) {
    echo "<script>
        alert('Password tidak sama!');
        window.history.back();
    </script>";
    exit;
}

$cek_nik = mysqli_query($conn, "SELECT * FROM user WHERE nik='$nik'");
if (mysqli_num_rows($cek_nik) > 0) {
    echo "<script>
        alert('NIK sudah terdaftar!');
        window.location='daftar.php';
    </script>";
    exit;
}

$cek_email = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
if (mysqli_num_rows($cek_email) > 0) {
    echo "<script>
        alert('Email sudah terdaftar!');
        window.location='../registrasi.html';
    </script>";
    exit;
}

$query = "INSERT INTO user
    (nik, email, password, nama_lengkap, tempat_lahir, tanggal_lahir, kelamin, alamat, rt, rw, kelurahan)
    VALUES
    ('$nik', '$email', '$password', '$nama', '$tempat', " . ($tanggal ? "'$tanggal'" : "NULL") . ", '$kelamin', '$alamat', '$rt', '$rw', '$kelurahan')";

if (mysqli_query($conn, $query)) {
    session_destroy();
    echo "<script>
        alert('Registrasi berhasil!');
        window.location='login.html';
    </script>";
} else {
    echo "Registrasi gagal: " . mysqli_error($conn);
}
