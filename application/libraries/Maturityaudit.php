<?php
class Maturityaudit {

	function getMaturity(){
		$CI =& get_instance();
    	$CI->load->model('monica/m_audit');
        //Level Maturity APP
        $semua_maturity   = $CI->m_audit->semua_maturity();
        $total_app        = 0;
        $total_bagian_kmg = 0;
        $total_bagian_pqa = 0;
        $total_bagian_opl = 0;
        $total_bagian_cbs = 0;
        $total_bagian_sku = 0;
        $total_bagian_sld = 0;
        $total_bagian_itp = 0;
        $total_bagian_msa = 0;
        $total_bagian_sbp = 0;
        $total_bagian_kop = 0;
        $total_bagian_ibr = 0;
        $total_bagian_sdk = 0;
        $total_bagian_aes = 0;
        $total_bagian_cao = 0;
        $total_bagian_mao = 0;
        $total_bagian_dao = 0;
        $total_bagian_itg = 0;
        $nama_bagian      = array();
        foreach ($semua_maturity as $semuamatur) {
            $nama_bagian[] = $semuamatur['divisi_name'];
            $total_app += $this->get_major($semuamatur);
            $total_app += $this->get_minor($semuamatur);
            $total_app += $this->get_moderate($semuamatur);
            if($semuamatur['divisi_name'] == "KMG"){
                $total_bagian_kmg += $this->get_major($semuamatur);
                $total_bagian_kmg += $this->get_minor($semuamatur);
                $total_bagian_kmg += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "PQA"){
                $total_bagian_pqa += $this->get_major($semuamatur);
                $total_bagian_pqa += $this->get_minor($semuamatur);
                $total_bagian_pqa += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "OPL"){
                $total_bagian_opl += $this->get_major($semuamatur);
                $total_bagian_opl += $this->get_minor($semuamatur);
                $total_bagian_opl += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "CBS"){
                $total_bagian_cbs += $this->get_major($semuamatur);
                $total_bagian_cbs += $this->get_minor($semuamatur);
                $total_bagian_cbs += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "SKU"){
                $total_bagian_sku += $this->get_major($semuamatur);
                $total_bagian_sku += $this->get_minor($semuamatur);
                $total_bagian_sku += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "SLD"){
                $total_bagian_sld += $this->get_major($semuamatur);
                $total_bagian_sld += $this->get_minor($semuamatur);
                $total_bagian_sld += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "ITP"){
                $total_bagian_itp += $this->get_major($semuamatur);
                $total_bagian_itp += $this->get_minor($semuamatur);
                $total_bagian_itp += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "MSA"){
                $total_bagian_msa += $this->get_major($semuamatur);
                $total_bagian_msa += $this->get_minor($semuamatur);
                $total_bagian_msa += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "SBP"){
                $total_bagian_sbp += $this->get_major($semuamatur);
                $total_bagian_sbp += $this->get_minor($semuamatur);
                $total_bagian_sbp += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "KOP"){
                $total_bagian_kop += $this->get_major($semuamatur);
                $total_bagian_kop += $this->get_minor($semuamatur);
                $total_bagian_kop += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "IBR"){
                $total_bagian_ibr += $this->get_major($semuamatur);
                $total_bagian_ibr += $this->get_minor($semuamatur);
                $total_bagian_ibr += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "SDK"){
                $total_bagian_sdk += $this->get_major($semuamatur);
                $total_bagian_sdk += $this->get_minor($semuamatur);
                $total_bagian_sdk += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "AES"){
                $total_bagian_aes += $this->get_major($semuamatur);
                $total_bagian_aes += $this->get_minor($semuamatur);
                $total_bagian_aes += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "CAO"){
                $total_bagian_cao += $this->get_major($semuamatur);
                $total_bagian_cao += $this->get_minor($semuamatur);
                $total_bagian_cao += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "MAO"){
                $total_bagian_mao += $this->get_major($semuamatur);
                $total_bagian_mao += $this->get_minor($semuamatur);
                $total_bagian_mao += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "DAO"){
                $total_bagian_dao += $this->get_major($semuamatur);
                $total_bagian_dao += $this->get_minor($semuamatur);
                $total_bagian_dao += $this->get_moderate($semuamatur);
            }
            if($semuamatur['divisi_name'] == "ITG"){
                $total_bagian_itg += $this->get_major($semuamatur);
                $total_bagian_itg += $this->get_minor($semuamatur);
                $total_bagian_itg += $this->get_moderate($semuamatur);
            }
        }
        $maturity_app = $total_app;
        $maturity_kmg = $total_bagian_kmg*10;
        $maturity_pqa = $total_bagian_pqa*10;
        $maturity_opl = $total_bagian_opl*10;
        $maturity_cbs = $total_bagian_cbs*10;
        $maturity_sku = $total_bagian_sku*10;
        $maturity_sld = $total_bagian_sld*10;
        $maturity_itp = $total_bagian_itp*10;
        $maturity_msa = $total_bagian_msa*10;
        $maturity_sbp = $total_bagian_sbp*10;
        $maturity_kop = $total_bagian_kop*10;
        $maturity_ibr = $total_bagian_ibr*10;
        $maturity_sdk = $total_bagian_sdk*10;
        $maturity_aes = $total_bagian_aes*10;
        $maturity_cao = $total_bagian_cao*10;
        $maturity_mao = $total_bagian_mao*10;
        $maturity_dao = $total_bagian_dao*10;
        $maturity_itg = $total_bagian_itg*10;
        $bagian       = $nama_bagian;
        $count        = count($nama_bagian)-1;
        $urutan       = array($maturity_kmg,$maturity_pqa,$maturity_opl,$maturity_cbs,$maturity_sku,$maturity_sld,$maturity_itp,
                        $maturity_msa,$maturity_sbp,$maturity_kop,$maturity_ibr,$maturity_sdk,$maturity_aes,$maturity_cao,$maturity_mao,
                        $maturity_dao,$maturity_itg);

        //Level Maturity Bidang QA
        $levelmaturityqa          = $CI->m_audit->maturity_qa();
        $nilai_major              = 60;
        $nilai_minor              = 10;
        $nilai_moderate           = 30;
        $totalmajorqa             = 0;
        $totalmajormemadaiqa      = 0;
        $satuan_nilai_major_qa    = 0;
        $major_qa                 = 0;
        $totalminorqa             = 0;
        $totalminormemadaiqa      = 0;
        $satuan_nilai_minor_qa    = 0;
        $minor_qa                 = 0;
        $totalmoderateqa          = 0;
        $totalmoderatememadaiqa   = 0;
        $satuan_nilai_moderate_qa = 0;
        $moderate_qa              = 0;
        $total_qa                 = 0;
        foreach ($levelmaturityqa as $maturityqa){
            $totalmajorqa += $maturityqa['total_major'];
            if ($totalmajorqa != 0){
                $totalmajormemadaiqa   += $maturityqa['total_major_memadai'];
                $satuan_nilai_major_qa = $nilai_major/$totalmajorqa;
                $major_qa              = $totalmajormemadaiqa*$satuan_nilai_major_qa;
            }else{
                $major_qa = $nilai_major;
            }

            $totalminorqa += $maturityqa['total_minor'];
            if ($maturityqa['total_minor'] != 0){
                $totalminormemadaiqa   += $maturityqa['total_minor_memadai'];
                $satuan_nilai_minor_qa = $nilai_minor/$totalminorqa;
                $minor_qa              = $totalminormemadaiqa*$satuan_nilai_minor_qa;
            }else{
                $minor_qa = $nilai_minor;
            }

            $totalmoderateqa += $maturityqa['total_moderate'];
            if ($totalmoderateqa != 0){
                $totalmoderatememadaiqa   += $maturityqa['total_moderate_memadai'];
                $satuan_nilai_moderate_qa = $nilai_moderate/$totalmoderateqa;
                $moderate_qa              = $totalmoderatememadaiqa*$satuan_nilai_moderate_qa;
            }else{
                $moderate_qa = $nilai_moderate;
            }
            $total_qa = $major_qa+$minor_qa+$moderate_qa;
        }
        $maturity_qa = $total_qa;

        //Level Maturity Bidang OPS
        $levelmaturityops          = $CI->m_audit->maturity_ops();
        $totalmajorops             = 0;
        $totalmajormemadaiops      = 0;
        $satuan_nilai_major_ops    = 0;
        $major_ops                 = 0;
        $totalminorops             = 0;
        $totalminormemadaiops      = 0;
        $satuan_nilai_minor_ops    = 0;
        $minor_ops                 = 0;
        $totalmoderateops          = 0;
        $totalmoderatememadaiops   = 0;
        $satuan_nilai_moderate_ops = 0;
        $moderate_ops              = 0;
        $total_ops                 = 0;
        foreach ($levelmaturityops as $maturityops){
            $totalmajorops += $maturityops['total_major'];
            if ($totalmajorops != 0){
                $totalmajormemadaiops   += $maturityops['total_major_memadai'];
                $satuan_nilai_major_ops = $nilai_major/$totalmajorops;
                $major_ops              = $totalmajormemadaiops*$satuan_nilai_major_ops;
            }else{
                $major_ops = $nilai_major;
            }

            $totalminorops += $maturityops['total_minor'];
            if ($totalminorops != 0){
                $totalminormemadaiops   += $maturityops['total_minor_memadai'];
                $satuan_nilai_minor_ops = $nilai_minor/$totalminorops;
                $minor_ops              = $totalminormemadaiops*$satuan_nilai_minor_ops;
            }else{
                $minor_ops = $nilai_minor;
            }

            $totalmoderateops += $maturityops['total_moderate'];
            if ($totalmoderateops != 0){
                $totalmoderatememadaiops   += $maturityops['total_moderate_memadai'];
                $satuan_nilai_moderate_ops = $nilai_moderate/$totalmoderateops;
                $moderate_ops              = $totalmoderatememadaiops*$satuan_nilai_moderate_ops;
            }else{
                $moderate_ops = $nilai_moderate;
            }
            $total_ops = $major_ops+$minor_ops+$moderate_ops;
        }
        $maturity_ops = $total_ops;

        return array(
            'maturity_app' => $maturity_app,
            'maturity_qa'  => $maturity_qa,
            'maturity_ops' => $maturity_ops,
            'bagian'       => $bagian,
            'count'        => $count,
            'urutan'       => $urutan
		);
    }

    //Perhitungan Maturity OPT
    function get_major($data) {
        if ($data['total_major'] == 0) {
            return $data['major_value'];
        } else {
            if($data['total_major_memadai'] != 0 && $data['total_major_diluar_memadai'] == 0){
                return ($data['major_value'] / $data['total_major']) * $data['total_major_memadai'];
            }else{
                return 0;
            }
        }
    }

    function get_minor($data) {
        if ($data['total_minor'] == 0) {
            return $data['minor_value'];
        } else {
            if($data['total_minor_memadai'] != 0 && $data['total_minor_diluar_memadai'] == 0){
                return ($data['minor_value'] / $data['total_minor']) * $data['total_minor_memadai'];
            }else{
                return 0;
            }
        }
    }

    function get_moderate($data) {
        if ($data['total_moderate'] == 0) {
            return $data['moderate_value'];
        } else {
            if($data['total_moderate_memadai'] != 0 && $data['total_moderate_diluar_memadai'] == 0){
                return ($data['moderate_value'] / $data['total_moderate']) * $data['total_moderate_memadai'];
            }else{
                return 0;
            }
        }
    }
}
