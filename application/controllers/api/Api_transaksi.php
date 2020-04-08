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
			$result = $this->api->get_consumer();
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

}

/* End of file Api_transaksi.php */
/* Location: ./application/controllers/api/Api_transaksi.php */