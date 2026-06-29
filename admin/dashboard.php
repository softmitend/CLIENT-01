<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
include "../koneksi.php";

$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pengajuan"))['total'];
$menunggu = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pengajuan WHERE status='menunggu'"))['total'];
$selesai = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pengajuan WHERE status='selesai'"))['total'];
$ditolak = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pengajuan WHERE status='ditolak'"))['total'];

$pengajuan = mysqli_query($conn, "SELECT * FROM pengajuan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - SiPeDes</title>
  <link rel="stylesheet" href="style-admin.css">
</head>

<body>

  <div class="navbar">
    <h2>SiPeDes Admin</h2>
    <a href="logout.php">Keluar</a>
  </div>

  <div class="layout">
    <div class="sidebar">
      <a href="dashboard.php" class="active">Dashboard</a>
      <a href="user.php">Data User</a>
    </div>

    <div class="main">
      <div class="stats">
        <div class="stat">
          <p>Total Pengajuan</p>
          <h3 class="purple"><?= $total ?></h3>
        </div>
        <div class="stat">
          <p>Menunggu</p>
          <h3 class="amber"><?= $menunggu ?></h3>
        </div>
        <div class="stat">
          <p>Selesai</p>
          <h3 class="green"><?= $selesai ?></h3>
        </div>
        <div class="stat">
          <p>Ditolak</p>
          <h3 class="red"><?= $ditolak ?></h3>
        </div>
      </div>

      <div class="panel">
        <div class="panel-header">
          <h4>Daftar Pengajuan</h4>
        </div>
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>NIK</th>
              <th>Jenis Surat</th>
              <th>Keperluan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            while ($row = mysqli_fetch_assoc($pengajuan)): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nik'] ?></td>
                <td><?= $row['jenis_surat'] ?></td>
                <td><?= $row['tujuan'] ?></td>
                <td><span
                    class="badge <?= $row['status'] ?? 'menunggu' ?>"><?= $row['status'] ?? 'menunggu' ?></span>
                </td>
                <td>
                  <div class="aksi">
                    <a href="detail.php?id=<?= $row['id'] ?>">Detail</a>
                    <a href="aksi.php?id=<?= $row['id'] ?>&aksi=setujui" class="approve">Setujui</a>
                    <a href="aksi.php?id=<?= $row['id'] ?>&aksi=tolak" class="tolak">Tolak</a>
                  </div>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>

</html>