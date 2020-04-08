<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales extends CI_Controller {

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
		$data['title']  = 'Sales';
	    $data['js']   = 'sales';
	    $this->template->load('template', 'mod/sales/view_index', $data);
	}

	public function getSales()
	{
		$list = $this->sales->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_sales;
			$row[] = $field->nowa_sales;
			$row[] = ($field->status_sales == 1 ? '<span class="badge badge-b badge-pill badge-success">Aktif</span>' : '<span class="badge badge-b badge-pill badge-danger">Tidak aktif</span>');
			$row[] = '<a href="javascript:;" class="btn btn-success btn-sm btn-sales" data-idsales="'.$field->id_plm.'"><i class="fas fa-key"></i></a> <a href="javascript:;" class="btn btn-danger btn-sm btn-hapus" data-idsales="'.$field->id_plm.'" data-namasales="'.$field->nama_sales.'"><i class="fas fa-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->sales->count_all(),
			"recordsFiltered" => $this->sales->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function editSales($idsales = '')
	{
		if ($idsales == '') {
			$dataJson['status'] = 'false';
		} else {
			$dataSales = $this->global->getOneWhere(array('id_plm' => $idsales), 't_sales');
			if ($dataSales) {
				$dataJson['dataSales'] = $dataSales;
				$dataJson['status'] = 'true';
			} else {
				$dataJson['status'] = 'false';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($dataJson);
	}

	public function ubahpassword()
	{
		$post 	= $this->input->post();
		$id 	= $post['idsales'];

		$data 	= [ 'password_sales' => $post['password2'] ];
		$success= $this->global->update('t_sales',$data,'id_plm',$id);
		if (!$success) {
       		echo $this->session->set_flashdata('msg','password');
			redirect('sales');
       	}else{
       		echo $this->session->set_flashdata('msg','gagalpassword');
			redirect('sales');
       	}
	}

	public function delete()
	{
		$id 		= $this->input->post('idsalesdelete');
		$success 	= $this->global->delete('t_sales','id_plm',$id);
		if (!$success) {
			echo $this->session->set_flashdata('msg','hapus');
			redirect('sales');
		} else {
			echo $this->session->set_flashdata('msg', 'gagalDihapus');
			redirect('sales');
		}
	}
}