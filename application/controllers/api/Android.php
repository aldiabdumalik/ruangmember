<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Android extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$this->load->model('M_api', 'api');
		$this->load->library('tools');
	}

	public function index_get()
	{
		
	}

	public function cekpin_post()
	{
		$sales = $this->api->sales_byid(['id_plm' => $this->post('idSales')]);
		$pin = $this->api->get_pin(['pin' => $this->post('pin')]);
		if (isset($pin)) {
			if (isset($sales)) {
				if ($sales['status_sales'] == 0) {
					$data = [
						'data_update' => [
							'status_sales' => 1
						],
						'where' => [
							'id_plm' => $this->post('idSales')
						]
					];
					$update = $this->api->update('t_sales', $data);
					$sales = $this->api->sales_byid(['id_plm' => $this->post('idSales')]);
				}
				$this->response([
					'status' => TRUE,
					'message' => 'Berhasil masuk. Tunggu beberapa saat...',
					'data' => $sales
				], REST_Controller::HTTP_OK);
			}else{
				$this->response([
					'status' => FALSE,
					'message' => 'Maaf anda belum terdaftar'
				], REST_Controller::HTTP_OK);
			}
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Maaf pin yang anda masukan salah'
			], REST_Controller::HTTP_OK);
		}
	}

	public function sales_get()
	{
		$result = $this->api->sales_byid(['id_plm' => $this->get('idSales')]);
		if (isset($result)) {
			$this->response([
				'status' => TRUE,
				'data' => $result
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Data tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}

	public function sales_post()
	{
		$data = [
			'data_update' => [
				'nama_sales' => $this->post('profile-nama'),
				'nowa_sales' => $this->tools->ubah_nohp($this->post('profile-nowa'))
			],
			'where' => [
				'id_plm' => $this->post('profile-id')
			]
		];
		$update = $this->api->update('t_sales', $data);
		if ($update) {
			$this->response([
				'status' => TRUE,
				'message' => 'Data berhasil di perbaharui'
			], REST_Controller::HTTP_CREATED);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Maaf data gagal di perbaharui. Silahkan coba beberapa saat lagi'
			], REST_Controller::HTTP_OK);
		}
	}

	public function bank_post()
	{
		$cek = $this->api->bank_byid(['id_plm' => $this->post('id_plm')]);
		if (empty($cek)) {
			$data = [
				'id_plm' => $this->post('id_plm'),
				'nama_bank' => $this->post('nama_bank'),
				'norek_bank' => $this->post('norek_bank'),
				'an_bank' => $this->post('an_bank'),
				'tgl_input' => date('Y-m-d H:i:s')
			];
			$insert = $this->api->insert('t_sales_bank', $data);
			if ($insert) {
				$this->response([
					'status' => TRUE,
					'message' => 'Anda berhasil menambahkan nomor rekening'
				], REST_Controller::HTTP_CREATED);
			}else{
				$this->response([
					'status' => FALSE,
					'message' => 'Maaf data gagal ditambahkan. Silahkan coba beberapa saat lagi'
				], REST_Controller::HTTP_OK);
			}
		}else{
			$data = [
				'id_plm' => $this->post('id_plm'),
				'nama_bank' => $this->post('nama_bank'),
				'norek_bank' => $this->post('norek_bank'),
				'an_bank' => $this->post('an_bank'),
				'tgl_input' => date('Y-m-d H:i:s')
			];
			$this->db->delete('t_sales_bank', ['id_plm' => $this->post('id_plm')]);
			$insert = $this->api->insert('t_sales_bank', $data);
			if ($insert) {
				$this->response([
					'status' => TRUE,
					'message' => 'Anda berhasil menambahkan nomor rekening'
				], REST_Controller::HTTP_CREATED);
			}else{
				$this->response([
					'status' => FALSE,
					'message' => 'Maaf data gagal ditambahkan. Silahkan coba beberapa saat lagi'
				], REST_Controller::HTTP_OK);
			}
		}
	}

	public function bank_get()
	{
		$result = $this->api->bank_byid(['id_plm' => $this->get('idSales')]);
		if (isset($result)) {
			$this->response([
				'status' => TRUE,
				'data' => $result
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Data tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}

	public function persentasi_get()
	{
		if (empty($this->get('idPersentasi'))) {
			$result = $this->api->persentasi();
		}else{
			$result = $this->api->persentasi(['idPersentasi' => $this->get('idPersentasi')]);
		}
		if (isset($result)) {
			$this->response([
				'status' => TRUE,
				'data' => $result
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Data tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}

	public function standar_get()
	{
		$result = $this->api->persentasi_satandar();
		if (isset($result)) {
			$this->response([
				'status' => TRUE,
				'data' => $result
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Data tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}

	public function basicpack_get()
	{
		if (empty($this->get('idBasicPack'))) {
			$result = $this->api->basic_pack();
		}else{
			$result = $this->api->basic_pack(['idBasicPack' => $this->get('idBasicPack')]);
		}
		if (isset($result)) {
			$this->response([
				'status' => TRUE,
				'data' => $result
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Data tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}

	

	public function testimoni_get()
	{
		if (empty($this->get('idTestimoni'))) {
			$result = $this->api->testimoni();
		}else{
			$result = $this->api->testimoni(['idTestimoni' => $this->get('idTestimoni')]);
		}
		if (isset($result)) {
			$this->response([
				'status' => TRUE,
				'data' => $result
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Data tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}

	// public function cart_get()
	// {
	// 	if (empty($this->get('idCart'))) {
	// 		$result = $this->api->cart_get(['id_plm' => $this->get('id_plm')]);
	// 		$result2 = $this->api->cart_get_total(['id_plm' => $this->get('id_plm')]);
	// 		if (!empty($result)) {
	// 			$this->response([
	// 				'status' => TRUE,
	// 				'data' => $result,
	// 				'total' => $result2
	// 			], REST_Controller::HTTP_OK);
	// 		}else{
	// 			$this->response([
	// 				'status' => FALSE,
	// 				'message' => 'Belum ada orderan, silahkan tambah order'
	// 			], REST_Controller::HTTP_OK);
	// 		}
	// 	}else{
	// 		$result = $this->api->cek_cart(['id_cart' => $this->get('idCart')]);
	// 		if (!empty($result)) {
	// 			$this->response([
	// 				'status' => TRUE,
	// 				'data' => $result
	// 			], REST_Controller::HTTP_OK);
	// 		}else{
	// 			$this->response([
	// 				'status' => FALSE,
	// 				'message' => 'Orderan tidak ditemukan'
	// 			], REST_Controller::HTTP_OK);
	// 		}
	// 	}
	// }

	public function cartedit_post()
	{
		$delete = $this->api->delete_new('order_cart', ['id_cart' => $this->post('idCart')]);
		if ($delete) {
			$data = [
				'id_plm' => $this->post('id_plm'),
				'idProduk' => $this->post('idProduk'),
				'qty_cart' => $this->post('qty_cart'),
				'total_cart' => $this->post('total_cart'),
				'tgl_cart' => date('Y-m-d H:i:s')
			];
			$cek = $this->api->cek_cart(['id_plm' => $data['id_plm'], 'idProduk' => $data['idProduk']]);
			if (empty($cek)) {
				$insert = $this->api->insert('order_cart', $data);
			}else{
				$update = [
					'qty_cart' => $this->post('qty_cart') + $cek['qty_cart'],
					'total_cart' => $this->post('total_cart') + $cek['total_cart']
				];
				$insert = $this->api->update_cart($update, ['id_plm' => $data['id_plm'], 'idProduk' => $data['idProduk']]);
			}
			if ($insert) {
				$this->response([
					'status' => TRUE,
					'message' => 'Produk ditambahkan ke dalam Keranjang'
				], REST_Controller::HTTP_CREATED);
			}else{
				$this->response([
					'status' => FALSE,
					'message' => 'Produk gagal ditambahkan silahkan ulangi beberapa saat lagi.'
				], REST_Controller::HTTP_OK);
			}
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Permintaan Gagal, Ulangi beberapa saat lagi'
			], REST_Controller::HTTP_OK);
		}
	}

	public function cartdelete_post()
	{
		$where = [
			'id_cart' => $this->post('idCart')
		];
		$delete = $this->api->delete_new('order_cart', $where);
		if ($delete) {
			$this->response([
				'status' => TRUE,
				'message' => 'Berhasil menghapus...'
			], REST_Controller::HTTP_CREATED);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Gagal menghapus coba beberapa saat lagi oke...'
			], REST_Controller::HTTP_OK);
		}
	}

	public function cartdeleteall_post()
	{
		$where = [
			'id_plm' => $this->post('id_plm')
		];
		$delete = $this->api->delete_new('order_cart', $where);
		if ($delete) {
			$this->response([
				'status' => TRUE,
				'message' => 'Berhasil menghapus...'
			], REST_Controller::HTTP_CREATED);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Gagal menghapus coba beberapa saat lagi oke...'
			], REST_Controller::HTTP_OK);
		}
	}

	public function order_post()
	{
		$consumer = [
			'id_consumer' => date('Ymd').$this->tools->str_random(4),
			'nama_penerima' => $this->post('order_nama_penerima'),
			'alamat_penerima' => $this->post('order_alamat_penerima'),
			'nowa_penerima' => $this->tools->ubah_nohp($this->post('order_nowa_penerima')),
		];
		$insert_consumer = $this->api->insert('order_detail_consumer', $consumer);
		if ($insert_consumer) {
			$result_cart = $this->api->cart_get(['id_plm' => $this->post('id_plm')]);
			// $result_cart2 = $this->api->cart_get_total(['id_plm' => $this->post('id_plm')]);
			$order_id = [
				'id_order' => 'ORD'.date('Ymd').'/'.$this->post('id_plm').$this->tools->str_random(5),
				'id_plm' => $this->post('id_plm'),
				'id_consumer' => $consumer['id_consumer'],
				'total_order' => $this->post('total_bayar'),
				'tgl_order' => date('Y-m-d H:i:s') 
			];
			$insert_order_id = $this->api->insert('order_id', $order_id);
			if ($insert_order_id) {
				foreach ($result_cart as $key => $v) {
					$order_detail[] = [
						'id_order' => $order_id['id_order'],
						'idProduk' => $v['idProduk'],
						'qty_detail' => $v['qty_cart'],
						'total_detail' => $v['total_cart']
					];

					$produk = $this->api->produk_byid(['idProduk' => $v['idProduk']]);
					$this->api->update_stock(['stokProduk' => $produk['stokProduk']-$v['qty_cart']], ['idProduk' => $v['idProduk']]);
				}
				$insert_order_detail = $this->db->insert_batch('order_detail', $order_detail);
				if ($insert_order_detail) {
					$this->api->delete_new('order_cart', ['id_plm' => $this->post('id_plm')]);
					$this->response([
						'status' => TRUE,
						'message' => 'Berhasil melakukan transaksi...'
					], REST_Controller::HTTP_CREATED);
				}else{
					$this->response([
						'status' => FALSE,
						'message' => 'Gagal melakukan transaksi, coba beberapa saat lagi...'
					], REST_Controller::HTTP_OK);
				}
			}
		}
	}

	public function getorder_get()
	{
		$where = [
			'status0' => [
				'order_id.id_plm' => $this->get('idSales'),
				'order_id.order_status' => 0
			],
			'status1' => [
				'order_id.id_plm' => $this->get('idSales'),
				'order_id.order_status' => 1
			]
		];
		$status0 = $this->api->get_order_join($where['status0']);
		$status1 = $this->api->get_order_join($where['status1']);
		if (isset($status0) || isset($status1)) {
			$this->response([
				'status' => TRUE,
				'data' => [
					'status_0' => $status0,
					'status_1' => $status1
				],
			], REST_Controller::HTTP_OK);
		}
	}

	public function upbukti_post()
	{
		$name = str_replace("/", "_", $this->post('orderID'));
		if ($this->post('idBank')==4) {
			$update = $this->api->upload_bukti(['id_bank' => $this->post('idBank'), 'foto_bukti' => '-'], ['id_order' => $this->post('orderID')]);
		}else{
			$img = './assets/img/bukti/'.$name.'.jpg';
			if (file_exists($img)) {
				unlink($img);
			}
			file_put_contents($img, base64_decode( str_replace(" ", "+", $this->post('fotoBukti')) ));
			$update = $this->api->upload_bukti(['id_bank' => $this->post('idBank'), 'foto_bukti' => $name.'.jpg'], ['id_order' => $this->post('orderID')]);
		}
		if ($update) {
			$this->response([
				'status' => TRUE,
				'message' => 'Bukti berhasil dikirim. Silahkan menunggu atau bila perlu hubungi Admin untuk mengonfirmasi orderan'
			], REST_Controller::HTTP_CREATED);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Bukti gagal dikirim. Silahkan ulangi beberapa saat lagi'
			], REST_Controller::HTTP_OK);
		}
	}

	public function bankadmin_get()
	{
		if (empty($this->get('idBank'))) {
			$result = $this->api->bank_admin();
		}else{
			$result = $this->api->bank_admin(['id_bank' => $this->get('idBank')]);
		}
		if (isset($result)) {
			$this->response([
				'status' => TRUE,
				'data' => $result
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Data tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}
}

/* End of file Android.php */
/* Location: ./application/controllers/api/Android.php */