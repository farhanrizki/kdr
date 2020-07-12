<?php 
  
class M_list_risk extends CI_Model
{	
	public function __construct()
    {
        parent::__construct();
    }

    public function data_list_risk()
    {
        $query = $this->db->query("SELECT * FROM list_risk risk 
                                   LEFT JOIN kategori_risk kate ON kate.id_kategori_risk = risk.id_kategori_risk");
        return $query->result_array();
    }

    public function data_kategori()
    {
        $query = $this->db->query("SELECT * FROM kategori_risk");
        return $query->result_array();
    }

    public function tambah_list_risk($id_kategori_risk,$nama_risk,$bobot_risk,$kontrol_skor,$user_modified,$date_modified)
    {
        $data = array(
            'id_kategori_risk' => $id_kategori_risk,
            'nama_risk'        => $nama_risk,
            'bobot_risk'       => $bobot_risk,
            'kontrol_skor'     => $kontrol_skor,
            'user_modified'    => $user_modified,
            'date_modified'    => $date_modified
        );

        $this->db->insert('list_risk',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_list_risk($id_list_risk,$id_kategori_risk,$nama_risk,$bobot_risk,$user_modified,$date_modified)
    {
        $data=array(
                        'id_kategori_risk' => $id_kategori_risk,
                        'nama_risk'        => $nama_risk,
                        'bobot_risk'       => $bobot_risk,
                        'user_modified'    => $user_modified,
                        'date_modified'    => $date_modified
                    );
        $this->db->where('id_list_risk', $id_list_risk);
        $this->db->update('list_risk', $data);
        return true;
    }

    public function hapus_list_risk($id_list_risk)
    {
        $this->db->where('id_list_risk', $id_list_risk);
        $this->db->delete('list_risk'); 
        return true;
    }
}