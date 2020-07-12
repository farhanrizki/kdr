<?php 
     
class Hari_libur extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('kdr/m_libur'));
        $level_risk   = $this->session->userdata('level_risk');
        $level_monica = $this->session->userdata('level_monica');

        if($level_risk == "adminkdr")
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

            if($status_kdr != "login" || $level_kdr != "adminkdr")
            {
                redirect(base_url("dashboard_kdr"));
            }
        } 
        else if($level_monica == "adminkdr")
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

            if($status_kdr != "login" || $level_kdr != "adminkdr")
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

            if($status_kdr != "login" || $level_kdr != "adminkdr")
            {
                redirect(base_url("dashboard_kdr"));
            }
        }
    }

    public function index()
    {   
        $data                = $this->data_array;
        $data['css_arr']     = array('bootstrap-tagsinput.css','jquery-ui.css');
        $data['js_arr']      = array('bootstrap-tagsinput.js');
        $data['notif_dispo'] = $this->get_notif_dispo();
        $this->load->view('kdr/v_header_kdr', $data);
        $this->load->view('kdr/v_tambahHariLibur', $data); 
        $this->load->view('kdr/v_footer_kdr');
    }

    public function data_hari_libur()
    {
        $list = $this->m_libur->get_hari_libur();
        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $app) 
        {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $app->tgl_libur;

            //add html for action
            $row[] = '<div style="text-align: center"><a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_libur('."'".$app->id_tgl_libur."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a></div>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw"            => $_POST['draw'],
                        "recordsTotal"    => $this->m_libur->count_all_libur(),
                        "recordsFiltered" => $this->m_libur->count_filtered_libur(),
                        "data"            => $data,
                    );
        //output to json format
        echo json_encode($output);
    }

    public function edit_hari_libur($id_tgl_libur)
    {
        $data = $this->m_libur->get_id_tgl_libur($id_tgl_libur);
        echo json_encode($data);
    }

    public function update_hari_libur()
    {
        $format_tgl_libur  = $this->input->post('tgl_libur');
        $tgl_libur         = date("Y-m-d", strtotime($format_tgl_libur));

        $data = array('tgl_libur' => $tgl_libur);
        $this->m_libur->update_hari_libur(array('id_tgl_libur' => $this->input->post('id_tgl_libur')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function tambah()
    {
        $format_holidays = $this->input->post('holidays');
        $array_holidays  = explode(',', $format_holidays);
        $holidays        = array_map(function ($date) 
        {
            return date('Y-m-d', strtotime($date));
        }, $array_holidays);

        $tgl_libur = "('".implode("'),('",$holidays)."')";
        $simpan    = $this->m_libur->simpan_libur($tgl_libur);

        if($simpan)
        {
            echo '<script language="javascript">';
            echo 'alert("Tanggal libur berhasil disimpan")';
            echo '</script>';
            redirect('kdr/hari_libur', 'refresh'); 
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Tanggal libur gagal disimpan!")';
            echo '</script>';
            redirect('kdr/hari_libur', 'refresh'); 
        }
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