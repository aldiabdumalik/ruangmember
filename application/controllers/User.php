<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('username')) {
        redirect('goadmin','refresh');
    }
  }

  public function index()
  {
    redirect('dashboard','refresh');
  }

  public function account()
  {
    $data['title']  = 'User';
    $data['js']   = 'user';
    $data['admin'] = $this->db->get_where('t_user',['id_user' => $this->session->userdata('id_user')])->row();
    $this->template->load('template', 'mod/user/view_index', $data);
  }

  public function edit()
  {
      $config['upload_path'] = './assets/img/user';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['encrypt_name'] = TRUE;

      $this->upload->initialize($config);
      if(!empty($_FILES['foto']['name'])){
          if ($this->upload->do_upload('foto')){
          $img = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./assets/img/user/'.$img['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['new_image']= './assets/img/user/'.$img['file_name'];

              $image = $img['file_name'];
              $id = $this->session->userdata('id_user');
              $username = $this->input->post('username');
              $nowa = $this->input->post('nowa');

              $data = [
                'username' => $username,
                'no_wa_user' => $nowa,
                'foto' => $image
              ];

              // HAPUS FOTO
              $dataUser = $this->global->getOneSpesificWhere('foto', array('id_user' => $this->session->userdata('id_user')), 't_user');
              if (file_exists('assets/img/user/' . $dataUser->foto))
              unlink('assets/img/user/' . $dataUser->foto);

              $success = $this->global->update('t_user',$data,'id_user',$id);
              if (!$success) {
                echo $this->session->set_flashdata('msg','edit');
                redirect('user/account/'.$this->session->userdata('id_user'));
              }else{
                echo $this->session->set_flashdata('msg','gagalDiedit');
                redirect('user/account/'.$this->session->userdata('id_user'));
              }
        }
      }else{
              $id = $this->session->userdata('id_user');
              $username = $this->input->post('username');
              $nowa = $this->input->post('nowa');

              $data = [
                'username' => $username,
                'no_wa_user' => $nowa
              ];
              $success = $this->global->update('t_user',$data,'id_user',$id);
              if (!$success) {
                echo $this->session->set_flashdata('msg','edit');
                redirect('user/account/'.$this->session->userdata('id_user'));
              }else{
                echo $this->session->set_flashdata('msg','edit');
                redirect('user/account/'.$this->session->userdata('id_user'));
              }
      }
  }

  public function ganti()
  {
    $lama = $this->input->post('lama');
    $baru = $this->input->post('baru');
    
    $user = $this->db->get_where('t_user', ['id_user'=> $this->session->userdata('id_user')])->row_array();
    if (password_verify($lama, $user['password'])) {
        $password_hash = password_hash($baru, PASSWORD_DEFAULT);

        $this->db->set('password', $password_hash);
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->update('t_user');
        echo $this->session->set_flashdata('msg', 'password');
        redirect('user/account/'.$this->session->userdata('username'), 'refresh');
    }else{
      echo $this->session->set_flashdata('msg', 'gagalpassword');
      redirect('user/account/'.$this->session->userdata('username'), 'refresh');
    }
  }
}