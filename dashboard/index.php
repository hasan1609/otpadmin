<?php
session_start();
include '../akses.php';
include '../koneksi.php';
include '../function.php';
include '../layout/header.php';
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4" style="margin-bottom: 50px;">
            <h1 class="mt-4">Dashboard</h1>
            <br>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body"><strong><i class="fas fa-user"></i>&emsp; Member</strong></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <?php
                            $user = mysqli_query($mysqli, "SELECT COUNT(id) AS hasil FROM `user`");
                            $us = $user->fetch_assoc();
                            ?>
                            <a class="small text-white stretched-link" href="../member/index.php" style="text-decoration: none;"><strong>Jumlah :&emsp;<?= $us['hasil']; ?></strong></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body"><strong><i class="fab fa-android"></i>&emsp; Aplikasi</strong></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <?php
                            $aplikasi = mysqli_query($mysqli, "SELECT COUNT(idapp) AS hasil FROM app");
                            $app = $aplikasi->fetch_assoc();
                            ?>
                            <a class="small text-white stretched-link" href="../app/index.php" style="text-decoration: none;"><strong>Jumlah :&emsp;<?= $app['hasil']; ?></strong></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body"><strong><i class="fab fa-android"></i>&emsp; Order</strong></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <?php
                            $order = mysqli_query($mysqli, "SELECT COUNT(id_order) AS hasil FROM `order`");
                            $od = $order->fetch_assoc();
                            ?>
                            <a class="small text-white stretched-link" href="../order/index.php" style="text-decoration: none;"><strong>Jumlah :&emsp;<?= $od['hasil']; ?></strong></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body"><strong><i class="fab fa-android"></i>&emsp; Deposit</strong></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <?php
                            $deposit = mysqli_query($mysqli, "SELECT SUM(saldo) AS hasil FROM `history` WHERE accept = 1");
                            $dp = $deposit->fetch_assoc();
                            ?>
                            <a class="small text-white stretched-link" href="../deposit/index.php" style="text-decoration: none;"><strong>Total :&emsp;<?= $dp['hasil']; ?></strong></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary text-white mb-4">
                        <div class="card-body"><strong><i class="fab fa-android"></i>&emsp; Pendapatan</strong></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <?php
                            $hasil = mysqli_query($mysqli, "SELECT SUM(harga) AS dapat FROM `order` WHERE status = '1'");
                            $hs = $hasil->fetch_assoc();
                            ?>
                            <a class="small text-white stretched-link" href="../order/index.php" style="text-decoration: none;"><strong>Total :&emsp;<?= $hs['dapat']; ?></strong></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>


<?php include '../layout/footer.php' ?>