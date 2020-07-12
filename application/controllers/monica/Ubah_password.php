<?php 
     
class Ubah_password extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model('monica/m_ubah_password');
        $level_kdr          = $this->session->userdata('level_kdr');
        $level_risk         = $this->session->userdata('level_risk');
        $tidakmemadai       = $this->notif_tidakmemadai();
        $dalampemantauan    = $this->notif_dalampemantauan();
        $id                 = $this->notifaudit->updateNotif();
        $id_tidakmemadai    = implode(",",$id['id_tidakmemadai']);
        $id_dalampemantauan = implode(",",$id['id_dalampemantauan']);

        if($level_kdr == "superadmin" || $level_kdr == "adminkdr" || $level_kdr == "staffkdr" || $level_kdr == "kabagkdr" || $level_kdr == "nonadmin")
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

            if($status_monica != "login")
            {
                redirect(base_url("monica/dashboard_monica"));
            }
        }
        else if($level_risk == "superadmin" || $level_risk == "adminkdr" || $level_risk == "staffkdr" 
            || $level_risk == "kabagkdr" || $level_risk == "nonadmin")
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

            if($status_monica != "login")
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

            if($status_monica != "login")
            {
                redirect(base_url("monica/dashboard_monica"));
            }
        }
    }

    public function index()
    {
        if(isset($_POST['ubahpassword']))
        {
            $this->ubah_password();
        }
        else
        {
            $data = $this->data_array;
            $this->load->view('monica/v_header_monica', $data);
            $this->load->view('monica/v_ubahPassword', $data); 
            $this->load->view('monica/v_footer_monica');
        }
    }

    public function ubah_password()
    {
        $id_user             = $this->session->userdata('id_user');
        $password_lama       = $this->input->post('password_lama');
        $password_baru       = $this->input->post('password_baru');
        $konfirmasi_password = $this->input->post('konfirmasi_password');
        $password_lama_sha   = sha1(md5($password_lama));
        $password_baru_sha   = sha1(md5($password_baru));
        $cek_password        = $this->m_ubah_password->cek_password($id_user,$password_lama_sha);
        $data                = $this->data_array;
        $this->load->view('monica/v_header_monica', $data);

        //Sama dengan database
        if($cek_password != false)
        {
            //Password baru = konfirmasi password
            if($password_baru == $konfirmasi_password)
            {
                $update = $this->m_ubah_password->update_password($id_user,$password_baru_sha);

                if($update)
                {
                    $data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <p style="font-weight:bold;">Password berhasil diubah</p>
                                                </div>';
                    $this->load->view('monica/v_ubahPassword', $data);
                }
                else
                {
                    $data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <p style="font-weight:bold;">Password gagal diubah</p>
                                            </div>';
                    $this->load->view('monica/v_ubahPassword', $data);
                }
            }

            //Password baru != konfirmasi password
            else
            {
                $data['beda_dengan_konfirmasi'] = '<div class="alert alert-danger alert-dismissable">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <p style="font-weight:bold;">Password baru tidak cocok dengan konfirmasi password</p>
                                                    </div>';
                $this->load->view('monica/v_ubahPassword', $data);
            }
        }

        //Tidak sama dengan database
        else
        {
            $data['beda_dengan_database'] = '<div class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <p style="font-weight:bold;">Password lama tidak cocok dengan di database</p>
                                            </div>';  
            $this->load->view('monica/v_ubahPassword', $data);
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