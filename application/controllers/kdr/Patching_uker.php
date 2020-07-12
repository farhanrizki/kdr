<?php 
     
class Patching_uker extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('kdr/m_kdr','kdr/m_dispo'));
        $level_risk   = $this->session->userdata('level_risk');
        $level_monica = $this->session->userdata('level_monica');

        if($level_risk == "adminkdr" || $level_risk == "staffkdr" || $level_risk == "kabagkdr" || $level_risk == "nonadmin")
        {
            $id_user          = $this->session->userdata('id_user');
            $nama_lengkap_kdr = $this->session->userdata('nama_lengkap_risk');
            $username_kdr     = $this->session->userdata('username_risk');
            $level_kdr        = $this->session->userdata('level_risk');
            $nama_bagian_kdr  = $this->session->userdata('nama_bagian_risk');
            $status_kdr       = $this->session->userdata('status_risk');
            $untuk_web_kdr    = $this->session->userdata('untuk_web_risk');

            $this->data_array = array(
                'id_user'          => $id_user,
                'nama_lengkap_kdr' => $nama_lengkap_kdr,
                'username_kdr'     => $username_kdr,
                'level_kdr'        => $level_kdr,
                'nama_bagian_kdr'  => $nama_bagian_kdr,
                'status_kdr'       => $status_kdr,
                'untuk_web_kdr'    => $untuk_web_kdr
            );

            if($level_kdr == "superadmin" || ($level_kdr == "nonadmin" && $untuk_web_kdr != "kdr"))
            {
                redirect(base_url("dashboard_kdr"));
            }
        } 
        else if($level_monica == "adminkdr" || $level_monica == "staffkdr" || $level_monica == "kabagkdr" 
        || $level_monica == "nonadmin")
        {
            $id_user          = $this->session->userdata('id_user');
            $nama_lengkap_kdr = $this->session->userdata('nama_lengkap_monica');
            $username_kdr     = $this->session->userdata('username_monica');
            $level_kdr        = $this->session->userdata('level_monica');
            $nama_bagian_kdr  = $this->session->userdata('nama_bagian_monica');
            $status_kdr       = $this->session->userdata('status_monica');
            $untuk_web_kdr    = $this->session->userdata('untuk_web_monica');

            $this->data_array = array(
                'id_user'          => $id_user,
                'nama_lengkap_kdr' => $nama_lengkap_kdr,
                'username_kdr'     => $username_kdr,
                'level_kdr'        => $level_kdr,
                'nama_bagian_kdr'  => $nama_bagian_kdr,
                'status_kdr'       => $status_kdr,
                'untuk_web_kdr'    => $untuk_web_kdr
            );

            if($level_kdr == "superadmin" || ($level_kdr == "nonadmin" && $untuk_web_kdr != "kdr"))
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
            $untuk_web_kdr    = $this->session->userdata('untuk_web_kdr');

            $this->data_array = array(
                'id_user'          => $id_user,
                'nama_lengkap_kdr' => $nama_lengkap_kdr,
                'username_kdr'     => $username_kdr,
                'level_kdr'        => $level_kdr,
                'nama_bagian_kdr'  => $nama_bagian_kdr,
                'status_kdr'       => $status_kdr,
                'untuk_web_kdr'    => $untuk_web_kdr
            );

            if($level_kdr == "superadmin" || ($level_kdr == "nonadmin" && $untuk_web_kdr != "kdr"))
            {
                redirect(base_url("dashboard_kdr"));
            }
        }
    }

    public function index()
    {
        $data                = $this->data_array;
        $data['css_arr']     = array('daterangepicker.min.css','bootstrap-datetimepicker.min.css',
                               'bootstrap-datepicker3.min.css','bootstrap-timepicker.min.css');
        $data['js_arr']      = array('moment.min.js','bootstrap-datepicker.min.js','bootstrap-timepicker.min.js'                   ,'daterangepicker.min.js','bootstrap-datetimepicker.min.js');
        $tanggal             = $this->input->post('tanggal');
        $uker                = $this->input->post('uker');
        $data['tanggal']     = $tanggal;
        $tanggal2            = explode(' / ',$tanggal);
        $tanggal_start       = $tanggal2[0];
        $data['uker']        = $this->m_kdr->get_uker();
        $data['notif_dispo'] = $this->get_notif_dispo();

        if($tanggal_start == 0 && $uker == "")
        {
            $uker                  = "semua";
            $tanggal_start         = 0;
            $tanggal_end           = 0;
            $data['patching_uker'] = $this->m_kdr->patching_uker($tanggal_start,$tanggal_end,$uker);
            $data['tahun']         = 'Tahun '.date("Y");
        }
        else if($tanggal_start == 0 && $uker != "semua")
        {
            $tanggal_start         = 0;
            $tanggal_end           = 0;
            $data['patching_uker'] = $this->m_kdr->patching_uker($tanggal_start,$tanggal_end,$uker);
            $data['tahun']         = 'Tahun '.date("Y");
        }
        else
        {
            $tanggal_start         = $tanggal2[0];
            $tanggal_end           = $tanggal2[1];
            $data['patching_uker'] = $this->m_kdr->patching_uker($tanggal_start,$tanggal_end,$uker);
            $tgl_awal              = date("d F Y", strtotime($tanggal_start));
            $tgl_akhir             = date("d F Y", strtotime($tanggal_end));
            $data['tahun']         = 'Tanggal '.$tgl_awal.' sampai '.$tgl_akhir;
        }
        $data['filter_uker'] = $uker;
        
        $this->load->view('kdr/v_header_kdr', $data);
        $this->load->view('kdr/v_patchingUker', $data); 
        $this->load->view('kdr/v_footer_kdr');
    }

    public function download_uker($tanggal_start,$tanggal_end,$uker)
    {
        if($tanggal_start == 0)
        {
            $data['isiexcel'] = $this->m_kdr->download_uker($tanggal_start,$tanggal_end,$uker);
            $data['tanggal']  = 'Tahun '.date("Y");
            $data['uker']     = ucfirst($uker).' Uker';
        }
        else
        {
            $data['isiexcel'] = $this->m_kdr->download_uker($tanggal_start,$tanggal_end,$uker);
            $tgl_awal         = date("d F Y", strtotime($tanggal_start));
            $tgl_akhir        = date("d F Y", strtotime($tanggal_end));
            $data['tanggal']  = 'Tanggal '.$tgl_awal.' - '.$tgl_akhir;
            $data['uker']     = 'Uker '.ucfirst($uker);
        }
        $this->load->view('kdr/v_excelUker', $data);
    }

    public function lihat_data_uker()
    {
        $uker          = $this->input->post('uker');
        $tanggal_start = $this->input->post('tanggal_start');
        $tanggal_end   = $this->input->post('tanggal_end');
        $result_html   = '';
        $data_uker     = $this->m_kdr->download_uker($tanggal_start,$tanggal_end,$uker);

        foreach($data_uker as $result)
        {
            $result_html .= '
                <tr>
                    <td>' . $result['nama'] . '</td>
                    <td>' . $result['jumlah_patching'] . '</td>
                </tr>'; 
        }
        echo json_encode($result_html);
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