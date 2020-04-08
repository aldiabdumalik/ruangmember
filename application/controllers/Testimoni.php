<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimoni extends CI_Controller {

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
		$data['title']  = 'Testimoni';
	    $data['js']   = 'testimoni';
	    $this->template->load('template', 'mod/testimoni/view_index', $data);
	}

	public function getTestimoni()
	{
		$list = $this->testimoni->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->namaTestimoni;
			$row[] = $field->deskripsiTestimoni;
			$row[] = '<a href="'.$field->linkTestimoni.'" title="" target="_blank">'.$field->linkTestimoni.'</a>';
			$row[] = '<a href="javascript:;" class="btn btn-success btn-sm btn-edit" data-idtestimoni="'.$field->idTestimoni.'"><i class="fas fa-edit"></i></a> <a href="'.base_url('testimoni/hapus/'.$field->idTestimoni).'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->testimoni->count_all(),
			"recordsFiltered" => $this->testimoni->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function EditTestimoni($idtestimoni = '')
	{
		if ($idtestimoni == '') {
			$dataJson['status'] = 'false';
		} else {
			$dataTestimoni = $this->global->getOneWhere(array('idTestimoni' => $idtestimoni), 't_testimoni');
			if ($dataTestimoni) {
				$dataJson['dataTestimoni'] = $dataTestimoni;
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
        	"namaTestimoni" 		=> $nama,
        	"deskripsiTestimoni" 	=> $deskripsi,
        	"linkTestimoni" 		=> $link
        ];
       	$success = $this->global->insert('t_testimoni',$data);
       	if (!$success) {
       		echo $this->session->set_flashdata('msg','berhasil');
			redirect('testimoni');
       	}else{
       		echo $this->session->set_flashdata('msg','gagalDisimpan');
			redirect('testimoni');
       	}
	}

	public function edit()
	{
		$post = $this->input->post();
		$id = $post['id'];
        $nama = $post['namaEdit'];
        $deskripsi = $post['deskripsiEdit'];
        $link = $post['linkEdit'];
        $data = [
        	"namaTestimoni" 		=> $nama,
        	"deskripsiTestimoni" 	=> $deskripsi,
        	"linkTestimoni" 		=> $link
        ];
       	$success = $this->global->update('t_testimoni',$data,'idTestimoni',$id);
       	if (!$success) {
       		echo $this->session->set_flashdata('msg','edit');
			redirect('testimoni');
       	}else{
       		echo $this->session->set_flashdata('msg','gagalEdit');
			redirect('testimoni');
       	}
	}

	public function hapus($id)
	{
		$success = $this->global->delete('t_testimoni','idTestimoni',$id);
		if (!$success) {
			echo $this->session->set_flashdata('msg','hapus');
			redirect('testimoni');
		} else {
			echo $this->session->set_flashdata('msg', 'gagalDihapus');
			redirect('testimoni');
		}
	}

}

/* End of file Testimoni.php */
/* Location: ./application/controllers/Testimoni.php */