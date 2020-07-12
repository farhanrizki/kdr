<?php 
     
class Ubah_password extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('kdr/m_kdr','kdr/m_dispo'));
        $level_risk   = $this->session->userdata('level_risk');
        $level_monica = $this->session->userdata('level_monica');

        if($level_risk == "superadmin" || $level_risk == "adminkdr" || $level_risk == "staffkdr" || $level_risk =="kabagkdr" || $level_risk =="nonadmin")
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

            if($status_kdr != "login" || $level_kdr == "nonadmin")
            {
                redirect(base_url("dashboard_kdr"));
            }
        }
        else if($level_monica == "superadmin" || $level_monica == "adminkdr" || $level_monica == "staffkdr" || $level_monica =="kabagkdr" || $level_monica =="nonadmin")
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

            if($status_kdr != "login" || $level_kdr == "nonadmin")
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

            if($status_kdr != "login" || $level_kdr == "nonadmin")
            {
                redirect(base_url("dashboard_kdr"));
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
            $data                = $this->data_array;
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_ubahPassword', $data); 
            $this->load->view('kdr/v_footer_kdr');
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
        $cek_password        = $this->m_kdr->cek_password($id_user,$password_lama_sha);
        $data                = $this->data_array;
        $data['notif_dispo'] = $this->get_notif_dispo();
        $this->load->view('kdr/v_header_kdr', $data);

        //Sama dengan database
        if($cek_password != false)
        {
            //Password baru = konfirmasi password
            if($password_baru == $konfirmasi_password)
            {
                $update = $this->m_kdr->update_password($id_user,$password_baru_sha);

                if($update)
                {
                    $data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <p style="font-weight:bold;">Password berhasil diubah</p>
                                                </div>';
                    $this->load->view('kdr/v_ubahPassword', $data);
                }
                else
                {
                    $data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <p style="font-weight:bold;">Password gagal diubah</p>
                                            </div>';
                    $this->load->view('kdr/v_ubahPassword', $data);
                }
            }

            //Password baru != konfirmasi password
            else
            {
                $data['beda_dengan_konfirmasi'] = '<div class="alert alert-danger alert-dismissable">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <p style="font-weight:bold;">Password baru tidak cocok dengan konfirmasi password</p>
                                                    </div>';
                $this->load->view('kdr/v_ubahPassword', $data);
            }
        }

        //Tidak sama dengan database
        else
        {
            $data['beda_dengan_database'] = '<div class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <p style="font-weight:bold;">Password lama tidak cocok dengan di database</p>
                                            </div>';  
            $this->load->view('kdr/v_ubahPassword', $data);
        }
        $this->load->view('kdr/v_footer_kdr');
    }

    public function get_notif_dispo()
    {
        $data    = $this->data_array;
        $level   = $data['level_kdr'];
        $id_user = $data['id_user'];

        if($level == "adminkdr")
        {
            $data['notif_dispo'] = '';
            return $data['notif_dispo'];
        }
        else if($level == "staffkdr")
        {
            $id_pic = $this->m_dispo->get_pic($id_user);
            
            $array_pic = "";
            foreach($id_pic as $row)
            {
                $array_pic[] = $row['id_pic'];
            }

            if($array_pic == "")
            {
                $data['notif_dispo'] = "";
            }
            else
            {
                $user_pic = implode(",",$array_pic);

                //Compare user pic yang di db dengan username login
                $pos      = strpos($user_pic, $id_user);

                if($pos !== false) 
                {
                    $filter_pic = $id_user;
                } 
                else 
                {
                    $filter_pic = "";
                }
                $notif_dispo   = $this->m_dispo->notif_dispo($filter_pic);

                foreach($notif_dispo as $row)
                {
                    $notif[] = $row['hitung'];
                }
                $hitung_notif = implode(",",$notif);

                if($hitung_notif == 0)
                {
                    $notif = "";
                }
                else
                {
                    $notif = $hitung_notif;
                }

                $data['notif_dispo'] = $notif;
            }
            return $data['notif_dispo'];
        }
        else
        {

        }
    }

}