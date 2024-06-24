<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Devices extends CI_Controller
{
    public $session;

    public $input;

    public $output;

    public $form_validation;

    public $security;

    public $access_control;

    public function  __construct()
    {
        parent::__construct();
        if(!$this->access_control->isLogin()) redirect('login');
    }

    public function index($group = null)
    {
        $devicesResponse      = empty($group) ? apiGet('devices') : apiGet('devices/group/'.slug($group));
        $deviceGroupsResponse = apiGet('groups');
        $manufacturesResponse = apiGet('manufactures');
        $deviceModelsResponse = apiGet('device-models');

        $data = array(
            'title' => "SIMDC - Devices",
            'content' => 'devices/index',
            'topbar' => true,
            'sidebar' => true,
            'footer' => true,
            'js' => 'assets/js/devices.js',
            'devices' => $devicesResponse['data'],
            'groups' => $deviceGroupsResponse['data'],
            'manufactures' => $manufacturesResponse['data'],
            'models' => $deviceModelsResponse['data']
        );

        $this->load->view('components/layout', $data);
    }

    private function  __validation()
    {
        return array(
            array(
                'field' => 'hostname',
                'label' => 'Hostname',
                'rules' => 'trim|required|alpha_dash|max_length[255]'
            ),
            array(
                'field' => 'groupId',
                'label' => 'Device Group',
                'rules' => 'required|integer'
            ),
            array(
                'field' => 'manuId',
                'label' => 'Manufacture',
                'rules' => 'required|integer'
            ),
            array(
                'field' => 'modelId',
                'label' => 'Model',
                'rules' => 'required|integer'
            ),
            array(
                'field' => 'processor',
                'label' => 'Processor',
                'rules' => 'trim|regex_match[/[a-zA-Z0-9 ()@\-_]+$/]|max_length[100]',
                'errors'=> array(
                    'regex_match' => 'Allowed characters for {field} are alphanumeric, space, and ()@-_ '
                )
            ),
            array(
                'field' => 'cores',
                'label' => 'Cores',
                'rules' => 'integer|max_length[10]'
            ),
            array(
                'field' => 'memoryCap',
                'label' => 'Memory Cap.',
                'rules' => 'integer|max_length[10]'
            ),
            array(
                'field' => 'storageCap',
                'label' => 'Storage Cap.',
                'rules' => 'numeric'
            ),
            array(
                'field' => 'location',
                'label' => 'Location',
                'rules' => 'trim|required|alpha_numeric_spaces'
            ),
            array(
                'field' => 'rackNumber',
                'label' => 'Rack Number',
                'rules' => 'integer|max_length[10]'
            )
        );
    }

    public function get(int $id)
    {
        $result = apiGet('devices/'.$id);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function add()
    {
        if($this->input->is_ajax_request())
        {
            $status     = false;
            $message    = 'Failed to save device';
            $errors     = [];
            $post       = $this->input->post(null, true);

            $this->form_validation->set_rules($this->__validation());
            if($this->form_validation->run())
            {
                unset($post['deviceId']);
                $result = apiPost('devices', array_merge(['userId' => sessionGet('uid')], $post));
                $status = $result['success'];
                $message= $result['message'];
            }
            else
            {
                $errors = $this->form_validation->error_array();
            }

            $token  = $this->security->get_csrf_hash();
            $result = array('status' => $status, 'message' => $message, 'csrf_token' => $token, 'errors' => $errors);
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function edit()
    {
        if($this->input->is_ajax_request())
        {
            $status     = false;
            $message    = 'Failed to save device';
            $errors     = [];
            $post       = $this->input->post(null, true);

            $this->form_validation->set_rules($this->__validation());
            if($this->form_validation->run())
            {
                $result = apiPut('devices/'.$post['deviceId'], array_merge(['userId' => sessionGet('uid')], $post));
                $status = $result['success'];
                $message= $result['message'];
            }
            else
            {
                $errors = $this->form_validation->error_array();
            }

            $token  = $this->security->get_csrf_hash();
            $result = array('status' => $status, 'message' => $message, 'csrf_token' => $token, 'errors' => $errors);
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function delete()
    {
        $status  = false;
        $message = 'Failed to delete device';
        $errors  = [];
        $deviceId= $this->input->post('deviceId', TRUE);

        $this->form_validation->set_rules('deviceId', 'Device ID', 'required|integer');
        if($this->form_validation->run())
        {
            $result = apiDelete('devices/'.$deviceId);
            $status = $result['success'];
            $message= $result['message'];
        }
        else
        {
            $errors = $this->form_validation->error_array();
        }

        $token  = $this->security->get_csrf_hash();
        $result = array('status' => $status, 'message' => $message, 'csrf_token' => $token, 'errors' => $errors);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
}