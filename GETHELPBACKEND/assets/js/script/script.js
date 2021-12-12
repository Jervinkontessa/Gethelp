$(document).on('click', '#ubah-btn', function(){
    $('.modal-body #user_id').val($(this).data('id'));
    $('.modal-body #verifikasi').val($(this).data('verifikasi'));
    $('.modal-body #oldverifikasi').val($(this).data('oldverifikasi')); 
    $('.modal-body #namauser').val($(this).data('nama'));
    $('.modal-body #emailuser').val($(this).data('email'));
    $('.modal-body #status').val($(this).data('status')); 
});


$(document).on('click', '#btndetailreport', function(){
    $('.modal-body #nmc').val($(this).data('campaign'));
    $('.modal-body #emailpelapor').val($(this).data('email'));
    $('.modal-body #nohppelapor').val($(this).data('nohp'));
    $('.modal-body #namapelapor').val($(this).data('pelapor'));
    $('.modal-body #kategorilaporan').val($(this).data('kategori'));
    $('.modal-body #detail').val($(this).data('detail'));
    $('.modal-body #download-btn').attr('href', $(this).data('foto'))
});


