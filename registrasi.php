<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    $konfirmasi = $_POST['konfirmasi_password'] ?? '';

    if ($password !== $konfirmasi) {
        echo "<script>
            alert('Password tidak sama!');
            window.history.back();
        </script>";
        exit;
    }

    $_SESSION['email_registrasi'] = $_POST['email_registrasi'] ?? '';
    $_SESSION['password_registrasi'] = $password;

    header("Location: user/daftar.php");
    exit;
}

header("Location: registrasi.html");
exit;
