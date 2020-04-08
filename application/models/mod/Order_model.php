<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

	var $table = 'order_id'; //nama tabel dari database
    var $column_order = array(null,'order_id.id_order','nama_sales','total_order','tgl_order','foto_bukti','order_status','id_bank'); //field yang ada di table user
    var $column_search = array('order_id.id_order','nama_sales','total_order','tgl_order','foto_bukti','order_status'); //field yang diizin untuk pencarian 
    var $order = array('order_id.id_order' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
	}

	private function _get_datatables_query()
    {
     	$this->db->select('*');
        $this->db->join('t_sales', 't_sales.id_plm = order_id.id_plm', 'left');
        $this->db->join('order_detail_consumer', 'order_detail_consumer.id_consumer = order_id.id_consumer', 'left');
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_order_view($idorder)
    {
        $this->db->join('order_id', 'order_id.id_order = order_detail.id_order', 'left');
        $this->db->join('t_sales', 't_sales.id_plm = order_id.id_plm', 'left');
        $this->db->join('order_detail_consumer', 'order_detail_consumer.id_consumer = order_id.id_consumer', 'left');
        $this->db->join('t_bank', 't_bank.id_bank = order_id.id_bank', 'left');
        $this->db->join('t_produk', 't_produk.idProduk = order_detail.idProduk', 'left');
        $this->db->where('order_detail.id_order', $idorder);
        // $this->db->like('order_detail.id_order', $idorder, 'BOTH');
        return $this->db->get('order_detail')->result();
    }


}

/* End of file Produk_model.php */
/* Location: ./application/models/mod/Produk_model.php */