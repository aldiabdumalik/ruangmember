<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Infopertemuan_model extends CI_Model {

	var $table = 't_info_pertemuan'; //nama tabel dari database
    var $column_order = array(null,'idPertemuan','tanggalPertemuan','namaPertemuan','tempatPertemuan','guestSpeaker','houseCouple','noWa'); //field yang ada di table user
    var $column_search = array('idPertemuan','tanggalPertemuan','namaPertemuan','tempatPertemuan','guestSpeaker','houseCouple','noWa'); //field yang diizin untuk pencarian 
    var $order = array('idPertemuan' => 'desc'); // default order 

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

    function getPages($searchTerm=""){

     // Fetch users
     $this->db->select('*');
     $this->db->where("nama_sales like '%".$searchTerm."%' ");
     $this->db->limit(5);
     $fetched_records = $this->db->get('t_sales');
     $users = $fetched_records->result_array();

     // Initialize Array with fetched data
     $data = array();
     foreach($users as $user){
        $data[] = array("id"=>$user['id_plm'], "text"=>$user['nama_sales']);
     }
     return $data;
  }

  public function getJoinInfo($id)
  {
    $this->db->select('*');
    $this->db->where('t_info_pertemuan.idPertemuan', $id);
    return $this->db->get('t_info_pertemuan')->row_array();
  }

  public function getSales()
  {
    return $this->db->get('t_sales')->result_array();
  }

}

/* End of file Produk_model.php */
/* Location: ./application/models/mod/Produk_model.php */