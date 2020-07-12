<?php 
    
class Dashboard_risk extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('risk/m_login_risk','risk/m_risk'));
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
        //Notif Insiden
        $data['notifInsiden']  = $this->m_risk->notifInsiden();
        $data['css_arr']       = array('');
        $data['js_arr']        = array('highchart/highcharts.js','highchart/highcharts-more.js','highchart/solid-gauge.js');
        $data['bagian']        = array('pqa','kdr','pen','shd','tik','isd','inf','osd','opl','ost');
        $data['insiden']       = array();
        $data['detil_insiden'] = array();

        foreach($data['bagian'] as $bagian)
        {
            $insiden       = $this->m_risk->insiden_bagian(strtoupper($bagian));
            $detil_insiden = $this->m_risk->detil_insiden(strtoupper($bagian));
            array_push($data['insiden'],$insiden);
            array_push($data['detil_insiden'],$detil_insiden);
        }

        //penghitungan risk
        $bobot   = $this->m_risk->allRisk();
        $risk    = array();
        $riskOPT = 0;
        $riskOPS = 0;
        $riskQA  = 0;

        for ($i=1; $i <= 12; $i++) 
        { 
            if($i != 3 && $i != 5)
            {
                $avgid       = $this->m_risk->avgid($i);
                $username    = $this->m_risk->username($i);
                $insiden     = $this->m_risk->insiden_peruser($username[0]['username']);
                $bagian      = $username[0]['username'];
                $normalbobot = (@$bobot[0][$bagian]/100) * 5;

                if($avgid[0]['avg'] == null)
                {
                    $risk[$i] = 5;
                }
                else
                {
                    $risk[$i] = $avgid[0]['avg'] + $normalbobot;
                }

                foreach($insiden as $insiden)
                {  
                    if($insiden['last_status'] == 'Dalam Penanganan' && $insiden['insiden_cause'] == "Host, Data Center, Operasional (OPT)"){
                        if($insiden['lingkup_impact'] == 'Lokal')
                        {
                            $risk[$i] = $risk[$i] + 0.2;
                        }
                        else if($insiden['lingkup_impact'] == 'Masal')
                        {
                            $risk[$i] = $risk[$i] + 0.4;
                        }
                        else if($insiden['lingkup_impact'] == 'Nasional')
                        {
                            $risk[$i] = $risk[$i] + 0.7;
                        }
                    }
                }

                if ($risk[$i] > 5) 
                {
                    $risk[$i] = 5;
                }

                $riskOPT += $risk[$i];
                if($i == 1 || $i == 2 || $i == 6 || $i == 7 || $i == 8 || $i == 12)
                {
                    $riskOPS += $risk[$i];
                }

                if($i == 4 || $i == 9 || $i == 10 || $i == 11)
                {
                    $riskQA += $risk[$i];
                }

                $this->m_risk->update_risk_profile($risk[$i],$i); 
            }
        }

        $data['risk_bagian'] = $risk;
        $data['risk_qa']     = $riskQA;
        $data['risk_ops']    = $riskOPS;
        $data['risk_opt']    = $riskOPT;

        $cek_login  = $this->m_login_risk->login_risk();
        $data_array = $this->data_array;

        //ketika belum login
        if(!$cek_login)
        {
            if($data_array['level_kdr'] == "superadmin" || $data_array['level_kdr']== "adminkdr")
            {
                $data['nama_lengkap_risk'] = $data_array['nama_lengkap_kdr'];
                $data['level_risk']        = $data_array['level_kdr'];
                $this->load->view('risk/v_header_risk', $data);
                $this->load->view('risk/v_dashboard_risk', $data);
            }
            else if(($data_array['level_kdr'] == "staffkdr" || $data_array['level_kdr'] == "kabagkdr")
                && $data_array['untuk_web_kdr'] == "semua")
            {
                $data['nama_lengkap_risk'] = $data_array['nama_lengkap_kdr'];
                $data['level_risk']        = $data_array['level_kdr'];
                $this->load->view('risk/v_header_risk', $data);
                $this->load->view('risk/v_dashboard_risk', $data);
            }
            else if($data_array['level_kdr'] == "nonadmin" && $data_array['untuk_web_kdr'] != "risk")
            {
                $data['nama_lengkap_risk'] = $data_array['nama_lengkap_kdr'];
                $data['level_risk']        = $data_array['level_kdr'];
                $data['untuk_web_risk']    = $data_array['untuk_web_kdr'];
                $this->load->view('risk/v_header_risk', $data);
                $this->load->view('risk/v_dashboard_risk', $data);
            }
            else if($data_array['level_monica'] == "superadmin" || $data_array['level_monica'] == "adminkdr")
            {
                $data['nama_lengkap_risk'] = $data_array['nama_lengkap_monica'];
                $data['level_risk']        = $data_array['level_monica'];
                $this->load->view('risk/v_header_risk', $data);
                $this->load->view('risk/v_dashboard_risk', $data);
            }
            else if(($data_array['level_monica'] == "staffkdr" || $data_array['level_monica'] == "kabagkdr")
                && $data_array['untuk_web_monica'] == "semua")
            {
                $data['nama_lengkap_risk'] = $data_array['nama_lengkap_monica'];
                $data['level_risk']        = $data_array['level_monica'];
                $this->load->view('risk/v_header_risk', $data);
                $this->load->view('risk/v_dashboard_risk', $data);
            }
            else if($data_array['level_monica'] == "nonadmin" && $data_array['untuk_web_monica'] != "risk")
            {
                $data['nama_lengkap_risk'] = $data_array['nama_lengkap_monica'];
                $data['level_risk']        = $data_array['level_monica'];
                $data['untuk_web_risk']    = $data_array['untuk_web_monica'];
                $this->load->view('risk/v_header_risk', $data);
                $this->load->view('risk/v_dashboard_risk', $data);
            }
            else
            {
                $data['nama_lengkap_risk'] = "";
                $data['level_risk']        = "";
                $data['untuk_web_risk']    = "";
                $this->load->view('risk/v_header_risk', $data);
                $this->load->view('risk/v_dashboard_risk', $data);
            }
        }

        //ketika sudah login
        else
        {
            //jika session sudah terdaftar
            if($cek_login)
            {
                $data['nama_lengkap_risk'] = $data_array['nama_lengkap_risk'];
                $data['level_risk']        = $data_array['level_risk'];
                $data['untuk_web_risk']    = $data_array['untuk_web_risk'];
                $this->load->view('risk/v_header_risk', $data);
                $this->load->view('risk/v_dashboard_risk', $data); 
            }

            //jika session belum terdaftar, maka redirect ke halaman login
            else
            {
                redirect('risk/login_risk');
            }
        }
        $this->load->view('risk/v_footer_risk'); 
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('risk/dashboard_risk');
    }
} 