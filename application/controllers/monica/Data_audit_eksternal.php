<?php 
     
class Data_audit_eksternal extends CI_Controller{
    var $data_array;

    function __construct(){
        parent::__construct();
        $this->load->model('monica/m_audit');
        $config['upload_path']   = './upload/audit/eksternal/';
        $config['allowed_types'] = '*';
        $config['max_size']      = 2048000;
        $config['max_width']     = 10000;
        $config['max_height']    = 10000;
        $config['remove_spaces'] = FALSE;
        $this->load->library('upload', $config);
        $level_kdr          = $this->session->userdata('level_kdr');
        $level_risk         = $this->session->userdata('level_risk');
        $tidakmemadai       = $this->notif_tidakmemadai();
        $dalampemantauan    = $this->notif_dalampemantauan();
        $id                 = $this->notifaudit->updateNotif();
        $id_tidakmemadai    = implode(",",$id['id_tidakmemadai']);
        $id_dalampemantauan = implode(",",$id['id_dalampemantauan']);
        $nama_divisi        = $this->m_audit->nama_divisi_eksternal();
        if($level_kdr == "adminkdr" || $level_kdr == "staffkdr" || $level_kdr == "kabagkdr" || $level_kdr == "nonadmin"){
            $id_user               = $this->session->userdata('id_user');
            $nama_lengkap_monica   = $this->session->userdata('nama_lengkap_kdr');
            $username_monica       = $this->session->userdata('username_kdr');
            $level_monica          = $this->session->userdata('level_kdr');
            $nama_bagian_monica    = $this->session->userdata('nama_bagian_kdr');
            $status_monica         = $this->session->userdata('status_kdr');
            $tahun_audit_eksternal = $this->m_audit->tahun_audit_eksternal($nama_bagian_monica);
            $this->data_array = array(
                'id_user'               => $id_user,
                'nama_lengkap_monica'   => $nama_lengkap_monica,
                'username_monica'       => $username_monica,
                'level_monica'          => $level_monica,
                'nama_bagian_monica'    => $nama_bagian_monica,
                'status_monica'         => $status_monica,
                'tidakmemadai'          => $tidakmemadai,
                'dalampemantauan'       => $dalampemantauan,
                'id_tidakmemadai'       => $id_tidakmemadai,
                'id_dalampemantauan'    => $id_dalampemantauan,
                'nama_divisi'           => $nama_divisi,
                'tahun_audit_eksternal' => $tahun_audit_eksternal
            );
            if($status_monica != "login" || $level_monica == "superadmin"){
                redirect(base_url("monica/dashboard_monica"));
            }
        }else if($level_risk == "adminkdr" || $level_risk == "staffkdr" || $level_risk == "kabagkdr" || $level_risk == "nonadmin"){
            $id_user               = $this->session->userdata('id_user');
            $nama_lengkap_monica   = $this->session->userdata('nama_lengkap_risk');
            $username_monica       = $this->session->userdata('username_risk');
            $level_monica          = $this->session->userdata('level_risk');
            $nama_bagian_monica    = $this->session->userdata('nama_bagian_risk');
            $status_monica         = $this->session->userdata('status_risk');
            $tahun_audit_eksternal = $this->m_audit->tahun_audit_eksternal($nama_bagian_monica);
            $this->data_array = array(
                'id_user'               => $id_user,
                'nama_lengkap_monica'   => $nama_lengkap_monica,
                'username_monica'       => $username_monica,
                'level_monica'          => $level_monica,
                'nama_bagian_monica'    => $nama_bagian_monica,
                'status_monica'         => $status_monica,
                'tidakmemadai'          => $tidakmemadai,
                'dalampemantauan'       => $dalampemantauan,
                'id_tidakmemadai'       => $id_tidakmemadai,
                'id_dalampemantauan'    => $id_dalampemantauan,
                'nama_divisi'           => $nama_divisi,
                'tahun_audit_eksternal' => $tahun_audit_eksternal
            );
            if($status_monica != "login" || $level_monica == "superadmin"){
                redirect(base_url("monica/dashboard_monica"));
            }
        }else{
            $id_user             = $this->session->userdata('id_user');
            $nama_lengkap_monica = $this->session->userdata('nama_lengkap_monica');
            $username_monica     = $this->session->userdata('username_monica');
            $level_monica        = $this->session->userdata('level_monica');
            $nama_bagian_monica  = $this->session->userdata('nama_bagian_monica');
            $status_monica       = $this->session->userdata('status_monica');
            $untuk_web_monica    = $this->session->userdata('untuk_web_monica');
            $tahun_audit_eksternal = $this->m_audit->tahun_audit_eksternal($nama_bagian_monica);
            $this->data_array = array(
                'id_user'               => $id_user,
                'nama_lengkap_monica'   => $nama_lengkap_monica,
                'username_monica'       => $username_monica,
                'level_monica'          => $level_monica,
                'nama_bagian_monica'    => $nama_bagian_monica,
                'status_monica'         => $status_monica,
                'tidakmemadai'          => $tidakmemadai,
                'dalampemantauan'       => $dalampemantauan,
                'id_tidakmemadai'       => $id_tidakmemadai,
                'id_dalampemantauan'    => $id_dalampemantauan,
                'nama_divisi'           => $nama_divisi,
                'tahun_audit_eksternal' => $tahun_audit_eksternal
            );
            if($status_monica != "login" || $level_monica == "superadmin"){
                redirect(base_url("monica/dashboard_monica"));
            }
        }
    }

    public function index(){
        if(isset($_POST['filter'])){
            $this->filter();
        }else if(isset($_POST['tambahauditeksternal'])){
            $this->tambah_audit_eksternal();
        }else if(isset($_POST['updateauditeksternal'])){
            $this->update_audit_eksternal();
        }else if(isset($_POST['hapusauditeksternal'])){
            $this->hapus_audit_eksternal();
        }else{
            $data                         = $this->data_array;
            $data['tahun']                = "";
            $data['status']               = "";
            $tahun                        = "";
            $status                       = "";
            $nama_bagian                  = $data['nama_bagian_monica'];
            $data['nama_bagian']          = $nama_bagian;
            $data['data_audit_eksternal'] = $this->m_audit->data_audit_eksternal($tahun,$nama_bagian,$status);
            $this->load->view('monica/v_header_monica', $data);
            $this->load->view('monica/v_dataAuditEksternal', $data); 
            $this->load->view('monica/v_footer_monica');
        }
    }

    public function filter(){
        $data                         = $this->data_array;
        $tahun                        = $this->input->post('tahun');
        $status                       = $this->input->post('status');
        $data['tahun']                = $tahun;
        $data['status']               = $status;
        $nama_bagian                  = $data['nama_bagian_monica'];
        $data['nama_bagian']          = $nama_bagian;
        $data['data_audit_eksternal'] = $this->m_audit->data_audit_eksternal($tahun,$nama_bagian,$status);
        $this->load->view('monica/v_header_monica', $data);
        $this->load->view('monica/v_dataAuditEksternal', $data); 
        $this->load->view('monica/v_footer_monica');
    }

    public function download_file(){    
        $id_audit  = $this->uri->segment(4);
        $fileInfo  = $this->m_audit->download_file_eksternal(array('id_audit' => $id_audit));
        $file_name = $fileInfo['upload'];
        $file      = 'upload/audit/eksternal/'.$file_name;
        force_download($file, NULL);
    } 

    public function download_audit_eksternal($tahun,$nama_bagian,$status){
        if($status == "semua"){
            $stat = "";
        }else{
            if($status == "memadai"){
                $judul = "Memadai";
                $stat  = $status;
            }else if($status == "tidakmemadai"){
                $judul = "Tidak Memadai";
                $stat  = $status;
            }else{
                $judul = "Dalam Pemantauan";
                $stat  = $status;
            }
        }
        if($tahun == "semua"){
            $tah = "";
        }else{
            $tah = $tahun;
        }

        if($tah == ""){
            if($stat == "")
            {
                $data['isiexcel'] = $this->m_audit->data_audit_eksternal($tah,$nama_bagian,$stat);
                $data['judul']    = 'Data Audit Eksternal Div. APP';
            }else{
                $data['isiexcel'] = $this->m_audit->data_audit_eksternal($tah,$nama_bagian,$stat);
                $data['judul']    = 'Data Audit Eksternal Div. APP dengan Status Monitoring '.$judul;
            }
        }else{
            if($stat == ""){
                $data['isiexcel'] = $this->m_audit->data_audit_eksternal($tah,$nama_bagian,$stat);
                $data['judul']    = 'Data Audit Eksternal Div. APP Tahun '.$tah;
            }else{
                $data['isiexcel'] = $this->m_audit->data_audit_eksternal($tah,$nama_bagian,$stat);
                $data['judul']    = 'Data Audit Eksternal Div. APP Tahun '.$tah. ' dengan Status Monitoring '.$judul;
            }
        }
        $this->load->view('monica/v_excelAuditEksternal', $data);
    }

    public function detail_audit_eksternal(){
        $id_audit        = $this->input->post('id_audit');
        $result_html     = '';
        $result_set      = $this->m_audit->detail_audit_eksternal($id_audit);
        $today           = date("Y-m-d");
        $kurangduaminggu = date('Y-m-d', strtotime('-2 week'));
        $lebihduaminggu  = date('Y-m-d', strtotime('+2 week'));
        $kurangsehari    = date('Y-m-d', strtotime('-1 day'));
        
        foreach($result_set as $result){
            if($result->status_monitoring =="T"){
                $status_monitoring = '<span class="label label-danger" style="width:150px">TIDAK MEMADAI</span>';
            }else if($result->status_monitoring =="P"){
                $status_monitoring = '<span class="label label-info" style="width:150px">DALAM PEMANTAUAN</span>';
            }else{
                $status_monitoring = '<span class="label label-success" style="width:150px">MEMADAI</span>';
            }

            if($result->status_monitoring =="M"){
                $status_deadline = '<span class="label label-default" style="width:150px">DONE</span>';
            }else if(($result->status_monitoring =="P" || $result->status_monitoring =="T") && $result->deadline >= $today){
                $status_deadline = '<span class="label label-success" style="width:150px">ON DEADLINE</span>';
            }else if(($result->status_monitoring =="P" || $result->status_monitoring =="T") && $result->deadline < $today){
                $status_deadline = '<span class="label label-danger" style="width:150px">OUT DEADLINE</span>';
            }else{
                
            }

            $tgl_deadline = date('Y-m-d', strtotime($result->deadline));
            $date1        = date_create($result->deadline);
            $date2        = date_create($today);
            $diff         = date_diff($date2,$date1);
            if($result->status_monitoring =="M"){
                $deadline = '-';
            }else if ($tgl_deadline < $kurangsehari){
                $deadline = '<span class="label label-default" style="width:100px;background-color:yellow;color:black;">'. $diff->format("%R%a hari") .'</span>';
            }else if($tgl_deadline <= $lebihduaminggu){
                $deadline = '<span class="label label-default" style="width:100px;background-color:yellow;color:black;">'. $diff->format("%R%a hari") .'</span>';
            }else{
                $deadline = $diff->format("%R%a hari");
            }
            $tgl_buat = date("d-m-Y", strtotime($result->dibuat_tanggal));
            $result_html .= '
                <tr>
                    <td>' . $result->tahun . '</td>
                    <td>' . $result->tema_audit . '</td>
                    <td>' . $result->nama_divisi . '</td>
                    <td>' . $result->data_temuan . '</td>
                    <td>' . $result->rekomendasi . '</td>
                    <td>' . $status_monitoring . '</td>
                    <td>' . $status_deadline . '</td>
                    <td>' . $deadline . '</td>
                    <td>' . $result->rpm_opt . '</td>
                    <td>' . $result->regulator . '</td>
                    <td>' . $tgl_buat . '</td>
                </tr>'; 
        }
        echo json_encode($result_html);
    }

    public function tambah_audit_eksternal(){
        $tahun                      = $this->input->post('tahun');
        $sha_code                   = null;
        $tema_audit                 = $this->input->post('tema_audit');
        $bagian_terkait             = $this->input->post('bagian_terkait');
        $data_temuan                = $this->input->post('data_temuan');
        $kategori_temuan            = 0;
        $rekomendasi_1              = $this->input->post('rekomendasi_1');
        $status_monitoring_1        = $this->input->post('status_monitoring_1');
        $rekomendasi_tambahan       = $this->input->post('rekomendasi_tambahan');
        $status_monitoring_tambahan = $this->input->post('status_monitoring_tambahan');
        $rek2                       = null;
        $rek3                       = null;
        $rek4                       = null;
        $rek5                       = null;
        $rek6                       = null;
        $rek7                       = null;
        $rek8                       = null;
        $rek9                       = null;
        $rek10                      = null;
        $stat2                      = null;
        $stat3                      = null;
        $stat4                      = null;
        $stat5                      = null;
        $stat6                      = null;
        $stat7                      = null;
        $stat8                      = null;
        $stat9                      = null;
        $stat10                     = null;

        //Get value rekomendasi tambahan
        for ($i = 0; $i < count($rekomendasi_tambahan); $i++){
            $array_rekomendasi[] = $rekomendasi_tambahan[$i];
            if(!empty($array_rekomendasi[0])){
                $rek2  = $array_rekomendasi[0];
            }else{
                $rek2  = null;
            }
            if(!empty($array_rekomendasi[1])){
                $rek3 = $array_rekomendasi[1];
            }else{
                $rek3 = null;
            }
            if(!empty($array_rekomendasi[2])){
                $rek4 = $array_rekomendasi[2];
            }else{
                $rek4 = null;
            }
            if(!empty($array_rekomendasi[3])){
                $rek5 = $array_rekomendasi[3];
            }else{
                $rek5 = null;
            }
            if(!empty($array_rekomendasi[4])){
                $rek6 = $array_rekomendasi[4];
            }else{
                $rek6 = null;
            }
            if(!empty($array_rekomendasi[5])){
                $rek7 = $array_rekomendasi[5];
            }else{
                $rek7 = null;
            }
            if(!empty($array_rekomendasi[6])){
                $rek8 = $array_rekomendasi[6];
            }else{
                $rek8 = null;
            }
            if(!empty($array_rekomendasi[7])){
                $rek9 = $array_rekomendasi[7];
            }else{
                $rek9 = null;
            }
            if(!empty($array_rekomendasi[8])){
                $rek10 = $array_rekomendasi[8];
            }else{
                $rek10 = null;
            }
        }

        //Get value status monitoring tambahan
        for ($i = 0; $i < count($status_monitoring_tambahan); $i++){
            $array_status[] = $status_monitoring_tambahan[$i];
            if(!empty($array_status[0])){
                $stat2  = $array_status[0];
            }else{
                $stat2  = null;
            }
            if(!empty($array_status[1])){
                $stat3 = $array_status[1];
            }else{
                $stat3 = null;
            }
            if(!empty($array_status[2])){
                $stat4 = $array_status[2];
            }else{
                $stat4 = null;
            }
            if(!empty($array_status[3])){
                $stat5 = $array_status[3];
            }else{
                $stat5 = null;
            }
            if(!empty($array_status[4])){
                $stat6 = $array_status[4];
            }else{
                $stat6 = null;
            }
            if(!empty($array_status[5])){
                $stat7 = $array_status[5];
            }else{
                $stat7 = null;
            }
            if(!empty($array_status[6])){
                $stat8 = $array_status[6];
            }else{
                $stat8 = null;
            }
            if(!empty($array_status[7])){
                $stat9 = $array_status[7];
            }else{
                $stat9 = null;
            }
            if(!empty($array_status[8])){
                $stat10 = $array_status[8];
            }else{
                $stat10 = null;
            }
        }

        $rekomendasi_2                 = $rek2;
        $rekomendasi_3                 = $rek3;
        $rekomendasi_4                 = $rek4;
        $rekomendasi_5                 = $rek5;
        $rekomendasi_6                 = $rek6;
        $rekomendasi_7                 = $rek7;
        $rekomendasi_8                 = $rek8;
        $rekomendasi_9                 = $rek9;
        $rekomendasi_10                = $rek10;
        $status_monitoring_2           = $stat2;
        $status_monitoring_3           = $stat3;
        $status_monitoring_4           = $stat4;
        $status_monitoring_5           = $stat5;
        $status_monitoring_6           = $stat6;
        $status_monitoring_7           = $stat7;
        $status_monitoring_8           = $stat8;
        $status_monitoring_9           = $stat9;
        $status_monitoring_10          = $stat10;
        $rpm_opt                       = $this->input->post('rpm_opt');
        $tanggapan_skai                = null;
        $regulator                     = $this->input->post('regulator');
        $deadline                      = $this->input->post('deadline');
        $tipe                          = "E";
        $file                          = $_FILES['file'];
        $upload_file                   = $file['name'];
        $dibuat_oleh                   = $this->input->post('username_monica');
        $dibuat_tanggal                = date("Y-m-d h:i:s");
        $diedit_oleh                   = $this->input->post('username_monica');
        $diedit_tanggal                = date("Y-m-d h:i:s");
        $data                          = $this->data_array;
        $nama_bagian                   = $data['nama_bagian_monica'];
    
        if (!empty($_FILES['file']['name'])){
            $path = './upload/audit/eksternal/'.$upload_file;
            if(file_exists($path)){
                echo '<script language="javascript">';
                echo 'alert("File yang di upload sudah ada, Data gagal disimpan!!!")';
                echo '</script>';
                redirect('monica/data_audit_eksternal', 'refresh');
            }else{
                $file_upload = $upload_file;
            }
        }else{
            $file_upload = null;
        } 

        $simpan = $this->m_audit->tambah_audit_eksternal($tahun,$sha_code,$tema_audit,$bagian_terkait,$data_temuan,$kategori_temuan,
                  $rekomendasi_1,$status_monitoring_1,$rekomendasi_2,$status_monitoring_2,$rekomendasi_3,$status_monitoring_3,
                  $rekomendasi_4,$status_monitoring_4,$rekomendasi_5,$status_monitoring_5,$rekomendasi_6,$status_monitoring_6,$rekomendasi_7
                  ,$status_monitoring_7,$rekomendasi_8,$status_monitoring_8,$rekomendasi_9,$status_monitoring_9,$rekomendasi_10,
                  $status_monitoring_10,$rpm_opt,$tanggapan_skai,$regulator,$deadline,$tipe,$file_upload,$dibuat_oleh,$dibuat_tanggal,
                  $diedit_oleh,$diedit_tanggal);

        if($simpan){
            $upload = $this->upload->do_upload('file');
            echo '<script language="javascript">';
            echo 'alert("Audit eksternal berhasil ditambahkan")';
            echo '</script>';
            redirect('monica/data_audit_eksternal', 'refresh');
        }else{
            echo '<script language="javascript">';
            echo 'alert("Audit eksternal gagal ditambahkan!!!")';
            echo '</script>';
            redirect('monica/data_audit_eksternal', 'refresh');
        }
    }

    public function update_audit_eksternal(){
        $id_audit                = $this->input->post('id_audit');
        $tahun                   = $this->input->post('tahun');
        $tema_audit              = $this->input->post('tema_audit');
        $bagian                  = $this->input->post('bagian');
        $data_temuan             = $this->input->post('data_temuan');
        $rekomendasi_1           = $this->input->post('rekomendasi_1');
        $status_monitoring_1     = $this->input->post('status_monitoring_1');
        $rekomendasi_2           = $this->input->post('rekomendasi_2');
        $status_monitoring_2     = $this->input->post('status_monitoring_2');
        $rekomendasi_3           = $this->input->post('rekomendasi_3');
        $status_monitoring_3     = $this->input->post('status_monitoring_3');
        $rekomendasi_4           = $this->input->post('rekomendasi_4');
        $status_monitoring_4     = $this->input->post('status_monitoring_4');
        $rekomendasi_5           = $this->input->post('rekomendasi_5');
        $status_monitoring_5     = $this->input->post('status_monitoring_5');
        $rekomendasi_6           = $this->input->post('rekomendasi_6');
        $status_monitoring_6     = $this->input->post('status_monitoring_6');
        $rekomendasi_7           = $this->input->post('rekomendasi_7');
        $status_monitoring_7     = $this->input->post('status_monitoring_7');
        $rekomendasi_8           = $this->input->post('rekomendasi_8');
        $status_monitoring_8     = $this->input->post('status_monitoring_8');
        $rekomendasi_9           = $this->input->post('rekomendasi_9');
        $status_monitoring_9     = $this->input->post('status_monitoring_9');
        $rekomendasi_10          = $this->input->post('rekomendasi_10');
        $status_monitoring_10    = $this->input->post('status_monitoring_10');
        $rpm_opt                 = $this->input->post('rpm_opt');
        $regulator               = $this->input->post('regulator');
        $deadline                = $this->input->post('deadline');
        $file                    = $_FILES['file'];
        $file_upload             = $file['name'];
        $upload_sebelum          = $this->input->post('upload_sebelum');
        $diedit_oleh             = $this->input->post('username_monica');
        $diedit_tanggal          = date("Y-m-d h:i:s");
        $tahun_input             = $this->input->post('tahun_input');

        if($rekomendasi_2 != '' && $status_monitoring_2 != ''){
            $rekomendasi_2       = $this->input->post('rekomendasi_2');
            $status_monitoring_2 = $this->input->post('status_monitoring_2');
        }else{
            $rekomendasi_2       = null;
            $status_monitoring_2 = null;
        }
        if($rekomendasi_3 != '' && $status_monitoring_3 != ''){
            $rekomendasi_3       = $this->input->post('rekomendasi_3');
            $status_monitoring_3 = $this->input->post('status_monitoring_3');
        }else{
            $rekomendasi_3       = null;
            $status_monitoring_3 = null;
        }
        if($rekomendasi_4 != '' && $status_monitoring_4 != ''){
            $rekomendasi_4       = $this->input->post('rekomendasi_4');
            $status_monitoring_4 = $this->input->post('status_monitoring_4');
        }else{
            $rekomendasi_4       = null;
            $status_monitoring_4 = null;
        }
        if($rekomendasi_5 != '' && $status_monitoring_5 != ''){
            $rekomendasi_5       = $this->input->post('rekomendasi_5');
            $status_monitoring_5 = $this->input->post('status_monitoring_5');
        }else{
            $rekomendasi_5       = null;
            $status_monitoring_5 = null;
        }
        if($rekomendasi_6 != '' && $status_monitoring_6 != ''){
            $rekomendasi_6       = $this->input->post('rekomendasi_6');
            $status_monitoring_6 = $this->input->post('status_monitoring_6');
        }else{
            $rekomendasi_6       = null;
            $status_monitoring_6 = null;
        }
        if($rekomendasi_7 != '' && $status_monitoring_7 != ''){
            $rekomendasi_7       = $this->input->post('rekomendasi_7');
            $status_monitoring_7 = $this->input->post('status_monitoring_7');
        }else{
            $rekomendasi_7       = null;
            $status_monitoring_7 = null;
        }
        if($rekomendasi_8 != '' && $status_monitoring_8 != ''){
            $rekomendasi_8       = $this->input->post('rekomendasi_8');
            $status_monitoring_8 = $this->input->post('status_monitoring_8');
        }else{
            $rekomendasi_8       = null;
            $status_monitoring_8 = null;
        }
        if($rekomendasi_9 != '' && $status_monitoring_9 != ''){
            $rekomendasi_9       = $this->input->post('rekomendasi_9');
            $status_monitoring_9 = $this->input->post('status_monitoring_9');
        }else{
            $rekomendasi_9       = null;
            $status_monitoring_9 = null;
        }
        if($rekomendasi_10 != '' && $status_monitoring_10 != ''){
            $rekomendasi_10       = $this->input->post('rekomendasi_10');
            $status_monitoring_10 = $this->input->post('status_monitoring_10');
        }else{
            $rekomendasi_10       = null;
            $status_monitoring_10 = null;
        }
        
        if (!empty($_FILES['file']['name'])){
            $path = './upload/audit/eksternal/'.$file_upload;
            if(file_exists($path)){
                echo '<script language="javascript">';
                echo 'alert("File yang di upload sudah ada, Data gagal diupdate!!!")';
                echo '</script>';
                redirect('monica/data_audit_eksternal', 'refresh');
            }else{
                if(empty($upload_sebelum)){
                    $file_upload = $file_upload;
                }else{
                    $path = './upload/audit/eksternal/'.$upload_sebelum;
                    unlink($path);
                    $file_upload = $file_upload;
                }
            }
        }else{
            if(empty($upload_sebelum)){
                $file_upload = null;
            }else{
                $file_upload = $upload_sebelum;
            }
        }

        for ($i = 0; $i < count($id_audit); $i++) 
        {
            $id                   = $id_audit[$i];
            $bagian               = $bagian[$id];  
            $regulator            = $regulator[$id];  
            $status_monitoring_1  = $status_monitoring_1[$id]; 
            $status_monitoring_2  = $status_monitoring_2[$id]; 
            $status_monitoring_3  = $status_monitoring_3[$id]; 
            $status_monitoring_4  = $status_monitoring_4[$id]; 
            $status_monitoring_5  = $status_monitoring_5[$id]; 
            $status_monitoring_6  = $status_monitoring_6[$id]; 
            $status_monitoring_7  = $status_monitoring_7[$id]; 
            $status_monitoring_8  = $status_monitoring_8[$id]; 
            $status_monitoring_9  = $status_monitoring_9[$id]; 
            $status_monitoring_10 = $status_monitoring_10[$id]; 
            $update               = $this->m_audit->update_audit_eksternal($id,$tahun,$tema_audit,$bagian,$data_temuan,
                                    $rekomendasi_1,$status_monitoring_1,$rekomendasi_2,$status_monitoring_2,$rekomendasi_3,
                                    $status_monitoring_3,$rekomendasi_4,$status_monitoring_4,$rekomendasi_5,
                                    $status_monitoring_5,$rekomendasi_6,$status_monitoring_6,$rekomendasi_7,
                                    $status_monitoring_7,$rekomendasi_8,$status_monitoring_8,$rekomendasi_9,
                                    $status_monitoring_9,$rekomendasi_10,$status_monitoring_10,
                                    $rpm_opt,$regulator,$deadline,$file_upload,$diedit_oleh,$diedit_tanggal);
        }
        
        if($update){
            $upload = $this->upload->do_upload('file');
            echo '<script language="javascript">';
            echo 'alert("Audit eksternal berhasil diupdate")';
            echo '</script>';
            redirect('monica/data_audit_eksternal', 'refresh');
        }else{
            echo '<script language="javascript">';
            echo 'alert("Audit eksternal gagal diupdate!!!")';
            echo '</script>';
            redirect('monica/data_audit_eksternal', 'refresh');
        }
    }

    public function hapus_audit_eksternal(){
        $id_audit                     = $this->input->post('id_audit');
        $upload_sebelum               = $this->input->post('upload_sebelum');
        $hapus                        = $this->m_audit->hapus_audit_eksternal($id_audit);
        if($hapus){
            if(!empty($upload_sebelum)){
                $path_to_file = './upload/audit/eksternal/'.$upload_sebelum;
                if(file_exists($path_to_file)){
                    unlink($path_to_file);
                }else{}
            }else{}
            echo '<script language="javascript">';
            echo 'alert("Audit eksternal berhasil dihapus")';
            echo '</script>';
            redirect('monica/data_audit_eksternal', 'refresh');
        }else{
            echo '<script language="javascript">';
            echo 'alert("Audit eksternal gagal dihapus!!!")';
            echo '</script>';
            redirect('monica/data_audit_eksternal', 'refresh');
        }
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

?>