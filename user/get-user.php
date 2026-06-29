<?php
session_start();
include "../koneksi.php";

// Pastikan tidak ada spasi atau karakter apa pun sebelum header JSON ini
header('Content-Type: application/json');

if (!isset($_SESSION['nik'])) {
    echo json_encode(["status" => "error", "message" => "Belum login"]);
    exit;
}

$nik = $_SESSION['nik'];
$query = mysqli_query($conn, "SELECT * FROM user WHERE nik='$nik'");

if (!$query) {
    echo json_encode(["status" => "error", "message" => "Query Error: " . mysqli_error($conn)]);
    exit;
}

$user = mysqli_fetch_assoc($query);

if (!$user) {
    echo json_encode(["status" => "error", "message" => "User tidak ditemukan"]);
    exit;
}

// Ambil potongan email sebagai nama alternatif jika nama_lengkap masih kosong
$email_user = isset($user['email']) ? $user['email'] : 'user@gmail.com';
$nama_alternatif = explode('@', $email_user)[0];

// Menyiapkan data untuk dikirim balik ke JavaScript dashboard.html
echo json_encode([
    "status" => "success",
    "email" => $email_user,
    "nama" => (!empty($user['nama_lengkap'])) ? $user['nama_lengkap'] : ucfirst($nama_alternatif),
    "nik" => $user['nik'],
    "alamat" => (!empty($user['alamat'])) ? $user['alamat'] : '-',
    "rt" => (!empty($user['rt'])) ? $user['rt'] : '-',
    "rw" => (!empty($user['rw'])) ? $user['rw'] : '-',
    "kelurahan" => (!empty($user['kelurahan'])) ? $user['kelurahan'] : 'Belum Atur Wilayah',

    // Titipan pesan sukses untuk notifikasi di dashboard.html
    "notif" => isset($_SESSION['success']) ? $_SESSION['success'] : null
]);

// Langsung hapus session sukses setelah dikirim agar tidak muncul terus-menerus
unset($_SESSION['success']);
exit;
