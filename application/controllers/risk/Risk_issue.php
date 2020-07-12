<?php 
     
class Risk_issue extends CI_Controller{
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
			$footer            = $this->load->view('risk/v_footer_risk', NULL, TRUE);

			$this->data_array = array(
				'id_user'           => $id_user,
				'nama_lengkap_risk' => $nama_lengkap_risk,
				'username_risk'     => $username_risk,
				'level_risk'        => $level_risk,
				'nama_bagian_risk'  => $nama_bagian_risk,
				'status_risk'       => $status_risk,
				'footer'            => $footer
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
			$footer            = $this->load->view('risk/v_footer_risk', NULL, TRUE);

			$this->data_array = array(
				'id_user'           => $id_user,
				'nama_lengkap_risk' => $nama_lengkap_risk,
				'username_risk'     => $username_risk,
				'level_risk'        => $level_risk,
				'nama_bagian_risk'  => $nama_bagian_risk,
				'status_risk'       => $status_risk,
				'footer'            => $footer
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
			$footer            = $this->load->view('risk/v_footer_risk', NULL, TRUE);

			$this->data_array = array(
				'id_user'           => $id_user,
				'nama_lengkap_risk' => $nama_lengkap_risk,
				'username_risk'     => $username_risk,
				'level_risk'        => $level_risk,
				'nama_bagian_risk'  => $nama_bagian_risk,
				'status_risk'       => $status_risk,
				'footer'            => $footer
	        );

	        if($status_risk != "login" || $level_risk == "superadmin" || $level_risk == "nonadmin")
			{
				redirect(base_url("risk/dashboard_risk"));
			}
        }
    }

    public function index()
    {
    	//Untuk login admin
    	if(isset($_POST['tambahrisk'])) 
        {
        	$this->tambah_risk_issue();
        }
        else if(isset($_POST['updaterisk']))
        {
        	$this->update_risk_issue();
        }
        else if(isset($_POST['hapusrisk']))
        {
        	$this->hapus_risk_issue();
        }

        //Untuk login nonadmin
        else if(isset($_POST['tambahriskuser']))
        {
        	$this->tambah_risk_user();
        }
        else if(isset($_POST['updateriskuser']))
        {
        	$this->update_risk_user();
        }
        else if(isset($_POST['hapusriskuser']))
        {
        	$this->hapus_risk_user();
        }
        else
        {
        	$data = $this->data_array;
        	$data['data_risk_issue'] = $this->m_risk->data_risk_issue();
			$this->load->view('risk/v_header_risk', $data);
	    	$this->load->view('risk/v_riskIssue', $data); 
        }
    }

    //Untuk login admin
    public function tambah_risk_issue()
    {
		$id_user                 = $this->input->post('id_user');
		$risk_issue              = $this->input->post('risk_issue');
		$simpan                  = $this->m_risk->tambah_risk_issue($id_user,$risk_issue);
		$data                    = $this->data_array;
		$data['data_risk_issue'] = $this->m_risk->data_risk_issue();
		$this->load->view('risk/v_header_risk', $data);
		if($simpan)
		{
			$data['berhasil_simpan'] = '<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								            <p style="font-weight:bold;">Risk Issue berhasil ditambahkan</p>
								        </div>';
	    	$this->load->view('risk/v_riskIssue', $data); 
		}
		else
		{
			$data['gagal_simpan'] = '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							            <p style="font-weight:bold;">Risk Issue gagal ditambahkan</p>
							        </div>';
	    	$this->load->view('risk/v_riskIssue', $data);
		}
    }

    public function update_risk_issue()
    {
		$id_risk                 = $this->input->post('id_risk');
		$risk_issue              = $this->input->post('risk_issue');
		$update                  = $this->m_risk->update_risk_issue($id_risk,$risk_issue);
		$data                    = $this->data_array;
		$data['data_risk_issue'] = $this->m_risk->data_risk_issue();
		$this->load->view('risk/v_header_risk', $data);
		if($update)
		{
			$data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								            <p style="font-weight:bold;">Risk Issue berhasil diupdate</p>
								        </div>';
	    	$this->load->view('risk/v_riskIssue', $data); 
		}
		else
		{
			$data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							            <p style="font-weight:bold;">Risk Issue gagal diupdate</p>
							        </div>';
	    	$this->load->view('risk/v_riskIssue', $data);
		}
    }

    public function hapus_risk_issue()
    {
		$id_risk                 = $this->input->post('id_risk');
		$hapus                   = $this->m_risk->hapus_risk_issue($id_risk);
		$data                    = $this->data_array;
		$data['data_risk_issue'] = $this->m_risk->data_risk_issue();
		$this->load->view('risk/v_header_risk', $data);
		if($hapus)
		{
			$data['berhasil_hapus'] = '<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								            <p style="font-weight:bold;">Data Risk Issue telah di hapus</p>
								        </div>';
	    	$this->load->view('risk/v_riskIssue', $data); 
		}
		else
		{
			$data['gagal_hapus'] = '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							            <p style="font-weight:bold;">Data Risk Issue gagal di hapus</p>
							        </div>';
	    	$this->load->view('risk/v_riskIssue', $data);
		}
    }

    //Untuk login nonadmin
    public function tambah_risk_user()
    {
		$id_user                 = $this->input->post('id_user');
		$risk_issue_tambah       = $this->input->post('risk_issue');
		$tambah_user             = 1;
		$simpan                  = $this->m_risk->tambah_risk_user($id_user,$risk_issue_tambah,$tambah_user);
		$data                    = $this->data_array;
		$data['data_risk_issue'] = $this->m_risk->data_risk_issue();
		$this->load->view('risk/v_header_risk', $data);
		if($simpan)
		{
			$data['berhasil_simpan_user'] = '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									            <p style="font-weight:bold;">Simpan berhasil, menunggu persetujuan admin KDR</p>
									        </div>';
	    	$this->load->view('risk/v_riskIssue', $data); 
		}
		else
		{
			$data['gagal_simpan'] = '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							            <p style="font-weight:bold;">Risk Issue gagal ditambahkan</p>
							        </div>';
	    	$this->load->view('risk/v_riskIssue', $data);
		}
    }
    
    public function update_risk_user()
    {
		$id_risk                 = $this->input->post('id_risk');
		$risk_issue_edit         = $this->input->post('risk_issue');
		$edit_user				 = 1;
		$update                  = $this->m_risk->update_risk_user($id_risk,$risk_issue_edit,$edit_user);
		$data                    = $this->data_array;
		$data['data_risk_issue'] = $this->m_risk->data_risk_issue();
		$this->load->view('risk/v_header_risk', $data);
		if($update)
		{
			$data['berhasil_update_user'] = '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									            <p style="font-weight:bold;">Update berhasil, menunggu persetujuan admin KDR</p>
									        </div>';
	    	$this->load->view('risk/v_riskIssue', $data); 
		}
		else
		{
			$data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							            <p style="font-weight:bold;">Risk Issue gagal diupdate</p>
							        </div>';
	    	$this->load->view('risk/v_riskIssue', $data);
		}
    }

    public function hapus_risk_user()
    {
		$id_risk                 = $this->input->post('id_risk');
		$hapus_user				 = 1;
		$update                  = $this->m_risk->hapus_risk_user($id_risk,$hapus_user);
		$data                    = $this->data_array;
		$data['data_risk_issue'] = $this->m_risk->data_risk_issue();
		$this->load->view('risk/v_header_risk', $data);
		if($update)
		{
			$data['berhasil_hapus_user'] = '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									            <p style="font-weight:bold;">Hapus berhasil, menunggu persetujuan admin KDR</p>
									        </div>';
	    	$this->load->view('risk/v_riskIssue', $data); 
		}
		else
		{
			$data['gagal_hapus'] = '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							            <p style="font-weight:bold;">Data Risk Issue gagal di hapus</p>
							        </div>';
	    	$this->load->view('risk/v_riskIssue', $data);
		}
    }
 }