<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../koneksi.php";

$id = $_GET['id'];
$aksi = $_GET['aksi'];

if ($aksi === 'setujui') {
    $status = 'selesai';
} elseif ($aksi === 'tolak') {
    $status = 'ditolak';
} else {
    header("Location: dashboard.php");
    exit;
}

mysqli_query($conn, "UPDATE pengajuan SET status='$status' WHERE id='$id'");

header("Location: dashboard.php");
exit;
