<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{
    public $access_control;

    public function index()
    {
        if(!$this->access_control->isLogin()) redirect('login');
        session_destroy();
        redirect('login');
    }
}