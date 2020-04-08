<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Persentasistandar extends CI_Controller {

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
		$data['title']  = 'Persentasi Standar';
	    $data['js']   = 'persentasistandar';
	    $this->template->load('template', 'mod/persentasiStandar/view_index', $data);
	}

	public function getPersentasiStandar()
	{
		$list = $this->persentasistandar->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->deskripsiPersentasi;
			$row[] = '<a href="'.$field->linkYoutube.'" target="_blank" title="">'.$field->linkYoutube.'</a>';
			$row[] = '<a href="javascript:;" class="btn btn-success btn-sm btn-edit" data-idpersentasi="'.$field->idPersentasi.'"><i class="fas fa-edit"></i></a> <a href="'.base_url('persentasistandar/hapus/'.$field->idPersentasi).'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->persentasistandar->count_all(),
			"recordsFiltered" => $this->persentasistandar->count_filtered(),
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
			$dataPersentasi = $this->global->getOneWhere(array('idPersentasi' => $idpersentasi), 't_persentasi_standar');
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

		$this->db->truncate('t_persentasi_standar');
        $post = $this->input->post();

        $deskripsi = $post['deskripsi'];
        $link = $post['link'];
        $data = [
        	"deskripsiPersentasi" 	=> $deskripsi,
        	"linkYoutube" 			=> $link
        ];
       	$success = $this->global->insert('t_persentasi_standar',$data);
       	if (!$success) {
       		echo $this->session->set_flashdata('msg','berhasil');
			redirect('persentasistandar');
       	}else{
       		echo $this->session->set_flashdata('msg','gagalDisimpan');
			redirect('persentasistandar');
       	}
	}

	public function edit()
	{
		$post = $this->input->post();
		$id = $post['idEdit'];
        $deskripsi = $post['deskripsiEdit'];
        $link = $post['linkEdit'];
        $data = [
        	"deskripsiPersentasi" 	=> $deskripsi,
        	"linkYoutube" 			=> $link
        ];
       	$success = $this->global->update('t_persentasi_standar',$data,'idPersentasi',$id);
       	if (!$success) {
       		echo $this->session->set_flashdata('msg','edit');
			redirect('persentasistandar');
       	}else{
       		echo $this->session->set_flashdata('msg','gagalEdit');
			redirect('persentasistandar');
       	}
	}

	public function hapus($id)
	{
		$success = $this->global->delete('t_persentasi_standar','idPersentasi',$id);
		if (!$success) {
			echo $this->session->set_flashdata('msg','hapus');
			redirect('persentasistandar');
		} else {
			echo $this->session->set_flashdata('msg', 'gagalDihapus');
			redirect('persentasistandar');
		}
	}
}

/* End of file PersentasiStandar.php */
/* Location: ./application/controllers/PersentasiStandar.php */