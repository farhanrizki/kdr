<?php 
     
class Manajemen_user extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model('monica/m_manajemen_monica');
        $level_kdr          = $this->session->userdata('level_kdr');
        $level_risk         = $this->session->userdata('level_risk');
        $tidakmemadai       = $this->notif_tidakmemadai();
        $dalampemantauan    = $this->notif_dalampemantauan();
        $id                 = $this->notifaudit->updateNotif();
        $id_tidakmemadai    = implode(",",$id['id_tidakmemadai']);
        $id_dalampemantauan = implode(",",$id['id_dalampemantauan']);

        if($level_kdr == "superadmin")
        {
            $id_user             = $this->session->userdata('id_user');
            $nama_lengkap_monica = $this->session->userdata('nama_lengkap_kdr');
            $username_monica     = $this->session->userdata('username_kdr');
            $level_monica        = $this->session->userdata('level_kdr');
            $nama_bagian_monica  = $this->session->userdata('nama_bagian_kdr');
            $status_monica       = $this->session->userdata('status_kdr');

            $this->data_array = array(
                'id_user'             => $id_user,
                'nama_lengkap_monica' => $nama_lengkap_monica,
                'username_monica'     => $username_monica,
                'level_monica'        => $level_monica,
                'nama_bagian_monica'  => $nama_bagian_monica,
                'status_monica'       => $status_monica,
                'tidakmemadai'        => $tidakmemadai,
                'dalampemantauan'     => $dalampemantauan,
                'id_tidakmemadai'     => $id_tidakmemadai,
                'id_dalampemantauan'  => $id_dalampemantauan
            );

            if($status_monica != "login" || $level_monica != "superadmin")
            {
                redirect(base_url("monica/dashboard_monica"));
            }
        }
        else if($level_risk == "superadmin")
        {
            $id_user             = $this->session->userdata('id_user');
            $nama_lengkap_monica = $this->session->userdata('nama_lengkap_risk');
            $username_monica     = $this->session->userdata('username_risk');
            $level_monica        = $this->session->userdata('level_risk');
            $nama_bagian_monica  = $this->session->userdata('nama_bagian_risk');
            $status_monica       = $this->session->userdata('status_risk');

            $this->data_array = array(
                'id_user'             => $id_user,
                'nama_lengkap_monica' => $nama_lengkap_monica,
                'username_monica'     => $username_monica,
                'level_monica'        => $level_monica,
                'nama_bagian_monica'  => $nama_bagian_monica,
                'status_monica'       => $status_monica,
                'tidakmemadai'        => $tidakmemadai,
                'dalampemantauan'     => $dalampemantauan,
                'id_tidakmemadai'     => $id_tidakmemadai,
                'id_dalampemantauan'  => $id_dalampemantauan
            );

            if($status_monica != "login" || $level_monica != "superadmin")
            {
                redirect(base_url("monica/dashboard_monica"));
            }
        } 
        else
        {
            $id_user             = $this->session->userdata('id_user');
            $nama_lengkap_monica = $this->session->userdata('nama_lengkap_monica');
            $username_monica     = $this->session->userdata('username_monica');
            $level_monica        = $this->session->userdata('level_monica');
            $nama_bagian_monica  = $this->session->userdata('nama_bagian_monica');
            $status_monica       = $this->session->userdata('status_monica');
            $untuk_web_monica    = $this->session->userdata('untuk_web_monica');

            $this->data_array = array(
                'id_user'             => $id_user,
                'nama_lengkap_monica' => $nama_lengkap_monica,
                'username_monica'     => $username_monica,
                'level_monica'        => $level_monica,
                'nama_bagian_monica'  => $nama_bagian_monica,
                'status_monica'       => $status_monica,
                'untuk_web_monica'    => $untuk_web_monica,
                'tidakmemadai'        => $tidakmemadai,
                'dalampemantauan'     => $dalampemantauan,
                'id_tidakmemadai'     => $id_tidakmemadai,
                'id_dalampemantauan'  => $id_dalampemantauan
            );

            if($status_monica != "login" || $level_monica != "superadmin")
            {
                redirect(base_url("monica/dashboard_monica"));
            }
        }
    }

    public function index()
    {
        if(isset($_POST['tambahuser']))
        {
            $this->tambah_user_monica();
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
            $data                         = $this->data_array;
            $data['user_monica_aktif']    = $this->m_manajemen_monica->user_monica_aktif();
            $data['user_monica_nonaktif'] = $this->m_manajemen_monica->user_monica_nonaktif();
            $this->load->view('monica/v_header_monica', $data);
            $this->load->view('monica/v_manajemenUser', $data); 
            $this->load->view('monica/v_footer_monica');
        }
    }

    public function tambah_user_monica()
    {
        $nama_lengkap                 = $this->input->post('nama_lengkap');
        $username                     = strtolower($this->input->post('username'));
        $password                     = sha1(md5($this->input->post('password')));
        $level                        = $this->input->post('level');
        $status                       = 1;
        $nama_bagian                  = $this->input->post('nama_bagian');
        $untuk_web                    = $this->input->post('untuk_web');
        $cek_user                     = $this->m_manajemen_monica->cek_user($username);
        $data                         = $this->data_array;
        $data['user_monica_aktif']    = $this->m_manajemen_monica->user_monica_aktif();
        $data['user_monica_nonaktif'] = $this->m_manajemen_monica->user_monica_nonaktif();

        $this->load->view('monica/v_header_monica', $data);
        if(!$cek_user)
        {
            $simpan = $this->m_manajemen_monica->tambah_user_monica($nama_lengkap,$username,$password,$level,$status,
                      $nama_bagian,$untuk_web);
            if($simpan)
            {
                $data['user_monica_aktif']    = $this->m_manajemen_monica->user_monica_aktif();
                $data['user_monica_nonaktif'] = $this->m_manajemen_monica->user_monica_nonaktif();
                $data['berhasil_simpan']      = '<div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <p style="font-weight:bold;">Username berhasil ditambahkan</p>
                                                 </div>';
                $this->load->view('monica/v_manajemenUser', $data); 
            }
            else
            {
                $data['gagal_simpan'] = '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Username gagal ditambahkan</p>
                                        </div>';
                $this->load->view('monica/v_manajemenUser', $data);
            }
        }
        else 
        {
            $data['duplicate_user'] = '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Username telah terdaftar, gunakan username lain !</p>
                                        </div>';  
            $this->load->view('monica/v_manajemenUser', $data);
        }
            
        $this->load->view('monica/v_footer_monica');
    }

    public function update_user_aktif()
    {
        $id_user                      = $this->input->post('id_user');
        $nama_lengkap                 = $this->input->post('nama_lengkap');
        $level                        = $this->input->post('level');
        $status                       = $this->input->post('status');
        $nama_bagian                  = $this->input->post('nama_bagian');
        $untuk_web                    = $this->input->post('untuk_web');
        $password_baru                = $this->input->post('password_baru');
        $password_encrypt             = sha1(md5($this->input->post('password_baru', TRUE)));
        $data                         = $this->data_array;
        $data['user_monica_aktif']    = $this->m_manajemen_monica->user_monica_aktif();
        $data['user_monica_nonaktif'] = $this->m_manajemen_monica->user_monica_nonaktif();

        for ($i = 0; $i < count($id_user); $i++) 
        {
            $id          = $id_user[$i];
            $level       = $level[$id];
            $status      = $status[$id];  
            $nama_bagian = $nama_bagian[$id];
            $untuk_web   = $untuk_web[$id]; 
            $update      = $this->m_manajemen_monica->update_user_monica_aktif($id,$nama_lengkap,$level,$status,
                           $nama_bagian,$untuk_web,$password_baru,$password_encrypt);
        }

        $this->load->view('monica/v_header_monica', $data);
        if($update)
        {
            $data                         = $this->data_array;
            $data['user_monica_aktif']    = $this->m_manajemen_monica->user_monica_aktif();
            $data['user_monica_nonaktif'] = $this->m_manajemen_monica->user_monica_nonaktif();
            $data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">User MONICA berhasil diupdate</p>
                                        </div>';
            $this->load->view('monica/v_manajemenUser', $data); 
        }
        else
        {
            $data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">User MONICA gagal diupdate</p>
                                    </div>';
            $this->load->view('monica/v_manajemenUser', $data);
        }
        $this->load->view('monica/v_footer_monica');
    }

    public function hapus_user_aktif()
    {
        $id_user                      = $this->input->post('id_user');
        $hapus                        = $this->m_manajemen_monica->hapus_user_monica_aktif($id_user);
        $data                         = $this->data_array;
        $data['user_monica_aktif']    = $this->m_manajemen_monica->user_monica_aktif();
        $data['user_monica_nonaktif'] = $this->m_manajemen_monica->user_monica_nonaktif();
        $this->load->view('monica/v_header_monica', $data);
        if($hapus)
        {
            $data['berhasil_hapus'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Username telah di hapus</p>
                                        </div>';
            $this->load->view('monica/v_manajemenUser', $data); 
        }
        else
        {
            $data['gagal_hapus'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Username gagal di hapus</p>
                                    </div>';
            $this->load->view('monica/v_manajemenUser', $data);
        }
        $this->load->view('monica/v_footer_monica');
    }

    public function update_user_nonaktif()
    {
        $id_user                      = $this->input->post('id_user');
        $nama_lengkap                 = $this->input->post('nama_lengkap');
        $level                        = $this->input->post('level');
        $status                       = $this->input->post('status');
        $nama_bagian                  = $this->input->post('nama_bagian');
        $untuk_web                    = $this->input->post('untuk_web');
        $password_baru                = $this->input->post('password_baru');
        $password_encrypt             = sha1(md5($this->input->post('password_baru', TRUE)));
        $data                         = $this->data_array;
        $data['user_monica_aktif']    = $this->m_manajemen_monica->user_monica_aktif();
        $data['user_monica_nonaktif'] = $this->m_manajemen_monica->user_monica_nonaktif();

        for ($i = 0; $i < count($id_user); $i++) 
        {
            $id          = $id_user[$i];
            $level       = $level[$id];
            $status      = $status[$id];  
            $nama_bagian = $nama_bagian[$id];
            $untuk_web   = $untuk_web[$id]; 
            $update      = $this->m_manajemen_monica->update_user_monica_nonaktif($id,$nama_lengkap,$level,$status,
                           $nama_bagian,$untuk_web,$password_baru,$password_encrypt);
        }
        
        $this->load->view('monica/v_header_monica', $data);
        if($update)
        {
            $data                         = $this->data_array;
            $data['user_monica_aktif']    = $this->m_manajemen_monica->user_monica_aktif();
            $data['user_monica_nonaktif'] = $this->m_manajemen_monica->user_monica_nonaktif();
            $data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">User MONICA berhasil diupdate</p>
                                        </div>';
            $this->load->view('monica/v_manajemenUser', $data); 
        }
        else
        {
            $data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">User MONICA gagal diupdate</p>
                                    </div>';
            $this->load->view('monica/v_manajemenUser', $data);
        }
        $this->load->view('monica/v_footer_monica');
    }

    public function hapus_user_nonaktif()
    {
        $id_user                      = $this->input->post('id_user');
        $hapus                        = $this->m_manajemen_monica->hapus_user_monica_nonaktif($id_user);
        $data                         = $this->data_array;
        $data['user_monica_aktif']    = $this->m_manajemen_monica->user_monica_aktif();
        $data['user_monica_nonaktif'] = $this->m_manajemen_monica->user_monica_nonaktif();
        $this->load->view('monica/v_header_monica', $data);
        if($hapus)
        {
            $data['berhasil_hapus'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Username telah di hapus</p>
                                        </div>';
            $this->load->view('monica/v_manajemenUser', $data); 
        }
        else
        {
            $data['gagal_hapus'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Username gagal di hapus</p>
                                    </div>';
            $this->load->view('monica/v_manajemenUser', $data);
        }
        $this->load->view('monica/v_footer_monica');
    }

    public function notif_tidakmemadai(){
        $getNotif     = $this->notifaudit->getNotif();
        $tidakmemadai = $getNotif[0]['jumlah_notif'];
        return $tidakmemadai;
    }

    public function notif_dalampemantauan(){
        $getNotif        = $this->notifaudit->getNotif();
        $dalampemantauan = $getNotif[1]['jumlah_notif'];
        return $dalampemantauan;
    }

}