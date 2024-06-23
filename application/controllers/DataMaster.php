<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataMaster extends CI_Controller
{
    public $session;

    public $input;

    public function index()
    {
        $deviceGroupsResponse = apiGet('groups');
        $manufacturesResponse = apiGet('manufactures');
        $deviceModelsResponse = apiGet('device-models');

        $data['title'] = "Data Master";
        $data['content'] = 'data-master/index';
        $data['deviceGroups'] = $deviceGroupsResponse['data'];
        $data['manufactures'] = $manufacturesResponse['data'];
        $data['deviceModels'] = $deviceModelsResponse['data'];

        $this->load->view('components/layout', $data);
    }

    public function addManufacture()
    {
        $data = [
            'groupId' => $this->input->post('groupId'),
            'manuName' => $this->input->post('manuName')
        ];
        $response = apiPost('manufactures', $data);
        if ($response['success']) {
            $this->session->set_flashdata('message', 'Manufacture berhasil dibuat!');
        } else {
            $this->session->set_flashdata('error', 'Manufacture gagal dibuat!');
        }
        redirect('datamaster');
    }

    public function updateManufacture($id)
    {
        $data = [
            'groupId' => $this->input->post('groupId'),
            'manuName' => $this->input->post('manuName')
        ];
        $response = apiPut('manufactures/' . $id, $data);
        if ($response['success']) {
            $this->session->set_flashdata('message', 'Manufacture berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Manufacture gagal diubah!');
        }
        redirect('datamaster');
    }

    public function addDeviceModel()
    {
        $data = [
            'manuId' => $this->input->post('manuId'),
            'modelName' => $this->input->post('modelName'),
        ];
        $response = apiPost('device-models', $data);
        if ($response['success']) {
            $this->session->set_flashdata('message', 'Device Model berhasil dibuat!');
        } else {
            $this->session->set_flashdata('error', 'Device Model gagal dibuat!');
        }
        redirect('datamaster');
    }

    public function updateDeviceModel($id)
    {
        $data = [
            'manuId' => $this->input->post('manuId'),
            'modelName' => $this->input->post('modelName'),
        ];
        $response = apiPut('device-models/' . $id, $data);
        if ($response['success']) {
            $this->session->set_flashdata('message', 'Device Model berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Device Model gagal diubah!');
        }
        redirect('datamaster');
    }

    public function addDeviceGroup()
    {
        $data = [
            'groupName' => $this->input->post('groupName'),
            'groupIcon' => $this->input->post('groupIcon')
        ];
        $response = apiPost('groups', $data);
        if ($response['success']) {
            $this->session->set_flashdata('message', 'Device Group berhasil dibuat!');
        } else {
            $this->session->set_flashdata('error', 'Device Group gagal dibuat!');
        }
        redirect('datamaster');
    }

    public function updateDeviceGroup($id)
    {
        $data = [
            'groupName' => $this->input->post('groupName'),
            'groupIcon' => $this->input->post('groupIcon')
        ];
        $response = apiPut('groups/' . $id, $data);
        if ($response['success']) {
            $this->session->set_flashdata('message', 'Device Group berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Device Group gagal diubah!');
        }
        redirect('datamaster');
    }

    public function deleteManufacture($id)
    {
        $response = apiDelete('manufactures/' . $id);
        if ($response['code'] == 200) {
            $this->session->set_flashdata('message', 'Manufacture berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Manufacture gagal dihapus');
        }

        redirect('datamaster');
    }

    public function deleteDeviceModel($id)
    {
        $response = apiDelete('device-models/' . $id);
        if ($response['code'] == 200) {
            $this->session->set_flashdata('message', 'Device Model berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Device Model gagal dihapus');
        }

        redirect('datamaster');
    }

    public function deleteDeviceGroup($id)
    {
        $response = apiDelete('groups/' . $id);
        if ($response['code'] == 200) {
            $this->session->set_flashdata('message', 'Device Group berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Device Group gagal dihapus');
        }

        redirect('datamaster');
    }
}
?>