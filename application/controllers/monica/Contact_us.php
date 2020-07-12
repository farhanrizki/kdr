<?php 
     
class Contact_us extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model('monica/m_contact_us');
        $level_kdr          = $this->session->userdata('level_kdr');
        $level_risk         = $this->session->userdata('level_risk');
        $tidakmemadai       = $this->notif_tidakmemadai();
        $dalampemantauan    = $this->notif_dalampemantauan();
        $id                 = $this->notifaudit->updateNotif();
        $id_tidakmemadai    = implode(",",$id['id_tidakmemadai']);
        $id_dalampemantauan = implode(",",$id['id_dalampemantauan']);

        if($level_kdr == "adminkdr" || $level_kdr == "staffkdr" || $level_kdr == "kabagkdr" || $level_kdr == "nonadmin")
        {
            $id_user             = $this->session->userdata('id_user');
            $nama_lengkap_monica = $this->session->userdata('nama_lengkap_kdr');
            $username_monica     = $this->session->userdata('username_kdr');
            $level_monica        = $this->session->userdata('level_kdr');
            $nama_bagian_monica  = $this->session->userdata('nama_bagian_kdr');
            $status_monica       = $this->session->userdata('status_kdr');

            $this->data_array = array(
                'id_user'             => $id_user,
                'nama_lengkap_monica' => $nama_lengkap_monica,
                'username_monica'     => $username_monica,
                'level_monica'        => $level_monica,
                'nama_bagian_monica'  => $nama_bagian_monica,
                'status_monica'       => $status_monica,
                'tidakmemadai'        => $tidakmemadai,
                'dalampemantauan'     => $dalampemantauan,
                'id_tidakmemadai'     => $id_tidakmemadai,
                'id_dalampemantauan'  => $id_dalampemantauan
            );

            if($status_monica != "login" || $level_monica == "superadmin")
            {
                redirect(base_url("monica/dashboard_monica"));
            }
        }
        else if($level_risk == "adminkdr" || $level_risk == "staffkdr" || $level_risk == "kabagkdr" || $level_risk == "nonadmin")
        {
            $id_user             = $this->session->userdata('id_user');
            $nama_lengkap_monica = $this->session->userdata('nama_lengkap_risk');
            $username_monica     = $this->session->userdata('username_risk');
            $level_monica        = $this->session->userdata('level_risk');
            $nama_bagian_monica  = $this->session->userdata('nama_bagian_risk');
            $status_monica       = $this->session->userdata('status_risk');

            $this->data_array = array(
                'id_user'             => $id_user,
                'nama_lengkap_monica' => $nama_lengkap_monica,
                'username_monica'     => $username_monica,
                'level_monica'        => $level_monica,
                'nama_bagian_monica'  => $nama_bagian_monica,
                'status_monica'       => $status_monica,
                'tidakmemadai'        => $tidakmemadai,
                'dalampemantauan'     => $dalampemantauan,
                'id_tidakmemadai'     => $id_tidakmemadai,
                'id_dalampemantauan'  => $id_dalampemantauan
            );

            if($status_monica != "login" || $level_monica == "superadmin")
            {
                redirect(base_url("monica/dashboard_monica"));
            }
        } 
        else
        {
            $id_user             = $this->session->userdata('id_user');
            $nama_lengkap_monica = $this->session->userdata('nama_lengkap_monica');
            $username_monica     = $this->session->userdata('username_monica');
            $level_monica        = $this->session->userdata('level_monica');
            $nama_bagian_monica  = $this->session->userdata('nama_bagian_monica');
            $status_monica       = $this->session->userdata('status_monica');
            $untuk_web_monica    = $this->session->userdata('untuk_web_monica');

            $this->data_array = array(
                'id_user'             => $id_user,
                'nama_lengkap_monica' => $nama_lengkap_monica,
                'username_monica'     => $username_monica,
                'level_monica'        => $level_monica,
                'nama_bagian_monica'  => $nama_bagian_monica,
                'status_monica'       => $status_monica,
                'untuk_web_monica'    => $untuk_web_monica,
                'tidakmemadai'        => $tidakmemadai,
                'dalampemantauan'     => $dalampemantauan,
                'id_tidakmemadai'     => $id_tidakmemadai,
                'id_dalampemantauan'  => $id_dalampemantauan
            );

            if($status_monica != "login" || $level_monica == "superadmin")
            {
                redirect(base_url("monica/dashboard_monica"));
            }
        }
    }

    public function index()
    {
    	if(isset($_POST['kirimpesan']))
        {
            $this->kirim_pesan();
        }
        else if(isset($_POST['hapuscontactus']))
        {
            $this->hapus_contact_us();
        }
        else
        {
            $data                    = $this->data_array;
            $data['data_contact_us'] = $this->m_contact_us->data_contact_us();
			$this->load->view('monica/v_header_monica', $data);
			$this->load->view('monica/v_contactUs', $data); 
			$this->load->view('monica/v_footer_monica');
        }
	}

	public function kirim_pesan()
	{
		$nama   = $this->input->post('nama');
		$email  = $this->input->post('email');
		$pesan  = $this->input->post('pesan');
		$simpan = $this->m_contact_us->tambah_contact_us($nama,$email,$pesan);
		$data   = $this->data_array;

		$this->load->view('monica/v_header_monica', $data);
		if($simpan)
        {
            $data['data_contact_us'] = $this->m_contact_us->data_contact_us();
            $data['berhasil_terkirim'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Pesan Terkirim, Terima Kasih</p>
                                        </div>';
            $this->load->view('monica/v_contactUs', $data);
        }
        else
        {
            $data['gagal_terkirim'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Oopss ada yang salah, pesan tidak terkirim</p>
                                    </div>';
            $this->load->view('monica/v_contactUs', $data);
        }
        $this->load->view('monica/v_footer_monica');
	}

    public function hapus_contact_us()
    {
        $id_contact_us           = $this->input->post('id_contact_us');
        $hapus                   = $this->m_contact_us->hapus_contact_us($id_contact_us);
        $data                    = $this->data_array;
        $data['data_contact_us'] = $this->m_contact_us->data_contact_us();

        $this->load->view('monica/v_header_monica', $data);
        if($hapus)
        {
            $data['berhasil_hapus'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Data telah di hapus</p>
                                        </div>';
            $this->load->view('monica/v_contactUs', $data);
        }
        else
        {
            $data['gagal_hapus'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Data gagal di hapus</p>
                                    </div>';
            $this->load->view('monica/v_contactUs', $data);
        }
        $this->load->view('monica/v_footer_monica');
    }

    public function notif_tidakmemadai(){
        $getNotif     = $this->notifaudit->getNotif();
        $tidakmemadai = $getNotif[0]['jumlah_notif'];
        return $tidakmemadai;
    }

    public function notif_dalampemantauan(){
        $getNotif        = $this->notifaudit->getNotif();
        $dalampemantauan = $getNotif[1]['jumlah_notif'];
        return $dalampemantauan;
    }
}