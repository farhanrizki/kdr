<?php 
  
class M_kategori extends CI_Model
{	
	public function __construct()
    {
        parent::__construct();
    }

    public function data_kategori()
    {
        $query = $this->db->query("SELECT * FROM kategori_risk");
        return $query->result_array();
    }

    public function tambah_kategori($nama_kategori,$bobot_kategori)
    {
        $data = array(
            'nama_kategori'  => $nama_kategori,
            'bobot_kategori' => $bobot_kategori
        );

        $this->db->insert('kategori_risk',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    
    public function update_kategori($id_kategori_risk,$nama_kategori,$bobot_kategori)
    {
        $data=array(
                        'nama_kategori'  => $nama_kategori,
                        'bobot_kategori' => $bobot_kategori
                    );
        $this->db->where('id_kategori_risk', $id_kategori_risk);
        $this->db->update('kategori_risk', $data);
        return true;
    }

    public function hapus_kategori($id_kategori_risk)
    {
        $this->db->where('id_kategori_risk', $id_kategori_risk);
        $this->db->delete('kategori_risk'); 
        return true;
    }
}