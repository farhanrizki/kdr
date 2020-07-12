<?php 
     
class Edit_bobot extends CI_Controller{
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
    	if(isset($_POST['editbobot'])) 
        {
        	$this->edit_bobot();
        }
        else
        {
        	$data = $this->data_array;
	    	$data['tampil_bobot'] = $this->m_risk->tampil_bobot();
	    	$this->load->view('risk/v_header_risk', $data);
	    	$this->load->view('risk/v_editBobot', $data); 
	    	$this->load->view('risk/v_footer_risk');
        }
    }

    public function edit_bobot()
    {
		$pqa = $this->input->post('pqa');
		$inf = $this->input->post('inf');
		$shd = $this->input->post('shd');
		$ost = $this->input->post('ost');
		$osd = $this->input->post('osd');
		$opl = $this->input->post('opl');
		$isd = $this->input->post('isd');
		$pen = $this->input->post('pen');
		$tik = $this->input->post('tik');
		$kdr = $this->input->post('kdr');

		$jumlah = $pqa + $inf + $shd + $ost + $osd + $opl + $isd + $pen + $tik + $kdr;
		
		if($jumlah > 100)
		{
			echo "<script type='text/javascript'>
			alert('Jumlah bobot tidak boleh melebihi 100');
			window.location = ' ';
			</script>";
		}
		else if($jumlah < 100)
		{
			echo "<script type='text/javascript'>
			alert('Jumlah bobot tidak boleh kurang dari 100');
			window.location = ' ';
			</script>";
		}
		else
		{
			$update               = $this->m_risk->update_bobot($pqa,$inf,$shd,$ost,$osd,$opl,$isd,$pen,$tik,$kdr);
			$data                 = $this->data_array;
			$data['tampil_bobot'] = $this->m_risk->tampil_bobot();
			$this->load->view('risk/v_header_risk', $data);
			if($update)
			{
				$data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									            <p style="font-weight:bold;">Edit bobot berhasil diupdate</p>
									        </div>';
	    		$this->load->view('risk/v_editBobot', $data);
			}
			else
			{
				$data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								            <p style="font-weight:bold;">Edit bobot gagal diupdate</p>
								        </div>';
	    		$this->load->view('risk/v_editBobot', $data);
			}
			$this->load->view('risk/v_footer_risk');
		}
    }

}

?>