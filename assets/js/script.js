$(function () {
    //create currency formatter
    let formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'IDR'
    });

    // script untuk datepicker
    $('.datepicker-exec').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true
    });

    //transaksi pemasukan========================================================================================================

    //ajax untuk kembalikan tampilan tambah pemasukan
    $('#tambahPemasukan').on('click', function () {
        $('#newTransModalLabel').html('Tambah Pemasukan Baru');
        $('.modal-footer button[type=submit]').html('Tambah');
        $('.modal-footer button[type=submit]').attr('class', 'btn btn-primary');
        let date = new Date();
        let tanggal = date.getDate();
        let bulan = date.getMonth() + 1;
        let tahun = date.getFullYear();
        $('#tanggal').val(tanggal + '/' + bulan + '/' + tahun);
        $('#jumlah').val('');
        $('#keterangan').val('');
        $('#terimaDari').val('');
        $('#simpanKe').val('');

    });
    //end of transaksi pemasukan===================================================================================================================

    /*
    // script untuk navigasi
    $('#linkDashboard').on('click', function () {
        // melakukan submit ketika klik tombol navigasi
        $('#form-to-dashboard').submit();
    });
    $('#linkPemasukan').on('click', function () {
        // melakukan submit ketika klik tombol navigasi
        $('#form-to-pemasukan').submit();
    });
    */


});
