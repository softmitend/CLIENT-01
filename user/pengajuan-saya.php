<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['nik'])) {
  header("Location: login.html");
  exit;
}

$nik = mysqli_real_escape_string($conn, $_SESSION['nik']);
$userQuery = mysqli_query($conn, "SELECT * FROM user WHERE nik='$nik'");
$user = mysqli_fetch_assoc($userQuery);
$pengajuan = mysqli_query($conn, "SELECT * FROM pengajuan WHERE nik='$nik' ORDER BY id DESC");

function e($value) {
  return htmlspecialchars((string) ($value ?? '-'), ENT_QUOTES, 'UTF-8');
}

function statusClass($status) {
  $status = strtolower((string) $status);
  if ($status === 'selesai') {
    return 'selesai';
  }
  if ($status === 'ditolak') {
    return 'ditolak';
  }
  return 'proses';
}

function isUnduhPdf($caraAmbil) {
  return strtolower(trim((string) $caraAmbil)) === 'unduh pdf';
}

function estimasiAmbil($status) {
  $status = strtolower((string) $status);
  if ($status === 'selesai') {
    return 'Siap diambil di kantor desa';
  }
  if ($status === 'ditolak') {
    return 'Pengajuan ditolak';
  }
  return 'Menunggu konfirmasi admin';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengajuan Saya - SiPeDes</title>
  <link rel="stylesheet" href="style-dashboard.css?v=2">
</head>

<body class="dashboard-page">

<header class="dash-navbar">
  <div class="dash-brand">
    <div class="dash-logo-box">
      <img src="logo-desa.jpg" alt="Logo Desa">
    </div>

    <div>
      <h2>SiPeDes</h2>
      <p>Desa Ciamis</p>
    </div>
  </div>

  <nav class="dash-menu">
    <a href="dashboard.html">Beranda</a>
    <a href="pengajuan-saya.php" class="active">Pengajuan Saya</a>
  </nav>

  <div class="dash-user-area">
    <div class="user-pill">
      <span class="avatar-circle"><?= e(strtoupper(substr($user['nama_lengkap'] ?? 'U', 0, 2))) ?></span>
      <span><?= e($user['nama_lengkap'] ?? 'User') ?></span>
    </div>

    <a href="logout.php" class="logout-btn">Keluar</a>
  </div>
</header>

<main class="dashboard-container">
  <section class="welcome-row">
    <div>
      <p class="welcome-text">Daftar Pengajuan</p>
      <h1>Pengajuan Saya</h1>
      <p class="address-text">Pantau semua surat yang pernah kamu ajukan.</p>
    </div>

    <a href="pilih-surat.html" class="ajukan-btn">Ajukan Surat Baru +</a>
  </section>

  <section class="pengajuan-panel">
    <?php if ($pengajuan && mysqli_num_rows($pengajuan) > 0): ?>
      <div class="pengajuan-list">
        <?php while ($row = mysqli_fetch_assoc($pengajuan)): ?>
          <article class="pengajuan-card">
            <div class="pengajuan-main">
              <span class="pengajuan-id">#<?= e($row['id']) ?></span>
              <h3><?= e($row['jenis_surat']) ?></h3>
              <p><?= e($row['tujuan']) ?></p>
              <div class="pengajuan-meta">
                <div class="pengajuan-meta-text">
                  <span>Instansi: <?= e($row['instansi']) ?></span>
                  <span>Cara ambil: <?= e($row['cara_ambil']) ?></span>
                </div>
                <div class="pengajuan-actions">
                  <?php if (isUnduhPdf($row['cara_ambil'])): ?>
                    <a href="unduh-pdf.php?id=<?= e($row['id']) ?>" class="pdf-btn" target="_blank">Unduh PDF</a>
                  <?php else: ?>
                    <span class="pickup-info"><?= e(estimasiAmbil($row['status'])) ?></span>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <span class="status-badge <?= statusClass($row['status']) ?>"><?= e(ucfirst($row['status'])) ?></span>
          </article>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <div class="empty-state">
        <h3>Belum ada pengajuan</h3>
        <p>Pengajuan surat yang kamu kirim akan muncul di sini.</p>
        <a href="pilih-surat.html" class="ajukan-btn">Ajukan Surat</a>
      </div>
    <?php endif; ?>
  </section>
</main>

</body>
</html>
