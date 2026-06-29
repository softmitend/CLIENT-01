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

function e($value) {
  return htmlspecialchars((string) ($value ?? '-'), ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Konfirmasi - SiPeDes</title>
  <link rel="stylesheet" href="style-formulir.css">
</head>

<body>

  <main class="form-page">

    <div class="breadcrumb">
      <a href="dashboard.html">Beranda</a>
      <span>&rsaquo;</span>
      <a href="pilih-surat.html">Pilih Surat</a>
      <span>&rsaquo;</span>
      <span>Konfirmasi</span>
    </div>

    <h1>Konfirmasi Pengajuan</h1>
    <p class="subtitle">Periksa kembali data sebelum dikirim</p>

    <section class="user-card">
      <div class="avatar"><?= e(strtoupper(substr($user['nama_lengkap'] ?? 'U', 0, 2))) ?></div>
      <div class="user-main">
        <h4><?= e($user['nama_lengkap'] ?? '-') ?></h4>
        <p>NIK: <?= e($user['nik'] ?? '-') ?> - RT <?= e($user['rt'] ?? '-') ?>/RW <?= e($user['rw'] ?? '-') ?></p>
      </div>
      <a href="dashboard.html">Edit Profil</a>
    </section>

    <section class="stepper">
      <div class="step done">
        <span>1</span>
        <p>Data Diri</p>
      </div>
      <div class="line"></div>
      <div class="step done">
        <span>2</span>
        <p>Keperluan</p>
      </div>
      <div class="line"></div>
      <div class="step done">
        <span>3</span>
        <p>Dokumen</p>
      </div>
      <div class="line"></div>
      <div class="step active">
        <span>4</span>
        <p>Kirim</p>
      </div>
    </section>

    <div class="info">
      Periksa kembali sebelum mengirim. Data yang sudah dikirim tidak bisa diubah.
    </div>

    <section class="konfirmasi-box">
      <h4>Ringkasan Pengajuan</h4>

      <div class="konfirmasi-section">
        <p class="konfirmasi-label">Data Pemohon</p>
        <table class="konfirmasi-table">
          <tr>
            <td>NIK</td>
            <td><?= e($_SESSION['nik'] ?? $user['nik'] ?? '-') ?></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td><?= e($_SESSION['nama'] ?? $user['nama_lengkap'] ?? '-') ?></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td><?= e($_SESSION['alamat'] ?? $user['alamat'] ?? '-') ?>, RT <?= e($_SESSION['rt'] ?? $user['rt'] ?? '-') ?>/<?= e($_SESSION['rw'] ?? $user['rw'] ?? '-') ?></td>
          </tr>
        </table>
      </div>

      <div class="konfirmasi-section">
        <p class="konfirmasi-label">Detail Surat</p>
        <table class="konfirmasi-table">
          <tr>
            <td>Jenis Surat</td>
            <td><?= e($_SESSION['jenis_surat'] ?? '-') ?></td>
          </tr>
          <tr>
            <td>Keperluan</td>
            <td><?= e($_SESSION['keperluan'] ?? '-') ?></td>
          </tr>
          <tr>
            <td>Cara Ambil</td>
            <td><?= e($_SESSION['cara_ambil'] ?? '-') ?></td>
          </tr>
          <tr>
            <td>Dokumen</td>
            <td><?= isset($_SESSION['ktp']) ? '3 file terlampir' : '-' ?></td>
          </tr>
          <tr>
            <td>Estimasi</td>
            <td>11 Maret 2026 (+/- 1 hari)</td>
          </tr>
        </table>
      </div>
    </section>

    <form action="kirim-pengajuan.php" method="POST" class="confirm-form">
      <div class="agreement">
        <input type="checkbox" id="setuju" required>
        <label for="setuju">Saya menyatakan data yang diisi adalah benar dan dapat dipertanggungjawabkan</label>
      </div>

      <div class="button-row">
        <a href="formulir-step2.html" class="btn-cancel">&larr; Kembali</a>
        <button type="submit" class="btn-next">Kirim Pengajuan &rarr;</button>
      </div>
    </form>

  </main>

</body>

</html>
