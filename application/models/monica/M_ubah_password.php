<?php 
  
class M_ubah_password extends CI_Model
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

}