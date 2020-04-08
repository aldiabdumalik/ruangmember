<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api_info extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$this->load->model('M_api', 'api');
		$this->load->library('tools');
	}

	public function produk_get()
	{
		if ($this->get('idProduk') == NULL) {
			$retail = $this->api->produk_all(['kategoriProduk' => 'Retail', 'parentProduk' => 0]);
			$reguler = $this->api->produk_all(['kategoriProduk' => 'reguler', 'parentProduk' => 0]);
			$ft = $this->api->produk_all(['kategoriProduk' => 'ft', 'parentProduk' => 0]);
			$this->response([
				'status' => TRUE,
				'retail' => $retail,
				'reguler' => $reguler,
				'ft' => $ft
			], REST_Controller::HTTP_OK);
		}else{
			$result = $this->api->produk_byid(['idProduk' => $this->get('idProduk')]);
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

	public function pertemuan_get()
	{
		$result = $this->api->pertemuan();
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

	public function flip_get()
	{
		if (empty($this->get('page'))) {
			$result = $this->api->flip(0);
		}else{
			$result = $this->api->flip($this->get('page'));
		}
		$count = $this->api->flip_all();
		if (isset($result)) {
			$this->response([
				'status' => TRUE,
				'count' => ceil(count($count)/5),
				'data' => $result
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Data tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}

	function buildTree(array $elements, $parentId = 0) {
	    $branch = array();

	    foreach ($elements as $element) {
	        if ($element['parent_id'] == $parentId) {
	            $children = $this->buildTree($elements, $element['id_marketing']);
	            if ($children) {
	                $element['children'] = $children;
	            }
	            $branch[] = $element;
	        }
	    }

	    return $branch;
	}

	public function plan_get()
	{
		$data = $this->buildTree($this->api->plan_des());
		if (isset($data)) {
			$this->response([
				'status' => TRUE,
				'data' => $data
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Data tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}

}

/* End of file Api_info.php */
/* Location: ./application/controllers/api/Api_info.php */