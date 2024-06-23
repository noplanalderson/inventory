<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public $input;

    public $form_validation;

    public $access_control;

    public $output;

    public $security;

    public function index()
    {
        if(!$this->access_control->isLogin()) redirect('dashboard');

        $data = array(
            'title' => "Login - SIMDC",
            'content' => 'login/index',
            'topbar' => false,
            'sidebar' => false,
            'footer' => true,
            'js' => 'assets/js/login.js'
        );
        $this->load->view('components/layout', $data);
    }

    public function auth()
    {
        if($this->input->is_ajax_request()) {
            $status     = false;
            $message    = 'Login gagal';
            $errors     = ['username' => '', 'password' => ''];
            $username   = $this->input->post('username', TRUE);
            $password   = $this->input->post('password', TRUE);

            $this->form_validation->set_rules('username', 'Username', 'required|alpha_dash');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if($this->form_validation->run()) 
            {
                $data = apiGet('users/login/'.$username);

                if(empty($data['data'])) {
                    $message = $data['message'];
                } else {
                    $user = $data['data'];
                    if(password_verify($password, $user['userPassword'])) {
                        sessionSet([
                            'uid' => $user['userId'],
                            'gid' => $user['userLevel']
                        ]);
                        $status  = true;
                        $message = 'Login berhasil, mengalihkan ke halaman utama.';
                    }
                    else {
                        $message = 'Username atau password salah.'.$user['user_password'];
                    }
                }

            } else {
                $errors = $this->form_validation->error_array();
            }

            $token  = $this->security->get_csrf_hash();
            $result = array('status' => $status, 'message' => $message, 'csrf_token' => $token, 'rule_msg' => $errors);
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }
}