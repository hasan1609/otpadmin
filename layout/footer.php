</div>
<script src="../vendor/js/scripts.js"></script>
<script src="../vendor/assets/demo/chart-area-demo.js"></script>
<script src="../vendor/assets/demo/chart-bar-demo.js"></script>
<script src="../vendor/js/datatables-simple-demo.js"></script>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../vendor/lightbox/js/lightbox.min.js"></script>

<script>
    $('.modalInbox').on('click', function() {
        var id = $(this).data('id');

        $.ajax({
            type: 'GET',
            url: 'sms.php',
            data: 'id=' + id,
            success: function(data) {
                $('.modal-body').html(data);
            }
        })
    })
</script>
<!-- Modal Edit App -->
<script>
    $('.modalAppEdit').on('click', function() {
        var id = $(this).data('id');
        var kode = $(this).data('kode');
        var app = $(this).data('app');
        var harga = $(this).data('harga');

        $('.modal-body #id').val(id);
        $('.modal-body #kodeEdit').val(kode);
        $('.modal-body #namaEdit').val(app);
        $('.modal-body #hargaEdit').val(harga);
    })
</script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
</body>

</html>