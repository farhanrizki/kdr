<?php 
  
class M_login_risk extends CI_Model
{	
	public function __construct()
    {
        parent::__construct();
    }

	//fungsi cek session
    public function login_risk()
    {
        $level_risk = $this->session->userdata('level_risk');

        if($level_risk == "superadmin")
        {
            return $level_risk == "superadmin";
        }
        else if($level_risk == "adminkdr")
        {
            return $level_risk == "adminkdr";
        }
        else if($level_risk == "kabagkdr")
        {
            return $level_risk == "kabagkdr";
        }
        else if($level_risk == "staffkdr")
        {
            return $level_risk == "staffkdr";
        }
        else if($level_risk == "nonadmin")
        {
            return $level_risk == "nonadmin";
        }
        else
        {
            
        }
    }

    //fungsi check login
    public function check_login($username, $password)
    {
        $sql      = "SELECT * FROM tb_user WHERE username='$username' AND password='$password' AND status=1
                     AND untuk_web in ('semua','risk')";
        $query  = $this->db->query($sql);
        if($query->num_rows() == 0)
        {
            return FALSE;
        }
        else
        {
            return $query->result();
        }
    }

    public function check_username($username)
    {
        $this->db->select('*');    
        $this->db->from('tb_user');
        $this->db->where('username', $username);
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

    public function simpan_user_baru($nama_lengkap,$username,$password,$level,$status,$nama_bagian,$untuk_web)
    {
        $data = array(
            'nama_lengkap' => $nama_lengkap,
            'username'     => $username,
            'password'     => $password,
            'level'        => $level,
            'status'       => $status,
            'nama_bagian'  => $nama_bagian,
            'untuk_web'    => $untuk_web
        );

        $this->db->insert('tb_user',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}