<?php 
     
class All_dashboard extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('risk/m_monitoring');
    }

    public function index(){
    	//Level Maturity APP
		$maturity             = $this->maturityaudit->getMaturity();
		$data['maturity_app'] = $maturity['maturity_app'];
		$data['bagian']       = $maturity['bagian'];
		$data['count']        = $maturity['count'];
		$data['urutan']       = $maturity['urutan'];

		//Risk By Apps
		$listapp          = $this->m_monitoring->listappdashboard();
		$very_critical    = array();
		$critical         = array();
		$high             = array();
		$medium           = array();
		$low              = array();
		$app_veryCritical = array();
		$app_critical     = array();
		$app_high         = array();
		$app_medium       = array();
		$app_low          = array();
		$nama_app         = array();
		$semua            = array();
		foreach($listapp as $row){
			$id_app     = $row['id_list_app'];
			$bia_app    = $row['bia_app'];
			$nama_app[] = $row['nama_app'];
			$semua[]    = $this->getHasil($id_app);

			//Per Bia App
			if($bia_app == "5"){
				$very_critical[]    = $this->getHasil($id_app);
				$app_veryCritical[] = $row['nama_app'];
			}else if($bia_app == "4"){
				$critical[]     = $this->getHasil($id_app);
				$app_critical[] = $row['nama_app'];
			}else if($bia_app == "3"){
				$high[]     = $this->getHasil($id_app);
				$app_high[] = $row['nama_app'];
			}else if($bia_app == "2"){
				$medium[]     = $this->getHasil($id_app);
				$app_medium[] = $row['nama_app'];
			}else{
				$low[]     = $this->getHasil($id_app);
				$app_low[] = $row['nama_app'];
			}			
		}

		if($nama_app != ""){
			$jml_nama_app           = array_count_values($nama_app);
			$jumlah_aplikasi        = count($jml_nama_app);
			$total                  = array_sum($semua);
			$all_monitoring         = $total/$jumlah_aplikasi;
			$data['all_monitoring'] = floor($all_monitoring * 100) / 100;
		}else{
			$data['all_monitoring'] = 0.00;
		}
		$count_veryCritical = count($app_veryCritical)-1;
		$count_critical     = count($app_critical)-1;
		$count_high         = count($app_high)-1;
		$count_medium       = count($app_medium)-1;
		$count_low          = count($app_low)-1;
		//Very Critical
		$data['idVC']       = $app_veryCritical;
		$data['namaVC']     = $app_veryCritical;
		$data['nilaiVC']    = $very_critical;
		$data['countVC']    = $count_veryCritical;
		//Critical
		$data['idC']       = $app_critical;
		$data['namaC']     = $app_critical;
		$data['nilaiC']    = $critical;
		$data['countC']    = $count_critical;
		//High
		$data['idH']       = $app_high;
		$data['namaH']     = $app_high;
		$data['nilaiH']    = $high;
		$data['countH']    = $count_high;
		//Medium
		$data['idM']       = $app_medium;
		$data['namaM']     = $app_medium;
		$data['nilaiM']    = $medium;
		$data['countM']    = $count_medium;
		//Low
		$data['idL']       = $app_low;
		$data['namaL']     = $app_low;
		$data['nilaiL']    = $low;
		$data['countL']    = $count_low;
        $this->load->view('header_allDashboard');
        $this->load->view('allDashboard', $data);
    }

    public function getHasil($id_app){
		$jml_server   = $this->m_monitoring->jml_server($id_app);
		$count_server = $jml_server['jml_server'];
		$peraplikasi  = $this->m_monitoring->peraplikasi($id_app);
		$a            = 0;
		$b            = 0;
		foreach($peraplikasi as $rowhasil){
			if($rowhasil['id_kategori_risk'] == '1'){
				$a += $rowhasil['HasilFix'];
			}else{
				$b += $rowhasil['HasilFix'];
			}
		}
		$a_fix      = $a/$count_server;
		$hasil      = ($a_fix+$b);
		$totalsemua = number_format((float)$hasil, 2, '.', '');
		$float      = (float)$totalsemua;
		return $float;
    }
}