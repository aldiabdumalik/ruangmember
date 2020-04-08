<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promosi extends CI_Controller {

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
		$data['title']  = 'Promosi';
	    $data['js']   = 'promosi';
	    $this->template->load('template', 'mod/promosi/view_index', $data);
	}

	public function getPromosi()
	{
		$list = $this->promosi->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->namaPromosi;
			$row[] = '<img width="100" height="80" src="'.base_url('assets/img/promosi/'.$field->fotoPromosi).'" alt="">';
			$row[] = '<a href="javascript:;" class="btn btn-success btn-sm btn-promosi" data-idpromosi="'.$field->idPromosi.'"><i class="fas fa-edit"></i></a> <a href="'.base_url('promosi/hapus/'.$field->idPromosi).'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->promosi->count_all(),
			"recordsFiltered" => $this->promosi->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function EditPromosi($idpromosi = '')
	{
		if ($idpromosi == '') {
			$dataJson['status'] = 'false';
		} else {
			$dataPromosi = $this->global->getOneWhere(array('idPromosi' => $idpromosi), 't_promosi');
			if ($dataPromosi) {
				$dataJson['dataPromosi'] = $dataPromosi;
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
		$config['upload_path'] = './assets/img/promosi';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg';
	    $config['encrypt_name'] = FALSE;
	    
	    $this->upload->initialize($config);

		if(!empty($_FILES['foto']['name'])){
	        if ($this->upload->do_upload('foto')){
	    		$img = $this->upload->data();
	            //Compress Image
	            $config['image_library']='gd2';
	            $config['source_image']='./assets/img/promosi/'.$img['file_name'];
	            $config['create_thumb']= FALSE;
	            $config['maintain_ratio']= FALSE;
	            $config['quality']= '80%';
	            $config['new_image']= './assets/img/promosi/'.$img['file_name'];

	            $foto = $img['file_name'];
	            $post = $this->input->post();

	            $nama = $post['nama'];

	            $data = [
	            	"namaPromosi" 		=> $nama,
	            	"fotoPromosi" 		=> $foto
	            ];
	           	$success = $this->global->insert('t_promosi',$data);
	           	if (!$success) {
	           		echo $this->session->set_flashdata('msg','berhasil');
					redirect('promosi');
	           	}else{
	           		echo $this->session->set_flashdata('msg','gagalDisimpan');
					redirect('promosi');
	           	}
	        }else{
	        	echo $this->session->set_flashdata('msg','errorGambar');
				redirect('promosi');
	        }
	    }else{
    		echo $this->session->set_flashdata('msg','errorGambar');
			redirect('promosi');
	    }

	}

	public function edit()
	{
		$config['upload_path'] = './assets/img/promosi';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg';
	    $config['encrypt_name'] = FALSE;
	    
	    $this->upload->initialize($config);

		if(!empty($_FILES['fotoEdit']['name'])){
	        if ($this->upload->do_upload('fotoEdit')){
	    		$img = $this->upload->data();
	            //Compress Image
	            $config['image_library']='gd2';
	            $config['source_image']='./assets/img/promosi/'.$img['file_name'];
	            $config['create_thumb']= FALSE;
	            $config['maintain_ratio']= FALSE;
	            $config['quality']= '80%';
	            $config['new_image']= './assets/img/promosi/'.$img['file_name'];

	            $foto = $img['file_name'];
	            $post = $this->input->post();

	            $id = $post['idEdit'];
	            $nama = $post['namaEdit'];

	            $data = [
	            	"namaPromosi" 		=> $nama,
	            	"fotoPromosi" 		=> $foto
	            ];
	            // HAPUS FOTO
	            $dataPromosi = $this->global->getOneSpesificWhere('fotoPromosi', array('idPromosi' => $id), 't_promosi');
	            if (file_exists('assets/img/promosi/' . $dataPromosi->fotoPromosi))
				unlink('assets/img/promosi/' . $dataPromosi->fotoPromosi);

	           	$success = $this->global->update('t_promosi',$data,'idPromosi',$id);
	           	if (!$success) {
	           		echo $this->session->set_flashdata('msg','edit');
					redirect('promosi');
	           	}else{
	           		echo $this->session->set_flashdata('msg','gagalDiedit');
					redirect('promosi');
	           	}
	        }else{
	        	echo $this->session->set_flashdata('msg','errorGambar');
				redirect('promosi');
	        }
	    }else{
    			$post = $this->input->post();

	            $id = $post['idEdit'];
	            $nama = $post['namaEdit'];

	            $data = [
	            	"namaPromosi" 		=> $nama
	            ];
	           	$success = $this->global->update('t_promosi',$data,'idPromosi',$id);
	    		if (!$success) {
	           		echo $this->session->set_flashdata('msg','edit');
					redirect('promosi');
	           	}else{
	           		echo $this->session->set_flashdata('msg','gagalDiedit');
					redirect('promosi');
	           	}
	    }
	}

	public function hapus($id)
	{
		$dataPromosi = $this->global->getOneSpesificWhere('fotoPromosi', array('idPromosi' => $id), 't_promosi');
		if ($dataPromosi) {

			if (file_exists('assets/img/promosi/' . $dataPromosi->fotoPromosi))
				unlink('assets/img/promosi/' . $dataPromosi->fotoPromosi);

			$success = $this->global->delete('t_promosi','idPromosi',$id);
			if (!$success) {
				echo $this->session->set_flashdata('msg','hapus');
				redirect('promosi');
			} else {
				echo $this->session->set_flashdata('msg', 'gagalDihapus');
				redirect('promosi');
			}

		}else{
			echo $this->session->set_flashdata('msg', 'dataKosong');
			redirect('promosi');
		}
	}

}

/* End of file Promosi.php */
/* Location: ./application/controllers/Promosi.php */