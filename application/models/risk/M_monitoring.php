<?php 
  
class M_monitoring extends CI_Model
{	
	public function __construct(){
        parent::__construct();
    }

    public function listapp($bia_app){
        if($bia_app == ""){
            $filter = "";
        }else{
            $filter = "WHERE bia_app = '$bia_app'";
        }
        $sql   = "SELECT * FROM list_app $filter";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function listappdashboard(){
        $sql   = "SELECT * FROM list_app ORDER BY bia_app";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function jml_server($id_app){
        $sql   = "SELECT COUNT(aps.id_app) AS jml_server FROM app_server aps WHERE aps.id_app='$id_app'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function peraplikasi($id_app){
        $sql = "SELECT cur.score_risk, lis.bobot_risk, cur.score_risk * lis.bobot_risk AS 'ScorexBobot', 
                SUM(cur.score_risk * lis.bobot_risk) AS JumlahKategori, kat.id_kategori_risk, 
                SUM(lis.bobot_risk) AS JumlahBobot,
                SUM(cur.score_risk * lis.bobot_risk) / SUM(lis.bobot_risk) AS JumlahperKategori,
                kat.bobot_kategori,
                (SUM(cur.score_risk * lis.bobot_risk) / SUM(lis.bobot_risk)) * (kat.bobot_kategori/100) AS HasilFix,
                lis.id_kategori_risk, aps.id_app_server, aps.id_app, kat.nama_kategori, las.nama_app
                FROM current_risk cur
                LEFT JOIN app_server aps ON aps.id_app_server = cur.id_app_server
                LEFT JOIN list_risk lis ON lis.id_list_risk = cur.id_list_risk
                LEFT JOIN kategori_risk kat ON kat.id_kategori_risk = lis.id_kategori_risk
                LEFT JOIN list_app las ON las.id_list_app = aps.id_app
                WHERE cur.date_modified IN (SELECT MAX(curr.date_modified) AS id FROM current_risk curr 
                GROUP BY curr.id_app_server) AND aps.id_app='$id_app'
                GROUP BY lis.id_kategori_risk, aps.id_app_server
                ORDER BY aps.id_app_server";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function risk_server(){
		$sql   = "SELECT nama_risk, kontrol_skor FROM list_risk WHERE kontrol_skor='1' group by id_list_risk";
		$query = $this->db->query($sql);
        return $query->result_array();
    }

    public function risk_aplikasi(){
        $sql   = "SELECT nama_risk, kontrol_skor FROM list_risk WHERE kontrol_skor='2' group by id_list_risk";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function list_risk_server($id_app_server){
        $sql = "SELECT risk.id_list_risk, risk.nama_risk, risk.kontrol_skor, cur.id_app_server, cur.score_risk
                FROM list_risk risk 
                LEFT JOIN current_risk cur ON cur.id_list_risk = risk.id_list_risk 
                LEFT JOIN app_server aps ON aps.id_app_server = cur.id_app_server 
                WHERE 
                (cur.date_modified IN (SELECT MAX(curr.date_modified) AS id FROM current_risk curr 
                LEFT JOIN list_risk ris ON ris.id_list_risk = curr.id_list_risk 
                LEFT JOIN app_server ap ON ap.id_app_server = curr.id_app_server 
                WHERE ris.kontrol_skor='1' AND ap.id_app_server='$id_app_server' GROUP BY curr.id_app_server)) 
                GROUP BY risk.id_list_risk";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function get_server(){
        $sql   = "SELECT risk.id_list_risk, risk.nama_risk FROM list_risk risk WHERE risk.kontrol_skor='1'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function list_risk_aplikasi($id_app_server,$id_app){
        $sql = "SELECT risk.id_list_risk, risk.nama_risk, risk.kontrol_skor, cur.id_app_server, cur.score_risk
                FROM list_risk risk 
                LEFT JOIN current_risk cur ON cur.id_list_risk = risk.id_list_risk 
                LEFT JOIN app_server aps ON aps.id_app_server = cur.id_app_server 
                WHERE 
                (cur.date_modified IN (SELECT MAX(curr.date_modified) AS id FROM current_risk curr 
                LEFT JOIN list_risk ris ON ris.id_list_risk = curr.id_list_risk 
                LEFT JOIN app_server ap ON ap.id_app_server = curr.id_app_server 
                WHERE ris.kontrol_skor='2' AND ap.id_app='$id_app'
                GROUP BY ap.id_app)) GROUP BY risk.id_list_risk";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_aplikasi(){
        $sql   = "SELECT risk.id_list_risk, risk.nama_risk FROM list_risk risk WHERE risk.kontrol_skor='2'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function data_app_server($id_app_server){
		if($id_app_server == ""){
            $filter = "GROUP BY aps.id_app_server";
        }else{
            $filter = "AND aps.id_app_server = '$id_app_server' LIMIT 1";
        }
		$sql = "SELECT lap.nama_app, les.ip_server, les.jenis_server, risk.nama_risk, aps.id_app_server, aps.id_app, 
                aps.id_server, cur.score_risk
				FROM app_server aps
				LEFT JOIN list_app lap ON lap.id_list_app = aps.id_app
				LEFT JOIN list_server les ON les.id_list_server = aps.id_server
				LEFT JOIN current_risk cur ON cur.id_app_server = aps.id_app_server
				LEFT JOIN list_risk risk ON cur.id_list_risk = risk.id_list_risk 
				WHERE (cur.date_modified IN (SELECT MAX(curr.date_modified) AS id FROM current_risk curr GROUP BY curr.id_app_server) OR score_risk IS NULL) $filter";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function simpan_current_risk($id_list_risk,$id_app_server,$score_risk,$user_modified,$date_modified){
        $data = array(
            'id_list_risk'  => $id_list_risk,
			'id_app_server' => $id_app_server,
			'score_risk'    => $score_risk,
			'user_modified' => $user_modified,
			'date_modified' => $date_modified
        );
        $this->db->insert('current_risk',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function lihat_score_server($id_app_server){
        $sql = "SELECT risk.id_list_risk, risk.nama_risk, risk.kontrol_skor, cur.id_app_server, cur.score_risk
                FROM list_risk risk 
                LEFT JOIN current_risk cur ON cur.id_list_risk = risk.id_list_risk 
                LEFT JOIN app_server aps ON aps.id_app_server = cur.id_app_server 
                WHERE 
                (cur.date_modified IN (SELECT MAX(curr.date_modified) AS id FROM current_risk curr 
                LEFT JOIN list_risk ris ON ris.id_list_risk = curr.id_list_risk 
                LEFT JOIN app_server ap ON ap.id_app_server = curr.id_app_server 
                WHERE ris.kontrol_skor = '1' AND ap.id_app_server='$id_app_server' GROUP BY curr.id_app_server)) 
                GROUP BY risk.id_list_risk";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function lihat_score_aplikasi($id_app){
        $sql = "SELECT risk.id_list_risk, risk.nama_risk, risk.kontrol_skor, cur.id_app_server, cur.score_risk
                FROM list_risk risk 
                LEFT JOIN current_risk cur ON cur.id_list_risk = risk.id_list_risk 
                LEFT JOIN app_server aps ON aps.id_app_server = cur.id_app_server 
                WHERE 
                (cur.date_modified IN (SELECT MAX(curr.date_modified) AS id FROM current_risk curr 
                LEFT JOIN list_risk ris ON ris.id_list_risk = curr.id_list_risk 
                LEFT JOIN app_server ap ON ap.id_app_server = curr.id_app_server 
                WHERE ris.kontrol_skor = '2' AND ap.id_app='$id_app' GROUP BY ap.id_app)) 
                GROUP BY risk.id_list_risk";
        $query = $this->db->query($sql);
        return $query->result();
    }
}