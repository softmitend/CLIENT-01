 <?php
    session_start();
    include "../koneksi.php";

    $nik = $_POST['nik'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE nik='$nik'");
    $data = mysqli_fetch_assoc($query);

    if ($data && $password == $data['password']) {

        $_SESSION['nik'] = $data['nik'];
        $_SESSION['nama'] = $data['nama_lengkap'];
        $_SESSION['login'] = true;

        // debug dulu
        echo "<pre>";
        print_r($_SESSION);
        exit;
    } else {
        echo "<script>
        alert('Login gagal!');
        window.location='login.html';
    </script>";
    }
