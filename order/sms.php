<?php
include '../koneksi.php';


if ($_GET['id']) {
    $result = mysqli_query($mysqli, "SELECT * FROM `inbox` WHERE `id_inbox` = '$_GET[id]'");
    if ($result->num_rows > 0) {
        // output data of each row

        while ($row = $result->fetch_assoc()) {
            $d = explode("\n", $row['sms']);
            print_r($d[5]);
        }
    } else {
        echo '<p>Maaf Masih Balum Ada Pesan Masuk !!!</p>';
    }
}
