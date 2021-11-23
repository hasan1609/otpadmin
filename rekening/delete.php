<?php
include '../koneksi.php';
include '../function.php';
$id = $_GET["id"];

if (hapusrek($id, $mysqli) > 0) {
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href = 'index.php';
        </script>";
} else {
    echo "
        <script>
            alert('Aplikasi gagal dihapus!');
            document.location.href = 'index.php';
        </script>
        ";
}
