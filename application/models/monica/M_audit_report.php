<?php 
  
class M_audit_report extends CI_Model
{	
    public function __construct(){
        parent::__construct();
    }

    /*============== MENU AUDIT -> AUDIT REPORT ===================*/
    public function tahun_audit_report($nama_bagian){
        if($nama_bagian != "kdr"){
          $bagian = "AND d.nama = '$nama_bagian'";
        }else{
          $bagian = "";
        }
        $query = $this->db->query("SELECT a.tahun FROM audit_baru a LEFT JOIN divisi d ON d.id_divisi = a.id_divisi 
                                   WHERE a.tipe IN ('I','E') AND d.nama != 'OTHER' AND d.nama_divisi='app' $bagian GROUP BY a.tahun");
        return $query->result_array();
    }

    //AUDIT REPORT INTERNAL
    public function audit_report_internal($tahun,$nama_bagian){
        if($tahun != "semua"){
      		$tahun = "AND tahun = '$tahun'";
        }else{
      		$tahun = "";
        }
        if($nama_bagian != "kdr"){
          $bagian = "AND d.nama = '$nama_bagian'";
        }else{
          $bagian = "";
        }
        $query = $this->db->query("SELECT d.nama,
                CASE WHEN qry_major.count_major_task IS NULL THEN 0 ELSE qry_major.count_major_task END AS major,
                CASE WHEN qry_minor.count_minor_task IS NULL THEN 0 ELSE qry_minor.count_minor_task END AS minor,
                CASE WHEN qry_moderate.count_moderate_task IS NULL THEN 0 ELSE qry_moderate.count_moderate_task
                END AS moderate
                FROM divisi d
                LEFT JOIN
                (SELECT COUNT(*) AS count_major_task, id_divisi
                FROM audit_baru
                WHERE id_kategori = '1' $tahun
                GROUP BY id_divisi) AS qry_major ON qry_major.id_divisi = d.id_divisi
                LEFT JOIN
                (SELECT COUNT(*) AS count_minor_task, id_divisi
                FROM audit_baru
                WHERE id_kategori = '2' $tahun
                GROUP BY id_divisi) AS qry_minor ON qry_minor.id_divisi = d.id_divisi
                LEFT JOIN
                (SELECT COUNT(*) AS count_moderate_task, id_divisi
                FROM audit_baru
                WHERE id_kategori = '3' $tahun
                GROUP BY id_divisi) AS qry_moderate ON qry_moderate.id_divisi = d.id_divisi
                WHERE d.tipe = 'I' AND d.nama != 'OTHER' AND d.nama_divisi='app' $bagian");
        return $query->result_array();
    }

    public function get_row_internal(){
        $query = $this->db->query("SELECT (SELECT COUNT(*) FROM audit_baru) AS major_memadai, 
                                 (SELECT COUNT(*) FROM audit_baru) AS major_pemantauan, 
                                 (SELECT COUNT(*) FROM audit_baru) AS major_tidak_memadai, 
                                 (SELECT COUNT(*) FROM audit_baru) AS minor_memadai, 
                                 (SELECT COUNT(*) FROM audit_baru) AS minor_pemantauan, 
                                 (SELECT COUNT(*) FROM audit_baru) AS minor_tidak_memadai, 
                                 (SELECT COUNT(*) FROM audit_baru) AS moderate_memadai, 
                                 (SELECT COUNT(*) FROM audit_baru) AS moderate_pemantauan, 
                                 (SELECT COUNT(*) FROM audit_baru) AS moderate_tidak_memadai");
        return $query->result_array();
    }

    public function major_internal($nama,$tahun_filter){
    	  if($tahun_filter != "semua"){
         	$tahun = "AND a.tahun = '$tahun_filter'";
        }else{
        	$tahun = "";
        }
        $query = $this->db->query("SELECT a.id_audit, a.status_monitoring_1,a.status_monitoring_2,
          a.status_monitoring_3,a.status_monitoring_4,a.status_monitoring_5,a.status_monitoring_6,a.status_monitoring_7,
          a.status_monitoring_8,a.status_monitoring_9,a.status_monitoring_10,
          CASE WHEN (a.status_monitoring_1 = 'M') THEN
            CASE
            WHEN (a.status_monitoring_2 = 'M' AND a.status_monitoring_3 = 'M' AND a.status_monitoring_4 = 'M' 
              AND a.status_monitoring_5 = 'M' AND a.status_monitoring_6 = 'M' AND a.status_monitoring_7 = 'M' 
              AND a.status_monitoring_8 = 'M' AND a.status_monitoring_9 = 'M' AND a.status_monitoring_10 = 'M')
              THEN 1
            WHEN (a.status_monitoring_2 IN ('P','T') OR a.status_monitoring_3 IN ('P','T') 
              OR a.status_monitoring_4 IN ('P','T') OR a.status_monitoring_5 IN ('P','T') 
              OR a.status_monitoring_6 IN ('P','T') OR a.status_monitoring_7 IN ('P','T')
              OR a.status_monitoring_8 IN ('P','T') OR a.status_monitoring_9 IN ('P','T') 
              OR a.status_monitoring_10 IN ('P','T'))
              THEN 0
            WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
              AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
              AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
              THEN 1
            WHEN (a.status_monitoring_2 = 'M' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = ''
              OR a.status_monitoring_5 = '' OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' 
              OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' OR a.status_monitoring_10 = '')
              THEN 1
            ELSE 0   
            END
          END AS total_memadai_major,

          CASE WHEN (a.status_monitoring_1 = 'P') THEN
            CASE
              WHEN (a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T'
                OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
                OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T')
                THEN 0
              WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
                AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
                AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
                THEN 1
              WHEN (a.status_monitoring_2 = 'P' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = ''
                OR a.status_monitoring_5 = '' OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' 
                OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' OR a.status_monitoring_10 = '')
                THEN 1
              WHEN (a.status_monitoring_2 IN ('P','M') OR a.status_monitoring_3 IN ('P','M') 
                OR a.status_monitoring_4 IN ('P','M') OR a.status_monitoring_5 IN ('P','M') 
                OR a.status_monitoring_6 IN ('P','M') OR a.status_monitoring_7 IN ('P','M') 
                OR a.status_monitoring_8 IN ('P','M') OR a.status_monitoring_9 IN ('P','M') 
                OR a.status_monitoring_10 IN ('P','M'))
                THEN 1
              ELSE 0   
            END
          END AS total_pemantauan_major_1,
          CASE WHEN (a.status_monitoring_1 = 'M') THEN
            CASE
              WHEN a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T'
                OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
                OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T'
                THEN 0
              WHEN (a.status_monitoring_2 ='P' OR a.status_monitoring_3 ='P' OR a.status_monitoring_4 ='P' 
                OR a.status_monitoring_5 ='P' OR a.status_monitoring_6 ='P' OR a.status_monitoring_7 ='P' 
                OR a.status_monitoring_8 ='P' OR a.status_monitoring_9 ='P' OR a.status_monitoring_10 ='P')
                THEN 1
              ELSE 0   
            END 
          END AS total_pemantauan_major_2,

          CASE WHEN (a.status_monitoring_1 = 'T') THEN
            CASE
              WHEN (a.status_monitoring_2 IS NULL OR a.status_monitoring_2 IN ('T','P','M')
                AND a.status_monitoring_3 IS NULL OR a.status_monitoring_3 IN ('T','P','M')
                AND a.status_monitoring_4 IS NULL OR a.status_monitoring_4 IN ('T','P','M')
                AND a.status_monitoring_5 IS NULL OR a.status_monitoring_5 IN ('T','P','M')
                AND a.status_monitoring_6 IS NULL OR a.status_monitoring_6 IN ('T','P','M')
                AND a.status_monitoring_7 IS NULL OR a.status_monitoring_7 IN ('T','P','M')
                AND a.status_monitoring_8 IS NULL OR a.status_monitoring_8 IN ('T','P','M')
                AND a.status_monitoring_9 IS NULL OR a.status_monitoring_9 IN ('T','P','M')
                AND a.status_monitoring_10 IS NULL OR a.status_monitoring_10 IN ('T','P','M'))
                THEN 1
              ELSE 0   
            END 
          END AS total_tidak_memadai_major_1,
          CASE WHEN (a.status_monitoring_1 = 'M') THEN
            CASE
              WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' 
                OR a.status_monitoring_5 ='T' OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' 
                OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T' OR a.status_monitoring_10 ='T')
                THEN 1
              ELSE 0   
            END 
          END AS total_tidak_memadai_major_2,
          CASE WHEN (a.status_monitoring_1 = 'P') THEN
            CASE
              WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' 
                OR a.status_monitoring_5 ='T' OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' 
                OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T' OR a.status_monitoring_10 ='T')
                THEN 1
              ELSE 0   
            END 
          END AS total_tidak_memadai_major_3

          FROM audit_baru a
          INNER JOIN divisi d ON a.id_divisi = d.id_divisi
          INNER JOIN kategori k ON a.id_kategori = k.id_kategori
          WHERE a.tipe='I'
          AND (a.status_monitoring_1 IN ('M','T','P') OR a.status_monitoring_2 IN ('M','T','P')
            OR a.status_monitoring_3 IN ('M','T','P') OR a.status_monitoring_4 IN ('M','T','P')
            OR a.status_monitoring_5 IN ('M','T','P') OR a.status_monitoring_6 IN ('M','T','P')
            OR a.status_monitoring_7 IN ('M','T','P') OR a.status_monitoring_8 IN ('M','T','P')
            OR a.status_monitoring_9 IN ('M','T','P') OR a.status_monitoring_10 IN ('M','T','P')
          )
          AND d.nama = '$nama' $tahun AND k.id_kategori = 1 AND d.nama_divisi='app'");
        return $query->result_array();
    }

    public function minor_internal($nama,$tahun_filter){
      	if($tahun_filter != "semua"){
          $tahun = "AND a.tahun = '$tahun_filter'";
        }else{
          $tahun = "";
        }
        $query = $this->db->query("SELECT a.id_audit, a.status_monitoring_1,a.status_monitoring_2,
          a.status_monitoring_3,a.status_monitoring_4,a.status_monitoring_5,a.status_monitoring_6,a.status_monitoring_7,
          a.status_monitoring_8,a.status_monitoring_9,a.status_monitoring_10,
          CASE WHEN (a.status_monitoring_1 = 'M') THEN
            CASE
            WHEN (a.status_monitoring_2 = 'M' AND a.status_monitoring_3 = 'M' AND a.status_monitoring_4 = 'M' 
              AND a.status_monitoring_5 = 'M' AND a.status_monitoring_6 = 'M' AND a.status_monitoring_7 = 'M' 
              AND a.status_monitoring_8 = 'M' AND a.status_monitoring_9 = 'M' AND a.status_monitoring_10 = 'M')
              THEN 1
            WHEN (a.status_monitoring_2 IN ('P','T') OR a.status_monitoring_3 IN ('P','T') 
              OR a.status_monitoring_4 IN ('P','T') OR a.status_monitoring_5 IN ('P','T') 
              OR a.status_monitoring_6 IN ('P','T') OR a.status_monitoring_7 IN ('P','T')
              OR a.status_monitoring_8 IN ('P','T') OR a.status_monitoring_9 IN ('P','T') 
              OR a.status_monitoring_10 IN ('P','T'))
              THEN 0
            WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
              AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
              AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
              THEN 1
            WHEN (a.status_monitoring_2 = 'M' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = ''
              OR a.status_monitoring_5 = '' OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' 
              OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' OR a.status_monitoring_10 = '')
              THEN 1
            ELSE 0   
            END
          END AS total_memadai_minor,

          CASE WHEN (a.status_monitoring_1 = 'P') THEN
            CASE
              WHEN (a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T'
                OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
                OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T')
                THEN 0
              WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
                AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
                AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
                THEN 1
              WHEN (a.status_monitoring_2 = 'P' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = ''
                OR a.status_monitoring_5 = '' OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' 
                OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' OR a.status_monitoring_10 = '')
                THEN 1
              WHEN (a.status_monitoring_2 IN ('P','M') OR a.status_monitoring_3 IN ('P','M') 
                OR a.status_monitoring_4 IN ('P','M') OR a.status_monitoring_5 IN ('P','M') 
                OR a.status_monitoring_6 IN ('P','M') OR a.status_monitoring_7 IN ('P','M') 
                OR a.status_monitoring_8 IN ('P','M') OR a.status_monitoring_9 IN ('P','M') 
                OR a.status_monitoring_10 IN ('P','M'))
                THEN 1
              ELSE 0   
            END
          END AS total_pemantauan_minor_1,
          CASE WHEN (a.status_monitoring_1 = 'M') THEN
            CASE
              WHEN a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T'
                OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
                OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T'
                THEN 0
              WHEN (a.status_monitoring_2 ='P' OR a.status_monitoring_3 ='P' OR a.status_monitoring_4 ='P' 
                OR a.status_monitoring_5 ='P' OR a.status_monitoring_6 ='P' OR a.status_monitoring_7 ='P' 
                OR a.status_monitoring_8 ='P' OR a.status_monitoring_9 ='P' OR a.status_monitoring_10 ='P')
                THEN 1
              ELSE 0   
            END 
          END AS total_pemantauan_minor_2,

          CASE WHEN (a.status_monitoring_1 = 'T') THEN
            CASE
              WHEN (a.status_monitoring_2 IS NULL OR a.status_monitoring_2 IN ('T','P','M')
                AND a.status_monitoring_3 IS NULL OR a.status_monitoring_3 IN ('T','P','M')
                AND a.status_monitoring_4 IS NULL OR a.status_monitoring_4 IN ('T','P','M')
                AND a.status_monitoring_5 IS NULL OR a.status_monitoring_5 IN ('T','P','M')
                AND a.status_monitoring_6 IS NULL OR a.status_monitoring_6 IN ('T','P','M')
                AND a.status_monitoring_7 IS NULL OR a.status_monitoring_7 IN ('T','P','M')
                AND a.status_monitoring_8 IS NULL OR a.status_monitoring_8 IN ('T','P','M')
                AND a.status_monitoring_9 IS NULL OR a.status_monitoring_9 IN ('T','P','M')
                AND a.status_monitoring_10 IS NULL OR a.status_monitoring_10 IN ('T','P','M'))
                THEN 1
              ELSE 0   
            END 
          END AS total_tidak_memadai_minor_1,
          CASE WHEN (a.status_monitoring_1 = 'M') THEN
            CASE
              WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' 
                OR a.status_monitoring_5 ='T' OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' 
                OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T' OR a.status_monitoring_10 ='T')
                THEN 1
              ELSE 0   
            END 
          END AS total_tidak_memadai_minor_2,
          CASE WHEN (a.status_monitoring_1 = 'P') THEN
            CASE
              WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' 
                OR a.status_monitoring_5 ='T' OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' 
                OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T' OR a.status_monitoring_10 ='T')
                THEN 1
              ELSE 0   
            END 
          END AS total_tidak_memadai_minor_3

          FROM audit_baru a
          INNER JOIN divisi d ON a.id_divisi = d.id_divisi
          INNER JOIN kategori k ON a.id_kategori = k.id_kategori
          WHERE a.tipe='I'
          AND (a.status_monitoring_1 IN ('M','T','P') OR a.status_monitoring_2 IN ('M','T','P')
            OR a.status_monitoring_3 IN ('M','T','P') OR a.status_monitoring_4 IN ('M','T','P')
            OR a.status_monitoring_5 IN ('M','T','P') OR a.status_monitoring_6 IN ('M','T','P')
            OR a.status_monitoring_7 IN ('M','T','P') OR a.status_monitoring_8 IN ('M','T','P')
            OR a.status_monitoring_9 IN ('M','T','P') OR a.status_monitoring_10 IN ('M','T','P')
          )
          AND d.nama = '$nama' $tahun AND k.id_kategori = 2 AND d.nama_divisi='app'");
        return $query->result_array();
    }

    public function moderate_internal($nama,$tahun_filter){
      	if($tahun_filter != "semua"){
          $tahun = "AND a.tahun = '$tahun_filter'";
        }else{
          $tahun = "";
        }
        $query = $this->db->query("SELECT a.id_audit, a.status_monitoring_1,a.status_monitoring_2,
          a.status_monitoring_3,a.status_monitoring_4,a.status_monitoring_5,a.status_monitoring_6,a.status_monitoring_7,
          a.status_monitoring_8,a.status_monitoring_9,a.status_monitoring_10,
          CASE WHEN (a.status_monitoring_1 = 'M') THEN
            CASE
            WHEN (a.status_monitoring_2 = 'M' AND a.status_monitoring_3 = 'M' AND a.status_monitoring_4 = 'M' 
              AND a.status_monitoring_5 = 'M' AND a.status_monitoring_6 = 'M' AND a.status_monitoring_7 = 'M' 
              AND a.status_monitoring_8 = 'M' AND a.status_monitoring_9 = 'M' AND a.status_monitoring_10 = 'M')
              THEN 1
            WHEN (a.status_monitoring_2 IN ('P','T') OR a.status_monitoring_3 IN ('P','T') 
              OR a.status_monitoring_4 IN ('P','T') OR a.status_monitoring_5 IN ('P','T') 
              OR a.status_monitoring_6 IN ('P','T') OR a.status_monitoring_7 IN ('P','T')
              OR a.status_monitoring_8 IN ('P','T') OR a.status_monitoring_9 IN ('P','T') 
              OR a.status_monitoring_10 IN ('P','T'))
              THEN 0
            WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
              AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
              AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
              THEN 1
            WHEN (a.status_monitoring_2 = 'M' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = ''
              OR a.status_monitoring_5 = '' OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' 
              OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' OR a.status_monitoring_10 = '')
              THEN 1
            ELSE 0   
            END
          END AS total_memadai_moderate,

          CASE WHEN (a.status_monitoring_1 = 'P') THEN
            CASE
              WHEN (a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T'
                OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
                OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T')
                THEN 0
              WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
                AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
                AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
                THEN 1
              WHEN (a.status_monitoring_2 = 'P' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = ''
                OR a.status_monitoring_5 = '' OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' 
                OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' OR a.status_monitoring_10 = '')
                THEN 1
              WHEN (a.status_monitoring_2 IN ('P','M') OR a.status_monitoring_3 IN ('P','M') 
                OR a.status_monitoring_4 IN ('P','M') OR a.status_monitoring_5 IN ('P','M') 
                OR a.status_monitoring_6 IN ('P','M') OR a.status_monitoring_7 IN ('P','M') 
                OR a.status_monitoring_8 IN ('P','M') OR a.status_monitoring_9 IN ('P','M') 
                OR a.status_monitoring_10 IN ('P','M'))
                THEN 1
              ELSE 0   
            END
          END AS total_pemantauan_moderate_1,
          CASE WHEN (a.status_monitoring_1 = 'M') THEN
            CASE
              WHEN a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T'
                OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
                OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T'
                THEN 0
              WHEN (a.status_monitoring_2 ='P' OR a.status_monitoring_3 ='P' OR a.status_monitoring_4 ='P' 
                OR a.status_monitoring_5 ='P' OR a.status_monitoring_6 ='P' OR a.status_monitoring_7 ='P' 
                OR a.status_monitoring_8 ='P' OR a.status_monitoring_9 ='P' OR a.status_monitoring_10 ='P')
                THEN 1
              ELSE 0   
            END 
          END AS total_pemantauan_moderate_2,

          CASE WHEN (a.status_monitoring_1 = 'T') THEN
            CASE
              WHEN (a.status_monitoring_2 IS NULL OR a.status_monitoring_2 IN ('T','P','M')
                AND a.status_monitoring_3 IS NULL OR a.status_monitoring_3 IN ('T','P','M')
                AND a.status_monitoring_4 IS NULL OR a.status_monitoring_4 IN ('T','P','M')
                AND a.status_monitoring_5 IS NULL OR a.status_monitoring_5 IN ('T','P','M')
                AND a.status_monitoring_6 IS NULL OR a.status_monitoring_6 IN ('T','P','M')
                AND a.status_monitoring_7 IS NULL OR a.status_monitoring_7 IN ('T','P','M')
                AND a.status_monitoring_8 IS NULL OR a.status_monitoring_8 IN ('T','P','M')
                AND a.status_monitoring_9 IS NULL OR a.status_monitoring_9 IN ('T','P','M')
                AND a.status_monitoring_10 IS NULL OR a.status_monitoring_10 IN ('T','P','M'))
                THEN 1
              ELSE 0   
            END 
          END AS total_tidak_memadai_moderate_1,
          CASE WHEN (a.status_monitoring_1 = 'M') THEN
            CASE
              WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' 
                OR a.status_monitoring_5 ='T' OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' 
                OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T' OR a.status_monitoring_10 ='T')
                THEN 1
              ELSE 0   
            END 
          END AS total_tidak_memadai_moderate_2,
          CASE WHEN (a.status_monitoring_1 = 'P') THEN
            CASE
              WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' 
                OR a.status_monitoring_5 ='T' OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' 
                OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T' OR a.status_monitoring_10 ='T')
                THEN 1
              ELSE 0   
            END 
          END AS total_tidak_memadai_moderate_3

          FROM audit_baru a
          INNER JOIN divisi d ON a.id_divisi = d.id_divisi
          INNER JOIN kategori k ON a.id_kategori = k.id_kategori
          WHERE a.tipe='I'
          AND (a.status_monitoring_1 IN ('M','T','P') OR a.status_monitoring_2 IN ('M','T','P')
            OR a.status_monitoring_3 IN ('M','T','P') OR a.status_monitoring_4 IN ('M','T','P')
            OR a.status_monitoring_5 IN ('M','T','P') OR a.status_monitoring_6 IN ('M','T','P')
            OR a.status_monitoring_7 IN ('M','T','P') OR a.status_monitoring_8 IN ('M','T','P')
            OR a.status_monitoring_9 IN ('M','T','P') OR a.status_monitoring_10 IN ('M','T','P')
          )
          AND d.nama = '$nama' $tahun AND k.id_kategori = 3 AND d.nama_divisi='app'");
        return $query->result_array();
    }

    public function jumlah_monitoring_internal($tahun,$nama_bagian){
  		if($tahun != "semua") {
  			$tahun = "AND tahun = '$tahun'";
  		}else{
  			$tahun = "";
  		}

      if($nama_bagian != "kdr"){
        $bagian = "AND d.nama = '$nama_bagian'";
      }else{
        $bagian = "";
      }

  		$query = $this->db->query("SELECT a.id_audit, a.status_monitoring_1,a.status_monitoring_2,a.status_monitoring_3,a.status_monitoring_4,a.status_monitoring_5,
  			a.status_monitoring_6,a.status_monitoring_7,a.status_monitoring_8,a.status_monitoring_9,a.status_monitoring_10,
  			CASE WHEN (a.status_monitoring_1 = 'M') THEN
  			  CASE 
  			  WHEN (a.status_monitoring_2 = 'M' AND a.status_monitoring_3 = 'M' AND a.status_monitoring_4 = 'M'
  			    AND a.status_monitoring_5 = 'M' AND a.status_monitoring_6 = 'M' AND a.status_monitoring_7 = 'M' 
  			    AND a.status_monitoring_8 = 'M' AND a.status_monitoring_9 = 'M' AND a.status_monitoring_10 = 'M')
  			    THEN 1
  			  WHEN (a.status_monitoring_2 IN ('P','T') OR a.status_monitoring_3 IN ('P','T') OR a.status_monitoring_4 IN ('P','T')
  			    OR a.status_monitoring_5 IN ('P','T') OR a.status_monitoring_6 IN ('P','T') OR a.status_monitoring_7 IN ('P','T')
  			    OR a.status_monitoring_8 IN ('P','T') OR a.status_monitoring_9 IN ('P','T') OR a.status_monitoring_10 IN ('P','T'))
  			    THEN 0
  			  WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
  			    AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
  			    AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
  			    THEN 1
  			  WHEN (a.status_monitoring_2 = 'M' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = '' OR a.status_monitoring_5 = '' 
  			    OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' 
  			    OR a.status_monitoring_10 = '')
  			    THEN 1
  			    ELSE 0   
  			  END
  			END AS total_memadai,

  			CASE WHEN (a.status_monitoring_1 = 'P') THEN
  			  CASE
  			    WHEN (a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T' 
  			      OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
  			      OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T')
  			      THEN 0
  			    WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
  			      AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
  			      AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
  			      THEN 1
  			    WHEN (a.status_monitoring_2 = 'P' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = ''
  			      OR a.status_monitoring_5 = '' OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' 
  			      OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' OR a.status_monitoring_10 = '')
  			      THEN 1
            WHEN (a.status_monitoring_2 IN ('P','M') OR a.status_monitoring_3 IN ('P','M') 
              OR a.status_monitoring_4 IN ('P','M') OR a.status_monitoring_5 IN ('P','M') 
              OR a.status_monitoring_6 IN ('P','M') OR a.status_monitoring_7 IN ('P','M') 
              OR a.status_monitoring_8 IN ('P','M') OR a.status_monitoring_9 IN ('P','M') 
              OR a.status_monitoring_10 IN ('P','M'))
              THEN 1
  			    ELSE 0   
  			  END
  			END AS total_pemantauan_1,
  			CASE WHEN (a.status_monitoring_1 = 'M') THEN
  			  CASE
  			    WHEN a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T'
  			      OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
  			      OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T'
  			    THEN 0
  			    WHEN (a.status_monitoring_2 ='P' OR a.status_monitoring_3 ='P' OR a.status_monitoring_4 ='P' OR a.status_monitoring_5 ='P'
  			      OR a.status_monitoring_6 ='P' OR a.status_monitoring_7 ='P' OR a.status_monitoring_8 ='P' OR a.status_monitoring_9 ='P'
  			      OR a.status_monitoring_10 ='P')
  			    THEN 1
  			    ELSE 0   
  			  END 
  			END AS total_pemantauan_2,

  			CASE WHEN (a.status_monitoring_1 = 'T') THEN
  			  CASE
  			    WHEN (a.status_monitoring_2 IS NULL OR a.status_monitoring_2 IN ('T','P','M')
  			      AND a.status_monitoring_3 IS NULL OR a.status_monitoring_3 IN ('T','P','M')
  			      AND a.status_monitoring_4 IS NULL OR a.status_monitoring_4 IN ('T','P','M')
  			      AND a.status_monitoring_5 IS NULL OR a.status_monitoring_5 IN ('T','P','M')
  			      AND a.status_monitoring_6 IS NULL OR a.status_monitoring_6 IN ('T','P','M')
  			      AND a.status_monitoring_7 IS NULL OR a.status_monitoring_7 IN ('T','P','M')
  			      AND a.status_monitoring_8 IS NULL OR a.status_monitoring_8 IN ('T','P','M')
  			      AND a.status_monitoring_9 IS NULL OR a.status_monitoring_9 IN ('T','P','M')
  			      AND a.status_monitoring_10 IS NULL OR a.status_monitoring_10 IN ('T','P','M'))
  			    THEN 1
  			    ELSE 0   
  			  END 
  			END AS total_tidak_memadai_1,
  			CASE WHEN (a.status_monitoring_1 = 'M') THEN
  			  CASE
  			    WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' OR a.status_monitoring_5 ='T'
  			      OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T'
  			      OR a.status_monitoring_10 ='T')
  			    THEN 1
  			    ELSE 0   
  			  END 
  			END AS total_tidak_memadai_2,
  			CASE WHEN (a.status_monitoring_1 = 'P') THEN
  			  CASE
  			    WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' OR a.status_monitoring_5 ='T'
  			      OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T'
  			      OR a.status_monitoring_10 ='T')
  			    THEN 1
  			    ELSE 0   
  			  END 
  			END AS total_tidak_memadai_3

  			FROM audit_baru a LEFT JOIN divisi d ON d.id_divisi = a.id_divisi WHERE a.tipe='I' AND d.nama != 'OTHER' AND d.nama_divisi='app' 
        $tahun $bagian
  			  AND (a.status_monitoring_1 IN ('M','T','P') OR a.status_monitoring_2 IN ('M','T','P')
  			  OR a.status_monitoring_3 IN ('M','T','P') OR a.status_monitoring_4 IN ('M','T','P')
  			  OR a.status_monitoring_5 IN ('M','T','P') OR a.status_monitoring_6 IN ('M','T','P')
  			  OR a.status_monitoring_7 IN ('M','T','P') OR a.status_monitoring_8 IN ('M','T','P')
  			  OR a.status_monitoring_9 IN ('M','T','P') OR a.status_monitoring_10 IN ('M','T','P')
  			  ) GROUP BY a.id_audit");
  		return $query->result_array();
    }

    public function jumlah_kategori_internal($tahun,$nama_bagian){
  		if($tahun != "semua"){
  			$tahun = "AND tahun = '$tahun'";
  		}else{
  			$tahun = "";
  		}

      if($nama_bagian != "kdr"){
        $bagian = "AND d.nama = '$nama_bagian'";
      }else{
        $bagian = "";
      }
  		$query = $this->db->query("SELECT a.id_audit,a.id_kategori,
  		                         CASE WHEN a.id_kategori = 1 THEN 1 ELSE 0
  		                         END AS total_major,
  		                         CASE WHEN a.id_kategori = 2 THEN 1 ELSE 0
  		                         END AS total_minor,
  		                         CASE WHEN a.id_kategori = 3 THEN 1 ELSE 0
  		                         END AS total_moderate
  		                         FROM audit_baru a LEFT JOIN divisi d ON d.id_divisi = a.id_divisi
  		                         WHERE a.tipe='I' AND d.nama != 'OTHER' AND d.nama_divisi='app' $tahun $bagian
  		                         AND a.id_kategori IN (1,2,3)");
  		return $query->result_array();
    }

    public function monitoring_internal_major($tahun,$nama_bagian){
    	if($tahun != "semua"){
  			$tahun = "AND tahun = '$tahun'";
  		}else{
  			$tahun = "";
  		}
      if($nama_bagian != "kdr"){
        $bagian = "AND d.nama = '$nama_bagian'";
      }else{
        $bagian = "";
      }
  		$query = $this->db->query("SELECT a.id_audit, a.status_monitoring_1,a.status_monitoring_2,a.status_monitoring_3,a.status_monitoring_4,a.status_monitoring_5,
  			a.status_monitoring_6,a.status_monitoring_7,a.status_monitoring_8,a.status_monitoring_9,a.status_monitoring_10,
  			CASE WHEN (a.status_monitoring_1 = 'M') THEN
  			  CASE 
  			  WHEN (a.status_monitoring_2 = 'M' AND a.status_monitoring_3 = 'M' AND a.status_monitoring_4 = 'M'
  			    AND a.status_monitoring_5 = 'M' AND a.status_monitoring_6 = 'M' AND a.status_monitoring_7 = 'M' 
  			    AND a.status_monitoring_8 = 'M' AND a.status_monitoring_9 = 'M' AND a.status_monitoring_10 = 'M')
  			    THEN 1
  			  WHEN (a.status_monitoring_2 IN ('P','T') OR a.status_monitoring_3 IN ('P','T') OR a.status_monitoring_4 IN ('P','T')
  			    OR a.status_monitoring_5 IN ('P','T') OR a.status_monitoring_6 IN ('P','T') OR a.status_monitoring_7 IN ('P','T')
  			    OR a.status_monitoring_8 IN ('P','T') OR a.status_monitoring_9 IN ('P','T') OR a.status_monitoring_10 IN ('P','T'))
  			    THEN 0
  			  WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
  			    AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
  			    AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
  			    THEN 1
  			  WHEN (a.status_monitoring_2 = 'M' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = '' OR a.status_monitoring_5 = '' 
  			    OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' 
  			    OR a.status_monitoring_10 = '')
  			    THEN 1
  			    ELSE 0   
  			  END
  			END AS total_memadai,

  			CASE WHEN (a.status_monitoring_1 = 'P') THEN
  			  CASE
  			    WHEN (a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T' 
  			      OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
  			      OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T')
  			      THEN 0
  			    WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
  			      AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
  			      AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
  			      THEN 1
  			    WHEN (a.status_monitoring_2 = 'P' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = ''
  			      OR a.status_monitoring_5 = '' OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' 
  			      OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' OR a.status_monitoring_10 = '')
  			      THEN 1
            WHEN (a.status_monitoring_2 IN ('P','M') OR a.status_monitoring_3 IN ('P','M') 
              OR a.status_monitoring_4 IN ('P','M') OR a.status_monitoring_5 IN ('P','M') 
              OR a.status_monitoring_6 IN ('P','M') OR a.status_monitoring_7 IN ('P','M') 
              OR a.status_monitoring_8 IN ('P','M') OR a.status_monitoring_9 IN ('P','M') 
              OR a.status_monitoring_10 IN ('P','M'))
              THEN 1
  			    ELSE 0   
  			  END
  			END AS total_pemantauan_1,
  			CASE WHEN (a.status_monitoring_1 = 'M') THEN
  			  CASE
  			    WHEN a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T'
  			      OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
  			      OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T'
  			    THEN 0
  			    WHEN (a.status_monitoring_2 ='P' OR a.status_monitoring_3 ='P' OR a.status_monitoring_4 ='P' OR a.status_monitoring_5 ='P'
  			      OR a.status_monitoring_6 ='P' OR a.status_monitoring_7 ='P' OR a.status_monitoring_8 ='P' OR a.status_monitoring_9 ='P'
  			      OR a.status_monitoring_10 ='P')
  			    THEN 1
  			    ELSE 0   
  			  END 
  			END AS total_pemantauan_2,

  			CASE WHEN (a.status_monitoring_1 = 'T') THEN
  			  CASE
  			    WHEN (a.status_monitoring_2 IS NULL OR a.status_monitoring_2 IN ('T','P','M')
  			      AND a.status_monitoring_3 IS NULL OR a.status_monitoring_3 IN ('T','P','M')
  			      AND a.status_monitoring_4 IS NULL OR a.status_monitoring_4 IN ('T','P','M')
  			      AND a.status_monitoring_5 IS NULL OR a.status_monitoring_5 IN ('T','P','M')
  			      AND a.status_monitoring_6 IS NULL OR a.status_monitoring_6 IN ('T','P','M')
  			      AND a.status_monitoring_7 IS NULL OR a.status_monitoring_7 IN ('T','P','M')
  			      AND a.status_monitoring_8 IS NULL OR a.status_monitoring_8 IN ('T','P','M')
  			      AND a.status_monitoring_9 IS NULL OR a.status_monitoring_9 IN ('T','P','M')
  			      AND a.status_monitoring_10 IS NULL OR a.status_monitoring_10 IN ('T','P','M'))
  			    THEN 1
  			    ELSE 0   
  			  END 
  			END AS total_tidak_memadai_1,
  			CASE WHEN (a.status_monitoring_1 = 'M') THEN
  			  CASE
  			    WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' OR a.status_monitoring_5 ='T'
  			      OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T'
  			      OR a.status_monitoring_10 ='T')
  			    THEN 1
  			    ELSE 0   
  			  END 
  			END AS total_tidak_memadai_2,
  			CASE WHEN (a.status_monitoring_1 = 'P') THEN
  			  CASE
  			    WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' OR a.status_monitoring_5 ='T'
  			      OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T'
  			      OR a.status_monitoring_10 ='T')
  			    THEN 1
  			    ELSE 0   
  			  END 
  			END AS total_tidak_memadai_3

  			FROM audit_baru a LEFT JOIN divisi d ON d.id_divisi = a.id_divisi WHERE a.tipe='I' AND d.nama != 'OTHER' AND d.nama_divisi='app' 
  			  AND a.id_kategori=1 $tahun $bagian
  			  AND (a.status_monitoring_1 IN ('M','T','P') OR a.status_monitoring_2 IN ('M','T','P')
  			  OR a.status_monitoring_3 IN ('M','T','P') OR a.status_monitoring_4 IN ('M','T','P')
  			  OR a.status_monitoring_5 IN ('M','T','P') OR a.status_monitoring_6 IN ('M','T','P')
  			  OR a.status_monitoring_7 IN ('M','T','P') OR a.status_monitoring_8 IN ('M','T','P')
  			  OR a.status_monitoring_9 IN ('M','T','P') OR a.status_monitoring_10 IN ('M','T','P')
  			  ) GROUP BY a.id_audit");
  		return $query->result_array();
    }

    public function monitoring_internal_minor($tahun,$nama_bagian){
      if($tahun != "semua"){
        $tahun = "AND tahun = '$tahun'";
      }else{
        $tahun = "";
      }

      if($nama_bagian != "kdr"){
        $bagian = "AND d.nama = '$nama_bagian'";
      }else{
        $bagian = "";
      }
      $query = $this->db->query("SELECT a.id_audit, a.status_monitoring_1,a.status_monitoring_2,a.status_monitoring_3,a.status_monitoring_4,a.status_monitoring_5,
        a.status_monitoring_6,a.status_monitoring_7,a.status_monitoring_8,a.status_monitoring_9,a.status_monitoring_10,
        CASE WHEN (a.status_monitoring_1 = 'M') THEN
          CASE 
          WHEN (a.status_monitoring_2 = 'M' AND a.status_monitoring_3 = 'M' AND a.status_monitoring_4 = 'M'
            AND a.status_monitoring_5 = 'M' AND a.status_monitoring_6 = 'M' AND a.status_monitoring_7 = 'M' 
            AND a.status_monitoring_8 = 'M' AND a.status_monitoring_9 = 'M' AND a.status_monitoring_10 = 'M')
            THEN 1
          WHEN (a.status_monitoring_2 IN ('P','T') OR a.status_monitoring_3 IN ('P','T') OR a.status_monitoring_4 IN ('P','T')
            OR a.status_monitoring_5 IN ('P','T') OR a.status_monitoring_6 IN ('P','T') OR a.status_monitoring_7 IN ('P','T')
            OR a.status_monitoring_8 IN ('P','T') OR a.status_monitoring_9 IN ('P','T') OR a.status_monitoring_10 IN ('P','T'))
            THEN 0
          WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
            AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
            AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
            THEN 1
          WHEN (a.status_monitoring_2 = 'M' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = '' OR a.status_monitoring_5 = '' 
            OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' 
            OR a.status_monitoring_10 = '')
            THEN 1
            ELSE 0   
          END
        END AS total_memadai,

        CASE WHEN (a.status_monitoring_1 = 'P') THEN
          CASE
            WHEN (a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T' 
              OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
              OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T')
              THEN 0
            WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
              AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
              AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
              THEN 1
            WHEN (a.status_monitoring_2 = 'P' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = ''
              OR a.status_monitoring_5 = '' OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' 
              OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' OR a.status_monitoring_10 = '')
              THEN 1
            WHEN (a.status_monitoring_2 IN ('P','M') OR a.status_monitoring_3 IN ('P','M') 
              OR a.status_monitoring_4 IN ('P','M') OR a.status_monitoring_5 IN ('P','M') 
              OR a.status_monitoring_6 IN ('P','M') OR a.status_monitoring_7 IN ('P','M') 
              OR a.status_monitoring_8 IN ('P','M') OR a.status_monitoring_9 IN ('P','M') 
              OR a.status_monitoring_10 IN ('P','M'))
              THEN 1
            ELSE 0   
          END
        END AS total_pemantauan_1,
        CASE WHEN (a.status_monitoring_1 = 'M') THEN
          CASE
            WHEN a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T'
              OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
              OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T'
            THEN 0
            WHEN (a.status_monitoring_2 ='P' OR a.status_monitoring_3 ='P' OR a.status_monitoring_4 ='P' OR a.status_monitoring_5 ='P'
              OR a.status_monitoring_6 ='P' OR a.status_monitoring_7 ='P' OR a.status_monitoring_8 ='P' OR a.status_monitoring_9 ='P'
              OR a.status_monitoring_10 ='P')
            THEN 1
            ELSE 0   
          END 
        END AS total_pemantauan_2,

        CASE WHEN (a.status_monitoring_1 = 'T') THEN
          CASE
            WHEN (a.status_monitoring_2 IS NULL OR a.status_monitoring_2 IN ('T','P','M')
              AND a.status_monitoring_3 IS NULL OR a.status_monitoring_3 IN ('T','P','M')
              AND a.status_monitoring_4 IS NULL OR a.status_monitoring_4 IN ('T','P','M')
              AND a.status_monitoring_5 IS NULL OR a.status_monitoring_5 IN ('T','P','M')
              AND a.status_monitoring_6 IS NULL OR a.status_monitoring_6 IN ('T','P','M')
              AND a.status_monitoring_7 IS NULL OR a.status_monitoring_7 IN ('T','P','M')
              AND a.status_monitoring_8 IS NULL OR a.status_monitoring_8 IN ('T','P','M')
              AND a.status_monitoring_9 IS NULL OR a.status_monitoring_9 IN ('T','P','M')
              AND a.status_monitoring_10 IS NULL OR a.status_monitoring_10 IN ('T','P','M'))
            THEN 1
            ELSE 0   
          END 
        END AS total_tidak_memadai_1,
        CASE WHEN (a.status_monitoring_1 = 'M') THEN
          CASE
            WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' OR a.status_monitoring_5 ='T'
              OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T'
              OR a.status_monitoring_10 ='T')
            THEN 1
            ELSE 0   
          END 
        END AS total_tidak_memadai_2,
        CASE WHEN (a.status_monitoring_1 = 'P') THEN
          CASE
            WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' OR a.status_monitoring_5 ='T'
              OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T'
              OR a.status_monitoring_10 ='T')
            THEN 1
            ELSE 0   
          END 
        END AS total_tidak_memadai_3

        FROM audit_baru a LEFT JOIN divisi d ON d.id_divisi = a.id_divisi WHERE a.tipe='I' AND d.nama != 'OTHER' AND d.nama_divisi='app'
          AND a.id_kategori=2 $tahun $bagian
          AND (a.status_monitoring_1 IN ('M','T','P') OR a.status_monitoring_2 IN ('M','T','P')
          OR a.status_monitoring_3 IN ('M','T','P') OR a.status_monitoring_4 IN ('M','T','P')
          OR a.status_monitoring_5 IN ('M','T','P') OR a.status_monitoring_6 IN ('M','T','P')
          OR a.status_monitoring_7 IN ('M','T','P') OR a.status_monitoring_8 IN ('M','T','P')
          OR a.status_monitoring_9 IN ('M','T','P') OR a.status_monitoring_10 IN ('M','T','P')
          ) GROUP BY a.id_audit");
      return $query->result_array();
    }

    public function monitoring_internal_moderate($tahun,$nama_bagian){
    	if($tahun != "semua"){
  			$tahun = "AND tahun = '$tahun'";
  		}else{
  			$tahun = "";
  		}

      if($nama_bagian != "kdr"){
        $bagian = "AND d.nama = '$nama_bagian'";
      }else{
        $bagian = "";
      }
  		$query = $this->db->query("SELECT a.id_audit, a.status_monitoring_1,a.status_monitoring_2,a.status_monitoring_3,a.status_monitoring_4,a.status_monitoring_5,
  			a.status_monitoring_6,a.status_monitoring_7,a.status_monitoring_8,a.status_monitoring_9,a.status_monitoring_10,
  			CASE WHEN (a.status_monitoring_1 = 'M') THEN
  			  CASE 
  			  WHEN (a.status_monitoring_2 = 'M' AND a.status_monitoring_3 = 'M' AND a.status_monitoring_4 = 'M'
  			    AND a.status_monitoring_5 = 'M' AND a.status_monitoring_6 = 'M' AND a.status_monitoring_7 = 'M' 
  			    AND a.status_monitoring_8 = 'M' AND a.status_monitoring_9 = 'M' AND a.status_monitoring_10 = 'M')
  			    THEN 1
  			  WHEN (a.status_monitoring_2 IN ('P','T') OR a.status_monitoring_3 IN ('P','T') OR a.status_monitoring_4 IN ('P','T')
  			    OR a.status_monitoring_5 IN ('P','T') OR a.status_monitoring_6 IN ('P','T') OR a.status_monitoring_7 IN ('P','T')
  			    OR a.status_monitoring_8 IN ('P','T') OR a.status_monitoring_9 IN ('P','T') OR a.status_monitoring_10 IN ('P','T'))
  			    THEN 0
  			  WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
  			    AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
  			    AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
  			    THEN 1
  			  WHEN (a.status_monitoring_2 = 'M' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = '' OR a.status_monitoring_5 = '' 
  			    OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' 
  			    OR a.status_monitoring_10 = '')
  			    THEN 1
  			    ELSE 0   
  			  END
  			END AS total_memadai,

  			CASE WHEN (a.status_monitoring_1 = 'P') THEN
  			  CASE
  			    WHEN (a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T' 
  			      OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
  			      OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T')
  			      THEN 0
  			    WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
  			      AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
  			      AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
  			      THEN 1
  			    WHEN (a.status_monitoring_2 = 'P' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = ''
  			      OR a.status_monitoring_5 = '' OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' 
  			      OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' OR a.status_monitoring_10 = '')
  			      THEN 1
            WHEN (a.status_monitoring_2 IN ('P','M') OR a.status_monitoring_3 IN ('P','M') 
              OR a.status_monitoring_4 IN ('P','M') OR a.status_monitoring_5 IN ('P','M') 
              OR a.status_monitoring_6 IN ('P','M') OR a.status_monitoring_7 IN ('P','M') 
              OR a.status_monitoring_8 IN ('P','M') OR a.status_monitoring_9 IN ('P','M') 
              OR a.status_monitoring_10 IN ('P','M'))
              THEN 1
  			    ELSE 0   
  			  END
  			END AS total_pemantauan_1,
  			CASE WHEN (a.status_monitoring_1 = 'M') THEN
  			  CASE
  			    WHEN a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T'
  			      OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
  			      OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T'
  			    THEN 0
  			    WHEN (a.status_monitoring_2 ='P' OR a.status_monitoring_3 ='P' OR a.status_monitoring_4 ='P' OR a.status_monitoring_5 ='P'
  			      OR a.status_monitoring_6 ='P' OR a.status_monitoring_7 ='P' OR a.status_monitoring_8 ='P' OR a.status_monitoring_9 ='P'
  			      OR a.status_monitoring_10 ='P')
  			    THEN 1
  			    ELSE 0   
  			  END 
  			END AS total_pemantauan_2,

  			CASE WHEN (a.status_monitoring_1 = 'T') THEN
  			  CASE
  			    WHEN (a.status_monitoring_2 IS NULL OR a.status_monitoring_2 IN ('T','P','M')
  			      AND a.status_monitoring_3 IS NULL OR a.status_monitoring_3 IN ('T','P','M')
  			      AND a.status_monitoring_4 IS NULL OR a.status_monitoring_4 IN ('T','P','M')
  			      AND a.status_monitoring_5 IS NULL OR a.status_monitoring_5 IN ('T','P','M')
  			      AND a.status_monitoring_6 IS NULL OR a.status_monitoring_6 IN ('T','P','M')
  			      AND a.status_monitoring_7 IS NULL OR a.status_monitoring_7 IN ('T','P','M')
  			      AND a.status_monitoring_8 IS NULL OR a.status_monitoring_8 IN ('T','P','M')
  			      AND a.status_monitoring_9 IS NULL OR a.status_monitoring_9 IN ('T','P','M')
  			      AND a.status_monitoring_10 IS NULL OR a.status_monitoring_10 IN ('T','P','M'))
  			    THEN 1
  			    ELSE 0   
  			  END 
  			END AS total_tidak_memadai_1,
  			CASE WHEN (a.status_monitoring_1 = 'M') THEN
  			  CASE
  			    WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' OR a.status_monitoring_5 ='T'
  			      OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T'
  			      OR a.status_monitoring_10 ='T')
  			    THEN 1
  			    ELSE 0   
  			  END 
  			END AS total_tidak_memadai_2,
  			CASE WHEN (a.status_monitoring_1 = 'P') THEN
  			  CASE
  			    WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' OR a.status_monitoring_5 ='T'
  			      OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T'
  			      OR a.status_monitoring_10 ='T')
  			    THEN 1
  			    ELSE 0   
  			  END 
  			END AS total_tidak_memadai_3

  			FROM audit_baru a LEFT JOIN divisi d ON d.id_divisi = a.id_divisi WHERE a.tipe='I' AND d.nama != 'OTHER' AND d.nama_divisi='app'
  			  AND a.id_kategori=3 $tahun $bagian
  			  AND (a.status_monitoring_1 IN ('M','T','P') OR a.status_monitoring_2 IN ('M','T','P')
  			  OR a.status_monitoring_3 IN ('M','T','P') OR a.status_monitoring_4 IN ('M','T','P')
  			  OR a.status_monitoring_5 IN ('M','T','P') OR a.status_monitoring_6 IN ('M','T','P')
  			  OR a.status_monitoring_7 IN ('M','T','P') OR a.status_monitoring_8 IN ('M','T','P')
  			  OR a.status_monitoring_9 IN ('M','T','P') OR a.status_monitoring_10 IN ('M','T','P')
  			  ) GROUP BY a.id_audit");
  		return $query->result_array();
    }

    public function detail_tidak_memadai($tahun,$nama_bagian){
      if($tahun != "semua"){
        $tahun = "AND tahun = '$tahun'";
      }else{
        $tahun = "";
      }

      if($nama_bagian != "kdr"){
        $bagian = "AND d.nama = '$nama_bagian'";
      }else{
        $bagian = "";
      }
      $query = $this->db->query("SELECT a.id_audit, a.status_monitoring_1,a.status_monitoring_2,a.status_monitoring_3,a.status_monitoring_4,a.status_monitoring_5,
        a.status_monitoring_6,a.status_monitoring_7,a.status_monitoring_8,a.status_monitoring_9,a.status_monitoring_10,
        a.data_temuan, a.deadline, d.nama,
        CASE WHEN (a.status_monitoring_1 = 'T') THEN
          CASE
            WHEN (a.status_monitoring_2 IS NULL OR a.status_monitoring_2 IN ('T','P','M')
              AND a.status_monitoring_3 IS NULL OR a.status_monitoring_3 IN ('T','P','M')
              AND a.status_monitoring_4 IS NULL OR a.status_monitoring_4 IN ('T','P','M')
              AND a.status_monitoring_5 IS NULL OR a.status_monitoring_5 IN ('T','P','M')
              AND a.status_monitoring_6 IS NULL OR a.status_monitoring_6 IN ('T','P','M')
              AND a.status_monitoring_7 IS NULL OR a.status_monitoring_7 IN ('T','P','M')
              AND a.status_monitoring_8 IS NULL OR a.status_monitoring_8 IN ('T','P','M')
              AND a.status_monitoring_9 IS NULL OR a.status_monitoring_9 IN ('T','P','M')
              AND a.status_monitoring_10 IS NULL OR a.status_monitoring_10 IN ('T','P','M'))
            THEN 1
            ELSE 0   
          END 
        END AS total_tidak_memadai_1,
        CASE WHEN (a.status_monitoring_1 = 'M') THEN
          CASE
            WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' OR a.status_monitoring_5 ='T'
              OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T'
              OR a.status_monitoring_10 ='T')
            THEN 1
            ELSE 0   
          END 
        END AS total_tidak_memadai_2,
        CASE WHEN (a.status_monitoring_1 = 'P') THEN
          CASE
            WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' OR a.status_monitoring_5 ='T'
              OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T'
              OR a.status_monitoring_10 ='T')
            THEN 1
            ELSE 0   
          END 
        END AS total_tidak_memadai_3

        FROM audit_baru a LEFT JOIN divisi d ON d.id_divisi = a.id_divisi WHERE a.tipe='I' AND d.nama != 'OTHER' AND d.nama_divisi='app' 
        $tahun $bagian
          AND (a.status_monitoring_1 IN ('T') OR a.status_monitoring_2 IN ('T')
          OR a.status_monitoring_3 IN ('T') OR a.status_monitoring_4 IN ('T')
          OR a.status_monitoring_5 IN ('T') OR a.status_monitoring_6 IN ('T')
          OR a.status_monitoring_7 IN ('T') OR a.status_monitoring_8 IN ('T')
          OR a.status_monitoring_9 IN ('T') OR a.status_monitoring_10 IN ('T')
          ) GROUP BY a.id_audit");
      return $query->result_array();
    }

    public function untuk_notif(){
      $query = $this->db->query("SELECT a.id_audit, a.status_monitoring_1,a.status_monitoring_2,a.status_monitoring_3,a.status_monitoring_4,a.status_monitoring_5,a.status_monitoring_6,a.status_monitoring_7,a.status_monitoring_8,a.status_monitoring_9,a.status_monitoring_10,
        CASE WHEN (a.status_monitoring_1 = 'P') THEN
          CASE
            WHEN (a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T' 
              OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
              OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T')
              THEN 0
            WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
              AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
              AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
              THEN 1
            WHEN (a.status_monitoring_2 = 'P' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = ''
              OR a.status_monitoring_5 = '' OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' 
              OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' OR a.status_monitoring_10 = '')
              THEN 1
            WHEN (a.status_monitoring_2 IN ('P','M') OR a.status_monitoring_3 IN ('P','M') 
              OR a.status_monitoring_4 IN ('P','M') OR a.status_monitoring_5 IN ('P','M') 
              OR a.status_monitoring_6 IN ('P','M') OR a.status_monitoring_7 IN ('P','M') 
              OR a.status_monitoring_8 IN ('P','M') OR a.status_monitoring_9 IN ('P','M') 
              OR a.status_monitoring_10 IN ('P','M'))
              THEN 1
            ELSE 0   
          END
        END AS total_pemantauan_1,
        CASE WHEN (a.status_monitoring_1 = 'M') THEN
          CASE
            WHEN a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T'
              OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
              OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T'
            THEN 0
            WHEN (a.status_monitoring_2 ='P' OR a.status_monitoring_3 ='P' OR a.status_monitoring_4 ='P' OR a.status_monitoring_5 ='P'
              OR a.status_monitoring_6 ='P' OR a.status_monitoring_7 ='P' OR a.status_monitoring_8 ='P' OR a.status_monitoring_9 ='P'
              OR a.status_monitoring_10 ='P')
            THEN 1
            ELSE 0   
          END 
        END AS total_pemantauan_2,

        CASE WHEN (a.status_monitoring_1 = 'T') THEN
          CASE
            WHEN (a.status_monitoring_2 IS NULL OR a.status_monitoring_2 IN ('T','P','M')
              AND a.status_monitoring_3 IS NULL OR a.status_monitoring_3 IN ('T','P','M')
              AND a.status_monitoring_4 IS NULL OR a.status_monitoring_4 IN ('T','P','M')
              AND a.status_monitoring_5 IS NULL OR a.status_monitoring_5 IN ('T','P','M')
              AND a.status_monitoring_6 IS NULL OR a.status_monitoring_6 IN ('T','P','M')
              AND a.status_monitoring_7 IS NULL OR a.status_monitoring_7 IN ('T','P','M')
              AND a.status_monitoring_8 IS NULL OR a.status_monitoring_8 IN ('T','P','M')
              AND a.status_monitoring_9 IS NULL OR a.status_monitoring_9 IN ('T','P','M')
              AND a.status_monitoring_10 IS NULL OR a.status_monitoring_10 IN ('T','P','M'))
            THEN 1
            ELSE 0   
          END 
        END AS total_tidak_memadai_1,
        CASE WHEN (a.status_monitoring_1 = 'M') THEN
          CASE
            WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' OR a.status_monitoring_5 ='T'
              OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T'
              OR a.status_monitoring_10 ='T')
            THEN 1
            ELSE 0   
          END 
        END AS total_tidak_memadai_2,
        CASE WHEN (a.status_monitoring_1 = 'P') THEN
          CASE
            WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' OR a.status_monitoring_5 ='T'
              OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T'
              OR a.status_monitoring_10 ='T')
            THEN 1
            ELSE 0   
          END 
        END AS total_tidak_memadai_3

        FROM audit_baru a LEFT JOIN divisi d ON d.id_divisi = a.id_divisi WHERE a.tipe='I' AND d.nama != 'OTHER' AND d.nama_divisi='app'
          AND (a.status_monitoring_1 IN ('M','T','P') OR a.status_monitoring_2 IN ('M','T','P')
          OR a.status_monitoring_3 IN ('M','T','P') OR a.status_monitoring_4 IN ('M','T','P')
          OR a.status_monitoring_5 IN ('M','T','P') OR a.status_monitoring_6 IN ('M','T','P')
          OR a.status_monitoring_7 IN ('M','T','P') OR a.status_monitoring_8 IN ('M','T','P')
          OR a.status_monitoring_9 IN ('M','T','P') OR a.status_monitoring_10 IN ('M','T','P')
          ) GROUP BY a.id_audit");
      return $query->result_array();
    }

    public function notiftidakmemadai($tidakmemadai){
        $data=array('jumlah_notif'=>$tidakmemadai);
        $this->db->where('id_notif', 1);
        $this->db->update('notif_audit', $data);
    }

    public function notifdalampemantauan($dalampemantauan){
        $data=array('jumlah_notif'=>$dalampemantauan);
        $this->db->where('id_notif', 2);
        $this->db->update('notif_audit', $data);
    }

    public function get_notif(){
        $query = $this->db->query("SELECT * FROM notif_audit");
        return $query->result_array();
    }

    //AUDIT REPORT EKSTERNAL
    public function jumlah_monitoring_eksternal($tahun,$nama_bagian){
  		if($tahun != "semua"){
  			$tahun = "AND tahun = '$tahun'";
  		}else{
  			$tahun = "";
  		}

      if($nama_bagian != "kdr"){
        $bagian = "AND nama = '$nama_bagian'";
      }else{
        $bagian = "";
      }
  		$query = $this->db->query("SELECT a.id_audit, a.status_monitoring_1,a.status_monitoring_2,a.status_monitoring_3,a.status_monitoring_4,a.status_monitoring_5,
        a.status_monitoring_6,a.status_monitoring_7,a.status_monitoring_8,a.status_monitoring_9,a.status_monitoring_10,
        CASE WHEN (a.status_monitoring_1 = 'M') THEN
          CASE 
          WHEN (a.status_monitoring_2 = 'M' AND a.status_monitoring_3 = 'M' AND a.status_monitoring_4 = 'M'
            AND a.status_monitoring_5 = 'M' AND a.status_monitoring_6 = 'M' AND a.status_monitoring_7 = 'M' 
            AND a.status_monitoring_8 = 'M' AND a.status_monitoring_9 = 'M' AND a.status_monitoring_10 = 'M')
            THEN 1
          WHEN (a.status_monitoring_2 IN ('P','T') OR a.status_monitoring_3 IN ('P','T') OR a.status_monitoring_4 IN ('P','T')
            OR a.status_monitoring_5 IN ('P','T') OR a.status_monitoring_6 IN ('P','T') OR a.status_monitoring_7 IN ('P','T')
            OR a.status_monitoring_8 IN ('P','T') OR a.status_monitoring_9 IN ('P','T') OR a.status_monitoring_10 IN ('P','T'))
            THEN 0
          WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
            AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
            AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
            THEN 1
          WHEN (a.status_monitoring_2 = 'M' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = '' OR a.status_monitoring_5 = '' 
            OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' 
            OR a.status_monitoring_10 = '')
            THEN 1
            ELSE 0   
          END
        END AS total_memadai,

        CASE WHEN (a.status_monitoring_1 = 'P') THEN
          CASE
            WHEN (a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T' 
              OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
              OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T')
              THEN 0
            WHEN (a.status_monitoring_2 IS NULL AND a.status_monitoring_3 IS NULL AND a.status_monitoring_4 IS NULL 
              AND a.status_monitoring_5 IS NULL AND a.status_monitoring_6 IS NULL AND a.status_monitoring_7 IS NULL 
              AND a.status_monitoring_8 IS NULL AND a.status_monitoring_9 IS NULL AND a.status_monitoring_10 IS NULL)
              THEN 1
            WHEN (a.status_monitoring_2 = 'P' OR a.status_monitoring_3 = '' OR a.status_monitoring_4 = ''
              OR a.status_monitoring_5 = '' OR a.status_monitoring_6 = '' OR a.status_monitoring_7 = '' 
              OR a.status_monitoring_8 = '' OR a.status_monitoring_9 = '' OR a.status_monitoring_10 = '')
              THEN 1
            WHEN (a.status_monitoring_2 IN ('P','M') OR a.status_monitoring_3 IN ('P','M') 
              OR a.status_monitoring_4 IN ('P','M') OR a.status_monitoring_5 IN ('P','M') 
              OR a.status_monitoring_6 IN ('P','M') OR a.status_monitoring_7 IN ('P','M') 
              OR a.status_monitoring_8 IN ('P','M') OR a.status_monitoring_9 IN ('P','M') 
              OR a.status_monitoring_10 IN ('P','M'))
              THEN 1
            ELSE 0   
          END
        END AS total_pemantauan_1,
        CASE WHEN (a.status_monitoring_1 = 'M') THEN
          CASE
            WHEN a.status_monitoring_2 = 'T' OR a.status_monitoring_3 = 'T' OR a.status_monitoring_4 = 'T'
              OR a.status_monitoring_5 = 'T' OR a.status_monitoring_6 = 'T' OR a.status_monitoring_7 = 'T'
              OR a.status_monitoring_8 = 'T' OR a.status_monitoring_9 = 'T' OR a.status_monitoring_10 = 'T'
            THEN 0
            WHEN (a.status_monitoring_2 ='P' OR a.status_monitoring_3 ='P' OR a.status_monitoring_4 ='P' OR a.status_monitoring_5 ='P'
              OR a.status_monitoring_6 ='P' OR a.status_monitoring_7 ='P' OR a.status_monitoring_8 ='P' OR a.status_monitoring_9 ='P'
              OR a.status_monitoring_10 ='P')
            THEN 1
            ELSE 0   
          END 
        END AS total_pemantauan_2,

        CASE WHEN (a.status_monitoring_1 = 'T') THEN
          CASE
            WHEN (a.status_monitoring_2 IS NULL OR a.status_monitoring_2 IN ('T','P','M')
              AND a.status_monitoring_3 IS NULL OR a.status_monitoring_3 IN ('T','P','M')
              AND a.status_monitoring_4 IS NULL OR a.status_monitoring_4 IN ('T','P','M')
              AND a.status_monitoring_5 IS NULL OR a.status_monitoring_5 IN ('T','P','M')
              AND a.status_monitoring_6 IS NULL OR a.status_monitoring_6 IN ('T','P','M')
              AND a.status_monitoring_7 IS NULL OR a.status_monitoring_7 IN ('T','P','M')
              AND a.status_monitoring_8 IS NULL OR a.status_monitoring_8 IN ('T','P','M')
              AND a.status_monitoring_9 IS NULL OR a.status_monitoring_9 IN ('T','P','M')
              AND a.status_monitoring_10 IS NULL OR a.status_monitoring_10 IN ('T','P','M'))
            THEN 1
            ELSE 0   
          END 
        END AS total_tidak_memadai_1,
        CASE WHEN (a.status_monitoring_1 = 'M') THEN
          CASE
            WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' OR a.status_monitoring_5 ='T'
              OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T'
              OR a.status_monitoring_10 ='T')
            THEN 1
            ELSE 0   
          END 
        END AS total_tidak_memadai_2,
        CASE WHEN (a.status_monitoring_1 = 'P') THEN
          CASE
            WHEN (a.status_monitoring_2 ='T' OR a.status_monitoring_3 ='T' OR a.status_monitoring_4 ='T' OR a.status_monitoring_5 ='T'
              OR a.status_monitoring_6 ='T' OR a.status_monitoring_7 ='T' OR a.status_monitoring_8 ='T' OR a.status_monitoring_9 ='T'
              OR a.status_monitoring_10 ='T')
            THEN 1
            ELSE 0   
          END 
        END AS total_tidak_memadai_3

        FROM audit_baru a LEFT JOIN divisi d ON d.id_divisi = a.id_divisi WHERE a.tipe='E' AND d.nama != 'OTHER' AND d.nama_divisi='app' $tahun $bagian
          AND (a.status_monitoring_1 IN ('M','T','P') OR a.status_monitoring_2 IN ('M','T','P')
          OR a.status_monitoring_3 IN ('M','T','P') OR a.status_monitoring_4 IN ('M','T','P')
          OR a.status_monitoring_5 IN ('M','T','P') OR a.status_monitoring_6 IN ('M','T','P')
          OR a.status_monitoring_7 IN ('M','T','P') OR a.status_monitoring_8 IN ('M','T','P')
          OR a.status_monitoring_9 IN ('M','T','P') OR a.status_monitoring_10 IN ('M','T','P')
          ) GROUP BY a.id_audit");
  		return $query->result_array();
    }
}