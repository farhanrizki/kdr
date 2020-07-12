<?php 
  
class M_risk extends CI_Model
{	
	public function __construct()
    {
        parent::__construct();
    }

	/*============== MENU UBAH PASSWORD ===================*/
	public function cek_password($id_user,$password_lama_sha)
	{
		$this->db->select('id_user, password');    
		$this->db->from('tb_user');
		$this->db->where('id_user', $id_user);
		$this->db->where('password', $password_lama_sha);
		$query = $this->db->get();
		if($query->num_rows() == 0)
	    {
	    	return false;
	    }
	    else
	    {
	    	return $query->result();
	    }
	}

	public function update_password($id_user,$password_baru_sha)
	{
		$data=array('password'=>$password_baru_sha);
		$this->db->where('id_user', $id_user);
        $this->db->update('tb_user', $data);
        return true;
	}

	/*============== MENU DASHBOARD ===================*/
	public function notifInsiden()
	{	
		$where    = "last_status = 'Dalam Penanganan' AND (insiden_cause = 'Host, Data Center, Operasional (OPT)' 
					OR insiden_cause = 'Local Problem')";
		$this->db->select('bagian, nama_insiden, insiden_cause, lingkup_impact, last_status');
	    $this->db->from('insidenreport');
	    $this->db->where($where);
	    $query = $this->db->get();
	    if($query->num_rows() > 0)
	    {
	    	return true;
	    }
	    else
	    {
	    	return false;
	    }
	}

	public function insiden_bagian($bagian_kapital)
	{
		$where    = "last_status = 'Dalam Penanganan' AND (insiden_cause = 'Host, Data Center, Operasional (OPT)' OR 
					insiden_cause = 'Local Problem') AND engineer like '%.$bagian_kapital.%'";
		$this->db->select('bagian, nama_insiden, lingkup_impact, last_status');
	    $this->db->from('insidenreport');
	    $this->db->where($where);
	    $query = $this->db->get();
	    return $query->result_array();
	}
	
	public function detil_insiden($bagian_kapital)
	{
		$where    = "last_status = 'Dalam Penanganan' AND engineer like '%.$bagian_kapital.%'";
		$this->db->select('bagian, nama_insiden, lingkup_impact, last_status, engineer, insiden_cause');
	    $this->db->from('insidenreport');
	    $this->db->where($where);
	    $query = $this->db->get();
	    return $query->result_array();
	}

	public function allRisk()
	{
		$this->db->select('*');
		$this->db->from('tb_bobot');		
		$query = $this->db->get();
		return $query->result_array();	
	}

	public function avgid($id)
	{
		$this->db->select('avg(risk_gabungan) as avg');
		$this->db->from('tb_risk');		
		$this->db->where('id_user',$id);		
		$query = $this->db->get();
		return $query->result_array();	
	}

	public function username($id)
	{
		$this->db->select('*');
		$this->db->from('tb_user');		
		$this->db->where('id_user',$id);		
		$query = $this->db->get();
		return $query->result_array();	
	}

	public function insiden_peruser($username)
	{
		$this->db->select('bagian, nama_insiden, insiden_cause, lingkup_impact, last_status');
		$this->db->from('insidenreport');		
		$this->db->like('engineer',$username);		
		$query = $this->db->get();
		return $query->result_array();	
	}

	public function update_risk_profile($nilai,$user)
	{
		$data=array('nilai_risk'=>$nilai);
		$this->db->where('id_user',$user);
        $this->db->update('tb_tampil', $data);
	}

	/*============== MENU RISK ISSUE ===================*/
	public function data_risk_issue()
	{
		$where = "tambah_user=0";
		$this->db->select('*');    
		$this->db->from('tb_risk');
		$this->db->join('tb_user', 'tb_risk.id_user = tb_user.id_user');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambah_risk_issue($id_user,$risk_issue)
	{
		$data = array(
			'id_user'    => $id_user,
			'risk_issue' => $risk_issue
	    );

	    $this->db->insert('tb_risk',$data);
	    return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function update_risk_issue($id_risk,$risk_issue)
	{
		$data=array('risk_issue'=>$risk_issue);
		$this->db->where('id_risk',$id_risk);
        $this->db->update('tb_risk', $data);
        return true;
	}

	public function hapus_risk_issue($id_risk)
	{
		$this->db->where('id_risk', $id_risk);
		$this->db->delete('tb_risk'); 
		return true;
	}

	public function tambah_risk_user($id_user,$risk_issue_tambah,$tambah_user)
	{
		$data = array(
			'id_user'           => $id_user,
			'risk_issue_tambah' => $risk_issue_tambah,
			'tambah_user'       => $tambah_user
	    );

	    $this->db->insert('tb_risk',$data);
	    return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function update_risk_user($id_risk,$risk_issue_edit,$edit_user)
	{
		$data=array('risk_issue_edit'=>$risk_issue_edit, 'edit_user'=>$edit_user);
		$this->db->where('id_risk',$id_risk);
        $this->db->update('tb_risk', $data);
        return true;
	}

	public function hapus_risk_user($id_risk,$hapus_user)
	{
		$data=array('hapus_user'=>$hapus_user);
		$this->db->where('id_risk',$id_risk);
        $this->db->update('tb_risk', $data);
        return true;
	}

	/*============== MENU RISK ASSESSMENT ===================*/
	public function isi_risk_assessment($id_user)
	{
		$where = "tb_risk.risk_issue IS NOT NULL";
		$this->db->select('*');    
		$this->db->from('tb_risk');
		$this->db->join('tb_user', 'tb_risk.id_user = tb_user.id_user');
		$this->db->where('tb_risk.id_user', $id_user);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function simpan_risk($impactid,$likelihoodid,$array,$id)
	{
		$data = array('impact'=>$impactid, 'likelihood'=>$likelihoodid, 'irs'=>$array);
		$this->db->where('id_risk',$id);
        $this->db->update('tb_risk', $data);
        return true;
	}

	public function update_risk($kontrol_mitigasi,$id)
	{
		$data = array('kontrol_mitigasi'=>$kontrol_mitigasi);
		$this->db->where('id_risk',$id);
        $this->db->update('tb_risk', $data);
        return true;
	}

	/*============== MENU EDIT BOBOT ===================*/
	public function tampil_bobot()
	{
		$this->db->select('*');    
		$this->db->from('tb_bobot');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function update_bobot($pqa,$inf,$shd,$ost,$osd,$opl,$isd,$pen,$tik,$kdr)
	{
		$data = array(
						'pqa'=>$pqa,
						'inf'=>$inf,
						'shd'=>$shd,
						'ost'=>$ost,
						'osd'=>$osd,
						'opl'=>$opl,
						'isd'=>$isd,
						'pen'=>$pen,
						'tik'=>$tik,
						'kdr'=>$kdr
					);
        $this->db->update('tb_bobot', $data);
        return true;
	}

	/*============== MENU PENILAIAN KONTROL ===================*/
	public function kontrol_baru()
	{
		$where = "likelihood IS NOT NULL and nk < 1 OR nk is NULL OR nk = 0";
		$this->db->select('*');    
		$this->db->from('tb_risk');
		$this->db->join('tb_user', 'tb_risk.id_user = tb_user.id_user');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function kontrol_lama()
	{
		$where = "likelihood IS NOT NULL AND nk >= 1";
		$this->db->select('*');    
		$this->db->from('tb_risk');
		$this->db->join('tb_user', 'tb_risk.id_user = tb_user.id_user');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function update_kontrol($nkid,$avg,$id)
	{
		$data = array('nk'=>$nkid, 'risk_gabungan'=>$avg);
		$this->db->where_in('id_risk',$id);
        $this->db->update('tb_risk', $data);
        return true;
	}

	/*============== MENU PERSETUJUAN ===================*/
	public function data_persetujuan()
	{
		$where = "tambah_user=1 OR edit_user=1 OR hapus_user=1";
		$this->db->select('*');    
		$this->db->from('tb_risk');
		$this->db->join('tb_user', 'tb_risk.id_user = tb_user.id_user');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
	}	

	public function tambah_persetujuan($id_risk,$risk_issue_tambah,$tambah_user,$null)
	{
		$data = array('risk_issue'=>$risk_issue_tambah, 'tambah_user'=>$tambah_user, 'risk_issue_tambah'=>$null);
		$this->db->where_in('id_risk',$id_risk);
        $this->db->update('tb_risk', $data);
        return true;
	}

	public function update_persetujuan($id_risk,$risk_issue_edit,$edit_user,$null)
	{
		$data = array('risk_issue'=>$risk_issue_edit, 'edit_user'=>$edit_user, 'risk_issue_edit'=>$null);
		$this->db->where_in('id_risk',$id_risk);
        $this->db->update('tb_risk', $data);
        return true;
	}

	public function hapus_persetujuan($id_risk)
	{
		$this->db->where('id_risk', $id_risk);
		$this->db->delete('tb_risk'); 
		return true;
	}

	public function batal_tambah($id_risk)
	{
		$this->db->where('id_risk', $id_risk);
		$this->db->delete('tb_risk'); 
		return true;
	}

	public function batal_edit($id_risk,$edit_user,$null)
	{
		$data = array('edit_user'=>$edit_user, 'risk_issue_edit'=>$null);
		$this->db->where_in('id_risk',$id_risk);
        $this->db->update('tb_risk', $data);
        return true;
	}

	public function batal_hapus($id_risk,$hapus_user)
	{
		$data = array('hapus_user'=>$hapus_user);
		$this->db->where_in('id_risk',$id_risk);
        $this->db->update('tb_risk', $data);
        return true;
	}

	/*============== MENU EKSPORT EXCEL ===================*/
	public function export_excel($format_tgl_awal, $format_tgl_akhir)
	{
		$sql  	  = "SELECT * FROM insidenreport
					WHERE DATE(time_start) BETWEEN '$format_tgl_awal' AND '$format_tgl_akhir'";
		$results  = $this->db->query($sql);
		return $results->result_array();
	}
} 