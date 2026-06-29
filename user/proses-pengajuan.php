<?php
session_start();
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: formulir.html");
    exit;
}

$nik = $_SESSION['nik'] ?? '';
$jenis_slug = $_POST['jenis_surat'] ?? '';
$jenis_surat = $_POST['jenis_surat_label'];
$tujuan = $_POST['keperluan'];
$instansi = $_POST['instansi'] ?? '';
$keterangan = $_POST['keterangan'] ?? '';
$cara_ambil = $_POST['cara_ambil'];

if ($jenis_slug === '') {
    $slug_map = [
        'Surat Domisili' => 'domisili',
        'Pengantar KTP / KK' => 'ktp',
        'Surat Keterangan Usaha' => 'usaha',
        'Surat Ahli Waris' => 'waris',
        'Surat Tidak Mampu' => 'tidakmampu',
    ];

    $jenis_slug = $slug_map[$jenis_surat] ?? '';
}

$_SESSION['jenis_surat'] = $jenis_surat;
$_SESSION['jenis_surat_slug'] = $jenis_slug;
$_SESSION['keperluan'] = $tujuan;
$_SESSION['cara_ambil'] = $cara_ambil;

$query = "INSERT INTO pengajuan (nik, jenis_surat, tujuan, instansi, keterangan, cara_ambil)
VALUES ('$nik', '$jenis_surat', '$tujuan', '$instansi', '$keterangan', '$cara_ambil')";

if (mysqli_query($conn, $query)) {
    $_SESSION['id_pengajuan'] = mysqli_insert_id($conn);
    header("Location: formulir-step2.html?jenis=" . urlencode($jenis_slug));
    exit;
} else {
    echo "Gagal: " . mysqli_error($conn);
}
