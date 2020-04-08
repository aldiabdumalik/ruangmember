<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
    $data['title']  = 'Dashboard';
    $data['js']   = 'dashboard';
    $data['user'] = $this->db->get('t_sales')->result();
    $this->template->load('template', 'mod/dashboard/view_index', $data);
  }

  public function aktif($id)
  {
    $this->db->set('status_sales', 1);
    $this->db->where('id_plm', $id);
    $success = $this->db->update('t_sales');

    if ($success) {
      echo $this->session->set_flashdata('msg','aktif');
      redirect('dashboard');
    }else{
      echo $this->session->set_flashdata('msg','gagalDiedit');
      redirect('dashboard');
    } 
    
  }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */