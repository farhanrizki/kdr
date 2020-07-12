<?php 
  
class M_login_kdr extends CI_Model
{	
	public function __construct()
    {
        parent::__construct();
    }

	//fungsi cek session
    public function login_kdr()
    {
        $level_kdr = $this->session->userdata('level_kdr');

        if($level_kdr == "superadmin")
        {
            return $level_kdr == "superadmin";
        }
        else if($level_kdr == "adminkdr")
        {
            return $level_kdr == "adminkdr";
        }
        else if($level_kdr == "kabagkdr")
        {
            return $level_kdr == "kabagkdr";
        }
        else if($level_kdr == "staffkdr")
        {
            return $level_kdr == "staffkdr";
        }
        else if($level_kdr == "nonadmin")
        {
            return $level_kdr == "nonadmin";
        }
        else
        {
            
        }
    }

    //fungsi check login
    public function check_login($username, $password)
    {
        $sql    = "SELECT * FROM tb_user WHERE username='$username' AND password='$password' AND status=1
                   AND untuk_web in ('semua','kdr')";
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