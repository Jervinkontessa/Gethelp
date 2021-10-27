$(document).on('click', '#ubah-btn', function(){
    $('.modal-body #user_id').val($(this).data('id'));
    $('.modal-body #verifikasi').val($(this).data('verifikasi'));
    $('.modal-body #namauser').val($(this).data('nama'));
    $('.modal-body #emailuser').val($(this).data('email'));
    $('.modal-body #status').val($(this).data('status'));
   
})

