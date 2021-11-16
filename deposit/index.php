<?php
session_start();
include '../akses.php';
include '../koneksi.php';
include '../function.php';
include '../layout/header.php';
$user = $_SESSION['username_admin'];
$result = mysqli_query($mysqli, "SELECT * FROM `history` ORDER BY `id` DESC");
$no = 1;
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4" style="margin-bottom: 50px;">
            <h1 class="mt-4">Deposit</h1>
            <br>
            <table class="table table-bordered table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Username</th>
                        <th>Nama Bank</th>
                        <th>Jumlah</th>
                        <th>Bukti Transaksi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                    <tbody>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['date'] ?></td>
                            <td><?= $data['user'] ?></td>
                            <td><?= strtoupper($data['bank']) ?></td>
                            <td>Rp. <?= number_format($data['saldo'], 2, ',', '.') ?></td>
                            <?php
                            if ($data['ss'] == "KOSONG" or $data['ss'] == "") {
                                echo '<td>BELUM UPLOAD</td>';
                            } else {
                                echo '<td><a class="btn btn-primary" href="http://localhost/bosotp/deposit/' . $data['ss'] . '" data-lightbox="mygalery" data-title="' . strtoupper($user) . '&emsp;' . $data['date'] . '"><i class="fas fa-eye"></i></a></td>';
                            }
                            ?>
                            <?php
                            if ($data["accept"] == 1) {
                                echo '<td><i class="fas fa-check-circle"></i></td>';
                            } elseif ($data["accept"] == 0) {
                                echo "<td><i class='fas fa-spinner'></i></td>";
                            } elseif ($data["accept"] == 2) {
                                echo "<td><i class='fas fa-window-close'></i></td>";
                            }
                            ?>
                            <?php
                            if ($data["accept"] == 0) {
                                echo '<td>
                                <form action="" method="post">
                                    <input type="hidden" value="' . $data['id_trx'] . '" name="id" id="id">
                                    <input type="hidden" value="' . $data['saldo'] . '" name="plus" id="plus">
                                    <input type="hidden" value="' . $data['user'] . '" name="user" id="user">
                                    <button type="submit" class="btn btn-primary" name="acc"><i class=" fas fa-check"></i></button>
                                    <button type="submit" class="btn btn-danger" name="tolak"><i class="fas fa-window-close"></i></button>
                                </form>
                            </td>';
                            } else {
                                echo '<td><strong>SELESAI</strong></td>';
                            }
                            ?>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </main>
</div>
<?php
if (isset($_POST['acc'])) {
    $sql = mysqli_query($mysqli, "UPDATE history SET accept = '1' WHERE id_trx = '$_POST[id]'");
    $jml = mysqli_query($mysqli, "SELECT * FROM user WHERE username = '$_POST[user]'");
    $ss = mysqli_fetch_array($jml);
    $qq = $_POST['plus'] + $ss['saldo'];
    // Prepare statement
    if ($sql) {
        mysqli_query($mysqli, "UPDATE user SET saldo = '$qq' WHERE username = '$_POST[user]'");
        echo "
        <script>
            document.location.href = 'index.php';
        </script>
        ";
    }
} elseif (isset($_POST['tolak'])) {
    $sql = mysqli_query($mysqli, "UPDATE history SET accept = '2' WHERE id_trx = '$_POST[id]'");
    // Prepare statement
    if ($sql) {
        echo "
        <script>
            document.location.href = 'index.php';
        </script>
        ";
    }
}
?>


<?php include '../layout/footer.php' ?>