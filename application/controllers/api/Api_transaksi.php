<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api_transaksi extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$this->load->model('M_api', 'api');
		$this->load->library('tools');
	}

	public function consumer_get()
	{
		if ($this->get('consumer') == NULL) {
			$result = $this->api->get_consumer_new(array('id_plm' => $this->get('id_plm')));
		}else{
			$where = array(
				'id_consumer' => $this->get('consumer')
			);
			$result = $this->api->get_consumer($where);
		}
		if (!empty($result)) {
			$this->response([
				'status' => TRUE,
				'data' => $result
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE
			], REST_Controller::HTTP_OK);
		}
	}

	public function cekcart_get()
	{
		$where = [
			'id_plm' => $this->get('id_plm')
		];
		$cart = $this->api->cart_get($where);
		if (!empty($cart)) {
			$total = $this->api->cart_get_total($where);
			$this->response([
				'status' => TRUE,
				'data' => $cart,
				'total' => $total
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Belum ada orderan, silahkan tambah order'
			], REST_Controller::HTTP_OK);
		}
	}

	public function cart_post()
	{
		$data = [
			'id_plm' => $this->post('id_plm'),
			'idProduk' => $this->post('idProduk'),
			'qty_cart' => $this->post('qty_cart'),
			'total_cart' => $this->post('total_cart'),
			'kategori_produk' => $this->post('kategori'),
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
	}

	public function changekat_get()
	{
		$where = [
			'kategoriProduk' => $this->get('id_kategori')
		];
		$produk = $this->buildTree($this->api->produk_all($where));
		if (!empty($produk)) {
			$this->response([
				'status' => TRUE,
				'data' => $produk,
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Produk dalam kategori ini tidak di temukan'
			], REST_Controller::HTTP_OK);
		}
	}
	public function changeproduk_get()
	{
		$where1 = [
			'idProduk' => $this->get('produk')
		];
		$where2 = [
			'parentProduk' => $this->get('produk')
		];
		$produk = $this->api->produk_all($where1);
		$parentProduk = $this->api->produk_all($where2);
		if (!empty($produk)) {
			$this->response([
				'status' => TRUE,
				'produk' => $produk,
				'parent' => $parentProduk,
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Produk ini tidak di temukan'
			], REST_Controller::HTTP_OK);
		}
	}

	public function getCart_get()
	{
		$where = array(
			'order_cart.id_cart' => $this->get('id')
		);
		$result = $this->api->cart_get($where);
		if (!empty($result)) {
			$this->response([
				'status' => TRUE,
				'data' => $result,
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Data tidak di temukan'
			], REST_Controller::HTTP_OK);
		}
	}
	public function deleteCart_post()
	{
		$where = array(
			'id_cart' => $this->post('id')
		);
		$result = $this->api->delete_new('order_cart', $where);
		if ($result) {
			$this->response([
				'status' => TRUE,
				'message' => 'Berhasil dihapus',
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Gagal menghapus, tunggu beberapa saat lagi'
			], REST_Controller::HTTP_OK);
		}
	}
	public function editCart_post()
	{
		$where = array(
			'id_cart' => $this->post('id')
		);
		$data = array(
			'qty_cart' => $this->post('qty'),
			'total_cart' => $this->post('total')
		);
		$result = $this->api->update_cart($data, $where);
		if ($result) {
			$this->response([
				'status' => TRUE,
				'message' => 'Berhasil diubah',
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Gagal diubah, tunggu beberapa saat lagi'
			], REST_Controller::HTTP_OK);
		}
	}

	public function orderkeun_post()
	{
		if ($this->post('consumer') == 0) {
			$consumer = array(
				'id_consumer' => date('Ymd').$this->tools->str_random(4),
				'id_plm' => $this->post('id_plm'),
				'nama_penerima' => $this->post('nama'),
				'alamat_penerima' => $this->post('alamat'),
				'nowa_penerima' => $this->tools->ubah_nohp($this->post('nowa')),
				'provinsi_consumer' => $this->post('provinsi'),
				'kota_consumer' => $this->post('kota'),
				'kecamatan_consumer' => $this->post('kecamatan'),
				'codepos_consumer' => $this->post('pos')
			);
			$insert_consumer = $this->api->insert('order_detail_consumer', $consumer);
			$id_consumer = $consumer['id_consumer'];
		}else{
			$id_consumer = $this->post('consumer');
		}
		$order_id = array(
			'id_order' => 'ORD'.date('Ymd').$this->post('id_plm').$this->tools->str_random(5),
			'id_plm' => $this->post('id_plm'),
			'id_consumer' => $id_consumer,
			'total_order' => $this->post('total_bayar'),
			'order_ongkir' => $this->post('ongkir'),
			'tgl_order' => date('Y-m-d H:i:s'),
			'order_status' => 'menunggu',
			'order_ekspedisi' => $this->post('ekspedisi').' ('.$this->post('ekspedisi_tipe').')',
			'order_alamat' => $this->post('alamat_lengkap')
		);
		$insert_order_id = $this->api->insert('order_id', $order_id);
		if ($insert_order_id) {
			$result_cart = $this->api->cart_get(array('id_plm' => $this->post('id_plm')));
			foreach ($result_cart as $key => $v) {
				$order_detail[] = array(
					'id_order' => $order_id['id_order'],
					'idProduk' => $v['idProduk'],
					'qty_detail' => $v['qty_cart'],
					'total_detail' => $v['total_cart']
				);
				$produk = $this->api->produk_byid(array('idProduk' => $v['idProduk']));
				$this->api->update_stock(array('stokProduk' => $produk['stokProduk']-$v['qty_cart']), array('idProduk' => $v['idProduk']));
			}
			$insert_order_detail = $this->db->insert_batch('order_detail', $order_detail);
			if ($insert_order_detail) {
				$this->api->delete_new('order_cart', array('id_plm' => $this->post('id_plm')));
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
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Gagal melakukan transaksi, coba beberapa saat lagi...'
			], REST_Controller::HTTP_OK);
		}
	}

	public function getorderbyid_get()
	{
		$result = $this->api->get_report_all(array('order_id.id_order' => $this->get('id')));
		if (!empty($result)) {
			$this->response([
				'status' => TRUE,
				'data' => $result
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Produk ini tidak di temukan'
			], REST_Controller::HTTP_OK);
		}
	}

	public function finish_post()
	{
		$config['upload_path'] = './assets/img/bukti/';
	    $config['allowed_types'] = '*';
	    $config['encrypt_name'] = TRUE;
	    $this->upload->initialize($config);
	    if ($this->upload->do_upload('file')) {
	    	$data = array(
	    		'foto_bukti' => $this->upload->data('file_name'),
	    		'id_bank' => $this->post('bank'),
	    		'order_status' => 'diproses'
	    	);
	    	$upload = $this->api->upload_bukti($data, array('id_order' => $this->post('id')));
	    	if ($upload) {
				$this->response([
					'status' => TRUE,
					'foto' => $this->upload->data('file_name'),
					'message' => 'Bukti berhasil di kirim'
				], REST_Controller::HTTP_OK);
	    	}else{
	    		$this->response([
					'status' => FALSE,
					'message' => 'Bukti gagal di kirim, silahkan ulangi beberapa saat lagi'
				], REST_Controller::HTTP_OK);
	    	}
	    }else{
	    	$this->response([
				'status' => FALSE,
				'message' => 'Bukti gagal di kirim, silahkan ulangi beberapa saat lagi'
			], REST_Controller::HTTP_OK);
	    }
	}
	public function finish_get()
	{
		$data = array(
    		'foto_bukti' => 'cod.jpg',
    		'id_bank' => $this->get('bank'),
    		'order_status' => 'diproses'
    	);
    	$upload = $this->api->upload_bukti($data, array('id_order' => $this->get('id')));
    	if ($upload) {
			$this->response([
				'status' => TRUE,
				'message' => 'Bukti berhasil di kirim'
			], REST_Controller::HTTP_OK);
    	}else{
    		$this->response([
				'status' => FALSE,
				'message' => 'Bukti gagal di kirim, silahkan ulangi beberapa saat lagi'
			], REST_Controller::HTTP_OK);
    	}
	}

	public function buildTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parentProduk'] == $parentId) {
                $children = $this->buildTree($elements, $element['idProduk']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }
    public function buildTree1(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['idProduk'] == $parentId) {
                $children = $this->buildTree($elements, $element['parentProduk']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public function index_post(){}
    public function index_get(){}
}

/* End of file Api_transaksi.php */
/* Location: ./application/controllers/api/Api_transaksi.php */