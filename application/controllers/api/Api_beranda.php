<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api_beranda extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$this->load->model('M_api', 'api');
		$this->load->library('tools');
	}

	public function promosi_get()
	{
		$result = $this->api->get_promosi();
		if (isset($result)) {
			$this->response([
				'status' => TRUE,
				'data' => $result
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Belum ada photo promosi'
			], REST_Controller::HTTP_OK);
		}
	}

}

/* End of file api_beranda.php */
/* Location: ./application/controllers/api_beranda.php */