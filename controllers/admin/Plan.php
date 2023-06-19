<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plan extends MY_Controller {

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
        $catData['tableData'] = $this->CommonModel->selectResultData('plan','plan_id');
        $this->load->view('admin/plan/show_plan',$catData);
        $this->load->view('admin/common_files/footer');
    }

    //Add about us page
    public function add_plan()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $this->load->view('admin/plan/add_plan');
        $this->load->view('admin/common_files/footer');
    }

    //Edit about us page
	public function edit_plan()
	{
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("plan_id" => $this->uri->segment(4));
        $planData['tableData'] = $this->CommonModel->selectRowDataByCondition($condition,'plan');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/plan/edit_plan',$planData);
        $this->load->view('admin/common_files/footer');
	}

    //Insert About Us.
    public function insert_plan()
    {
        if (empty($this->input->post('plan_name'))) {
            $this->session->set_flashdata('error', 'Please fill all the field');
            redirect('admin/plan/add_plan');
        }
        $data = array(
            "plan_name"     => $this->input->post('plan_name'),
            "days"          => $this->input->post('days'),
            "price"         => $this->input->post('price'),
            "created_at"    => date('Y-m-d H:i:s a'),
            "updated_at"    => date('Y-m-d H:i:s a')
        );
        // print_r($condition);exit;
        $aboutUsData = $this->CommonModel->insertData($data,'plan');  
        if ($aboutUsData) {
            $this->session->set_flashdata('success','plan add Successfully');
            redirect('admin/plan/add_plan');
        }else{
            $this->session->set_flashdata('error', 'plan not added');
            redirect('admin/plan/add_plan');
        }
    }

    //Update About Us.
    public function update_plan()
    {
        if (empty($this->input->post('plan_name'))) {
            $this->session->set_flashdata('error', 'Please fill all the field');
            redirect('admin/plan/edit_plan/'.$this->input->post('plan_id'));
        }
        $condition = array(
            "plan_id" => $this->input->post('plan_id')
        );
        $data = array(
            "plan_name"     => $this->input->post('plan_name'),
            "days"          => $this->input->post('days'),
            "price"         => $this->input->post('price'),
            "updated_at"    => date('Y-m-d H:i:s a')
        );
        // print_r($condition);exit;
        $planData = $this->CommonModel->updateRowByCondition($condition,'plan',$data);  
        if ($planData) {
            $this->session->set_flashdata('success','plan updadted Successfully');
            redirect('admin/plan/edit_plan/'.$this->input->post('plan_id'));
        }else{
            $this->session->set_flashdata('error', 'plan not updadted');
            redirect('admin/plan/edit_plan/'.$this->input->post('plan_id'));
        }
    }

    //Update About Us.
    public function delete_plan()
    {
        $condition = array(
            "plan_id" => $this->input->post('plan_id')
        );
        $planData = $this->CommonModel->delete($condition,'plan');  
        if ($planData) {
            echo "1";
        }else{
            echo "0";
        }
    }
}
