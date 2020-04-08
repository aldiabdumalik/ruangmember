<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')) {
            redirect('goadmin','refresh');
        }
	}

	public function index()
	{
		$data['title']  = 'Report';
	    $data['js']   = 'report';
	    $this->template->load('template', 'mod/report/view_index', $data);
	}

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */