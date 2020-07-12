<?php 
  
class M_contact_us extends CI_Model
{	
    public function __construct()
    {
        parent::__construct();
    }

    /*============== MENU CONTACT US ===================*/
    public function data_contact_us()
    {
        $query = $this->db->query("SELECT * FROM contact_us");
        return $query->result_array();
    }

    public function tambah_contact_us($nama,$email,$pesan)
    {
        $data = array(
            'nama'  => $nama,
            'email' => $email,
            'pesan' => $pesan
        );

        $this->db->insert('contact_us',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function hapus_contact_us($id_contact_us)
    {
        $this->db->where('id_contact_us', $id_contact_us);
        $this->db->delete('contact_us'); 
        return true;
    }

}