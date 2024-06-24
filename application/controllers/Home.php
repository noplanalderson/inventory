<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $data['title'] = "Home";
        $data['content'] = 'home/index';
        $data['topbar'] = true;
        $data['sidebar'] = true;
        $data['footer'] = true;
        $this->load->view('components/layout', $data);
    }
}
