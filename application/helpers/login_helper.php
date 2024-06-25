<?php

function cek_login()
{
    $ci = get_instance();
    if ($ci->session->userdata('email')) {
		if($ci->session->userdata('roles') == 'admin'){
			redirect('admin/');
		}else{
			redirect('user/');
		}
	} else{
        $ci->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akses ditolak. Anda belum login!!</div>');
        redirect('auth');
	}
}

function cek_admin()
{
	$ci = get_instance();
	if ($ci->session->userdata('roles') != 'admin') {
		$ci->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akses ditolak. Anda bukan admin!!</div>');
		redirect('/');
	}
}

?>
