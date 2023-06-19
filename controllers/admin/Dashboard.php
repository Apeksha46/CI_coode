<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct()
	{
		parent::__construct();

        // die(var_dump($_SESSION));

        $this->_adminLoginCheck(); 
	}
    //Dashboard
	public function index()
	{

        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $data['user']  		  = $this->CommonModel->countData('user');
        $data['direct_user'] = $this->CommonModel->countDataWithCondition('user',array('used_referal' => '' ));
        $data['without_user'] = $this->CommonModel->countDataWithCondition('user',array('package_id' => '0' ));
        $data['bronze_user']  = $this->CommonModel->countDataWithCondition('user',array('package_id' => '1' ));
        $data['silver_user']  = $this->CommonModel->countDataWithCondition('user',array('package_id' => '2' ));
        $data['gold_user'] 	  = $this->CommonModel->countDataWithCondition('user',array('package_id' => '3' ));
        $data['platinum_user']= $this->CommonModel->countDataWithCondition('user',array('package_id' => '4' ));
        $data['pending']	  = $this->CommonModel->countDataWithCondition('tbl_booking',array('payment_status' => '0' ));
        $data['dispatch']	  = $this->CommonModel->countDataWithCondition('tbl_booking',array('payment_status' => '2' ));
        $data['cancel']	  = $this->CommonModel->countDataWithCondition('tbl_booking',array('payment_status' => '3' ));
        $data['return']	  = $this->CommonModel->countDataWithCondition('tbl_booking',array('payment_status' => '4' ));
        $data['complete']	  = $this->CommonModel->countDataWithCondition('tbl_booking',array('payment_status' => '1' ));
        $this->load->view('admin/dashboard',$data);
        $this->load->view('admin/common_files/footer');
	}

    //Show admin profile.
    public function show_profile()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $session_value = $this->session->userdata('ses_logged_in');
        
        $condition = array(
            "admin_id" => $session_value['admin_id']
        );
        // print_r($condition);exit;
        $adminData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'admin');  
        $this->load->view('admin/profile',$adminData);
        $this->load->view('admin/common_files/footer');
    }

    //admin update Profile.
    public function edit_profile()
    {
        $session_value = $this->session->userdata('ses_logged_in');
        $condition = array(
            "admin_id" => $session_value['admin_id']
        );

        $config['upload_path']   = './uploads/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);
        
        // print_r($_FILES['image']['name']);exit;
        if (empty($_FILES['image']['name'])) {
            $data = array(
                "name"              => $this->input->post('name'),
                "admin_address"     => $this->input->post('admin_address'),
                "admin_latitude"    => $this->input->post('admin_latitude'),
                "admin_longitude"   => $this->input->post('admin_longitude')
            );
        }else{
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/Dashboard/show_profile');
            }else { 
                $data = array(
                    "name"              => $this->input->post('name'),
                    "admin_address"     => $this->input->post('admin_address'),
                    "admin_latitude"    => $this->input->post('admin_latitude'),
                    "admin_longitude"   => $this->input->post('admin_longitude'),
                    "profile"           => $this->upload->data('file_name')
                );
            } 
        }
        // print_r($data);exit;
        $updateData = $this->CommonModel->updateRowByCondition($condition,'admin',$data);  
        if ($updateData) {
            $sessiondata = array(
                'admin_id'    => $session_value['admin_id'],
                'admin_name'  => $this->input->post('name'),
                'admin_email' => $session_value['email'],
                'logged_in'   => TRUE,
               );
            //remove old data
            $this->session->unset_userdata($session_value);

            // modify session
            $this->session->set_userdata('ses_logged_in',$sessiondata);

            $this->session->set_flashdata('success','Update Profile Successfully');
            redirect('admin/Dashboard/show_profile');
        }else{
            $this->session->set_flashdata('error','Update not Profile Successfully');
            redirect('admin/Dashboard/show_profile');
        }
    }

    //admin Change Password.
    public function change_password()
    {
        $session_value = $this->session->userdata('ses_logged_in');
        $condition = array(
            "admin_id" => $session_value['admin_id']
        );
        if ($this->input->post('new_password') == $this->input->post('confirm_password')) {
            $data = array(
                "password"    => md5($this->input->post('new_password')),
                "pwd"         => $this->input->post('new_password')
            );
            $updateData = $this->CommonModel->updateRowByCondition($condition,'admin',$data); 
            if ($updateData) { 
                $this->session->set_flashdata('success','Password change Successfully');
                redirect('admin/Dashboard/show_profile');
            }else{
                $this->session->set_flashdata('error','Password not change ');
                redirect('admin/Dashboard/show_profile');
            }
        }else { 
            $this->session->set_flashdata('error', 'Your new Password and confirm Password not match!');
            redirect('admin/Dashboard/show_profile');
        } 
    }

    public function notification()
    {
        $this->load->view('admin/common_files/header');
        $session_value = $this->session->userdata('ses_logged_in');
        $val = $session_value['admin_id'];
        
        $msg_update = array(
            "is_read" => 1
        );
        $update = $this->CommonModel->updateRowByCondition(array("admin_id" => $val),'notification',$msg_update);
        $this->load->view('admin/common_files/sidebar');
        $notificationData = $this->CommonModel->selectResultDataByCondition(array("send_to!=" => 4,"admin_id" => $val ),'notification','notification_id');
        if (!empty($notificationData)) {
            for ($i=0; $i < count($notificationData); $i++) { 
                $chat = array(
                    "chat_id" => $notificationData[$i]['chat_id']
                );
                
                $customerCondition   = array("customer_id" => $notificationData[$i]['customer_id']);
                $customerData        = $this->CommonModel->selectRowDataByCondition($customerCondition,'customer');

                $customer_name = '';
                // print_r($customerData);exit();
                if (count($customerData) > 0) {
                    $customer_name = $customerData->customer_first_name.' '.$customerData->customer_last_name;
                    if ($customerData->customer_device_type != 'android' || $customerData->customer_device_type != 'ios') {
                        
                        if (!empty($this->check_value($customerData->customer_profile))) {
                            $customer_profile = base_url().'uploads/'.$customerData->customer_profile;
                        }else{
                            $customer_profile = '';
                        }
                    }else{
                        $customer_profile = $customerData->customer_profile;
                    }
                    // print_r($productImgData[0]['image']);
                }

                $productCondition   = array("product_id" => $notificationData[$i]['product_id']);
                $productData        = $this->CommonModel->selectRowDataByCondition($productCondition,'product');

                $product_name = '';
                if (count($productData) > 0) {
                    $product_name = $productData->product_name;
                }
                $arr[] = array(
                    'customer_id'           => $notificationData[$i]['customer_id'],
                    'product_id'            => $notificationData[$i]['product_id'],
                    'customer_name'         => $customer_name,
                    'customer_profile'      => $customer_profile,
                    'text_message'          => $notificationData[$i]['text_message'],
                    'title'                 => $notificationData[$i]['title'],
                    'product_name'          => $product_name
                );
            }
        }
        if (empty($arr)) {
            $arr = array();
        }
        $notify['tableData'] = $arr;
        $this->load->view('admin/notification',$notify);
        $this->load->view('admin/common_files/footer');
    }

    public function count_notification(){
        $session_value = $this->session->userdata('ses_logged_in');
        $val = $session_value['admin_id'];
        $condition      = array(
            "is_read"   => 0,
            "send_to!=" => 4,
            "send_to!=" => 2,
            "admin_id" => $val
        );
        $data   = $this->CommonModel->countDataWithCondition('notification',$condition); 
        if ($data == 0) {
            echo'';
        }else{
            echo $data;
        }
    }

    //Delete notification
    public function delete_notification()
    {
        $session_value = $this->session->userdata('ses_logged_in');
        $val = $session_value['admin_id'];
        
        $delete = $this->CommonModel->delete(array("admin_id" => $val),'notification');
        if ($delete) {
            echo "1";
        }else{
            echo "0";
        }
    }
    //Logout admin and destroy session.
    public function logout()
    {
        $sessionData = array(
            'admin_id'    => '',
            'admin_name'  =>'',
            'admin_email' => '',    
            'logged_in'   => FALSE,
           );
        $this->session->unset_userdata($sessionData);
        $this->session->sess_destroy();
        redirect('admin/auth','refresh');
    }
}
