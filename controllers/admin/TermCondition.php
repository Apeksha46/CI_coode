<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TermCondition extends MY_Controller {

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
        $aboutUsData['tableData'] = $this->CommonModel->selectResultData('termCondition','termCondition_id');
        $this->load->view('admin/term_and_condition',$aboutUsData);
        $this->load->view('admin/common_files/footer');
    }

    public function update_termCondition()
    {
        $data = array(
            "title"      => $this->input->post('title'),
            "content" => $this->input->post('content')
        );
        if (empty($this->input->post('termCondition_id'))) {
            $aboutUsData = $this->CommonModel->insertData($data,'termCondition');  
            if ($aboutUsData) {
                $this->session->set_flashdata('success','Add Successfully');
                redirect('admin/TermCondition');
            }else{
                $this->session->set_flashdata('error', 'Not added');
                redirect('admin/TermCondition');
            }
        }else{
            $condition = array(
                "termCondition_id" => $this->input->post('termCondition_id')
            );
            $updateData = $this->CommonModel->updateRowByCondition($condition,'termCondition',$data); 
            if ($updateData) { 
                $this->session->set_flashdata('success','change Successfully');
                redirect('admin/TermCondition');
            }else{
                $this->session->set_flashdata('error','not change ');
                redirect('admin/TermCondition');
            }
        }
    }
    
}
