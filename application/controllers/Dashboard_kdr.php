<?php 
    
class Dashboard_kdr extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('kdr/m_login_kdr','kdr/m_dispo','risk/m_risk'));
        $id_user             = $this->session->userdata('id_user');
        $level_kdr           = $this->session->userdata('level_kdr');
        $nama_lengkap_kdr    = $this->session->userdata('nama_lengkap_kdr');
        $untuk_web_kdr       = $this->session->userdata('untuk_web_kdr');
        $level_risk          = $this->session->userdata('level_risk');
        $nama_lengkap_risk   = $this->session->userdata('nama_lengkap_risk');
        $untuk_web_risk      = $this->session->userdata('untuk_web_risk');
        $level_monica        = $this->session->userdata('level_monica');
        $nama_lengkap_monica = $this->session->userdata('nama_lengkap_monica');
        $untuk_web_monica    = $this->session->userdata('untuk_web_monica');

        $this->data_array = array(
            'id_user'             => $id_user,
            'level_kdr'           => $level_kdr,
            'nama_lengkap_kdr'    => $nama_lengkap_kdr,
            'untuk_web_kdr'       => $untuk_web_kdr,
            'level_risk'          => $level_risk,
            'nama_lengkap_risk'   => $nama_lengkap_risk,
            'untuk_web_risk'      => $untuk_web_risk,
            'level_monica'        => $level_monica,
            'nama_lengkap_monica' => $nama_lengkap_monica,
            'untuk_web_monica'    => $untuk_web_monica
        );
    }

    public function index()
    {
        //WEB RISK
        //Notif Insiden
        $data['notifInsiden']  = $this->m_risk->notifInsiden();
        $data['css_arr']       = array('');
        $data['js_arr']        = array('highchart/highcharts.js','highchart/highcharts-more.js',
                                 'highchart/solid-gauge.js');
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

        //WEB MONICA
        $maturity             = $this->maturityaudit->getMaturity();
        $data['maturity_app'] = $maturity['maturity_app'];
        $cek_login            = $this->m_login_kdr->login_kdr();
        $data_array           = $this->data_array;
        
        //ketika belum login
        if(!$cek_login)
        {
            if($data_array['level_risk'] == "superadmin")
            {
                $data['nama_lengkap_kdr'] = $data_array['nama_lengkap_risk'];
                $data['level_kdr']        = $data_array['level_risk'];
                $this->load->view('kdr/v_header_kdr', $data);
                $this->load->view('kdr/v_dashboard_kdr', $data);
            }
            else if($data_array['level_risk'] == "adminkdr")
            {
                $data['nama_lengkap_kdr'] = $data_array['nama_lengkap_risk'];
                $data['level_kdr']        = $data_array['level_risk'];
                $data['notif_dispo']      = '';
                $this->load->view('kdr/v_header_kdr', $data);
                $this->load->view('kdr/v_dashboard_kdr', $data);
            }
            else if(($data_array['level_risk'] == "staffkdr" || $data_array['level_risk'] == "kabagkdr") 
                && $data_array['untuk_web_risk'] == "semua")
            {
                $data['nama_lengkap_kdr'] = $data_array['nama_lengkap_risk'];
                $data['level_kdr']        = $data_array['level_risk'];
                $data['notif_dispo']      = $this->get_notif_dispo();
                $this->load->view('kdr/v_header_kdr', $data);
                $this->load->view('kdr/v_dashboard_kdr', $data);
            }
            else if($data_array['level_risk'] == "nonadmin" && $data_array['untuk_web_risk'] != "kdr")
            {
                $data['nama_lengkap_kdr'] = $data_array['nama_lengkap_risk'];
                $data['level_kdr']        = $data_array['level_risk'];
                $data['untuk_web_kdr']    = $data_array['untuk_web_risk'];
                $this->load->view('kdr/v_header_kdr', $data);
                $this->load->view('kdr/v_dashboard_kdr', $data);
            }

            else if($data_array['level_monica'] == "superadmin")
            {
                $data['nama_lengkap_kdr'] = $data_array['nama_lengkap_monica'];
                $data['level_kdr']        = $data_array['level_monica'];
                $this->load->view('kdr/v_header_kdr', $data);
                $this->load->view('kdr/v_dashboard_kdr', $data);
            }
            else if($data_array['level_monica'] == "adminkdr")
            {
                $data['nama_lengkap_kdr'] = $data_array['nama_lengkap_monica'];
                $data['level_kdr']        = $data_array['level_monica'];
                $data['notif_dispo']      = '';
                $this->load->view('kdr/v_header_kdr', $data);
                $this->load->view('kdr/v_dashboard_kdr', $data);
            }
            else if(($data_array['level_monica'] == "staffkdr" || $data_array['level_monica'] == "kabagkdr") 
                && $data_array['untuk_web_monica'] == "semua")
            {
                $data['nama_lengkap_kdr'] = $data_array['nama_lengkap_monica'];
                $data['level_kdr']        = $data_array['level_monica'];
                $data['notif_dispo']      = $this->get_notif_dispo();
                $this->load->view('kdr/v_header_kdr', $data);
                $this->load->view('kdr/v_dashboard_kdr', $data);
            }
            else if($data_array['level_monica'] == "nonadmin" && $data_array['untuk_web_monica'] != "kdr")
            {
                $data['nama_lengkap_kdr'] = $data_array['nama_lengkap_monica'];
                $data['level_kdr']        = $data_array['level_monica'];
                $data['untuk_web_kdr']    = $data_array['untuk_web_monica'];
                $this->load->view('kdr/v_header_kdr', $data);
                $this->load->view('kdr/v_dashboard_kdr', $data);
            }
            else
            {
                $data['nama_lengkap_kdr'] = "";
                $data['level_kdr']        = "";
                $data['untuk_web_kdr']    = "";
                $this->load->view('kdr/v_header_kdr', $data);
                $this->load->view('kdr/v_dashboard_kdr', $data);
            }
        }
        
        //ketika sudah login
        else
        {
            //jika session sudah terdaftar
            if($cek_login)
            {
                $data['nama_lengkap_kdr'] = $data_array['nama_lengkap_kdr'];
                $data['level_kdr']        = $data_array['level_kdr'];
                $data['untuk_web_kdr']    = $data_array['untuk_web_kdr'];
                $data['notif_dispo']      = $this->get_notif_dispo();
                $this->load->view('kdr/v_header_kdr', $data);
                $this->load->view('kdr/v_dashboard_kdr', $data); 
            }

            //jika session belum terdaftar, maka redirect ke halaman login
            else
            {
                redirect('login_kdr');
            }
        }
        $this->load->view('kdr/v_footer_kdr'); 
    }

    public function get_notif_dispo()
    {
        $data_array   = $this->data_array;
        $level_kdr    = $data_array['level_kdr'];
        $level_risk   = $data_array['level_risk'];
        $level_monica = $data_array['level_monica'];
        $id_user      = $data_array['id_user'];

        if($level_kdr == "adminkdr" || $level_risk == "adminkdr" || $level_monica == "adminkdr")
        {
            $data['notif_dispo'] = '';
            return $data['notif_dispo'];
        }
        else if($level_kdr == "staffkdr" || $level_risk == "staffkdr" || $level_monica == "staffkdr")
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

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('dashboard_kdr');
    }
} 