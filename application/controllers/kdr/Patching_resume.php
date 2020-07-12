<?php 
     
class Patching_resume extends CI_Controller{
    var $data_array;

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('kdr/m_kdr','kdr/m_dispo'));
        $this->load->library('working');
        $level_risk   = $this->session->userdata('level_risk');
        $level_monica = $this->session->userdata('level_monica');

        if($level_risk == "adminkdr" || $level_risk == "staffkdr" || $level_risk == "kabagkdr" || $level_risk == "nonadmin")
        {
            $id_user          = $this->session->userdata('id_user');
            $nama_lengkap_kdr = $this->session->userdata('nama_lengkap_risk');
            $username_kdr     = $this->session->userdata('username_risk');
            $level_kdr        = $this->session->userdata('level_risk');
            $nama_bagian_kdr  = $this->session->userdata('nama_bagian_risk');
            $status_kdr       = $this->session->userdata('status_risk');
            $untuk_web_kdr    = $this->session->userdata('untuk_web_risk');

            $this->data_array = array(
                'id_user'          => $id_user,
                'nama_lengkap_kdr' => $nama_lengkap_kdr,
                'username_kdr'     => $username_kdr,
                'level_kdr'        => $level_kdr,
                'nama_bagian_kdr'  => $nama_bagian_kdr,
                'status_kdr'       => $status_kdr,
                'untuk_web_kdr'    => $untuk_web_kdr
            );

            if($level_kdr == "superadmin" || ($level_kdr == "nonadmin" && $untuk_web_kdr != "kdr"))
            {
                redirect(base_url("dashboard_kdr"));
            }
        } 
        else if($level_monica == "adminkdr" || $level_monica == "staffkdr" || $level_monica == "kabagkdr" 
        || $level_monica == "nonadmin")
        {
            $id_user          = $this->session->userdata('id_user');
            $nama_lengkap_kdr = $this->session->userdata('nama_lengkap_monica');
            $username_kdr     = $this->session->userdata('username_monica');
            $level_kdr        = $this->session->userdata('level_monica');
            $nama_bagian_kdr  = $this->session->userdata('nama_bagian_monica');
            $status_kdr       = $this->session->userdata('status_monica');
            $untuk_web_kdr    = $this->session->userdata('untuk_web_monica');

            $this->data_array = array(
                'id_user'          => $id_user,
                'nama_lengkap_kdr' => $nama_lengkap_kdr,
                'username_kdr'     => $username_kdr,
                'level_kdr'        => $level_kdr,
                'nama_bagian_kdr'  => $nama_bagian_kdr,
                'status_kdr'       => $status_kdr,
                'untuk_web_kdr'    => $untuk_web_kdr
            );

            if($level_kdr == "superadmin" || ($level_kdr == "nonadmin" && $untuk_web_kdr != "kdr"))
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
            $untuk_web_kdr    = $this->session->userdata('untuk_web_kdr');

            $this->data_array = array(
                'id_user'          => $id_user,
                'nama_lengkap_kdr' => $nama_lengkap_kdr,
                'username_kdr'     => $username_kdr,
                'level_kdr'        => $level_kdr,
                'nama_bagian_kdr'  => $nama_bagian_kdr,
                'status_kdr'       => $status_kdr,
                'untuk_web_kdr'    => $untuk_web_kdr
            );

            if($level_kdr == "superadmin" || ($level_kdr == "nonadmin" && $untuk_web_kdr != "kdr"))
            {
                redirect(base_url("dashboard_kdr"));
            }
        }
    }

    public function index()
    {   
        $tanggal_awal  = 0;
        $tanggal_akhir = 0;
        $tahun         = "";

        //Get holidays
        $holidays      = $this->m_kdr->tanggal_libur();
        $row_holidays  = "";
        foreach($holidays as $row)
        {
            $row_holidays[] = $row['tgl_libur']; 
        }
        $holidays = $row_holidays;

        //Perhitungan Total Realisasi dan Total Pencapaian
        $get_tanggal_sla = $this->m_kdr->get_tanggal_sla($tanggal_awal,$tanggal_akhir);
        if(!empty($get_tanggal_sla) ) {
            foreach($get_tanggal_sla as $data)
            {
                $tgl_permohonan = $data["tgl_permohonan"];
                $tgl_patching   = $data["tgl_patching"];
                $justifikasi[]  = $data["justifikasi"];
                $patching[]     = $this->working->getWorkingDays($tgl_permohonan,$tgl_patching,$holidays);

                //Get sla yang tidak lebih dari 5 hari
                $min     = 0;
                $max     = 5;
                $get_sla = array_filter(
                    $patching,
                    function ($value) use($min,$max) {
                        return ($value >= $min && $value <= $max);
                    }
                );
            }
            $count_justif    = count(array_keys($justifikasi, "1"));
            $sla             = count($get_sla)+$count_justif;
            $total_patching2 = count($patching);
            $realisasi       = ($sla/$total_patching2)*1*100;
            $totalrealisasi  = number_format((float)$realisasi, 2, '.', '');
            $pencapaian      = $totalrealisasi/0.97;
            $totalpencapaian = number_format((float)$pencapaian, 2, '.', '');
        }
        else
        {
            $totalrealisasi  = 0;
            $totalpencapaian = 0;
        }

        //Grafik SLA Per Bulan Tahun Sistem
        $jan_system   = $this->m_kdr->get_sla_per_bulan_system('1',$tanggal_awal,$tahun);
        $feb_system   = $this->m_kdr->get_sla_per_bulan_system('2',$tanggal_awal,$tahun);
        $mar_system   = $this->m_kdr->get_sla_per_bulan_system('3',$tanggal_awal,$tahun);
        $apr_system   = $this->m_kdr->get_sla_per_bulan_system('4',$tanggal_awal,$tahun);
        $mei_system   = $this->m_kdr->get_sla_per_bulan_system('5',$tanggal_awal,$tahun);
        $jun_system   = $this->m_kdr->get_sla_per_bulan_system('6',$tanggal_awal,$tahun);
        $jul_system   = $this->m_kdr->get_sla_per_bulan_system('7',$tanggal_awal,$tahun);
        $agu_system   = $this->m_kdr->get_sla_per_bulan_system('8',$tanggal_awal,$tahun);
        $sep_system   = $this->m_kdr->get_sla_per_bulan_system('9',$tanggal_awal,$tahun);
        $okt_system   = $this->m_kdr->get_sla_per_bulan_system('10',$tanggal_awal,$tahun);
        $nov_system   = $this->m_kdr->get_sla_per_bulan_system('11',$tanggal_awal,$tahun);
        $des_system   = $this->m_kdr->get_sla_per_bulan_system('12',$tanggal_awal,$tahun);
        $sistem_bulan = array($jan_system,$feb_system,$mar_system,$apr_system,$mei_system,$jun_system,
                        $jul_system,$agu_system,$sep_system,$okt_system,$nov_system,$des_system);

        //Sla dan Non Sla Tahun Sistem
        foreach($sistem_bulan as $data)
        {
            $totalSLA    = 0;
            $totalNotSLA = 0;
            foreach($data as $row)
            {
                if($row == null)
                {
                    $count_sla     = 0;
                    $count_not_sla = 0;
                }
                else
                {
                    $patching       = array();
                    $get_sla        = 0;
                    $justifikasi    = "";
                    $tgl_permohonan = $row["tgl_permohonan"];
                    $tgl_patching   = $row["tgl_patching"];
                    $justifikasi[]  = $row["justifikasi"];
                    $patching[]     = $this->working->getWorkingDays($tgl_permohonan,$tgl_patching,$holidays);

                    //Get sla yang tidak lebih dari 5 hari
                    $min_sla = 0;
                    $max_sla = 5;
                    $get_sla = array_filter(
                        $patching,
                        function ($value_sla) use($min_sla,$max_sla) {
                            return ($value_sla >= $min_sla && $value_sla <= $max_sla);
                        }
                    );

                    //Get non sla yang lebih dari 5 hari
                    $max_not_sla = 5;
                    $not_sla     = array_filter(
                        $patching,
                        function ($value_not_sla) use($max_not_sla) {
                            return ($value_not_sla > $max_not_sla);
                        }
                    );  

                    $count_justif  = count(array_keys($justifikasi, "1"));
                    $count_sla     = count($get_sla)+$count_justif;
                    $totalSLA      += $count_sla;
                    $count_not_sla = count($not_sla)-$count_justif;
                    $totalNotSLA   += $count_not_sla;
                }
            }
            
            $array_sla[]     = $totalSLA;
            $array_not_sla[] = $totalNotSLA;
        }
        
        //Grafik SLA Per Bulan Tahun Sistem -1
        $jan_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('1',$tanggal_awal,$tahun);
        $feb_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('2',$tanggal_awal,$tahun);
        $mar_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('3',$tanggal_awal,$tahun);
        $apr_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('4',$tanggal_awal,$tahun);
        $mei_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('5',$tanggal_awal,$tahun);
        $jun_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('6',$tanggal_awal,$tahun);
        $jul_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('7',$tanggal_awal,$tahun);
        $agu_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('8',$tanggal_awal,$tahun);
        $sep_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('9',$tanggal_awal,$tahun);
        $okt_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('10',$tanggal_awal,$tahun);
        $nov_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('11',$tanggal_awal,$tahun);
        $des_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('12',$tanggal_awal,$tahun);
        $sebelum     = array($jan_sebelum,$feb_sebelum,$mar_sebelum,$apr_sebelum,$mei_sebelum,$jun_sebelum,
                       $jul_sebelum,$agu_sebelum,$sep_sebelum,$okt_sebelum,$nov_sebelum,$des_sebelum);

        //Sla dan Non Sla Tahun Sistem -1
        foreach($sebelum as $data)
        {
            $totalSLAsebelum    = 0;
            $totalNotSLAsebelum = 0;
            foreach($data as $row)
            {
                if($row == null)
                {
                    $count_sla_sebelum     = 0;
                    $count_not_sla_sebelum = 0;
                }
                else
                {
                    $patching       = array();
                    $get_sla        = 0;
                    $justifikasi    = "";
                    $tgl_permohonan = $row["tgl_permohonan"];
                    $tgl_patching   = $row["tgl_patching"];
                    $justifikasi[]  = $row["justifikasi"];
                    $patching[]     = $this->working->getWorkingDays($tgl_permohonan,$tgl_patching,$holidays);

                    //Get sla yang tidak lebih dari 5 hari
                    $min_sla = 0;
                    $max_sla = 5;
                    $get_sla = array_filter(
                        $patching,
                        function ($value_sla) use($min_sla,$max_sla) {
                            return ($value_sla >= $min_sla && $value_sla <= $max_sla);
                        }
                    );

                    //Get non sla yang lebih dari 5 hari
                    $max_not_sla = 5;
                    $not_sla     = array_filter(
                        $patching,
                        function ($value_not_sla) use($max_not_sla) {
                            return ($value_not_sla > $max_not_sla);
                        }
                    );  
                    
                    $count_justif          = count(array_keys($justifikasi, "1"));
                    $count_sla_sebelum     = count($get_sla)+$count_justif;
                    $totalSLAsebelum       += $count_sla_sebelum;
                    $count_not_sla_sebelum = count($not_sla)-$count_justif;
                    $totalNotSLAsebelum    += $count_not_sla_sebelum;
                }
            }
            $array_sla_sebelum[]     = $totalSLAsebelum;
            $array_not_sla_sebelum[] = $totalNotSLAsebelum;
        }

        //Array Bulan
        $bulan = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des");
        foreach($bulan as $row)
        {
            $nama_bulan[] = $row;
        }

        $data                    = $this->data_array;
        $data['css_arr']         = array('daterangepicker.min.css','bootstrap-datetimepicker.min.css',
                                   'bootstrap-datepicker3.min.css','bootstrap-timepicker.min.css');
        $data['js_arr']          = array('highcharts.js','exporting.js','export-data.js','moment.min.js',
                                   'bootstrap-datepicker.min.js','bootstrap-timepicker.min.js',
                                   'daterangepicker.min.js','bootstrap-datetimepicker.min.js');
        $data['rekap_brinets']   = $this->m_kdr->get_count_rekap_by_jenis('BRINETS',$tanggal_awal,
                                   $tanggal_akhir);
        $data['rekap_tab']       = $this->m_kdr->get_count_rekap_by_jenis('Tabungan',$tanggal_awal,
                                   $tanggal_akhir);
        $data['rekap_loan']      = $this->m_kdr->get_count_rekap_by_jenis('Pinjaman',$tanggal_awal,
                                   $tanggal_akhir);
        $data['rekap_giro']      = $this->m_kdr->get_count_rekap_by_jenis('Giro',$tanggal_awal,$tanggal_akhir);
        $data['rekap_gl']        = $this->m_kdr->get_count_rekap_by_jenis('GL',$tanggal_awal,$tanggal_akhir);
        $data['rekap_ia']        = $this->m_kdr->get_count_rekap_by_jenis('IA',$tanggal_awal,$tanggal_akhir);
        $data['rekap_pen']       = $this->m_kdr->get_count_rekap_by_jenis('BRIPENS',$tanggal_awal,
                                   $tanggal_akhir);
        $data['rekap_cif']       = $this->m_kdr->get_count_rekap_by_jenis('CIF',$tanggal_awal,$tanggal_akhir);
        $data['rekap_inventory'] = $this->m_kdr->get_count_rekap_by_jenis('Inventory',$tanggal_awal,
                                   $tanggal_akhir);
        $data['tf']              = $this->m_kdr->get_count_rekap_by_jenis('Trade Finance',$tanggal_awal,
                                   $tanggal_akhir);
        $data['remmitance']      = $this->m_kdr->get_count_rekap_by_jenis('Remmitance',$tanggal_awal,
                                   $tanggal_akhir);
        $data['deposito']        = $this->m_kdr->get_count_rekap_by_jenis('Deposito',$tanggal_awal,
                                   $tanggal_akhir);
        $data['las']             = $this->m_kdr->get_count_rekap_by_jenis('LAS',$tanggal_awal,$tanggal_akhir);
        $data['cams']            = $this->m_kdr->get_count_rekap_by_jenis('CAMS',$tanggal_awal,$tanggal_akhir);
        $data['total_patching']  = $this->m_kdr->get_total_patching($tanggal_awal,$tanggal_akhir);
        $data['notif_dispo']     = $this->get_notif_dispo();
        $data['totalrealisasi']  = $totalrealisasi;
        $data['totalpencapaian'] = $totalpencapaian;
        $data['tampil_sla']      = json_encode($array_sla, JSON_NUMERIC_CHECK);
        $data['tampil_not_sla']  = json_encode($array_not_sla, JSON_NUMERIC_CHECK);
        $data['sla_sebelum']     = json_encode($array_sla_sebelum, JSON_NUMERIC_CHECK);
        $data['not_sla_sebelum'] = json_encode($array_not_sla_sebelum, JSON_NUMERIC_CHECK); 
        $data['nama_bulan']      = json_encode($nama_bulan, JSON_NUMERIC_CHECK);
        $data['tahun_filter']    = "";
        $data['tahun_sebelum']   = "";
        $this->load->view('kdr/v_header_kdr', $data);
        $this->load->view('kdr/v_patchingResume', $data); 
        $this->load->view('kdr/v_footer_kdr');
    }

    public function filter_resume()
    {
        $tanggal        = $this->input->post('tanggal');
        $tanggal2       = explode('/',$tanggal);
        $tanggal_awal   = $tanggal2[0];
        $tanggal_akhir  = $tanggal2[1];
        $tahun_filter   = substr($tanggal_awal,0,4);
        $filter_sebelum = substr($tanggal_awal,0,4)-1;
        $tahun_sebelum  = (string)$filter_sebelum;

        //Get Holidays
        $holidays     = $this->m_kdr->tanggal_libur();
        $row_holidays = "";
        foreach($holidays as $row)
        {
            $row_holidays[] = $row['tgl_libur']; 
        }
        $holidays = $row_holidays;

        //Perhitungan Total Realisasi dan Total Pencapaian
        $get_tanggal_sla = $this->m_kdr->get_tanggal_sla($tanggal_awal,$tanggal_akhir);
        if(!empty($get_tanggal_sla) ) {
            foreach($get_tanggal_sla as $data)
            {
                $tgl_permohonan = $data["tgl_permohonan"];
                $tgl_patching   = $data["tgl_patching"];
                $justifikasi[]  = $data["justifikasi"];
                $patching[]     = $this->working->getWorkingDays($tgl_permohonan,$tgl_patching,$holidays);

                //Get sla yang tidak lebih dari 5 hari
                $min     = 0;
                $max     = 5;
                $get_sla = array_filter(
                    $patching,
                    function ($value) use($min,$max) {
                        return ($value >= $min && $value <= $max);
                    }
                );
            }

            $count_justif    = count(array_keys($justifikasi, "1"));
            $sla             = count($get_sla)+$count_justif;
            $total_patching2 = count($patching);
            $realisasi       = ($sla/$total_patching2)*1*100;
            $totalrealisasi  = number_format((float)$realisasi, 2, '.', '');
            $pencapaian      = $totalrealisasi/0.97;
            $totalpencapaian = number_format((float)$pencapaian, 2, '.', '');
        }
        else
        {
            $totalrealisasi  = 0;
            $totalpencapaian = 0;
        }

        //Grafik SLA Per Bulan Tahun Filter
        $jan_system   = $this->m_kdr->get_sla_per_bulan_system('1',$tanggal_awal,$tahun_filter);
        $feb_system   = $this->m_kdr->get_sla_per_bulan_system('2',$tanggal_awal,$tahun_filter);
        $mar_system   = $this->m_kdr->get_sla_per_bulan_system('3',$tanggal_awal,$tahun_filter);
        $apr_system   = $this->m_kdr->get_sla_per_bulan_system('4',$tanggal_awal,$tahun_filter);
        $mei_system   = $this->m_kdr->get_sla_per_bulan_system('5',$tanggal_awal,$tahun_filter);
        $jun_system   = $this->m_kdr->get_sla_per_bulan_system('6',$tanggal_awal,$tahun_filter);
        $jul_system   = $this->m_kdr->get_sla_per_bulan_system('7',$tanggal_awal,$tahun_filter);
        $agu_system   = $this->m_kdr->get_sla_per_bulan_system('8',$tanggal_awal,$tahun_filter);
        $sep_system   = $this->m_kdr->get_sla_per_bulan_system('9',$tanggal_awal,$tahun_filter);
        $okt_system   = $this->m_kdr->get_sla_per_bulan_system('10',$tanggal_awal,$tahun_filter);
        $nov_system   = $this->m_kdr->get_sla_per_bulan_system('11',$tanggal_awal,$tahun_filter);
        $des_system   = $this->m_kdr->get_sla_per_bulan_system('12',$tanggal_awal,$tahun_filter);
        $sistem_bulan = array($jan_system,$feb_system,$mar_system,$apr_system,$mei_system,$jun_system,
                        $jul_system,$agu_system,$sep_system,$okt_system,$nov_system,$des_system);

        //Sla dan Non Sla Tahun Filter
        foreach($sistem_bulan as $data)
        {
            $totalSLA    = 0;
            $totalNotSLA = 0;
            foreach($data as $row)
            {
                if($row == null)
                {
                    $count_sla     = 0;
                    $count_not_sla = 0;
                }
                else
                {
                    $patching       = array();
                    $get_sla        = 0;
                    $justifikasi    = "";
                    $tgl_permohonan = $row["tgl_permohonan"];
                    $tgl_patching   = $row["tgl_patching"];
                    $justifikasi[]  = $row["justifikasi"];
                    $patching[]     = $this->working->getWorkingDays($tgl_permohonan,$tgl_patching,$holidays);

                    //Get sla yang tidak lebih dari 5 hari
                    $min_sla = 0;
                    $max_sla = 5;
                    $get_sla = array_filter(
                        $patching,
                        function ($value_sla) use($min_sla,$max_sla) {
                            return ($value_sla >= $min_sla && $value_sla <= $max_sla);
                        }
                    );

                    //Get non sla yang lebih dari 5 hari
                    $max_not_sla = 5;
                    $not_sla     = array_filter(
                        $patching,
                        function ($value_not_sla) use($max_not_sla) {
                            return ($value_not_sla > $max_not_sla);
                        }
                    );  
                    
                    $count_justif  = count(array_keys($justifikasi, "1"));
                    $count_sla     = count($get_sla)+$count_justif;
                    $totalSLA      += $count_sla;
                    $count_not_sla = count($not_sla)-$count_justif;
                    $totalNotSLA   += $count_not_sla;
                }
            }
            $array_sla[]     = $totalSLA;
            $array_not_sla[] = $totalNotSLA;
        }

        //Grafik SLA Per Bulan Tahun Filter -1
        $jan_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('1',$tanggal_awal,$tahun_sebelum);
        $feb_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('2',$tanggal_awal,$tahun_sebelum);
        $mar_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('3',$tanggal_awal,$tahun_sebelum);
        $apr_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('4',$tanggal_awal,$tahun_sebelum);
        $mei_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('5',$tanggal_awal,$tahun_sebelum);
        $jun_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('6',$tanggal_awal,$tahun_sebelum);
        $jul_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('7',$tanggal_awal,$tahun_sebelum);
        $agu_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('8',$tanggal_awal,$tahun_sebelum);
        $sep_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('9',$tanggal_awal,$tahun_sebelum);
        $okt_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('10',$tanggal_awal,$tahun_sebelum);
        $nov_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('11',$tanggal_awal,$tahun_sebelum);
        $des_sebelum = $this->m_kdr->sla_per_bulan_tahun_sebelum('12',$tanggal_awal,$tahun_sebelum);
        $sebelum     = array($jan_sebelum,$feb_sebelum,$mar_sebelum,$apr_sebelum,$mei_sebelum,$jun_sebelum,
                       $jul_sebelum,$agu_sebelum,$sep_sebelum,$okt_sebelum,$nov_sebelum,$des_sebelum);

        //Sla dan Non Sla Tahun Sistem -1
        foreach($sebelum as $data)
        {
            $totalSLAsebelum    = 0;
            $totalNotSLAsebelum = 0;
            foreach($data as $row)
            {
                if($row == null)
                {
                    $count_sla_sebelum     = 0;
                    $count_not_sla_sebelum = 0;
                }
                else
                {
                    $patching       = array();
                    $get_sla        = 0;
                    $justifikasi    = "";
                    $tgl_permohonan = $row["tgl_permohonan"];
                    $tgl_patching   = $row["tgl_patching"];
                    $justifikasi[]  = $row["justifikasi"];
                    $patching[]     = $this->working->getWorkingDays($tgl_permohonan,$tgl_patching,$holidays);

                    //Get sla yang tidak lebih dari 5 hari
                    $min_sla = 0;
                    $max_sla = 5;
                    $get_sla = array_filter(
                        $patching,
                        function ($value_sla) use($min_sla,$max_sla) {
                            return ($value_sla >= $min_sla && $value_sla <= $max_sla);
                        }
                    );

                    //Get non sla yang lebih dari 5 hari
                    $max_not_sla = 5;
                    $not_sla     = array_filter(
                        $patching,
                        function ($value_not_sla) use($max_not_sla) {
                            return ($value_not_sla > $max_not_sla);
                        }
                    );  
                    
                    $count_justif          = count(array_keys($justifikasi, "1"));
                    $count_sla_sebelum     = count($get_sla)+$count_justif;
                    $totalSLAsebelum       += $count_sla_sebelum;
                    $count_not_sla_sebelum = count($not_sla)-$count_justif;
                    $totalNotSLAsebelum    += $count_not_sla_sebelum;
                }
            }
            $array_sla_sebelum[]     = $totalSLAsebelum;
            $array_not_sla_sebelum[] = $totalNotSLAsebelum;
        }

        //Array Bulan
        $bulan = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des");
        foreach($bulan as $row)
        {
            $nama_bulan[] = $row;
        }

        $data                    = $this->data_array;
        $data['css_arr']         = array('daterangepicker.min.css','bootstrap-datetimepicker.min.css',
                                   'bootstrap-datepicker3.min.css','bootstrap-timepicker.min.css');
        $data['js_arr']          = array('highcharts.js','exporting.js','export-data.js','moment.min.js',
                                   'bootstrap-datepicker.min.js','bootstrap-timepicker.min.js',
                                   'daterangepicker.min.js','bootstrap-datetimepicker.min.js');
        $data['rekap_tab']       = $this->m_kdr->get_count_rekap_by_jenis('Tabungan',$tanggal_awal,
                                   $tanggal_akhir);
        $data['rekap_loan']      = $this->m_kdr->get_count_rekap_by_jenis('Pinjaman',$tanggal_awal,
                                   $tanggal_akhir);
        $data['rekap_brinets']   = $this->m_kdr->get_count_rekap_by_jenis('BRINETS',$tanggal_awal,
                                   $tanggal_akhir);
        $data['rekap_giro']      = $this->m_kdr->get_count_rekap_by_jenis('Giro',$tanggal_awal,$tanggal_akhir);
        $data['rekap_ia']        = $this->m_kdr->get_count_rekap_by_jenis('IA',$tanggal_awal,$tanggal_akhir);
        $data['rekap_inventory'] = $this->m_kdr->get_count_rekap_by_jenis('inventory',$tanggal_awal,
                                   $tanggal_akhir);
        $data['rekap_pen']       = $this->m_kdr->get_count_rekap_by_jenis('BRIPENS',$tanggal_awal,
                                   $tanggal_akhir);
        $data['rekap_gl']        = $this->m_kdr->get_count_rekap_by_jenis('GL',$tanggal_awal,$tanggal_akhir);
        $data['rekap_cif']       = $this->m_kdr->get_count_rekap_by_jenis('CIF',$tanggal_awal,$tanggal_akhir);
        $data['tf']              = $this->m_kdr->get_count_rekap_by_jenis('Trade Finance',$tanggal_awal,
                                   $tanggal_akhir);
        $data['remmitance']      = $this->m_kdr->get_count_rekap_by_jenis('Remmitance',$tanggal_awal,
                                   $tanggal_akhir);
        $data['deposito']        = $this->m_kdr->get_count_rekap_by_jenis('Deposito',$tanggal_awal,
                                   $tanggal_akhir);
        $data['las']             = $this->m_kdr->get_count_rekap_by_jenis('LAS',$tanggal_awal,$tanggal_akhir);
        $data['cams']            = $this->m_kdr->get_count_rekap_by_jenis('CAMS',$tanggal_awal,$tanggal_akhir);
        $data['total_patching']  = $this->m_kdr->get_total_patching($tanggal_awal,$tanggal_akhir);
        $total_permintaan        = 0;
        $meet_sla                = 0;
        $data['notif_dispo']     = $this->get_notif_dispo();
        $data['totalrealisasi']  = $totalrealisasi;
        $data['totalpencapaian'] = $totalpencapaian;
        $data['tampil_sla']      = json_encode($array_sla, JSON_NUMERIC_CHECK);
        $data['tampil_not_sla']  = json_encode($array_not_sla, JSON_NUMERIC_CHECK);
        $data['sla_sebelum']     = json_encode($array_sla_sebelum, JSON_NUMERIC_CHECK);
        $data['not_sla_sebelum'] = json_encode($array_not_sla_sebelum, JSON_NUMERIC_CHECK); 
        $data['nama_bulan']      = json_encode($nama_bulan, JSON_NUMERIC_CHECK);
        $data['tahun_filter']    = $tahun_filter;
        $data['tahun_sebelum']   = $tahun_sebelum;
        $data['tanggal']         = $tanggal;
        $this->load->view('kdr/v_header_kdr', $data);
        $this->load->view('kdr/v_patchingResume', $data); 
        $this->load->view('kdr/v_footer_kdr');
    }

    public function detail_resume($tanggal_start,$tanggal_end,$jenis_patching)
    {
        $data                = $this->data_array;
        $level               = $data['level_kdr'];
        $data['notif_dispo'] = $this->get_notif_dispo();
        $holidays            = $this->m_kdr->tanggal_libur();
        $row_holidays        = "";
        foreach($holidays as $row)
        {
            $row_holidays[] = $row['tgl_libur']; 
        }
        $data['holidays'] = $row_holidays;

        //throw library to view
        $mylib            = $this->working;
        $data['working']  = $mylib;

        if($jenis_patching == "TF")
        {
            $jenis_patching = "Trade Finance";
        }
        else
        {
            $jenis_patching = $jenis_patching;
        }

        if($tanggal_start == 0)
        {
            $data['detail_resume']  = $this->m_kdr->detail_resume($jenis_patching,$tanggal_start,$tanggal_end);
            $data['summary']        = $this->m_kdr->summary_resume($jenis_patching,$tanggal_start,$tanggal_end);
            $data['filter']         = 'Tahun '.date("Y");
            $data['tanggal_start']  = 0;
            $data['tanggal_end']    = 0;
            $data['jenis_patching'] = $jenis_patching;
        }
        else
        {
            $data['detail_resume']  = $this->m_kdr->detail_resume($jenis_patching,$tanggal_start,$tanggal_end);
            $data['summary']        = $this->m_kdr->summary_resume($jenis_patching,$tanggal_start,$tanggal_end);
            $tgl_awal               = date("d F Y", strtotime($tanggal_start));
            $tgl_akhir              = date("d F Y", strtotime($tanggal_end));
            $data['filter']         = 'Tanggal '.$tgl_awal.' - '.$tgl_akhir;
            $data['tanggal_start']  = $tanggal_start;
            $data['tanggal_end']    = $tanggal_end;
            $data['jenis_patching'] = $jenis_patching;
        }
        $this->load->view('kdr/v_header_kdr', $data);
        $this->load->view('kdr/v_detailPatchingResume', $data);
        $this->load->view('kdr/v_footer_kdr');
    }

    public function detail_resume_bulan($tahun_filter,$nama_bulan)
    {
        $data                = $this->data_array;
        $level               = $data['level_kdr'];
        $data['notif_dispo'] = $this->get_notif_dispo();
        $tahun_ini           = date("Y");

        //Get Holidays
        $holidays     = $this->m_kdr->tanggal_libur();
        $row_holidays = "";
        foreach($holidays as $row)
        {
            $row_holidays[] = $row['tgl_libur']; 
        }
        $data['holidays'] = $row_holidays;

        //throw library to view
        $mylib            = $this->working;
        $data['working']  = $mylib;

        if($nama_bulan == "Jan"){ $bulan = "1"; }
        else if($nama_bulan == "Feb"){ $bulan = "2"; }
        else if($nama_bulan == "Mar"){ $bulan = "3"; }
        else if($nama_bulan == "Apr"){ $bulan = "4"; }
        else if($nama_bulan == "Mei"){ $bulan = "5"; }
        else if($nama_bulan == "Jun"){ $bulan = "6"; }
        else if($nama_bulan == "Jul"){ $bulan = "7"; }
        else if($nama_bulan == "Agu"){ $bulan = "8"; }
        else if($nama_bulan == "Sep"){ $bulan = "9"; }
        else if($nama_bulan == "Okt"){ $bulan = "10"; }
        else if($nama_bulan == "Nov"){ $bulan = "11"; }
        else{ $bulan = "12"; }

        if($tahun_ini == $tahun_filter)
        {
            $data['resume_bulan']  = $this->m_kdr->resume_bulan($tahun_filter,$bulan);
            $data['summary_bulan'] = $this->m_kdr->summary_bulan($tahun_filter,$bulan);
            $data['tahun_filter']  = $tahun_filter;
            $data['nama_bulan']    = $nama_bulan;
        }
        else
        {
            $data['resume_bulan']  = $this->m_kdr->resume_bulan($tahun_filter,$bulan);
            $data['summary_bulan'] = $this->m_kdr->summary_bulan($tahun_filter,$bulan);
            $data['tahun_filter']  = $tahun_filter;
            $data['nama_bulan']    = $nama_bulan;
        }
        $this->load->view('kdr/v_header_kdr', $data);
        $this->load->view('kdr/v_detailResumeBulan', $data);
        $this->load->view('kdr/v_footer_kdr');
    }

    public function update_justifikasi()
    {
        $id_patching    = $this->input->post('id_patching');
        $keterangan     = $this->input->post('keterangan');
        $justifikasi    = "1";
        $tanggal_start  = $this->input->post('tanggal_start');
        $tanggal_end    = $this->input->post('tanggal_end');
        $jenis_patching = $this->input->post('jenis_patching');

        for ($i = 0; $i < count($id_patching); $i++) 
        {
            $id     = $id_patching[$i];
            $update = $this->m_kdr->update_justifikasi($id,$keterangan,$justifikasi);
        }
        $data = $this->data_array;
        if($update)
        {
            echo '<script language="javascript">';
            echo 'alert("Justifikasi berhasil diupdate")';
            echo '</script>';
            redirect('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/'.$jenis_patching, 'refresh'); 
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Justifikasi gagal diupdate!")';
            echo '</script>';
            redirect('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/'.$jenis_patching, 'refresh');
        }
    }

    public function batal_justifikasi($id_patching,$tanggal_start,$tanggal_end,$jenis_patching)
    {
        $keterangan   = "";
        $justifikasi  = "0";
        $batal_justif = $this->m_kdr->batal_justifikasi($id_patching,$keterangan,$justifikasi);
        $data         = $this->data_array;
        if($batal_justif)
        {
            echo '<script language="javascript">';
            echo 'alert("Justifikasi berhasil dibatalkan")';
            echo '</script>';
            redirect('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/'.$jenis_patching, 'refresh'); 
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Justifikasi gagal dibatalkan!")';
            echo '</script>';
            redirect('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/'.$jenis_patching, 'refresh');
        }
    }

    public function update_justifikasi_bulan()
    {
        $id_patching  = $this->input->post('id_patching');
        $keterangan   = $this->input->post('keterangan');
        $justifikasi  = "1";
        $tahun_filter = $this->input->post('tahun_filter');
        $nama_bulan   = $this->input->post('nama_bulan');

        for ($i = 0; $i < count($id_patching); $i++) 
        {
            $id     = $id_patching[$i];
            $update = $this->m_kdr->update_justifikasi($id,$keterangan,$justifikasi);
        }
        $data = $this->data_array;
        if($update)
        {
            echo '<script language="javascript">';
            echo 'alert("Justifikasi berhasil diupdate")';
            echo '</script>';
            redirect('kdr/patching_resume/detail_resume_bulan/'.$tahun_filter.'/'.$nama_bulan, 'refresh'); 
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Justifikasi gagal diupdate!")';
            echo '</script>';
            redirect('kdr/patching_resume/detail_resume_bulan/'.$tahun_filter.'/'.$nama_bulan, 'refresh'); 
        }
    }

    public function batal_justifikasi_bulan($id_patching,$tahun_filter,$nama_bulan)
    {
        $keterangan   = "";
        $justifikasi  = "0";
        $batal_justif = $this->m_kdr->batal_justifikasi($id_patching,$keterangan,$justifikasi);
        $data         = $this->data_array;
        if($batal_justif)
        {
            echo '<script language="javascript">';
            echo 'alert("Justifikasi berhasil dibatalkan")';
            echo '</script>';
            redirect('kdr/patching_resume/detail_resume_bulan/'.$tahun_filter.'/'.$nama_bulan, 'refresh');
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Justifikasi gagal dibatalkan!")';
            echo '</script>';
            redirect('kdr/patching_resume/detail_resume_bulan/'.$tahun_filter.'/'.$nama_bulan, 'refresh');
        }
    }

    public function download_resume($tanggal_start,$tanggal_end)
    {
        if($tanggal_start == 0)
        {
            $data['isiexcel']       = $this->m_kdr->download_resume($tanggal_start,$tanggal_end);
            $data['tanggal']        = 'Tahun '.date("Y");
        }
        else
        {
            $data['isiexcel']       = $this->m_kdr->download_resume($tanggal_start,$tanggal_end);
            $tgl_awal               = date("d F Y", strtotime($tanggal_start));
            $tgl_akhir              = date("d F Y", strtotime($tanggal_end));
            $data['tanggal']        = 'Tanggal '.$tgl_awal.' - '.$tgl_akhir;
        }
        $this->load->view('kdr/v_excelResume', $data);
    }

    public function download_detail_resume($tanggal_start,$tanggal_end,$jenis_patching)
    {
        if($tanggal_start == 0)
        {
            $data['isiexcel']       = $this->m_kdr->detail_resume($jenis_patching,$tanggal_start,$tanggal_end);
            $data['tanggal']        = 'Tahun '.date("Y");
            $data['jenis_patching'] = $jenis_patching;
        }
        else
        {
            $data['isiexcel']       = $this->m_kdr->detail_resume($jenis_patching,$tanggal_start,$tanggal_end);
            $tgl_awal               = date("d F Y", strtotime($tanggal_start));
            $tgl_akhir              = date("d F Y", strtotime($tanggal_end));
            $data['tanggal']        = 'Tanggal '.$tgl_awal.' - '.$tgl_akhir;   
            $data['jenis_patching'] = $jenis_patching;
        }
        $this->load->view('kdr/v_excelDetailResume', $data);
    }

    public function download_resume_bulan($tahun_filter,$nama_bulan)
    {
        $tahun_ini = date("Y");
        if($nama_bulan == "Jan"){ $bulan = "1"; }
        else if($nama_bulan == "Feb"){ $bulan = "2"; }
        else if($nama_bulan == "Mar"){ $bulan = "3"; }
        else if($nama_bulan == "Apr"){ $bulan = "4"; }
        else if($nama_bulan == "Mei"){ $bulan = "5"; }
        else if($nama_bulan == "Jun"){ $bulan = "6"; }
        else if($nama_bulan == "Jul"){ $bulan = "7"; }
        else if($nama_bulan == "Agu"){ $bulan = "8"; }
        else if($nama_bulan == "Sep"){ $bulan = "9"; }
        else if($nama_bulan == "Okt"){ $bulan = "10"; }
        else if($nama_bulan == "Nov"){ $bulan = "11"; }
        else{ $bulan = "12"; }

        if($tahun_filter == $tahun_ini)
        {
            $data['isiexcel']     = $this->m_kdr->resume_bulan($tahun_filter,$bulan);
            $data['tahun_filter'] = $tahun_filter;
            $data['nama_bulan']   = $nama_bulan;
        }
        else
        {
            $data['isiexcel']     = $this->m_kdr->resume_bulan($tahun_filter,$bulan);
            $data['tahun_filter'] = $tahun_filter;
            $data['nama_bulan']   = $nama_bulan;
        }
        $this->load->view('kdr/v_excelResumeBulan', $data);
    }

    public function get_notif_dispo()
    {
        $data    = $this->data_array;
        $level   = $data['level_kdr'];
        $id_user = $data['id_user'];

        if($level == "adminkdr")
        {
            $data['notif_dispo'] = '';
            return $data['notif_dispo'];
        }
        else if($level == "staffkdr")
        {
            $id_pic = $this->m_dispo->get_pic($id_user);
            
            $array_pic = "";
            foreach($id_pic as $row)
            {
                $array_pic[] = $row['id_pic'];
            }

            if($array_pic == "")
            {
                $data['notif_dispo'] = "";
            }
            else
            {
                $user_pic = implode(",",$array_pic);

                //Compare user pic yang di db dengan username login
                $pos      = strpos($user_pic, $id_user);

                if($pos !== false) 
                {
                    $filter_pic = $id_user;
                } 
                else 
                {
                    $filter_pic = "";
                }
                $notif_dispo   = $this->m_dispo->notif_dispo($filter_pic);

                foreach($notif_dispo as $row)
                {
                    $notif[] = $row['hitung'];
                }
                $hitung_notif = implode(",",$notif);

                if($hitung_notif == 0)
                {
                    $notif = "";
                }
                else
                {
                    $notif = $hitung_notif;
                }

                $data['notif_dispo'] = $notif;
            }
            return $data['notif_dispo'];
        }
        else
        {

        }
    }
}