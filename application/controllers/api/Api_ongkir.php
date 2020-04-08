<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api_ongkir extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$this->load->model('M_api', 'api');
		$this->load->library('tools');
	}

	public function provinsi_get()
	{
		$provinsi = $this->api->get_provinsi();
		$this->response([
			'status' => TRUE,
			'data' => $provinsi
		], REST_Controller::HTTP_OK);
	}

	public function kota_get()
	{
		$kota = $this->api->get_kota(array('id_provinsi' => $this->get('provinsi')));
		$this->response([
			'status' => TRUE,
			'data' => $kota
		], REST_Controller::HTTP_OK);
	}

	public function kecamatan_get()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=" . $this->get('kota'),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 60,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: 7fa3a7039494dd92a6d207bef6be0c6a"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}
	}

	public function ongkir_post()
	{
		$courier = $this->post('ongkir-ekspedisi');
		$destination = $this->post('ongkir-ke');
		$berat = $this->post('ongkir-berat');
		$params = "origin=171&originType=city&destination=".$destination."&destinationType=subdistrict&weight=".$berat."&courier=" . $courier;
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 60,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $params,
		  CURLOPT_HTTPHEADER => array(
		    "content-type: application/x-www-form-urlencoded",
		    "key: 7fa3a7039494dd92a6d207bef6be0c6a"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}
	}

	public function index_post(){}
	public function index_get(){}
}

/* End of file Rajaongkir.php */
/* Location: ./application/controllers/api/Rajaongkir.php */