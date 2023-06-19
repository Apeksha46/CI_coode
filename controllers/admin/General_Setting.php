<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_Setting extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $sessionValue = $this->_adminLoginCheck();
    }
    //show about us
    public function index()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $aboutUsData['tableData'] = $this->CommonModel->selectResultData('general_setting','general_setting_id');
        $this->load->view('admin/general_setting',$aboutUsData);
        $this->load->view('admin/common_files/footer');
    }

    public function update_general_setting()
    {
        $data = array(
            "address"           => $this->input->post('address'),
            "general_setting_id"=> $this->input->post('general_setting_id'),
            "postal_code"       => $this->input->post('postal_code'),
            "email_1"           => $this->input->post('email_1'),
            "email_2"           => $this->input->post('email_2'),
            "email_3"           => $this->input->post('email_3'),
            "alt_mobile"        => $this->input->post('alt_mobile'),
            "mobile"            => $this->input->post('mobile'),
            "facebook"          => $this->input->post('facebook'),
            "twittter"          => $this->input->post('twittter'),
            "instagram"         => $this->input->post('instagram'),
        );
        if (empty($this->input->post('general_setting_id'))) {
            $aboutUsData = $this->CommonModel->insertData($data,'general_setting');  
            if ($aboutUsData) {
                $this->session->set_flashdata('success_setting','Add Successfully');
                redirect('admin/General_Setting/');
            }else{
                $this->session->set_flashdata('error_setting', 'Not added');
                redirect('admin/General_Setting/');
            }
        }else{
            $condition = array(
                "general_setting_id" => $this->input->post('general_setting_id')
            );
            $updateData = $this->CommonModel->updateRowByCondition($condition,'general_setting',$data); 
            if ($updateData) { 
                $this->session->set_flashdata('success_setting','Change Successfully');
                redirect('admin/General_Setting/');
            }else{
                $this->session->set_flashdata('error_setting','Not Change ');
                redirect('admin/General_Setting/');
            }
        }
    }

}
