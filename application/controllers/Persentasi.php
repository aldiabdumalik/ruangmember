<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Persentasi extends CI_Controller {

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
		$data['title']  = 'Persentasi';
	    $data['js']   = 'persentasi';
	    $this->template->load('template', 'mod/persentasi/view_index', $data);
	}

	public function getPersentasi()
	{
		$list = $this->persentasi->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->namaPersentasi;
			$row[] = $field->deskripsiPersentasi;
			$row[] = '<a href="'.$field->linkPersentasi.'" title="" target="_blank">'.$field->linkPersentasi.'</a>';
			$row[] = '<a href="javascript:;" class="btn btn-success btn-sm btn-edit" data-idpersentasi="'.$field->idPersentasi.'"><i class="fas fa-edit"></i></a> <a href="'.base_url('persentasi/hapus/'.$field->idPersentasi).'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->persentasi->count_all(),
			"recordsFiltered" => $this->persentasi->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function EditPersentasi($idpersentasi = '')
	{
		if ($idpersentasi == '') {
			$dataJson['status'] = 'false';
		} else {
			$dataPersentasi = $this->global->getOneWhere(array('idPersentasi' => $idpersentasi), 't_persentasi');
			if ($dataPersentasi) {
				$dataJson['dataPersentasi'] = $dataPersentasi;
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
        	"namaPersentasi" 	=> $nama,
        	"deskripsiPersentasi" 	=> $deskripsi,
        	"linkPersentasi" 			=> $link
        ];
       	$success = $this->global->insert('t_persentasi',$data);
       	if (!$success) {
       		echo $this->session->set_flashdata('msg','berhasil');
			redirect('persentasi');
       	}else{
       		echo $this->session->set_flashdata('msg','gagalDisimpan');
			redirect('persentasi');
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
        	"namaPersentasi" 		=> $nama,
        	"deskripsiPersentasi" 	=> $deskripsi,
        	"linkPersentasi" 		=> $link
        ];
       	$success = $this->global->update('t_persentasi',$data,'idPersentasi',$id);
       	if (!$success) {
       		echo $this->session->set_flashdata('msg','edit');
			redirect('persentasi');
       	}else{
       		echo $this->session->set_flashdata('msg','gagalEdit');
			redirect('persentasi');
       	}
	}

	public function hapus($id)
	{
		$success = $this->global->delete('t_persentasi','idPersentasi',$id);
		if (!$success) {
			echo $this->session->set_flashdata('msg','hapus');
			redirect('persentasi');
		} else {
			echo $this->session->set_flashdata('msg', 'gagalDihapus');
			redirect('persentasi');
		}
	}

}

/* End of file Persentasi.php */
/* Location: ./application/controllers/Persentasi.php */