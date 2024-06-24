<?php
defined('BASEPATH') or exit('No direct script access allowed');
use \Dompdf\Dompdf;

class Export extends CI_Controller
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
        $devicesResponse    = empty($group) ? apiGet('devices') : apiGet('devices/group/'.slug($group));
        $deviceGroup        = empty($group) ? 'All' : apiGet('groups/'.$group)['data']['groupName'];

        $filename   = "Device List ".$deviceGroup.".pdf";

        $dompdf = new Dompdf();
        
        $data = array(
            'title' => "SIMDC - Devices",
            'devices' => $devicesResponse['data'],
            'group' => $deviceGroup
        );
        
        $dompdf->loadHtml($this->load->view('devices/export_device', $data, true));

        $dompdf->setPaper('Legal', 'landscape');

        $dompdf->render();

        $dompdf->stream($filename);
    }
}