<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basicpack extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('download');
		if (!$this->session->userdata('username')) {
            redirect('goadmin','refresh');
        }
	}

	public function index()
	{
		$data['admin'] = $this->db->get_where('t_user',['id_user' => $this->session->userdata('id_user')])->row();
		$data['title']  = 'Basic Pack';
	    $data['js']   = 'basicpack';
	    $this->template->load('template', 'mod/basicPack/view_index', $data);
	}

	public function getBasicpack()
	{
		$list = $this->basicpack->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->namaBasicPack;
			$row[] = '<a href="https://www.youtube.com/watch?v='.$field->linkYoutube.'" target="_blank">'.$field->linkYoutube.'</a>';
			$row[] = '<a href="javascript:;" class="btn btn-success btn-sm btn-basic" data-idbasicpack="'.$field->idBasicPack.'"><i class="fas fa-edit"></i></a> <a href="'.base_url('basicpack/hapus/'.$field->idBasicPack).'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->basicpack->count_all(),
			"recordsFiltered" => $this->basicpack->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function EditBasic($idbasicpack = '')
	{
		if ($idbasicpack == '') {
			$dataJson['status'] = 'false';
		} else {
			$dataBasic = $this->global->getOneWhere(array('idBasicPack' => $idbasicpack), 't_basic_pack');
			if ($dataBasic) {
				$dataJson['dataBasic'] = $dataBasic;
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

	    $nama = $post['nama'];
	    $deskripsi = $post['deskripsi'];
	    $link = $post['link'];

	    $data = [
	    	"namaBasicPack" 		=> $nama,
	    	"deskripsiBasicPack" 	=> $deskripsi,
	    	"linkYoutube" 			=> $link
	    ];
	   	$success = $this->global->insert('t_basic_pack',$data);
	   	if (!$success) {
	   		echo $this->session->set_flashdata('msg','berhasil');
			redirect('basicpack');
	   	}else{
	   		echo $this->session->set_flashdata('msg','gagalDisimpan');
			redirect('basicpack');
	   	}
	        

	}

	public function edit()
	{
        $post = $this->input->post();
        $id = $post['id'];
        $nama = $post['namaEdit'];
        $link = $post['linkEdit'];
        $deskripsi = $post['deskripsiEdit'];

        $data = [
        	"namaBasicPack" 		=> $nama,
        	"deskripsiBasicPack" 	=> $deskripsi,
        	"linkYoutube" 			=> $link
        ];

       	$success = $this->global->update('t_basic_pack',$data,'idBasicPack',$id);
       	if (!$success) {
       		echo $this->session->set_flashdata('msg','edit');
			redirect('basicpack');
       	}else{
       		echo $this->session->set_flashdata('msg','gagalDiedit');
			redirect('basicpack');
       	}
	        
	}

	public function hapus($id)
	{
		$success = $this->global->delete('t_basic_pack','idBasicPack',$id);
		if (!$success) {
			echo $this->session->set_flashdata('msg','hapus');
			redirect('basicpack');
		} else {
			echo $this->session->set_flashdata('msg', 'gagalDihapus');
			redirect('basicpack');
		}
	}

}

/* End of file BasicPack.php */
/* Location: ./application/controllers/BasicPack.php */