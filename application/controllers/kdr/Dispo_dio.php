<?php 
     
class Dispo_dio extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model('kdr/m_dispo');
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
        $tgl_awal  = "";
        $tgl_akhir = "";

        if($level == "adminkdr")
        {
            $user_pic            = "";
            $data['dispo']       = $this->m_dispo->get_dispo($user_pic,$tgl_awal,$tgl_akhir);
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_dispoDio', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else if($level == "staffkdr" || $level == "kabagkdr")
        {
            $get_variable        = $this->get_notif_dispo();
            $filter_pic          = $get_variable['filter_pic'];
            $data['dispo']       = $this->m_dispo->get_dispo($filter_pic,$tgl_awal,$tgl_akhir);
            $data['notif_dispo'] = $get_variable['notif_dispo'];
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_dispoDio', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else
        {
            redirect(base_url("dashboard_kdr"));
        }
    }

    public function filter_dispo()
    {
        $data             = $this->data_array;
        $level            = $data['level_kdr'];
        $format_tgl_awal  = $this->input->post('tgl_awal');
        $tgl_awal         = date("Y-m-d", strtotime($format_tgl_awal));
        $format_tgl_akhir = $this->input->post('tgl_akhir');
        $tgl_akhir        = date("Y-m-d", strtotime($format_tgl_akhir));

        if($level == "adminkdr")
        {
            $user_pic            = "";
            $data['dispo']       = $this->m_dispo->get_dispo($user_pic,$tgl_awal,$tgl_akhir);
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_dispoDio', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else if($level == "staffkdr" || $level == "kabagkdr")
        {
            $get_variable        = $this->get_notif_dispo();
            $filter_pic          = $get_variable['filter_pic'];
            $data['dispo']       = $this->m_dispo->get_dispo($filter_pic,$tgl_awal,$tgl_akhir);
            $data['notif_dispo'] = $get_variable['notif_dispo'];
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_dispoDio', $data); 
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
        $result = $this->m_dispo->get_user($user);
        echo json_encode($result);
    }

    public function tambah_dispo()
    {
        $data  = $this->data_array;
        $level = $this->input->post('level_kdr');

        if($level == "adminkdr")
        {
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_tambahDispo', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else
        {
            redirect('kdr/dispo_dio', 'refresh');
        }
    }

    public function simpan_dispo()
    {
        //insert ke dispo
        $no_surat               = $this->input->post('no_surat');
        $agenda                 = $this->input->post('agenda');
        $keterangan             = "-";
        $pic                    = $this->input->post('pic');
        $kategori               = $this->input->post('kategori');
        $sub_kategori           = $this->input->post('subkategori');
        $format_due_date        = $this->input->post('due_date');
        $due_date               = date("Y-m-d", strtotime($format_due_date));
        $tgl_dispo              = date("Y-m-d h:i:s");
        $data                   = $this->data_array;

        //insert ke notif
        $arraypic               = explode(',', $pic);
        $stringpic              = "'" . implode("','", $arraypic) . "'";
        $get_id_user            = $this->m_dispo->get_id_user($stringpic);
        $arrayid                = array();
        foreach($get_id_user as $row)   
        {
            $arrayid[] = $row['id_user']; 
        }
        $id_user                = implode(",",$arrayid);

        $simpan_dispo           = $this->m_dispo->simpan_dispo($id_user,$no_surat,$agenda,
                                  $keterangan,$pic,$kategori,$sub_kategori,$due_date,$tgl_dispo);
        $simpan_notif           = $this->m_dispo->simpan_notif($id_user,$tgl_dispo,$keterangan);
        if($simpan_dispo)
        {
            echo '<script language="javascript">';
            echo 'alert("Dispo berhasil ditambahkan")';
            echo '</script>';
            redirect('kdr/dispo_dio', 'refresh');
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Dispo gagal ditambahkan!!!")';
            echo '</script>';
            redirect('kdr/dispo_dio', 'refresh');
        }
    }

    public function edit_dispo($id_dispodio,$level_kdr)
    {
        $data = $this->data_array; 

        if($level_kdr == "adminkdr")
        {
            $data['lihat_dispo'] = $this->m_dispo->lihat_dispo($id_dispodio);
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_editDispo', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else
        {
            redirect('kdr/dispo_dio', 'refresh');
        }
    }

    public function update_dispo()
    {
        //insert ke dispo
        $id_dispodio            = $this->input->post('id_dispodio');
        $no_surat               = $this->input->post('no_surat');
        $agenda                 = $this->input->post('agenda');
        $keterangan             = "-";
        $pic                    = $this->input->post('pic');
        $kategori               = $this->input->post('kategori');
        $sub_kategori           = $this->input->post('subkategori');
        $format_due_date        = $this->input->post('due_date');
        $due_date               = date("Y-m-d", strtotime($format_due_date));
        $data                   = $this->data_array;
        
        //insert ke notif
        $id                     = "D-".$id_dispodio;
        $arraypic               = explode(',', $pic);
        $stringpic              = "'" . implode("','", $arraypic) . "'";
        $get_id_user            = $this->m_dispo->get_id_user($stringpic);
        $arrayid                = array();
        foreach($get_id_user as $row)   
        {
            $arrayid[] = $row['id_user']; 
        }
        $id_user                = implode(",",$arrayid);
        $update_dispo           = $this->m_dispo->update_dispo($id_dispodio,$id_user,$no_surat,
                                  $agenda,$keterangan,$pic,$kategori,$sub_kategori,$due_date);
        $update_notif           = $this->m_dispo->update_notif2($id,$id_user,$keterangan);
        if($update_dispo)
        {
            echo '<script language="javascript">';
            echo 'alert("Dispo berhasil diupdate")';
            echo '</script>';
            redirect('kdr/dispo_dio', 'refresh');
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Dispo gagal diupdate!!!")';
            echo '</script>';
            redirect('kdr/dispo_dio', 'refresh');
        }
    }

    public function update_tl()
    {
        $id_dispodio   = $this->input->post('id_dispodio');
        $keterangan_tl = $this->input->post('keterangan_tl');
        $tgl_tl        = date("Y-m-d");
        $update_tl     = $this->m_dispo->update_tl($id_dispodio,$keterangan_tl,$tgl_tl);
        echo json_encode($update_tl);
    }

    public function update_done()
    {
        $id_dispodio     = $this->input->post('id_dispodio');
        $keterangan_done = $this->input->post('keterangan_done');
        $tgl_done        = date("Y-m-d");
        $update_done     = $this->m_dispo->update_done($id_dispodio,$keterangan_done,$tgl_done);
        echo json_encode($update_done);
    }

    public function update_keterangan()
    {
        $id_dispodio       = $this->input->post('id_dispodio');
        $keterangan_tl     = $this->input->post('keterangan_tl');
        $keterangan_done   = $this->input->post('keterangan_done');
        $update_keterangan = $this->m_dispo->update_keterangan($id_dispodio,$keterangan_tl,$keterangan_done);
        echo '<script language="javascript">';
        echo 'alert("Update Keterangan Berhasil")';
        echo '</script>';
        redirect('kdr/dispo_dio', 'refresh');
    }

    public function hapus_dispo()
    {
        $id_dispodio = $this->input->post('id_dispodio');
        $id_tambahan = "D-".$id_dispodio;
        $hapus_dispo = $this->m_dispo->hapus_dispo($id_dispodio);
        $hapus_notif = $this->m_dispo->hapus_notif($id_tambahan);

        if($hapus_dispo)
        {
            echo '<script language="javascript">';
            echo 'alert("Dispo berhasil dihapus")';
            echo '</script>';
            redirect('kdr/dispo_dio', 'refresh');
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Dispo gagal dihapus!!!")';
            echo '</script>';
            redirect('kdr/dispo_dio', 'refresh');
        }
    }

    public function view_dispo($id_dispodio,$id_pic)
    {
        $data     = $this->data_array;
        $id_user  = $data['id_user'];
        $level    = $data['level_kdr'];
        $id_dispo = "D-".$id_dispodio;
        $pos      = strpos($id_pic, $id_user);

        if($pos !== false) 
        {
            $filter_pic = $id_user;
        } 
        else 
        {
            $filter_pic = $id_user;
        }

        $get_status = $this->m_dispo->get_status($id_dispo);
        foreach($get_status as $row)
        {
            $stat = $row['status'];
        }

        $compare = explode(',',$stat);

        $status = "";
        if($stat == "")
        {
            $status = $filter_pic;
        }
        else if($stat != "" && in_array($id_user, $compare))
        {
            $status = $stat;
        }
        else
        {
            $status = $stat.','.$filter_pic;
        }

        if($level == "adminkdr")
        {
            $data['lihat_dispo'] = $this->m_dispo->lihat_dispo($id_dispodio);
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_viewDispo', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
        else if($level == "staffkdr" || $level == "kabagkdr")
        {
            $tgl_awal            = "";
            $tgl_akhir           = "";
            $update_notif        = $this->m_dispo->update_notif($id_dispo,$status);
            $data['lihat_dispo'] = $this->m_dispo->lihat_dispo($id_dispodio);
            $get_variable        = $this->get_notif_dispo();
            $filter_pic          = $get_variable['filter_pic'];
            $data['dispo']       = $this->m_dispo->get_dispo($filter_pic,$tgl_awal,$tgl_akhir);
            $data['notif_dispo'] = $get_variable['notif_dispo'];
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_viewDispo', $data); 
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
        else if($level == "staffkdr" || $level == "kabagkdr")
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
                $filter_pic          = $id_user;
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

            return array(
                'notif_dispo' => $data['notif_dispo'],
                'filter_pic'  => $filter_pic
            );
        }
        else
        {

        }
    }
    
    /*public function json_search_country()
    {
        $query  = $this->m_dispo->get();
        $data = array();
        foreach ($query as $key) 
        {
            $data[] = $key['username'];
        }
        echo json_encode($data);
    }*/
}

?>