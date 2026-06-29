<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
include "../koneksi.php";

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT p.*, u.nama_lengkap, u.alamat, u.rt, u.rw, u.kelurahan 
    FROM pengajuan p 
    LEFT JOIN user u ON p.nik = u.nik 
    WHERE p.id='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Pengajuan - SiPeDes</title>
  <link rel="stylesheet" href="style-admin.css">
  <link rel="stylesheet" href="style-detail.css">
</head>

<body>

  <div class="navbar">
    <h2>SiPeDes Admin</h2>
    <a href="logout.php">Keluar</a>
  </div>

  <div class="layout">
    <div class="sidebar">
      <a href="dashboard.php">Dashboard</a>
      <a href="user.php">Data User</a>
    </div>

    <div class="main">
      <a href="dashboard.php" class="back">← Kembali</a>

      <div class="detail-box">
        <h4>Data Pemohon</h4>
        <div class="detail-row"><span
            class="detail-label">Nama</span><span><?= $data['nama_lengkap'] ?? '-' ?></span></div>
        <div class="detail-row"><span class="detail-label">NIK</span><span><?= $data['nik'] ?></span></div>
        <div class="detail-row"><span
            class="detail-label">Alamat</span><span><?= $data['alamat'] ?? '-' ?></span></div>
        <div class="detail-row"><span
            class="detail-label">RT/RW</span><span><?= $data['rt'] ?? '-' ?>/<?= $data['rw'] ?? '-' ?></span>
        </div>
        <div class="detail-row"><span
            class="detail-label">Kelurahan</span><span><?= $data['kelurahan'] ?? '-' ?></span></div>
      </div>

      <div class="detail-box">
        <h4>Detail Surat</h4>
        <div class="detail-row"><span class="detail-label">Jenis
            Surat</span><span><?= $data['jenis_surat'] ?></span></div>
        <div class="detail-row"><span class="detail-label">Keperluan</span><span><?= $data['tujuan'] ?></span>
        </div>
        <div class="detail-row"><span
            class="detail-label">Instansi</span><span><?= $data['instansi'] ?? '-' ?></span></div>
        <div class="detail-row"><span class="detail-label">Cara
            Ambil</span><span><?= $data['cara_ambil'] ?></span></div>
        <div class="detail-row"><span class="detail-label">Status</span><span
            class="badge <?= $data['status'] ?? 'menunggu' ?>"><?= $data['status'] ?? 'menunggu' ?></span>
        </div>
      </div>

      <div class="detail-box">
        <h4>Dokumen Terlampir</h4>
        <?php if (!empty($data['foto_ktp'])): ?>
          <div class="detail-row">
            <span class="detail-label">Foto KTP</span>
            <span><img src="../user/uploads/<?= $data['foto_ktp'] ?>" class="foto-dokumen" alt="KTP"></span>
          </div>
        <?php endif; ?>

        <?php if (!empty($data['foto_kk'])): ?>
          <div class="detail-row">
            <span class="detail-label">Kartu Keluarga</span>
            <span><img src="../user/uploads/<?= $data['foto_kk'] ?>" class="foto-dokumen" alt="KK"></span>
          </div>
        <?php endif; ?>

        <?php if (!empty($data['foto_surat_rt'])): ?>
          <div class="detail-row">
            <span class="detail-label">Surat RT/RW</span>
            <span><img src="../user/uploads/<?= $data['foto_surat_rt'] ?>" class="foto-dokumen"
                alt="Surat RT"></span>
          </div>
        <?php endif; ?>

        <?php if (empty($data['foto_ktp']) && empty($data['foto_kk'])): ?>
          <p style="color:#9ca3af; font-size:13px;">Belum ada dokumen yang terlampir.</p>
        <?php endif; ?>
      </div>

      <div class="aksi-besar">
        <a href="aksi.php?id=<?= $id ?>&aksi=setujui" class="approve">Setujui Pengajuan</a>
        <a href="aksi.php?id=<?= $id ?>&aksi=tolak" class="tolak">Tolak Pengajuan</a>
        <a href="dashboard.php" class="back-btn">Kembali</a>
      </div>
    </div>
  </div>

</body>

</html>