<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public $session;

    public $input;

    public $upload;

    public $access_control;

    public function __construct()
    {
        parent::__construct();
        $this->access_control->checkRole();
    }
    
    public function index()
    {
        $response = apiGet('users');
        $data['title'] = "Users";
        $data['content'] = 'user/index';
        $data['users'] = $response['data'];
        $data['topbar'] = true;
        $data['sidebar'] = true;
        $data['footer'] = true;
        $this->load->view('components/layout', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $error = null;
            $this->load->library('upload');
            $filename = sessionGet('username').'_'.uniqid(8).'_'.time();
            $config = array(
                'upload_path' => FCPATH . 'assets/uploads/users/',
                'allowed_types' => 'jpeg|jpg|webp|png',
                'max_size' => 5200,
                'detect_mime' => TRUE,
                'file_ext_tolower' => TRUE,
                'file_name' => $filename
            );

            $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('userPicture'))
            {
                $filename = 'user.png';
                $error = $this->upload->display_errors();
            }
            else
            {
                $img = $this->upload->data();
                $filename = $img['file_name'];
            }
            
            $data = [
                'userName' => $this->input->post('userName'),
                'userPassword' => password_hash($this->input->post('userPassword'), PASSWORD_ARGON2ID, [
                    'memory_cost' => 1<<17, 
                    'time_cost' => 4, 
                    'threads' => 2
                ]),
                'userLevel' => $this->input->post('userLevel'),
                'userStatus' => $this->input->post('userStatus'),
                'userPicture' => $filename
            ];

            $response = apiPost('users', $data);

            if ($response['code'] == 200) {
                $this->session->set_flashdata('success', 'User berhasil dibuat! ('.$error.')');
            } else {
                $this->session->set_flashdata('error', 'User gagal dibuat! ('.$error.')');
            }

            redirect('user');
        }
    }

    public function detail($id)
    {
        $response = apiGet('users/' . $id);
        $data['title'] = "User Detail";
        $data['content'] = 'user/detail';
        $data['user'] = $response['data'];
        $data['topbar'] = true;
        $data['sidebar'] = true;
        $data['footer'] = true;
        $this->load->view('components/layout', $data);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $error = null;
            $this->load->library('upload');
            $filename = sessionGet('username').'_'.uniqid(8).'_'.time();
            $config = array(
                'upload_path' => FCPATH . 'assets/uploads/users/',
                'allowed_types' => 'jpeg|jpg|webp|png',
                'max_size' => 5200,
                'detect_mime' => TRUE,
                'file_ext_tolower' => TRUE,
                'file_name' => $filename
            );

            $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('userPicture'))
            {
                $filename = $this->input->post('userPictureOld', TRUE);
                $error = $this->upload->display_errors();
            }
            else
            {
                $img = $this->upload->data();
                $filename = $img['file_name'];
            }

            $data = [
                'userName' => $this->input->post('userName'),
                'userPassword' => password_hash($this->input->post('userPassword'), PASSWORD_ARGON2ID, [
                    'memory_cost' => 1<<17, 
                    'time_cost' => 4, 
                    'threads' => 2
                ]),
                'userPicture' => $filename,
                'userLevel' => $this->input->post('userLevel'),
                'userStatus' => $this->input->post('userStatus'),
            ];

            $response = apiPut('users/' . $id, $data);

            if ($response['code'] == 200) {
                $this->session->set_flashdata('success', 'User berhasil diubah!');
            } else {
                $this->session->set_flashdata('error', 'User gagal diubah!');
            }

            redirect('user/detail/' . $id);
        }
    }

    public function delete($id)
    {
        $response = apiDelete('users/' . $id);
        if ($response['code'] == 200) {
            @unlink(FCPATH . 'uploads/users/' . sessionGet('user_picture'));
            $this->session->set_flashdata('success', 'User berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'User gagal dihapus');
        }

        redirect('user/index');
    }

}
?>