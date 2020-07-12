<?php 
     
class Audit_report extends CI_Controller{
    var $data_array;

    function __construct(){
        parent::__construct();
        $this->load->model('monica/m_audit_report');
        $level_kdr          = $this->session->userdata('level_kdr');
        $level_risk         = $this->session->userdata('level_risk');
        $tidakmemadai       = $this->notif_tidakmemadai();
        $dalampemantauan    = $this->notif_dalampemantauan();
        $id                 = $this->notifaudit->updateNotif();
        $id_tidakmemadai    = implode(",",$id['id_tidakmemadai']);
        $id_dalampemantauan = implode(",",$id['id_dalampemantauan']);
        if($level_kdr == "adminkdr" || $level_kdr == "staffkdr" || $level_kdr == "kabagkdr" || $level_kdr == "nonadmin"){
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
            if($status_monica != "login" || $level_monica == "superadmin"){
                redirect(base_url("monica/dashboard_monica"));
            }
        }else if($level_risk == "adminkdr" || $level_risk == "staffkdr" || $level_risk == "kabagkdr" || $level_risk == "nonadmin"){
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
            if($status_monica != "login" || $level_monica == "superadmin"){
                redirect(base_url("monica/dashboard_monica"));
            }
        }
    }

    public function index()
    {
        if(isset($_POST['lihatdata'])){
            $this->lihat_data();
        }else{
            $data                       = $this->data_array;
            $nama_bagian                = $data['nama_bagian_monica'];
            $data['tahun_audit_report'] = $this->m_audit_report->tahun_audit_report($nama_bagian);
            $this->load->view('monica/v_header_monica', $data);
            $this->load->view('monica/v_tahunAuditReport', $data); 
            $this->load->view('monica/v_footer_monica');
        }
    }

    public function lihat_data(){
        $data                    = $this->data_array;
        $nama_bagian             = $data['nama_bagian_monica'];
        $tahun                   = $this->input->post('tahun');
        $data['tahun_input']     = $this->input->post('tahun');

        /* ============================ UNTUK DIAGRAM CHART INTERNAL ============================*/
        $audit_report_internal = $this->m_audit_report->audit_report_internal($tahun,$nama_bagian);
        foreach ($audit_report_internal as $internal) {
            $namainternal[]          = $internal['nama'];
            $nilaimajorinternal[]    = $internal['major'];
            $nilaiminorinternal[]    = $internal['minor'];
            $nilaimoderateinternal[] = $internal['moderate'];
        }
        $data['namainternal']          = json_encode($namainternal, JSON_NUMERIC_CHECK);
        $data['nilaimajorinternal']    = json_encode($nilaimajorinternal, JSON_NUMERIC_CHECK);
        $data['nilaiminorinternal']    = json_encode($nilaiminorinternal, JSON_NUMERIC_CHECK);
        $data['nilaimoderateinternal'] = json_encode($nilaimoderateinternal, JSON_NUMERIC_CHECK);

        /* ============================ JUMLAH STATUS MONITORING INTERNAL ============================*/
        $jumlah_monitoring_internal   = $this->m_audit_report->jumlah_monitoring_internal($tahun,$nama_bagian);
        $total_memadai_internal       = 0;
        $total_pemantauan_internal    = 0;
        $total_tidak_memadai_internal = 0;
        foreach ($jumlah_monitoring_internal as $row){
            $total_memadai_internal       += $row['total_memadai'];
            $total_pemantauan_internal    += $row['total_pemantauan_1'];
            $total_pemantauan_internal    += $row['total_pemantauan_2'];
            $total_tidak_memadai_internal += $row['total_tidak_memadai_1'];
            $total_tidak_memadai_internal += $row['total_tidak_memadai_2'];
            $total_tidak_memadai_internal += $row['total_tidak_memadai_3'];
        }
        $data['total_memadai_internal']       = $total_memadai_internal;   
        $data['total_pemantauan_internal']    = $total_pemantauan_internal;  
        $data['total_tidak_memadai_internal'] = $total_tidak_memadai_internal;  

        /* ============================ JUMLAH KATEGORI INTERNAL ============================ */
        $jumlah_kategori_internal = $this->m_audit_report->jumlah_kategori_internal($tahun,$nama_bagian);
        $total_major              = 0;
        $total_minor              = 0;
        $total_moderate           = 0;
        foreach ($jumlah_kategori_internal as $row) {   
            $total_major    += $row['total_major'];
            $total_minor    += $row['total_minor'];
            $total_moderate += $row['total_moderate'];
        }
        $data['total_major']    = $total_major;   
        $data['total_minor']    = $total_minor;  
        $data['total_moderate'] = $total_moderate;  

        /* ====================== JUMLAH STATUS MONITORING INTERNAL UNTUK MAJOR ============================*/
        $monitoring_internal_major    = $this->m_audit_report->monitoring_internal_major($tahun,$nama_bagian);
        $major_memadai_internal       = 0;
        $major_pemantauan_internal    = 0;
        $major_tidak_memadai_internal = 0;
        foreach ($monitoring_internal_major as $row){
            $major_memadai_internal       += $row['total_memadai'];
            $major_pemantauan_internal    += $row['total_pemantauan_1'];
            $major_pemantauan_internal    += $row['total_pemantauan_2'];
            $major_tidak_memadai_internal += $row['total_tidak_memadai_1'];
            $major_tidak_memadai_internal += $row['total_tidak_memadai_2'];
            $major_tidak_memadai_internal += $row['total_tidak_memadai_3'];
        }
        $data['major_memadai_internal']       = $major_memadai_internal;   
        $data['major_pemantauan_internal']    = $major_pemantauan_internal;  
        $data['major_tidak_memadai_internal'] = $major_tidak_memadai_internal;  

        /* ======================= JUMLAH STATUS MONITORING INTERNAL UNTUK MINOR ============================*/
        $monitoring_internal_minor    = $this->m_audit_report->monitoring_internal_minor($tahun,$nama_bagian);
        $minor_memadai_internal       = 0;
        $minor_pemantauan_internal    = 0;
        $minor_tidak_memadai_internal = 0;
        foreach ($monitoring_internal_minor as $row){
            $minor_memadai_internal       += $row['total_memadai'];
            $minor_pemantauan_internal    += $row['total_pemantauan_1'];
            $minor_pemantauan_internal    += $row['total_pemantauan_2'];
            $minor_tidak_memadai_internal += $row['total_tidak_memadai_1'];
            $minor_tidak_memadai_internal += $row['total_tidak_memadai_2'];
            $minor_tidak_memadai_internal += $row['total_tidak_memadai_3'];
        }
        $data['minor_memadai_internal']       = $minor_memadai_internal;   
        $data['minor_pemantauan_internal']    = $minor_pemantauan_internal;  
        $data['minor_tidak_memadai_internal'] = $minor_tidak_memadai_internal;  

        /* ===================== JUMLAH STATUS MONITORING INTERNAL UNTUK MODERATE ============================*/
        $monitoring_internal_moderate= $this->m_audit_report->monitoring_internal_moderate($tahun,$nama_bagian);
        $moderate_memadai_internal       = 0;
        $moderate_pemantauan_internal    = 0;
        $moderate_tidak_memadai_internal = 0;
        foreach ($monitoring_internal_moderate as $row){
            $moderate_memadai_internal       += $row['total_memadai'];
            $moderate_pemantauan_internal    += $row['total_pemantauan_1'];
            $moderate_pemantauan_internal    += $row['total_pemantauan_2'];
            $moderate_tidak_memadai_internal += $row['total_tidak_memadai_1'];
            $moderate_tidak_memadai_internal += $row['total_tidak_memadai_2'];
            $moderate_tidak_memadai_internal += $row['total_tidak_memadai_3'];
        }
        $data['moderate_memadai_internal']       = $moderate_memadai_internal;   
        $data['moderate_pemantauan_internal']    = $moderate_pemantauan_internal;  
        $data['moderate_tidak_memadai_internal'] = $moderate_tidak_memadai_internal;  

        /* ============================ JUMLAH STATUS MONITORING EKSTERNAL ============================*/
        $jumlah_monitoring_eksternal  = $this->m_audit_report->jumlah_monitoring_eksternal($tahun,$nama_bagian);
        $total_memadai_eksternal       = 0;
        $total_pemantauan_eksternal    = 0;
        $total_tidak_memadai_eksternal = 0;
        foreach ($jumlah_monitoring_eksternal as $row) {
            $total_memadai_eksternal       += $row['total_memadai'];
            $total_pemantauan_eksternal    += $row['total_pemantauan_1'];
            $total_pemantauan_eksternal    += $row['total_pemantauan_2'];
            $total_tidak_memadai_eksternal += $row['total_tidak_memadai_1'];
            $total_tidak_memadai_eksternal += $row['total_tidak_memadai_2'];
            $total_tidak_memadai_eksternal += $row['total_tidak_memadai_3'];
            
        }
        $data['total_memadai_eksternal']       = $total_memadai_eksternal;   
        $data['total_pemantauan_eksternal']    = $total_pemantauan_eksternal;  
        $data['total_tidak_memadai_eksternal'] = $total_tidak_memadai_eksternal; 
        $this->load->view('monica/v_header_monica', $data);
        $this->load->view('monica/v_auditReport', $data); 
        $this->load->view('monica/v_footer_monica');
    }

    public function lihat_data_internal(){
        $nama                   = $this->input->post('nama');
        $tahun                  = $this->input->post('tahun');
        $result_html            = '';
        $result_set             = $this->m_audit_report->get_row_internal();
        $major_internal         = $this->m_audit_report->major_internal($nama,$tahun);
        $minor_internal         = $this->m_audit_report->minor_internal($nama,$tahun);
        $moderate_internal      = $this->m_audit_report->moderate_internal($nama,$tahun);
        $major_memadai          = 0;
        $major_pemantauan       = 0;
        $major_tidak_memadai    = 0;
        $minor_memadai          = 0;
        $minor_pemantauan       = 0;
        $minor_tidak_memadai    = 0;
        $moderate_memadai       = 0;
        $moderate_pemantauan    = 0;
        $moderate_tidak_memadai = 0;
        foreach($major_internal as $result_major){
            $major_memadai       += $result_major['total_memadai_major'];
            $major_pemantauan    += $result_major['total_pemantauan_major_1'];
            $major_pemantauan    += $result_major['total_pemantauan_major_2'];
            $major_tidak_memadai += $result_major['total_tidak_memadai_major_1'];
            $major_tidak_memadai += $result_major['total_tidak_memadai_major_2'];
            $major_tidak_memadai += $result_major['total_tidak_memadai_major_3'];
        }
        foreach($minor_internal as $result_minor){
            $minor_memadai       += $result_minor['total_memadai_minor'];
            $minor_pemantauan    += $result_minor['total_pemantauan_minor_1'];
            $minor_pemantauan    += $result_minor['total_pemantauan_minor_2'];
            $minor_tidak_memadai += $result_minor['total_tidak_memadai_minor_1'];
            $minor_tidak_memadai += $result_minor['total_tidak_memadai_minor_2'];
            $minor_tidak_memadai += $result_minor['total_tidak_memadai_minor_3'];
        }
        foreach($moderate_internal as $result_moderate){
            $moderate_memadai       += $result_moderate['total_memadai_moderate'];
            $moderate_pemantauan    += $result_moderate['total_pemantauan_moderate_1'];
            $moderate_pemantauan    += $result_moderate['total_pemantauan_moderate_2'];
            $moderate_tidak_memadai += $result_moderate['total_tidak_memadai_moderate_1'];
            $moderate_tidak_memadai += $result_moderate['total_tidak_memadai_moderate_2'];
            $moderate_tidak_memadai += $result_moderate['total_tidak_memadai_moderate_3'];
        }
        foreach($result_set as $result){
            $result_html .= '
                <tr>
                    <td>' . $nama . '</td>
                    <td>' . $major_memadai . '</td>
                    <td>' . $major_pemantauan . '</td>
                    <td>' . $major_tidak_memadai . '</td>
                    <td>' . $minor_memadai . '</td>
                    <td>' . $minor_pemantauan . '</td>
                    <td>' . $minor_tidak_memadai . '</td>
                    <td>' . $moderate_memadai . '</td>
                    <td>' . $moderate_pemantauan . '</td>
                    <td>' . $moderate_tidak_memadai . '</td>
                </tr>'; 
        }
        echo json_encode($result_html);
    }

    public function detail_tidak_memadai(){
        $tahun                = $this->input->post('tahun');
        $nama_bagian          = $this->input->post('nama_bagian');
        $detail_tidak_memadai = $this->m_audit_report->detail_tidak_memadai($tahun,$nama_bagian);
        $tidak_memadai        = 0;
        $isi_table            = '';
        $today                = date("Y-m-d");
        foreach ($detail_tidak_memadai as $row){
            if(($row['status_monitoring_1'] == "P" 
                    || $row['status_monitoring_1'] == "T"
                    || $row['status_monitoring_1'] == "M") 
                && (($row['status_monitoring_2'] == "" 
                    || $row['status_monitoring_2'] == "P"
                    || $row['status_monitoring_2'] == "T"
                    || $row['status_monitoring_2'] == "M") 
                && ($row['status_monitoring_3'] == ""
                    || $row['status_monitoring_3'] == "P"
                    || $row['status_monitoring_3'] == "T"
                    || $row['status_monitoring_3'] == "M")
                && ($row['status_monitoring_4'] == ""
                    || $row['status_monitoring_4'] == "P"
                    || $row['status_monitoring_4'] == "T"
                    || $row['status_monitoring_4'] == "M")
                && ($row['status_monitoring_5'] == ""
                    || $row['status_monitoring_5'] == "P"
                    || $row['status_monitoring_5'] == "T"
                    || $row['status_monitoring_5'] == "M")
                && ($row['status_monitoring_6'] == ""
                    || $row['status_monitoring_6'] == "P"
                    || $row['status_monitoring_6'] == "T"
                    || $row['status_monitoring_6'] == "M")
                && ($row['status_monitoring_7'] == ""
                    || $row['status_monitoring_7'] == "P"
                    || $row['status_monitoring_7'] == "T"
                    || $row['status_monitoring_7'] == "M")
                && ($row['status_monitoring_8'] == ""
                    || $row['status_monitoring_8'] == "P"
                    || $row['status_monitoring_8'] == "T"
                    || $row['status_monitoring_8'] == "M")
                && ($row['status_monitoring_9'] == ""
                    || $row['status_monitoring_9'] == "P"
                    || $row['status_monitoring_9'] == "T"
                    || $row['status_monitoring_9'] == "M")
                && ($row['status_monitoring_10'] == ""
                    || $row['status_monitoring_10'] == "P"
                    || $row['status_monitoring_10'] == "T"
                    || $row['status_monitoring_10'] == "M"))
                && $row['deadline'] < $today)
            {
                $tidak_memadai += $row['total_tidak_memadai_1'];
                $tidak_memadai += $row['total_tidak_memadai_2'];
                $tidak_memadai += $row['total_tidak_memadai_3'];
                $isi_table .= '
                    <tr>
                        <td>' . $row["data_temuan"] . '</td>
                        <td>' . $row["nama"] . '</td>
                        <td>' . $row["deadline"] . '</td>
                    </tr>
                ';
                $nama[]  = $row['nama'];
                $jml_kmg = count(array_keys($nama, "KMG"));
                $jml_pqa = count(array_keys($nama, "PQA"));
                $jml_opl = count(array_keys($nama, "OPL"));
                $jml_cbs = count(array_keys($nama, "CBS"));
                $jml_sku = count(array_keys($nama, "SKU"));
                $jml_sld = count(array_keys($nama, "SLD"));
                $jml_itp = count(array_keys($nama, "ITP"));
                $jml_msa = count(array_keys($nama, "MSA"));
                $jml_sbp = count(array_keys($nama, "SBP"));
                $jml_kop = count(array_keys($nama, "KOP"));
                $jml_ibr = count(array_keys($nama, "IBR"));
                $jml_sdk = count(array_keys($nama, "SDK"));
                $jml_aes = count(array_keys($nama, "AES"));
                $jml_cao = count(array_keys($nama, "CAO"));
                $jml_mao = count(array_keys($nama, "MAO"));
                $jml_dao = count(array_keys($nama, "DAO"));
                $jml_itg = count(array_keys($nama, "ITG"));
                
            } else { }
        } 
        echo json_encode(array
                            (
                                'total_tidak_memadai' => $tidak_memadai,
                                'isi_table'           => $isi_table,
                                'jml_kmg'             => $jml_kmg,
                                'jml_pqa'             => $jml_pqa,
                                'jml_opl'             => $jml_opl,
                                'jml_cbs'             => $jml_cbs,
                                'jml_sku'             => $jml_sku,
                                'jml_sld'             => $jml_sld,
                                'jml_itp'             => $jml_itp,
                                'jml_msa'             => $jml_msa,
                                'jml_sbp'             => $jml_sbp,
                                'jml_kop'             => $jml_kop,
                                'jml_ibr'             => $jml_ibr,
                                'jml_sdk'             => $jml_sdk,
                                'jml_aes'             => $jml_aes,
                                'jml_cao'             => $jml_cao,
                                'jml_mao'             => $jml_mao,
                                'jml_dao'             => $jml_dao,
                                'jml_itg'             => $jml_itg
                            )
                        );
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