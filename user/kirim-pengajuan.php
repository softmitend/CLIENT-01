<?php
session_start();

// UBAH: Cek session 'nik', bukan 'login'
if (!isset($_SESSION['nik'])) {
    header("Location: login.html");
    exit;
}

$_SESSION['success'] = "Pengajuan berhasil dikirim!";
header("Location: dashboard.html");
exit;