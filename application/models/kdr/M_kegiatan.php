<?php 
  
class M_kegiatan extends CI_Model
{	
	public function __construct()
    {
        parent::__construct();
    }

    public function get_kegiatan($tgl_awal,$tgl_akhir)
    {
        if($tgl_awal == "")
        {
            $filter = "";
        }
        else
        {
            $filter = "AND DATE(ke.tgl_pelaksanaan) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
        }
        $sql = "SELECT * FROM kegiatan ke LEFT JOIN tb_user us ON ke.id_pic = us.id_user 
                WHERE user_modified IN('1','0') $filter GROUP BY ke.id_kegiatan ORDER BY ke.id_kegiatan DESC";
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

    public function simpan_kegiatan($id_pic,$tgl_pelaksanaan,$start,$end,$title,$color,$tempat,$no_surat,$agenda,$pic,
        $kategori,$sub_kategori,$user_modified)
    {
        $data = array(
            'id_pic'          => $id_pic,
            'tgl_pelaksanaan' => $tgl_pelaksanaan,
            'start'           => $start,
            'end'             => $end,
            'title'           => $title,
            'color'           => $color,
            'tempat'          => $tempat,
            'no_surat'        => $no_surat,
            'agenda'          => $agenda,
            'pic'             => $pic,
            'kategori'        => $kategori,
            'sub_kategori'    => $sub_kategori,
            'user_modified'   => $user_modified
        );

        $this->db->insert('kegiatan',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function lihat_kegiatan($id_kegiatan)
    {
        $sql = "SELECT * FROM kegiatan WHERE id_kegiatan='$id_kegiatan'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function update_kegiatan($id_kegiatan,$id_pic,$tgl_pelaksanaan,$start,$end,$title,$color,$tempat,$no_surat,$agenda,$pic,
        $kategori,$sub_kategori)
    {
        $data = array(
                    'id_pic'          => $id_pic,
                    'tgl_pelaksanaan' => $tgl_pelaksanaan,
                    'start'           => $start,
                    'end'             => $end,
                    'title'           => $title,
                    'color'           => $color,
                    'tempat'          => $tempat,
                    'no_surat'        => $no_surat,
                    'agenda'          => $agenda,
                    'pic'             => $pic,
                    'kategori'        => $kategori,
                    'sub_kategori'    => $sub_kategori
                );
        $this->db->where('id_kegiatan', $id_kegiatan);
        $this->db->update('kegiatan', $data);
        return true;
    }

    public function hapus_kegiatan($id_kegiatan)
    {
        $this->db->where('id_kegiatan', $id_kegiatan);
        $this->db->delete('kegiatan'); 
        return true;
    }

    Public function kegiatanStaff($id_user)
    {
        $sql = "SELECT * FROM kegiatan WHERE FIND_IN_SET('$id_user',kegiatan.id_pic) AND kegiatan.start BETWEEN ? AND ? ORDER BY kegiatan.start ASC";
        return $this->db->query($sql, array($_GET['start'], $_GET['end']))->result();
    }

    Public function addKegiatan($color,$user_modified)
    {
        $sql = "INSERT INTO kegiatan (id_pic,tgl_pelaksanaan,kegiatan.start,kegiatan.end,title,color,tempat,no_surat,agenda,
                pic,kategori,sub_kategori,user_modified) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $this->db->query($sql, array($_POST['id_pic'],$_POST['tgl_pelaksanaan'],$_POST['start'],$_POST['end'],$_POST['title'],
                $color,$_POST['tempat'],$_POST['no_surat'],$_POST['agenda'],$_POST['pic'],$_POST['kategori'],
                $_POST['subkategori'],$user_modified));
        return ($this->db->affected_rows()!=1)?false:true;
    }

    Public function updateKegiatan($color)
    {
        $sql = "UPDATE kegiatan SET title = ?, color = ?, tempat = ?, no_surat = ?, agenda = ?, kategori = ?, 
                sub_kategori = ? WHERE id_kegiatan = ?";
        $this->db->query($sql, array($_POST['title'], $color, $_POST['tempat'], $_POST['no_surat'], $_POST['agenda'], 
                $_POST['kategori'], $_POST['subkategori'], $_POST['id']));
        return ($this->db->affected_rows()!=1)?false:true;
    }

    Public function hapusKegiatan()
    {
        $sql = "DELETE FROM kegiatan WHERE id_kegiatan = ?";
        $this->db->query($sql, array($_GET['id']));
        return ($this->db->affected_rows()!=1)?false:true;
    }

    /*Public function dragUpdateKegiatan()
    {
        $sql = "UPDATE kegiatan SET kegiatan.tgl_pelaksanaan = ?, kegiatan.start = ? ,kegiatan.end = ? WHERE id_kegiatan = ?";
        $this->db->query($sql, array($_POST['tgl_pelaksanaan'],$_POST['start'],$_POST['end'], $_POST['id']));
        return ($this->db->affected_rows()!=1)?false:true;
    }*/
}