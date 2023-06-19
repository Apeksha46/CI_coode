<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubCategory extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $sessionValue = $this->_adminLoginCheck();
	}
    //show about us
    public function index()
    {
        $session_value = $this->session->userdata('ses_logged_in');
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array(
            "seller_id" => 0
        );
        $subCatData['tableData'] = $this->CommonModel->selectResultDataByCondition($condition,'category');
        $subCatData['tableData1'] = $this->CommonModel->selectResultDataByCondition($condition,'sub_category');
        // print_r($subCatData);exit; 
        // $subCatData['tableData'] = $this->CommonModel->joinOneTableRecord('sub_category','sub_category_id');
        $this->load->view('admin/SubCategory/sub_category',$subCatData);
        $this->load->view('admin/common_files/footer');
    }

    public function getSubCategory(){
        $condition  = array("category_id" => $this->input->post('cat_id'));
        $subCatData = $this->CommonModel->selectResultDataByCondition($condition,'sub_category');
        if (!empty($subCatData)) {
            echo json_encode($subCatData);
        }else{
            echo "0";
        }
    }

    //Add about us page
    public function add_sub_category()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $session_value = $this->session->userdata('ses_logged_in');
        $condition = array(
            "seller_id" => 0
        );
        $CatData['cat'] = $this->CommonModel->selectResultDataByCondition($condition,'category');
        // $CatData['cat'] = $this->CommonModel->selectAllResultData('category');
        $this->load->view('admin/SubCategory/add_sub_category',$CatData);
        $this->load->view('admin/common_files/footer');
    }

    //Edit about us page
	public function edit_sub_category()
	{
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("sub_category_id" => $this->uri->segment(4));
        $sub_categoryData['tableData'] = $this->CommonModel->selectRowDataByCondition($condition,'sub_category');
        $session_value = $this->session->userdata('ses_logged_in');
        $condition = array(
            "seller_id" => 0
        );
        $sub_categoryData['cat'] = $this->CommonModel->selectResultDataByCondition($condition,'category');
        // $sub_categoryData['cat'] = $this->CommonModel->selectAllResultData('category');

        // print_r($aboutUsData);exit;
        $this->load->view('admin/SubCategory/edit_sub_category',$sub_categoryData);
        $this->load->view('admin/common_files/footer');
	}

    //Insert About Us.
    public function insert_sub_category()
    {
        $session_value = $this->session->userdata('ses_logged_in');
        if (empty($this->input->post('sub_category_name'))) {
            $this->session->set_flashdata('error', 'Please fill all the field');
            redirect('admin/SubCategory/add_sub_category');
        }
        $config['upload_path']   = './sub_category/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        $this->load->library('upload', $config);
        
        // print_r($_FILES['image']['name']);exit;
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "category_id"       => $this->input->post('category_id'),
                "sub_category_name" => $this->input->post('sub_category_name'),
                "created_at"        => date('Y-m-d H:i:s a'),
                "updated_at"        => date('Y-m-d H:i:s a')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/SubCategory/add_sub_category');
            }else { 
                $data = array(
                    "category_id"        => $this->input->post('category_id'),
                    "sub_category_name"  => $this->input->post('sub_category_name'),
                    "created_at"         => date('Y-m-d H:i:s a'),
                    "updated_at"         => date('Y-m-d H:i:s a'),
                    "sub_category_image" => $this->upload->data('file_name')
                );
            } 
        }
        
        // print_r($condition);exit;
        $aboutUsData = $this->CommonModel->insertData($data,'sub_category');  
        if ($aboutUsData) {
            $this->session->set_flashdata('success','Sub-Category add Successfully');
            redirect('admin/SubCategory/add_sub_category');
        }else{
            $this->session->set_flashdata('error', 'Sub-Category not added');
            redirect('admin/SubCategory/add_sub_category');
        }
    }

    //Update About Us.
    public function update_sub_category()
    {
        if (empty($this->input->post('sub_category_name'))) {
            $this->session->set_flashdata('error', 'Please fill all the field');
            redirect('admin/SubCategory/edit_sub_category/'.$this->input->post('sub_category_id'));
        }
        $condition = array(
            "sub_category_id" => $this->input->post('sub_category_id')
        );
        $config['upload_path']   = './sub_category/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        $this->load->library('upload', $config);
        
        // print_r($_FILES['image']['name']);exit;
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "category_id"       => $this->input->post('category_id'),
                "sub_category_name" => $this->input->post('sub_category_name'),
                "updated_at"        => date('Y-m-d H:i:s a')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/SubCategory/edit_sub_category/'.$this->input->post('sub_category_id'));
            }else { 
                $data = array(
                    "category_id"        => $this->input->post('category_id'),
                    "sub_category_name"  => $this->input->post('sub_category_name'),
                    "updated_at"         => date('Y-m-d H:i:s a'),
                    "sub_category_image" => $this->upload->data('file_name')
                );
            } 
        }
        // print_r($condition);exit;
        $sub_categoryData = $this->CommonModel->updateRowByCondition($condition,'sub_category',$data);  
        if ($sub_categoryData) {
            $this->session->set_flashdata('success','Sub-Category updadted Successfully');
            redirect('admin/SubCategory/edit_sub_category/'.$this->input->post('sub_category_id'));
        }else{
            $this->session->set_flashdata('error', 'Sub-Category not updadted');
            redirect('admin/SubCategory/edit_sub_category/'.$this->input->post('sub_category_id'));
        }
    }

    //Update About Us.
    public function delete_sub_category()
    {
        $condition = array(
            "sub_category_id" => $this->input->post('sub_category_id')
        );
        $sub_categoryData = $this->CommonModel->delete($condition,'sub_category');  
        if ($sub_categoryData) {
            echo "1";
        }else{
            echo "0";
        }
    }
}
