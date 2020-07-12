<?php 
  
class M_libur extends CI_Model
{	
    var $tanggal_libur        = 'tanggal_libur';
    var $column_tanggal_libur = array('tgl_libur');
    var $order_tanggal_libur  = array('id_tgl_libur' => 'desc');

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_query_hari_libur()
    {
        $this->db->from($this->tanggal_libur);
        $i = 0;
    
        foreach ($this->column_tanggal_libur as $item) 
        {
            if($_POST['search']['value'])
                ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $column_tanggal_libur[$i] = $item;
            $i++;
        }
        
        if(isset($_POST['order']))
        {
            $this->db->order_by($column_tanggal_libur[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_tanggal_libur))
        {
            $order_tanggal_libur = $this->order_tanggal_libur;
            $this->db->order_by(key($order_tanggal_libur), $order_tanggal_libur[key($order_tanggal_libur)]);
        }
    }

    function get_hari_libur()
    {
        $this->_get_query_hari_libur();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_libur()
    {
        $this->_get_query_hari_libur();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_libur()
    {
        $this->db->from($this->tanggal_libur);
        return $this->db->count_all_results();
    }

    public function get_id_tgl_libur($id_tgl_libur)
    {
        $this->db->from($this->tanggal_libur);
        $this->db->where('id_tgl_libur',$id_tgl_libur);
        $query = $this->db->get();

        return $query->row();
    }

    public function update_hari_libur($where, $data)
    {
        $this->db->update($this->tanggal_libur, $data, $where);
        return $this->db->affected_rows();
    }

    public function simpan_libur($tgl_libur)
    {
        $query_simpan = "INSERT INTO tanggal_libur (tgl_libur) VALUES $tgl_libur";
        $simpan = $this->db->query($query_simpan);
        return true;
    }

}
