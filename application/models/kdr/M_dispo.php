<?php 
  
class M_dispo extends CI_Model
{	
	public function __construct()
    {
        parent::__construct();
    }

    public function get_pic($id_user)
    {
        $sql = "SELECT id_pic FROM dispodio WHERE FIND_IN_SET('$id_user',id_pic)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_dispo($user_pic,$tgl_awal,$tgl_akhir)
    {
        if($user_pic == "") 
        {
            if($tgl_awal == "")
            {
                $filter = "LEFT JOIN tb_user us ON di.id_pic = us.id_user 
                LEFT JOIN notifikasi notif ON CONCAT('D-', di.id_dispodio) = notif.id_tambahan";
            }
            else
            {
                $filter = "LEFT JOIN tb_user us ON di.id_pic = us.id_user 
                LEFT JOIN notifikasi notif ON CONCAT('D-', di.id_dispodio) = notif.id_tambahan
                WHERE DATE(di.tgl_dispo) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
            }
            
        }
        else
        {
            if($tgl_awal == "")
            {
                $filter = "LEFT JOIN tb_user us ON di.id_pic = us.id_user
                LEFT JOIN notifikasi notif ON CONCAT('D-', di.id_dispodio) = notif.id_tambahan
                WHERE FIND_IN_SET('$user_pic',di.id_pic)";
            }
            else
            {
                $filter = "LEFT JOIN tb_user us ON di.id_pic = us.id_user
                LEFT JOIN notifikasi notif ON CONCAT('D-', di.id_dispodio) = notif.id_tambahan
                WHERE FIND_IN_SET('$user_pic',di.id_pic) AND DATE(di.tgl_dispo) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
            }
        }
        $sql = "SELECT *, notif.id_user AS user_id_notif FROM dispodio di $filter 
                GROUP BY di.id_dispodio ORDER BY di.id_dispodio DESC";
        //var_dump($sql); die();
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function notif_dispo($user_pic)
    {
        if($user_pic == "") 
        {
            $filter = "";
        }
        else
        {
            $filter = "LEFT JOIN tb_user us ON notif.id_user = us.id_user WHERE FIND_IN_SET('$user_pic',notif.id_user) 
                       AND (notif.status IS NULL OR NOT FIND_IN_SET('$user_pic',notif.status))";
        }
        $sql = "SELECT count(*) AS hitung FROM notifikasi notif $filter";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_status($id_dispo)
    {
        $sql = "SELECT status FROM notifikasi WHERE id_tambahan='$id_dispo'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function update_notif($id_tambahan,$status)
    {
        $data = array('status' => $status);
        $this->db->where('id_tambahan', $id_tambahan);
        $this->db->update('notifikasi', $data);
        return true;
    }

    public function get_user($user)
    {
        $query = $this->db
                      ->select('username')
                      ->like('username',$user)
                      ->where_in('level', array('adminkdr','staffkdr','kabagkdr'))
                      ->get('tb_user');

        if($query->num_rows() > 0)
        {
            $row_set = ""; 
            foreach($query->result_array() as $row) 
            {
                $row_set[] = htmlentities(stripslashes($row['username']));
            }
            return $row_set;
        }
        else
        {
            return false;
        }
    }

    public function get_id_user($pic)
    {
        $sql = "SELECT id_user FROM tb_user WHERE username IN ($pic)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function simpan_dispo($id_pic,$no_surat,$agenda,$keterangan,$pic,$kategori,$sub_kategori,$due_date,$tgl_dispo)
    {
        $data = array(
            'id_pic'          => $id_pic,
            'no_surat'        => $no_surat,
            'agenda'          => $agenda,
            'keterangan'      => $keterangan,
            'pic'             => $pic,
            'kategori'        => $kategori,
            'sub_kategori'    => $sub_kategori,
            'due_date'        => $due_date,
            'tgl_dispo'       => $tgl_dispo
        );

        $this->db->insert('dispodio',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_dispo($id_dispodio,$id_pic,$no_surat,$agenda,$keterangan,$pic,$kategori,$sub_kategori,$due_date)
    {
        $data = array(
                    'id_pic'       => $id_pic,
                    'no_surat'     => $no_surat,
                    'agenda'       => $agenda,
                    'keterangan'   => $keterangan,
                    'pic'          => $pic,
                    'kategori'     => $kategori,
                    'sub_kategori' => $sub_kategori,
                    'due_date'     => $due_date
                );
        $this->db->where('id_dispodio', $id_dispodio);
        $this->db->update('dispodio', $data);
        return true;
    }

    public function update_notif2($id,$id_user,$keterangan)
    {
        $data = array('keterangan' => $keterangan, 'id_user' => $id_user);
        $this->db->where('id_tambahan', $id);
        $this->db->update('notifikasi', $data);
        return true;
    }

    public function update_tl($id_dispodio,$keterangan_tl,$tgl_tl)
    {
        $data = array(
                        'keterangan_tl' => $keterangan_tl,
                        'tgl_tl'        => $tgl_tl
                    );
        $this->db->where('id_dispodio', $id_dispodio);
        $this->db->update('dispodio', $data);
        return true;
    }

    public function update_done($id_dispodio,$keterangan_done,$tgl_done)
    {
        $data = array(
                        'keterangan_done' => $keterangan_done,
                        'tgl_done'        => $tgl_done
                    );
        $this->db->where('id_dispodio', $id_dispodio);
        $this->db->update('dispodio', $data);
        return true;
    }

    public function update_keterangan($id_dispodio,$keterangan_tl,$keterangan_done)
    {
        $data = array(
                        'keterangan_tl'   => $keterangan_tl,
                        'keterangan_done' => $keterangan_done
                    );
        $this->db->where('id_dispodio', $id_dispodio);
        $this->db->update('dispodio', $data);
        return true;
    }

    public function hapus_dispo($id_dispodio)
    {
        $this->db->where('id_dispodio', $id_dispodio);
        $this->db->delete('dispodio'); 
        return true;
    }

    public function hapus_notif($id_tambahan)
    {
        $this->db->where('id_tambahan', $id_tambahan);
        $this->db->delete('notifikasi'); 
        return true;
    }

    public function lihat_dispo($id_dispodio)
    {
        $sql = "SELECT * FROM dispodio WHERE id_dispodio='$id_dispodio'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function simpan_notif($id_user,$tgl_dispo,$keterangan)
    {
        $query_detail = "INSERT INTO notifikasi (id_user, id_tambahan, tgl_dispo, keterangan, status)
                        VALUES ('$id_user', CONCAT('D-', (SELECT MAX(id_dispodio) FROM dispodio)), '$tgl_dispo', '$keterangan', NULL)";

        $simpan_detail = $this->db->query($query_detail);
    }

    /*public function get()
    {
        $sql = "SELECT username FROM tb_user";
        $query = $this->db->query($sql);
        return $query->result_array();
    }*/
}

?>