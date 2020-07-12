<?php 
  
class M_surat_keluar extends CI_Model
{	
	public function __construct()
    {
        parent::__construct();
    }

    public function get_surat($user_pic,$tgl_awal,$tgl_akhir)
    {
    	if($user_pic == "") 
        {
            if($tgl_awal == "")
            {
                $filter = "LEFT JOIN tb_user us ON su.id_pic = us.id_user";
            }
            else
            {
                $filter = "LEFT JOIN tb_user us ON su.id_pic = us.id_user 
                WHERE DATE(su.tanggal) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
            }
        }
        else
        {
            if($tgl_awal == "")
            {
                $filter = "LEFT JOIN tb_user us ON su.id_pic = us.id_user
                WHERE FIND_IN_SET('$user_pic',su.id_pic)";
            }
            else
            {
                $filter = "LEFT JOIN tb_user us ON su.id_pic = us.id_user
                WHERE FIND_IN_SET('$user_pic',su.id_pic) AND DATE(su.tanggal) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
            }
        }
        $sql = "SELECT * FROM surat_keluar su $filter 
                GROUP BY su.id_surat_keluar ORDER BY su.id_surat_keluar DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_user($user)
    {
        $query = $this->db
                      ->select('username')
                      ->like('username',$user)
                      ->where_in('level', array('adminkdr','staffkdr'))
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

    public function simpan_surat($id_pic,$tanggal,$ke_divisi,$no_surat,$agenda,$pic,$kategori,$sub_kategori)
    {
        $data = array(
			'id_pic'       => $id_pic,
			'tanggal'      => $tanggal,
			'ke_divisi'    => $ke_divisi,
			'no_surat'     => $no_surat,
			'agenda'       => $agenda,
			'pic'          => $pic,
			'kategori'     => $kategori,
			'sub_kategori' => $sub_kategori
        );

        $this->db->insert('surat_keluar',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function lihat_surat($id_surat_keluar)
    {
        $sql = "SELECT * FROM surat_keluar WHERE id_surat_keluar='$id_surat_keluar'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function update_surat($id_surat_keluar,$id_pic,$no_surat,$agenda,$pic,$ke_divisi,$kategori,$sub_kategori)
    {
        $data = array(
                    'id_pic'       => $id_pic,
                    'no_surat'     => $no_surat,
                    'agenda'       => $agenda,
                    'pic'          => $pic,
                    'ke_divisi'    => $ke_divisi,
                    'kategori'     => $kategori,
                    'sub_kategori' => $sub_kategori
                );
        $this->db->where('id_surat_keluar', $id_surat_keluar);
        $this->db->update('surat_keluar', $data);
        return true;
    }

    public function hapus_surat($id_surat_keluar)
    {
        $this->db->where('id_surat_keluar', $id_surat_keluar);
        $this->db->delete('surat_keluar'); 
        return true;
    }
}