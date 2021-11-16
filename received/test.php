<?php
include 'koneksi.php';
include 'function.php';
if (empty($_GET)) {
    echo 'kontol';
} else {

    if ($_GET['receiver']) {
        $d = mysqli_query($mysqli, "SELECT * FROM `trash` WHERE `nomor_trash` LIKE '" . $_GET['receiver'] . "'");
        if (mysqli_num_rows($d) == 1) {
            echo 'status 3';
        } else {

            mysqli_query($mysqli, "INSERT INTO `trash` (`id`, `nomor_trash`, `tgl`) VALUES (NULL, '" . $_GET['receiver'] . "', current_timestamp())");

            echo 'jalan';
        }
    }
}
