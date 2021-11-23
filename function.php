<?php

function getapp($app, $mysqli)
{
    $result = mysqli_query($mysqli, "SELECT * FROM `app` WHERE `idapp` LIKE '" . $app . "'");

    $row = $result->fetch_assoc();
    echo $row['app'];
}
function getop($op, $mysqli)
{
    $result = mysqli_query($mysqli, "SELECT * FROM `operator` WHERE `idop` LIKE '" . $op . "'");

    $row = $result->fetch_assoc();
    echo $row['operator'];
}

function otp($nomor, $app, $mysqli)
{
    $result = mysqli_query($mysqli, "SELECT * FROM `inbox` WHERE `nomor_i` LIKE '" . $nomor . "' AND `app_i` LIKE '" . $app . "'");

    if ($result->num_rows > 0) {
        // output data of each row

        while ($row = $result->fetch_assoc()) {
            //echo "Your OTP code = ";
            // $str = preg_replace('/[^0-9]+/', ' ', $row['sms']);
            //  $str1 = explode(' ', $str);
            // print_r($str1[1]);
            $d = explode("\n", $row['sms']);
            preg_match_all('!\d+!', $d[5], $matches);

            print_r($matches[0][0]);
        }
    }
}
function price($app, $mysqli)
{
    $result = mysqli_query($mysqli, "SELECT * FROM `price` WHERE `app` LIKE '" . $app . "'");

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row['harga'];
        }
    } else {
        echo "<h6 class='text-danger'>Maaf Harga Belum Diset</h6>";
    }
}
function hapusapp($id, $mysqli)
{
    mysqli_query($mysqli, "DELETE FROM app WHERE id = '$id'");
    return mysqli_affected_rows($mysqli);
}
function hapusprice($id, $mysqli)
{
    mysqli_query($mysqli, "DELETE FROM price WHERE app = '$id'");
    return mysqli_affected_rows($mysqli);
}
function hapusrek($id, $mysqli)
{
    mysqli_query($mysqli, "DELETE FROM trx WHERE id = '$id'");
    return mysqli_affected_rows($mysqli);
}
