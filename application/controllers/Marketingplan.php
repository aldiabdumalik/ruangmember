<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketingplan extends CI_Controller {

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
		$data['title']  = 'Marketing Plan';
	    $data['js']   = 'marketingplan';
	    $this->template->load('template', 'mod/marketingPlan/view_index', $data);
	}

	public function getMarketing()
	{
		$list = $this->marketing->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->deskripsiMarketing;
			$row[] = '<a href="javascript:;" class="btn btn-success btn-sm btn-edit" data-idmarketing="'.$field->idMarketing.'"><i class="fas fa-edit"></i></a> <a href="'.base_url('marketingplan/hapus/'.$field->idMarketing).'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->marketing->count_all(),
			"recordsFiltered" => $this->marketing->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function editMarketing($idmarketing)
	{
		if ($idmarketing == '') {
			$dataJson['status'] = 'false';
		} else {
			$dataMarketing = $this->global->getJoinTable($idmarketing);
			if ($dataMarketing) {
				$dataJson['dataMarketing'] = $dataMarketing;
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
		// Hitung Jumlah File/Gambar yang dipilih
		$jumlahData = count($_FILES['foto']['name']);
		$post = $this->input->post();
		$deskripsi 	=  $post['deskripsi'];

		$data = [
			'deskripsiMarketing' => $deskripsi 
		];

		$insert_id = $this->global->insert('t_marketing_plan',$data);
		$id = $this->db->insert_id();
		// Lakukan Perulangan dengan maksimal ulang Jumlah File yang dipilih
		for ($i=0; $i < $jumlahData ; $i++):

			// Inisialisasi Nama,Tipe,Dll.
			$_FILES['file']['name']     = $_FILES['foto']['name'][$i];
			$_FILES['file']['type']     = $_FILES['foto']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
			$_FILES['file']['size']     = $_FILES['foto']['size'][$i];

			// Konfigurasi Upload
			$config['upload_path']          = './assets/img/marketingplan/';
			$config['allowed_types']        = 'gif|jpg|png|pdf|jpeg';

			// Memanggil Library Upload dan Setting Konfigurasi
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('file')){ // Jika Berhasil Upload

				$fileData = $this->upload->data(); // Lakukan Upload Data

				// Membuat Variable untuk dimasukkan ke Database
				$uploadData[$i]['idMarketing'] = $id; 
				$uploadData[$i]['foto'] = $fileData['file_name']; 
			}

		endfor; // Penutup For
		if($uploadData !== null){ // Jika Berhasil Upload

			// Insert ke Database 
			$insert = $this->global->insert_data_batch('t_image_marketing',$uploadData);
			if (!$success) {
           		echo $this->session->set_flashdata('msg','berhasil');
				redirect('marketingplan');
           	}else{
           		echo $this->session->set_flashdata('msg','gagalDisimpan');
				redirect('marketingplan');
           	}

		}
	}

	public function edit()
	{
		// Hitung Jumlah File/Gambar yang dipilih
		$kosong = $_FILES['foto']['name'][0];
		$jumlahData = count($_FILES['foto']['name']);
		$post = $this->input->post();
		$id = $post['id2'];
		if ($kosong == "") {
			$deskripsi 	=  $post['deskripsi'];

			$data = [
				'deskripsiMarketing' => $deskripsi 
			];

			$success = $this->global->update('t_marketing_plan',$data,'idMarketing',$id);
			if (!$success) {
           		echo $this->session->set_flashdata('msg','edit');
				redirect('marketingplan');
           	}else{
           		echo $this->session->set_flashdata('msg','gagalDiedit');
				redirect('marketingplan');
           	}
		}
		else
		{
			$post = $this->input->post();
			$deskripsi 	=  $post['deskripsi'];

			$data = [
				'deskripsiMarketing' => $deskripsi 
			];

			$insert_id = $this->global->update('t_marketing_plan',$data,'idMarketing',$id);
			
			// for ($i=0; $i < $jumlahData ; $i++):
			// HAPUS FOTO
            $dataMarketing = $this->global->getBanyakSpesificWhere('foto', array('idMarketing' => $id), 't_image_marketing');

            for ($i=0; $i < count($dataMarketing); $i++) {
            	if (file_exists('assets/img/marketingplan/' . $dataMarketing[$i]->foto))
				unlink('assets/img/marketingplan/' . $dataMarketing[$i]->foto);
            }
            $this->global->delete('t_image_marketing','idMarketing',$id);
			// Lakukan Perulangan dengan maksimal ulang Jumlah File yang dipilih
			for ($i=0; $i < $jumlahData ; $i++):

				// Inisialisasi Nama,Tipe,Dll.
				$_FILES['file']['name']     = $_FILES['foto']['name'][$i];
				$_FILES['file']['type']     = $_FILES['foto']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
				$_FILES['file']['size']     = $_FILES['foto']['size'][$i];

				// Konfigurasi Upload
				$config['upload_path']          = './assets/img/marketingplan/';
				$config['allowed_types']        = 'gif|jpg|png|pdf|jpeg';

				// Memanggil Library Upload dan Setting Konfigurasi
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('file')){ // Jika Berhasil Upload

					$fileData = $this->upload->data(); // Lakukan Upload Data

					// Membuat Variable untuk dimasukkan ke Database
					$uploadData[$i]['idMarketing'] = $id; 
					$uploadData[$i]['foto'] = $fileData['file_name']; 
				}

			endfor; // Penutup For

			if($uploadData !== null){ // Jika Berhasil Upload

				// Insert ke Database 
				$insert = $this->global->insert_data_batch('t_image_marketing',$uploadData);
				if (!$success) {
	           		echo $this->session->set_flashdata('msg','berhasil');
					redirect('marketingplan');
	           	}else{
	           		echo $this->session->set_flashdata('msg','gagalDisimpan');
					redirect('marketingplan');
	           	}

			}
		}
	}

	public function hapus($id)
	{
		$dataMarketing = $this->global->getBanyakSpesificWhere('foto', array('idMarketing' => $id), 't_image_marketing');
		if ($dataMarketing) {

			for ($i=0; $i < count($dataMarketing); $i++) {
	        	if (file_exists('assets/img/marketingplan/' . $dataMarketing[$i]->foto))
				unlink('assets/img/marketingplan/' . $dataMarketing[$i]->foto);
	        }
	        $this->global->delete('t_image_marketing','idMarketing',$id);

			$success = $this->global->delete('t_marketing_plan','idMarketing',$id);
			if (!$success) {
				echo $this->session->set_flashdata('msg','hapus');
				redirect('marketingplan');
			} else {
				echo $this->session->set_flashdata('msg', 'gagalDihapus');
				redirect('marketingplan');
			}

		}else{
			echo $this->session->set_flashdata('msg', 'dataKosong');
			redirect('marketingplan');
		}
	}

}

/* End of file MarketingPlan.php */
/* Location: ./application/controllers/MarketingPlan.php */