<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infopertemuan extends CI_Controller {

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
		$data['title']  = 'Info Pertemuan';
	    $data['js']   = 'infopertemuan';
	    $this->template->load('template', 'mod/infoPertemuan/view_index', $data);
	}

	public function getInfo()
	{
		$list = $this->info->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = date('d F Y - h:i:s',strtotime($field->tanggalPertemuan));
			$row[] = $field->namaPertemuan;
			$row[] = $field->tempatPertemuan;
			$row[] = $field->noWa;
			$row[] = '<a href="'.base_url('infopertemuan/view_update/'.$field->idPertemuan).'" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a> <a href="'.base_url('infopertemuan/hapus/'.$field->idPertemuan).'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->info->count_all(),
			"recordsFiltered" => $this->info->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function getPageDetail()
	{
		// Search term
      	$searchTerm = $this->input->post('searchTerm');
      	// Get users
      	$response = $this->info->getPages($searchTerm);
      	echo json_encode($response);
	}

	public function view_update($idinfo)
	{
		$data['admin'] = $this->db->get_where('t_user',['id_user' => $this->session->userdata('id_user')])->row();
		$data['title']  = 'Edit Pertemuan';
	    $data['js']   	= 'infopertemuan';
	    $data['info']	= $this->info->getJoinInfo($idinfo);
	    $this->template->load('template', 'mod/infoPertemuan/view_edit', $data);
	}

	public function simpan()
	{
        $post = $this->input->post();
        $tanggal = date('yy-m-d h:i:00', strtotime($post['tanggal']));
        $tempat = $post['tempat'];
        $nama = $post['nama'];
        $guest = $post['guest'];
        $house = $post['house'];
        $no = $post['no'];
        $data = [
        	"tanggalPertemuan" 	=> $tanggal,
        	"namaPertemuan" 	=> $nama,
        	"tempatPertemuan" 	=> $tempat,
        	"guestSpeaker" 		=> $guest,
        	"houseCouple" 		=> $house,
        	"noWa" 				=> $no
        ];
       	$success = $this->global->insert('t_info_pertemuan',$data);
       	if (!$success) {
       		echo $this->session->set_flashdata('msg','berhasil');
			redirect('infopertemuan');
       	}else{
       		echo $this->session->set_flashdata('msg','gagalDisimpan');
			redirect('infopertemuan');
       	}
	}

	public function edit()
	{	
		$post = $this->input->post();
		$id = $post['id'];
		$sales = $post['sales'];
        $tanggal = date('yy-m-d h:i:00', strtotime($post['tanggal']));
        $tempat = $post['tempat'];
        $nama = $post['nama'];
        $guest = $post['guest'];
        $house = $post['house'];
        $no = $post['no'];
        $data = [
        	"tanggalPertemuan" 	=> $tanggal,
        	"namaPertemuan" 	=> $nama,
        	"tempatPertemuan" 	=> $tempat,
        	"guestSpeaker" 		=> $guest,
        	"houseCouple" 		=> $house,
        	"noWa" 				=> $no
        ];
       	$success = $this->global->update('t_info_pertemuan',$data,'idPertemuan',$id);
       	if (!$success) {
       		echo $this->session->set_flashdata('msg','edit');
			redirect('infopertemuan');
       	}else{
       		echo $this->session->set_flashdata('msg','gagalEdit');
			redirect('infopertemuan');
       	}
	}

	public function hapus($id)
	{
		$success = $this->global->delete('t_info_pertemuan','idPertemuan',$id);
		if (!$success) {
			echo $this->session->set_flashdata('msg','hapus');
			redirect('infopertemuan');
		} else {
			echo $this->session->set_flashdata('msg', 'gagalDihapus');
			redirect('infopertemuan');
		}
	}

}

/* End of file Pertemuan.php */
/* Location: ./application/controllers/Pertemuan.php */