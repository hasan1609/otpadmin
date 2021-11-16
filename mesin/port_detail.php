<?php
session_start();
include '../akses.php';
include '../koneksi.php';
include '../function.php';
include '../layout/header.php';
$user = $_SESSION['username_admin'];
?>
<div id="layoutSidenav_content">
    <?php
    $result = mysqli_query($mysqli, "SELECT * FROM `nomor` WHERE `mesin` LIKE '$_GET[mesin]' AND `port` LIKE '$_GET[id]'");
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
    ?>
            <main>
                <div class="container-fluid px-4" style="margin-bottom: 50px;">
                    <h3 class="mt-4">Mesin <?= $_GET['mesin'] ?></h3>
                    <ol class="breadcrumb mb-2">
                        <h5>Port <?= $row['port'] ?></h5>
                    </ol>
                    <div class="row">
                        <div class="table-responsive p-3">
                            <table>
                                <tr>
                                    <td>Aplikasi</td>
                                    <td></td>
                                    <td>:</td>
                                    <td> </td>
                                    <td></td>
                                </tr>
                                <tr></tr>
                            </table>
                        </div>

                    </div>
                </div>
            </main>
        <?php } ?>
    <?php
    } ?>
</div>
<?php include '../layout/footer.php' ?>s