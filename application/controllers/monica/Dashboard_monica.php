<?php 
    
class Dashboard_monica extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model('monica/m_login_monica');
        $id_user             = $this->session->userdata('id_user');
        $level_kdr           = $this->session->userdata('level_kdr');
        $untuk_web_kdr       = $this->session->userdata('untuk_web_kdr');
        $nama_lengkap_kdr    = $this->session->userdata('nama_lengkap_kdr');
        $level_risk          = $this->session->userdata('level_risk');
        $untuk_web_risk      = $this->session->userdata('untuk_web_risk');
        $nama_lengkap_risk   = $this->session->userdata('nama_lengkap_risk');
        $level_monica        = $this->session->userdata('level_monica');
        $untuk_web_monica    = $this->session->userdata('untuk_web_monica');
        $nama_lengkap_monica = $this->session->userdata('nama_lengkap_monica');

        $this->data_array = array(
            'id_user'             => $id_user,
            'level_kdr'           => $level_kdr,
            'untuk_web_kdr'       => $untuk_web_kdr,
            'nama_lengkap_kdr'    => $nama_lengkap_kdr,
            'level_risk'          => $level_risk,
            'untuk_web_risk'      => $untuk_web_risk,
            'nama_lengkap_risk'   => $nama_lengkap_risk,
            'level_monica'        => $level_monica,
            'untuk_web_monica'    => $untuk_web_monica,
            'nama_lengkap_monica' => $nama_lengkap_monica
        );
    }

    public function index()
    {
        //Get Maturity
        $maturity                   = $this->maturityaudit->getMaturity();
        $data['maturity_app']       = $maturity['maturity_app'];
        $data['maturity_qa']        = $maturity['maturity_qa'];
        $data['maturity_ops']       = $maturity['maturity_ops'];
        $data['bagian']             = $maturity['bagian'];
        $data['count']              = $maturity['count'];
        $data['urutan']             = $maturity['urutan'];
        //Get jumlah notif
        $data['tidakmemadai']       = $this->notif_tidakmemadai();
        $data['dalampemantauan']    = $this->notif_dalampemantauan();
        $id                         = $this->notifaudit->updateNotif();
        $data['id_tidakmemadai']    = implode(",",$id['id_tidakmemadai']);
        $data['id_dalampemantauan'] = implode(",",$id['id_dalampemantauan']);
        $cek_login                  = $this->m_login_monica->login_monica();
        $data_array                 = $this->data_array;
        
        //ketika belum login
        if(!$cek_login)
        {
            if($data_array['level_kdr'] == "superadmin" || $data_array['level_kdr'] == "adminkdr")
            {
                $data['nama_lengkap_monica'] = $data_array['nama_lengkap_kdr'];
                $data['level_monica']        = $data_array['level_kdr'];
                $this->load->view('monica/v_header_monica', $data);
                $this->load->view('monica/v_dashboard_monica', $data);
            }
            else if(($data_array['level_kdr'] == "staffkdr" || $data_array['level_kdr'] == "kabagkdr") 
                && $data_array['untuk_web_kdr'] == "semua")
            {
                $data['nama_lengkap_monica'] = $data_array['nama_lengkap_kdr'];
                $data['level_monica']        = $data_array['level_kdr'];
                $this->load->view('monica/v_header_monica', $data);
                $this->load->view('monica/v_dashboard_monica', $data);
            }
            else if($data_array['level_kdr'] == "nonadmin" && $data_array['untuk_web_kdr'] != "monica")
            {
                $data['nama_lengkap_monica'] = $data_array['nama_lengkap_kdr'];
                $data['level_monica']        = $data_array['level_kdr'];
                $data['untuk_web_monica']    = $data_array['untuk_web_kdr'];
                $this->load->view('monica/v_header_monica', $data);
                $this->load->view('monica/v_dashboard_monica', $data);
            }
            else if($data_array['level_risk'] == "superadmin" || $data_array['level_risk'] == "adminkdr")
            {
                $data['nama_lengkap_monica'] = $data_array['nama_lengkap_risk'];
                $data['level_monica']        = $data_array['level_risk'];
                $this->load->view('monica/v_header_monica', $data);
                $this->load->view('monica/v_dashboard_monica', $data);
            }
            else if(($data_array['level_risk'] == "staffkdr" || $data_array['level_risk'] == "kabagkdr") 
                && $data_array['untuk_web_risk'] == "semua")
            {
                $data['nama_lengkap_monica'] = $data_array['nama_lengkap_risk'];
                $data['level_monica']        = $data_array['level_risk'];
                $this->load->view('monica/v_header_monica', $data);
                $this->load->view('monica/v_dashboard_monica', $data);
            }
            else if($data_array['level_risk'] == "nonadmin" && $data_array['untuk_web_risk'] != "monica")
            {
                $data['nama_lengkap_monica'] = $data_array['nama_lengkap_risk'];
                $data['level_monica']        = $data_array['level_risk'];
                $data['untuk_web_monica']    = $data_array['untuk_web_risk'];
                $this->load->view('monica/v_header_monica', $data);
                $this->load->view('monica/v_dashboard_monica', $data);
            }
            else
            {
                $data['nama_lengkap_monica'] = "";
                $data['level_monica']        = "";
                $data['untuk_web_monica']    = "";
                $this->load->view('monica/v_header_monica', $data);
                $this->load->view('monica/v_dashboard_monica', $data);
            }
        }

        //ketika sudah login
        else
        {
            //jika session sudah terdaftar
            if($cek_login)
            {
                $data['nama_lengkap_monica'] = $data_array['nama_lengkap_monica'];
                $data['level_monica']        = $data_array['level_monica'];
                $data['untuk_web_monica']    = $data_array['untuk_web_monica'];
                $this->load->view('monica/v_header_monica', $data);
                $this->load->view('monica/v_dashboard_monica', $data); 
            }

            //jika session belum terdaftar, maka redirect ke halaman login
            else
            {
                redirect('login_kdr');
            }
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

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('monica/dashboard_monica');
    }
} 