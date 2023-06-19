<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends MY_Controller {

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
        $Data['tableData'] = $this->CommonModel->selectResultData('sale','sale_id');
        $this->load->view('admin/sale/sale',$Data);
        $this->load->view('admin/common_files/footer');
    }

    //Add about us page
    public function add_sale()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $this->load->view('admin/sale/add_sale');
        $this->load->view('admin/common_files/footer');
    }

    //Edit about us page
	public function edit_sale()
	{
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("sale_id" => $this->uri->segment(4));
        $categoryData['tableData'] = $this->CommonModel->selectRowDataByCondition($condition,'sale');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/sale/edit_sale',$categoryData);
        $this->load->view('admin/common_files/footer');
	}

    //Insert About Us.
    public function insert_sale()
    {
        if (empty($this->input->post('sale_desc')) && empty($this->input->post('start_date')) && empty($this->input->post('end_date')) ) {
            $this->session->set_flashdata('error', 'fill all the field should be manditory except banner image');
            redirect('admin/sale/add_sale');
        }
        $config['upload_path']   = './sale_banner/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);
        
        // print_r($_FILES['image']['name']);exit;
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "sale_title"    => $this->input->post('sale_title'),
                "sale_desc"     => $this->input->post('sale_desc'),
                "start_date"    => $this->input->post('start_date'),
                "end_date"      => $this->input->post('end_date'),
                "created_at"    => date('Y-m-d H:i:s a'),
                "updated_at"    => date('Y-m-d H:i:s a')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/Sale/add_sale');
            }else { 
                $data = array(
                    "sale_title"    => $this->input->post('sale_title'),
                    "sale_desc"     => $this->input->post('sale_desc'),
                    "start_date"    => $this->input->post('start_date'),
                    "end_date"      => $this->input->post('end_date'),
                    "created_at"    => date('Y-m-d H:i:s a'),
                    "updated_at"    => date('Y-m-d H:i:s a'),
                    "sale_banner"  => base_url().'sale_banner/'.$this->upload->data('file_name')
                );
            } 
        }
        // print_r($data);exit;
        $addData = $this->CommonModel->insertData($data,'sale');  
        if ($addData) {
              
            $this->session->set_flashdata('success','Sale add Successfully');
            redirect('admin/Sale/add_sale');
        }else{
            $this->session->set_flashdata('error','Sale not added');
            redirect('admin/Sale/add_sale');
        }
    }

    //Update About Us.
    public function update_sale()
    {
        if (empty($this->input->post('sale_desc')) && empty($this->input->post('start_date')) && empty($this->input->post('end_date')) ) {
            $this->session->set_flashdata('error', 'fill all the field should be manditory except Banner image');
            redirect('admin/sale/edit_sale/'.$this->input->post('sale_id'));
        }
        $condition = array(
            "sale_id" => $this->input->post('sale_id')
        );

        $config['upload_path']   = './sale_banner/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        $this->load->library('upload', $config);
        
        // print_r($_FILES['image']['name']);exit;
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "sale_title"    => $this->input->post('sale_title'),
                "sale_desc"     => $this->input->post('sale_desc'),
                "start_date"    => $this->input->post('start_date'),
                "end_date"      => $this->input->post('end_date'),
                "updated_at"    => date('Y-m-d H:i:s a')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/sale/edit_sale/'.$this->input->post('sale_id'));
            }else { 
                $data = array(
                    "sale_title"    => $this->input->post('sale_title'),
                    "sale_desc"     => $this->input->post('sale_desc'),
                    "start_date"    => $this->input->post('start_date'),
                    "end_date"      => $this->input->post('end_date'),
                    "updated_at"    => date('Y-m-d H:i:s a'),
                    "sale_banner"      => base_url().'sale_banner/'.$this->upload->data('file_name')
                );
            } 
        }
        // print_r($data);exit;
        $updateData = $this->CommonModel->updateRowByCondition($condition,'sale',$data);  
        if ($updateData) {
            
            $this->session->set_flashdata('success','Update Successfully');
            redirect('admin/sale/edit_sale/'.$this->input->post('sale_id'));
        }else{
            $this->session->set_flashdata('error','Not Update');
            redirect('admin/sale/edit_sale/'.$this->input->post('sale_id'));
        }
    }

    //Update About Us.
    public function delete_sale()
    {
        $condition = array(
            "sale_id" => $this->input->post('sale_id')
        );
        $saleData = $this->CommonModel->delete($condition,'sale');  
        if ($saleData) {
            echo "1";
        }else{
            echo "0";
        }
    }

    //participate_seller
    public function participate_seller()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $sale_id            = $this->uri->segment(4);
        $Data['tableData']  = $this->CommonModel->productDataAccToSale($sale_id);
        $this->load->view('admin/sale/participant_seller_list',$Data);
        $this->load->view('admin/common_files/footer');
    }
}
