<?php
session_start();
include '../akses.php';
include '../koneksi.php';
include '../function.php';
include '../layout/header.php';
$result = mysqli_query($mysqli, "SELECT * FROM `app` ORDER BY `id` ASC");
$no = 1;
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4" style="margin-bottom: 50px;">
            <h1 class="mt-4">Aplikasi</h1>
            <ol class="breadcrumb mb-4">
                <a href="" class=" btn btn-primary modalApp" data-toggle="modal" data-target="#modalApp">Tambah Aplikasi</a>
            </ol>
            <table class="table table-bordered table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Harga</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= strtoupper($data['app']) ?></td>
                            <td><?= $data['idapp'] ?></td>
                            <td><?= price($data['idapp'], $mysqli) ?></td>
                            <td>
                                <a href="" class="btn btn-primary btn-circle btn-sm modalAppEdit" data-toggle="modal" data-id="<?= $data['id'] ?>" data-kode="<?= $data['idapp'] ?>" data-app="<?= $data['app'] ?>" data-harga="<?= price($data['idapp'], $mysqli) ?>" data-target="#modalAppEdit">
                                    <i class=" fas fa-edit"></i>
                                </a>
                                <a href="delete.php?id=<?= $data['id']; ?>&app=<?= $data['idapp'] ?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin ingin menghapus ?')">
                                    <i class=" fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<div class="modal fade" id="modalApp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Tambah Aplikasi</h5>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <h6>Nama Aplikasi</h6>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="nama" name="nama" type="text" />
                        <label for="">Aplikasi</label>
                    </div>
                    <?php
                    $qq = mysqli_query($mysqli, "SELECT max(idapp) as maxkode FROM app");
                    $result = mysqli_fetch_array($qq);
                    $maxkode = $result['maxkode'];
                    $no = (int) substr($maxkode, -2);
                    $ap = "APP";
                    $no++;
                    $jadi = $ap . sprintf("%05s", $no);
                    ?>
                    <h6>Kode Aplikasi</h6>
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control" id="kode" name="kode" type="text" readonly value="<?= $jadi ?>" />
                        <label for="">Kode Aplikasi</label>
                    </div>
                    <h6>Harga</h6>
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control" id="harga" name="harga" type="text" />
                        <label for="">Harga</label>
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
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $kode = $_POST['kode'];
    $app = mysqli_query($mysqli, "INSERT INTO app (id, app, idapp) VALUES ('', '$nama', '$kode')");

    if ($app) {
        mysqli_query($mysqli, "INSERT INTO price(id, harga, app) VALUES ('', '$harga', '$kode')");
        echo "
			<script>
				alert('Data Berhasil Ditambahkan!');
                document.location.href = 'index.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('Data Gagal Ditambahkan!');
                document.location.href = 'index.php';
			</script>
		";
    }
}
?>
<div class="modal fade" id="modalAppEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Edit Aplikasi</h5>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <h6>Nama Aplikasi</h6>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="namaEdit" name="namaEdit" type="text" />
                        <label for="">Aplikasi</label>
                    </div>
                    <h6>Kode Aplikasi</h6>
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control" id="kodeEdit" name="kodeEdit" type="text" readonly />
                        <label for="">Kode Aplikasi</label>
                    </div>
                    <h6>Harga</h6>
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control" id="hargaEdit" name="hargaEdit" type="text" />
                        <label for="">Harga</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit" name="edit" id="edit" value="Edit">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['namaEdit'];
    $harga = $_POST['hargaEdit'];
    $kode = $_POST['kodeEdit'];
    $app = mysqli_query($mysqli, "UPDATE app SET id = '$id', app = '$nama', idapp = '$kode' WHERE id = '$id'");

    if ($app) {
        mysqli_query($mysqli, "UPDATE price SET harga = '$harga', app = '$kode' WHERE app = '$kode'");
        echo "
			<script>
				alert('Data Berhasil Diubah!');
                document.location.href = 'index.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('Data Gagal Diubah!');
                document.location.href = 'index.php';
			</script>
		";
    }
}
?>
<?php include '../layout/footer.php' ?>