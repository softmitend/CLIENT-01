<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
include "../koneksi.php";

$users = mysqli_query($conn, "SELECT * FROM user ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data User - SiPeDes</title>
  <link rel="stylesheet" href="style-admin.css">
</head>

<body>

  <div class="navbar">
    <h2>SiPeDes Admin</h2>
    <a href="logout.php">Keluar</a>
  </div>

  <div class="layout">
    <div class="sidebar">
      <a href="dashboard.php">Dashboard</a>
      <a href="user.php" class="active">Data User</a>
    </div>

    <div class="main">
      <div class="panel">
        <div class="panel-header">
          <h4>Daftar User</h4>
        </div>
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Email</th>
              <th>Nama</th>
              <th>NIK</th>
              <th>Kelurahan</th>
              <th>RT/RW</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            while ($row = mysqli_fetch_assoc($users)): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['email'] ?? '-' ?></td>
                <td><?= $row['nama_lengkap'] ?? '-' ?></td>
                <td><?= $row['nik'] ?? '-' ?></td>
                <td><?= $row['kelurahan'] ?? '-' ?></td>
                <td><?= $row['rt'] ?? '-' ?>/<?= $row['rw'] ?? '-' ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>

</html>
