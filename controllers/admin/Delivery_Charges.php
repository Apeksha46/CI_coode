<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_Charges extends MY_Controller {

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
        $catData['tableData'] = $this->CommonModel->selectResultData('delivery_charges','delivery_charges_id');
        // print_r($catData);exit;
        $this->load->view('admin/delivery_charges/edit_delivery_charges',$catData);
        $this->load->view('admin/common_files/footer');
    }

    //Add about us page
    public function add_delivery_charges()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $this->load->view('admin/delivery_charges/add_delivery_charges');
        $this->load->view('admin/common_files/footer');
    }

    //Edit about us page
    public function edit_delivery_charges()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("delivery_charges_id" => $this->uri->segment(4));
        $delivery_chargesData['tableData'] = $this->CommonModel->selectRowDataByCondition($condition,'delivery_charges');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/delivery_charges/edit_delivery_charges',$delivery_chargesData);
        $this->load->view('admin/common_files/footer');
    }

    //Insert About Us.
    public function insert_delivery_charges()
    {
        if (empty($this->input->post('delivery_charges_amount'))) {
            $this->session->set_flashdata('error', 'Please fill Delivery Charges field');
            redirect('admin/Delivery_Charges/add_delivery_charges');
        }
        $data = array(
            "delivery_charges_amount"   => $this->input->post('delivery_charges_amount'),
            "created_at"                => date('Y-m-d H:i:s a')
        );
        // print_r($condition);exit;
        $aboutUsData = $this->CommonModel->insertData($data,'delivery_charges');  
        if ($aboutUsData) {
            $this->session->set_flashdata('success','Delivery Charges add Successfully');
            redirect('admin/Delivery_Charges/add_delivery_charges');
        }else{
            $this->session->set_flashdata('error', 'Delivery Charges not added');
            redirect('admin/Delivery_Charges/add_delivery_charges');
        }
    }

    public function update_delivery_charges()
    {
        $data = array(
            "delivery_charges_amount"      => $this->input->post('delivery_charges_amount')
        );
        if (empty($this->input->post('delivery_charges_id'))) {
            $aboutUsData = $this->CommonModel->insertData($data,'delivery_charges');  
            if ($aboutUsData) {
                $this->session->set_flashdata('success','Add Successfully');
                redirect('admin/Delivery_Charges/');
            }else{
                $this->session->set_flashdata('error', 'Not added');
                redirect('admin/Delivery_Charges/');
            }
        }else{
            $condition = array(
                "delivery_charges_id" => $this->input->post('delivery_charges_id')
            );
            // print_r($data);exit;
            $updateData = $this->CommonModel->updateRowByCondition($condition,'delivery_charges',$data);
            // print_r($this->db->last_query());exit; 
            // print_r($updateData);exit;
            if ($updateData) { 
                $this->session->set_flashdata('success','Change Successfully');
                redirect('admin/Delivery_Charges');
            }else{
                $this->session->set_flashdata('error','Not change ');
                redirect('admin/Delivery_Charges');
            }
        }
    }
    //Update About Us.
    public function delete_delivery_charges()
    {
        $condition = array(
            "delivery_charges_id" => $this->input->post('delivery_charges_id')
        );
        $delivery_chargesData = $this->CommonModel->delete($condition,'delivery_charges');  
        if ($delivery_chargesData) {
            echo "1";
        }else{
            echo "0";
        }
    }
}
