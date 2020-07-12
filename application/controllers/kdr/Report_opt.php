<?php 
     
class Report_opt extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('kdr/m_kdr','kdr/m_dispo'));
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
        $data                = $this->data_array;
        $data['notif_dispo'] = $this->get_notif_dispo();
        $data['report_opt']  = $this->m_kdr->report_opt();
        $this->load->view('kdr/v_header_kdr', $data);
        $this->load->view('kdr/v_reportOPT', $data);
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