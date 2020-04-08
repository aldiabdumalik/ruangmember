<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flipchart extends CI_Controller {

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
		$data['title']  = 'Flip Chart';
	    $data['js']   = 'flipchart';
	    $this->template->load('template', 'mod/flipChart/view_index', $data);
	}

	public function getFlipChart()
	{
		$list = $this->flipchart->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<img width="100" height="80" src="'.base_url('assets/img/flipchart/'.$field->fotoFlipChart).'" alt="">';
			$row[] = $field->namaFlipChart;
			$row[] = '<a href="javascript:;" class="btn btn-success btn-sm btn-flip" data-idflipchart="'.$field->idFlipChart.'"><i class="fas fa-edit"></i></a> <a href="'.base_url('flipchart/hapus/'.$field->idFlipChart).'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->flipchart->count_all(),
			"recordsFiltered" => $this->flipchart->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function EditFlip($idflipchart = '')
	{
		if ($idflipchart == '') {
			$dataJson['status'] = 'false';
		} else {
			$dataFlip = $this->global->getOneWhere(array('idFlipChart' => $idflipchart), 't_flip_chart');
			if ($dataFlip) {
				$dataJson['dataFlip'] = $dataFlip;
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
		$config['upload_path'] = './assets/img/flipchart';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg';
	    $config['encrypt_name'] = FALSE;
	    
	    $this->upload->initialize($config);

		if(!empty($_FILES['foto']['name'])){
	        if ($this->upload->do_upload('foto')){
	    		$img = $this->upload->data();
	            //Compress Image
	            $config['image_library']='gd2';
	            $config['source_image']='./assets/img/flipchart/'.$img['file_name'];
	            $config['create_thumb']= FALSE;
	            $config['maintain_ratio']= FALSE;
	            $config['quality']= '80%';
	            $config['new_image']= './assets/img/flipchart/'.$img['file_name'];

	            $foto = $img['file_name'];
	            $post = $this->input->post();

	            $nama = $post['nama'];
	            $deskripsi = $post['deskripsi'];

	            $data = [
	            	"fotoFlipChart" 		=> $foto,
	            	"namaFlipChart" 		=> $nama,
	            	"deskripsiFlipChart" 	=> $deskripsi
	            ];
	           	$success = $this->global->insert('t_flip_chart',$data);
	           	if (!$success) {
	           		echo $this->session->set_flashdata('msg','berhasil');
					redirect('flipchart');
	           	}else{
	           		echo $this->session->set_flashdata('msg','gagalDisimpan');
					redirect('flipchart');
	           	}
	        }else{
	        	echo $this->session->set_flashdata('msg','errorGambar');
				redirect('flipchart');
	        }
	    }else{
    		echo $this->session->set_flashdata('msg','errorGambar');
			redirect('flipchart');
	    }

	}

	public function edit()
	{
		$config['upload_path'] = './assets/img/flipchart';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg';
	    $config['encrypt_name'] = FALSE;
	    
	    $this->upload->initialize($config);

		if(!empty($_FILES['foto']['name'])){
	        if ($this->upload->do_upload('foto')){
	    		$img = $this->upload->data();
	            //Compress Image
	            $config['image_library']='gd2';
	            $config['source_image']='./assets/img/flipchart/'.$img['file_name'];
	            $config['create_thumb']= FALSE;
	            $config['maintain_ratio']= FALSE;
	            $config['quality']= '80%';
	            $config['new_image']= './assets/img/flipchart/'.$img['file_name'];

	            $foto = $img['file_name'];
	            $post = $this->input->post();

	            $id = $post['idEdit'];
	            $nama = $post['nama'];
	            $deskripsi = $post['deskripsi'];

	            $data = [
	            	"fotoFlipChart" 		=> $foto,
	            	"namaFlipChart" 		=> $nama,
	            	"deskripsiFlipChart" 	=> $deskripsi
	            ];
	            // HAPUS FOTO
	            $dataFlip = $this->global->getOneSpesificWhere('fotoFlipChart', array('idFlipChart' => $id), 't_flip_chart');
	            if (file_exists('assets/img/flipchart/' . $dataFlip->fotoFlipChart))
				unlink('assets/img/flipchart/' . $dataFlip->fotoFlipChart);

	           	$success = $this->global->update('t_flip_chart',$data,'idFlipChart',$id);
	           	if (!$success) {
	           		echo $this->session->set_flashdata('msg','edit');
					redirect('flipchart');
	           	}else{
	           		echo $this->session->set_flashdata('msg','gagalDiedit');
					redirect('flipchart');
	           	}
	        }else{
	        	echo $this->session->set_flashdata('msg','errorGambar');
				redirect('flipchart');
	        }
	    }else{
    			$post = $this->input->post();

	            $id = $post['idEdit'];
	            $nama = $post['nama'];
	            $deskripsi = $post['deskripsi'];

	            $data = [
	            	"namaFlipChart" 		=> $nama,
	            	"deskripsiFlipChart" 	=> $deskripsi
	            ];
	           	$success = $this->global->update('t_flip_chart',$data,'idFlipChart',$id);
	    		if (!$success) {
	           		echo $this->session->set_flashdata('msg','edit');
					redirect('flipchart');
	           	}else{
	           		echo $this->session->set_flashdata('msg','gagalDiedit');
					redirect('flipchart');
	           	}
	    }
	}

	public function hapus($id)
	{
		$dataFlip = $this->global->getOneSpesificWhere('fotoFlipChart', array('idFlipChart' => $id), 't_flip_chart');
		if ($dataFlip) {

			if (file_exists('assets/img/flipchart/' . $dataFlip->fotoFlipChart))
				unlink('assets/img/flipchart/' . $dataFlip->fotoFlipChart);

			$success = $this->global->delete('t_flip_chart','idFlipChart',$id);
			if (!$success) {
				echo $this->session->set_flashdata('msg','hapus');
				redirect('flipchart');
			} else {
				echo $this->session->set_flashdata('msg', 'gagalDihapus');
				redirect('flipchart');
			}

		}else{
			echo $this->session->set_flashdata('msg', 'dataKosong');
			redirect('flipchart');
		}
	}

}

/* End of file FlipChart.php */
/* Location: ./application/controllers/FlipChart.php */