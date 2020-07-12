<?php 
     
class Kegiatan extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('kdr/m_kegiatan','kdr/m_dispo'));
        $level_risk   = $this->session->userdata('level_risk');
        $level_monica = $this->session->userdata('level_monica');

        if($level_risk == "adminkdr" || $level_risk =="staffkdr" || $level_risk =="kabagkdr")
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
        else if($level_monica == "adminkdr" || $level_monica =="staffkdr" || $level_monica =="kabagkdr")
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
        $data         = $this->data_array;
        $level        = $data['level_kdr'];
        $id_user      = $data['id_user'];
        $username_kdr = $data['username_kdr'];
        $tgl_awal     = "";
        $tgl_akhir    = "";

        if($level == "adminkdr")
        {
            $data['kegiatan']    = $this->m_kegiatan->get_kegiatan($tgl_awal,$tgl_akhir);
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_kegiatan', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else if($level == "staffkdr" || $level == "kabagkdr")
        {
            $data['css_arr'] = array('fullcalendar/fullcalendar.css','fullcalendar/bootstrapValidator.min.css');
            $data['js_arr']  = array('fullcalendar/moment.min.js','fullcalendar/bootstrapValidator.min.js',
                                     'fullcalendar/fullcalendar.min.js','fullcalendar/bootstrap-colorpicker.min.js',
                                     'fullcalendar/main.js');
            $data['notif_dispo']  = $this->get_notif_dispo();
            $data['id_user']      = $id_user;
            $data['username_kdr'] = $username_kdr;
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_kegiatanStaff', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else
        {
            redirect(base_url("dashboard_kdr"));
        }
    }

    public function filter_kegiatan()
    {
        $data             = $this->data_array;
        $level            = $data['level_kdr'];
        $format_tgl_awal  = $this->input->post('tgl_awal');
        $tgl_awal         = date("Y-m-d", strtotime($format_tgl_awal));
        $format_tgl_akhir = $this->input->post('tgl_akhir');
        $tgl_akhir        = date("Y-m-d", strtotime($format_tgl_akhir));

        if($level == "adminkdr")
        {
            $data['kegiatan']    = $this->m_kegiatan->get_kegiatan($tgl_awal,$tgl_akhir);
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_kegiatan', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else
        {
            redirect(base_url("dashboard_kdr"));
        }
    }

    public function data_username()
    {
        $user   = $_GET['term'];
        $result = $this->m_kegiatan->get_user($user);
        echo json_encode($result);
    }

    public function tambah_kegiatan()
    {
        $data  = $this->data_array;
        $level = $this->input->post('level_kdr');

        if($level == "adminkdr")
        {
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_tambahKegiatan', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else
        {
            redirect('kdr/kegiatan', 'refresh');
        }
    }

    public function simpan_kegiatan()
    {
        $format_tgl_pelaksanaan = $this->input->post('tgl_pelaksanaan');
        $tgl_pelaksanaan        = date("Y-m-d", strtotime($format_tgl_pelaksanaan));
        $start                  = $tgl_pelaksanaan;
        $format_tgl_berakhir    = $this->input->post('tgl_berakhir');
        $end                    = date("Y-m-d", strtotime($format_tgl_berakhir));
        $title                  = $this->input->post('agenda');
        $warna                  = array("#0071c5","#40E0D0","#008000","#FFD700","#FF8C00","#FF0000","#000");
        $random_keys            = array_rand($warna);
        $color                  = $warna[$random_keys];
        $tempat                 = $this->input->post('tempat');
        $no_surat               = $this->input->post('no_surat');
        $agenda                 = $this->input->post('agenda');
        $pic                    = $this->input->post('pic');
        $kategori               = $this->input->post('kategori');
        $sub_kategori           = $this->input->post('subkategori');
        $user_modified          = "1";
        $data                   = $this->data_array;
        $arraypic               = explode(',', $pic);
        $stringpic              = "'" . implode("','", $arraypic) . "'";
        $get_id_user            = $this->m_kegiatan->get_id_user($stringpic);
        $arrayid                = array();
        foreach($get_id_user as $row)   
        {
            $arrayid[] = $row['id_user']; 
        }
        $id_user                = implode(",",$arrayid);
        $simpan_kegiatan        = $this->m_kegiatan->simpan_kegiatan($id_user,$tgl_pelaksanaan,$start,$end,$title,$color,
                                  $tempat,$no_surat,$agenda,$pic,$kategori,$sub_kategori,$user_modified);
        if($simpan_kegiatan)
        {
            echo '<script language="javascript">';
            echo 'alert("Kegiatan berhasil ditambahkan")';
            echo '</script>';
            redirect('kdr/kegiatan', 'refresh');
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Kegiatan gagal ditambahkan!!!")';
            echo '</script>';
            redirect('kdr/kegiatan', 'refresh');
        }
    }

    public function edit_kegiatan($id_kegiatan,$level_kdr)
    {
        $data  = $this->data_array; 

        if($level_kdr == "adminkdr")
        {
            $data['lihat_kegiatan'] = $this->m_kegiatan->lihat_kegiatan($id_kegiatan);
            $data['notif_dispo']    = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_editKegiatan', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else
        {
            redirect('kdr/kegiatan', 'refresh');
        }
    }

    public function update_kegiatan()
    {
        $id_kegiatan            = $this->input->post('id_kegiatan');
        $format_tgl_pelaksanaan = $this->input->post('tgl_pelaksanaan');
        $tgl_pelaksanaan        = date("Y-m-d", strtotime($format_tgl_pelaksanaan));
        $start                  = $tgl_pelaksanaan;
        $format_tgl_berakhir    = $this->input->post('tgl_berakhir');
        $end                    = date("Y-m-d", strtotime($format_tgl_berakhir));
        $title                  = $this->input->post('agenda');
        $warna                  = array("#0071c5","#40E0D0","#008000","#FFD700","#FF8C00","#FF0000","#000");
        $random_keys            = array_rand($warna);
        $color                  = $warna[$random_keys];
        $tempat                 = $this->input->post('tempat');
        $no_surat               = $this->input->post('no_surat');
        $agenda                 = $this->input->post('agenda');
        $pic                    = $this->input->post('pic');
        $kategori               = $this->input->post('kategori');
        $sub_kategori           = $this->input->post('subkategori');
        $data                   = $this->data_array;
        $arraypic               = explode(',', $pic);
        $stringpic              = "'" . implode("','", $arraypic) . "'";
        $get_id_user            = $this->m_kegiatan->get_id_user($stringpic);
        $arrayid                = array();
        foreach($get_id_user as $row)   
        {
            $arrayid[] = $row['id_user']; 
        }
        $id_user                = implode(",",$arrayid);
        $update_kegiatan        = $this->m_kegiatan->update_kegiatan($id_kegiatan,$id_user,$tgl_pelaksanaan,$start,$end,$title,$color,
                                  $tempat,$no_surat,$agenda,$pic,$kategori,$sub_kategori);
        if($update_kegiatan)
        {
            echo '<script language="javascript">';
            echo 'alert("Kegiatan berhasil diupdate")';
            echo '</script>';
            redirect('kdr/kegiatan', 'refresh');
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Kegiatan gagal diupdate!!!")';
            echo '</script>';
            redirect('kdr/kegiatan', 'refresh');
        }
    }

    public function hapus_kegiatan()
    {
        $id_kegiatan    = $this->input->post('id_kegiatan');
        $hapus_kegiatan = $this->m_kegiatan->hapus_kegiatan($id_kegiatan);

        if($hapus_kegiatan)
        {
            echo '<script language="javascript">';
            echo 'alert("Kegiatan berhasil dihapus")';
            echo '</script>';
            redirect('kdr/kegiatan', 'refresh');
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Kegiatan gagal dihapus!!!")';
            echo '</script>';
            redirect('kdr/kegiatan', 'refresh');
        }
    }

    public function view_kegiatan($id_kegiatan)
    {
        $data  = $this->data_array;
        $level = $data['level_kdr'];

        if($level == "adminkdr" || $level == "staffkdr" || $level == "kabagkdr")
        {
            $data['lihat_kegiatan'] = $this->m_kegiatan->lihat_kegiatan($id_kegiatan);
            $data['notif_dispo']    = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_viewKegiatan', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else
        {
            redirect(base_url("dashboard_kdr"));
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

    Public function kegiatanStaff()
    {
        $data    = $this->data_array;
        $id_user = $data['id_user'];
        $result  = $this->m_kegiatan->kegiatanStaff($id_user);
        echo json_encode($result);
    }

    Public function addKegiatan()
    {
        $warna         = array("#0071c5","#40E0D0","#008000","#FFD700","#FF8C00","#FF0000","#000");
        $random_keys   = array_rand($warna);
        $color         = $warna[$random_keys];
        $user_modified = "0";
        $result        = $this->m_kegiatan->addKegiatan($color,$user_modified);
        echo $result;
    }

    Public function updateKegiatan()
    {
        /*$format_tgl_pelaksanaan = $_POST['tgl_pelaksanaan'];
        $tgl_pelaksanaan        = date("Y-m-d", strtotime($format_tgl_pelaksanaan));*/
        $warna                  = array("#0071c5","#40E0D0","#008000","#FFD700","#FF8C00","#FF0000","#000");
        $random_keys            = array_rand($warna);
        $color                  = $warna[$random_keys];
        $result                 = $this->m_kegiatan->updateKegiatan($color);
        echo $result;
    }

    Public function hapusKegiatan()
    {
        $result = $this->m_kegiatan->hapusKegiatan();
        echo $result;
    }

    /*Public function dragUpdateKegiatan()
    {   
        $result = $this->m_kegiatan->dragUpdateKegiatan();
        echo $result;
    }*/
}

?>