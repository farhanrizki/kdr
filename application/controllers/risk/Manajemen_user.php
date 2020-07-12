<?php 
     
class Manajemen_user extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model('risk/m_manajemen_risk');
		$level_kdr    = $this->session->userdata('level_kdr');
		$level_monica = $this->session->userdata('level_monica');

        if($level_kdr == "superadmin")
        {
            $id_user           = $this->session->userdata('id_user');
            $nama_lengkap_risk = $this->session->userdata('nama_lengkap_kdr');
            $username_risk     = $this->session->userdata('username_kdr');
            $level_risk        = $this->session->userdata('level_kdr');
            $nama_bagian_risk  = $this->session->userdata('nama_bagian_kdr');
            $status_risk       = "login";

            $this->data_array = array(
                'id_user'           => $id_user,
                'nama_lengkap_risk' => $nama_lengkap_risk,
                'username_risk'     => $username_risk,
                'level_risk'        => $level_risk,
                'nama_bagian_risk'  => $nama_bagian_risk,
                'status_risk'       => $status_risk
            );
            if($status_risk != "login" || $level_risk != "superadmin")
            {
                redirect(base_url("risk/dashboard_risk"));
            }
        }
        else if($level_monica == "superadmin")
        {
            $id_user           = $this->session->userdata('id_user');
            $nama_lengkap_risk = $this->session->userdata('nama_lengkap_monica');
            $username_risk     = $this->session->userdata('username_monica');
            $level_risk        = $this->session->userdata('level_monica');
            $nama_bagian_risk  = $this->session->userdata('nama_bagian_monica');
            $status_risk       = "login";

            $this->data_array = array(
                'id_user'           => $id_user,
                'nama_lengkap_risk' => $nama_lengkap_risk,
                'username_risk'     => $username_risk,
                'level_risk'        => $level_risk,
                'nama_bagian_risk'  => $nama_bagian_risk,
                'status_risk'       => $status_risk
            );
            if($status_risk != "login" || $level_risk != "superadmin")
            {
                redirect(base_url("risk/dashboard_risk"));
            }
        }
        else
        {
            $id_user           = $this->session->userdata('id_user');
            $nama_lengkap_risk = $this->session->userdata('nama_lengkap_risk');
            $username_risk     = $this->session->userdata('username_risk');
            $level_risk        = $this->session->userdata('level_risk');
            $nama_bagian_risk  = $this->session->userdata('nama_bagian_risk');
            $status_risk       = "login";

            $this->data_array = array(
                'id_user'           => $id_user,
                'nama_lengkap_risk' => $nama_lengkap_risk,
                'username_risk'     => $username_risk,
                'level_risk'        => $level_risk,
                'nama_bagian_risk'  => $nama_bagian_risk,
                'status_risk'       => $status_risk
            );
            if($status_risk != "login" || $level_risk != "superadmin")
            {
                redirect(base_url("risk/dashboard_risk"));
            }
        }
    }

    public function index()
    {
    	if(isset($_POST['tambahuser']))
        {
            $this->tambah_user_risk();
        }
        else if(isset($_POST['updateuseraktif']))
        {
            $this->update_user_aktif();
        }
        else if(isset($_POST['hapususeraktif']))
        {
            $this->hapus_user_aktif();
        }
        else if(isset($_POST['updateusernonaktif']))
        {
            $this->update_user_nonaktif();
        }
        else if(isset($_POST['hapususernonaktif']))
        {
            $this->hapus_user_nonaktif();
        }
        else
        {
            $data                       = $this->data_array;
            $data['user_risk_aktif']    = $this->m_manajemen_risk->user_risk_aktif();
            $data['user_risk_nonaktif'] = $this->m_manajemen_risk->user_risk_nonaktif();
	    	$this->load->view('risk/v_header_risk', $data);
	    	$this->load->view('risk/v_manajemenUser', $data); 
	    	$this->load->view('risk/v_footer_risk');
    	}
    }

    public function tambah_user_risk()
    {
        $nama_lengkap               = $this->input->post('nama_lengkap');
        $username                   = strtolower($this->input->post('username'));
        $password                   = sha1(md5($this->input->post('password')));
        $level                      = $this->input->post('level');
        $status                     = 1;
        $nama_bagian                = $this->input->post('nama_bagian');
        $untuk_web                  = $this->input->post('untuk_web');
        $cek_user                   = $this->m_manajemen_risk->cek_user($username);
        $data                       = $this->data_array;
        $data['user_risk_aktif']    = $this->m_manajemen_risk->user_risk_aktif();
        $data['user_risk_nonaktif'] = $this->m_manajemen_risk->user_risk_nonaktif();
        $this->load->view('risk/v_header_risk', $data);

        if(!$cek_user)
        {
            $simpan = $this->m_manajemen_risk->tambah_user_risk($nama_lengkap,$username,$password,$level,$status,$nama_bagian,
                      $untuk_web);
            if($simpan)
            {
                $data['user_risk_aktif']    = $this->m_manajemen_risk->user_risk_aktif();
                $data['user_risk_nonaktif'] = $this->m_manajemen_risk->user_risk_nonaktif();
                $data['berhasil_simpan']    = '<div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <p style="font-weight:bold;">Username berhasil ditambahkan</p>
                                              </div>';
                $this->load->view('risk/v_manajemenUser', $data); 
            }
            else
            {
                $data['gagal_simpan'] = '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Username gagal ditambahkan</p>
                                        </div>';
                $this->load->view('risk/v_manajemenUser', $data);
            }
        }
        else 
        {
            $data['duplicate_user'] = '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Username telah terdaftar, gunakan username lain !</p>
                                        </div>';  
            $this->load->view('risk/v_manajemenUser', $data);
        }
            
        $this->load->view('risk/v_footer_risk');
    }

    public function update_user_aktif()
    {
        $id_user                    = $this->input->post('id_user');
        $nama_lengkap               = $this->input->post('nama_lengkap');
        $level                      = $this->input->post('level');
        $status                     = $this->input->post('status');
        $nama_bagian                = $this->input->post('nama_bagian');
        $untuk_web                  = $this->input->post('untuk_web');
        $password_baru              = $this->input->post('password_baru');
        $password_encrypt           = sha1(md5($this->input->post('password_baru', TRUE)));
        $data                       = $this->data_array;
        $data['user_risk_aktif']    = $this->m_manajemen_risk->user_risk_aktif();
        $data['user_risk_nonaktif'] = $this->m_manajemen_risk->user_risk_nonaktif();

        for ($i = 0; $i < count($id_user); $i++) 
        {
            $id          = $id_user[$i];
            $level       = $level[$id];
            $status      = $status[$id];  
            $nama_bagian = $nama_bagian[$id];
            $untuk_web   = $untuk_web[$id]; 
            $update      = $this->m_manajemen_risk->update_user_risk_aktif($id,$nama_lengkap,$level,$status,$nama_bagian,
                           $untuk_web,$password_baru,$password_encrypt);
        }

        $this->load->view('risk/v_header_risk', $data);
        if($update)
        {
            $data                       = $this->data_array;
            $data['user_risk_aktif']    = $this->m_manajemen_risk->user_risk_aktif();
            $data['user_risk_nonaktif'] = $this->m_manajemen_risk->user_risk_nonaktif();
            $data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">User RISK berhasil diupdate</p>
                                        </div>';
            $this->load->view('risk/v_manajemenUser', $data); 
        }
        else
        {
            $data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">User RISK gagal diupdate</p>
                                    </div>';
            $this->load->view('risk/v_manajemenUser', $data);
        }
        $this->load->view('risk/v_footer_risk');
    }

    public function hapus_user_aktif()
    {
        $id_user                    = $this->input->post('id_user');
        $hapus                      = $this->m_manajemen_risk->hapus_user_risk_aktif($id_user);
        $data                       = $this->data_array;
        $data['user_risk_aktif']    = $this->m_manajemen_risk->user_risk_aktif();
        $data['user_risk_nonaktif'] = $this->m_manajemen_risk->user_risk_nonaktif();
        $this->load->view('risk/v_header_risk', $data);
        if($hapus)
        {
            $data['berhasil_hapus'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Username telah di hapus</p>
                                        </div>';
            $this->load->view('risk/v_manajemenUser', $data); 
        }
        else
        {
            $data['gagal_hapus'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Username gagal di hapus</p>
                                    </div>';
            $this->load->view('risk/v_manajemenUser', $data);
        }
        $this->load->view('risk/v_footer_risk');
    }

    public function update_user_nonaktif()
    {
        $id_user                    = $this->input->post('id_user');
        $nama_lengkap               = $this->input->post('nama_lengkap');
        $level                      = $this->input->post('level');
        $status                     = $this->input->post('status');
        $nama_bagian                = $this->input->post('nama_bagian');
        $untuk_web                  = $this->input->post('untuk_web');
        $password_baru              = $this->input->post('password_baru');
        $password_encrypt           = sha1(md5($this->input->post('password_baru', TRUE)));
        $data                       = $this->data_array;
        $data['user_risk_aktif']    = $this->m_manajemen_risk->user_risk_aktif();
        $data['user_risk_nonaktif'] = $this->m_manajemen_risk->user_risk_nonaktif();

        for ($i = 0; $i < count($id_user); $i++) 
        {
            $id          = $id_user[$i];
            $level       = $level[$id];
            $status      = $status[$id];  
            $nama_bagian = $nama_bagian[$id];
            $untuk_web   = $untuk_web[$id]; 
            $update      = $this->m_manajemen_risk->update_user_risk_nonaktif($id,$nama_lengkap,$level,$status,$nama_bagian,
                           $untuk_web,$password_baru,$password_encrypt);
        }

        $this->load->view('risk/v_header_risk', $data);
        if($update)
        {
            $data                       = $this->data_array;
            $data['user_risk_aktif']    = $this->m_manajemen_risk->user_risk_aktif();
            $data['user_risk_nonaktif'] = $this->m_manajemen_risk->user_risk_nonaktif();
            $data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">User RISK berhasil diupdate</p>
                                        </div>';
            $this->load->view('risk/v_manajemenUser', $data); 
        }
        else
        {
            $data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">User RISK gagal diupdate</p>
                                    </div>';
            $this->load->view('risk/v_manajemenUser', $data);
        }
        $this->load->view('risk/v_footer_risk');
    }

    public function hapus_user_nonaktif()
    {
        $id_user                    = $this->input->post('id_user');
        $hapus                      = $this->m_manajemen_risk->hapus_user_risk_nonaktif($id_user);
        $data                       = $this->data_array;
        $data['user_risk_aktif']    = $this->m_manajemen_risk->user_risk_aktif();
        $data['user_risk_nonaktif'] = $this->m_manajemen_risk->user_risk_nonaktif();
        $this->load->view('risk/v_header_risk', $data);
        if($hapus)
        {
            $data['berhasil_hapus'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Username telah di hapus</p>
                                        </div>';
            $this->load->view('risk/v_manajemenUser', $data); 
        }
        else
        {
            $data['gagal_hapus'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Username gagal di hapus</p>
                                    </div>';
            $this->load->view('risk/v_manajemenUser', $data);
        }
        $this->load->view('risk/v_footer_risk');
    }
}