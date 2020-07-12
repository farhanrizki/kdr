<?php 
     
class Risk_assessment extends CI_Controller{
	var $data_array;

	function __construct()
    {
        parent::__construct();
        $this->load->model('risk/m_risk');
        $level_kdr    = $this->session->userdata('level_kdr');
		$level_monica = $this->session->userdata('level_monica');

        if($level_kdr == "adminkdr" || $level_kdr == "staffkdr" || $level_kdr == "kabagkdr")
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
	        if($status_risk != "login" || $level_risk == "superadmin" || $level_risk == "nonadmin")
			{
				redirect(base_url("risk/dashboard_risk"));
			}
        } 
        else if($level_monica == "adminkdr" || $level_monica == "staffkdr" || $level_monica == "kabagkdr")
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
	        if($status_risk != "login" || $level_risk == "superadmin" || $level_risk == "nonadmin")
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

	        if($status_risk != "login" || $level_risk == "superadmin" || $level_risk == "nonadmin")
			{
				redirect(base_url("risk/dashboard_risk"));
			}
        }
    }

	public function index()
	{
		if(isset($_POST['updatekontrol'])) 
        {
        	$this->update_risk();
        }
        else
        {
			$data                        = $this->data_array;
			$id_user                     = $this->session->userdata('id_user');
			$data['isi_risk_assessment'] = $this->m_risk->isi_risk_assessment($id_user);
			$this->load->view('risk/v_header_risk', $data);
	    	$this->load->view('risk/v_riskAssessment', $data); 
	    	$this->load->view('risk/v_footer_risk'); 
        }
	}

	public function simpan_risk()
	{
		$nilai_matriks = array(array(2,3,4,5,5),
						 array(2,2,3,4,5),
						 array(1,2,2,3,4),
						 array(1,1,2,2,3),
						 array(1,1,1,2,2));

		$id_risk    = $this->input->post('id_risk');
		$impact     = $this->input->post('impact');
		$likelihood = $this->input->post('likelihood');

		for ($i = 0; $i < count($id_risk); $i++) 
		{
			$id           = $id_risk[$i]; 
			$array        = $nilai_matriks[$impact[$id]][$likelihood[$id]];	
			$impactid     = $impact[$id];
			$likelihoodid = $likelihood[$id];       
			$data         = $this->m_risk->simpan_risk($impactid,$likelihoodid,$array,$id);
	    }
	}

	public function update_risk()
	{
		$id_risk    = $this->input->post('id_risk');
		$risk_issue = $this->input->post('risk_issue');

		for ($i = 0; $i < count($id_risk); $i++) 
		{
			$id               = $id_risk[$i];      
			$kontrol_mitigasi = $risk_issue[$id]; 
			$update           = $this->m_risk->update_risk($kontrol_mitigasi,$id);  	
	    }

		$data                        = $this->data_array;
		$id_user                     = $this->session->userdata('id_user');
		$data['isi_risk_assessment'] = $this->m_risk->isi_risk_assessment($id_user);
	    $this->load->view('risk/v_header_risk', $data);
	    if($update)
	    {
	    	$data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								            <p style="font-weight:bold;">Profile risk berhasil diupdate</p>
								        </div>';
	    	$this->load->view('risk/v_riskAssessment', $data);
	    }
	    else
	    {
	    	$data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							            <p style="font-weight:bold;">Profile risk gagal diupdate</p>
							        </div>';
	    	$this->load->view('risk/v_riskAssessment', $data);
	    }
	    $this->load->view('risk/v_footer_risk'); 
	}
}

?>