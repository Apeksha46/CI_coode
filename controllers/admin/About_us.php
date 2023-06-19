<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_us extends MY_Controller {

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
        $aboutUsData['tableData'] = $this->CommonModel->selectResultData('about_us','about_us_id');
        $this->load->view('admin/about_us/edit_about_us',$aboutUsData);
        $this->load->view('admin/common_files/footer');
    }

    //Add about us page
    public function add_about_us()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $this->load->view('admin/about_us/add_about_us');
        $this->load->view('admin/common_files/footer');
    }

    //Edit about us page
	public function edit_about_us()
	{
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        // $condition = array("about_us_id" => $this->uri->segment(4));
        $aboutUsData['tableData'] = $this->CommonModel->selectAllResultData('about_us');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/about_us/edit_about_us',$aboutUsData);
        $this->load->view('admin/common_files/footer');
	}

    //Insert About Us.
    public function insert_about_us()
    {
        if (empty($this->input->post('content'))) {
            $this->session->set_flashdata('error', 'Please write something');
            redirect('admin/About_us/add_about_us');
        }
        $data = array(
            "content"    => $this->input->post('content'),
            "created_at" => date('Y-m-d H:i:s a'),
            "updated_at" => date('Y-m-d H:i:s a')
        );
        // print_r($condition);exit;
        $aboutUsData = $this->CommonModel->insertData($data,'about_us');  
        if ($aboutUsData) {
            $this->session->set_flashdata('success','Content add Successfully');
            redirect('admin/About_us/add_about_us');
        }else{
            $this->session->set_flashdata('error', 'Content not added');
            redirect('admin/About_us/add_about_us');
        }
    }

    //Update About Us.
    public function update_about_us1()
    {
        if (empty($this->input->post('content'))) {
            $this->session->set_flashdata('error', 'Please write something');
            redirect('admin/About_us/edit_about_us/'.$this->input->post('about_us_id'));
        }
        $condition = array(
            "about_us_id" => $this->input->post('about_us_id')
        );
        $data = array(
            "title"      => $this->input->post('title'),
            "content"    => $this->input->post('content'),
            "updated_at" => date('Y-m-d H:i:s a')
        );
        // print_r($condition);exit;
        $aboutUsData = $this->CommonModel->updateRowByCondition($condition,'about_us',$data);  
        if ($aboutUsData) {
            $this->session->set_flashdata('success','Content updadted Successfully');
            redirect('admin/About_us/edit_about_us/'.$this->input->post('about_us_id'));
        }else{
            $this->session->set_flashdata('error', 'Content not updadted');
            redirect('admin/About_us/edit_about_us/'.$this->input->post('about_us_id'));
        }
    }

    public function update_about_us()
    {
        $data = array(
            "title"      => $this->input->post('title'),
            "content" => $this->input->post('content')
        );
        if (empty($this->input->post('about_us_id'))) {
            $aboutUsData = $this->CommonModel->insertData($data,'about_us');  
            if ($aboutUsData) {
                $this->session->set_flashdata('success','Add Successfully');
                redirect('admin/About_us/edit_about_us');
            }else{
                $this->session->set_flashdata('error', 'Not added');
                redirect('admin/About_us/edit_about_us');
            }
        }else{
            $condition = array(
                "about_us_id" => $this->input->post('about_us_id')
            );
            $updateData = $this->CommonModel->updateRowByCondition($condition,'about_us',$data); 
            if ($updateData) { 
                $this->session->set_flashdata('success','change Successfully');
                redirect('admin/About_us/edit_about_us');
            }else{
                $this->session->set_flashdata('error','not change ');
                redirect('admin/About_us/edit_about_us');
            }
        }
    }
    //Update About Us.
    public function delete_about_us()
    {
        $condition = array(
            "about_us_id" => $this->input->post('about_us_id')
        );
        $aboutUsData = $this->CommonModel->delete($condition,'about_us');  
        if ($aboutUsData) {
            echo "1";
        }else{
            echo "0";
        }
    }
}
