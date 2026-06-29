<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['nik'])) {
    header("Location: login.html");
    exit;
}

$nik = $_SESSION['nik'];

$query = mysqli_query($conn, "SELECT * FROM user WHERE nik='$nik'");
$user = mysqli_fetch_assoc($query);

if (!$user) {
    session_unset();
    session_destroy();
    header("Location: login.html");
    exit;
}

$id_pengajuan = $_SESSION['id_pengajuan'] ?? null;

$pengajuan = null;
if ($id_pengajuan) {
    $q2 = mysqli_query($conn, "SELECT * FROM pengajuan WHERE id='$id_pengajuan'");
    $pengajuan = mysqli_fetch_assoc($q2);
}
?>

<h2>Selamat datang, <?= $user['nama'] ?></h2>
<p>NIK: <?= $user['nik'] ?></p>

<?php if ($pengajuan) { ?>
    <h3>Status Pengajuan</h3>
    <p>Pengajuan kamu sudah masuk.</p>
<?php } else { ?>
    <p>Belum ada pengajuan.</p>
<?php } ?>
