<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_man extends MY_Controller {

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
        $Data['tableData'] = $this->CommonModel->selectResultData('delivery_man','delivery_man_id');
        $this->load->view('admin/delivery_man/show_delivery_man',$Data);
        $this->load->view('admin/common_files/footer');
    }

    //Add about us page
    public function add_delivery_man()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $this->load->view('admin/delivery_man/add_delivery_man');
        $this->load->view('admin/common_files/footer');
    }

    //Edit about us page
	public function edit_delivery_man()
	{
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("delivery_man_id" => $this->uri->segment(4));
        $categoryData['tableData'] = $this->CommonModel->selectRowDataByCondition($condition,'delivery_man');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/delivery_man/edit_delivery_man',$categoryData);
        $this->load->view('admin/common_files/footer');
	}

    //Insert About Us.
    public function insert_delivery_man()
    {
        if (empty($this->input->post('delivery_man_first_name')) && empty($this->input->post('delivery_man_last_name')) && empty($this->input->post('delivery_man_contact')) && empty($this->input->post('delivery_man_address'))) {
            $this->session->set_flashdata('error', 'fill all the field should be manditory except profile image');
            redirect('admin/Delivery_man/add_delivery_man');
        }
        $config['upload_path']   = './delivery_man/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);
        $token = $this->utility->token();

        //START unique driver id
        $permitted_chars = '0123456789';
        // Output: 54esmd
        $driver_identification_id =  'DRIVER-'.substr(str_shuffle($permitted_chars), 0, 4);
        //END

        $checkEmail = array(
            "delivery_man_email"    => $this->input->post('delivery_man_email')
        );
        $check = $this->CommonModel->selectRowDataByCondition($checkEmail,'delivery_man');  
        if ($check) {
            $this->session->set_flashdata('error','Delivery Man email already exists');
            redirect('admin/Delivery_man/add_delivery_man');
        }
        $checkMobile = array(
            "delivery_man_contact"  => $this->input->post('delivery_man_contact')
        );
        $check1 = $this->CommonModel->selectRowDataByCondition($checkMobile,'delivery_man');  
        if ($check1) {
            $this->session->set_flashdata('error','Delivery Man mobile already exists');
            redirect('admin/Delivery_man/add_delivery_man');
        }
        // print_r($_FILES['image']['name']);exit;
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "driver_identification_id"  => $driver_identification_id,
                "delivery_man_first_name"   => $this->input->post('delivery_man_first_name'),
                "delivery_man_last_name"    => $this->input->post('delivery_man_last_name'),
                "delivery_man_contact"      => $this->input->post('delivery_man_contact'),
                "delivery_man_address"      => $this->input->post('delivery_man_address'),
                "driver_vehicle_number"     => $this->input->post('driver_vehicle_number'),
                "delivery_man_email"        => $this->input->post('delivery_man_email'),
                "is_active"                 => 1,
                "driver_token"              => $token,
                "delivery_man_pwd"          => $this->input->post('delivery_man_pwd')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/Delivery_man/add_delivery_man');
            }else { 
                $data = array(
                    "driver_identification_id"  => $driver_identification_id,
                    "delivery_man_first_name"   => $this->input->post('delivery_man_first_name'),
                    "delivery_man_last_name"    => $this->input->post('delivery_man_last_name'),
                    "delivery_man_contact"      => $this->input->post('delivery_man_contact'),
                    "delivery_man_address"      => $this->input->post('delivery_man_address'),
                    "driver_vehicle_number"     => $this->input->post('driver_vehicle_number'),
                    "delivery_man_email"        => $this->input->post('delivery_man_email'),
                    "delivery_man_pwd"          => $this->input->post('delivery_man_pwd'),
                    "driver_token"              => $token,
                    "delivery_man_profile"      => $this->upload->data('file_name')
                );
            } 
        }
        // print_r($data);exit;
        $addData = $this->CommonModel->insertData($data,'delivery_man');  
        if ($addData) {
            $data['message'] = $this->load->view('email_templates/driver_credential',$data,TRUE );
            $data['to']      = $this->input->post('delivery_man_email');
            $data['subject'] = 'Driver crediantial';
            $sent = $this->CommonModel->sendMail($data);
            $this->session->set_flashdata('success','Delivery Man add Successfully');
            redirect('admin/Delivery_man/add_delivery_man');
        }else{
            $this->session->set_flashdata('error','Delivery Man not added');
            redirect('admin/Delivery_man/add_delivery_man');
        }
    }

    //Update About Us.
    public function update_delivery_man()
    {
        if (empty($this->input->post('delivery_man_first_name')) && empty($this->input->post('delivery_man_last_name')) && empty($this->input->post('delivery_man_contact')) && empty($this->input->post('delivery_man_address'))) {
            $this->session->set_flashdata('error', 'fill all the field should be manditory except profile image');
            redirect('admin/Delivery_man/add_delivery_man');
        }
        $condition = array(
            "delivery_man_id" => $this->input->post('delivery_man_id')
        );

        $config['upload_path']   = './delivery_man/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);
        
        // print_r($_FILES['image']['name']);exit;
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "delivery_man_first_name"   => $this->input->post('delivery_man_first_name'),
                "delivery_man_last_name"    => $this->input->post('delivery_man_last_name'),
                "delivery_man_contact"      => $this->input->post('delivery_man_contact'),
                "delivery_man_address"      => $this->input->post('delivery_man_address'),
                "driver_vehicle_number"     => $this->input->post('driver_vehicle_number'),
                "delivery_man_email"        => $this->input->post('delivery_man_email'),
                "delivery_man_pwd"          => $this->input->post('delivery_man_pwd')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/Delivery_man/edit_delivery_man/'.$this->input->post('delivery_man_id'));
            }else { 
                $data = array(
                    "delivery_man_first_name"   => $this->input->post('delivery_man_first_name'),
                    "delivery_man_last_name"    => $this->input->post('delivery_man_last_name'),
                    "delivery_man_contact"      => $this->input->post('delivery_man_contact'),
                    "delivery_man_address"      => $this->input->post('delivery_man_address'),
                    "driver_vehicle_number"     => $this->input->post('driver_vehicle_number'),
                    "delivery_man_profile"      => $this->upload->data('file_name'),
                    "delivery_man_email"        => $this->input->post('delivery_man_email'),
                    "delivery_man_pwd"          => $this->input->post('delivery_man_pwd')
                );
            } 
        }
        // print_r($data);exit;
        $updateData = $this->CommonModel->updateRowByCondition($condition,'delivery_man',$data);  
        if ($updateData) {
            $this->session->set_flashdata('success','Update Successfully');
            redirect('admin/Delivery_man/edit_delivery_man/'.$this->input->post('delivery_man_id'));
        }else{
            $this->session->set_flashdata('error','Not Update');
            redirect('admin/Delivery_man/edit_delivery_man/'.$this->input->post('delivery_man_id'));
        }
    }

    //kyc 
    public function kyc()
    {
        $condition = array(
            "driver_id" => $this->uri->segment(4)
        );
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $Data['tableData'] = $this->CommonModel->selectResultDataByCondition($condition,'driver_kyc');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/delivery_man/kyc',$Data);
        $this->load->view('admin/common_files/footer');
    }

    //update status
    public function changeStatus()
    {
        $kyc_verified_status = $this->input->post('status');
        $delivery_man_id     = $this->input->post('driver_id');
        $data = array(
            "kyc_verified_status"   => $kyc_verified_status,
        );
        $condition = array(
            "delivery_man_id"       => $delivery_man_id
        );
        $deliveryManData = $this->CommonModel->updateRowByCondition($condition,'delivery_man',$data);  
        if ($deliveryManData) {
            echo "1";
        }else{
            echo "0";
        }
    }
    //Update About Us.
    public function delete_delivery_man()
    {
        $condition = array(
            "delivery_man_id" => $this->input->post('delivery_man_id')
        );
        $deliveryManData = $this->CommonModel->delete($condition,'delivery_man');  
        if ($deliveryManData) {
            echo "1";
        }else{
            echo "0";
        }
    }
}
