<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank extends CI_Controller {

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
		$data['title']  = 'Bank';
	    $data['js']   = 'bank';
	    $this->template->load('template', 'mod/bank/view_index', $data);
	}

	public function get_bank()
	{
		$list = $this->bank->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_bank;
			$row[] = $field->norek_bank;
			$row[] = $field->an_bank;
			$row[] = '<a href="javascript:;" class="btn btn-success btn-sm btn-bank" data-idbank="'.$field->id_bank.'"><i class="fas fa-edit"></i></a> <a href="javascript:;" class="btn btn-danger btn-sm btn-hapus" data-idbank="'.$field->id_bank.'" data-namabank="'.$field->an_bank.'"><i class="fas fa-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->bank->count_all(),
			"recordsFiltered" => $this->bank->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function edit_bank($idbank = '')
	{
		if ($idbank == '') {
			$dataJson['status'] = 'false';
		} else {
			$databank = $this->global->getOneWhere(array('id_bank' => $idbank), 't_bank');
			if ($databank) {
				$dataJson['databank'] = $databank;
				$dataJson['status'] = 'true';
			} else {
				$dataJson['status'] = 'false';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($dataJson);
	}

	public function simpan()
	{
		$post = $this->input->post();

		$data = [
			'nama_bank' => $post['namabank'],
			'norek_bank' => $post['norek'],
			'an_bank' => $post['an']
		];

		$success = $this->global->insert('t_bank',$data);
	   	if (!$success) {
	   		echo $this->session->set_flashdata('msg','berhasil');
			redirect('bank');
	   	}else{
	   		echo $this->session->set_flashdata('msg','gagalDisimpan');
			redirect('bank');
	   	}
	}

	public function edit()
	{
		$post = $this->input->post();
		$id   = $post['idbankedit'];

		$data = [
			'nama_bank' => $post['namabankedit'],
			'norek_bank' => $post['norekedit'],
			'an_bank' => $post['anedit']
		];

		$success = $this->global->update('t_bank',$data,'id_bank',$id);
	   	if (!$success) {
	   		echo $this->session->set_flashdata('msg','edit');
			redirect('bank');
	   	}else{
	   		echo $this->session->set_flashdata('msg','gagalDiedit');
			redirect('bank');
	   	}
	}

	public function delete()
	{
		$id 		= $this->input->post('idbankdelete');
		$success 	= $this->global->delete('t_bank','id_bank',$id);
		if (!$success) {
			echo $this->session->set_flashdata('msg','hapus');
			redirect('bank');
		} else {
			echo $this->session->set_flashdata('msg', 'gagalDihapus');
			redirect('bank');
		}
	}
}