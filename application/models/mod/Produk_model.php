<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

	var $table = 't_produk'; //nama tabel dari database
    var $column_order = array(null,'idProduk','fotoProduk','namaProduk','deskripsiProduk','hargaProduk','stokProduk'); //field yang ada di table user
    var $column_search = array('namaProduk'); //field yang diizin untuk pencarian 
    var $order = array('namaProduk' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
	}

	private function _get_datatables_query()
    {
     	$this->db->select('*');
        $this->db->from($this->table);	
        $this->db->where('parentProduk', '0');
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

    public function getProdukForSelect()
    {
        $where = array(
            'parentProduk' => '0',
            'kategoriProduk' => 'retail'
        );
        $this->db->select('idProduk, parentProduk, namaProduk, kategoriProduk');
        $this->db->from('t_produk');
        $this->db->where($where);
        $this->db->order_by('namaProduk', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_produk($data)
    {
        $this->db->insert('t_produk', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function get_byId($where)
    {
        $this->db->select('idProduk, parentProduk, namaProduk, kategoriProduk');
        $this->db->from('t_produk');
        $this->db->where($where);
        $this->db->order_by('namaProduk', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function produk_cek($namaProduk, $parent)
    {
        $where = "parentProduk = '". $parent ."' AND (kategoriProduk = 'reguler' OR kategoriProduk = 'ft')";
        $this->db->select('idProduk, parentProduk, namaProduk, stokProduk, kategoriProduk');
        $this->db->from('t_produk');
        $this->db->like('namaProduk', $namaProduk, 'BOTH');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function delete_produk($id)
    {
        $this->db->where('idProduk', $id);
        $this->db->or_where('parentProduk', $id);

        $this->db->delete('t_produk');
        return true;
    }

}

/* End of file Produk_model.php */
/* Location: ./application/models/mod/Produk_model.php */