<?php
session_start();

if (empty($_SESSION['email_registrasi']) || empty($_SESSION['password_registrasi'])) {
    header("Location: ../registrasi.html");
    exit;
}

function old($key)
{
    return htmlspecialchars($_SESSION[$key] ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Isi Data Diri</title>
  <link rel="stylesheet" href="style-registrasi.css">
</head>

<body>

<div class="card">
  <div class="header">
    <h2>SiPeDes</h2>
    <h1>Isi Data Diri</h1>
    <p>Lengkapi identitas pemohon</p>

    <div class="step">1 Buat Akun</div>
    <div class="step">2 Isi Data Diri</div>
  </div>

  <div class="form-box">
    <h2>Data Diri & Identitas</h2>
    <p>Langkah 2 dari 2</p>

    <form action="proses-registrasi.php" method="POST">
      <input type="hidden" name="email_registrasi" value="<?= old('email_registrasi') ?>">
      <input type="hidden" name="password" value="<?= old('password_registrasi') ?>">
      <input type="hidden" name="konfirmasi_password" value="<?= old('password_registrasi') ?>">

      <label>NIK *</label>
      <input type="text" name="nik" required>

      <label>Nama Lengkap *</label>
      <input type="text" name="nama_lengkap" required>

      <label>Tempat Lahir</label>
      <input type="text" name="tempat_lahir">

      <label>Tanggal Lahir</label>
      <input type="date" name="tanggal_lahir">

      <label>Kelamin</label>
      <select name="kelamin">
        <option value="">Pilih</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>

      <label>Alamat</label>
      <input type="text" name="alamat">

      <label>RT</label>
      <input type="text" name="rt">

      <label>RW</label>
      <input type="text" name="rw">

      <label>Kelurahan</label>
      <input type="text" name="kelurahan">

      <div class="agreement">
        <input type="checkbox" id="setuju2" required>
        <label for="setuju2">Saya menyatakan data yang saya isi adalah benar.</label>
      </div>

      <button type="submit">Daftar</button>
    </form>
  </div>
</div>

</body>
</html>
