<?php 
     
class Persetujuan extends CI_Controller{
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
        if(isset($_POST['persetujuantambah'])) 
        {
            $this->persetujuan_tambah();
        }
        else if(isset($_POST['persetujuanedit'])) 
        {
            $this->persetujuan_edit();
        }
        else if(isset($_POST['persetujuanhapus'])) 
        {
            $this->persetujuan_hapus();
        }
        else if(isset($_POST['bataltambah'])) 
        {
            $this->batal_tambah();
        }
        else if(isset($_POST['bataledit'])) 
        {
            $this->batal_edit();
        }
        else if(isset($_POST['batalhapus'])) 
        {
            $this->batal_hapus();
        }
        else
        {
            $data = $this->data_array;
            $data['data_persetujuan'] = $this->m_risk->data_persetujuan();
            $this->load->view('risk/v_header_risk', $data);
            $this->load->view('risk/v_persetujuan', $data); 
            $this->load->view('risk/v_footer_risk');
        }
    }

    public function persetujuan_tambah()
    {
        $id_risk                  = $this->input->post('id_risk');
        $risk_issue_tambah        = $this->input->post('risk_issue_tambah');
        $tambah_user              = 0;
        $null                     = null;
        $tambah                   = $this->m_risk->tambah_persetujuan($id_risk,$risk_issue_tambah,$tambah_user,$null);
        $data                     = $this->data_array;
        $data['data_persetujuan'] = $this->m_risk->data_persetujuan();
        $this->load->view('risk/v_header_risk', $data);
        if($tambah)
        {
            $data['berhasil_tambah'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Tambah risk issue berhasil</p>
                                        </div>';
            $this->load->view('risk/v_persetujuan', $data); 
        }
        else
        {
            $data['gagal_tambah'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Tambah risk issue gagal</p>
                                    </div>';
            $this->load->view('risk/v_persetujuan', $data);
        }
        $this->load->view('risk/v_footer_risk');
    }

    public function persetujuan_edit()
    {
        $id_risk                  = $this->input->post('id_risk');
        $risk_issue_edit          = $this->input->post('risk_issue_edit');
        $edit_user                = 0;
        $null                     = null;
        $update                   = $this->m_risk->update_persetujuan($id_risk,$risk_issue_edit,$edit_user,$null);
        $data                     = $this->data_array;
        $data['data_persetujuan'] = $this->m_risk->data_persetujuan();
        $this->load->view('risk/v_header_risk', $data);
        if($update)
        {
            $data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Update risk issue berhasil</p>
                                        </div>';
            $this->load->view('risk/v_persetujuan', $data); 
        }
        else
        {
            $data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Update risk issue gagal</p>
                                    </div>';
            $this->load->view('risk/v_persetujuan', $data);
        }
        $this->load->view('risk/v_footer_risk');
    }

    public function persetujuan_hapus()
    {
        $id_risk                  = $this->input->post('id_risk');
        $hapus                    = $this->m_risk->hapus_persetujuan($id_risk);
        $data                     = $this->data_array;
        $data['data_persetujuan'] = $this->m_risk->data_persetujuan();
        $this->load->view('risk/v_header_risk', $data);
        if($hapus)
        {
            $data['berhasil_hapus'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Hapus risk issue berhasil</p>
                                        </div>';
            $this->load->view('risk/v_persetujuan', $data); 
        }
        else
        {
            $data['gagal_hapus'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Hapus risk issue gagal</p>
                                    </div>';
            $this->load->view('risk/v_persetujuan', $data);
        }
        $this->load->view('risk/v_footer_risk');
    }

    public function batal_tambah()
    {
        $id_risk                  = $this->input->post('id_risk');
        $tambah                   = $this->m_risk->batal_tambah($id_risk);
        $data                     = $this->data_array;
        $data['data_persetujuan'] = $this->m_risk->data_persetujuan();
        $this->load->view('risk/v_header_risk', $data);
        if($tambah)
        {
            $data['batal_tambah'] = '<div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Data berhasil di hapus</p>
                                    </div>';
            $this->load->view('risk/v_persetujuan', $data); 
        }
        else
        {
            $data['gagal_batal_tambah'] = '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Gagal batal tambah</p>
                                        </div>';
            $this->load->view('risk/v_persetujuan', $data);
        }
        $this->load->view('risk/v_footer_risk');
    }

    public function batal_edit()
    {
        $id_risk                  = $this->input->post('id_risk');
        $edit_user                = 0;
        $null                     = null;
        $edit                     = $this->m_risk->batal_edit($id_risk,$edit_user,$null);
        $data                     = $this->data_array;
        $data['data_persetujuan'] = $this->m_risk->data_persetujuan();
        $this->load->view('risk/v_header_risk', $data);
        if($edit)
        {
            $data['batal_edit'] = '<div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Edit berhasil di batalkan</p>
                                    </div>';
            $this->load->view('risk/v_persetujuan', $data); 
        }
        else
        {
            $data['gagal_batal_edit'] = '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Gagal batal edit</p>
                                        </div>';
            $this->load->view('risk/v_persetujuan', $data);
        }
        $this->load->view('risk/v_footer_risk');
    }

    public function batal_hapus()
    {
        $id_risk                  = $this->input->post('id_risk');
        $hapus_user               = 0;
        $hapus                    = $this->m_risk->batal_hapus($id_risk,$hapus_user);
        $data                     = $this->data_array;
        $data['data_persetujuan'] = $this->m_risk->data_persetujuan();
        $this->load->view('risk/v_header_risk', $data);
        if($hapus)
        {
            $data['batal_hapus'] = '<div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Hapus berhasil di batalkan</p>
                                    </div>';
            $this->load->view('risk/v_persetujuan', $data); 
        }
        else
        {
            $data['gagal_batal_hapus'] = '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Gagal batal hapus</p>
                                        </div>';
            $this->load->view('risk/v_persetujuan', $data);
        }
        $this->load->view('risk/v_footer_risk');
    }
}