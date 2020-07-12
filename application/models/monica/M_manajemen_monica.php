<?php 
  
class M_manajemen_monica extends CI_Model
{	
    public function __construct()
    {
        parent::__construct();
    }

    /*============== MENU MANAJEMEN USER MONICA ===================*/
    public function user_monica_aktif()
    {
        $this->db->select('*');    
        $this->db->from('tb_user');
        $this->db->where_in('level', array('staffkdr','nonadmin'));
        $this->db->where('status', 1);
        $this->db->where_in('untuk_web', array('semua','monica'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function user_monica_nonaktif()
    {
        $this->db->select('*');    
        $this->db->from('tb_user');
        $this->db->where_in('COALESCE(LEVEL,0)', array('staffkdr','nonadmin',0));
        $this->db->where('status', 0);
        $this->db->where_in('untuk_web', array('semua','monica'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function cek_user($username)
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

    public function tambah_user_monica($nama_lengkap,$username,$password,$level,$status,$nama_bagian,$untuk_web)
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

    public function update_user_monica_aktif($id_user,$nama_lengkap,$level,$status,$nama_bagian,$untuk_web,
        $password_baru,$password_encrypt)
    {
        if($password_baru == null)
        {
            $data=array(
                            'id_user'      => $id_user,
                            'nama_lengkap' => $nama_lengkap,
                            'level'        => $level,
                            'status'       => $status,
                            'nama_bagian'  => $nama_bagian,
                            'untuk_web'    => $untuk_web
                        );
            $this->db->where('id_user', $id_user);
            $this->db->update('tb_user', $data);
            return true;
        }
        else
        {
            $data=array(
                            'id_user'      => $id_user,
                            'nama_lengkap' => $nama_lengkap,
                            'level'        => $level,
                            'status'       => $status,
                            'nama_bagian'  => $nama_bagian,
                            'untuk_web'    => $untuk_web,
                            'password'     => $password_encrypt
                        );
            $this->db->where('id_user', $id_user);
            $this->db->update('tb_user', $data);
            return true;
        }
    }

    public function hapus_user_monica_aktif($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user'); 
        return true;
    }

    public function update_user_monica_nonaktif($id_user,$nama_lengkap,$level,$status,$nama_bagian,$untuk_web,
        $password_baru,$password_encrypt)
    {
        if($password_baru == null)
        {
            $data=array(
                            'id_user'      => $id_user,
                            'nama_lengkap' => $nama_lengkap,
                            'level'        => $level,
                            'status'       => $status,
                            'nama_bagian'  => $nama_bagian,
                            'untuk_web'    => $untuk_web
                        );
            $this->db->where('id_user', $id_user);
            $this->db->update('tb_user', $data);
            return true;
        }
        else
        {
            $data=array(
                            'id_user'      => $id_user,
                            'nama_lengkap' => $nama_lengkap,
                            'level'        => $level,
                            'status'       => $status,
                            'nama_bagian'  => $nama_bagian,
                            'untuk_web'    => $untuk_web,
                            'password'     => $password_encrypt
                        );
            $this->db->where('id_user', $id_user);
            $this->db->update('tb_user', $data);
            return true;
        }
    }

    public function hapus_user_monica_nonaktif($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user'); 
        return true;
    }

}