<?php
session_start();
include '../akses.php';
include '../koneksi.php';
include '../function.php';
include '../layout/header.php';
$user = $_SESSION['username_admin'];
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4" style="margin-bottom: 50px;">
            <h3 class="mt-4">Mesin <?= $_GET['id'] ?></h3>
            <ol class="breadcrumb mb-2">
                <h5>Port</h5>
            </ol>
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM `nomor` WHERE `mesin` LIKE '$_GET[id]'");
            $no = 1;
            if ($result->num_rows > 0) {
                // output data of each row
            ?>
                <div class="row">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="col-xl-1 col-md-1 col-sm-1">
                            <div class="card border-primary mb-4">
                                <a class="small text-black text-center" href="port_detail.php?id=<?= $row['port'] . "&mesin=" . $_GET['id'] ?>" style="text-decoration: none;">
                                    <?php if ($row['status'] == 0) {

                                        $hara = "#ff0000";
                                        //blokir

                                    } elseif ($row['status'] == 1) {
                                        $hara = "#0d6efd";
                                        //ready

                                    } elseif ($row['status'] == 2) {
                                        $hara = "#ffff1a";

                                        //penuh
                                    } elseif ($row['status'] == 3) {
                                        $hara = "#ffffff";

                                        //blokir
                                    } else {

                                        $hara = "#a3a3c2";
                                        //nomor tidak ada
                                    }

                                    ?>
                                    <div class="card-header text-white" style="background-color:<?= $hara ?> ;"><strong><?= $row['port'] ?></strong></div>
                                </a>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            <?php
            } ?>
        </div>
    </main>
</div>
<?php include '../layout/footer.php' ?>