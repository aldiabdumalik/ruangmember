<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api_report extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$this->load->model('M_api', 'api');
		$this->load->library('tools');
	}

	public function reporttbl_get()
	{
		$result = $this->api->get_report($this->get('page'), array('order_id.order_status' => $this->get('status')));
		$all = $this->api->get_report_all(array('order_id.order_status' => $this->get('status')));
		if (!empty($result)) {
			$this->response([
				'status' => TRUE,
				'data' => $result,
				'count' => ceil(count($all)/5),
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Data tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}
	public function reporttbl2_get()
	{
		if (!empty($this->get('text')) && !empty($this->get('date'))) {
			$result = $this->api->search_report($this->get('text'), $this->get('date'), $this->get('status'));
		}elseif (!empty($this->get('text')) && empty($this->get('date'))) {
			$result = $this->api->search_report($this->get('text'), null, $this->get('status'));
		}else{
			$result = $this->api->search_report(null, $this->get('date'), $this->get('status'));
		}
		if (!empty($result)) {
			$this->response([
				'status' => TRUE,
				'data' => $result,
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Data tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}

	public function orderdetail_get()
	{
		$result = $this->api->get_report_detail(array('order_id.id_order' => $this->get('order')));
		if (!empty($result)) {
			$this->response([
				'status' => TRUE,
				'data' => $result,
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Data tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}

	public function index_get(){}
	public function index_post(){}
}