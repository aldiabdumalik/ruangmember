<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
		if (!$this->session->userdata('username')) {
            redirect('goadmin','refresh');
        }
	}

	public function index()
	{
		$data['admin'] = $this->db->get_where('t_user',['id_user' => $this->session->userdata('id_user')])->row();
		$data['title']  = 'Order';
	    $data['js']   = 'order';
	    $this->template->load('template', 'mod/order/view_index', $data);
	}

	public function selesai()
	{
		$data['admin'] = $this->db->get_where('t_user',['id_user' => $this->session->userdata('id_user')])->row();
		$data['title']  = 'Order Selesai';
	    $data['js']   = 'order';
	    $this->template->load('template', 'mod/order/view_selesai_index', $data);
	}

	public function get_order()
	{
		$list = $this->order->get_datatables('menunggu');
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->id_order;
			$row[] = $field->nama_sales;
			$row[] = "Rp " . number_format($field->total_order,0,',','.');
			$row[] = $field->tgl_order;
			if ($field->foto_bukti == "" || $field->foto_bukti == NULL) {
				$bukti = '<small class="text-danger">bukti belum dikirim</small>';
			}elseif($field->id_bank == 4 && $field->foto_bukti != ""){
				$bukti = '<a href="'.base_url('assets/img/bukti/cod.jpg').'" data-toggle="lightbox" data-title="COD"><img src="'.base_url('assets/img/bukti/cod.jpg').'" width="100" height="100" class="img-fluid mb-2" alt="COD"/></a>';
			}else{
				$bukti = '<a href="'.base_url('assets/img/bukti/'.$field->foto_bukti).'" data-toggle="lightbox" data-title="FOTO BUKTI"><img src="'.base_url('assets/img/bukti/'.$field->foto_bukti).'" width="100" height="100" class="img-fluid mb-2" alt="FOTO BUKTI"/></a>';
			}
			$row[] = $bukti;
			if ($field->order_status == 'menunggu') {
				$status = '<span class="badge badge-pill badge-info">Menunggu</span>';
			}elseif ($field->order_status == 'diproses') {
				$status = '<span class="badge badge-pill badge-danger">Diproses</span>';
			}elseif ($field->order_status == 'dikirim') {
				$status = '<span class="badge badge-pill badge-warning">Dikirim</span>';
			}elseif ($field->order_status == 'selesai') {
				$status = '<span class="badge badge-pill badge-success">Selesai</span>';
			}
			$row[] = $status;
			if ($field->order_status == 'diproses' || $field->order_status == 'dikirim') {
				$button = 
				'<a href="javascript:;" class="btn btn-success btn-sm btn-konfir" data-idorder="'.$field->id_order.'" data-status="'.$field->order_status.'">
					<i class="fas fa-check-circle"></i>
				</a>
				<a href="javascript:;" class="btn btn-info btn-sm btn-lihat" data-idorder="'.base64_encode($field->id_order).'"><i class="fas fa-eye"></i></a>';
			}else{
				$button = '<a href="javascript:;" class="btn btn-info btn-sm btn-lihat" data-idorder="'.base64_encode($field->id_order).'"><i class="fas fa-eye"></i></a>';
			}
			$row[] = $button;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->order->count_all(),
			"recordsFiltered" => $this->order->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function get_order2()
	{
		$list = $this->order->get_datatables('selesai');
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->id_order;
			$row[] = $field->nama_sales;
			$row[] = "Rp " . number_format($field->total_order,0,',','.');
			$row[] = $field->tgl_order;
			if ($field->foto_bukti == "" || $field->foto_bukti == NULL) {
				$bukti = '<small class="text-danger">bukti belum dikirim</small>';
			}elseif($field->id_bank == 4 && $field->foto_bukti != ""){
				$bukti = '<a href="'.base_url('assets/img/bukti/cod.jpg').'" data-toggle="lightbox" data-title="COD"><img src="'.base_url('assets/img/bukti/cod.jpg').'" width="100" height="100" class="img-fluid mb-2" alt="COD"/></a>';
			}else{
				$bukti = '<a href="'.base_url('assets/img/bukti/'.$field->foto_bukti).'" data-toggle="lightbox" data-title="FOTO BUKTI"><img src="'.base_url('assets/img/bukti/'.$field->foto_bukti).'" width="100" height="100" class="img-fluid mb-2" alt="FOTO BUKTI"/></a>';
			}
			$row[] = $bukti;
			if ($field->order_status == 'menunggu') {
				$status = '<span class="badge badge-pill badge-info">Menunggu</span>';
			}elseif ($field->order_status == 'diproses') {
				$status = '<span class="badge badge-pill badge-danger">Diproses</span>';
			}elseif ($field->order_status == 'dikirim') {
				$status = '<span class="badge badge-pill badge-warning">Dikirim</span>';
			}elseif ($field->order_status == 'selesai') {
				$status = '<span class="badge badge-pill badge-success">Selesai</span>';
			}
			$row[] = $status;
			if ($field->order_status == 'diproses' || $field->order_status == 'dikirim') {
				$button = 
				'<a href="javascript:;" class="btn btn-success btn-sm btn-konfir" data-idorder="'.$field->id_order.'" data-status="'.$field->order_status.'">
					<i class="fas fa-check-circle"></i>
				</a>
				<a href="javascript:;" class="btn btn-info btn-sm btn-lihat" data-idorder="'.base64_encode($field->id_order).'"><i class="fas fa-eye"></i></a>';
			}else{
				$button = '<a href="javascript:;" class="btn btn-info btn-sm btn-lihat" data-idorder="'.base64_encode($field->id_order).'"><i class="fas fa-eye"></i></a>';
			}
			$row[] = $button;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->order->count_all(),
			"recordsFiltered" => $this->order->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function order_detail_view($idorder)
	{
		$idorderdecode = base64_decode($idorder);
		if ($idorderdecode == '') {
			$dataJson['status'] = 'false';
		} else {
			$dataorder = $this->order->get_order_view($idorderdecode);
			if ($dataorder) {
				$dataJson['dataorder'] = $dataorder;
				$dataJson['status'] = 'true';
			} else {
				$dataJson['status'] = 'false';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($dataJson);
	}


	public function konfir()
	{
		if ($this->input->post('status') == 'dikirim') {
			$where = array(
				'order_detail.id_order' => $this->input->post('id_order')
			);
			$order = $this->order->get_order_detail_where($where);
			foreach ($order as $key => $ord) {
				if ($ord['kategoriProduk'] == 'retail') {
					$bonus = array(
						'id_order' => $this->input->post('id_order'),
						'bonus' => 60000*$ord['qty_detail'],
						'tgl_bonus' => date('Y-m-d')
					);
					$this->db->insert('order_bonus', $bonus);
				}
			}
			$data = array(
				'order_status' => 'selesai'
			);
		}else{
			$data = array(
				'order_status' => 'dikirim',
				'resi' => $this->input->post('noresi')
			);
		}
	    $success = $this->global->update_new('order_id', $data, array('id_order' => $this->input->post('id_order')));
	    if ($success) {
	      echo $this->session->set_flashdata('msg','konfirmasi');
	      redirect('order');
	    }else{
	      echo $this->session->set_flashdata('msg','gagalKonfir');
	      redirect('order');
	    }
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