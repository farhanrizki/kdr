<?php 
  
class M_audit extends CI_Model
{	
    public function __construct(){
        parent::__construct();
    }

    /*============== MENU DASHBOARD ====================*/
    public function semua_maturity(){
        $query = $this->db->query("SELECT*,
            (SELECT nilai FROM kategori WHERE id_kategori = 1) AS major_value,
            (SELECT nilai FROM kategori WHERE id_kategori = 2) AS minor_value,
            (SELECT nilai FROM kategori WHERE id_kategori = 3) AS moderate_value
        FROM
            (SELECT d.id_divisi, d.`nama` AS divisi_name, d.nilai AS divisi_value,
              CASE
                  WHEN major.total_major IS NULL THEN 0
                  ELSE major.total_major
              END AS total_major,
              CASE
                  WHEN majormemadai.tot_major_memadai IS NULL THEN 0
                  ELSE majormemadai.tot_major_memadai
              END AS total_major_memadai,
              CASE
                  WHEN majordiluarmemadai.tot_major_diluar_memadai IS NULL THEN 0
                  ELSE majordiluarmemadai.tot_major_diluar_memadai
              END AS total_major_diluar_memadai,
              
              CASE
                 WHEN minor.total_minor IS NULL THEN 0
                 ELSE minor.total_minor
              END AS total_minor,
              CASE
                  WHEN minormemadai.tot_minor_memadai IS NULL THEN 0
                  ELSE minormemadai.tot_minor_memadai
              END AS total_minor_memadai,
              CASE
                  WHEN minordiluarmemadai.tot_minor_diluar_memadai IS NULL THEN 0
                  ELSE minordiluarmemadai.tot_minor_diluar_memadai
              END AS total_minor_diluar_memadai,
              
              CASE
                  WHEN moderate.total_moderate IS NULL THEN 0
                  ELSE moderate.total_moderate
              END AS total_moderate,
              CASE
                  WHEN moderatememadai.tot_moderate_memadai IS NULL THEN 0
                  ELSE moderatememadai.tot_moderate_memadai
              END AS total_moderate_memadai,
              CASE
                  WHEN moderatediluarmemadai.tot_moderate_diluar_memadai IS NULL THEN 0
                  ELSE moderatediluarmemadai.tot_moderate_diluar_memadai
              END AS total_moderate_diluar_memadai
            FROM divisi d
              LEFT JOIN (SELECT id_divisi, COUNT(*) AS total_major FROM audit_baru
              WHERE id_kategori = '1' AND tipe = 'I'
              GROUP BY id_divisi) AS major ON major.id_divisi = d.id_divisi
              LEFT JOIN (SELECT id_divisi, COUNT(*) AS tot_major_memadai FROM audit_baru
              WHERE (status_monitoring_1 ='M' OR status_monitoring_2 ='M'
                  OR status_monitoring_3 ='M' OR status_monitoring_4 ='M'
                  OR status_monitoring_5 ='M' OR status_monitoring_6 ='M'
                  OR status_monitoring_7 ='M' OR status_monitoring_8 ='M'
                  OR status_monitoring_9 ='M' OR status_monitoring_10 ='M')  
              AND id_kategori = '1' AND tipe = 'I'
              GROUP BY id_divisi) AS majormemadai ON majormemadai.id_divisi = d.id_divisi
              LEFT JOIN (SELECT id_divisi, COUNT(*) AS tot_major_diluar_memadai FROM audit_baru
              WHERE (status_monitoring_1 IN ('T','P') OR status_monitoring_2 IN ('T','P')
                  OR status_monitoring_3 IN ('T','P') OR status_monitoring_4 IN ('T','P')
                  OR status_monitoring_5 IN ('T','P') OR status_monitoring_6 IN ('T','P')
                  OR status_monitoring_7 IN ('T','P') OR status_monitoring_8 IN ('T','P')
                  OR status_monitoring_9 IN ('T','P') OR status_monitoring_10 IN ('T','P'))  
              AND id_kategori = '1' AND tipe = 'I'
              GROUP BY id_divisi) AS majordiluarmemadai ON majordiluarmemadai.id_divisi = d.id_divisi
              LEFT JOIN (SELECT id_divisi, COUNT(*) AS total_minor FROM audit_baru
              WHERE id_kategori = '2' AND tipe = 'I'
              GROUP BY id_divisi) AS minor ON minor.id_divisi = d.id_divisi
              LEFT JOIN (SELECT id_divisi, COUNT(*) AS tot_minor_memadai FROM audit_baru
              WHERE (status_monitoring_1 ='M' OR status_monitoring_2 ='M'
                  OR status_monitoring_3 ='M' OR status_monitoring_4 ='M'
                  OR status_monitoring_5 ='M' OR status_monitoring_6 ='M'
                  OR status_monitoring_7 ='M' OR status_monitoring_8 ='M'
                  OR status_monitoring_9 ='M' OR status_monitoring_10 ='M')  
              AND id_kategori = '2' AND tipe = 'I'
              GROUP BY id_divisi) AS minormemadai ON minormemadai.id_divisi = d.id_divisi
              LEFT JOIN (SELECT id_divisi, COUNT(*) AS tot_minor_diluar_memadai FROM audit_baru
              WHERE (status_monitoring_1 IN ('T','P') OR status_monitoring_2 IN ('T','P')
                  OR status_monitoring_3 IN ('T','P') OR status_monitoring_4 IN ('T','P')
                  OR status_monitoring_5 IN ('T','P') OR status_monitoring_6 IN ('T','P')
                  OR status_monitoring_7 IN ('T','P') OR status_monitoring_8 IN ('T','P')
                  OR status_monitoring_9 IN ('T','P') OR status_monitoring_10 IN ('T','P'))  
              AND id_kategori = '2' AND tipe = 'I'
              GROUP BY id_divisi) AS minordiluarmemadai ON minordiluarmemadai.id_divisi = d.id_divisi
              LEFT JOIN (SELECT id_divisi, COUNT(*) AS total_moderate FROM audit_baru
              WHERE id_kategori = '3' AND tipe = 'I'
              GROUP BY id_divisi) AS moderate ON moderate.id_divisi = d.id_divisi
              LEFT JOIN (SELECT id_divisi, COUNT(*) AS tot_moderate_memadai FROM audit_baru
              WHERE (status_monitoring_1 ='M' OR status_monitoring_2 ='M'
                  OR status_monitoring_3 ='M' OR status_monitoring_4 ='M'
                  OR status_monitoring_5 ='M' OR status_monitoring_6 ='M'
                  OR status_monitoring_7 ='M' OR status_monitoring_8 ='M'
                  OR status_monitoring_9 ='M' OR status_monitoring_10 ='M')  
              AND id_kategori = '3' AND tipe = 'I'
              GROUP BY id_divisi) AS moderatememadai ON moderatememadai.id_divisi = d.id_divisi
              LEFT JOIN (SELECT id_divisi, COUNT(*) AS tot_moderate_diluar_memadai FROM audit_baru
              WHERE (status_monitoring_1 IN ('T','P') OR status_monitoring_2 IN ('T','P')
                  OR status_monitoring_3 IN ('T','P') OR status_monitoring_4 IN ('T','P')
                  OR status_monitoring_5 IN ('T','P') OR status_monitoring_6 IN ('T','P')
                  OR status_monitoring_7 IN ('T','P') OR status_monitoring_8 IN ('T','P')
                  OR status_monitoring_9 IN ('T','P') OR status_monitoring_10 IN ('T','P'))  
              AND id_kategori = '3' AND tipe = 'I'
              GROUP BY id_divisi) AS moderatediluarmemadai ON moderatediluarmemadai.id_divisi = d.id_divisi
            WHERE d.tipe = 'I' AND d.nama != 'OTHER' AND d.nama_divisi='app') 
            AS maturity;");
        return $query->result_array();
    }

    public function maturity_qa(){
        $query = $this->db->query("
        SELECT d.id_divisi, d.`nama` AS divisi_name, d.nilai AS divisi_value,
          CASE WHEN major.total_major IS NULL THEN 0 ELSE major.total_major 
            END AS total_major,
          CASE WHEN majormemadai.tot_major_memadai IS NULL THEN 0 ELSE majormemadai.tot_major_memadai 
            END AS total_major_memadai,
          CASE WHEN minor.total_minor IS NULL THEN 0 ELSE minor.total_minor
            END AS total_minor,
          CASE WHEN minormemadai.tot_minor_memadai IS NULL THEN 0 ELSE minormemadai.tot_minor_memadai
            END AS total_minor_memadai,
          CASE WHEN moderate.total_moderate IS NULL THEN 0 ELSE moderate.total_moderate
            END AS total_moderate,
          CASE WHEN moderatememadai.tot_moderate_memadai IS NULL THEN 0 ELSE moderatememadai.tot_moderate_memadai
            END AS total_moderate_memadai
        FROM divisi d
          LEFT JOIN (SELECT id_divisi, COUNT(*) AS total_major FROM audit_baru
          WHERE id_kategori = '1' AND tipe = 'I'
          GROUP BY id_divisi) AS major ON major.id_divisi = d.id_divisi
          LEFT JOIN (SELECT id_divisi, COUNT(*) AS tot_major_memadai FROM audit_baru
          WHERE (status_monitoring_1 ='M' OR status_monitoring_2 ='M'
              OR status_monitoring_3 ='M' OR status_monitoring_4 ='M'
              OR status_monitoring_5 ='M' OR status_monitoring_6 ='M'
              OR status_monitoring_7 ='M' OR status_monitoring_8 ='M'
              OR status_monitoring_9 ='M' OR status_monitoring_10 ='M')  
          AND id_kategori = '1' AND tipe = 'I'
          GROUP BY id_divisi) AS majormemadai ON majormemadai.id_divisi = d.id_divisi
          LEFT JOIN (SELECT id_divisi, COUNT(*) AS total_minor FROM audit_baru
          WHERE id_kategori = '2' AND tipe = 'I'
          GROUP BY id_divisi) AS minor ON minor.id_divisi = d.id_divisi
          LEFT JOIN (SELECT id_divisi, COUNT(*) AS tot_minor_memadai FROM audit_baru
          WHERE (status_monitoring_1 ='M' OR status_monitoring_2 ='M'
              OR status_monitoring_3 ='M' OR status_monitoring_4 ='M'
              OR status_monitoring_5 ='M' OR status_monitoring_6 ='M'
              OR status_monitoring_7 ='M' OR status_monitoring_8 ='M'
              OR status_monitoring_9 ='M' OR status_monitoring_10 ='M')  
          AND id_kategori = '2' AND tipe = 'I'
          GROUP BY id_divisi) AS minormemadai ON minormemadai.id_divisi = d.id_divisi
          LEFT JOIN (SELECT id_divisi, COUNT(*) AS total_moderate FROM audit_baru
          WHERE id_kategori = '3' AND tipe = 'I'
          GROUP BY id_divisi) AS moderate ON moderate.id_divisi = d.id_divisi
          LEFT JOIN (SELECT id_divisi, COUNT(*) AS tot_moderate_memadai FROM audit_baru
          WHERE (status_monitoring_1 ='M' OR status_monitoring_2 ='M'
              OR status_monitoring_3 ='M' OR status_monitoring_4 ='M'
              OR status_monitoring_5 ='M' OR status_monitoring_6 ='M'
              OR status_monitoring_7 ='M' OR status_monitoring_8 ='M'
              OR status_monitoring_9 ='M' OR status_monitoring_10 ='M')  
          AND id_kategori = '3' AND tipe = 'I'
          GROUP BY id_divisi) AS moderatememadai ON moderatememadai.id_divisi = d.id_divisi
        WHERE d.tipe = 'I' AND d.nama IN ('KDR','PQA','PEN','SHD')");
        return $query->result_array();
    }

    public function maturity_ops(){
        $query = $this->db->query("
        SELECT d.id_divisi, d.`nama` AS divisi_name, d.nilai AS divisi_value,
          CASE WHEN major.total_major IS NULL THEN 0 ELSE major.total_major 
            END AS total_major,
          CASE WHEN majormemadai.tot_major_memadai IS NULL THEN 0 ELSE majormemadai.tot_major_memadai 
            END AS total_major_memadai,
          CASE WHEN minor.total_minor IS NULL THEN 0 ELSE minor.total_minor
            END AS total_minor,
          CASE WHEN minormemadai.tot_minor_memadai IS NULL THEN 0 ELSE minormemadai.tot_minor_memadai
            END AS total_minor_memadai,
          CASE WHEN moderate.total_moderate IS NULL THEN 0 ELSE moderate.total_moderate
            END AS total_moderate,
          CASE WHEN moderatememadai.tot_moderate_memadai IS NULL THEN 0 ELSE moderatememadai.tot_moderate_memadai
            END AS total_moderate_memadai
        FROM divisi d
          LEFT JOIN (SELECT id_divisi, COUNT(*) AS total_major FROM audit_baru
          WHERE id_kategori = '1' AND tipe = 'I'
          GROUP BY id_divisi) AS major ON major.id_divisi = d.id_divisi
          LEFT JOIN (SELECT id_divisi, COUNT(*) AS tot_major_memadai FROM audit_baru
          WHERE (status_monitoring_1 ='M' OR status_monitoring_2 ='M'
              OR status_monitoring_3 ='M' OR status_monitoring_4 ='M'
              OR status_monitoring_5 ='M' OR status_monitoring_6 ='M'
              OR status_monitoring_7 ='M' OR status_monitoring_8 ='M'
              OR status_monitoring_9 ='M' OR status_monitoring_10 ='M')  
          AND id_kategori = '1' AND tipe = 'I'
          GROUP BY id_divisi) AS majormemadai ON majormemadai.id_divisi = d.id_divisi
          LEFT JOIN (SELECT id_divisi, COUNT(*) AS total_minor FROM audit_baru
          WHERE id_kategori = '2' AND tipe = 'I'
          GROUP BY id_divisi) AS minor ON minor.id_divisi = d.id_divisi
          LEFT JOIN (SELECT id_divisi, COUNT(*) AS tot_minor_memadai FROM audit_baru
          WHERE (status_monitoring_1 ='M' OR status_monitoring_2 ='M'
              OR status_monitoring_3 ='M' OR status_monitoring_4 ='M'
              OR status_monitoring_5 ='M' OR status_monitoring_6 ='M'
              OR status_monitoring_7 ='M' OR status_monitoring_8 ='M'
              OR status_monitoring_9 ='M' OR status_monitoring_10 ='M')  
          AND id_kategori = '2' AND tipe = 'I'
          GROUP BY id_divisi) AS minormemadai ON minormemadai.id_divisi = d.id_divisi
          LEFT JOIN (SELECT id_divisi, COUNT(*) AS total_moderate FROM audit_baru
          WHERE id_kategori = '3' AND tipe = 'I'
          GROUP BY id_divisi) AS moderate ON moderate.id_divisi = d.id_divisi
          LEFT JOIN (SELECT id_divisi, COUNT(*) AS tot_moderate_memadai FROM audit_baru
          WHERE (status_monitoring_1 ='M' OR status_monitoring_2 ='M'
              OR status_monitoring_3 ='M' OR status_monitoring_4 ='M'
              OR status_monitoring_5 ='M' OR status_monitoring_6 ='M'
              OR status_monitoring_7 ='M' OR status_monitoring_8 ='M'
              OR status_monitoring_9 ='M' OR status_monitoring_10 ='M')  
          AND id_kategori = '3' AND tipe = 'I'
          GROUP BY id_divisi) AS moderatememadai ON moderatememadai.id_divisi = d.id_divisi
        WHERE d.tipe = 'I' AND d.nama IN ('ISD','OSD','OPL','OST','INF','TIK')");
        return $query->result_array();
    }

    //Audit Internal
    public function tl_internal_langsung($id_audit){
        $query = $this->db->query("SELECT a.*,DATEDIFF(a.deadline, NOW()) AS tgl_deadline,b.id_kategori AS id_kategori,
                                  b.nama AS nama_kategori,c.id_divisi AS id_divisi,c.nama AS nama_divisi
                                  FROM audit_baru a
                                  LEFT JOIN kategori b ON b.id_kategori = a.id_kategori
                                  LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                                  WHERE a.tipe='I' AND a.id_audit IN ($id_audit)
                                  AND (a.status_monitoring_1 IN ('T','P')
                                  OR a.status_monitoring_2 IN ('T','P')
                                  OR a.status_monitoring_3 IN ('T','P')
                                  OR a.status_monitoring_4 IN ('T','P')
                                  OR a.status_monitoring_5 IN ('T','P')
                                  OR a.status_monitoring_6 IN ('T','P')
                                  OR a.status_monitoring_7 IN ('T','P')
                                  OR a.status_monitoring_8 IN ('T','P')
                                  OR a.status_monitoring_9 IN ('T','P')
                                  OR a.status_monitoring_10 IN ('T','P')
                                  ) ORDER BY tgl_deadline");
        return $query->result_array();
    }

    public function tahun_audit_internal($nama_bagian){
        if($nama_bagian != "kdr"){
          $bagian = "AND d.nama = '$nama_bagian'";
        }else{
          $bagian = "";
        }
        $query = $this->db->query("SELECT a.tahun FROM audit_baru a 
                                   LEFT JOIN divisi d ON d.id_divisi = a.id_divisi 
                                   WHERE a.tipe='I' AND d.nama != 'OTHER' AND d.nama_divisi='app' $bagian GROUP BY tahun");
        return $query->result_array();
    }

    public function nama_divisi(){
        $query = $this->db->query("SELECT id_divisi, nama FROM divisi WHERE nama_divisi='app' AND tipe='I'");
        return $query->result_array();
    }

    public function nama_divisi_eksternal(){
        $query = $this->db->query("SELECT id_divisi, nama FROM divisi WHERE nama_divisi='app' AND tipe='E'");
        return $query->result_array();
    }

    public function nama_kategori(){
        $query = $this->db->query("SELECT id_kategori, nama FROM kategori WHERE nama != ''");
        return $query->result_array();
    }

    public function risk_issue(){
        $query = $this->db->query("SELECT * FROM risk_issue");
        return $query->result_array();
    }

    public function proses_major(){
        $query = $this->db->query("SELECT * FROM proses_major");
        return $query->result_array();
    }

    public function sub_proses(){
        $query = $this->db->query("SELECT * FROM subproses_major");
        return $query->result_array();
    }

    public function data_audit_internal($tahun,$nama_bagian,$status){
        if($tahun != ""){
            $tahun = "AND a.tahun = '$tahun'";
        }else{
            $tahun = "";
        }
        if($nama_bagian != "kdr"){
            $bagian = "AND c.nama = '$nama_bagian'";
        }else{
            $bagian = "";
        }

        if($status != ""){
            if($status == "memadai"){
              $status = "('M')";
            }else if($status == "tidakmemadai"){
              $status = "('T')";
            }else{
              $status = "('P')";
            }
        }else{
            $status = "('M','T','P')";
        }
        $query = $this->db->query("SELECT a.*,DATEDIFF(a.deadline, NOW()) AS tgl_deadline,b.id_kategori AS id_kategori,
                                  b.nama AS nama_kategori,c.id_divisi AS id_divisi,c.nama AS nama_divisi
                                  FROM audit_baru a
                                  LEFT JOIN kategori b ON b.id_kategori = a.id_kategori
                                  LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                                  WHERE a.tipe='I' AND c.nama != 'OTHER' AND c.nama_divisi='app' $tahun $bagian
                                  AND (a.status_monitoring_1 IN $status
                                  OR a.status_monitoring_2 IN $status
                                  OR a.status_monitoring_3 IN $status
                                  OR a.status_monitoring_4 IN $status
                                  OR a.status_monitoring_5 IN $status
                                  OR a.status_monitoring_6 IN $status
                                  OR a.status_monitoring_7 IN $status
                                  OR a.status_monitoring_8 IN $status
                                  OR a.status_monitoring_9 IN $status
                                  OR a.status_monitoring_10 IN $status
                                  ) ORDER BY tgl_deadline ");
        return $query->result_array();
    }

    public function detail_audit_internal($id_audit){
        $query = $this->db->query("
                    SELECT a.*, 
                       a.rekomendasi_1 AS rekomendasi, 
                       a.status_monitoring_1 AS status_monitoring,
                       b.id_kategori AS id_kategori,
                       b.nama AS nama_kategori, 
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi,
                       d.nama_risk AS nama_risk_issue
                    FROM audit_baru a 
                       LEFT JOIN kategori b ON b.id_kategori = a.id_kategori
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                       LEFT JOIN risk_issue d ON d.id_riskissue = a.risk_issue
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_1 IS NOT NULL AND a.tipe='I'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_2 AS rekomendasi, 
                       a.status_monitoring_2 AS status_monitoring,
                       b.id_kategori AS id_kategori,
                       b.nama AS nama_kategori, 
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi,
                       d.nama_risk AS nama_risk_issue
                    FROM audit_baru a 
                       LEFT JOIN kategori b ON b.id_kategori = a.id_kategori
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                       LEFT JOIN risk_issue d ON d.id_riskissue = a.risk_issue
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_2 IS NOT NULL AND a.tipe='I'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_3 AS rekomendasi, 
                       a.status_monitoring_3 AS status_monitoring,
                       b.id_kategori AS id_kategori,
                       b.nama AS nama_kategori, 
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi,
                       d.nama_risk AS nama_risk_issue
                    FROM audit_baru a 
                       LEFT JOIN kategori b ON b.id_kategori = a.id_kategori
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                       LEFT JOIN risk_issue d ON d.id_riskissue = a.risk_issue
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_3 IS NOT NULL AND a.tipe='I'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_4 AS rekomendasi, 
                       a.status_monitoring_4 AS status_monitoring,
                       b.id_kategori AS id_kategori,
                       b.nama AS nama_kategori, 
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi,
                       d.nama_risk AS nama_risk_issue
                    FROM audit_baru a 
                       LEFT JOIN kategori b ON b.id_kategori = a.id_kategori
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                       LEFT JOIN risk_issue d ON d.id_riskissue = a.risk_issue
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_4 IS NOT NULL AND a.tipe='I'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_5 AS rekomendasi, 
                       a.status_monitoring_5 AS status_monitoring,
                       b.id_kategori AS id_kategori,
                       b.nama AS nama_kategori, 
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi,
                       d.nama_risk AS nama_risk_issue
                    FROM audit_baru a 
                       LEFT JOIN kategori b ON b.id_kategori = a.id_kategori
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                       LEFT JOIN risk_issue d ON d.id_riskissue = a.risk_issue
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_5 IS NOT NULL AND a.tipe='I'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_6 AS rekomendasi, 
                       a.status_monitoring_6 AS status_monitoring,
                       b.id_kategori AS id_kategori,
                       b.nama AS nama_kategori, 
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi,
                       d.nama_risk AS nama_risk_issue
                    FROM audit_baru a 
                       LEFT JOIN kategori b ON b.id_kategori = a.id_kategori
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                       LEFT JOIN risk_issue d ON d.id_riskissue = a.risk_issue
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_6 IS NOT NULL AND a.tipe='I'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_7 AS rekomendasi, 
                       a.status_monitoring_7 AS status_monitoring,
                       b.id_kategori AS id_kategori,
                       b.nama AS nama_kategori, 
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi,
                       d.nama_risk AS nama_risk_issue
                    FROM audit_baru a 
                       LEFT JOIN kategori b ON b.id_kategori = a.id_kategori
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                       LEFT JOIN risk_issue d ON d.id_riskissue = a.risk_issue
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_7 IS NOT NULL AND a.tipe='I'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_8 AS rekomendasi, 
                       a.status_monitoring_8 AS status_monitoring,
                       b.id_kategori AS id_kategori,
                       b.nama AS nama_kategori, 
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi,
                       d.nama_risk AS nama_risk_issue
                    FROM audit_baru a 
                       LEFT JOIN kategori b ON b.id_kategori = a.id_kategori
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                       LEFT JOIN risk_issue d ON d.id_riskissue = a.risk_issue
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_8 IS NOT NULL AND a.tipe='I'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_9 AS rekomendasi, 
                       a.status_monitoring_9 AS status_monitoring,
                       b.id_kategori AS id_kategori,
                       b.nama AS nama_kategori, 
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi,
                       d.nama_risk AS nama_risk_issue
                    FROM audit_baru a 
                       LEFT JOIN kategori b ON b.id_kategori = a.id_kategori
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                       LEFT JOIN risk_issue d ON d.id_riskissue = a.risk_issue
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_9 IS NOT NULL AND a.tipe='I'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_10 AS rekomendasi, 
                       a.status_monitoring_10 AS status_monitoring,
                       b.id_kategori AS id_kategori,
                       b.nama AS nama_kategori, 
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi,
                       d.nama_risk AS nama_risk_issue
                    FROM audit_baru a 
                       LEFT JOIN kategori b ON b.id_kategori = a.id_kategori
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                       LEFT JOIN risk_issue d ON d.id_riskissue = a.risk_issue
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_10 IS NOT NULL AND a.tipe='I'
                ");
        return $query->result();
    }

    public function tambah_audit_internal($tahun,$sha_code,$tema_audit,$bagian_terkait,
        $data_temuan,$kategori_temuan,$rekomendasi_1,$status_monitoring_1,$rekomendasi_2,
        $status_monitoring_2,$rekomendasi_3,$status_monitoring_3,$rekomendasi_4,
        $status_monitoring_4,$rekomendasi_5,$status_monitoring_5,$rekomendasi_6,
        $status_monitoring_6,$rekomendasi_7,$status_monitoring_7,$rekomendasi_8,
        $status_monitoring_8,$rekomendasi_9,$status_monitoring_9,$rekomendasi_10,
        $status_monitoring_10,$rpm_opt,$tanggapan_skai,$deadline,$tipe,$file_upload,$risk_issue,
        $tipe_temuan,$proses_major,$subproses_major,$dibuat_oleh,$dibuat_tanggal,$diedit_oleh,$diedit_tanggal){
        $data = array(
            'tahun'                => $tahun,
            'sha'                  => $sha_code,
            'tema_audit'           => $tema_audit,
            'id_divisi'            => $bagian_terkait,
            'data_temuan'          => $data_temuan,
            'id_kategori'          => $kategori_temuan,
            'rekomendasi_1'        => $rekomendasi_1,
            'status_monitoring_1'  => $status_monitoring_1,
            'rekomendasi_2'        => $rekomendasi_2,
            'status_monitoring_2'  => $status_monitoring_2,
            'rekomendasi_3'        => $rekomendasi_3,
            'status_monitoring_3'  => $status_monitoring_3,
            'rekomendasi_4'        => $rekomendasi_4,
            'status_monitoring_4'  => $status_monitoring_4,
            'rekomendasi_5'        => $rekomendasi_5,
            'status_monitoring_5'  => $status_monitoring_5,
            'rekomendasi_6'        => $rekomendasi_6,
            'status_monitoring_6'  => $status_monitoring_6,
            'rekomendasi_7'        => $rekomendasi_7,
            'status_monitoring_7'  => $status_monitoring_7,
            'rekomendasi_8'        => $rekomendasi_8,
            'status_monitoring_8'  => $status_monitoring_8,
            'rekomendasi_9'        => $rekomendasi_9,
            'status_monitoring_9'  => $status_monitoring_9,
            'rekomendasi_10'       => $rekomendasi_10,
            'status_monitoring_10' => $status_monitoring_10,
            'rpm_opt'              => $rpm_opt,
            'tanggapan_skai'       => $tanggapan_skai,
            'deadline'             => $deadline,
            'tipe'                 => $tipe,
            'upload'               => $file_upload,
            'risk_issue'           => $risk_issue,
            'tipe_temuan'          => $tipe_temuan,
            'proses_major'         => $proses_major,
            'subproses_major'      => $subproses_major,
            'dibuat_oleh'          => $dibuat_oleh,
            'dibuat_tanggal'       => $dibuat_tanggal,
            'diedit_oleh'          => $diedit_oleh,
            'diedit_tanggal'       => $diedit_tanggal
        );
        $this->db->insert('audit_baru',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_audit_internal($id_audit,$sha_code,$tema_audit,$bagian,$data_temuan,$kategori,
        $rekomendasi_1,$status_monitoring_1,$rekomendasi_2,$status_monitoring_2,$rekomendasi_3,
        $status_monitoring_3,$rekomendasi_4,$status_monitoring_4,$rekomendasi_5,$status_monitoring_5,
        $rekomendasi_6,$status_monitoring_6,$rekomendasi_7,$status_monitoring_7,$rekomendasi_8,
        $status_monitoring_8,$rekomendasi_9,$status_monitoring_9,$rekomendasi_10,$status_monitoring_10,
        $rpm_opt,$tanggapan_skai,$deadline,$file_upload,$risk_issue,$tipe_temuan,$proses_major,$subproses_major,$diedit_oleh,$diedit_tanggal){
        $data=array(
                        'sha'                  => $sha_code,
                        'tema_audit'           => $tema_audit,
                        'id_divisi'            => $bagian,
                        'data_temuan'          => $data_temuan,
                        'id_kategori'          => $kategori,
                        'rekomendasi_1'        => $rekomendasi_1,
                        'status_monitoring_1'  => $status_monitoring_1,
                        'rekomendasi_2'        => $rekomendasi_2,
                        'status_monitoring_2'  => $status_monitoring_2,
                        'rekomendasi_3'        => $rekomendasi_3,
                        'status_monitoring_3'  => $status_monitoring_3,
                        'rekomendasi_4'        => $rekomendasi_4,
                        'status_monitoring_4'  => $status_monitoring_4,
                        'rekomendasi_5'        => $rekomendasi_5,
                        'status_monitoring_5'  => $status_monitoring_5,
                        'rekomendasi_6'        => $rekomendasi_6,
                        'status_monitoring_6'  => $status_monitoring_6,
                        'rekomendasi_7'        => $rekomendasi_7,
                        'status_monitoring_7'  => $status_monitoring_7,
                        'rekomendasi_8'        => $rekomendasi_8,
                        'status_monitoring_8'  => $status_monitoring_8,
                        'rekomendasi_9'        => $rekomendasi_9,
                        'status_monitoring_9'  => $status_monitoring_9,
                        'rekomendasi_10'       => $rekomendasi_10,
                        'status_monitoring_10' => $status_monitoring_10,
                        'rpm_opt'              => $rpm_opt,
                        'tanggapan_skai'       => $tanggapan_skai,
                        'deadline'             => $deadline,
                        'upload'               => $file_upload,
                        'risk_issue'           => $risk_issue,
                        'tipe_temuan'          => $tipe_temuan,
                        'proses_major'         => $proses_major,
                        'subproses_major'      => $subproses_major,
                        'diedit_oleh'          => $diedit_oleh,
                        'diedit_tanggal'       => $diedit_tanggal
                    );
        $this->db->where('id_audit', $id_audit);
        $this->db->update('audit_baru', $data);
        return true;
    }

    public function hapus_audit_internal($id_audit){
        $this->db->where('id_audit', $id_audit);
        $this->db->delete('audit_baru'); 
        return true;
    }

    public function download_file_internal($params = array()){
        $this->db->select('*');
        $this->db->from('audit_baru');
        $this->db->where('id_audit',$params['id_audit']);
        $query  = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        return $result;
    }

    //Aduit Eksternal
    public function tahun_audit_eksternal($nama_bagian){
        if($nama_bagian != "kdr"){
          $bagian = "AND d.nama = '$nama_bagian'";
        }else{
          $bagian = "";
        }
        $query = $this->db->query("SELECT a.tahun FROM audit_baru a 
                                   LEFT JOIN divisi d ON d.id_divisi = a.id_divisi 
                                   WHERE a.tipe='E' AND d.nama != 'OTHER' AND d.nama_divisi='app' $bagian GROUP BY tahun");
        return $query->result_array();
    }

    public function data_audit_eksternal($tahun,$nama_bagian,$status){
        if($tahun != ""){
            $tahun = "AND a.tahun = '$tahun'";
        }else{
            $tahun = "";
        }
        if($nama_bagian != "kdr"){
            $bagian = "AND c.nama = '$nama_bagian'";
        }else{
            $bagian = "";
        }
        if($status != ""){
            if($status == "memadai"){
              $status = "('M')";
            }else if($status == "tidakmemadai"){
              $status = "('T')";
            }else{
              $status = "('P')";
            }
        }else{
            $status = "('M','T','P')";
        }
        $query = $this->db->query("SELECT a.*,DATEDIFF(a.deadline, NOW()) AS tgl_deadline,c.id_divisi AS id_divisi,c.nama AS nama_divisi
                                  FROM audit_baru a
                                  LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                                  WHERE a.tipe='E' AND c.nama_divisi='app' $tahun $bagian
                                  AND (a.status_monitoring_1 IN $status
                                  OR a.status_monitoring_2 IN $status
                                  OR a.status_monitoring_3 IN $status
                                  OR a.status_monitoring_4 IN $status
                                  OR a.status_monitoring_5 IN $status
                                  OR a.status_monitoring_6 IN $status
                                  OR a.status_monitoring_7 IN $status
                                  OR a.status_monitoring_8 IN $status
                                  OR a.status_monitoring_9 IN $status
                                  OR a.status_monitoring_10 IN $status
                                  ) ORDER BY tgl_deadline");
        return $query->result_array();
    }

    public function detail_audit_eksternal($id_audit){
        $query = $this->db->query("
                    SELECT a.*, 
                       a.rekomendasi_1 AS rekomendasi, 
                       a.status_monitoring_1 AS status_monitoring,
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi
                    FROM audit_baru a 
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_1 IS NOT NULL AND a.tipe='E'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_2 AS rekomendasi, 
                       a.status_monitoring_2 AS status_monitoring,
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi
                    FROM audit_baru a 
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_2 IS NOT NULL AND a.tipe='E'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_3 AS rekomendasi, 
                       a.status_monitoring_3 AS status_monitoring,
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi
                    FROM audit_baru a 
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_3 IS NOT NULL AND a.tipe='E'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_4 AS rekomendasi, 
                       a.status_monitoring_4 AS status_monitoring,
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi
                    FROM audit_baru a 
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_4 IS NOT NULL AND a.tipe='E'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_5 AS rekomendasi, 
                       a.status_monitoring_5 AS status_monitoring,
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi
                    FROM audit_baru a 
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_5 IS NOT NULL AND a.tipe='E'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_6 AS rekomendasi, 
                       a.status_monitoring_6 AS status_monitoring,
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi
                    FROM audit_baru a 
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_6 IS NOT NULL AND a.tipe='E'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_7 AS rekomendasi, 
                       a.status_monitoring_7 AS status_monitoring,
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi
                    FROM audit_baru a 
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_7 IS NOT NULL AND a.tipe='E'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_8 AS rekomendasi, 
                       a.status_monitoring_8 AS status_monitoring,
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi
                    FROM audit_baru a 
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_8 IS NOT NULL AND a.tipe='E'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_9 AS rekomendasi, 
                       a.status_monitoring_9 AS status_monitoring,
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi
                    FROM audit_baru a 
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_9 IS NOT NULL AND a.tipe='E'
                    UNION ALL
                    SELECT a.*, 
                       a.rekomendasi_10 AS rekomendasi, 
                       a.status_monitoring_10 AS status_monitoring,
                       c.id_divisi AS id_divisi,    
                       c.nama AS nama_divisi
                    FROM audit_baru a 
                       LEFT JOIN divisi c ON c.id_divisi = a.id_divisi
                    WHERE a.id_audit='$id_audit' AND a.rekomendasi_10 IS NOT NULL AND a.tipe='E'
                ");
        return $query->result();
    }

    public function tambah_audit_eksternal($tahun,$sha_code,$tema_audit,$bagian_terkait,
        $data_temuan,$kategori_temuan,$rekomendasi_1,$status_monitoring_1,$rekomendasi_2,
        $status_monitoring_2,$rekomendasi_3,$status_monitoring_3,$rekomendasi_4,
        $status_monitoring_4,$rekomendasi_5,$status_monitoring_5,$rekomendasi_6,
        $status_monitoring_6,$rekomendasi_7,$status_monitoring_7,$rekomendasi_8,
        $status_monitoring_8,$rekomendasi_9,$status_monitoring_9,$rekomendasi_10,
        $status_monitoring_10,$rpm_opt,$tanggapan_skai,$regulator,$deadline,$tipe,$file_upload,$dibuat_oleh,
        $dibuat_tanggal,$diedit_oleh,$diedit_tanggal){
        $data = array(
            'tahun'                => $tahun,
            'sha'                  => $sha_code,
            'tema_audit'           => $tema_audit,
            'id_divisi'            => $bagian_terkait,
            'data_temuan'          => $data_temuan,
            'id_kategori'          => $kategori_temuan,
            'rekomendasi_1'        => $rekomendasi_1,
            'status_monitoring_1'  => $status_monitoring_1,
            'rekomendasi_2'        => $rekomendasi_2,
            'status_monitoring_2'  => $status_monitoring_2,
            'rekomendasi_3'        => $rekomendasi_3,
            'status_monitoring_3'  => $status_monitoring_3,
            'rekomendasi_4'        => $rekomendasi_4,
            'status_monitoring_4'  => $status_monitoring_4,
            'rekomendasi_5'        => $rekomendasi_5,
            'status_monitoring_5'  => $status_monitoring_5,
            'rekomendasi_6'        => $rekomendasi_6,
            'status_monitoring_6'  => $status_monitoring_6,
            'rekomendasi_7'        => $rekomendasi_7,
            'status_monitoring_7'  => $status_monitoring_7,
            'rekomendasi_8'        => $rekomendasi_8,
            'status_monitoring_8'  => $status_monitoring_8,
            'rekomendasi_9'        => $rekomendasi_9,
            'status_monitoring_9'  => $status_monitoring_9,
            'rekomendasi_10'       => $rekomendasi_10,
            'status_monitoring_10' => $status_monitoring_10,
            'rpm_opt'              => $rpm_opt,
            'tanggapan_skai'       => $tanggapan_skai,
            'regulator'            => $regulator,
            'deadline'             => $deadline,
            'tipe'                 => $tipe,
            'upload'               => $file_upload,
            'dibuat_oleh'          => $dibuat_oleh,
            'dibuat_tanggal'       => $dibuat_tanggal,
            'diedit_oleh'          => $diedit_oleh,
            'diedit_tanggal'       => $diedit_tanggal
        );
        $this->db->insert('audit_baru',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_audit_eksternal($id_audit,$tahun,$tema_audit,$bagian,$data_temuan,
        $rekomendasi_1,$status_monitoring_1,$rekomendasi_2,$status_monitoring_2,
        $rekomendasi_3,$status_monitoring_3,$rekomendasi_4,$status_monitoring_4,
        $rekomendasi_5,$status_monitoring_5,$rekomendasi_6,$status_monitoring_6,
        $rekomendasi_7,$status_monitoring_7,$rekomendasi_8,$status_monitoring_8,
        $rekomendasi_9,$status_monitoring_9,$rekomendasi_10,$status_monitoring_10,
        $rpm_opt,$regulator,$deadline,$file_upload,$diedit_oleh,$diedit_tanggal){
        $data=array(
                        'tahun'                => $tahun,
                        'tema_audit'           => $tema_audit,
                        'id_divisi'            => $bagian,
                        'data_temuan'          => $data_temuan,
                        'rekomendasi_1'        => $rekomendasi_1,
                        'status_monitoring_1'  => $status_monitoring_1,
                        'rekomendasi_2'        => $rekomendasi_2,
                        'status_monitoring_2'  => $status_monitoring_2,
                        'rekomendasi_3'        => $rekomendasi_3,
                        'status_monitoring_3'  => $status_monitoring_3,
                        'rekomendasi_4'        => $rekomendasi_4,
                        'status_monitoring_4'  => $status_monitoring_4,
                        'rekomendasi_5'        => $rekomendasi_5,
                        'status_monitoring_5'  => $status_monitoring_5,
                        'rekomendasi_6'        => $rekomendasi_6,
                        'status_monitoring_6'  => $status_monitoring_6,
                        'rekomendasi_7'        => $rekomendasi_7,
                        'status_monitoring_7'  => $status_monitoring_7,
                        'rekomendasi_8'        => $rekomendasi_8,
                        'status_monitoring_8'  => $status_monitoring_8,
                        'rekomendasi_9'        => $rekomendasi_9,
                        'status_monitoring_9'  => $status_monitoring_9,
                        'rekomendasi_10'       => $rekomendasi_10,
                        'status_monitoring_10' => $status_monitoring_10,
                        'rpm_opt'              => $rpm_opt,
                        'regulator'            => $regulator,
                        'deadline'             => $deadline,
                        'upload'               => $file_upload,
                        'diedit_oleh'          => $diedit_oleh,
                        'diedit_tanggal'       => $diedit_tanggal
                    );
        $this->db->where('id_audit', $id_audit);
        $this->db->update('audit_baru', $data);
        return true;
    }

    public function hapus_audit_eksternal($id_audit){
        $this->db->where('id_audit', $id_audit);
        $this->db->delete('audit_baru'); 
        return true;
    }

    public function download_file_eksternal($params = array()){
        $this->db->select('*');
        $this->db->from('audit_baru');
        $this->db->where('id_audit',$params['id_audit']);
        $query  = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        return $result;
    }
}