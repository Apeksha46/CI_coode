<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription_Plan extends MY_Controller {

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
        $catData['tableData'] = $this->CommonModel->selectResultData('subscription','subscription_plan_id');
        $this->load->view('admin/subscription/show_subscription_plan',$catData);
        $this->load->view('admin/common_files/footer');
    }

    //Add about us page
    public function add_subscription_plan()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $this->load->view('admin/subscription/add_subscription_plan');
        $this->load->view('admin/common_files/footer');
    }

    //Edit about us page
	public function edit_subscription_plan()
	{
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("subscription_plan_id" => $this->uri->segment(4));
        $planData['tableData'] = $this->CommonModel->selectRowDataByCondition($condition,'subscription');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/subscription/edit_subscription_plan',$planData);
        $this->load->view('admin/common_files/footer');
	}

    //Insert About Us.
    public function insert_subscription_plan()
    {
        if (empty($this->input->post('plan_name'))) {
            $this->session->set_flashdata('error', 'Please fill all the field');
            redirect('admin/Subscription_Plan/add_subscription_plan');
        }
        $data = array(
            "subscription_plan_name" => $this->input->post('plan_name'),
            "days"          => $this->input->post('days'),
            "price"         => $this->input->post('price'),
            "gstTax"        => $this->input->post('gstTax'),
            "created_at"    => date('Y-m-d H:i:s a'),
            "updated_at"    => date('Y-m-d H:i:s a')
        );
        // print_r($condition);exit;
        $aboutUsData = $this->CommonModel->insertData($data,'subscription');  
        if ($aboutUsData) {
            $this->session->set_flashdata('success','Subscription Plan add Successfully');
            redirect('admin/Subscription_Plan/add_subscription_plan');
        }else{
            $this->session->set_flashdata('error', 'plan not added');
            redirect('admin/Subscription_Plan/add_subscription_plan');
        }
    }

    //Update About Us.
    public function update_subscription_plan()
    {
        if (empty($this->input->post('plan_name'))) {
            $this->session->set_flashdata('error', 'Please fill all the field');
            redirect('admin/Subscription_Plan/edit_subscription_plan/'.$this->input->post('subscription_plan_id'));
        }
        $condition = array(
            "subscription_plan_id" => $this->input->post('subscription_plan_id')
        );
        $data = array(
            "subscription_plan_name" => $this->input->post('plan_name'),
            "days"          => $this->input->post('days'),
            "price"         => $this->input->post('price'),
            "gstTax"        => $this->input->post('gstTax'),
            "updated_at"    => date('Y-m-d H:i:s a')
        );
        // print_r($condition);exit;
        $planData = $this->CommonModel->updateRowByCondition($condition,'subscription',$data);  
        if ($planData) {
            $this->session->set_flashdata('success','Subscription Plan updadted Successfully');
            redirect('admin/Subscription_Plan/edit_subscription_plan/'.$this->input->post('subscription_plan_id'));
        }else{
            $this->session->set_flashdata('error', 'Subscription Plan not updadted');
            redirect('admin/Subscription_Plan/edit_subscription_plan/'.$this->input->post('subscription_plan_id'));
        }
    }

    //Update About Us.
    public function delete_subscription_plan()
    {
        $condition = array(
            "subscription_plan_id" => $this->input->post('subscription_plan_id')
        );
        $planData = $this->CommonModel->delete($condition,'subscription');  
        if ($planData) {
            echo "1";
        }else{
            echo "0";
        }
    }
}
