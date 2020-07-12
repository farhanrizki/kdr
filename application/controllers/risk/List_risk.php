<?php 
     
class List_risk extends CI_Controller{
	var $data_array;

	function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('risk/m_list_risk');
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
    	if(isset($_POST['tambahlistrisk'])) 
        {
        	$this->tambah_list_risk();
        }
        else if(isset($_POST['updatelistrisk']))
        {
        	$this->update_list_risk();
        }
        else if(isset($_POST['hapuslistrisk']))
        {
        	$this->hapus_list_risk();
        }
        else
        {
			$data                   = $this->data_array;
			$data['data_list_risk'] = $this->m_list_risk->data_list_risk();
			$data['data_kategori']  = $this->m_list_risk->data_kategori();
			$this->load->view('risk/v_header_risk', $data);
	    	$this->load->view('risk/v_listRisk', $data); 
	    	$this->load->view('risk/v_footer_risk'); 
        }
    }

    public function tambah_list_risk()
    {
    	$id_kategori_risk       = $this->input->post('id_kategori_risk');
		$nama_risk              = $this->input->post('nama_risk');
		$bobot_risk             = $this->input->post('bobot_risk');
		$kontrol_skor           = $this->input->post('kontrol_skor');
		$user_modified          = $this->input->post('id_user');
		$date_modified          = date("Y-m-d h:i:s");
		$simpan                 = $this->m_list_risk->tambah_list_risk($id_kategori_risk,$nama_risk,$bobot_risk,
								  $kontrol_skor,$user_modified,$date_modified);
		$data                   = $this->data_array;
		$data['data_list_risk'] = $this->m_list_risk->data_list_risk();
		$data['data_kategori']  = $this->m_list_risk->data_kategori();
		
		$this->load->view('risk/v_header_risk', $data);
		if($simpan)
		{
			$data['berhasil_simpan'] = '<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								            <p style="font-weight:bold;">List Risk berhasil ditambahkan</p>
								        </div>';
	    	$this->load->view('risk/v_listRisk', $data); 
		}
		else
		{
			$data['gagal_simpan'] = '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							            <p style="font-weight:bold;">List Risk gagal ditambahkan</p>
							        </div>';
	    	$this->load->view('risk/v_listRisk', $data);
		}
		$this->load->view('risk/v_footer_risk'); 
    }

    public function update_list_risk()
    {
		$id_list_risk           = $this->input->post('id_list_risk');
		$id_kategori_risk       = $this->input->post('id_kategori_risk');
		$nama_risk              = $this->input->post('nama_risk');
		$bobot_risk             = $this->input->post('bobot_risk');
		$user_modified          = $this->input->post('id_user');
		$date_modified          = date("Y-m-d h:i:s");

		for ($i = 0; $i < count($id_list_risk); $i++) 
        {
			$id               = $id_list_risk[$i];
			$id_kategori_risk = $id_kategori_risk[$id];
			$bobot_risk       = $bobot_risk[$id];
			$update     	  = $this->m_list_risk->update_list_risk($id,$id_kategori_risk,$nama_risk,$bobot_risk,
								$user_modified,$date_modified);
        }

        $data                   = $this->data_array;
		$data['data_list_risk'] = $this->m_list_risk->data_list_risk();
		$data['data_kategori']  = $this->m_list_risk->data_kategori();
		
		$this->load->view('risk/v_header_risk', $data);
		if($update)
		{
			$data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								            <p style="font-weight:bold;">Risk berhasil diupdate</p>
								        </div>';
	    	$this->load->view('risk/v_listRisk', $data); 
		}
		else
		{
			$data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							            <p style="font-weight:bold;">Risk gagal diupdate</p>
							        </div>';
	    	$this->load->view('risk/v_listRisk', $data);
		}
		$this->load->view('risk/v_footer_risk'); 
    }

    public function hapus_list_risk()
    {
		$id_list_risk           = $this->input->post('id_list_risk');
		$hapus                  = $this->m_list_risk->hapus_list_risk($id_list_risk);
		$data                   = $this->data_array;
		$data['data_list_risk'] = $this->m_list_risk->data_list_risk();
		$data['data_kategori']  = $this->m_list_risk->data_kategori();
		$this->load->view('risk/v_header_risk', $data);
		if($hapus)
		{
			$data['berhasil_hapus'] = '<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								            <p style="font-weight:bold;">Data Risk telah di hapus</p>
								        </div>';
	    	$this->load->view('risk/v_listRisk', $data); 
		}
		else
		{
			$data['gagal_hapus'] = '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							            <p style="font-weight:bold;">Data Risk gagal di hapus</p>
							        </div>';
	    	$this->load->view('risk/v_listRisk', $data);
		}
		$this->load->view('risk/v_footer_risk');
    }
}

?>