<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api_login extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$this->load->model('M_api', 'api');
		$this->load->library('tools');
	}

	public function login_post()
	{
		$query = $this->api->login($this->post('login-id'), $this->post('login-password'));
		if (isset($query)) {
			$this->response([
				'status' => TRUE,
				'message' => 'Berhasil masuk. Tunggu beberapa saat...',
				'data' => $query
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Maaf login gagal, periksa kembali ID & Password Anda'
			], REST_Controller::HTTP_OK);
		}
	}

	public function daftar_post()
	{
		$data = [
			'id_plm' => $this->post('register-id'),
			'nama_sales' => $this->post('register-nama'),
			'nowa_sales' => $this->tools->ubah_nohp( $this->post('register-nowa')),
			'password_sales' => $this->post('register-password')
		];
		if (empty($this->api->get_sales(['id_plm' => $this->post('register-id')]))) {
			if (empty($this->api->get_sales(['nowa_sales' => $this->tools->ubah_nohp( $this->post('register-nowa'))]))) {
				$insert = $this->api->insert('t_sales', $data);
				$mypin = $this->api->pin_rand();
				$this->__sendWhatsapText();
				if ($insert) {
					$this->response([
						'status' => TRUE,
						'message' => 'Selamat, Pendaftaran Anda Berhasil'
					], REST_Controller::HTTP_CREATED);
				}else{
					$this->response([
						'status' => FALSE,
						'message' => 'Maaf, Pendaftaran Anda Gagal. Silahkan ulangi beberapa saat lagi'
					], REST_Controller::HTTP_OK);
				}
			}else{
				$this->response([
					'status' => FALSE,
					'message' => 'Maaf, Pendaftaran Anda Gagal. Nomor WA yang Anda Masukan Sudah digunakan'
				], REST_Controller::HTTP_OK);
			}
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Maaf, Pendaftaran Anda Gagal. ID PLM Sudah terdaftar'
			], REST_Controller::HTTP_OK);
		}
	}

	public function aktivasi_post()
	{
		$sales = $this->api->get_sales(['id_plm' => $this->post('lupa-id')]);
		if (empty($sales)) {
			$this->response([
				'status' => FALSE,
				'message' => 'Maaf, ID PLM belum terdaftar'
			], REST_Controller::HTTP_OK);
		}else{
			$lupa = [
				'id_plm' => $this->post('lupa-id'),
				'kode_aktivasi' => $this->tools->str_random_abj(10)
			];
			$this->api->delete_new('t_sales_lupa', ['id_plm' => $this->post('lupa-id')]);
			$this->api->insert('t_sales_lupa', $lupa);
			$data_lupa = $this->api->get_aktivasi(['id_plm' => $this->post('lupa-id')]);
			if (isset($data_lupa)) {
				$curl = curl_init();
				$data = [
					'receiver' => $sales['nowa_sales'],
					'device' => '089508457647',
					'message' => 'Kode Aktivasi Anda adalah '.$data_lupa['kode_aktivasi'].' Harap tidak memberikan kode ini pada siapapun. Terima kasih',
					'type' => 'chat'
				];

				curl_setopt($curl, CURLOPT_HTTPHEADER,
					array(
						"Accept: application/json",
						"Content-Type: application/x-www-form-urlencoded",
						"Authorization: Bearer 30tt5jXPfsFREjyHrdb6xuLkhlO0cP5xHyHjwb76VDeHwEqKRp"
					)
				);
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($curl, CURLOPT_URL, "https://app.whatspie.com/api/messages");
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
				$result = curl_exec($curl);
				curl_close($curl);
				$this->response([
					'status' => TRUE,
					'data' => $result
				], REST_Controller::HTTP_OK);
			}
		}
	}

	public function kirimPassword_post()
	{
		$aktivasi = $this->api->get_aktivasi(['id_plm' => $this->post('lupa-id'), 'kode_aktivasi' => $this->post('lupa-kode')]);
		if (empty($aktivasi)) {
			$this->response([
				'status' => FALSE,
				'message' => 'Maaf, Kode Aktivasi salah silahkan cek kembali Whatssapp Anda'
			], REST_Controller::HTTP_OK);
		}else{
			$sales = $this->api->get_sales(['id_plm' => $this->post('lupa-id')]);
			$message = 'Password Anda adalah '.$sales['password_sales'].', Mohon untuk tidak memberitahu pada siapapun. Terima kasih.';
			$this->__sendWhatsapText($sales['nowa_sales'], $message);
			$this->response([
				'status' => TRUE,
				'message' => 'Password sudah dikirim pada Whatssapps Anda'
			], REST_Controller::HTTP_OK);
		}
	}

	function __sendWhatsapText($nomor, $pesan)
	{
		$curl = curl_init();
		$data = [
			'receiver' => $nomor,
			'device' => '6282113122700',
			'message' => $pesan,
			'type' => 'chat'
		];

		curl_setopt($curl, CURLOPT_HTTPHEADER,
			array(
				"Accept: application/json",
				"Content-Type: application/x-www-form-urlencoded",
				"Authorization: Bearer 30tt5jXPfsFREjyHrdb6xuLkhlO0cP5xHyHjwb76VDeHwEqKRp"
			)
		);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_URL, "https://app.whatspie.com/api/messages");
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}

	public function index_get(){}
	public function index_post(){}
}

/* End of file Api_login.php */
/* Location: ./application/controllers/api/Api_login.php */