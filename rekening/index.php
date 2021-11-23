<?php
session_start();
include '../akses.php';
include '../koneksi.php';
include '../function.php';
include '../layout/header.php';
$result = mysqli_query($mysqli, "SELECT * FROM `trx` ORDER BY `id` DESC");
$no = 1;
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4" style="margin-bottom: 50px;">
            <h1 class="mt-4">Rekening</h1>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahrekening"> Tambah Rekening</a> <br>
            <br>
            <table class="table table-bordered table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bank</th>
                        <th>Atas Nama</th>
                        <th>No rekening</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= strtoupper($data['bank']) ?></td>
                            <td><?= $data['ats_nama'] ?></td>
                            <td><?= $data['rek'] ?></td>
                            <td>
                                <a href="" class="modalRekEdit" data-toggle="modal" data-id="<?= $data['id'] ?>" data-nama="<?= $data['ats_nama'] ?>" data-rek="<?= $data['rek'] ?>" data-bank="<?= $data['bank'] ?>" data-target="#modalRekEdit"><i class="far fa-edit"></i></a>
                                <a href="delete.php?id=<?= $data['id']; ?>" onclick="return confirm('Yakin ingin menghapus ?')">
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

<div class="modal fade" id="tambahrekening" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Tambah Rekening</h5>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <h6>Atas Nama</h6>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="nama" name="nama" type="text" />
                        <label for="">Masukkan atas nama bank</label>
                    </div>
                    <h6>Nama Bank</h6>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="bank" name="bank" type="text" />
                        <label for="">Masukkan Nama Bank</label>
                    </div>
                    <h6>No. Rekening</h6>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="rek" name="rek" type="number" />
                        <label for="">Masukkan Nomor Rekening</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input class="btn btn-primary" type="submit" name="addrek" id="addrek" value="Tambah">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['addrek'])) {
    $nama = $_POST['nama'];
    $bank = $_POST['bank'];
    $rek = $_POST['rek'];
    $app = mysqli_query($mysqli, "INSERT INTO trx (id, ats_nama, bank, rek) VALUES ('', '$nama', '$bank', '$rek')");

    if ($app) {
        echo "
			<script>
				alert('Rekening Berhasil Ditambahkan!');
                document.location.href = 'index.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('Rekening Gagal Ditambahkan!');
                document.location.href = 'index.php';
			</script>
		";
    }
}
?>
<div class="modal fade" id="modalRekEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Edit Rekening</h5>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <h6>Atas Nama</h6>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="namaEdit" name="namaEdit" type="text" />
                        <label for="">Masukkan atas nama bank</label>
                    </div>
                    <h6>Nama Bank</h6>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="bankEdit" name="bankEdit" type="text" />
                        <label for="">Masukkan Nama Bank</label>
                    </div>
                    <h6>No. Rekening</h6>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="rekEdit" name="rekEdit" type="number" />
                        <label for="">Masukkan Nomor Rekening</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input class="btn btn-primary" type="submit" name="editrek" id="editrek" value="Edit">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST['editrek'])) {
    $id = $_POST['id'];
    $nama = $_POST['namaEdit'];
    $bank = $_POST['bankEdit'];
    $rek = $_POST['rekEdit'];
    $app = mysqli_query($mysqli, "UPDATE trx SET id = '$id', ats_nama = '$nama', bank = '$bank', rek = '$rek' WHERE id = '$id'");

    if ($app) {
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