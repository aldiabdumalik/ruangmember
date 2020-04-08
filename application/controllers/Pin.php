<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')) {
            redirect('goadmin','refresh');
        }
	}

	public function index()
	{
		$data['admin'] = $this->db->get_where('t_user',['id_user' => $this->session->userdata('id_user')])->row();
		$data['title']  = 'Pin';
	    $data['js']   = 'pin';
	    $this->template->load('template', 'mod/pin/view_index', $data);
	}

	public function getPin()
	{
		$list = $this->pin->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->pin;
			$row[] = '<a href="javascript:;" class="btn btn-danger btn-sm btn-hapus" data-idpin="'.$field->id_pin.'" data-pin="'.$field->pin.'"><i class="fas fa-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pin->count_all(),
			"recordsFiltered" => $this->pin->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function simpan()
	{
		$data = ['pin' => $this->input->post('pin')];
		$success = $this->global->insert('t_pin',$data);
       	if (!$success) {
       		echo $this->session->set_flashdata('msg','berhasil');
			redirect('pin');
       	}else{
       		echo $this->session->set_flashdata('msg','gagalDisimpan');
			redirect('pin');
       	}
	}

	public function delete()
	{
		$id 		= $this->input->post('idpinedit');
		$success 	= $this->global->delete('t_pin','id_pin',$id);
		if (!$success) {
			echo $this->session->set_flashdata('msg','hapus');
			redirect('pin');
		} else {
			echo $this->session->set_flashdata('msg', 'gagalDihapus');
			redirect('pin');
		}
	}
}