<?php 
     
class Eksport_excel extends CI_Controller{
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
    	if(isset($_POST['exportexcel'])) 
        {
            $this->export_excel();
        }
        else
        {
            $data = $this->data_array;
            $this->load->view('risk/v_header_risk', $data);
            $this->load->view('risk/v_exportExcel', $data); 
            $this->load->view('risk/v_footer_risk');
        }
    }

    public function export_excel()
    {
        $tgl_awal         = $this->input->post('tanggal_awal');
        $tgl_akhir        = $this->input->post('tanggal_akhir');
        $format_tgl_awal  = date("Y-m-d", strtotime($tgl_awal));
        $format_tgl_akhir = date("Y-m-d", strtotime($tgl_akhir));
        $data             = $this->m_risk->export_excel($format_tgl_awal, $format_tgl_akhir);
        $datasemua = array
                        (   
                            'isiexcel'   => $data,
                            'tgl_awal'   => $format_tgl_awal,
                            'tgl_akhir'  => $format_tgl_akhir
                        );
        $this->load->view('risk/v_tampilExcel', $datasemua);
    }
}

?>