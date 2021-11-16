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
            <h1 class="mt-4">Mesin</h1>
            <ol class="breadcrumb mb-4">
                <a href="" class=" btn btn-primary modalMesin" data-toggle="modal" data-target="#modalMesin">Tambah Mesin</a>
            </ol>
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM `mesin` WHERE `user` LIKE '" . $user . "'");
            $no = 1;
            if ($result->num_rows > 0) {
                // output data of each row
            ?>
                <div class="row">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="col-xl-2 col-md-3 col-sm-2">
                            <div class="card border-primary mb-4">
                                <a class="small text-black" href="detail.php?id=<?= $row['mesin'] ?>" style="text-decoration: none;">
                                    <div class="card-header text-white" style="background-color: #0d6efd;"><strong><?= $row['mesin'] ?></strong></div>
                                    <div class="card-body text-primary">
                                        <h6 class="card-text">Detail &emsp; &emsp; &emsp;&emsp;<i class="fas fa-angle-right"></i></h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php
            } else {
                echo "<h4>Maaf Masih Belum Ada Mesin</h4>";
            } ?>
        </div>
    </main>
</div>

<div class="modal fade" id="modalMesin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Tambah Mesin</h5>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <h6>Username</h6>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="username" name="username" type="text" />
                        <label for="">Masukkan Username</label>
                    </div>
                    <h6>Password</h6>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="password" name="password" type="text" />
                        <label for="">Masukkan Password</label>
                    </div>
                    <h6>Port</h6>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="port" name="port" type="number" />
                        <label for="">Jumlah Port</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit" name="add" id="add" value="Add">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST['add'])) {
    $username = $_POST['username'];
    $jadi = $user . "_" . $username;
    $password = $_POST['password'];
    $pp = $_POST['port'];
    $cc = $_POST['port'] + 1;
    $query = mysqli_query($mysqli, "INSERT INTO `mesin` (`nama`, `mesin`, `paswd`, `port`, `user`) VALUES ('" . $username . "', '" . $jadi . "', '" . $password . "', '" . $pp . "','$user')");
    if ($query) {
        for ($i = 1; $i < $cc; $i++) {
            mysqli_query($mysqli, "INSERT INTO `nomor` (`id`, `nomor`, `operator`, `mesin`, `port`, `app`, `status`) VALUES (NULL, NULL, NULL, '$jadi', '$i', NULL, '0')");
        }
        echo "
			<script>
				alert('Data Berhasil Ditambah!');
                document.location.href = 'index.php';
			</script>
		";
    } else {
        echo "
			<script>
            alert('Data Gagal Ditambah!');
            document.location.href = 'index.php';
			</script>
		";
    }
}
?>

<?php include '../layout/footer.php' ?>