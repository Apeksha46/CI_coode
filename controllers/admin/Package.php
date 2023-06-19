<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        // require_once base_url().'third_party/PHPExcel.php';
        // $this->excel = new PHPExcel();
        $sessionValue = $this->_adminLoginCheck();
	}
    
    //show Customers
    public function index()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $Data['tableData'] = $this->CommonModel->selectResultData('package','package_id');
        $this->load->view('admin/package/Package',$Data);
        $this->load->view('admin/common_files/footer');
    }

    //Add Customer page
    public function add_package()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $this->load->view('admin/package/add_package');
        $this->load->view('admin/common_files/footer');
    }

    //Edit Customer page
	public function edit_package()
	{
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("package_id" => $this->uri->segment(4));
        $categoryData['tableData'] = $this->CommonModel->selectRowDataByCondition($condition,'package');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/package/edit_package',$categoryData);
        $this->load->view('admin/common_files/footer');
	}

    //Insert Customer.
    public function insert_package()
    {
        if (empty($this->input->post('price')) && empty($this->input->post('description')) && empty($this->input->post('package_name')) ) {
            $this->session->set_flashdata('not_done','Please fill all the field');
            redirect('admin/Package/add_package');
        }

        $config['upload_path']   = './package/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);
        
        // print_r($_FILES['image']['name']);exit;
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "package_name"  => $this->input->post('package_name'),
                "description"   => $this->input->post('description'),
                "price"         => $this->input->post('price'),
                "created_at"    => date('Y-m-d H:i:s a'),
                "updated_at"    => date('Y-m-d H:i:s a')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                // echo $this->upload->display_errors();
                $this->session->set_flashdata('error', $this->upload->display_errors());
                // $error = array('error' => $this->upload->display_errors()); 
                // $this->load->view('imageUploadForm', $error); 
                redirect('admin/Package/add_package');
            }else { 
                $data = array(
                    "package_name"  => $this->input->post('package_name'),
                    "description"   => $this->input->post('description'),
                    "price"         => $this->input->post('price'),
                    "created_at"    => date('Y-m-d H:i:s a'),
                    "image"         => $this->upload->data('file_name'),
                    "updated_at"    => date('Y-m-d H:i:s a')
                );
            } 
        }
        
        // print_r($condition);exit;
        $advertData = $this->CommonModel->insertData($data,'package');  
        if ($advertData) {
            $this->session->set_flashdata('success','Package add Successfully');
            redirect('admin/Package/add_package');
        }else{
            $this->session->set_flashdata('error', 'Package not added');
            redirect('admin/Package/add_package');
        }
        
    }

    //Update Customer.
    public function update_package()
    {
        if (empty($this->input->post('package_name')) && empty($this->input->post('description')) && empty($this->input->post('price')) ) {
            $this->session->set_flashdata('error','Please fill all the field');
            redirect('admin/Package/edit_package/'.$this->input->post('package_id'));
        }

        $condition = array(
            "package_id" => $this->input->post('package_id')
        );
        $config['upload_path']   = './package/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        // $config['max_size']      = 1024;
        $this->load->library('upload', $config);
        
        // print_r($_FILES['image']['name']);exit;
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "package_name"  => $this->input->post('package_name'),
                "description"   => $this->input->post('description'),
                "price"         => $this->input->post('price'),
                "created_at"    => date('Y-m-d H:i:s a'),
                "updated_at"    => date('Y-m-d H:i:s a')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                // echo $this->upload->display_errors();
                $this->session->set_flashdata('error', $this->upload->display_errors());
                // $error = array('error' => $this->upload->display_errors()); 
                // $this->load->view('imageUploadForm', $error); 
                redirect('admin/Package/edit_package/'.$this->input->post('package_id'));
            }else { 
                $data = array(
                    "package_name"  => $this->input->post('package_name'),
                    "description"   => $this->input->post('description'),
                    "price"         => $this->input->post('price'),
                    "created_at"    => date('Y-m-d H:i:s a'),
                    "updated_at"    => date('Y-m-d H:i:s a'),
                    "image"         => $this->upload->data('file_name')
                );
            } 
        }
        
        // print_r($condition);exit;
        $advertData = $this->CommonModel->updateRowByCondition($condition,'package',$data);  
        if ($advertData) {
            $this->session->set_flashdata('success','Advertisement updadted Successfully');
            redirect('admin/Package/edit_package/'.$this->input->post('package_id'));
        }else{
            $this->session->set_flashdata('error', 'Advertisement not updadted');
            redirect('admin/Package/edit_package/'.$this->input->post('package_id'));
        }
    }
    
    //Delete Customer.
    public function delete_package()
    {
        $condition = array(
            "package_id" => $this->input->post('package_id')
        );
        $customerData = $this->CommonModel->delete($condition,'package');  
        if ($customerData) {
            echo "1";
        }else{
            echo "0";
        }
    }

    //Bronze Package
    public function bronze_user()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("package_id" => 1);
        $Data['tableData'] = $this->CommonModel->selectResultDataByCondition($condition,'user');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/package/bronze_user',$Data);
        $this->load->view('admin/common_files/footer');
    }

    //Silver Package
    public function silver_user()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("package_id" => 2);
        $Data['tableData'] = $this->CommonModel->selectResultDataByCondition($condition,'user');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/package/silver_user',$Data);
        $this->load->view('admin/common_files/footer');
    }

    //Gold Package
    public function gold_user()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("package_id" => 3);
        $Data['tableData'] = $this->CommonModel->selectResultDataByCondition($condition,'user');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/package/gold_user',$Data);
        $this->load->view('admin/common_files/footer');
    }

    //Platinum Package
    public function diamond_user()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("package_id" => 4);
        $Data['tableData'] = $this->CommonModel->selectResultDataByCondition($condition,'user');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/package/diamond_user',$Data);
        $this->load->view('admin/common_files/footer');
    }
    public function platinum_user()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("package_id" => 5);
        $Data['tableData'] = $this->CommonModel->selectResultDataByCondition($condition,'user');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/package/platinum_user',$Data);
        $this->load->view('admin/common_files/footer');
    }

    //Platinum+ Package
    public function platinum_plus_user()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("package_id" => 6);
        $Data['tableData'] = $this->CommonModel->selectResultDataByCondition($condition,'user');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/package/platinum_plus_user',$Data);
        $this->load->view('admin/common_files/footer');
    }

    //addAmount
    public function addAmount()
    {
        // $url = $this->uri->segment('3') ;
        $condition = array("user_id" => $this->input->post('user_id'));
        $Data = $this->CommonModel->selectRowDataByCondition($condition,'user');

        if ($this->input->post('type') == 'amount') {
            if ($this->input->post('method') == 'add') {
                echo$per = (int)$Data->wallet + (int)$this->input->post('per_amt');
            }else{
                $per = (int)$Data->wallet - (int)$this->input->post('per_amt');
            }
        }
        else{
            $add = ((int)$Data->wallet * (int)$this->input->post('per_amt') )/100;
            if ($this->input->post('method') == 'add') {
                $per = (int)$Data->wallet + $add;
            }else{
                $per = (int)$Data->wallet - $add;
            }
        }
        
        $data = array("wallet" => $per);
        $res = $this->CommonModel->updateRowByCondition($condition,'user',$data);
        if ($res) {
            echo "1";
        }else{
            echo "0";
        }
    }
}
