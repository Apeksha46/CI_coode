<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_Slider extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        // require_once base_url().'third_party/PHPExcel.php';
        // $this->excel = new PHPExcel();
        $sessionValue = $this->_adminLoginCheck();
	}
    
    //show slider
    public function index()
    {
        // echo "string";die;
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $Data['tableData'] = $this->CommonModel->selectResultData('slider','slider_id');
        // print_r($Data['tableData']);die;
        // $this->load->view('admin/package/web_slider',$Data);
        $this->load->view('admin/web_slider/slider_list',$Data);
        $this->load->view('admin/common_files/footer');
    }

    //show slider page
    public function add_slider()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $this->load->view('admin/web_slider/add_slider');
        $this->load->view('admin/common_files/footer');
    }

    //add slider page
    public function insert_slider()
    {
        $session_value = $this->session->userdata('ses_logged_in');

        // if ($this->input->post('slider_desc') == '')
        // {
        //     $this->session->set_flashdata('error_slider', 'Please fill all the field');
        //     redirect('admin/Web_Slider/add_slider');
        // }

        $config['upload_path']   = './slider/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        $this->load->library('upload', $config);
        
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "slider_title" => $this->input->post('slider_title'),
                "slider_desc" => $this->input->post('slider_desc'),
                "created_at"    => date('Y-m-d H:i:s a'),
                "updated_at"    => date('Y-m-d H:i:s a')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error_slider', $this->upload->display_errors());
                redirect('admin/Web_Slider/add_slider');
            }else { 
                $data = array(
                    "slider_title"  => $this->input->post('slider_title'),
                    "slider_desc"  => $this->input->post('slider_desc'),
                    "created_at"     => date('Y-m-d H:i:s a'),
                    "updated_at"     => date('Y-m-d H:i:s a'),
                    "slider_img" => $this->upload->data('file_name')
                );
            } 
        }

        $sliderData = $this->CommonModel->insertData($data,'slider');  

        if ($sliderData) {

            $this->session->set_flashdata('success_slider','Slider add Successfully');
            redirect('admin/Web_Slider/add_slider');
        }else{
            $this->session->set_flashdata('error_slider', 'Slider not added');
            redirect('admin/Web_Slider/add_slider');
        }
          
    }

    //Edit Customer page
	public function edit_slider()
	{
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("slider_id" => $this->uri->segment(4));
        $sliderData['tableData'] = $this->CommonModel->selectRowDataByCondition($condition,'slider');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/web_slider/edit_slider',$sliderData);
        $this->load->view('admin/common_files/footer');
	}

    public function update_slider()
    {
        // if ($this->input->post('slider_desc') == '') {
        //     $this->session->set_flashdata('error_slider', 'Please fill all the field');
        //     redirect('admin/Web_Slider/edit_slider/'.$this->input->post('slider_id'));
        // }
        $condition = array(
            "slider_id" => $this->input->post('slider_id')
        );

        $config['upload_path']   = './slider/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        // $config['max_size']      = 1024;
        $this->load->library('upload', $config);
        
        
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "slider_title"  => $this->input->post('slider_title'),
                "slider_desc"  => $this->input->post('slider_desc'),
                "updated_at"    => date('Y-m-d H:i:s a')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error_slider', $this->upload->display_errors());
                unset($_SESSION['error_slider']);
                redirect('admin/Web_Slider/edit_slider/'.$this->input->post('slider_id'));
            }else { 
                $data = array(
                    "slider_title"  => $this->input->post('slider_title'),
                    "slider_desc"  => $this->input->post('slider_desc'),
                    "updated_at"     => date('Y-m-d H:i:s a'),
                    "slider_img" => $this->upload->data('file_name')
                );
            } 
        }
        
        // print_r($condition);exit;
        $categoryData = $this->CommonModel->updateRowByCondition($condition,'slider',$data);  

        if ($categoryData) {
            $this->session->set_flashdata('success_slider','Slider updated Successfully');
            unset($_SESSION['error_slider']);
            redirect('admin/Web_Slider/edit_slider/'.$this->input->post('slider_id'));
        }else{
            $this->session->set_flashdata('error_slider', 'Slider not updated');
            unset($_SESSION['success_slider']);
            redirect('admin/Web_Slider/edit_slider/'.$this->input->post('slider_id'));
        }
    }
   
    public function delete_slider()
    {
        $condition = array(
            "slider_id" => $this->input->post('slider_id')
        );
        $categoryData = $this->CommonModel->delete($condition,'slider');  
        if ($categoryData) {
            echo "1";
        }else{
            echo "0";
        }
    }
    
}
