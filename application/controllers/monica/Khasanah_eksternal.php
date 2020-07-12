<?php 
     
class Khasanah_eksternal extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model('monica/m_khasanah');
        $config['upload_path']          = './upload/compliance/eksternal/';
        $config['allowed_types']        = '*';
        $config['max_size']             = 2048000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;
        $config['remove_spaces']        = FALSE;
        $this->load->library('upload', $config);
        $level_kdr          = $this->session->userdata('level_kdr');
        $level_risk         = $this->session->userdata('level_risk');
        $tidakmemadai       = $this->notif_tidakmemadai();
        $dalampemantauan    = $this->notif_dalampemantauan();
        $id                 = $this->notifaudit->updateNotif();
        $id_tidakmemadai    = implode(",",$id['id_tidakmemadai']);
        $id_dalampemantauan = implode(",",$id['id_dalampemantauan']);

        if($level_kdr == "adminkdr" || $level_kdr == "staffkdr" || $level_kdr == "kabagkdr")
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

            if($status_monica != "login" || $level_monica == "superadmin" || $level_monica == "nonadmin")
            {
                redirect(base_url("monica/dashboard_monica"));
            }
        }
        else if($level_risk == "adminkdr" || $level_risk == "staffkdr" || $level_risk == "kabagkdr")
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

            if($status_monica != "login" || $level_monica == "superadmin" || $level_monica == "nonadmin")
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

            if($status_monica != "login" || $level_monica == "superadmin" || $level_monica == "nonadmin")
            {
                redirect(base_url("monica/dashboard_monica"));
            }
        }
    }

    public function index()
    {
    	if(isset($_POST['tambahkhasanaheksternal'])){
            $this->tambah_khasanah_eksternal();
        }else if(isset($_POST['hapuskhasanaheksternal'])){
            $this->hapus_khasanah_eksternal();
        }else{
        	$data = $this->data_array;
			$data['data_khasanah_eksternal'] = $this->m_khasanah->data_khasanah_eksternal();
			$this->load->view('monica/v_header_monica', $data);
			$this->load->view('monica/v_khasanahEksternal', $data); 
			$this->load->view('monica/v_footer_monica');
        }
	}

	public function download_file()
    {    
		$id_compliance = $this->uri->segment(4);
		$fileInfo      = $this->m_khasanah->download_khasanah_eksternal(array('id_compliance' => $id_compliance));
		$file_name     = $fileInfo['file'];
		$file          = 'upload/compliance/eksternal/'.$file_name;
        force_download($file, NULL);
        /*header('Content-Type: application/pdf');
        readfile($file);*/
    } 

    public function detail_khasanah_eksternal()
    {
		$id_compliance = $this->input->post('id_compliance');
		$result_html   = '';
		$result_set    = $this->m_khasanah->detail_khasanah_eksternal($id_compliance);
		$today         = date("Y-m-d");
        
        foreach($result_set as $result){
            $tgl_buat = date("d-m-Y", strtotime($result->dibuat_tanggal));

            if($result->catatan_khusus != ""){
                $tampil_catatan = $result->catatan_khusus;
            }else{
                $tampil_catatan = "-";
            }
            $result_html .= '
                <tr>
                    <td>' . $result->nomor_doc . '</td>
                    <td>' . $result->judul . '</td>
                    <td>' . $result->deskripsi . '</td>
                    <td>' . $result->request_oleh . '</td>
                    <td>' . $tampil_catatan . '</td>
                    <td>' . $result->dibuat_oleh . '</td>
                    <td>' . $tgl_buat . '</td>
                </tr>'; 
        }

        echo json_encode($result_html);
    }

    public function tambah_khasanah_eksternal()
    {
        $nomor_doc                       = $this->input->post('nomor_doc');
        $tahun                           = $this->input->post('tahun');
        $angka                           = $this->input->post('angka');
        $no_doc                          = $nomor_doc.'-'.$tahun.'-'.$angka;
        $judul                           = $this->input->post('judul');
        $deskripsi                       = $this->input->post('deskripsi');
        $request_oleh                    = $this->input->post('request_oleh');
        $catatan_khusus                  = null;
        $file                            = $_FILES['file'];
        $upload_file                     = $file['name'];
        $tipe                            = "E";
        $dibuat_oleh                     = $this->input->post('username_monica');
        $dibuat_tanggal                  = date("Y-m-d h:i:s");
        $diedit_oleh                     = $this->input->post('username_monica');
        $diedit_tanggal                  = date("Y-m-d h:i:s");
        $data                            = $this->data_array;
        $data['data_khasanah_eksternal'] = $this->m_khasanah->data_khasanah_eksternal();

        if (!empty($_FILES['file']['name'])) {
            $path = './upload/compliance/eksternal/'.$upload_file;
            if(file_exists($path)){
                echo '<script language="javascript">';
                echo 'alert("File yang di upload sudah ada, Data gagal disimpan!!!")';
                echo '</script>';
                redirect('monica/khasanah_eksternal', 'refresh');
            }else{
                $file_upload = $upload_file;
            }
        }else{
            $file_upload = null;
        }
        
        $simpan = $this->m_khasanah->tambah_khasanah_eksternal($no_doc,$judul,$deskripsi,$request_oleh,$catatan_khusus,$file_upload,$tipe,
                  $dibuat_oleh,$dibuat_tanggal,$diedit_oleh,$diedit_tanggal);
        $data['data_khasanah_eksternal'] = $this->m_khasanah->data_khasanah_eksternal();
        $this->load->view('monica/v_header_monica', $data);
        
        if($simpan)
        {
            $upload                  = $this->upload->do_upload('file');
            $data['berhasil_simpan'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Khasanah Eksternal berhasil ditambahkan</p>
                                        </div>';
            $this->load->view('monica/v_khasanahEksternal', $data);
        }
        else
        {
            $data['gagal_simpan'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Khasanah Eksternal gagal ditambahkan</p>
                                    </div>';
            $this->load->view('monica/v_khasanahEksternal', $data);
        }
        
        $this->load->view('monica/v_footer_monica');
    }

    public function edit_khasanah_eksternal($id_compliance)
    {
        $data  = $this->data_array; 
        $level = $data['level_monica'];

        if($level == "adminkdr" || $level == "staffkdr" || $level == "kabagkdr")
        {
            $data['lihat_eksternal'] = $this->m_khasanah->lihat_eksternal($id_compliance);
            $this->load->view('monica/v_header_monica', $data);
            $this->load->view('monica/v_editKhasanahEksternal', $data); 
            $this->load->view('monica/v_footer_monica');
        }
        else
        {
            redirect('monica/khasanah_eksternal', 'refresh');
        }
    }

    public function update_khasanah_eksternal()
    {
        $id_compliance = $this->input->post('id_compliance');
        $nomor_doc     = $this->input->post('no_doc');
        $tahun         = $this->input->post('tahun');
        $angka         = $this->input->post('angka');
        $no_doc        = $nomor_doc.'-'.$tahun.'-'.$angka;
        $judul         = $this->input->post('judul');
        $deskripsi     = $this->input->post('deskripsi');
        $request_oleh  = $this->input->post('request_oleh');
        $cat_khus      = $this->input->post('catatan_khusus');
        if($cat_khus != ""){
            $catatan_khusus = $cat_khus;
        }else{
            $catatan_khusus = null;
        }
        $file_sebelum   = $this->input->post('file_sebelum');
        $diedit_oleh    = $this->input->post('username_monica');
        $diedit_tanggal = date("Y-m-d h:i:s");
        $file           = $_FILES['file'];
        $file_upload    = $file['name'];

        if (!empty($_FILES['file']['name'])) {
            $path = './upload/compliance/eksternal/'.$file_upload;
            if(file_exists($path)){
                echo '<script language="javascript">';
                echo 'alert("File yang di upload sudah ada, Data gagal diupdate!!!")';
                echo '</script>';
                redirect('monica/khasanah_eksternal', 'refresh');
            }else{
                if(empty($file_sebelum)){
                    $file_upload = $file_upload;
                }else{
                    $path = './upload/compliance/eksternal/'.$file_sebelum;
                    unlink($path);
                    $file_upload = $file_upload;
                }
            }
        }else{
            if(empty($file_sebelum)){
                $file_upload = null;
            }else{
                $file_upload = $file_sebelum;
            }
        }

        $update = $this->m_khasanah->update_khasanah_eksternal($id_compliance,$no_doc,$judul,$deskripsi,$request_oleh,$catatan_khusus,
                  $file_upload,$diedit_oleh,$diedit_tanggal);

        if($update){
            $upload = $this->upload->do_upload('file');
            echo '<script language="javascript">';
            echo 'alert("Khasanah eksternal berhasil diupdate")';
            echo '</script>';
            redirect('monica/khasanah_eksternal', 'refresh');
        }else{
            echo '<script language="javascript">';
            echo 'alert("Khasanah eksternal gagal diupdate")';
            echo '</script>';
            redirect('monica/khasanah_eksternal', 'refresh');
        } 
    }

    public function hapus_khasanah_eksternal()
    {
        $id_compliance                   = $this->input->post('id_compliance');
        $file_sebelum                    = $this->input->post('file_sebelum');
        $hapus                           = $this->m_khasanah->hapus_khasanah_eksternal($id_compliance);
        $data                            = $this->data_array;
        $data['data_khasanah_eksternal'] = $this->m_khasanah->data_khasanah_eksternal();

        $this->load->view('monica/v_header_monica', $data);
        if($hapus)
        {
            if(!empty($file_sebelum))
            {
                $path_to_file = './upload/compliance/eksternal/'.$file_sebelum;
                if(file_exists($path_to_file))
                {
                    unlink($path_to_file);
                }
                else
                {

                }
            }
            else
            {
                
            }
            $data['berhasil_hapus'] = '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p style="font-weight:bold;">Data telah di hapus</p>
                                        </div>';
            $this->load->view('monica/v_khasanahEksternal', $data);
        }
        else
        {
            $data['gagal_hapus'] = '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p style="font-weight:bold;">Data gagal di hapus</p>
                                    </div>';
            $this->load->view('monica/v_khasanahEksternal', $data);
        }
        $this->load->view('monica/v_footer_monica');
    }

    public function doc_ext_input()
    {
        $no_doc    = $this->input->post('no_doc');
        $tahun     = $this->input->post('tahun');
        $nomor_doc = $no_doc.'-'.$tahun.'-';
        $data      = $this->m_khasanah->doc_ext_input($nomor_doc);
        echo json_encode($data);
    }

    public function doc_ext_edit()
    {
        $no_doc         = $this->input->post('no_doc');
        $tahun          = $this->input->post('tahun');
        $nodoc_terakhir = $this->input->post('nodoc_terakhir');
        $angka_terakhir = $this->input->post('angka_terakhir');
        $nomor_doc      = $no_doc.'-'.$tahun.'-';
        $data           = $this->m_khasanah->doc_ext_edit($nomor_doc,$nodoc_terakhir,$angka_terakhir);
        echo json_encode($data);
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