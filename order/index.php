<?php
session_start();
include '../akses.php';
include '../koneksi.php';
include '../function.php';
include '../layout/header.php';
$user = $_SESSION['username_admin'];

$no = 1;
$tz = 'Asia/Jakarta';
$dt = new DateTime("now", new DateTimeZone($tz));
$timestamp = $dt->format('Y-m-d H:i:s');
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4" style="margin-bottom: 50px;">
            <h1 class="mt-4">Order</h1>
            <ol class="breadcrumb mb-4">
            </ol>
            <div class="table-responsive p-3">
                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Operator</th>
                            <th>Nomor</th>
                            <th>Kode Otp</th>
                            <th>Status</th>
                            <th>SMS</th>
                        </tr>
                    </thead>
                    <?php
                    // SELECT * FROM `order` LEFT OUTER JOIN `inbox` ON `order`.`nomor` = `inbox`.`nomor` AND `order`.`app` = `inbox`.`app` WHERE `order`.`user` = 'hasan' AND `order`.`app` = 'APP00001'
                    $query = mysqli_query($mysqli, "SELECT * FROM `order` LEFT OUTER JOIN `inbox` ON `order`.`nomor` = `inbox`.`nomor_i` AND `order`.`app` = `inbox`.`app_i`");
                    while ($row = $query->fetch_assoc()) {
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= getop($row['operator'], $mysqli) ?></td>
                                <td><?= $row['nomor']; ?></td>
                                <td><?= otp($row["nomor"], $row["app"], $mysqli) ?></td>
                                <td>
                                    <?php
                                    if ($row['status'] == "1") {
                                        echo '<i class="fa fa-check"></i>';
                                    } elseif ($row['status'] == "0") {
                                        echo '<i class="fa fa-clock"></i>';
                                    } elseif ($row['status'] == "2") {
                                        echo '<i class="fa fa-window-close"></i>';
                                    } elseif ($row['status'] == "3") {
                                        echo '<i class="fa fa-window-close"></i>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($row['id_inbox'] != "") {
                                        echo '
                                    <a href="" class=" btn btn-primary modalInbox" data-toggle="modal" data-id="' . $row['id_inbox'] . '" data-target="#modalInbox"><i class=" fa fa-eye"></i>View</a>
                                    ';
                                    } else {
                                        echo '
                                    <a href="" class=" btn btn-primary modalInbox" data-toggle="modal" data-id="MAAF MASIH BELUM ADA INBOX!!!!" data-target="#modalInbox"><i class=" fa fa-eye"></i>View</a>
                                    ';
                                    }
                                    ?>
                                </td>
                        </tbody>
                    <?php } ?>

                </table>
            </div>
        </div>
    </main>
</div>
<div class="modal fade" id="modalInbox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Isi Pesan</h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<?php include '../layout/footer.php' ?>