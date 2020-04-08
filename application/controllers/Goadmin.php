<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Goadmin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('dashboard','refresh');
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false ) {
            $data['title'] = "Login Disini.";
            $this->load->view('goadmin/login', $data);
        }else{
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('t_user', ['username'=> $username])->row_array();
	        if ($user) {
            if($user['is_actived'] == 1 ) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id_user' => $user['id_user'],
                        'username' => $user['username'],
                        'foto' => $user['foto'],
                        'level' => $user['level']
                    ];
                    $this->session->set_userdata($data);
                    redirect('dashboard');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password yang anda masukkan salah.</div>');
                    redirect('goadmin');
                }
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akunnya belum aktif.!</div>');
            redirect('goadmin');
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak ada.</div>');
            redirect('goadmin');
        }
    }

    // public function regis()
    // {
    // 	$data = array(
    // 		'username' => 'admin', 
    // 		'password' => password_hash('admin', PASSWORD_DEFAULT), 
    // 		'foto' => 'default', 
    // 		'level' => 'admin', 
    // 		'is_actived' => 1
    // 	);
    // 	$this->db->insert('t_user', $data);
    // }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('foto');
        $this->session->unset_userdata('level');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil logout!</div>');
        redirect('goadmin');
    }

}

/* End of file Goadmin.php */
/* Location: ./application/controllers/Goadmin.php */