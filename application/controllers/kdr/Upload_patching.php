<?php 
     
class Upload_patching extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('kdr/m_kdr','kdr/m_dispo'));
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
        if(isset($_POST['upload'])) 
        {
            $this->upload();
        }
        else
        {
            $data                = $this->data_array;
            $data['notif_dispo'] = $this->get_notif_dispo();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_uploadPatching', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
    }

    public function upload()
    {
        $data                = $this->data_array;
        $data['notif_dispo'] = $this->get_notif_dispo();
        $file                = $_FILES['csv']['tmp_name'];

        // Medapatkan ekstensi file csv yang akan diimport.
        $ekstensi  = explode('.', $_FILES['csv']['name']);

        $this->load->view('kdr/v_header_kdr', $data);
        
        // Validasi apakah file yang diupload benar-benar file csv.
        if (strtolower(end($ekstensi)) === 'csv' && $_FILES["csv"]["size"] > 0) 
        {
            $i = 0;
            $handle = fopen($file, "r");
            while (($row = fgetcsv($handle, 2048))) 
            {
                $i++;
                if ($i == 1) continue;

                $date1          = $row[2];
                $tgl1           = str_replace('-', '-', $date1);
                $tgl_permohonan =  date('Y-m-d', strtotime($tgl1));

                $date2          = $row[3];
                $tgl2           = str_replace('-', '-', $date2);
                $tgl_patching   = date('Y-m-d', strtotime($tgl2));
                $simpan         = $this->m_kdr->upload_patching($tgl_permohonan, $tgl_patching, $row[4], $row[5],
                                  $row[6], $row[7], $row[9], $row[10], $row[11], $row[15]);

                /*$dateString1    = $row[1];
                $Date1          = DateTime::createFromFormat('d/m/Y', $dateString1, new DateTimeZone(('UTC')));
                //$tgl_permohonan = $Date1->format('Y-m-d');
                $tgl_permohonan = $dateString1;

                $dateString2    = $row[2];
                $Date2          = DateTime::createFromFormat('d/m/Y', $dateString2, new DateTimeZone(('UTC')));
                //$tgl_patching = $Date2->format('Y-m-d');
                $tgl_patching   = $dateString2;*/
            }
            
            if($simpan)
            {
                $data['berhasil_upload'] = '<div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <p style="font-weight:bold;">Patching berhasil diupload</p>
                                            </div>';
                $this->load->view('kdr/v_uploadPatching', $data);
            }
            else
            {
                $data['gagal_upload'] = '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Patching gagal diupload</p>
                                        </div>';
                $this->load->view('kdr/v_uploadPatching', $data);
            }

            fclose($handle);
        } 
        else 
        {
            $data['tidak_valid'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Format file tidak valid!</p>
                                    </div>';
            $this->load->view('kdr/v_uploadPatching', $data);
        }
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