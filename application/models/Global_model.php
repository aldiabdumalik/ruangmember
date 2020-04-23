<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Global_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function insert($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function insert_data_batch($table,$data)
	{
		$this->db->insert_batch($table, $data);
	}

	public function update($table, $data, $id, $where)
	{
		$this->db->where($id, $where);
		$this->db->update($table, $data);
	}

	public function delete($table,$id,$where)
	{
		$this->db->where($id, $where);
		$this->db->delete($table);
	}

	public function getOneSpesificWhere($select,$where,$table){
		return $this->db->select($select)->where($where)->get($table)->row();
	}

	public function getBanyakSpesificWhere($select,$where,$table){
		return $this->db->select($select)->where($where)->get($table)->result();
	}

	public function getOneWhere($where,$table){
		return $this->db->where($where)->get($table)->row();
	}

	public function getJoinTable($id)
	{
		$this->db->join('t_image_marketing', 't_image_marketing.idMarketing = t_marketing_plan.idMarketing', 'left');
		$this->db->where('t_image_marketing.idMarketing', $id);
		return $this->db->get('t_marketing_plan')->result();
	}

	public function update_new($table, $data, $where)
	{
		$this->db->update($table, $data, $where);
		return true;
	}

	public function get_admin($where)
	{
		return
			$this->db->get_where('t_user', $where)
			->row();
	}

}

/* End of file Global_model.php */
/* Location: ./application/models/Global_model.php */