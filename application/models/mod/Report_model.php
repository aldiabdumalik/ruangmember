<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

	function get_report($where)
	{
		$this->db->select('*');
		$this->db->from('order_id');
		$this->db->join('order_detail_consumer', 'order_detail_consumer.id_consumer = order_id.id_consumer', 'left');
		$this->db->join('t_sales', 't_sales.id_plm = t_sales.id_plm', 'left');
		$this->db->join('t_bank', 't_bank.id_bank = order_id.id_bank', 'left');
		$this->db->where($where);
		$q = $this->db->get();
		return $q->result_array();
	}

}

/* End of file Report_model.php */
/* Location: ./application/models/mod/Report_model.php */