<?php 
     
class Monitoring extends CI_Controller{
	var $data_array;

	function __construct(){
        parent::__construct();
        $this->load->model('risk/m_monitoring');
		$level_kdr    = $this->session->userdata('level_kdr');
		$level_monica = $this->session->userdata('level_monica');
        if($level_kdr == "staffkdr" || $level_kdr == "kabagkdr"){
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
                || $level_risk == "nonadmin"){
				redirect(base_url("risk/dashboard_risk"));
			}
        }else if($level_monica == "staffkdr" || $level_monica == "kabagkdr"){
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
                || $level_risk == "nonadmin"){
				redirect(base_url("risk/dashboard_risk"));
			}
        }else{
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
                || $level_risk == "nonadmin"){
				redirect(base_url("risk/dashboard_risk"));
			}
        }
    }

    public function index(){
		$bia_app    = "";
		$listapp    = $this->m_monitoring->listapp($bia_app);
		$id_app     = "";
		$nama_app   = "";
		$float      = array();
		foreach($listapp as $dataapp){
			$id_app       = $dataapp['id_list_app'];
			$jml_server   = $this->m_monitoring->jml_server($id_app);
			$count_server = $jml_server['jml_server'];
			$a            = 0;
			$b            = 0;
			$peraplikasi  = $this->m_monitoring->peraplikasi($id_app);
            foreach($peraplikasi as $rowhasil)
            {
                if($rowhasil['id_kategori_risk'] == '1'){
                	$a += $rowhasil['HasilFix'];
                }else{
                	$b += $rowhasil['HasilFix'];
                }
				$nama_app[] = $rowhasil['nama_app'];
            }
			$a_fix      = $a/$count_server;
			$hasil      = ($a_fix+$b);
			$totalsemua = number_format((float)$hasil, 2, '.', '');
			$float[]    = (float)$totalsemua;
		}
		$data            = $this->data_array;
		$data['css_arr'] = array('');
		$data['js_arr']  = array('highchart/highcharts.js','highchart/highcharts-more.js','highchart/solid-gauge.js');
		if($nama_app != ""){
			$jml_nama_app           = array_count_values($nama_app);
			$jumlah_aplikasi        = count($jml_nama_app);
			$total                  = array_sum($float);
			$all_monitoring         = $total/$jumlah_aplikasi;
			$data['all_monitoring'] = $all_monitoring;
		}else{
			$data['all_monitoring'] = 0.00;
		}
		$this->load->view('risk/v_header_risk', $data);
    	$this->load->view('risk/v_monitoring', $data); 
    	$this->load->view('risk/v_footer_risk'); 
    }

    public function per_bia_app(){
		$bia_app  = $this->input->post('bia_app');
		$listapp  = $this->m_monitoring->listapp($bia_app);
		foreach($listapp as $dataapp){
			$id_app       = $dataapp['id_list_app'];
			$nama_app[]   = $dataapp['nama_app'];
			$jml_server   = $this->m_monitoring->jml_server($id_app);
			$count_server = $jml_server['jml_server'];
			$a            = 0;
			$b            = 0;
			$peraplikasi  = $this->m_monitoring->peraplikasi($id_app);
			foreach($peraplikasi as $rowhasil){
				if($rowhasil['id_kategori_risk'] == '1'){
					$a += $rowhasil['HasilFix'];
				}else{
					$b += $rowhasil['HasilFix'];
				}
			}
			$a_fix      = $a/$count_server;
			$hasil      = ($a_fix+$b);
			$totalsemua = number_format((float)$hasil, 2, '.', '');
			$float[]    = (float)$totalsemua;
		}
		$jumlah_aplikasi = count($nama_app);
		$data  = array(
			'hasil_aplikasi'  => $float,
			'nama_aplikasi'   => $nama_app,
			'jumlah_aplikasi' => $jumlah_aplikasi
		);
		echo json_encode($data);
    }

    public function list_score(){
		$data  = $this->data_array;
		$level = $data['level_risk'];
    	if($level == "staffkdr"){
			$id_app_server           = "";
			$data['data_app_server'] = $this->m_monitoring->data_app_server($id_app_server);
    		$this->load->view('risk/v_header_risk', $data);
	    	$this->load->view('risk/v_listScore', $data); 
	    	$this->load->view('risk/v_footer_risk'); 
    	}else{
			redirect('risk/dashboard_risk', 'refresh');
    	}
    }

    public function score_server(){
		$id_app_server = $this->input->post('id_app_server');
		$isi           = '';
		$result_set    = $this->m_monitoring->lihat_score_server($id_app_server);
		$risk_server   = $this->m_monitoring->risk_server();
		$a             = 0;
		$b             = 0;
		foreach($result_set as $result){
    		if($result->score_risk == ""){
        		$count = count($risk_server);
        		for($i=0; $i<$count; $i++)
        		{
        			$score[$i] = "0";
        		}
        	}else{
        		$score[$b] = $result->score_risk;
        	}
        	$b++;
	    }

	    foreach($risk_server as $row){
			$isi .= '
	            <tr>
	                <td>' . $row["nama_risk"] . '</td>
	                <td>' . $score[$a] . '</td>
	            </tr>
            ';
            $a++;
        }
        echo json_encode($isi);
    }

    public function score_aplikasi(){
		$id_app        = $this->input->post('id_app');
		$isi           = '';
		$result_set    = $this->m_monitoring->lihat_score_aplikasi($id_app);
		$risk_aplikasi = $this->m_monitoring->risk_aplikasi();
		$a             = 0;
		$b             = 0;
		foreach($result_set as $result){
    		if($result->score_risk == ""){
        		$count = count($risk_aplikasi);
        		for($i=0; $i<$count; $i++){
        			$score[$i] = "0";
        		}
        	}else{
        		$score[$b] = $result->score_risk;
        	}
        	$b++;
	    }

	    foreach($risk_aplikasi as $row){
			$isi .= '
	            <tr>
	                <td>' . $row["nama_risk"] . '</td>
	                <td>' . $score[$a] . '</td>
	            </tr>
            ';
            $a++;
        }
        echo json_encode($isi);
    }

    public function update_score($id_app_server,$id_app,$id_server){
		$data                       = $this->data_array; 
		$level                      = $data['level_risk'];
		$data['penanda_app_server'] = $id_app_server;
		$data['penanda_id_app']     = $id_app;
		$data['penanda_id_server']  = $id_server;
        if($level == "staffkdr"){
			$data['data_app_server'] = $this->m_monitoring->data_app_server($id_app_server);
			$list_risk_server        = $this->m_monitoring->list_risk_server($id_app_server);
			$list_risk_aplikasi      = $this->m_monitoring->list_risk_aplikasi($id_app_server,$id_app);

			//Jika udah ada skor  di server
			if($list_risk_server){
				$data['score_server_kosong'] = 1;
				$data['list_risk_server']    = $list_risk_server;
			}
			//Jika belum ada skor di server
			else{
				$data['score_server_kosong'] = 0;
				$data['list_risk_server']    = $this->m_monitoring->get_server();
			}

			//Jika udah ada skor di aplikasi
			if($list_risk_aplikasi){
				$data['score_aplikasi_kosong'] = 1;
				$data['list_risk_aplikasi']    = $list_risk_aplikasi;
			}
			//Jika belum ada skor di aplikasi
			else{
				$data['score_aplikasi_kosong'] = 0;
				$data['list_risk_aplikasi']    = $this->m_monitoring->get_aplikasi();
			}
            $this->load->view('risk/v_header_risk', $data);
            $this->load->view('risk/v_updateScore', $data); 
            $this->load->view('risk/v_footer_risk');
        }else{
            redirect('risk/dashboard_risk', 'refresh');
        }
    }

    public function simpan_skor_server(){
		$id_list_risk  = $this->input->post('id_list_risk');
		$id_app_server = $this->input->post('id_app_server');
		$score_risk    = $this->input->post('score_risk');
		$user_modified = $this->input->post('id_user');
		$date_modified = date("Y-m-d h:i:s");
		$app_server    = $this->input->post('app_server');
		$id_app        = $this->input->post('id_app');
		$id_server     = $this->input->post('id_server');
		for ($i = 0; $i < count($id_list_risk); $i++){
			$id     = $id_list_risk[$i];
			$score  = $score_risk[$id];
            $simpan = $this->m_monitoring->simpan_current_risk($id,$id_app_server,$score,$user_modified,
            		  $date_modified);
        }
        $data = $this->data_array;
        if($simpan){
            echo '<script language="javascript">';
            echo 'alert("Score risk server berhasil diupdate")';
            echo '</script>';
            redirect('risk/monitoring/update_score/'.$app_server.'/'.$id_app.'/'.$id_server, 'refresh'); 
        }else{
            echo '<script language="javascript">';
            echo 'alert("Score risk server gagal diupdate!")';
            echo '</script>';
            redirect('risk/monitoring/update_score/'.$app_server.'/'.$id_app.'/'.$id_server, 'refresh');
        }
    }

    public function simpan_skor_aplikasi(){
		$id_list_risk  = $this->input->post('id_list_risk');
		$id_app_server = $this->input->post('id_app_server');
		$score_risk    = $this->input->post('score_risk');
		$user_modified = $this->input->post('id_user');
		$date_modified = date("Y-m-d h:i:s");
		$app_server    = $this->input->post('app_server');
		$id_app        = $this->input->post('id_app');
		$id_server     = $this->input->post('id_server');
		for ($i = 0; $i < count($id_list_risk); $i++){
			$id     = $id_list_risk[$i];
			$score  = $score_risk[$id];
            $simpan = $this->m_monitoring->simpan_current_risk($id,$id_app_server,$score,$user_modified,
            		  $date_modified);
        }
        $data = $this->data_array;
        if($simpan){
            echo '<script language="javascript">';
            echo 'alert("Score risk aplikasi berhasil diupdate")';
            echo '</script>';
            redirect('risk/monitoring/update_score/'.$app_server.'/'.$id_app.'/'.$id_server, 'refresh'); 
        }else{
            echo '<script language="javascript">';
            echo 'alert("Score risk aplikasi gagal diupdate!")';
            echo '</script>';
            redirect('risk/monitoring/update_score/'.$app_server.'/'.$id_app.'/'.$id_server, 'refresh');
        }
    }
}

?>