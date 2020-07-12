<?php 
     
class Manajemen_khusus extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model('kdr/m_kdr');
        $level_risk   = $this->session->userdata('level_risk');
        $level_monica = $this->session->userdata('level_monica');

        if($level_risk == "superadmin")
        {
            $id_user          = $this->session->userdata('id_user');
            $nama_lengkap_kdr = $this->session->userdata('nama_lengkap_risk');
            $username_kdr     = $this->session->userdata('username_risk');
            $level_kdr        = $this->session->userdata('level_risk');
            $nama_bagian_kdr  = $this->session->userdata('nama_bagian_risk');
            $status_kdr       = $this->session->userdata('status_risk');

            $this->data_array = array(
                'id_user'          => $id_user,
                'nama_lengkap_kdr' => $nama_lengkap_kdr,
                'username_kdr'     => $username_kdr,
                'level_kdr'        => $level_kdr,
                'nama_bagian_kdr'  => $nama_bagian_kdr,
                'status_kdr'       => $status_kdr
            );

            if($status_kdr != "login" || $level_kdr != "superadmin")
            {
                redirect(base_url("dashboard_kdr"));
            }
        } 
        else if($level_monica == "superadmin")
        {
            $id_user          = $this->session->userdata('id_user');
            $nama_lengkap_kdr = $this->session->userdata('nama_lengkap_monica');
            $username_kdr     = $this->session->userdata('username_monica');
            $level_kdr        = $this->session->userdata('level_monica');
            $nama_bagian_kdr  = $this->session->userdata('nama_bagian_monica');
            $status_kdr       = $this->session->userdata('status_monica');

            $this->data_array = array(
                'id_user'          => $id_user,
                'nama_lengkap_kdr' => $nama_lengkap_kdr,
                'username_kdr'     => $username_kdr,
                'level_kdr'        => $level_kdr,
                'nama_bagian_kdr'  => $nama_bagian_kdr,
                'status_kdr'       => $status_kdr
            );

            if($status_kdr != "login" || $level_kdr != "superadmin")
            {
                redirect(base_url("dashboard_kdr"));
            }
        } 
        else
        {
            $id_user          = $this->session->userdata('id_user');
            $nama_lengkap_kdr = $this->session->userdata('nama_lengkap_kdr');
            $username_kdr     = $this->session->userdata('username_kdr');
            $level_kdr        = $this->session->userdata('level_kdr');
            $nama_bagian_kdr  = $this->session->userdata('nama_bagian_kdr');
            $status_kdr       = $this->session->userdata('status_kdr');

            $this->data_array = array(
                'id_user'          => $id_user,
                'nama_lengkap_kdr' => $nama_lengkap_kdr,
                'username_kdr'     => $username_kdr,
                'level_kdr'        => $level_kdr,
                'nama_bagian_kdr'  => $nama_bagian_kdr,
                'status_kdr'       => $status_kdr
            );

            if($status_kdr != "login" || $level_kdr != "superadmin")
            {
                redirect(base_url("dashboard_kdr"));
            }
        }
    }

    public function index()
    {
        if(isset($_POST['updateuserkhusus']))
        {
            $this->update_user_khusus();
        }
        else
        {
            $data                     = $this->data_array;
            $data['manajemen_khusus'] = $this->m_kdr->manajemen_khusus();
            $this->load->view('kdr/v_header_kdr', $data);
            $this->load->view('kdr/v_manajemenKhusus', $data); 
            $this->load->view('kdr/v_footer_kdr');
        }
    }

    public function update_user_khusus()
    {
        $id_user                  = $this->input->post('id_user');
        $nama_lengkap             = $this->input->post('nama_lengkap');
        $password_baru            = $this->input->post('password_baru');
        $password_encrypt         = sha1(md5($this->input->post('password_baru', TRUE)));
        $data                     = $this->data_array;
        $data['manajemen_khusus'] = $this->m_kdr->manajemen_khusus();
        
        for ($i = 0; $i < count($id_user); $i++) 
        {
            $id     = $id_user[$i];
            $update = $this->m_kdr->update_user_khusus($id,$nama_lengkap,$password_baru,$password_encrypt);
        }

        $this->load->view('kdr/v_header_kdr', $data);
        if($update)
        {
            $data                     = $this->data_array;
            $data['manajemen_khusus'] = $this->m_kdr->manajemen_khusus();
            $data['berhasil_update'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">User Khusus berhasil diupdate</p>
                                        </div>';
            $this->load->view('kdr/v_manajemenKhusus', $data); 
        }
        else
        {
            $data['gagal_update'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">User Khusus gagal diupdate</p>
                                    </div>';
            $this->load->view('kdr/v_manajemenKhusus', $data);
        }
        $this->load->view('kdr/v_footer_kdr');
    }
}