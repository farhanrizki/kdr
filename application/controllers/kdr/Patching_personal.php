<?php 
     
class Patching_personal extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('kdr/m_kdr','kdr/m_dispo'));
        $this->load->library('working');
        $level_risk   = $this->session->userdata('level_risk');
        $level_monica = $this->session->userdata('level_monica');

        if($level_risk == "adminkdr" || $level_risk == "staffkdr" || $level_risk =="kabagkdr")
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

            if($status_kdr != "login" || $level_kdr == "superadmin" || $level_kdr == "nonadmin")
            {
                redirect(base_url("dashboard_kdr"));
            }
        } 
        else if($level_monica == "adminkdr" || $level_monica == "staffkdr" || $level_monica =="kabagkdr")
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
            if($status_kdr != "login" || $level_kdr == "superadmin" || $level_kdr == "nonadmin")
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
            if($status_kdr != "login" || $level_kdr == "superadmin" || $level_kdr == "nonadmin")
            {
                redirect(base_url("dashboard_kdr"));
            }
        }
    }

    public function index()
    {
        $data                 = $this->data_array;
        $data['css_arr']      = array('daterangepicker.min.css','bootstrap-datetimepicker.min.css',
                                'bootstrap-datepicker3.min.css','bootstrap-timepicker.min.css');
        $data['js_arr']       = array('highcharts.js','exporting.js','export-data.js','moment.min.js',
                                'bootstrap-datepicker.min.js','bootstrap-timepicker.min.js',
                                'daterangepicker.min.js','bootstrap-datetimepicker.min.js');
        $tanggal_awal         = 0;
        $tanggal_akhir        = 0;
        $data['personal']     = $this->m_kdr->patching_personal($tanggal_awal,$tanggal_akhir);
        $total_patching       = 0;
        $data['sla_personal'] = array();
        foreach($data['personal'] as $patching)
        {
            $total_patching += $patching['hitung_maker'];
            $maker          = $patching['maker'];   
            $data['makers'] = $maker;
            $sla_personal   = $this->m_kdr->sla_personal($tanggal_awal,$tanggal_akhir,$maker);
            array_push($data['sla_personal'],$sla_personal);
        }
        $total_patching2 = array('maker' => 'Total','hitung_maker' => $total_patching);
        array_push($data['personal'],$total_patching2);
        $data['notif_dispo'] = $this->get_notif_dispo();
        
        //Get holidays
        $holidays            = $this->m_kdr->tanggal_libur();
        $row_holidays        = "";
        foreach($holidays as $row)
        {
            $row_holidays[] = $row['tgl_libur']; 
        }
        $data['holidays']        = $row_holidays;

        //throw library to view
        $mylib            = $this->working;
        $data['working']  = $mylib;

        $this->load->view('kdr/v_header_kdr', $data);
        $this->load->view('kdr/v_patchingPersonal', $data);
        $this->load->view('kdr/v_footer_kdr');
    }

    public function filter_personal()
    {
        $data                 = $this->data_array;
        $data['css_arr']      = array('daterangepicker.min.css','bootstrap-datetimepicker.min.css',
                                'bootstrap-datepicker3.min.css','bootstrap-timepicker.min.css');
        $data['js_arr']       = array('highcharts.js','exporting.js','export-data.js','moment.min.js',
                                'bootstrap-datepicker.min.js','bootstrap-timepicker.min.js',
                                'daterangepicker.min.js','bootstrap-datetimepicker.min.js');
        $tanggal              = $this->input->post('tanggal');
        $data['tanggal']      = $tanggal;
        $tanggal2             = explode(' / ',$tanggal);
        $tanggal_start        = $tanggal2[0];
        $tanggal_end          = $tanggal2[1];
        $data['personal']     = $this->m_kdr->patching_personal($tanggal_start,$tanggal_end);
        $total_patching       = 0;
        $data['sla_personal'] = array();
        foreach($data['personal'] as $patching)
        {
            $total_patching += $patching['hitung_maker'];
            $maker          = $patching['maker'];   
            $data['makers'] = $maker;
            $sla_personal   = $this->m_kdr->sla_personal($tanggal_start,$tanggal_end,$maker);
            array_push($data['sla_personal'],$sla_personal);
        }
        $total_patching2 = array('maker' => 'Total','hitung_maker' => $total_patching);
        array_push($data['personal'],$total_patching2);
        $data['notif_dispo'] = $this->get_notif_dispo();

        //Get holidays
        $holidays     = $this->m_kdr->tanggal_libur();
        $row_holidays = "";
        foreach($holidays as $row)
        {
            $row_holidays[] = $row['tgl_libur']; 
        }
        $data['holidays']         = $row_holidays;
        $tgl_awal                 = date("d F Y", strtotime($tanggal_start));
        $tgl_akhir                = date("d F Y", strtotime($tanggal_end));
        $data['tanggal_personal'] = $tgl_awal.' - '.$tgl_akhir;

        //throw library to view
        $mylib            = $this->working;
        $data['working']  = $mylib;

        $this->load->view('kdr/v_header_kdr', $data);
        $this->load->view('kdr/v_patchingPersonal', $data);
        $this->load->view('kdr/v_footer_kdr');
    }

    public function download_personal($tanggal_start,$tanggal_end)
    {
        if($tanggal_start == 0)
        {
            $data['isiexcel'] = $this->m_kdr->patching_personal($tanggal_start,$tanggal_end);
            $data['tanggal']  = 'Tahun '.date("Y");
        }
        else
        {
            $data['isiexcel'] = $this->m_kdr->patching_personal($tanggal_start,$tanggal_end);
            $tgl_awal         = date("d F Y", strtotime($tanggal_start));
            $tgl_akhir        = date("d F Y", strtotime($tanggal_end));
            $data['tanggal']  = $tgl_awal.' - '.$tgl_akhir;
        }
        $this->load->view('kdr/v_excelPersonal', $data);
    }

    public function detail_personal($tanggal_start,$tanggal_end,$personal)
    {
        $data                = $this->data_array;
        $level               = $data['level_kdr'];
        $nama_personal       = urldecode($personal);
        $data['notif_dispo'] = $this->get_notif_dispo();

        //Get holidays
        $holidays     = $this->m_kdr->tanggal_libur();
        $row_holidays = "";
        foreach($holidays as $row)
        {
            $row_holidays[] = $row['tgl_libur']; 
        }
        $data['holidays'] = $row_holidays;

        //throw library to view
        $mylib            = $this->working;
        $data['working']  = $mylib;
        
        if($tanggal_start == 0)
        {
            $data['detail_personal']= $this->m_kdr->detail_personal($tanggal_start,$tanggal_end,$nama_personal);
            $tanggal_start          = date('Y-m-d');
            $tanggal_end            = date('Y-m-d');
            $data['filter']         = 'Tahun '.date("Y");
            $data['tanggal_start']  = 0;
            $data['tanggal_end']    = 0;
            $data['nama_personal']  = $nama_personal;
        }
        else
        {
            $data['detail_personal']= $this->m_kdr->detail_personal($tanggal_start,$tanggal_end,$nama_personal);
            $tgl_awal               = date("d F Y", strtotime($tanggal_start));
            $tgl_akhir              = date("d F Y", strtotime($tanggal_end));
            $data['filter']         = 'Tanggal '.$tgl_awal.' - '.$tgl_akhir;
            $data['tanggal_start']  = $tanggal_start;
            $data['tanggal_end']    = $tanggal_end;
            $data['nama_personal']  = $nama_personal;
        }
        $this->load->view('kdr/v_header_kdr', $data);
        $this->load->view('kdr/v_detailPatchingPersonal', $data);
        $this->load->view('kdr/v_footer_kdr');
    }

    public function update_justifikasi()
    {
        $id_patching   = $this->input->post('id_patching');
        $keterangan    = $this->input->post('keterangan');
        $justifikasi   = "1";
        $tanggal_start = $this->input->post('tanggal_start');
        $tanggal_end   = $this->input->post('tanggal_end');
        $nama_personal = $this->input->post('nama_personal');

        for ($i = 0; $i < count($id_patching); $i++) 
        {
            $id     = $id_patching[$i];
            $update = $this->m_kdr->update_justifikasi($id,$keterangan,$justifikasi);
        }
        $data = $this->data_array;
        if($update)
        {
            echo '<script language="javascript">';
            echo 'alert("Justifikasi berhasil diupdate")';
            echo '</script>';
            redirect('kdr/patching_personal/detail_personal/'.$tanggal_start.'/'.$tanggal_end.'/'.$nama_personal, 'refresh'); 
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Justifikasi gagal diupdate!")';
            echo '</script>';
            redirect('kdr/patching_personal/detail_personal/'.$tanggal_start.'/'.$tanggal_end.'/'.$nama_personal, 'refresh');
        }
    }

    public function batal_justifikasi($id_patching,$tanggal_start,$tanggal_end,$nama_personal)
    {
        $keterangan   = "";
        $justifikasi  = "0";
        $batal_justif = $this->m_kdr->batal_justifikasi($id_patching,$keterangan,$justifikasi);
        $data         = $this->data_array;
        if($batal_justif)
        {
            echo '<script language="javascript">';
            echo 'alert("Justifikasi berhasil dibatalkan")';
            echo '</script>';
            redirect('kdr/patching_personal/detail_personal/'.$tanggal_start.'/'.$tanggal_end.'/'.$nama_personal, 'refresh'); 
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Justifikasi gagal dibatalkan!")';
            echo '</script>';
            redirect('kdr/patching_personal/detail_personal/'.$tanggal_start.'/'.$tanggal_end.'/'.$nama_personal, 'refresh');
        }
    }

    public function download_detail_personal($tanggal_start,$tanggal_end,$nama)
    {
        $nama_personal = urldecode($nama);
        if($tanggal_start == 0)
        {
            $data['isiexcel']      = $this->m_kdr->detail_personal($tanggal_start,$tanggal_end,$nama_personal);
            $data['tanggal']       = 'Tahun '.date("Y");
            $data['nama_personal'] = urldecode($nama);
        }
        else
        {
            $data['isiexcel']      = $this->m_kdr->detail_personal($tanggal_start,$tanggal_end,$nama_personal);
            $tgl_awal              = date("d F Y", strtotime($tanggal_start));
            $tgl_akhir             = date("d F Y", strtotime($tanggal_end));
            $data['tanggal']       = $tgl_awal.' - '.$tgl_akhir; 
            $data['nama_personal'] = urldecode($nama);  
        }
        $this->load->view('kdr/v_excelDetailPersonal', $data);
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