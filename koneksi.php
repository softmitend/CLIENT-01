<?php
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $db = "sipedes";

    $conn = mysqli_connect($server_name, $username, $password, $db);

    if (mysqli_connect_errno()) {
        echo "aplikasi belum konek/koneksi gagal: ". mysqli_connect_errno();
    }
?>