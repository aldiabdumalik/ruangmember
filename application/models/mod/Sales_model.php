<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_model extends CI_Model {

	var $table = 't_sales'; //nama tabel dari database
    var $column_order = array(null,'id_plm','nama_sales','nowa_sales','status_sales'); //field yang ada di table user
    var $column_search = array('id_plm','nama_sales','nowa_sales','status_sales'); //field yang diizin untuk pencarian 
    var $order = array('id_plm' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
	}

	private function _get_datatables_query()
    {
     	$this->db->select('*');
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


    public function get_sales_with_bank($where)
    {
        $this->db->join('t_sales_bank', 't_sales_bank.id_plm = t_sales.id_plm', 'left');
        $this->db->where($where);
        $query = $this->db->get('t_sales');
        return $query->row_array();
    }

    function get_bonus_where($where)
    {
        $this->db->select('order_bonus.*, order_id.*, SUM(order_bonus.bonus) AS komisi');
        $this->db->from('order_bonus');
        $this->db->join('order_id', 'order_id.id_order = order_bonus.id_order', 'left');
        $this->db->where($where);
        $this->db->group_by('order_id.id_order');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_bonus_where_total($where)
    {
        $this->db->select('TRUNCATE((SUM(bonus) - SUM(bonus) * 0.1), 0) as total_bonus');
        $this->db->from('order_bonus');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row_array();
    }

}

/* End of file Produk_model.php */
/* Location: ./application/models/mod/Produk_model.php */