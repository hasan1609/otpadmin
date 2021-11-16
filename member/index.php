<?php
session_start();
include '../akses.php';
include '../koneksi.php';
include '../function.php';
include '../layout/header.php';
$result = mysqli_query($mysqli, "SELECT * FROM `user` ORDER BY `id` DESC");
$no = 1;
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4" style="margin-bottom: 50px;">
            <h1 class="mt-4">Member</h1>
            <br>
            <table class="table table-bordered table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Saldo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= strtoupper($data['nama']) ?></td>
                            <td><?= $data['username'] ?></td>
                            <td><?= $data['email'] ?></td>
                            <td>Rp. <?= number_format($data['saldo'], 2, ',', '.') ?></td>
                            <td>
                                <?php
                                if ($data['aktif'] == 0) {
                                    echo '<i class="fas fa-spinner"></i>';
                                } else {
                                    echo '<i class="fas fa-check-circle"></i>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<?php include '../layout/footer.php' ?>