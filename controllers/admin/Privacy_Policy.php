<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy_Policy extends MY_Controller {

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
        $aboutUsData['tableData'] = $this->CommonModel->selectResultData('privacy_policy','privacy_policy_id');
        $this->load->view('admin/privacy_policy',$aboutUsData);
        $this->load->view('admin/common_files/footer');
    }

    public function update_policy()
    {
        $data = array(
            "title"      => $this->input->post('title'),
            "content" => $this->input->post('content')
        );
        if (empty($this->input->post('privacy_policy_id'))) {
            $aboutUsData = $this->CommonModel->insertData($data,'privacy_policy');  
            if ($aboutUsData) {
                $this->session->set_flashdata('success','Add Successfully');
                redirect('admin/Privacy_Policy');
            }else{
                $this->session->set_flashdata('error', 'Not added');
                redirect('admin/Privacy_Policy');
            }
        }else{
            $condition = array(
                "privacy_policy_id" => $this->input->post('termCondition_id')
            );
            $updateData = $this->CommonModel->updateRowByCondition($condition,'privacy_policy',$data); 
            if ($updateData) { 
                $this->session->set_flashdata('success','change Successfully');
                redirect('admin/Privacy_Policy');
            }else{
                $this->session->set_flashdata('error','not change ');
                redirect('admin/Privacy_Policy');
            }
        }
    }
    
}
