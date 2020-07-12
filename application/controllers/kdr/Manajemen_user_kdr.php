<?php 
     
class Manajemen_user_kdr extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model('kdr/m_kdr');
        $level_risk   = $this->session->userdata('level_risk');
        $level_monica = $this->session->userdata('level_monica');

        if($level_risk == "superadmin")
        {
            $id_user          = $this->session->userdata('id_user');
            $nama_lengkap_kdr = $this->session->userdata('nama_lengkap_risk');
            $username_kdr     = $this->session->userdata('username_risk');
            $level_kdr        = $this->session->userdata('level_risk');
            $nama_bagian_kdr  = $this->session->userdata('nama_bagian_risk');
            $status_kdr       = $this->session->userdata('status_risk');

            $this->data_array = array(
                'id_user'          => $id_user,
                'nama_lengkap_kdr' => $nama_lengkap_kdr,
                'username_kdr'     => $username_kdr,
                'level_kdr'        => $level_kdr,
                'nama_bagian_kdr'  => $nama_bagian_kdr,
                'status_kdr'       => $status_kdr
            );

            if($status_kdr != "login" || $level_kdr != "superadmin")
            {
                redirect(base_url("dashboard_kdr"));
            }
        } 
        else if($level_monica == "superadmin")
        {
            $id_user          = $this->session->userdata('id_user');
            $nama_lengkap_kdr = $this->session->userdata('nama_lengkap_monica');
            $username_kdr     = $this->session->userdata('username_monica');
            $level_kdr        = $this->session->userdata('level_monica');
            $nama_bagian_kdr  = $this->session->userdata('nama_bagian_monica');
            $status_kdr       = $this->session->userdata('status_monica');

            $this->data_array = array(
                'id_user'          => $id_user,
                'nama_lengkap_kdr' => $nama_lengkap_kdr,
                'username_kdr'     => $username_kdr,
                'level_kdr'        => $level_kdr,
                'nama_bagian_kdr'  => $nama_bagian_kdr,
                'status_kdr'       => $status_kdr
            );

            if($status_kdr != "login" || $level_kdr != "superadmin")
            {
                redirect(base_url("dashboard_kdr"));
            }
        } 
        else
        {
            $id_user          = $this->session->userdata('id_user');
            $nama_lengkap_kdr = $this->session->userdata('nama_lengkap_kdr');
            $username_kdr     = $this->session->userdata('username_kdr');
            $level_kdr        = $this->session->userdata('level_kdr');
            $nama_bagian_kdr  = $this->session->userdata('nama_bagian_kdr');
            $status_kdr       = $this->session->userdata('status_kdr');

            $this->data_array = array(
                'id_user'          => $id_user,
                'nama_lengkap_kdr' => $nama_lengkap_kdr,
                'username_kdr'     => $username_kdr,
                'level_kdr'        => $level_kdr,
                'nama_bagian_kdr'  => $nama_bagian_kdr,
                'status_kdr'       => $status_kdr
            );

            if($status_kdr != "login" || $level_kdr != "superadmin")
            {
                redirect(base_url("dashboard_kdr"));
            }
        }
    }

    public function index()
    {
        if(isset($_POST['tambahuser']))
        {
            $this->tambah_user_kdr();
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
            $data                      = $this->data_array;
            $data['user_kdr_aktif']    = $this->m_kdr->user_kdr_aktif();
            $data['user_kdr_nonaktif'] = $this->m_kdr->user_kdr_nonaktif();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_manajemenUserKDR', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
    }

    public function tambah_user_kdr()
    {
        $nama_lengkap              = $this->input->post('nama_lengkap');
        $username                  = strtolower($this->input->post('username'));
        $password                  = sha1(md5($this->input->post('password')));
        $level                     = $this->input->post('level');
        $status                    = 1;
        $nama_bagian               = $this->input->post('nama_bagian');
        $untuk_web                 = $this->input->post('untuk_web');
        $cek_user                  = $this->m_kdr->cek_user($username);
        $data                      = $this->data_array;
        $data['user_kdr_aktif']    = $this->m_kdr->user_kdr_aktif();
        $data['user_kdr_nonaktif'] = $this->m_kdr->user_kdr_nonaktif();
        $this->load->view('kdr/v_header_kdr', $data);

        if(!$cek_user)
        {
            $simpan = $this->m_kdr->tambah_user_kdr($nama_lengkap,$username,$password,$level,$status,$nama_bagian,$untuk_web);
            if($simpan)
            {
                $data['user_kdr_aktif']    = $this->m_kdr->user_kdr_aktif();
                $data['user_kdr_nonaktif'] = $this->m_kdr->user_kdr_nonaktif();
                $data['berhasil_simpan']   = '<div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <p style="font-weight:bold;">Username berhasil ditambahkan</p>
                                              </div>';
                $this->load->view('kdr/v_manajemenUserKDR', $data); 
            }
            else
            {
                $data['gagal_simpan'] = '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Username gagal ditambahkan</p>
                                        </div>';
                $this->load->view('kdr/v_manajemenUserKDR', $data);
            }
        }
        else 
        {
            $data['duplicate_user'] = '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Username telah terdaftar, gunakan username lain !</p>
                                        </div>';  
            $this->load->view('kdr/v_manajemenUserKDR', $data);
        }
            
        $this->load->view('kdr/v_footer_kdr');
    }

    public function update_user_aktif()
    {
        $id_user                   = $this->input->post('id_user');
        $nama_lengkap              = $this->input->post('nama_lengkap');
        $level                     = $this->input->post('level');
        $status                    = $this->input->post('status');
        $nama_bagian               = $this->input->post('nama_bagian');
        $untuk_web                 = $this->input->post('untuk_web');
        $password_baru             = $this->input->post('password_baru');
        $password_encrypt          = sha1(md5($this->input->post('password_baru', TRUE)));
        $data                      = $this->data_array;
        $data['user_kdr_aktif']    = $this->m_kdr->user_kdr_aktif();
        $data['user_kdr_nonaktif'] = $this->m_kdr->user_kdr_nonaktif();

        for ($i = 0; $i < count($id_user); $i++) 
        {
            $id          = $id_user[$i];
            $level       = $level[$id];
            $status      = $status[$id];  
            $nama_bagian = $nama_bagian[$id];
            $untuk_web   = $untuk_web[$id]; 
            $update      = $this->m_kdr->update_user_kdr_aktif($id,$nama_lengkap,$level,$status,$nama_bagian,
                           $untuk_web,$password_baru,$password_encrypt);
        }

        $this->load->view('kdr/v_header_kdr', $data);
        if($update)
        {
            $data                      = $this->data_array;
            $data['user_kdr_aktif']    = $this->m_kdr->user_kdr_aktif();
            $data['user_kdr_nonaktif'] = $this->m_kdr->user_kdr_nonaktif();
            $data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">User KDR berhasil diupdate</p>
                                        </div>';
            $this->load->view('kdr/v_manajemenUserKDR', $data); 
        }
        else
        {
            $data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">User KDR gagal diupdate</p>
                                    </div>';
            $this->load->view('kdr/v_manajemenUserKDR', $data);
        }
        $this->load->view('kdr/v_footer_kdr');
    }

    public function hapus_user_aktif()
    {
        $id_user                   = $this->input->post('id_user');
        $hapus                     = $this->m_kdr->hapus_user_kdr_aktif($id_user);
        $data                      = $this->data_array;
        $data['user_kdr_aktif']    = $this->m_kdr->user_kdr_aktif();
        $data['user_kdr_nonaktif'] = $this->m_kdr->user_kdr_nonaktif();
        $this->load->view('kdr/v_header_kdr', $data);
        if($hapus)
        {
            $data['berhasil_hapus'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Username telah di hapus</p>
                                        </div>';
            $this->load->view('kdr/v_manajemenUserKDR', $data); 
        }
        else
        {
            $data['gagal_hapus'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Username gagal di hapus</p>
                                    </div>';
            $this->load->view('kdr/v_manajemenUserKDR', $data);
        }
        $this->load->view('kdr/v_footer_kdr');
    }

    public function update_user_nonaktif()
    {
        $id_user                   = $this->input->post('id_user');
        $nama_lengkap              = $this->input->post('nama_lengkap');
        $level                     = $this->input->post('level');
        $status                    = $this->input->post('status');
        $nama_bagian               = $this->input->post('nama_bagian');
        $untuk_web                 = $this->input->post('untuk_web');
        $password_baru             = $this->input->post('password_baru');
        $password_encrypt          = sha1(md5($this->input->post('password_baru', TRUE)));
        $data                      = $this->data_array;
        $data['user_kdr_aktif']    = $this->m_kdr->user_kdr_aktif();
        $data['user_kdr_nonaktif'] = $this->m_kdr->user_kdr_nonaktif();

        for ($i = 0; $i < count($id_user); $i++) 
        {
            $id          = $id_user[$i];
            $level       = $level[$id];
            $status      = $status[$id];  
            $nama_bagian = $nama_bagian[$id];
            $untuk_web   = $untuk_web[$id]; 
            $update      = $this->m_kdr->update_user_kdr_nonaktif($id,$nama_lengkap,$level,$status,$nama_bagian,
                           $untuk_web,$password_baru,$password_encrypt);
        }

        $this->load->view('kdr/v_header_kdr', $data);
        if($update)
        {
            $data                      = $this->data_array;
            $data['user_kdr_aktif']    = $this->m_kdr->user_kdr_aktif();
            $data['user_kdr_nonaktif'] = $this->m_kdr->user_kdr_nonaktif();
            $data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">User KDR berhasil diupdate</p>
                                        </div>';
            $this->load->view('kdr/v_manajemenUserKDR', $data); 
        }
        else
        {
            $data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">User KDR gagal diupdate</p>
                                    </div>';
            $this->load->view('kdr/v_manajemenUserKDR', $data);
        }
        $this->load->view('kdr/v_footer_kdr');
    }

    public function hapus_user_nonaktif()
    {
        $id_user                   = $this->input->post('id_user');
        $hapus                     = $this->m_kdr->hapus_user_kdr_nonaktif($id_user);
        $data                      = $this->data_array;
        $data['user_kdr_aktif']    = $this->m_kdr->user_kdr_aktif();
        $data['user_kdr_nonaktif'] = $this->m_kdr->user_kdr_nonaktif();
        $this->load->view('kdr/v_header_kdr', $data);
        if($hapus)
        {
            $data['berhasil_hapus'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Username telah di hapus</p>
                                        </div>';
            $this->load->view('kdr/v_manajemenUserKDR', $data); 
        }
        else
        {
            $data['gagal_hapus'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Username gagal di hapus</p>
                                    </div>';
            $this->load->view('kdr/v_manajemenUserKDR', $data);
        }
        $this->load->view('kdr/v_footer_kdr');
    }

}