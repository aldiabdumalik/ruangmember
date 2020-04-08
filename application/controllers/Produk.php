<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller {

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
		$data['title']  = 'Produk';
	    $data['js']   = 'produk';
	    $this->template->load('template', 'mod/produk/view_index', $data);
	}

	public function getProduk()
	{
		$list = $this->produk->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<img width="100" height="80" src="'.base_url('assets/img/produk/'.$field->fotoProduk).'" alt="">';
			$row[] = $field->namaProduk;
			$row[] = '<a href="'.base_url('produk/view_edit/'.$field->idProduk).'" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a> <a href="'.base_url('produk/hapus/'.$field->idProduk).'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->produk->count_all(),
			"recordsFiltered" => $this->produk->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function EditProduk($idproduk = '')
	{
		if ($idproduk == '') {
			$dataJson['status'] = 'false';
		} else {
			$dataProduk = $this->global->getOneWhere(array('idProduk' => $idproduk), 't_produk');
			if ($dataProduk) {
				$dataJson['dataProduk'] = $dataProduk;
				$dataJson['status'] = 'true';
			} else {
				$dataJson['status'] = 'false';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($dataJson);
	}

	public function view_add()
	{
		$data['admin'] = $this->db->get_where('t_user',['id_user' => $this->session->userdata('id_user')])->row();
		$data['title']  = 'Tambah Produk';
	    $data['js']   = 'produk';
	    $this->template->load('template', 'mod/produk/view_add', $data);
	}

	public function view_edit($idproduk)
	{
		$data['admin'] = $this->db->get_where('t_user',['id_user' => $this->session->userdata('id_user')])->row();
		$data['title']  = 'Edit Produk';
	    $data['js']   	= 'produk';
	    $data['produk'] = $this->db->get_where('t_produk',['idProduk' => $idproduk])->row();
	    $this->template->load('template', 'mod/produk/view_edit', $data);
	}

	public function simpan()
	{
		$config['upload_path'] = './assets/img/produk';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg';
	    $config['encrypt_name'] = FALSE;
	    
	    $this->upload->initialize($config);

		if(!empty($_FILES['image']['name'])){
	        if ($this->upload->do_upload('image')){
	    		$img = $this->upload->data();
	            //Compress Image
	            $config['image_library']='gd2';
	            $config['source_image']='./assets/img/produk/'.$img['file_name'];
	            $config['create_thumb']= FALSE;
	            $config['maintain_ratio']= FALSE;
	            $config['quality']= '50%';
	            $config['width']= 600;
                $config['height']= 400;
	            $config['new_image']= './assets/img/produk/'.$img['file_name'];

	            $foto = $img['file_name'];
	            $post = $this->input->post();

	            $nama = $post['nama'];
	            $deskripsi = $post['deskripsi'];
	            $harga = $post['harga'];
	            $stok = $post['stok'];
				$kategori = $this->input->post('kategori');

	            $data = [
	            	"fotoProduk" 		=> $foto,
	            	"namaProduk" 		=> $nama,
	            	"deskripsiProduk" 	=> $deskripsi,
	            	"hargaProduk" 		=> $harga,
	            	"stokProduk" 		=> $stok,
	            	"kategoriProduk"	=> $kategori
	            ];
	           	$success = $this->produk->insert_produk($data);
	           	if ($kategori === 'retail') {
	           		echo $this->session->set_flashdata('msg','berhasil');
					redirect('produk');
		    //        	if (empty($success)) {
		    //        		echo $this->session->set_flashdata('msg','berhasil');
						// redirect('produk');
		    //        	}else{
		    //        		echo $this->session->set_flashdata('msg','gagalDisimpan');
						// redirect('produk');
		    //        	}
	           	}else{
		       		$arr_paket = $this->input->post('paket_produk');
					for ($i=0; $i < count($arr_paket); $i++) { 
						$data2[] = substr($arr_paket[$i], 0,-2);
					}
					// $paket = array_count_values($data);
					foreach ($data2 as $key => $pak) {
						$data_paket[] = $this->produk->get_byId(['idProduk' => $pak]);
					}
					foreach ($data_paket as $k => $v) {
						$paket_nih = [
							"parentProduk" => $success,
							"namaProduk" => $v[0]['namaProduk'],
							"deskripsiProduk" => 'null',
							"fotoProduk" => 'null',
			            	"hargaProduk" => $harga,
			            	"stokProduk" => 1,
			            	"kategoriProduk" => $kategori
						];
						$cek = $this->produk->produk_cek($paket_nih["namaProduk"], $paket_nih["parentProduk"]);
						if (empty($cek)) {
							$insert = $this->db->insert('t_produk', $paket_nih);
						}else{
							$paket_nih = [
								"parentProduk" => $success,
								"namaProduk" => $cek['namaProduk'],
								"deskripsiProduk" => 'null',
								"fotoProduk" => 'null',
				            	"hargaProduk" => $harga,
				            	"stokProduk" => $cek['stokProduk'] + 1,
				            	"kategoriProduk" => $kategori
							];
							$insert = $this->db->update('t_produk', $paket_nih, ['idProduk' => $cek['idProduk']]);
						}
					}
					echo $this->session->set_flashdata('msg','berhasil');
					redirect('produk');
	           	}
	        }else{
	        	echo $this->session->set_flashdata('msg','errorGambar');
				redirect('produk');
	        }
	    }else{
    		echo $this->session->set_flashdata('msg','errorGambar');
			redirect('produk');
	    }

	}

	public function edit()
	{
		$config['upload_path'] = './assets/img/produk';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg';
	    $config['encrypt_name'] = FALSE;
	    
	    $this->upload->initialize($config);

		if(!empty($_FILES['imageEdit']['name'])){
	        if ($this->upload->do_upload('imageEdit')){
	    		$img = $this->upload->data();
	            //Compress Image
	            $config['image_library']='gd2';
	            $config['source_image']='./assets/img/produk/'.$img['file_name'];
	            $config['create_thumb']= FALSE;
	            $config['maintain_ratio']= FALSE;
	            $config['quality']= '50%';
	            $config['width']= 600;
                $config['height']= 400;
	            $config['new_image']= './assets/img/produk/'.$img['file_name'];

	            $foto = $img['file_name'];
	            $post = $this->input->post();

	            $id = $post['idEdit'];
	            $nama = $post['namaEdit'];
	            $deskripsi = $post['deskripsiEdit'];
	            $harga = $post['hargaEdit'];
	            $stok = $post['stokEdit'];

	            $data = [
	            	"fotoProduk" 		=> $foto,
	            	"namaProduk" 		=> $nama,
	            	"deskripsiProduk" 	=> $deskripsi,
	            	"hargaProduk" 		=> $harga,
	            	"stokProduk" 		=> $stok
	            ];
	            // HAPUS FOTO
	            $dataProduk = $this->global->getOneSpesificWhere('fotoProduk', array('idProduk' => $id), 't_produk');
	            if (file_exists('assets/img/produk/' . $dataProduk->fotoProduk))
				unlink('assets/img/produk/' . $dataProduk->fotoProduk);

	           	$success = $this->global->update('t_produk',$data,'idProduk',$id);
	           	if (!$success) {
	           		echo $this->session->set_flashdata('msg','edit');
					redirect('produk');
	           	}else{
	           		echo $this->session->set_flashdata('msg','gagalDiedit');
					redirect('produk');
	           	}
	        }else{
	        	echo $this->session->set_flashdata('msg','errorGambar');
				redirect('produk');
	        }
	    }else{
    			$post = $this->input->post();

	            $id = $post['idEdit'];
	            $nama = $post['namaEdit'];
	            $deskripsi = $post['deskripsiEdit'];
	            $harga = $post['hargaEdit'];
	            $stok = $post['stokEdit'];

	            $data = [
	            	"namaProduk" 		=> $nama,
	            	"deskripsiProduk" 	=> $deskripsi,
	            	"hargaProduk" 		=> $harga,
	            	"stokProduk" 		=> $stok
	            ];

	           	$success = $this->global->update('t_produk',$data,'idProduk',$id);
	    		if (!$success) {
	           		echo $this->session->set_flashdata('msg','edit');
					redirect('produk');
	           	}else{
	           		echo $this->session->set_flashdata('msg','gagalDiedit');
					redirect('produk');
	           	}
	    }
	}

	public function hapus($id)
	{
		$dataProduk = $this->global->getOneSpesificWhere('fotoProduk', array('idProduk' => $id), 't_produk');
		if ($dataProduk) {

			if (file_exists('assets/img/produk/' . $dataProduk->fotoProduk))
				unlink('assets/img/produk/' . $dataProduk->fotoProduk);

			$success = $this->produk->delete_produk($id);
			if ($success) {
				echo $this->session->set_flashdata('msg','hapus');
				redirect('produk');
			} else {
				echo $this->session->set_flashdata('msg', 'gagalDihapus');
				redirect('produk');
			}

		}else{
			echo $this->session->set_flashdata('msg', 'dataKosong');
			redirect('produk');
		}
	}

	public function getProdukForSelect()
	{
		$produk = $this->produk->getProdukForSelect();
		foreach ($produk as $key => $prod) {
			for ($i=1; $i < 6; $i++) { 
				$pro[] = array(
					'idProduk' => $prod['idProduk'].'_'.$i,
					'namaProduk' => $prod['namaProduk']
				);
			}
		}
		echo json_encode($pro);
	}


	public function upload_image()
	{
		if (isset($_FILES["image"]["name"])) {
			$config['upload_path'] = './assets/img/produk';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['encrypt_name'] = false;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('image')) {
				$error = $this->upload->display_errors();
				return json_encode($error);
			} else {
				$data = $this->upload->data();
				echo base_url() . 'assets/img/produk/' . $data['file_name'];
			}
		}
	}

	public function delete_image()
	{
		$src = $this->input->post('src');
		$file_name = str_replace(base_url(), '', $src);
		if (unlink($file_name)) {
			echo 'File Delete Successfully';
		}
	}

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */