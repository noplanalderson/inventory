<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('API_Request');
    }

    public function index()
    {
        $response = $this->api_request->get('users');
        $data['title'] = "Users";
        $data['content'] = 'user/index';
        $data['users'] = $response['data'];
        $this->load->view('components/layout', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'userName' => $this->input->post('userName'),
                'userPassword' => $this->input->post('userPassword'),
                'userPicture' => $this->input->post('userPicture'),
                'userLevel' => $this->input->post('userLevel'),
                'userStatus' => $this->input->post('userStatus'),
            ];

            $response = $this->api_request->post('users', $data);

            if ($response['code'] == 200) {
                $this->session->set_flashdata('success', 'User berhasil dibuat!');
            } else {
                $this->session->set_flashdata('error', 'User gagal dibuat!');
            }

            redirect('user');
        }
    }

    public function detail($id)
    {
        $response = $this->api_request->get('users/' . $id);
        $data['title'] = "User Detail";
        $data['content'] = 'user/detail';
        $data['user'] = $response['data'];
        $this->load->view('components/layout', $data);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'userName' => $this->input->post('userName'),
                'userPassword' => $this->input->post('userPassword'),
                'userPicture' => $this->input->post('userPicture'),
                'userLevel' => $this->input->post('userLevel'),
                'userStatus' => $this->input->post('userStatus'),
            ];

            $response = $this->api_request->put('users/' . $id, $data);

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
        $response = $this->api_request->delete('users/' . $id);
        if ($response['code'] == 200) {
            $this->session->set_flashdata('success', 'User berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'User gagal dihapus');
        }

        redirect('user/index');
    }

}
?>