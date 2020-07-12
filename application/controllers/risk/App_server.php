<?php 
     
class App_server extends CI_Controller{
	var $data_array;

	function __construct()
    {
        parent::__construct();
        $this->load->model('risk/m_app_server');
		$level_kdr    = $this->session->userdata('level_kdr');
		$level_monica = $this->session->userdata('level_monica');

        if($level_kdr == "staffkdr" || $level_kdr == "kabagkdr")
        {
            $id_user           = $this->session->userdata('id_user');
            $nama_lengkap_risk = $this->session->userdata('nama_lengkap_kdr');
            $username_risk     = $this->session->userdata('username_kdr');
            $level_risk        = $this->session->userdata('level_kdr');
            $nama_bagian_risk  = $this->session->userdata('nama_bagian_kdr');
			$status_risk       = "login";

			$this->data_array = array(
				'id_user'           => $id_user,
				'nama_lengkap_risk' => $nama_lengkap_risk,
				'username_risk'     => $username_risk,
				'level_risk'        => $level_risk,
				'nama_bagian_risk'  => $nama_bagian_risk,
				'status_risk'       => $status_risk
	        );
	        if($status_risk != "login" || $level_risk == "superadmin" || $level_risk == "adminkdr" 
                || $level_risk == "nonadmin")
			{
				redirect(base_url("risk/dashboard_risk"));
			}
        } 
        else if($level_monica == "staffkdr" || $level_monica == "kabagkdr")
        {
        	$id_user           = $this->session->userdata('id_user');
			$nama_lengkap_risk = $this->session->userdata('nama_lengkap_monica');
			$username_risk     = $this->session->userdata('username_monica');
			$level_risk        = $this->session->userdata('level_monica');
			$nama_bagian_risk  = $this->session->userdata('nama_bagian_monica');
			$status_risk       = "login";

			$this->data_array = array(
				'id_user'           => $id_user,
				'nama_lengkap_risk' => $nama_lengkap_risk,
				'username_risk'     => $username_risk,
				'level_risk'        => $level_risk,
				'nama_bagian_risk'  => $nama_bagian_risk,
				'status_risk'       => $status_risk
	        );
	        if($status_risk != "login" || $level_risk == "superadmin" || $level_risk == "adminkdr" 
                || $level_risk == "nonadmin")
			{
				redirect(base_url("risk/dashboard_risk"));
			}
        }
        else
        {
        	$id_user           = $this->session->userdata('id_user');
			$nama_lengkap_risk = $this->session->userdata('nama_lengkap_risk');
			$username_risk     = $this->session->userdata('username_risk');
			$level_risk        = $this->session->userdata('level_risk');
			$nama_bagian_risk  = $this->session->userdata('nama_bagian_risk');
			$status_risk       = $this->session->userdata('status_risk');

			$this->data_array = array(
				'id_user'           => $id_user,
				'nama_lengkap_risk' => $nama_lengkap_risk,
				'username_risk'     => $username_risk,
				'level_risk'        => $level_risk,
				'nama_bagian_risk'  => $nama_bagian_risk,
				'status_risk'       => $status_risk
	        );

	        if($status_risk != "login" || $level_risk == "superadmin" || $level_risk == "adminkdr"
                || $level_risk == "nonadmin")
			{
				redirect(base_url("risk/dashboard_risk"));
			}
        }
    }

    public function index()
    {	
        $data = $this->data_array;
		$this->load->view('risk/v_header_risk', $data);
        $this->load->view('risk/v_appServer', $data); 
        $this->load->view('risk/v_footer_risk'); 
    }

    //List app
    public function data_list_app()
    {
        $list = $this->m_app_server->get_list_app();
        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $app) 
        {
            $no++;
            $row = array();
            $row[] = $app->nama_app;
            $row[] = $app->bia_app;
            $row[] = '<div style="text-align: center">
                <a class="btn btn-sm btn-success" href="javascript:void()" title="Tampil" onclick="tampil_app('."'".$app->id_list_app."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
                <a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_app('."'".$app->id_list_app."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
                <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_app('."'".$app->id_list_app."'".')"><i class="glyphicon glyphicon-trash"></i></a></div>';
            //<a class="btn btn-sm btn-success" href="javascript:void()" title="Tampil" onclick="tampil_app('."'".$app->id_list_app."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
            $data[] = $row;
        }

        $output = array(
                        "draw"            => $_POST['draw'],
                        "recordsTotal"    => $this->m_app_server->count_all_list_app(),
                        "recordsFiltered" => $this->m_app_server->count_filtered_list_app(),
                        "data"            => $data,
                    );
        echo json_encode($output);
    }

    public function detail_list_app($id_list_app)
    {
        $detail = $this->m_app_server->detail_list_app($id_list_app);
        echo json_encode($detail);
    }

    public function detail_list_app2($ip_server)
    {
        $detail = $this->m_app_server->detail_list_app2($ip_server);
        foreach($detail as $row) 
        {
            $nama_array[] = $row['nama_app'];
        }
        $nama_app = implode(",",$nama_array);
        echo json_encode($nama_app);
    }

    public function edit_list_app($id_list_app)
    {
        $data = $this->m_app_server->get_id_list_app($id_list_app);
        echo json_encode($data);
    }

    public function update_list_app()
    {
        $data = array(
                'nama_app' => $this->input->post('nama_app'),
                'bia_app'  => $this->input->post('bia_app')
            );
        $this->m_app_server->update_list_app(array('id_list_app' => $this->input->post('id_list_app')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus_list_app($id_list_app)
    {
        $select1 = $this->m_app_server->select1($id_list_app);
        foreach($select1 as $row)
        {
            $array_id_server1[] = $row['id_server'];
        }
        $id_server1 = implode(",",$array_id_server1);

        $select2 = $this->m_app_server->select2($id_server1);
        foreach($select2 as $row)
        {
            $array_id_app_server[] = $row['id_app_server'];
            $array_id_server2[]    = $row['id_server'];

            //Cari duplicate array
            $array_double = array();
            foreach(array_count_values($array_id_server2) as $val => $row)
            if($row > 1) $array_double[] = $val;
           
            $pisahin_array_double = array_diff($array_id_server2, $array_double);
            $array_single         = array_values($pisahin_array_double);
        }
        $double        = implode(",",$array_double);
        $single        = implode(",",$array_single);
        $id_app_server = implode(",",$array_id_app_server);
        $id_server2    = implode(",",$array_id_server2);
        $jml_server1   = count($array_id_server1);
        $jml_server2   = count($array_id_server2);

        if($jml_server1 < $jml_server2)
        {
            $server_double = $this->m_app_server->get_server($double,$id_list_app);
            foreach($server_double as $row)
            {
                $app_server_double[] = $row['id_app_server'];
            }
            $id_app_server_double = implode(",",$app_server_double);

            if($single != "" || $single != NULL)
            {
                $server_single = $this->m_app_server->get_server($single,$id_list_app);
                foreach($server_single as $row)
                {
                    $app_server_single[] = $row['id_app_server'];
                    $server_single_aja[] = $row['id_server'];
                }
                $id_app_server_single = implode(",",$app_server_single);
                $id_server_single     = implode(",",$server_single_aja);

                $this->m_app_server->delete_current_risk($id_app_server_double);
                $this->m_app_server->delete_current_risk($id_app_server_single);
                $this->m_app_server->delete_maping($id_app_server_double);
                $this->m_app_server->delete_maping($id_app_server_single);
                $this->m_app_server->delete_server($id_server_single);
                $this->m_app_server->delete_app($id_list_app);
            }
            else
            {
                $this->m_app_server->delete_current_risk($id_app_server_double);
                $this->m_app_server->delete_maping($id_app_server_double);
                $this->m_app_server->delete_app($id_list_app);
            }
        }
        else
        {
            $this->m_app_server->delete_current_risk($id_app_server);
            $this->m_app_server->delete_maping($id_app_server);
            $this->m_app_server->delete_server($id_server2);
            $this->m_app_server->delete_app($id_list_app);
        }
        echo json_encode(array("status" => TRUE));
    }


    //List server
    public function data_list_server()
    {
        $list = $this->m_app_server->get_list_server();
        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $server) 
        {
            $no++;
            $row = array();
            $row[] = $server->ip_server;
            $row[] = $server->nama_server;
            $row[] = $server->jenis_server;
            $row[] = '<div style="text-align: center"><a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_server('."'".$server->id_list_server."'".')"><i class="glyphicon glyphicon-trash"></i></a></div>';
            /*$row[] = '<div style="text-align: center"><a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_server('."'".$server->id_list_server."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a></div>';*/
        
            $data[] = $row;
        }

        $output = array(
                        "draw"            => $_POST['draw'],
                        "recordsTotal"    => $this->m_app_server->count_all_list_server(),
                        "recordsFiltered" => $this->m_app_server->count_filtered_list_server(),
                        "data"            => $data,
                    );
        echo json_encode($output);
    }

    public function edit_list_server($id_list_server)
    {
        $data = $this->m_app_server->get_id_list_server($id_list_server);
        echo json_encode($data);
    }

    public function update_list_server()
    {
        $data = array(
                'ip_server'   => $this->input->post('ip_server'),
                'nama_server' => $this->input->post('nama_server')
            );
        $this->m_app_server->update_list_server(array('id_list_server' => $this->input->post('id_list_server')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus_list_server($id_list_server)
    {
        $select4 = $this->m_app_server->select4($id_list_server);
        foreach($select4 as $row)
        {
            $array_id_server[]     = $row['id_server'];
            $array_id_app_server[] = $row['id_app_server'];
            $array_nama_app[]      = $row['nama_app'];
        }
        $jumlah_server = count($array_id_server);

        if($jumlah_server > 1)
        {
            $data  = array(
                'jml_server'    => $jumlah_server,
                'nama_app'      => $array_nama_app,
                'id_app_server' => $array_id_app_server
            );
            echo json_encode($data);
        }
        else
        {
            $id_app    = implode(",",$array_id_app_server);
            $id_server = implode(",",$array_id_server);
            $this->m_app_server->delete_current_risk($id_app);
            $this->m_app_server->delete_maping($id_app);
            $this->m_app_server->delete_server($id_server);
            echo json_encode(array("status" => TRUE));  
        }
    }

    public function hapus_list_server_double()
    {
        //Jika pilih semua
        if(!empty($_POST['pilih_semua'])) 
        {
            foreach($_POST['id_app_server'] as $check) 
            {
                $array_id_app[] = $check; 
            }
            $id_app_server = implode(",",$array_id_app);
            $select5       = $this->m_app_server->select5($id_app_server);
            foreach($select5 as $row)
            {
                $array_id_server[]     = $row['id_server'];
                $array_id_app_server[] = $row['id_app_server'];
            }
            $id_app    = implode(",",$array_id_app_server);
            $id_server = implode(",",$array_id_server);
            $this->m_app_server->delete_current_risk($id_app);
            $this->m_app_server->delete_maping($id_app);
            $this->m_app_server->delete_server($id_server);
        }
        //Jika pilih salah satu
        else
        {
            foreach($_POST['id_app_server'] as $check) 
            {
                $id_app_server = $check; 
            }
            $select5 = $this->m_app_server->select5($id_app_server);
            foreach($select5 as $row)
            {
                $array_id_app_server[] = $row['id_app_server'];
            }
            $id_app = implode(",",$array_id_app_server);
            $this->m_app_server->delete_current_risk($id_app);
            $this->m_app_server->delete_maping($id_app);
        }
        echo json_encode(array("status" => TRUE));  
    }


    //Tambah app
    public function tambah_app()
    {
        $data  = $this->data_array;
        $level = $this->input->post('level_risk');

        if($level == "staffkdr")
        {
            $data                  = $this->data_array;
            $nama_app              = "";
            $data['get_nama_app']  = $this->m_app_server->get_nama_app($nama_app);
            $this->load->view('risk/v_header_risk', $data);
            $this->load->view('risk/v_tambahAppServer', $data); 
            $this->load->view('risk/v_footer_risk'); 
        }
        else
        {
            redirect('kdr/dashboard_risk', 'refresh');
        }
    }

    public function get_ip_server()
    {
        $nama_aplikasi = $this->input->post('nama_aplikasi');
        $data          = $this->m_app_server->get_ip_server($nama_aplikasi);
        echo json_encode($data);
    }

    public function get_ip_db()
    {
        $nama_aplikasi = $this->input->post('nama_aplikasi');
        $data          = $this->m_app_server->get_ip_db($nama_aplikasi);
        echo json_encode($data);
    }

    public function get_bia_app()
    {
        $nama_aplikasi = $this->input->post('nama_aplikasi');
        $data          = $this->m_app_server->get_bia_app($nama_aplikasi);
        echo json_encode($data);
    }

    public function simpan_app()
    {
        $nama_app                 = $this->input->post('nama_app');
        $ip_server                = $this->input->post('ip_server');
        $ip_db                    = $this->input->post('ip_db');
        $bia_app                  = $this->input->post('bia_app');
        $cek_list_app             = $this->m_app_server->cek_list_app($nama_app);
        $cek_list_server_aplikasi = $this->m_app_server->cek_list_server_aplikasi($ip_server);
        $cek_list_server_db       = $this->m_app_server->cek_list_server_db($ip_db);
        
        if($cek_list_app)
        {
            $app    = $this->m_app_server->get_request_id_app($nama_app);
            $id_app = $app['id_list_app'];
        }
        else
        {
            $app    = $this->m_app_server->simpan_list_app($nama_app,$bia_app);
            $id_app = $app['id_app'];
        }

        if($cek_list_server_aplikasi)
        {
            $aplikasi           = $this->m_app_server->get_request_id_aplikasi($ip_server);
            $id_server_aplikasi = $aplikasi['id_list_server'];
        }
        else
        {
            $aplikasi           = $this->m_app_server->simpan_list_server_aplikasi($ip_server,$nama_app);
            $id_server_aplikasi = $aplikasi['id_aplikasi'];
        }

        if($cek_list_server_db)
        {
            $db           = $this->m_app_server->get_request_id_db($ip_db);
            $id_server_db = $db['id_list_server'];
        }
        else
        {
            $db           = $this->m_app_server->simpan_list_server_db($ip_db,$nama_app);
            $id_server_db = $db['id_db'];
        }

        
        $cek_aplikasi = $this->m_app_server->cek_app_server($id_app,$id_server_aplikasi);
        $cek_db       = $this->m_app_server->cek_app_server($id_app,$id_server_db);

        if(!$cek_aplikasi || !$cek_db)
        {
            if(!$cek_aplikasi)
            {
                $this->m_app_server->simpan_appserver($id_app,$id_server_aplikasi);
            }

            if(!$cek_db)
            {
                $this->m_app_server->simpan_appserver($id_app,$id_server_db);
            }
            echo '<script language="javascript">';
            echo 'alert("App dan Server berhasil ditambahkan")';
            echo '</script>';
            redirect('risk/app_server', 'refresh');
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("App dan Server berhasil ditambahkan")';
            echo '</script>';
            redirect('risk/app_server', 'refresh');
        }
    }
}

?>