<?php 
     
class Ubah_password extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('risk/m_risk');
        $level_kdr    = $this->session->userdata('level_kdr');
        $level_monica = $this->session->userdata('level_monica');

        if($level_kdr == "superadmin" || $level_kdr == "adminkdr" || $level_kdr == "staffkdr" || $level_kdr == "kabagkdr" || $level_kdr == "nonadmin")
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
            if($status_risk != "login" || $level_risk == "nonadmin")
            {
                redirect(base_url("risk/dashboard_risk"));
            }
        } 
        else if($level_monica == "superadmin" || $level_monica == "adminkdr" || $level_monica == "staffkdr" 
            || $level_monica == "kabagkdr" || $level_monica == "nonadmin")
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
            if($status_risk != "login" || $level_risk == "nonadmin")
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

            if($status_risk != "login" || $level_risk == "nonadmin")
            {
                redirect(base_url("risk/dashboard_risk"));
            }
        }
    }

    public function index()
    {
    	if(isset($_POST['ubahpassword'])) 
        {
        	$this->ubah_password();
        }
        else
        {
        	$data = $this->data_array;
	    	$this->load->view('risk/v_header_risk', $data);
	    	$this->load->view('risk/v_ubahPassword', $data); 
	    	$this->load->view('risk/v_footer_risk');
        }
    }

    public function ubah_password()
    {
		$id_user             = $this->session->userdata('id_user');
		$password_lama       = $this->input->post('password_lama');
		$password_baru       = $this->input->post('password_baru');
		$konfirmasi_password = $this->input->post('konfirmasi_password');
		$password_lama_sha   = sha1(md5($password_lama));
		$password_baru_sha   = sha1(md5($password_baru));
		$cek_password        = $this->m_risk->cek_password($id_user,$password_lama_sha);
		$data                = $this->data_array;
		$this->load->view('risk/v_header_risk', $data);

		//Sama dengan database
		if($cek_password != false)
		{
			//Password baru = konfirmasi password
			if($password_baru == $konfirmasi_password)
			{
				$update = $this->m_risk->update_password($id_user,$password_baru_sha);

				if($update)
				{
					$data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										            <p style="font-weight:bold;">Password berhasil diubah</p>
										        </div>';
    				$this->load->view('risk/v_ubahPassword', $data);
				}
				else
				{
					$data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									            <p style="font-weight:bold;">Password gagal diubah</p>
									        </div>';
    				$this->load->view('risk/v_ubahPassword', $data);
				}
			}

			//Password baru != konfirmasi password
			else
			{
				$data['beda_dengan_konfirmasi'] = '<div class="alert alert-danger alert-dismissable">
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											            <p style="font-weight:bold;">Password baru tidak cocok dengan konfirmasi password</p>
											        </div>';
	    		$this->load->view('risk/v_ubahPassword', $data);
			}
		}

		//Tidak sama dengan database
		else
		{
			$data['beda_dengan_database'] = '<div class="alert alert-danger alert-dismissable">
									            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									            <p style="font-weight:bold;">Password lama tidak cocok dengan di database</p>
						            		</div>';  
            $this->load->view('risk/v_ubahPassword', $data);
		}
		$this->load->view('risk/v_footer_risk');
    }
}