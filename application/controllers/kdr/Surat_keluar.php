<?php 
     
class Surat_keluar extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('kdr/m_surat_keluar','kdr/m_dispo'));
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
        $data      = $this->data_array;
        $level     = $data['level_kdr'];
        $id_user   = $data['id_user'];
        $tgl_awal  = "";
        $tgl_akhir = "";

        if($level == "adminkdr")
        {
            $user_pic         = "";
            $data['surat']    = $this->m_surat_keluar->get_surat($user_pic,$tgl_awal,$tgl_akhir);
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_suratKeluar', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else if($level == "staffkdr" || $level == "kabagkdr")
        {
            $data['surat']       = $this->m_surat_keluar->get_surat($id_user,$tgl_awal,$tgl_akhir);
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_suratKeluar', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else
        {
            redirect(base_url("dashboard_kdr"));
        }
    }

    public function filter_surat()
    {   
        $data             = $this->data_array;
        $level            = $data['level_kdr'];
        $id_user          = $data['id_user'];
        $format_tgl_awal  = $this->input->post('tgl_awal');
        $tgl_awal         = date("Y-m-d", strtotime($format_tgl_awal));
        $format_tgl_akhir = $this->input->post('tgl_akhir');
        $tgl_akhir        = date("Y-m-d", strtotime($format_tgl_akhir));

        if($level == "adminkdr")
        {
            $user_pic         = "";
            $data['surat']    = $this->m_surat_keluar->get_surat($user_pic,$tgl_awal,$tgl_akhir);
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_suratKeluar', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else if($level == "staffkdr" || $level == "kabagkdr")
        {
            $data['surat']       = $this->m_surat_keluar->get_surat($id_user,$tgl_awal,$tgl_akhir);
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_suratKeluar', $data); 
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
        $result = $this->m_surat_keluar->get_user($user);
        echo json_encode($result);
    }

    public function tambah_surat()
    {
        $data  = $this->data_array;
        $level = $this->input->post('level_kdr');

        if($level == "adminkdr")
        {
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_tambahSurat', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else
        {
            redirect('kdr/surat_keluar', 'refresh');
        }
    }

    public function simpan_surat()
    {
        $no_surat               = $this->input->post('no_surat');
        $agenda                 = $this->input->post('agenda');
        $ke_divisi              = $this->input->post('ke_divisi');
        $pic                    = $this->input->post('pic');
        $kategori               = $this->input->post('kategori');
        $sub_kategori           = $this->input->post('subkategori');
        $tanggal                = date("Y-m-d h:i:s");
        $data                   = $this->data_array;
        $arraypic               = explode(',', $pic);
        $stringpic              = "'" . implode("','", $arraypic) . "'";
        $get_id_user            = $this->m_surat_keluar->get_id_user($stringpic);
        $arrayid                = array();
        foreach($get_id_user as $row)   
        {
            $arrayid[] = $row['id_user']; 
        }
        $id_user                = implode(",",$arrayid);
        $simpan_surat           = $this->m_surat_keluar->simpan_surat($id_user,$tanggal,$ke_divisi,$no_surat,$agenda,
                                  $pic,$kategori,$sub_kategori);
        if($simpan_surat)
        {
            echo '<script language="javascript">';
            echo 'alert("Surat keluar berhasil ditambahkan")';
            echo '</script>';
            redirect('kdr/surat_keluar', 'refresh');
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Surat keluar gagal ditambahkan!!!")';
            echo '</script>';
            redirect('kdr/surat_keluar', 'refresh');
        }
    }

    public function edit_surat($id_surat_keluar,$level_kdr)
    {
        $data  = $this->data_array; 

        if($level_kdr == "adminkdr")
        {
            $data['lihat_surat'] = $this->m_surat_keluar->lihat_surat($id_surat_keluar);
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_editSurat', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else
        {
            redirect('kdr/surat_keluar', 'refresh');
        }
    }

    public function update_surat()
    {
        $id_surat_keluar = $this->input->post('id_surat_keluar');
        $no_surat        = $this->input->post('no_surat');
        $agenda          = $this->input->post('agenda');
        $ke_divisi       = $this->input->post('ke_divisi');
        $pic             = $this->input->post('pic');
        $kategori        = $this->input->post('kategori');
        $sub_kategori    = $this->input->post('subkategori');
        $data            = $this->data_array;
        $arraypic        = explode(',', $pic);
        $stringpic       = "'" . implode("','", $arraypic) . "'";
        $get_id_user     = $this->m_surat_keluar->get_id_user($stringpic);
        $arrayid         = array();
        foreach($get_id_user as $row)   
        {
            $arrayid[] = $row['id_user']; 
        }
        $id_user         = implode(",",$arrayid);
        $update_surat    = $this->m_surat_keluar->update_surat($id_surat_keluar,$id_user,$no_surat,$agenda,$pic,$ke_divisi,$kategori,
                           $sub_kategori);
        if($update_surat)
        {
            echo '<script language="javascript">';
            echo 'alert("Surat keluar berhasil diupdate")';
            echo '</script>';
            redirect('kdr/surat_keluar', 'refresh');
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Surat keluar gagal diupdate!!!")';
            echo '</script>';
            redirect('kdr/surat_keluar', 'refresh');
        }
    }

    public function hapus_surat()
    {
        $id_surat_keluar = $this->input->post('id_surat_keluar');
        $hapus_surat     = $this->m_surat_keluar->hapus_surat($id_surat_keluar);

        if($hapus_surat)
        {
            echo '<script language="javascript">';
            echo 'alert("Surat keluar berhasil dihapus")';
            echo '</script>';
            redirect('kdr/surat_keluar', 'refresh');
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Surat keluar gagal dihapus!!!")';
            echo '</script>';
            redirect('kdr/surat_keluar', 'refresh');
        }
    }

    public function view_surat($id_surat_keluar)
    {
        $data  = $this->data_array;
        $level = $data['level_kdr'];

        if($level == "adminkdr" || $level == "staffkdr" || $level == "kabagkdr")
        {
            $data['lihat_surat'] = $this->m_surat_keluar->lihat_surat($id_surat_keluar);
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_viewSurat', $data); 
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

}

?>