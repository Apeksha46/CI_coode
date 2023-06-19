<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

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
        $condition = array(
            "seller_id" => 0
        );
        // $catData['tableData'] = $this->CommonModel->selectResultDataByConditionAndFieldName($condition,'category','category_id');
        $cat = $this->CommonModel->selectAllResultData('category');
        $arr = array();
        if (count($cat) > 0) {
            for ($i=0; $i < count($cat); $i++) { 
                // $cond = array("seller_id" => $cat[$i]['seller_id']);
                // $sel = $this->CommonModel->selectRowDataByCondition($cond,'seller');
                // if ($sel) {
                //     $seller_name = $sel->seller_first_name.' '.$sel->seller_last_name;
                // }else{
                //     $seller_name = '';
                // }
                $arr[] = array(
                    "category_id"       => $cat[$i]['category_id'],
                    // "seller_name"       => $seller_name,
                    "category_name"     => $cat[$i]['category_name'],
                    "category_image"    => $cat[$i]['category_image']
                );
            }
        }
        $catData['tableData'] = $arr;
        $this->load->view('admin/category/show_category',$catData);
        $this->load->view('admin/common_files/footer');
    }

    //Add about us page
    public function add_category()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $this->load->view('admin/category/add_category');
        $this->load->view('admin/common_files/footer');
    }

    //Edit about us page
	public function edit_category()
	{
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("category_id" => $this->uri->segment(4));
        $categoryData['tableData'] = $this->CommonModel->selectRowDataByCondition($condition,'category');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/category/edit_category',$categoryData);
        $this->load->view('admin/common_files/footer');
	}

    //Insert About Us.
    public function insert_category()
    {
        $session_value = $this->session->userdata('ses_logged_in');
        if ($this->input->post('category_name') == '') {
            $this->session->set_flashdata('error', 'Please fill all the field');
            redirect('admin/Category/add_category');
        }
        $config['upload_path']   = './category/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        $this->load->library('upload', $config);
        
        // print_r($_FILES['image']['name']);exit;
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "seller_id"     => 0,
                "category_name" => $this->input->post('category_name'),
                "created_at"    => date('Y-m-d H:i:s a'),
                "updated_at"    => date('Y-m-d H:i:s a')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/Category/add_category');
            }else { 
                $data = array(
                    "seller_id"      => 0,
                    "category_name"  => $this->input->post('category_name'),
                    "created_at"     => date('Y-m-d H:i:s a'),
                    "updated_at"     => date('Y-m-d H:i:s a'),
                    "category_image" => $this->upload->data('file_name')
                );
            } 
        }
        // print_r($data);exit;
        
        // print_r($condition);exit;
        $aboutUsData = $this->CommonModel->insertData($data,'category');  
        if ($aboutUsData) {
            $this->session->set_flashdata('success','Category add Successfully');
            redirect('admin/Category/add_category');
        }else{
            $this->session->set_flashdata('error', 'Category not added');
            redirect('admin/Category/add_category');
        }
    }

    //Update About Us.
    public function update_category()
    {
        if ($this->input->post('category_name') == '') {
            $this->session->set_flashdata('error', 'Please fill all the field');
            redirect('admin/Category/edit_category/'.$this->input->post('category_id'));
        }
        $condition = array(
            "category_id" => $this->input->post('category_id')
        );
        $config['upload_path']   = './category/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        // $config['max_size']      = 1024;
        $this->load->library('upload', $config);
        
        // print_r($_FILES['category_icon']['name']);exit;
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "category_name" => $this->input->post('category_name'),
                "updated_at"    => date('Y-m-d H:i:s a')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/Category/edit_category/'.$this->input->post('category_id'));
            }else { 
                $data = array(
                    "category_name"  => $this->input->post('category_name'),
                    "updated_at"     => date('Y-m-d H:i:s a'),
                    "category_image" => $this->upload->data('file_name')
                );
            } 
        }
        
        // print_r($condition);exit;
        $categoryData = $this->CommonModel->updateRowByCondition($condition,'category',$data);  
        if ($categoryData) {
            $this->session->set_flashdata('success','Category updadted Successfully');
            redirect('admin/Category/edit_category/'.$this->input->post('category_id'));
        }else{
            $this->session->set_flashdata('error', 'Category not updadted');
            redirect('admin/Category/edit_category/'.$this->input->post('category_id'));
        }
    }

    //Update About Us.
    public function delete_category()
    {
        $condition = array(
            "category_id" => $this->input->post('category_id')
        );
        $categoryData = $this->CommonModel->delete($condition,'category');  
        if ($categoryData) {
            echo "1";
        }else{
            echo "0";
        }
    }
}
