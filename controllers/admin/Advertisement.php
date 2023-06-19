<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertisement extends MY_Controller {

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
        $advertData['tableData'] = $this->CommonModel->advert('advert','advert_id');
        $this->load->view('admin/advertisement/advert',$advertData);
        $this->load->view('admin/common_files/footer');
    }

    //Add about us page
    public function add_advert()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $planData['plan'] = $this->CommonModel->selectAllResultData('plan');
        $planData['seller'] = $this->CommonModel->selectAllResultData('seller');
        $this->load->view('admin/advertisement/add_advert',$planData);
        $this->load->view('admin/common_files/footer');
    }

    //Edit about us page
	public function edit_advert()
	{
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("advert_id" => $this->uri->segment(4));
        $advertData['tableData'] = $this->CommonModel->selectRowDataByCondition($condition,'advert');
        $advertData['plan'] = $this->CommonModel->selectAllResultData('plan');
        $advertData['seller'] = $this->CommonModel->selectAllResultData('seller');

        // print_r($aboutUsData);exit;
        $this->load->view('admin/advertisement/edit_advert',$advertData);
        $this->load->view('admin/common_files/footer');
	}

    //Insert About Us.
    public function insert_advert()
    {
        if (empty($this->input->post('advert_name')) && empty($this->input->post('advert_desc')))
        {
            $this->session->set_flashdata('error', 'Please fill all the field');
            redirect('admin/advertisement/add_advert');
        }
        $config['upload_path']   = './advertisement/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);
        
        // print_r($_FILES['image']['name']);exit;
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "plan_id"       => $this->input->post('plan_id'),
                "advert_name"   => $this->input->post('advert_name'),
                "seller_id"   => $this->input->post('seller_id'),
                "advert_desc"   => $this->input->post('advert_desc'),
                "from_date"     => $this->input->post('from_date'),
                "to_date"       => $this->input->post('to_date'),
                "created_at"    => date('Y-m-d H:i:s a'),
                "updated_at"    => date('Y-m-d H:i:s a')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                // echo $this->upload->display_errors();
                $this->session->set_flashdata('error', $this->upload->display_errors());
                // $error = array('error' => $this->upload->display_errors()); 
                // $this->load->view('imageUploadForm', $error); 
                redirect('admin/Advertisement/add_advert');
            }else { 
                $data = array(
                    "plan_id"        => $this->input->post('plan_id'),
                    "advert_name"    => $this->input->post('advert_name'),
                    "seller_id"      => $this->input->post('seller_id'),
                    "advert_desc"    => $this->input->post('advert_desc'),
                    "created_at"     => date('Y-m-d H:i:s a'),
                    "updated_at"     => date('Y-m-d H:i:s a'),
                    "advert_profile" => $this->upload->data('file_name')
                );
            } 
        }
        
        // print_r($condition);exit;
        $advertData = $this->CommonModel->insertData($data,'advert');  
        if ($advertData) {
            $this->session->set_flashdata('success','Advertisement add Successfully');
            redirect('admin/advertisement/add_advert');
        }else{
            $this->session->set_flashdata('error', 'Advertisement not added');
            redirect('admin/advertisement/add_advert');
        }
    }

    //Update About Us.
    public function update_advert()
    {
        if (empty($this->input->post('advert_name')) && empty($this->input->post('advert_desc')))
        {
            $this->session->set_flashdata('error', 'Please fill all the field');
            redirect('admin/advertisement/edit_advert/'.$this->input->post('advert_id'));
        }
        $condition = array(
            "advert_id" => $this->input->post('advert_id')
        );
        $config['upload_path']   = './advertisement/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        // $config['max_size']      = 1024;
        $this->load->library('upload', $config);
        
        // print_r($_FILES['image']['name']);exit;
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "plan_id"        => $this->input->post('plan_id'),
                "advert_name"    => $this->input->post('advert_name'),
                "seller_id"      => $this->input->post('seller_id'),
                "advert_desc"    => $this->input->post('advert_desc'),
                "from_date"      => $this->input->post('from_date'),
                "to_date"        => $this->input->post('to_date'),
                "updated_at"     => date('Y-m-d H:i:s a')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                // echo $this->upload->display_errors();
                $this->session->set_flashdata('error', $this->upload->display_errors());
                // $error = array('error' => $this->upload->display_errors()); 
                // $this->load->view('imageUploadForm', $error); 
                redirect('admin/Advertisement/edit_advert/'.$this->input->post('advert_id'));
            }else { 
                $data = array(
                    "plan_id"        => $this->input->post('plan_id'),
                    "seller_id"      => $this->input->post('seller_id'),
                    "advert_name"    => $this->input->post('advert_name'),
                    "advert_desc"    => $this->input->post('advert_desc'),
                    "from_date"      => $this->input->post('from_date'),
                    "to_date"        => $this->input->post('to_date'),
                    "updated_at"     => date('Y-m-d H:i:s a'),
                    "advert_profile" => $this->upload->data('file_name')
                );
            } 
        }
        
        // print_r($condition);exit;
        $advertData = $this->CommonModel->updateRowByCondition($condition,'advert',$data);  
        if ($advertData) {
            $this->session->set_flashdata('success','Advertisement updadted Successfully');
            redirect('admin/advertisement/edit_advert/'.$this->input->post('advert_id'));
        }else{
            $this->session->set_flashdata('error', 'Advertisement not updadted');
            redirect('admin/advertisement/edit_advert/'.$this->input->post('advert_id'));
        }
    }

    //Update About Us.
    public function delete_advert()
    {
        $condition = array(
            "advert_id" => $this->input->post('advert_id')
        );
        $advertData = $this->CommonModel->delete($condition,'advert');  
        if ($advertData) {
            echo "1";
        }else{
            echo "0";
        }
    }
}
