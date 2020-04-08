<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api_youtube extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$this->load->model('M_api', 'api');
		$this->load->library('tools');
	}

	public function basicpack_get()
	{
		$api_key = 'AIzaSyBZ4MsKx53fOiO-zU9lxa_R7QrrIfPFt0o';
		$client = new Google_Client();
		$client->setDeveloperKey($api_key);
		$YouTube = new Google_Service_YouTube($client);

		if (empty($this->get('pageToken'))) {
			$pageToken = 'PAGE01';
		}else{
			$pageToken = $this->get('pageToken');
		}

		$params = [
			'maxResults' => 5,
			'pageToken' => $pageToken,
			'playlistId' => 'PLmUEoqFsS4ACSuKej78Y2dztwEzrb1zFk',
		];

		$PlayList = $YouTube->playlistItems->listPlaylistItems('snippet,contentDetails', $params);

		foreach ($PlayList as $key => $value) {
			$data[] = [
				'id' => $value->contentDetails->videoId,
				'title' => $value->snippet->title,
				'description' => $value->snippet->description,
				'publishedAt' => $value->snippet->publishedAt,
				'thumbnail' => $value->snippet->thumbnails->high->url
			];
		}

		$page = [
			'jumlah' => $PlayList->pageInfo->resultsPerPage,
			'total' => $PlayList->pageInfo->totalResults,
			'prev' => $PlayList->prevPageToken,
			'next' => $PlayList->nextPageToken
		];

		if (isset($data)) {
			$this->response([
				'status' => TRUE,
				'data' => $data,
				'page' => $page
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'PlayList tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}

	public function persentasistandar_get()
	{
		$api_key = 'AIzaSyBZ4MsKx53fOiO-zU9lxa_R7QrrIfPFt0o';
		$client = new Google_Client();
		$client->setDeveloperKey($api_key);
		$YouTube = new Google_Service_YouTube($client);

		if (empty($this->get('pageToken'))) {
			$pageToken = 'PAGE01';
		}else{
			$pageToken = $this->get('pageToken');
		}

		$params = [
			'maxResults' => 5,
			'pageToken' => $pageToken,
			'playlistId' => 'PLmUEoqFsS4ACSuKej78Y2dztwEzrb1zFk',
		];

		$PlayList = $YouTube->playlistItems->listPlaylistItems('snippet,contentDetails', $params);

		foreach ($PlayList as $key => $value) {
			$data[] = [
				'id' => $value->contentDetails->videoId,
				'title' => $value->snippet->title,
				'description' => $value->snippet->description,
				'publishedAt' => $value->snippet->publishedAt,
				'thumbnail' => $value->snippet->thumbnails->high->url
			];
		}

		$page = [
			'jumlah' => $PlayList->pageInfo->resultsPerPage,
			'total' => $PlayList->pageInfo->totalResults,
			'prev' => $PlayList->prevPageToken,
			'next' => $PlayList->nextPageToken
		];

		if (isset($data)) {
			$this->response([
				'status' => TRUE,
				'data' => $data,
				'page' => $page
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'PlayList tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}

	public function persentasi_get()
	{
		$api_key = 'AIzaSyBZ4MsKx53fOiO-zU9lxa_R7QrrIfPFt0o';
		$client = new Google_Client();
		$client->setDeveloperKey($api_key);
		$YouTube = new Google_Service_YouTube($client);

		if (empty($this->get('pageToken'))) {
			$pageToken = 'PAGE01';
		}else{
			$pageToken = $this->get('pageToken');
		}

		$params = [
			'maxResults' => 5,
			'pageToken' => $pageToken,
			'playlistId' => 'PLmUEoqFsS4ACSuKej78Y2dztwEzrb1zFk',
		];

		$PlayList = $YouTube->playlistItems->listPlaylistItems('snippet,contentDetails', $params);

		foreach ($PlayList as $key => $value) {
			$data[] = [
				'id' => $value->contentDetails->videoId,
				'title' => $value->snippet->title,
				'description' => $value->snippet->description,
				'publishedAt' => $value->snippet->publishedAt,
				'thumbnail' => $value->snippet->thumbnails->high->url
			];
		}

		$page = [
			'jumlah' => $PlayList->pageInfo->resultsPerPage,
			'total' => $PlayList->pageInfo->totalResults,
			'prev' => $PlayList->prevPageToken,
			'next' => $PlayList->nextPageToken
		];

		if (isset($data)) {
			$this->response([
				'status' => TRUE,
				'data' => $data,
				'page' => $page
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'PlayList tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}

	public function testimoni_get()
	{
		$api_key = 'AIzaSyBZ4MsKx53fOiO-zU9lxa_R7QrrIfPFt0o';
		$client = new Google_Client();
		$client->setDeveloperKey($api_key);
		$YouTube = new Google_Service_YouTube($client);

		if (empty($this->get('pageToken'))) {
			$pageToken = 'PAGE01';
		}else{
			$pageToken = $this->get('pageToken');
		}

		$params = [
			'maxResults' => 5,
			'pageToken' => $pageToken,
			'playlistId' => 'PLmUEoqFsS4ACSuKej78Y2dztwEzrb1zFk',
		];

		$PlayList = $YouTube->playlistItems->listPlaylistItems('snippet,contentDetails', $params);

		foreach ($PlayList as $key => $value) {
			$data[] = [
				'id' => $value->contentDetails->videoId,
				'title' => $value->snippet->title,
				'description' => $value->snippet->description,
				'publishedAt' => $value->snippet->publishedAt,
				'thumbnail' => $value->snippet->thumbnails->high->url
			];
		}

		$page = [
			'jumlah' => $PlayList->pageInfo->resultsPerPage,
			'total' => $PlayList->pageInfo->totalResults,
			'prev' => $PlayList->prevPageToken,
			'next' => $PlayList->nextPageToken
		];

		if (isset($data)) {
			$this->response([
				'status' => TRUE,
				'data' => $data,
				'page' => $page
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'PlayList tidak ditemukan'
			], REST_Controller::HTTP_OK);
		}
	}

}

/* End of file Rajaongkir.php */
/* Location: ./application/controllers/api/Rajaongkir.php */