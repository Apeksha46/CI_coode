<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishes extends MY_Controller {

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
        $wishesData['tableData'] = $this->CommonModel->selectResultData('wishes','wishes_id');
        $this->load->view('admin/wishes',$wishesData);
        $this->load->view('admin/common_files/footer');
    }

    public function update_wishe()
    {
        $data = array(
            "active_status"   => $this->input->post('active_status'),
            "text_msg"        => $this->input->post('text_msg')
        );
        if (empty($this->input->post('wishes_id'))) {
            $aboutUsData = $this->CommonModel->insertData($data,'wishes');  
            if ($aboutUsData) {
                $this->session->set_flashdata('success_wishes','Wishes Add Successfully');
                redirect('admin/Wishes');
            }else{
                $this->session->set_flashdata('error_wishes', 'Wishes Not added');
                redirect('admin/Wishes');
            }
        }else{
            $condition = array(
                "wishes_id" => $this->input->post('wishes_id')
            );
            $updateData = $this->CommonModel->updateRowByCondition($condition,'wishes',$data); 
            if ($updateData) { 
                $this->session->set_flashdata('success_wishes','Wishes change Successfully');
                redirect('admin/Wishes');
            }else{
                $this->session->set_flashdata('error_wishes','Wishes not Change ');
                redirect('admin/Wishes');
            }
        }
    }
    
}
