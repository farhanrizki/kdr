<?php 
     
class Kategori_risk extends CI_Controller{
	var $data_array;

	function __construct()
    {
        parent::__construct();
        $this->load->model('risk/m_kategori');
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
    	if(isset($_POST['tambahkategori'])) 
        {
        	$this->tambah_kategori();
        }
        else if(isset($_POST['updatekategori']))
        {
        	$this->update_kategori();
        }
        else if(isset($_POST['hapuskategori']))
        {
        	$this->hapus_kategori();
        }
        else
        {
			$data                  = $this->data_array;
			$data['data_kategori'] = $this->m_kategori->data_kategori();
			$this->load->view('risk/v_header_risk', $data);
	    	$this->load->view('risk/v_kategoriRisk', $data); 
	    	$this->load->view('risk/v_footer_risk'); 
        }
    }

    public function tambah_kategori()
    {
		$nama_kategori         = $this->input->post('nama_kategori');
		$bobot_kategori        = $this->input->post('bobot_kategori');
		$simpan                = $this->m_kategori->tambah_kategori($nama_kategori,$bobot_kategori);
		$data                  = $this->data_array;
		$data['data_kategori'] = $this->m_kategori->data_kategori();
		
		$this->load->view('risk/v_header_risk', $data);
		if($simpan)
		{
			$data['berhasil_simpan'] = '<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								            <p style="font-weight:bold;">Kategori Risk berhasil ditambahkan</p>
								        </div>';
	    	$this->load->view('risk/v_kategoriRisk', $data); 
		}
		else
		{
			$data['gagal_simpan'] = '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							            <p style="font-weight:bold;">Kategori Risk gagal ditambahkan</p>
							        </div>';
	    	$this->load->view('risk/v_kategoriRisk', $data);
		}
		$this->load->view('risk/v_footer_risk'); 
    }

    public function update_kategori()
    {
		$id_kategori_risk      = $this->input->post('id_kategori_risk');
		$nama_kategori         = $this->input->post('nama_kategori');
		$bobot_kategori        = $this->input->post('bobot_kategori');
		$update                = $this->m_kategori->update_kategori($id_kategori_risk,$nama_kategori,$bobot_kategori);
		$data                  = $this->data_array;
		$data['data_kategori'] = $this->m_kategori->data_kategori();
		
		$this->load->view('risk/v_header_risk', $data);
		if($update)
		{
			$data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								            <p style="font-weight:bold;">Kategori berhasil diupdate</p>
								        </div>';
	    	$this->load->view('risk/v_kategoriRisk', $data); 
		}
		else
		{
			$data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							            <p style="font-weight:bold;">Kategori gagal diupdate</p>
							        </div>';
	    	$this->load->view('risk/v_kategoriRisk', $data);
		}
		$this->load->view('risk/v_footer_risk'); 
    }

    public function hapus_kategori()
    {
		$id_kategori_risk      = $this->input->post('id_kategori_risk');
		$hapus                 = $this->m_kategori->hapus_kategori($id_kategori_risk);
		$data                  = $this->data_array;
		$data['data_kategori'] = $this->m_kategori->data_kategori();
		$this->load->view('risk/v_header_risk', $data);
		if($hapus)
		{
			$data['berhasil_hapus'] = '<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								            <p style="font-weight:bold;">Data Kategori telah di hapus</p>
								        </div>';
	    	$this->load->view('risk/v_kategoriRisk', $data); 
		}
		else
		{
			$data['gagal_hapus'] = '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							            <p style="font-weight:bold;">Data Kategori Issue gagal di hapus</p>
							        </div>';
	    	$this->load->view('risk/v_kategoriRisk', $data);
		}
		$this->load->view('risk/v_footer_risk');
    }

}
?>