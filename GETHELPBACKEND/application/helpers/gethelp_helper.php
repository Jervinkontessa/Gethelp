<?php
//untuk admin
function is_logged_in()
{
    $ci = get_instance(); //memanggil fitur ci 
    if (!$ci->session->userdata('admin_data')) {
        redirect('auth');
    }
}

//untuk user
function user_sudah_login()
{
    $ci = get_instance(); //memanggil fitur ci 
    if (!$ci->session->userdata('user_data')) {
        redirect('auth');
    }
}
