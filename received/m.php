<?php
include 'koneksi.php';
include 'function.php';
preg_match_all('!\d+!', $_GET['port'], $ports);
$port = $ports[0][0];
if (empty($_GET)) {
    echo 'kontol';
} else {

    $mesin = mysqli_query($mysqli, "SELECT * FROM `mesin` WHERE `mesin` LIKE '" . $_GET['username'] . "' AND `paswd` LIKE '" . $_GET['password'] . "'");

    $uu = $mesin->fetch_assoc();

    if (empty($uu)) {
    } else {





        $op = getcodeop($_GET['receiver'], $mysqli);
        $ass = getcodeapp($_GET['sender'], $_GET['content'], $mysqli);




        $mesin1 = mysqli_query($mysqli, "SELECT * FROM `nomor` WHERE `mesin` LIKE '$_GET[username]' AND `port` = '$port'");

        $uuu = $mesin1->fetch_assoc();

        //print_r($uuu);

        if (empty($uuu['nomor'])) {


            $a = mysqli_query($mysqli, "UPDATE `nomor` SET `nomor` = '$_GET[receiver]', `status` = '1', `operator` = '$op', `app` = '' WHERE `nomor`.`id` = '$uuu[id]'");
            if ($a) {
                $upno =    mysqli_query($mysqli, "INSERT INTO `inbox` (`id_inbox`, `nomor_i`, `sender`, `sms`, `app_i`, `mesin`, `port`) VALUES (NULL, '" . $_GET['receiver'] . "', '" . $_GET['sender'] . "', '" . $_GET['content'] . "', '" . $ass . "', '" . $_GET['username'] . "', '" . $port . "')");
                if ($upno) {
                    $m = mysqli_query($mysqli, "SELECT * FROM `order` WHERE `nomor` LIKE '$_GET[receiver]' AND `operator` LIKE '$op' AND `app` LIKE '$ass'");
                    $u = $m->fetch_assoc();
                    mysqli_query($mysqli, "UPDATE `order` SET `status` = '1' WHERE `order`.`id_order` = '$u[id_order]'");
                }
            }
        } elseif ($uuu['nomor'] != $_GET['receiver']) {
            //CEK TRASH DULU >> JIKA NOMOR ADA DI TRASH MAKA STATUS PORT JADI 3 DAN UPDATE NOMOR, JIKA TIDAK ADA LAKUKAN UPDATE NOMOR (FUNCTION DI BAWAH)
            $b = mysqli_query($mysqli, "UPDATE `nomor` SET `nomor` = '$_GET[receiver]',`status` = '1', `operator` = '$op', `app` = '' WHERE `nomor`.`id` = '$uuu[id]'");

            if ($b) {

                $upno = mysqli_query($mysqli, "INSERT INTO `inbox` (`id_inbox`, `nomor_i`, `sender`, `sms`, `app_i`, `mesin`, `port`) VALUES (NULL, '" . $_GET['receiver'] . "', '" . $_GET['sender'] . "', '" . $_GET['content'] . "', '" . $ass . "', '" . $_GET['username'] . "', '" . $port . "')");
                if ($upno) {
                    $m = mysqli_query($mysqli, "SELECT * FROM `order` WHERE `nomor` LIKE '$_GET[receiver]' AND `operator` LIKE '$op' AND `app` LIKE '$ass'");
                    $u = $m->fetch_assoc();

                    mysqli_query($mysqli, "UPDATE `order` SET `status` = '1' WHERE `order`.`id_order` = '$u[id_order]'");
                }
            }
        } elseif (!empty($uuu['nomor'] && $uuu['mesin'] == $_GET['username'] && $port == $uuu['port'])) {


            $cc = mysqli_query($mysqli, "SELECT * FROM `inbox` WHERE `nomor_i` LIKE '$_GET[receiver]' AND `app_i` LIKE '$ass' AND `mesin` LIKE '$_GET[username]' AND `port` LIKE '$port'");
            $ccc = $cc->fetch_assoc();

            if (empty($ccc)) {

                $upno =    mysqli_query($mysqli, "INSERT INTO `inbox` (`id_inbox`, `nomor_i`, `sender`, `sms`, `app_i`, `mesin`, `port`) VALUES (NULL, '" . $_GET['receiver'] . "', '" . $_GET['sender'] . "', '" . $_GET['content'] . "', '" . $ass . "', '" . $_GET['username'] . "', '" . $port . "')");
                if ($upno) {
                    $m = mysqli_query($mysqli, "SELECT * FROM `order` WHERE `nomor` LIKE '$_GET[receiver]' AND `operator` LIKE '$op' AND `app` LIKE '$ass'");
                    $u = $m->fetch_assoc();
                    mysqli_query($mysqli, "UPDATE `order` SET `status` = '1' WHERE `order`.`id_order` = '$u[id_order]'");
                }
            } else {

                mysqli_query($mysqli, "UPDATE `inbox` SET `sms` = '$_GET[content]' WHERE `inbox`.`id_inbox` = '$ccc[id_inbox]'");
            }
        }
    }
    $req_dump = print_r($_REQUEST, TRUE);
    $fp = fopen('request.log', 'a');
    fwrite($fp, $req_dump);
    fclose($fp);
}
