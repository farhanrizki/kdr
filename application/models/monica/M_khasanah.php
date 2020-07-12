<?php 
  
class M_khasanah extends CI_Model
{	
    public function __construct()
    {
        parent::__construct();
    }

    /*============== MENU COMPLIANCE -> KHASANAH INTERNAL ===================*/
    public function data_khasanah_internal()
    {
        $query = $this->db->query("SELECT * FROM compliance WHERE tipe='I'");
        return $query->result_array();
    }

    public function download_khasanah_internal($params = array())
    {
        $this->db->select('*');
        $this->db->from('compliance');
        $this->db->where('id_compliance',$params['id_compliance']);
        $query  = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        return $result;
    }

    public function lihat_internal($id_compliance)
    {
        $sql = "SELECT * FROM compliance WHERE id_compliance='$id_compliance' AND tipe='I'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function detail_khasanah_internal($id_compliance)
    {
        $query = $this->db->query("SELECT * FROM compliance WHERE id_compliance='$id_compliance'");
        return $query->result();
    }

    public function tambah_khasanah_internal($nomor_doc,$judul,$deskripsi,$request_oleh,$catatan_khusus,$file_upload,$tipe,
    $dibuat_oleh,$dibuat_tanggal,$diedit_oleh,$diedit_tanggal)
    {
        $data = array(
            'nomor_doc'      => $nomor_doc,
            'judul'          => $judul,
            'deskripsi'      => $deskripsi,
            'request_oleh'   => $request_oleh,
            'catatan_khusus' => $catatan_khusus,
            'file'           => $file_upload,
            'tipe'           => $tipe,
            'dibuat_oleh'    => $dibuat_oleh,
            'dibuat_tanggal' => $dibuat_tanggal,
            'diedit_oleh'    => $diedit_oleh,
            'diedit_tanggal' => $diedit_tanggal
        );

        $this->db->insert('compliance',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_khasanah_internal($id_compliance,$nomor_doc,$judul,$deskripsi,$request_oleh,$catatan_khusus,
        $file_upload,$diedit_oleh,$diedit_tanggal)
    {
        $data=array(
                        'nomor_doc'      => $nomor_doc,
                        'judul'          => $judul,
                        'deskripsi'      => $deskripsi,
                        'request_oleh'   => $request_oleh,
                        'catatan_khusus' => $catatan_khusus,
                        'file'           => $file_upload,
                        'diedit_oleh'    => $diedit_oleh,
                        'diedit_tanggal' => $diedit_tanggal
                    );
        $this->db->where('id_compliance', $id_compliance);
        $this->db->update('compliance', $data);
        return true;
    }

    public function hapus_khasanah_internal($id_compliance)
    {
        $this->db->where('id_compliance', $id_compliance);
        $this->db->delete('compliance'); 
        return true;
    }


    /*============== MENU COMPLIANCE -> KHASANAH EKSTERNAL ===================*/
    public function data_khasanah_eksternal()
    {
        $query = $this->db->query("SELECT * FROM compliance WHERE tipe='E'");
        return $query->result_array();
    }

    public function download_khasanah_eksternal($params = array())
    {
        $this->db->select('*');
        $this->db->from('compliance');
        $this->db->where('id_compliance',$params['id_compliance']);
        $query  = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        return $result;
    }

    public function lihat_eksternal($id_compliance)
    {
        $sql = "SELECT * FROM compliance WHERE id_compliance='$id_compliance' AND tipe='E'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function detail_khasanah_eksternal($id_compliance)
    {
        $query = $this->db->query("SELECT * FROM compliance WHERE id_compliance='$id_compliance'");
        return $query->result();
    }

    public function tambah_khasanah_eksternal($nomor_doc,$judul,$deskripsi,$request_oleh,$catatan_khusus,$file_upload,$tipe,
    $dibuat_oleh,$dibuat_tanggal,$diedit_oleh,$diedit_tanggal)
    {
        $data = array(
            'nomor_doc'      => $nomor_doc,
            'judul'          => $judul,
            'deskripsi'      => $deskripsi,
            'request_oleh'   => $request_oleh,
            'catatan_khusus' => $catatan_khusus,
            'file'           => $file_upload,
            'tipe'           => $tipe,
            'dibuat_oleh'    => $dibuat_oleh,
            'dibuat_tanggal' => $dibuat_tanggal,
            'diedit_oleh'    => $diedit_oleh,
            'diedit_tanggal' => $diedit_tanggal
        );

        $this->db->insert('compliance',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_khasanah_eksternal($id_compliance,$nomor_doc,$judul,$deskripsi,$request_oleh,$catatan_khusus,
        $file_upload,$diedit_oleh,$diedit_tanggal)
    {
        $data=array(
                        'nomor_doc'      => $nomor_doc,
                        'judul'          => $judul,
                        'deskripsi'      => $deskripsi,
                        'request_oleh'   => $request_oleh,
                        'catatan_khusus' => $catatan_khusus,
                        'file'           => $file_upload,
                        'diedit_oleh'    => $diedit_oleh,
                        'diedit_tanggal' => $diedit_tanggal
                    );
        $this->db->where('id_compliance', $id_compliance);
        $this->db->update('compliance', $data);
        return true;
    }

    public function hapus_khasanah_eksternal($id_compliance)
    {
        $this->db->where('id_compliance', $id_compliance);
        $this->db->delete('compliance'); 
        return true;
    }

    //get last no doc
    public function doc_int_input($nomor_doc)
    {
        $sql   = "SELECT MAX(RIGHT(nomor_doc,4)) AS nomor_terakhir, 
                    CASE 
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='1' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, 000)
                        
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='2' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, 00)
                        
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='3' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, 0)
                        
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='4' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, '')
                    ELSE NULL
                END AS nomor_selanjutnya
                FROM compliance
                WHERE LEFT(nomor_doc,12) LIKE '$nomor_doc%' AND tipe='I'";
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0)
        {
            $row_set = ""; 
            foreach($query->result_array() as $row) 
            {
                if (empty($row['nomor_terakhir']))
                {
                    return "0001";
                }
                else 
                {
                    $row_set[] = $row['nomor_selanjutnya'];
                    return $row_set;
                }
            }
        }
        else
        {
            return false;
        }
    }

    public function doc_int_edit($nomor_doc,$nodoc_terakhir,$angka_terakhir)
    {
        $sql   = "SELECT MAX(LEFT(nomor_doc,6)) AS nomor_dokumen, MAX(RIGHT(nomor_doc,4)) AS nomor_terakhir, 
                    CASE 
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='1' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, 000)
                        
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='2' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, 00)
                        
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='3' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, 0)
                        
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='4' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, '')
                    ELSE NULL
                END AS nomor_selanjutnya
                FROM compliance
                WHERE LEFT(nomor_doc,12) LIKE '$nomor_doc%' AND tipe='I'";
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0)
        {
            $row_set = ""; 
            foreach($query->result_array() as $row) 
            {
                if (empty($row['nomor_terakhir']))
                {
                    return "0001";
                }
                else 
                {
                    if(strpos($nodoc_terakhir, $row['nomor_dokumen']) !== false) 
                    {
                        return $angka_terakhir;
                    }
                    else
                    {
                         $row_set[] = $row['nomor_selanjutnya'];
                        return $row_set; 
                    }  
                }
            }
        }
        else
        {
            return false;
        }
    }

    public function doc_ext_input($nomor_doc)
    {
        $sql   = "SELECT MAX(RIGHT(nomor_doc,4)) AS nomor_terakhir, 
                    CASE 
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='1' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, 000)
                        
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='2' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, 00)
                        
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='3' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, 0)
                        
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='4' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, '')
                    ELSE NULL
                END AS nomor_selanjutnya
                FROM compliance
                WHERE LEFT(nomor_doc,12) LIKE '$nomor_doc%' AND tipe='E'";
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0)
        {
            $row_set = ""; 
            foreach($query->result_array() as $row) 
            {
                if (empty($row['nomor_terakhir']))
                {
                    return "0001";
                }
                else 
                {
                    $row_set[] = $row['nomor_selanjutnya'];
                    return $row_set;
                }
            }
        }
        else
        {
            return false;
        }
    }

    public function doc_ext_edit($nomor_doc,$nodoc_terakhir,$angka_terakhir)
    {
        $sql   = "SELECT MAX(LEFT(nomor_doc,6)) AS nomor_dokumen, MAX(RIGHT(nomor_doc,4)) AS nomor_terakhir, 
                    CASE 
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='1' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, 000)
                        
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='2' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, 00)
                        
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='3' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, 0)
                        
                        WHEN LENGTH(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1)='4' 
                        THEN LPAD(CONVERT(MAX(RIGHT(nomor_doc,4)), SIGNED INTEGER)+1, 4, '')
                    ELSE NULL
                END AS nomor_selanjutnya
                FROM compliance
                WHERE LEFT(nomor_doc,12) LIKE '$nomor_doc%' AND tipe='E'";
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0)
        {
            $row_set = ""; 
            foreach($query->result_array() as $row) 
            {
                if (empty($row['nomor_terakhir']))
                {
                    return "0001";
                }
                else 
                {
                    if(strpos($nodoc_terakhir, $row['nomor_dokumen']) !== false) 
                    {
                        return $angka_terakhir;
                    }
                    else
                    {
                         $row_set[] = $row['nomor_selanjutnya'];
                        return $row_set; 
                    }  
                }
            }
        }
        else
        {
            return false;
        }
    }
}