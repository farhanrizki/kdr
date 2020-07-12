<?php 
  
class M_kdr extends CI_Model
{	
	public function __construct()
    {
        parent::__construct();
    }

    /*============== MENU PATCHING -> RESUME ===================*/
    public function get_count_rekap_by_jenis($jenis,$tanggal_awal,$tanggal_akhir)
    {
        if($tanggal_awal == 0) 
        {
            $tanggal = "AND YEAR(pa.tgl_patching) = YEAR(CURDATE())";
        }
        else
        {
            $tanggal = "AND pa.tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        }

        $sql = "SELECT COUNT(*) AS hitung FROM patching pa LEFT JOIN kode_patching kd ON pa.jenis = 
                kd.id_jenis_patching WHERE kd.jenis = '$jenis' $tanggal";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function get_sla_per_bulan_system($bulan,$tanggal_awal,$tahun)
    {
        if($tanggal_awal == 0) 
        {
            $tahun_filter = "AND YEAR(tgl_patching) = YEAR(CURDATE())";
        }
        else
        {
            $tahun_filter = "AND YEAR(tgl_patching) = '$tahun'";
        }

        $sql = "SELECT tgl_permohonan, tgl_patching, justifikasi FROM patching 
                WHERE MONTH(tgl_patching) = '$bulan' $tahun_filter";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function sla_per_bulan_tahun_sebelum($bulan,$tanggal_awal,$tahun)
    {
        if($tanggal_awal == 0) 
        {
            $tahun_filter = "AND YEAR(tgl_patching) = YEAR(CURDATE())-1";
        }
        else
        {
            $tahun_filter = "AND YEAR(tgl_patching) = '$tahun'";
        }

        $sql = "SELECT tgl_permohonan, tgl_patching, justifikasi FROM patching 
                WHERE MONTH(tgl_patching) = '$bulan' $tahun_filter";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_total_patching($tanggal_awal,$tanggal_akhir)
    {
        if($tanggal_awal == 0) 
        {
            $tanggal = "WHERE YEAR(pa.tgl_patching) = YEAR(CURDATE())";
        }
        else
        {
            $tanggal = "WHERE pa.tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        }

        $sql = "SELECT COUNT(*) AS hitung_patching FROM patching pa LEFT JOIN kode_patching kd 
                ON pa.jenis = kd.id_jenis_patching $tanggal";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function detail_resume($jenis_patching,$tanggal_awal,$tanggal_akhir)
    {
        if($tanggal_awal == 0) 
        {
            $tanggal = "AND YEAR(pa.tgl_patching) = YEAR(CURDATE())";
        }
        else
        {
            $tanggal = "AND pa.tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        }

        $sql = "SELECT * FROM patching pa LEFT JOIN kode_patching kd ON pa.jenis=kd.id_jenis_patching
                WHERE kd.jenis='$jenis_patching' $tanggal ORDER BY pa.tgl_patching DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function summary_resume($jenis_patching,$tanggal_awal,$tanggal_akhir)
    {
        if($tanggal_awal == 0) 
        {
            $tanggal = "AND YEAR(pa.tgl_patching) = YEAR(CURDATE())";
        }
        else
        {
            $tanggal = "AND pa.tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        }

        $sql = "SELECT kd.nama, COUNT(*) AS hitung_summary FROM patching pa LEFT JOIN kode_patching kd 
                ON pa.jenis=kd.id_jenis_patching WHERE kd.jenis='$jenis_patching' $tanggal GROUP BY pa.jenis";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function resume_bulan($tahun_filter,$bulan)
    {
        $sql = "SELECT * FROM patching pa LEFT JOIN kode_patching kd ON pa.jenis=kd.id_jenis_patching
                WHERE MONTH(pa.tgl_patching)='$bulan' AND YEAR(pa.tgl_patching)='$tahun_filter' 
                ORDER BY pa.tgl_patching DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function summary_bulan($tahun_filter,$bulan)
    {
        $sql = "SELECT kd.nama, COUNT(*) AS hitung_summary FROM patching pa LEFT JOIN kode_patching kd 
                ON pa.jenis=kd.id_jenis_patching WHERE MONTH(pa.tgl_patching)='$bulan' 
                AND YEAR(pa.tgl_patching)='$tahun_filter' GROUP BY pa.jenis";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_tanggal_sla($tanggal_awal,$tanggal_akhir)
    {
        if($tanggal_awal == 0) 
        {
            $tanggal = "WHERE YEAR(tgl_patching) = YEAR(CURDATE())";
        }
        else
        {
            $tanggal = "WHERE tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        }

        $sql = "SELECT tgl_permohonan, tgl_patching, justifikasi FROM patching $tanggal";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function download_resume($tanggal_awal,$tanggal_akhir)
    {
        if($tanggal_awal == 0) 
        {
            $tanggal = "WHERE YEAR(pa.tgl_patching) = YEAR(CURDATE())";
        }
        else
        {
            $tanggal = "WHERE pa.tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        }

        $sql = "SELECT * FROM patching pa LEFT JOIN kode_patching kd ON pa.jenis=kd.id_jenis_patching
                $tanggal ORDER BY pa.tgl_patching DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function upload_patching($tgl_permohonan,$tgl_patching,$judul_patching,$no_tiket,$id_patching2,
        $divisi,$status,$maker,$uker,$jenis)
    {
        $data = array(
            'tgl_permohonan' => $tgl_permohonan,
            'tgl_patching'   => $tgl_patching,
            'judul_patching' => $judul_patching,
            'no_tiket'       => $no_tiket,
            'id_patching2'   => $id_patching2,
            'divisi'         => $divisi,
            'status'         => $status,
            'maker'          => $maker,
            'uker'           => $uker,
            'jenis'          => $jenis
        );

        $this->db->insert('patching',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function tanggal_libur()
    {
        $sql = "SELECT tgl_libur FROM tanggal_libur";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    /*============== MENU PATCHING -> DIVISI ===================*/
    public function patching_divisi($tanggal_awal,$tanggal_akhir)
    {
        if($tanggal_awal == 0) 
        {
            $tanggal = "WHERE YEAR(pa.tgl_patching) = YEAR(CURDATE())";
        }
        else
        {
            $tanggal = "WHERE pa.tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        }

        $sql = "SELECT divisi, COUNT(*) AS hitung_divisi FROM patching pa $tanggal GROUP BY pa.divisi";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function detail_divisi($tanggal_awal,$tanggal_akhir,$nama_divisi)
    {
        if($tanggal_awal == 0) 
        {
            $tanggal = "AND YEAR(pa.tgl_patching) = YEAR(CURDATE())";
        }
        else
        {
            $tanggal = "AND pa.tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        }

        $sql = "SELECT * FROM patching pa LEFT JOIN kode_patching kd ON pa.jenis=kd.id_jenis_patching 
               WHERE divisi = '$nama_divisi' $tanggal";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    /*============== MENU PATCHING -> PERSONAL ===================*/
    public function patching_personal($tanggal_awal,$tanggal_akhir)
    {
        if($tanggal_awal == 0) 
        {
            $tanggal = "WHERE YEAR(pa.tgl_patching) = YEAR(CURDATE())";
        }
        else
        {
            $tanggal = "WHERE pa.tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        }

        $sql = "SELECT maker, COUNT(*) AS hitung_maker FROM patching pa $tanggal GROUP BY pa.maker";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function detail_personal($tanggal_awal,$tanggal_akhir,$nama_personal)
    {
        if($tanggal_awal == 0) 
        {
            $tanggal = "AND YEAR(pa.tgl_patching) = YEAR(CURDATE())";
        }
        else
        {
            $tanggal = "AND pa.tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        }

        $sql = "SELECT * FROM patching pa LEFT JOIN kode_patching kd ON pa.jenis=kd.id_jenis_patching 
               WHERE maker = '$nama_personal' $tanggal";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function sla_personal($tanggal_awal,$tanggal_akhir,$maker)
    {
        if($tanggal_awal == 0) 
        {
            $tanggal = "AND YEAR(tgl_patching) = YEAR(CURDATE())";
        }
        else
        {
            $tanggal = "AND tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        }

        $sql = "SELECT tgl_permohonan, tgl_patching, maker, justifikasi FROM patching WHERE maker IN ('$maker') $tanggal";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function update_justifikasi($id_patching,$keterangan,$justifikasi)
    {
        $data = array('keterangan' => $keterangan, 'justifikasi' => $justifikasi);
        $this->db->where('id_patching', $id_patching);
        $this->db->update('patching', $data);
        return true;
    }

    public function batal_justifikasi($id_patching,$keterangan,$justifikasi)
    {
        $data = array(
                        'keterangan'  => $keterangan,
                        'justifikasi' => $justifikasi
                    );
        $this->db->where('id_patching', $id_patching);
        $this->db->update('patching', $data);
        return true;
    }

    /*============== MENU PATCHING -> UKER ===================*/
    public function get_uker()
    {
        $sql = "SELECT uker FROM patching GROUP BY uker";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function patching_uker($tanggal_awal,$tanggal_akhir,$uker)
    {
        if($tanggal_awal == 0 && $uker == "semua") 
        {
            $filter = "WHERE YEAR(pa.tgl_patching) = YEAR(CURDATE())";
        }
        else if($tanggal_awal == 0 && $uker != "semua")
        {
            $filter = "WHERE pa.uker ='$uker' AND YEAR(pa.tgl_patching) = YEAR(CURDATE())";
        }
        else if($tanggal_awal != 0 && $uker == "semua")
        {
            $filter = "WHERE pa.tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        }
        else 
        {
            $filter = "WHERE pa.tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND pa.uker ='$uker'";
        }
        $sql = "SELECT pa.uker, COUNT(*) AS hitung_uker FROM patching pa $filter GROUP BY pa.uker"; 
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function download_uker($tanggal_awal,$tanggal_akhir,$uker)
    {
        if($tanggal_awal == 0 && $uker == "semua") 
        {
            $filter = "WHERE YEAR(pa.tgl_patching) = YEAR(CURDATE())";
        }
        else if($tanggal_awal == 0 && $uker != "semua")
        {
            $filter = "WHERE pa.uker ='$uker' AND YEAR(pa.tgl_patching) = YEAR(CURDATE())";
        }
        else if($tanggal_awal != 0 && $uker == "semua")
        {
            $filter = "WHERE pa.tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        }
        else 
        {
            $filter = "WHERE pa.tgl_patching BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND pa.uker ='$uker'";
        }
        $sql = "SELECT kd.nama, COUNT(kd.nama) AS jumlah_patching FROM patching pa JOIN kode_patching kd ON 
                pa.jenis = kd.id_jenis_patching $filter GROUP BY kd.nama"; 
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    /*============== MENU REPORT -> KDR ===================*/
    public function report_kdr(){
        $this->db->select('*');
        $this->db->from('report_kdr');
        $result = $this->db->get();
        return $result->result_array();
    } 


    /*============== MENU REPORT -> OPT ===================*/
    public function report_opt(){
        $this->db->select('*');
        $this->db->from('data_rabid');
        $result = $this->db->get();
        return $result->result_array();
    } 
    

    /*============== MENU MANAJEMEN KHUSUS ===================*/
    public function manajemen_khusus()
    {
        $this->db->select('*');    
        $this->db->from('tb_user');
        $this->db->where_in('level', array('superadmin','adminkdr'));
        $this->db->where('status', 1);
        $this->db->where('untuk_web', 'semua');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_user_khusus($id_user,$nama_lengkap,$password_baru,$password_encrypt)
    {
        if($password_baru == null)
        {
            $data=array(
                            'id_user'      => $id_user,
                            'nama_lengkap' => $nama_lengkap
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
                            'password'     => $password_encrypt
                        );
            $this->db->where('id_user', $id_user);
            $this->db->update('tb_user', $data);
            return true;
        }
    }


    /*============== MENU MANAJEMEN USER KDR ===================*/
    public function user_kdr_aktif()
    {
    	$this->db->select('*');    
		$this->db->from('tb_user');
		$this->db->where_in('level', array('kabagkdr','staffkdr','nonadmin'));
        $this->db->where('status', 1);
		$this->db->where_in('untuk_web', array('semua','kdr'));
		$query = $this->db->get();
		return $query->result_array();
    }

    public function user_kdr_nonaktif()
    {
        $this->db->select('*');    
        $this->db->from('tb_user');
        $this->db->where_in('COALESCE(LEVEL,0)', array('kabagkdr','staffkdr','nonadmin',0));
        $this->db->where('status', 0);
        $this->db->where_in('untuk_web', array('semua','kdr'));
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

    public function tambah_user_kdr($nama_lengkap,$username,$password,$level,$status,$nama_bagian,$untuk_web)
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

    public function update_user_kdr_aktif($id_user,$nama_lengkap,$level,$status,$nama_bagian,$untuk_web,
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

    public function hapus_user_kdr_aktif($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user'); 
        return true;
    }

    public function update_user_kdr_nonaktif($id_user,$nama_lengkap,$level,$status,$nama_bagian,$untuk_web,
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

    public function hapus_user_kdr_nonaktif($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user'); 
        return true;
    }


    /*============== MENU MANAJEMEN USER RISK ===================*/
    public function user_risk_aktif()
    {
        $this->db->select('*');    
        $this->db->from('tb_user');
        $this->db->where_in('level', array('staffkdr','nonadmin'));
        $this->db->where('status', 1);
        $this->db->where_in('untuk_web', array('semua','risk'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function user_risk_nonaktif()
    {
        $this->db->select('*');    
        $this->db->from('tb_user');
        $this->db->where_in('COALESCE(LEVEL,0)', array('staffkdr','nonadmin',0));
        $this->db->where('status', 0);
        $this->db->where_in('untuk_web', array('semua','risk'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambah_user_risk($nama_lengkap,$username,$password,$level,$status,$nama_bagian,$untuk_web)
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

    public function update_user_risk_aktif($id_user,$nama_lengkap,$level,$status,$nama_bagian,$untuk_web,
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

    public function hapus_user_risk_aktif($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user'); 
        return true;
    }

    public function update_user_risk_nonaktif($id_user,$nama_lengkap,$level,$status,$nama_bagian,$untuk_web,
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

    public function hapus_user_risk_nonaktif($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user'); 
        return true;
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