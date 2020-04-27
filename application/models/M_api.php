<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_api extends CI_Model {

	function insert($table, $data)
	{
		$this->db->insert($table, $data);
		return true;
	}
	function update($table, $data)
	{
		$this->db->update($table, $data['data_update'], $data['where']);
		return true;
	}
	function delete($table, $data)
	{
		$this->db->delete($table, $data['where']);
		return true;
	}
	function get_sales($where)
	{
		$query = $this->db->get_where('t_sales', $where);
		return $query->row_array();
	}

	function login($id,$password)
	{
		$this->db->select('id_plm, status_sales');
		$query = $this->db->get_where('t_sales', ['id_plm' => $id, 'password_sales' => $password]);
		return $query->row_array();
	}

	function get_aktivasi($where)
	{
		$query = $this->db->get_where('t_sales_lupa', $where);
		return $query->row_array();
	}

	function get_promosi()
	{
		$query = $this->db->get('t_promosi');
		return $query->result_array();
	}

	function produk_all($where)
	{
		$this->db->select('idProduk, parentProduk, namaProduk, stokProduk, hargaProduk, fotoProduk, kategoriProduk');
		$this->db->order_by('namaProduk', 'asc');
		$query = $this->db->get_where('t_produk', $where);
		return $query->result_array();
	}

	function produk_byid($where)
	{
		$query = $this->db->get_where('t_produk', $where);
		return $query->row_array();
	}

	function sales_byid($where)
	{
		$this->db->select('id_plm, nama_sales, nowa_sales, status_sales');
		$query = $this->db->get_where('t_sales', $where);
		return $query->row_array();
	}

	function bank_byid($where)
	{
		$query = $this->db->get_where('t_sales_bank', $where);
		return $query->row_array();
	}

	function pertemuan()
	{
		$this->db->order_by('tanggalPertemuan', 'desc');
		$query = $this->db->get('t_info_pertemuan');
		return $query->result_array();
	}

	function flip_all()
	{
		$query = $this->db->get('t_flip_chart');
		return $query->result_array();
	}

	function flip($page)
	{
		$limit = 5;
		$offset = $page*$limit;
		$query = $this->db->get('t_flip_chart', $limit, $offset);
		return $query->result_array();
	}

	function persentasi_satandar()
	{
		$query = $this->db->get('t_persentasi_standar');
		return $query->row_array();
	}

	function persentasi($where=NULL)
	{
		if ($where!==null) {
			$query = $this->db->get_where('t_persentasi', $where);
			return $query->row_array();
		}else{
			$query = $this->db->get('t_persentasi');
			return $query->result_array();
		}
	}

	function basic_pack($where=NULL)
	{
		if ($where!==null) {
			$query = $this->db->get_where('t_basic_pack', $where);
			return $query->row_array();
		}else{
			$query = $this->db->get('t_basic_pack');
			return $query->result_array();
		}
	}

	function plan_des()
	{
		$query = $this->db->get('t_marketing_new');
		return $query->result_array();
	}

	function plan_img($where)
	{
		$query = $this->db->get_where('t_image_marketing', $where);
		return $query->result_array();
	}

	function testimoni($where=NULL)
	{
		if ($where!==null) {
			$query = $this->db->get_where('t_testimoni', $where);
			return $query->row_array();
		}else{
			$query = $this->db->get('t_testimoni');
			return $query->result_array();
		}
	}

	function cek_cart($where)
	{
		$query = $this->db->get_where('order_cart', $where);
		return $query->row_array();
	}
	function cek_cart2($where)
	{
		$query = $this->db->get_where('order_cart', $where);
		return $query->result_array();
	}

	function update_cart($data, $where)
	{
		$query = $this->db->update('order_cart', $data, $where);
		return true;
	}

	function cart_get($where)
	{
		$this->db->select('t_produk.namaProduk, t_produk.hargaProduk, t_produk.stokProduk, order_cart.*');
		$this->db->join('t_produk', 't_produk.idProduk = order_cart.idProduk', 'left');
		$query = $this->db->get_where('order_cart', $where);
		return $query->result_array();
	}

	function cart_get_total($where)
	{
		$this->db->select('SUM(order_cart.total_cart) as total_bayar');
		$query = $this->db->get_where('order_cart', $where);
		return $query->row_array();
	}

	function delete_new($table, $where)
	{
		$this->db->delete($table, $where);
		return true;
	}

	function get_pin($where)
	{
		$query = $this->db->get_where('t_pin', $where);
		return $query->row_array();
	}
	function get_pin_order($where)
	{
		$query = $this->db->get_where('order_id', $where);
		return $query->row_array();
	}

	function get_order_join($where)
	{
		$this->db->select('order_id.*, order_detail_consumer.*, order_detail.*, t_sales.id_plm, t_sales.nama_sales, t_produk.idProduk, t_produk.namaProduk, t_produk.hargaProduk');
		$this->db->from('order_id');
		$this->db->join('order_detail_consumer', 'order_detail_consumer.id_consumer = order_id.id_consumer', 'left');
		$this->db->join('order_detail', 'order_detail.id_order = order_id.id_order', 'left');
		$this->db->join('t_produk', 't_produk.idProduk = order_detail.idProduk', 'left');
		$this->db->join('t_sales', 't_sales.id_plm = order_id.id_plm', 'left');
		$this->db->where($where);
		$this->db->group_by('order_id.id_order');
		$query = $this->db->get();
		return $query->result_array();
	}

	function upload_bukti($data, $where)
	{
		$this->db->update('order_id', $data, $where);
		return true;
	}

	function update_stock($data, $where)
	{
		$this->db->update('t_produk', $data, $where);
		return true;
	}

	function bank_admin($where=NULL)
	{
		if ($where!==null) {
			$query = $this->db->get_where('t_bank', $where);
			return $query->row_array();
		}else{
			$query = $this->db->get('t_bank');
			return $query->result_array();
		}
	}

	function get_provinsi()
	{
		$this->db->order_by('provinsi', 'asc');
		$query = $this->db->get('m_provinsi');
		return $query->result_array();
	}

	function get_kota($where)
	{
		$this->db->order_by('kota', 'asc');
		$query = $this->db->get_where('m_kota', $where);
		return $query->result_array();
	}

	function get_consumer($where=NULL)
	{
		if ($where!==null) {
			$query = $this->db->get_where('order_detail_consumer', $where);
			return $query->row_array();
		}else{
			$query = $this->db->get('order_detail_consumer');
			return $query->result_array();
		}
	}
	function get_consumer_new($where)
	{
		$query = $this->db->get_where('order_detail_consumer', $where);
		return $query->result_array();
	}

	function get_report($page=0, $where=null)
	{
		$limit = 5;
		$offset = $page*$limit;
		$this->db->select('order_id.*, order_detail_consumer.*');
		$this->db->from('order_id');
		$this->db->join('order_detail_consumer', 'order_detail_consumer.id_consumer = order_id.id_consumer', 'left');
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by('order_id.tgl_order', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_report_all($where)
	{
		$this->db->select('order_id.*, order_detail_consumer.*');
		$this->db->from('order_id');
		$this->db->join('order_detail_consumer', 'order_detail_consumer.id_consumer = order_id.id_consumer', 'left');
		$this->db->where($where);
		$this->db->order_by('order_id.tgl_order', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	function search_report($text=null, $date=null, $status, $id)
	{
		if ($text != null && $date != null) {
			$where = "
				order_id.order_status = '${status}' AND order_id.id_plm = '${id}' AND order_detail_consumer.nama_penerima LIKE '%${text}%' AND order_id.tgl_order LIKE '%${date}%'
			";
		}elseif ($text != null && $date == null) {
			$where = "
				order_id.order_status = '${status}' AND order_id.id_plm = '${id}' AND order_detail_consumer.nama_penerima LIKE '%${text}%'
			";
		}else{
			$where = "
				order_id.order_status = '${status}' AND order_id.id_plm = '${id}' AND order_id.tgl_order LIKE '%${date}%'
			";
		}
		$this->db->select('order_id.*, order_detail_consumer.*');
		$this->db->from('order_id');
		$this->db->join('order_detail_consumer', 'order_detail_consumer.id_consumer = order_id.id_consumer', 'left');
		$this->db->where($where);
		$this->db->order_by('order_id.tgl_order', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_report_detail($where)
	{
		$this->db->select('order_id.*, order_detail.*, t_produk.idProduk, order_detail_consumer.*, t_produk.namaProduk, t_produk.hargaProduk');
		$this->db->from('order_id');
		$this->db->join('order_detail_consumer', 'order_detail_consumer.id_consumer = order_id.id_consumer', 'left');
		$this->db->join('order_detail', 'order_detail.id_order = order_id.id_order', 'left');
		$this->db->join('t_produk', 't_produk.idProduk = order_detail.idProduk', 'left');
		$this->db->where($where);
		$this->db->order_by('t_produk.namaProduk', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}
	function pin_order($where)
	{
		$query = $this->db->get_where('order_id', $where);
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
	function pin_rand()
	{
		$this->db->select('pin');
		$this->db->from('t_pin');
		$this->db->order_by('rand()');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array();
	}
}

/* End of file M_api.php */
/* Location: ./application/models/M_api.php */