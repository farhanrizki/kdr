<?php 
  
class M_app_server extends CI_Model
{   
    var $list_app        = 'list_app';
    var $column_list_app = array('nama_app','bia_app');
    var $order_list_app  = array('id_list_app' => 'desc');

    var $list_server        = 'list_server';
    var $column_list_server = array('ip_server','nama_server','jenis_server');
    var $order_list_server  = array('id_list_server' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Untuk List App
    private function _get_query_list_app()
    {
        $this->db->from($this->list_app);
        $i = 0;
    
        foreach ($this->column_list_app as $item) 
        {
            if($_POST['search']['value'])
                ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $column_list_app[$i] = $item;
            $i++;
        }
        
        if(isset($_POST['order']))
        {
            $this->db->order_by($column_list_app[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_list_app))
        {
            $order_list_app = $this->order_list_app;
            $this->db->order_by(key($order_list_app), $order_list_app[key($order_list_app)]);
        }
    }

    function get_list_app()
    {
        $this->_get_query_list_app();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_list_app()
    {
        $this->_get_query_list_app();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_list_app()
    {
        $this->db->from($this->list_app);
        return $this->db->count_all_results();
    }

    public function get_id_list_app($id_list_app)
    {
        $this->db->from($this->list_app);
        $this->db->where('id_list_app',$id_list_app);
        $query = $this->db->get();
        return $query->row();
    }

    public function detail_list_app($id_list_app)
    {
        $query = $this->db->query("SELECT lap.nama_app,lis.ip_server,lis.nama_server,
                 lis.jenis_server FROM app_server app
                 JOIN list_app lap ON lap.id_list_app = app.id_app
                 JOIN list_server lis ON lis.id_list_server = app.id_server
                 WHERE lap.id_list_app = '$id_list_app'");
        return $query->result();
    }

    public function detail_list_app2($ip_server)
    {
        $query = $this->db->query("SELECT lap.nama_app,lis.ip_server,lis.nama_server,
                 lis.jenis_server FROM app_server app
                 JOIN list_app lap ON lap.id_list_app = app.id_app
                 JOIN list_server lis ON lis.id_list_server = app.id_server
                 WHERE lis.ip_server = '$ip_server'");
        return $query->result_array();
    }

    public function update_list_app($where, $data)
    {
        $this->db->update($this->list_app, $data, $where);
        return $this->db->affected_rows();
    }

    //Get data app server pas delete app
    public function select1($id_app)
    {
        $query = $this->db->query("SELECT * FROM app_server WHERE id_app=$id_app");
        return $query->result_array();
    }

    public function select2($id_server)
    {
        $query = $this->db->query("SELECT * FROM app_server app
                 JOIN list_app lap ON lap.id_list_app=app.id_app
                 WHERE app.id_server IN ($id_server)");
        return $query->result_array();
    }

    public function get_server($id_server,$id_app)
    {
        $query = $this->db->query("SELECT * FROM app_server app
                 JOIN list_app lap ON lap.id_list_app=app.id_app
                 WHERE app.id_server IN ($id_server)
                 AND app.id_app IN ($id_app)");
        return $query->result_array();
    }    

    public function delete_maping($id_app_server)
    {
        $query = $this->db->query("DELETE FROM app_server WHERE id_app_server IN ($id_app_server)");
    }

    public function delete_server($id_list_server)
    {
        $query = $this->db->query("DELETE FROM list_server WHERE id_list_server IN ($id_list_server)");
    }

    public function delete_app($id_list_app)
    {
        $query = $this->db->query("DELETE FROM list_app WHERE id_list_app IN ($id_list_app)");
    }

    public function delete_current_risk($id_app_server)
    {
        $query = $this->db->query("DELETE FROM current_risk WHERE id_app_server IN ($id_app_server)");
    }
    //End List App

    //Untuk List Server 
    private function _get_query_list_server()
    {
        $this->db->from($this->list_server);
        $i = 0;
    
        foreach ($this->column_list_server as $item) 
        {
            if($_POST['search']['value'])
                ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $column_list_server[$i] = $item;
            $i++;
        }
        
        if(isset($_POST['order']))
        {
            $this->db->order_by($column_list_server[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_list_server))
        {
            $order_list_server = $this->order_list_server;
            $this->db->order_by(key($order_list_server), $order_list_server[key($order_list_server)]);
        }
    }

    function get_list_server()
    {
        $this->_get_query_list_server();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_list_server()
    {
        $this->_get_query_list_server();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_list_server()
    {
        $this->db->from($this->list_server);
        return $this->db->count_all_results();
    }

    public function get_id_list_server($id_list_server)
    {
        $this->db->from($this->list_server);
        $this->db->where('id_list_server',$id_list_server);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_list_server($where, $data)
    {
        $this->db->update($this->list_server, $data, $where);
        return $this->db->affected_rows();
    }
    
    //Get data app server pas delete server
    public function select4($id_server)
    {
        $query = $this->db->query("SELECT * FROM app_server app
                 JOIN list_app lap ON lap.id_list_app=app.id_app
                 WHERE app.id_server IN($id_server)");
        return $query->result_array();
    }

    public function select5($id_app_server)
    {
        $query = $this->db->query("SELECT * FROM app_server
                 WHERE id_app_server IN($id_app_server)");
        return $query->result_array();
    }


    //Tambah App Server
    public function get_nama_app($nama_app)
    {
        if($nama_app == "")
        {
            $filter = "";
        }
        else
        {
            $filter = "WHERE nama_app='$nama_app'";
        }
        $sql = "SELECT nama_app FROM list_app $filter";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_ip_server($nama_aplikasi)
    {
        $hasil = $this->db->query("SELECT lis.ip_server FROM app_server app
                 JOIN list_server lis JOIN list_app lap
                 WHERE app.id_app=lap.id_list_app AND app.id_server=lis.id_list_server
                 AND lap.nama_app='$nama_aplikasi' AND lis.jenis_server='aplikasi' 
                 GROUP BY lis.id_list_server");
        return $hasil->result();
    }

    public function get_ip_db($nama_aplikasi)
    {
        $hasil = $this->db->query("SELECT lis.ip_server FROM app_server app
                 JOIN list_server lis JOIN list_app lap
                 WHERE app.id_app=lap.id_list_app AND app.id_server=lis.id_list_server
                 AND lap.nama_app='$nama_aplikasi' AND lis.jenis_server='db' 
                 GROUP BY lis.id_list_server");
        return $hasil->result();
    }

    public function get_bia_app($nama_aplikasi)
    {
        $sql   = "SELECT bia_app FROM list_app WHERE nama_app='$nama_aplikasi'";
        $query = $this->db->query($sql);
        if($query->num_rows() == 0)
        {
            return "0";
        }
        else
        {
            return $query->result();
        }
    }

    public function cek_list_app($nama_app)
    {
        $this->db->select('nama_app');    
        $this->db->from('list_app');
        $this->db->where('nama_app', $nama_app);
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

    public function cek_list_server_aplikasi($ip_server)
    {
        $this->db->select('ip_server');    
        $this->db->from('list_server');
        $this->db->where('ip_server', $ip_server);
        $this->db->where('jenis_server', 'aplikasi');
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

    public function cek_list_server_db($ip_server)
    {
        $this->db->select('ip_server');    
        $this->db->from('list_server');
        $this->db->where('ip_server', $ip_server);
        $this->db->where('jenis_server', 'db');
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

    public function cek_app_server($id_app,$id_server)
    {
        $this->db->select('id_app');    
        $this->db->from('app_server');
        $this->db->where('id_app', $id_app);
        $this->db->where('id_server', $id_server);
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

    public function cek_id_server($id_server)
    {
        $this->db->select('id_server');    
        $this->db->from('app_server');
        $this->db->where('id_server', $id_server);
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

    public function get_request_id_app($nama_app)
    {
        $sql = "SELECT id_list_app FROM list_app WHERE nama_app='$nama_app'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }    

    public function get_request_id_aplikasi($ip_server)
    {
        $sql   = "SELECT id_list_server FROM list_server WHERE ip_server='$ip_server' AND jenis_server='aplikasi'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function get_request_id_db($ip_server)
    {
        $sql   = "SELECT id_list_server FROM list_server WHERE ip_server='$ip_server' AND jenis_server='db'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function simpan_list_app($nama_app,$bia_app)
    {
        $data = array(
                        'nama_app' => $nama_app,
                        'bia_app'  => $bia_app
                    );
        $this->db->insert('list_app',$data);
        $id_app   = $this->db->insert_id();

        return array(
            'true'     => true,
            'id_app'   => $id_app
        );
    }

    public function simpan_list_server_aplikasi($ip_server,$nama_app)
    {
        $data = array(
                    'ip_server'    => $ip_server,
                    'nama_server'  => $nama_app,
                    'jenis_server' => "aplikasi"
                );
        $this->db->insert('list_server',$data);
        $id_aplikasi = $this->db->insert_id();

        return array(
            'true'        => true,
            'id_aplikasi' => $id_aplikasi
        );
    }

    public function simpan_list_server_db($db_server,$nama_app)
    {
        $data = array(
                    'ip_server'    => $db_server,
                    'nama_server'  => $nama_app,
                    'jenis_server' => "db"
                );
        $this->db->insert('list_server',$data);
        $id_db = $this->db->insert_id();

        return array(
            'true'  => true,
            'id_db' => $id_db
        );
    }

    public function simpan_appserver($id_app,$id_server)
    {
        $data = array(
                    'id_app'    => $id_app,
                    'id_server' => $id_server
                );
        $this->db->insert('app_server',$data);
        return true;
    }
}