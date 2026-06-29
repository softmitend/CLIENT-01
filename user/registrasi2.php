<?php
session_start();
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nik = $_SESSION['nik'];
    $nama = $_SESSION['nama_lengkap'];
    $tempat = $_SESSION['tempat_lahir'];
    $tanggal = $_SESSION['tanggal_lahir'];
    $kelamin = $_SESSION['kelamin'];
    $alamat = $_SESSION['alamat'];
    $rt = $_SESSION['rt'];
    $rw = $_SESSION['rw'];
    $kelurahan = $_SESSION['kelurahan'];

    $password = $_POST['password'];

    // SIMPAN KE DATABASE
    mysqli_query($conn, "INSERT INTO user 
    (nik, nama_lengkap, tempat_lahir, tanggal_lahir, kelamin, alamat, rt, rw, kelurahan, password)
    VALUES 
    ('$nik', '$nama', '$tempat', '$tanggal', '$kelamin', '$alamat', '$rt', '$rw', '$kelurahan', '$password')");

    // hapus session
    session_destroy();

    echo "<script>
        alert('Registrasi berhasil!');
        window.location='login.html';
    </script>";

    exit;
} else {
    header("Location: ../registrasi.html");
    exit;
}
