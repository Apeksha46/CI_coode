<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

    function __construct()
    {
        parent::__construct();

     
    }

    public function invite()
    {
        $session_value = $this->session->userdata('web_logged_in');
        $a = $this->CommonModel->selectRowDataByCondition(array("user_id" => $session_value['id']),'user');
        if (!empty($this->session->userdata('web_logged_in'))) {
            
            if (!empty($a->profile)) {
                $profile = base_url().'uploads/'.$a->profile;
            }else{
                $profile = '';
            }
            $arr['id']     = $session_value['id'];
            $arr['name']   = $session_value['name'];
            $arr['email']  = $session_value['email'];
            $arr['wallet']  = $a->wallet;
            $arr['unique_package_id']  = $a->unique_package_id;
            $arr['profile']  = $profile;
            // $arr = array(
            //                "id"     => $session_value['id'],
            //                "email"  => $session_value['email'],
            //                "name"   => $session_value['name'],
            //             );
            // print_r($session_value);exit;
        }else{
             $session_value = '';
             $arr['id']     = '';
             $arr['name']   = '';
             $arr['email']  = '';
             $arr['wallet']  = '';
             $arr['unique_package_id']  = '';
             $arr['profile']  = '';
        }

        $this->load->view('website/common_files/header',$arr);
        $this->load->view('website/invite');
        $this->load->view('website/common_files/footer');
    }
    public function wonStatusChange()
    {
        $data = array("won_status" => 1);
        $condition = array("user_id" => $this->input->post('id'));
        $this->CommonModel->updateRowByCondition($condition,'user',$data);
        echo "1";

    }
    public function checkWonStatus()
    {
        $condition = "user_id = '".$this->input->post('id')."' and used_referal != '' ";
        // $condition = array("user_id" => $this->input->post('id'),"used_referal!=" => '');
        $a = $this->CommonModel->selectRowDataByCondition($condition,'user');
        if ($a) {
           $won_status = $a->won_status;
           if ($won_status == 1) {
               echo "1";
           }else{
            echo "0";
           }
        }else{
            echo "2";
        }
    }
    public function term_and_condition()
    {
        $session_value = $this->session->userdata('web_logged_in');
        $a = $this->CommonModel->selectRowDataByCondition(array("user_id" => $session_value['id']),'user');
        if (!empty($this->session->userdata('web_logged_in'))) {
            
            if (!empty($a->profile)) {
                $profile = base_url().'uploads/'.$a->profile;
            }else{
                $profile = '';
            }
            $arr['id']     = $session_value['id'];
            $arr['name']   = $session_value['name'];
            $arr['email']  = $session_value['email'];
            $arr['wallet']  = $a->wallet;
            $arr['unique_package_id']  = $a->unique_package_id;
            $arr['profile']  = $profile;
            // $arr = array(
            //                "id"     => $session_value['id'],
            //                "email"  => $session_value['email'],
            //                "name"   => $session_value['name'],
            //             );
            // print_r($session_value);exit;
        }else{
             $session_value = '';
             $arr['id']     = '';
             $arr['name']   = '';
             $arr['email']  = '';
             $arr['wallet']  = '';
             $arr['unique_package_id']  = '';
             $arr['profile']  = '';
        }

        $this->load->view('website/common_files/header',$arr);

        $data['termCondition']  = $this->CommonModel->selectAllResultData('termCondition');
        // print_r($data['product']);die;
        foreach ($data['termCondition'] as $key => $value) 
        {
            $arr = array(
                "title" => $value['title'],
                "content" => $value['content'],
            );          
        }
        $data['arr'] = $arr;
        $this->load->view('website/term_and_condition', $data);
        $this->load->view('website/common_files/footer');
    }

    public function about_us()
    {
        $session_value = $this->session->userdata('web_logged_in');
        $a = $this->CommonModel->selectRowDataByCondition(array("user_id" => $session_value['id']),'user');
        if (!empty($this->session->userdata('web_logged_in'))) {
            
            if (!empty($a->profile)) {
                $profile = base_url().'uploads/'.$a->profile;
            }else{
                $profile = '';
            }
            $arr['id']     = $session_value['id'];
            $arr['name']   = $session_value['name'];
            $arr['email']  = $session_value['email'];
            $arr['wallet']  = $a->wallet;
            $arr['unique_package_id']  = $a->unique_package_id;
            $arr['profile']  = $profile;
            // $arr = array(
            //                "id"     => $session_value['id'],
            //                "email"  => $session_value['email'],
            //                "name"   => $session_value['name'],
            //             );
            // print_r($session_value);exit;
        }else{
             $session_value = '';
             $arr['id']     = '';
             $arr['name']   = '';
             $arr['email']  = '';
             $arr['wallet']  = '';
             $arr['unique_package_id']  = '';
             $arr['profile']  = '';
        }

        $this->load->view('website/common_files/header',$arr);

        $data['about_us']  = $this->CommonModel->selectAllResultData('about_us');
        // print_r($data['product']);die;
        foreach ($data['about_us'] as $key => $value) 
        {
            $arr = array(
                "title" => $value['title'],
                "content" => $value['content'],
            );          
        }
        $data['arr'] = $arr;
        $this->load->view('website/about-us', $data);
        $this->load->view('website/common_files/footer');
    }

    public function privacy_policy()
    {
        $session_value = $this->session->userdata('web_logged_in');
        $a = $this->CommonModel->selectRowDataByCondition(array("user_id" => $session_value['id']),'user');
        if (!empty($this->session->userdata('web_logged_in'))) {
            
            if (!empty($a->profile)) {
                $profile = base_url().'uploads/'.$a->profile;
            }else{
                $profile = '';
            }
            $arr['id']     = $session_value['id'];
            $arr['name']   = $session_value['name'];
            $arr['email']  = $session_value['email'];
            $arr['wallet']  = $a->wallet;
            $arr['unique_package_id']  = $a->unique_package_id;
            $arr['profile']  = $profile;
            // $arr = array(
            //                "id"     => $session_value['id'],
            //                "email"  => $session_value['email'],
            //                "name"   => $session_value['name'],
            //             );
            // print_r($session_value);exit;
        }else{
             $session_value = '';
             $arr['id']     = '';
             $arr['name']   = '';
             $arr['email']  = '';
             $arr['wallet']  = '';
             $arr['unique_package_id']  = '';
             $arr['profile']  = '';
        }

        $this->load->view('website/common_files/header',$arr);

        $data['privacy_policy']  = $this->CommonModel->selectAllResultData('privacy_policy');
        // print_r($data['product']);die;
        foreach ($data['privacy_policy'] as $key => $value) 
        {
            $arr = array(
                "title" => $value['title'],
                "content" => $value['content'],
            );          
        }
        $data['arr'] = $arr;
        $this->load->view('website/about-us', $data);
        $this->load->view('website/common_files/footer');
    }
    public function index()
    {
        // $this->web_logged();
        $session_value = $this->session->userdata('web_logged_in');
        $a = $this->CommonModel->selectRowDataByCondition(array("user_id" => $session_value['id']),'user');
        if (!empty($this->session->userdata('web_logged_in'))) {
            
            if (!empty($a->profile)) {
                $profile = base_url().'uploads/'.$a->profile;
            }else{
                $profile = '';
            }
            $arr['id']     = $session_value['id'];
            $arr['name']   = $session_value['name'];
            $arr['email']  = $session_value['email'];
            $arr['wallet']  = $a->wallet;
            $arr['unique_package_id']  = $a->unique_package_id;
            $arr['profile']  = $profile;
            // $arr = array(
            //                "id"     => $session_value['id'],
            //                "email"  => $session_value['email'],
            //                "name"   => $session_value['name'],
            //             );
            // print_r($session_value);exit;
        }else{
             $session_value = '';
             $arr['id']     = '';
             $arr['name']   = '';
             $arr['email']  = '';
             $arr['wallet']  = '';
             $arr['unique_package_id']  = '';
             $arr['profile']  = '';
        }

        $this->load->view('website/common_files/header',$arr);
        $data['product']  = $this->CommonModel->selectAllResultData('product');

        foreach ($data['product'] as $key => $value) 
        {
            $condition = array("product_id" => $value['product_id'],"priority" => 1);

            $imageData = $this->CommonModel->selectRowDataByCondition($condition,'product_image');
            // print_r($imageData->image);die();
            if(!empty($imageData))
            {
                $product_image = base_url().'product/'.$imageData->image; 
            }else{
                $product_image = '';
            }
            $data['product'][$key]['image'] = $product_image;
        }

        // print_r($data);die;
        $this->load->view('website/Dashboard',$data);
        $this->load->view('website/common_files/footer');
    }

    //login
    public function login()
    {
        
        
        $this->load->view('website/login');
    }

    //signin
    public function signin()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $this->load->view('website/login'); 
        }
        else
        {
            $loginCondition = array(
                'email'     => $this->input->post('email'),                
                'password'  => md5($this->input->post('password'))
            );
            
            $adminData = $this->CommonModel->selectRowDataByCondition($loginCondition,'user');

            if(!empty($adminData))
            {
                $sessiondata = array(
                    'id'    => $adminData->user_id,
                    'name'  => $adminData->first_name.' '.$adminData->last_name,
                    'email' => $adminData->email,
                    'wallet' => $adminData->wallet,
                    'unique_package_id' => $adminData->unique_package_id,
                    'logged_in'   => TRUE,
                );
                // print_r($sessiondata);exit;
                $this->session->set_userdata('web_logged_in',$sessiondata);

                if(!empty($this->input->cookie('guest_id', TRUE)))
                {
                    $user_id = $this->input->cookie('guest_id', TRUE);
                    $Condition = array(
                        'user_id'     => $user_id,                
                    );
                    $data = $this->CommonModel->selectRowDataByCondition($Condition,'cart');
                    if (count($data) > 0) {
                        $Condition1 = array(
                            'user_id'     => $adminData->user_id,                
                        );
                        $this->CommonModel->updateRowByCondition($Condition,'cart',$Condition1);
                    }

                } 

                // print_r($this->session->userdata('web_logged_in'));exit();
                // $this->session->set_flashdata('success', 'Login successfully');
                redirect('website/Auth/');
            }
            else
            {   
                $this->session->set_flashdata("error","Invalid crediantial");
                redirect('website/Auth/login');
            } 
        }
    }

    // sign up
    public function signup()
    {

        $this->load->view('website/signup');
    }

    //Change password
    public function setting()
    {
        $this->web_logged();
        $session_value = $this->session->userdata('web_logged_in');
        $a = $this->CommonModel->selectRowDataByCondition(array("user_id" => $session_value['id']),'user');
        if (!empty($this->session->userdata('web_logged_in'))) {
            
            if (!empty($a->profile)) {
                $profile = base_url().'uploads/'.$a->profile;
            }else{
                $profile = '';
            }
            $arr['id']     = $session_value['id'];
            $arr['name']   = $session_value['name'];
            $arr['email']  = $session_value['email'];
            $arr['wallet']  = $a->wallet;
            $arr['unique_package_id']  = $a->unique_package_id;
            $arr['profile']  = $profile;
            // $arr = array(
            //                "id"     => $session_value['id'],
            //                "email"  => $session_value['email'],
            //                "name"   => $session_value['name'],
            //             );
            // print_r($session_value);exit;
        }else{
             $session_value = '';
             $arr['id']     = '';
             $arr['name']   = '';
             $arr['email']  = '';
             $arr['wallet']  = '';
             $arr['unique_package_id']  = '';
             $arr['profile']  = '';
        }

        $this->load->view('website/common_files/header',$arr);
        $this->load->view('website/change_password');
        $this->load->view('website/common_files/footer');
    }
    // update Profile.
    public function update_profile()
    {
        $session_value = $this->session->userdata('web_logged_in');
        $condition = array(
            "user_id" => $session_value['id']
        );

        $config['upload_path']   = './uploads'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);
        
        // print_r($_FILES['image']['name']);exit;
        if (empty($_FILES['file']['name'])) {
            $data = array(
                "first_name"        => $this->input->post('first_name'),
                "last_name"         => $this->input->post('last_name'),
                "mobile"            => $this->input->post('mobile'),
            );
        }else{
            if (!$this->upload->do_upload('file')) {
                // echo $this->upload->display_errors();exit;
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('website/Auth/setting');
            }else { 
                $data = array(
                    "first_name"        => $this->input->post('first_name'),
                    "last_name"         => $this->input->post('last_name'),
                    "mobile"            => $this->input->post('mobile'),
                    "profile"           => $this->upload->data('file_name')
                );
            } 
        }
        // print_r($data);exit;
        $fullname = $this->input->post('first_name').' '.$this->input->post('last_name');
        $updateData = $this->CommonModel->updateRowByCondition($condition,'user',$data);  
        if ($updateData) {
            $this->session->set_userdata('name', $fullname);
           
            $this->session->set_flashdata('success_','Update Profile Successfully');
            redirect('website/Auth/setting');
        }else{
            $this->session->set_flashdata('error_','Update not Profile Successfully');
            redirect('website/Auth/setting');
        }
    }

    // Change Password.
    public function reset_password()
    {
        $session_value = $this->session->userdata('ses_logged_in');
        $condition = array(
            "user_id" => $session_value['id']
        );
        if ($this->input->post('new_password') == $this->input->post('confirm_password')) {
            $data = array(
                "password"   => md5($this->input->post('new_password')),
                "pwd"        => $this->input->post('new_password')
            );
            $updateData = $this->CommonModel->updateRowByCondition($condition,'user',$data); 
            if ($updateData) { 
                $this->session->set_flashdata('_success','Password change Successfully');
                redirect('website/Auth/setting');
            }else{
                $this->session->set_flashdata('_error','Password not change ');
                redirect('website/Auth/setting');
            }
        }else { 
            $this->session->set_flashdata('_error', 'Your new Password and confirm Password not match!');
            redirect('website/Auth/setting');
        } 
    }
    //forget password
    public function forget_password()
    {
         $this->load->view('website/forget_password');
    }


    public function send_mail(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE) 
        {
            $this->load->view('website/forget_password'); 
        }
        else
        {   
            $to  = $this->input->post("email");
            $condition  = array('email' => $this->input->post("email"));
            $adminData = $this->CommonModel->selectRowDataByCondition($condition,'user');  
            // print_r($adminData);exit;      
            if ($adminData) {
                $randno     = rand(1000,9999);
                $md         = md5($randno);
                $data       = array("password" => $md,"pwd"=>$randno );
                $adminDatas  = $this->CommonModel->updateRowByCondition($condition,'user',$data); 
                
                $data1['email']      = $this->input->post("email");
                $data1['password']   = $randno;
                $data1['name']      = $adminData->first_name.' '.$adminData->last_name;
                
                $mail['to']         = $this->input->post("email");
                $mail['subject']    = 'Your reset password';
                $mail['message']    = 
                $this->load->view('email_templates/forget_password',$data1,TRUE );
                // $sent = $this->CommonModel->sendMail($mail); 
                // echo $this->load->view('email_templates/forget_password',$data1,TRUE );exit;
                $headers            = "From: smallbazariim@gmail.com";
                // echo $sent = mail($this->input->post("email"),'Your reset password',$this->load->view('email_templates/forget_password',$data1,TRUE ),$headers);
                echo $sent = mail($this->input->post("email"),'Your reset password','test',$headers);
                die;
                // print_r($data1);exit; 
                
                // $this->email
                //         ->from('info@smallbazar.in', 'Small-Bazar.')
                //         ->to($this->input->post('email'))
                //         ->subject('Your reset password.')
                //         ->message($this->load->view('email_templates/forget_password',$data1,TRUE ))
                //         ->set_mailtype('html');
                        
                //                 // send email
                // $sent1      = $this->email->send();

                 
                if ($sent) {
                    echo "yes";
                 }else{
                    echo "no";
                 }   exit;  

                // $this->session->set_flashdata("success","Email send on your email id");
                // redirect('website/Auth/');
            }else{
                echo "string";exit;
                // $this->session->set_flashdata("_error_login","Invalid Email");
                // $this->load->view('website/forget_password');
            }
        }
    }

    //Sign up with chain system
    public function chainSignUp()
    {
    	$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('re_password', 'Re-Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $this->load->view('website/Auth/signup'); 
        }
        else
        {

            //start check demo user available or not if not then insert
            $demoCondition  = array(
                                "email" => 'demoUser@yopmail.com',
                            );
            $demo   = $this->CommonModel->selectRowDataByCondition($demoCondition,'user');
            if (empty($demo)) {
                $data = array(
                    "first_name"         => 'Demo',
                    "last_name"          => 'Test',
                    "mobile"             => '0000000000',
                    "email"              => 'demoUser@yopmail.com',
                    "password"           => md5('123456'),
                    "referal_code"       => 'Demo@123',
                    "used_referal"       => '',
                    "wallet"             => '0',
                    "created_at"         => date('Y-m-d'),
                    "updated_at"         => date('Y-m-d')
                );
                $insertData = $this->CommonModel->insertData($data,'user');
               
            }
            //end check demo user available or not if not then insert
            if (!empty($this->input->post('referal'))) {
                $used_referal = $this->input->post('referal');
                $wallet = 51;
            }else{
                $used_referal = '';
                $wallet = 0;
            }
            $countData      = $this->CommonModel->countData('user');
            $date           = date('dmY');
            $randno         = rand(100,999);
            $refe           = 'SBSC@'.$date.$countData;
            $loginCondition = array(
                'email'      => $this->input->post('email')
            );
            $sellerData = $this->CommonModel->selectRowDataByCondition($loginCondition,'user');
            if(empty($sellerData))
            {
                if ($this->input->post('password') == $this->input->post('re_password')) 
                {
                    $data = array(
                        "first_name"         => $this->input->post('first_name'),
                        "last_name"          => $this->input->post('last_name'),
                        "mobile"             => $this->input->post('mobile'),
                        "email"              => $this->input->post('email'),
                        "password"           => md5($this->input->post('password')),
                        "pwd"                => $this->input->post('password'),
                        "referal_code"       => $refe,
                        "used_referal"       => $used_referal,
                        "wallet"             => $wallet,
                        "created_at"         => date('Y-m-d'),
                        "updated_at"         => date('Y-m-d')
                    );
                    $insertData = $this->CommonModel->insertData($data,'user');
                    if($insertData){
                        
                    	//level-1
                        $id = $this->db->insert_id();
                        
                        $link           = base_url().'website/Auth/referral_code?id='.$refe;
                        $dataa['ref']   = $refe;
                        $dataa['name']  = $this->input->post('first_name').' '.$this->input->post('last_name');
                        $dataa['link']  = $link;
                        //Start Send Mail
                            // $mail['to']         = $this->input->post('email');
                            // $mail['subject']    = 'Welcome in Small Bazar';
                            // $mail['message']    = 
                            // $this->load->view('email_templates/referral_code',$dataa,TRUE );
                            // $sent = $this->CommonModel->sendMail($mail);
                        //End Send Mail
                        
                        $this->email
                                ->from('info@smallbazar.in', 'Small-Bazar.')
                                ->to($this->input->post('email'))
                                ->subject('Welcome to Small Bazar.')
                                ->message($this->load->view('email_templates/referral_code',$dataa,TRUE ))
                                ->set_mailtype('html');
                                
                                // send email
                        $sent1 = $this->email->send();
                        
                        $userData = $this->CommonModel->selectRowDataByCondition(array("referal_code" => $used_referal),'user');
                        // print_r($userData);exit;
                        if (!empty($userData)) {

                        	$userCond = array("user_id" => $userData->user_id);
                        	// $package_id = $userData->package_id;
                        	// start Level-1
                        	//Start  How many user use referal code bottom level.

                        	$countUserInDirectly = 0;
                        	$usedReferalData = $this->CommonModel->selectResultDataByCondition(array("used_referal" => $used_referal),'user');
                        	if ($usedReferalData) {
                        		$countUserDirectly = count($usedReferalData);
                        		// print_r($usedReferalData);exit;
                        		foreach ($usedReferalData as $key => $usedReferalData) {

                        			$conditions = array("user_id" => $usedReferalData['user_id']);
                        			$usedReferalIndirectData = $this->CommonModel->selectRowDataByCondition($conditions,'user');
                        			if ($usedReferalIndirectData) {
                        				if ($usedReferalIndirectData->customer_count != '') {
                        					$countUser = $usedReferalIndirectData->customer_count; 
                        				}else{
                        					$countUser = 0;
                        				}
                        				$countUserInDirectly = (int)$countUserInDirectly + (int)$countUser;
                        			}
                        		}
                        		$customer_count = (int)$countUserDirectly + (int)$countUserInDirectly ;

                        	}else{
                        		$customer_count = 0;
                        	}
                        	$this->CommonModel->updateRowByCondition($userCond,'user',array("customer_count" => $customer_count));

                        	//End  How many user use referal code bottom level.

                        	//Start Check condition according to customer count
                            
                    		if ((int)$userData->customer_count > (int)20000) 
                    		{
                    			$addWallet = 25;
                    		}
                    		else if((int)$userData->customer_count > (int)50000)
                    		{
                    			$addWallet = 10;
                    		}
                    		else if((int)$userData->customer_count > (int)1000000)
                    		{
                    			$addWallet = 1;
                    		}else{
                    			$addWallet = 51;
                    		}

                            $wallet = (int)$userData->wallet + (int)$addWallet;

                            $userUpdate = $this->CommonModel->updateRowByCondition(array("referal_code" => $used_referal),'user',array("wallet" => $wallet));
                            //End Check condition according to customer count

                            //End level-1

                            //Start level-2
                            // echo $userData->used_referal;exit;
                            if (!empty($userData->used_referal)) {
	                            $userData2 = $this->CommonModel->selectRowDataByCondition(array("referal_code" => $userData->used_referal,'package_id!='=> 0,'package_id>='=>$userData->package_id),'user');
		                        // print_r($userData);exit;
		                        if (!empty($userData2)) {

		                        	$userCond2 = array("user_id" => $userData2->user_id);
		                        	//Start  How many user use referal code bottom level.

		                        	$countUserInDirectly2 = 0;
		                        	$usedReferalData2 = $this->CommonModel->selectResultDataByCondition(array("used_referal" => $userData->used_referal),'user');
		                        	if ($usedReferalData2) {
		                        		$countUserDirectly2 = count($usedReferalData2);

		                        		foreach ($usedReferalData2 as $key2 => $usedReferalData2) {
		                        			$conditions2 = array("user_id" => $usedReferalData2['user_id']);
		                        			$usedReferalIndirectData2 = $this->CommonModel->selectRowDataByCondition($conditions2,'user');
		                        			if ($usedReferalIndirectData2) {
		                        				if ($usedReferalIndirectData2->customer_count != '') {
		                        					$countUser2 = $usedReferalIndirectData2->customer_count; 
		                        				}else{
		                        					$countUser2 = 0;
		                        				}
		                        				$countUserInDirectly2 = (int)$countUserInDirectly2 + (int)$countUser2;
		                        			}
		                        		}
		                        		$customer_count2 = (int)$countUserDirectly2 + (int)$countUserInDirectly2 ;

		                        	}else{
		                        		$customer_count2 = 0;
		                        	}
		                        	$this->CommonModel->updateRowByCondition($userCond2,'user',array("customer_count" => $customer_count2));

		                        	//End  How many user use referal code bottom level.

		                        	//Start Check condition according to customer count
		                            
		                    		if ((int)$userData2->customer_count > (int)20000) 
		                    		{
		                    			$addWallet2 = 25;
		                    		}
		                    		else if((int)$userData2->customer_count > (int)50000)
		                    		{
		                    			$addWallet2 = 10;
		                    		}
		                    		else if((int)$userData2->customer_count > (int)1000000)
		                    		{
		                    			$addWallet2 = 5;
		                    		}else{
		                    			$addWallet2 = 51;
		                    		}

		                            $wallet2 = (int)$userData2->wallet + (int)$addWallet2;
		                            $userUpdate = $this->CommonModel->updateRowByCondition(array("referal_code" => $userData->used_referal),'user',array("wallet" => $wallet2));
		                            //End Check condition according to customer count

		                            //End level-2
		                            //Start level-3

		                            if (!empty($userData2->used_referal)) {
			                            $userData3 = $this->CommonModel->selectRowDataByCondition(array("referal_code" => $userData2->used_referal,'package_id!='=> 0,'package_id>='=>$userData2->package_id),'user');
				                        // print_r($userData);exit;
				                        if (!empty($userData3)) {

				                        	$userCond3 = array("user_id" => $userData3->user_id);
				                        	//Start  How many user use referal code bottom level.

				                        	$countUserInDirectly3 = 0;
				                        	$usedReferalData3 = $this->CommonModel->selectResultDataByCondition(array("used_referal" => $userData2->used_referal),'user');
				                        	if ($usedReferalData3) {
				                        		$countUserDirectly3 = count($usedReferalData3);

				                        		foreach ($usedReferalData3 as $key3 => $usedReferalData3) {
				                        			$conditions3 = array("user_id" => $usedReferalData3['user_id']);
				                        			$usedReferalIndirectData3 = $this->CommonModel->selectRowDataByCondition($conditions3,'user');
				                        			if ($usedReferalIndirectData3) {
				                        				if ($usedReferalIndirectData3->customer_count != '') {
				                        					$countUser3 = $usedReferalIndirectData3->customer_count; 
				                        				}else{
				                        					$countUser3 = 0;
				                        				}
				                        				$countUserInDirectly3 = (int)$countUserInDirectly3 + (int)$countUser3;
				                        			}
				                        		}
				                        		$customer_count3 = (int)$countUserDirectly3 + (int)$countUserInDirectly3 ;

				                        	}else{
				                        		$customer_count3 = 0;
				                        	}
				                        	$this->CommonModel->updateRowByCondition($userCond3,'user',array("customer_count" => $customer_count3));

				                        	//End  How many user use referal code bottom level.

				                        	//Start Check condition according to customer count
				                            
				                    		if ((int)$userData3->customer_count > (int)20000) 
				                    		{
				                    			$addWallet3 = 25;
				                    		}
				                    		else if((int)$userData3->customer_count > (int)50000)
				                    		{
				                    			$addWallet3 = 10;
				                    		}
				                    		else if((int)$userData3->customer_count > (int)1000000)
				                    		{
				                    			$addWallet3 = 5;
				                    		}else{
				                    			$addWallet3 = 51;
				                    		}

				                            $wallet3 = (int)$userData3->wallet + (int)$addWallet3;

				                            $userUpdate = $this->CommonModel->updateRowByCondition(array("referal_code" => $userData2->used_referal),'user',array("wallet" => $wallet3));
				                            //End Check condition according to customer count

				                            //End level-3

				                            //Start level-4

				                            if (!empty($userData3->used_referal)) {
					                            $userData4 = $this->CommonModel->selectRowDataByCondition(array("referal_code" => $userData3->used_referal,'package_id!='=> 0,'package_id>='=>$userData3->package_id),'user');
						                        // print_r($userData);exit;
						                        if (!empty($userData4)) {

						                        	$userCond4 = array("user_id" => $userData4->user_id);
						                        	//Start  How many user use referal code bottom level.

						                        	$countUserInDirectly4 = 0;
						                        	$usedReferalData4 = $this->CommonModel->selectResultDataByCondition(array("used_referal" => $userData3->used_referal),'user');
						                        	if ($usedReferalData4) {
						                        		$countUserDirectly4 = count($usedReferalData4);

						                        		foreach ($usedReferalData4 as $key4 => $usedReferalData4) {
						                        			$conditions4 = array("user_id" => $usedReferalData4['user_id']);
						                        			$usedReferalIndirectData4 = $this->CommonModel->selectRowDataByCondition($conditions4,'user');
						                        			if ($usedReferalIndirectData4) {
						                        				if ($usedReferalIndirectData4->customer_count != '') {
						                        					$countUser4 = $usedReferalIndirectData4->customer_count; 
						                        				}else{
						                        					$countUser4 = 0;
						                        				}
						                        				$countUserInDirectly4 = (int)$countUserInDirectly4 + (int)$countUser4;
						                        			}
						                        		}
						                        		$customer_count4 = (int)$countUserDirectly4 + (int)$countUserInDirectly4 ;

						                        	}else{
						                        		$customer_count4 = 0;
						                        	}
						                        	$this->CommonModel->updateRowByCondition($userCond4,'user',array("customer_count" => $customer_count4));

						                        	//End  How many user use referal code bottom level.

						                        	//Start Check condition according to customer count
						                            
						                    		if ((int)$userData4->customer_count > (int)20000) 
						                    		{
						                    			$addWallet4 = 25;
						                    		}
						                    		else if((int)$userData4->customer_count > (int)50000)
						                    		{
						                    			$addWallet4 = 10;
						                    		}
						                    		else if((int)$userData4->customer_count > (int)1000000)
						                    		{
						                    			$addWallet4 = 5;
						                    		}else{
						                    			$addWallet4 = 51;
						                    		}

						                            $wallet4 = (int)$userData4->wallet + (int)$addWallet4;

						                            $userUpdate = $this->CommonModel->updateRowByCondition(array("referal_code" => $userData3->used_referal),'user',array("wallet" => $wallet4));
						                            //End Check condition according to customer count

						                            //End level-4

						                            //Start level-5

						                            if (!empty($userData4->used_referal)) {
							                            $userData4 = $this->CommonModel->selectRowDataByCondition(array("referal_code" => $userData4->used_referal,'package_id!='=> 0,'package_id>='=>$userData4->package_id),'user');
								                        // print_r($userData);exit;
								                        if (!empty($userData4)) {

								                        	$userCond4 = array("user_id" => $userData4->user_id);
								                        	//Start  How many user use referal code bottom level.

								                        	$countUserInDirectly4 = 0;
								                        	$usedReferalData4 = $this->CommonModel->selectResultDataByCondition(array("used_referal" => $userData4->used_referal),'user');
								                        	if ($usedReferalData4) {
								                        		$countUserDirectly4 = count($usedReferalData4);

								                        		foreach ($usedReferalData4 as $key4 => $usedReferalData4) {
								                        			$conditions4 = array("user_id" => $usedReferalData4['user_id']);
								                        			$usedReferalIndirectData4 = $this->CommonModel->selectRowDataByCondition($conditions4,'user');
								                        			if ($usedReferalIndirectData4) {
								                        				if ($usedReferalIndirectData4->customer_count != '') {
								                        					$countUser4 = $usedReferalIndirectData4->customer_count; 
								                        				}else{
								                        					$countUser4 = 0;
								                        				}
								                        				$countUserInDirectly4 = (int)$countUserInDirectly4 + (int)$countUser4;
								                        			}
								                        		}
								                        		$customer_count4 = (int)$countUserDirectly4 + (int)$countUserInDirectly4 ;

								                        	}else{
								                        		$customer_count4 = 0;
								                        	}
								                        	$this->CommonModel->updateRowByCondition($userCond4,'user',array("customer_count" => $customer_count4));

								                        	//End  How many user use referal code bottom level.

								                        	//Start Check condition according to customer count
								                            
								                    		if ((int)$userData4->customer_count > (int)20000) 
								                    		{
								                    			$addWallet4 = 25;
								                    		}
								                    		else if((int)$userData4->customer_count > (int)50000)
								                    		{
								                    			$addWallet4 = 10;
								                    		}
								                    		else if((int)$userData4->customer_count > (int)1000000)
								                    		{
								                    			$addWallet4 = 5;
								                    		}else{
								                    			$addWallet4 = 51;
								                    		}

								                            $wallet4 = (int)$userData4->wallet + (int)$addWallet4;
								                            $userUpdate = $this->CommonModel->updateRowByCondition(array("referal_code" => $userData4->used_referal),'user',array("wallet" => $wallet4));
								                            //End Check condition according to customer count
								                        }
						                            }
						                            //End level-5
						                        }
				                            }
				                        }
		                            }
		                        }
                            }
                            
                        }else{
                            $demoData = $this->CommonModel->selectRowDataByCondition($demoCondition,'user');
                            $demo_wallet = (int)$demoData->wallet + (int)51;

                            $userUpdate = $this->CommonModel->updateRowByCondition($demoCondition,'user',array("wallet" => $demo_wallet));

                            $wallet = 0;
                        // 	$userUpdate = $this->CommonModel->updateRowByCondition(array("referal_code" => $used_referal),'user',array("wallet" => $wallet));
                        }
                        

                        $sessiondata = array(
                            'id'    => $id,
                            'name'  => $this->input->post('first_name').' '.$this->input->post('last_name'),
                            'email' => $this->input->post('email'),
                            'wallet' => $sellerData->wallet,
                            'logged_in'   => TRUE,
                           );
                        $this->session->set_userdata('web_logged_in',$sessiondata);
                        // $this->session->set_flashdata('success', 'Thank you for registration.');
                        redirect('website/Auth');
					}else{
                        $this->session->set_flashdata('error', 'Something Wrong');
                        redirect('website/Auth/signup');
                    }
                }else{
                    $this->session->set_flashdata('error', 'Confirm password not match');
                    redirect('website/Auth/signup');
                }
			}else{
				$this->session->set_flashdata('error', 'Email already exists');
                redirect('website/Auth/signup');
			}
		}
    }

    //register
    public function register()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('re_password', 'Re-Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $this->load->view('website/Auth/signup'); 
        }
        else
        {

            //start check demo user available or not if not then insert
                $demoCondition  = array(
                                    "email" => 'demoUser@yopmail.com',
                                );
                $demo   = $this->CommonModel->selectRowDataByCondition($demoCondition,'user');
                if (empty($demo)) {
                    $data = array(
                        "first_name"         => 'Demo',
                        "last_name"          => 'Test',
                        "mobile"             => '0000000000',
                        "email"              => 'demoUser@yopmail.com',
                        "password"           => md5('123456'),
                        "referal_code"       => 'Demo@123',
                        "used_referal"       => '',
                        "wallet"             => '0',
                        "created_at"         => date('Y-m-d'),
                        "updated_at"         => date('Y-m-d')
                    );
                    $insertData = $this->CommonModel->insertData($data,'user');
                }
            //end check demo user available or not if not then insert


            if (!empty($this->input->post('referal'))) {
                $used_referal = $this->input->post('referal');
                $wallet = 51;
            }else{
                $used_referal = '';
                $wallet = 0;
            }
            $randno         = rand(100,999);
            $refe           = $this->input->post('first_name').'@'.$randno;
            $loginCondition = array(
                'email'      => $this->input->post('email')
            );
            $sellerData = $this->CommonModel->selectRowDataByCondition($loginCondition,'user');
            if(empty($sellerData))
            {
                if ($this->input->post('password') == $this->input->post('re_password')) {
                    $data = array(
                        "first_name"         => $this->input->post('first_name'),
                        "last_name"          => $this->input->post('last_name'),
                        "mobile"             => $this->input->post('mobile'),
                        "email"              => $this->input->post('email'),
                        "password"           => md5($this->input->post('password')),
                        "referal_code"       => $refe,
                        "used_referal"       => $used_referal,
                        "wallet"             => $wallet,
                        "created_at"         => date('Y-m-d'),
                        "updated_at"         => date('Y-m-d')
                    );
                    $insertData = $this->CommonModel->insertData($data,'user');
                    if($insertData){
                        $id = $this->db->insert_id();

                        $userData = $this->CommonModel->selectRowDataByCondition(array("referal_code" => $used_referal),'user');
                        // print_r($userData);exit;
                        if (!empty($userData)) {
                            $wallet = (int)$userData->wallet + (int)51;
                        }else{
                            $demoData = $this->CommonModel->selectRowDataByCondition($demoCondition,'user');
                            $demo_wallet = (int)$demoData->wallet + (int)51;

                            $userUpdate = $this->CommonModel->updateRowByCondition($demoCondition,'user',array("wallet" => $demo_wallet));

                            $wallet = 0;
                        }
                        $userUpdate = $this->CommonModel->updateRowByCondition(array("referal_code" => $used_referal),'user',array("wallet" => $wallet));

                        $link           = base_url().'website/Auth/referral_code?id='.$refe;
                        $dataa['ref']   = $refe;
                        $dataa['name']  = $this->input->post('first_name').' '.$this->input->post('last_name');
                        $dataa['link']  = $link;
                        //Start Send Mail
                            // $mail['to']         = $this->input->post('email');
                            // $mail['subject']    = 'Welcome in Small Bazar';
                            // $mail['message']    = 
                            // $this->load->view('email_templates/referral_code',$dataa,TRUE );
                            // $sent = $this->CommonModel->sendMail($mail);
                            
                           $this->email
                                    ->from('info@smallbazar.in', 'Small-Bazar.')
                                    ->to($this->input->post('email'))
                                    ->subject('Welcome in Small Bazar.')
                                    ->message($this->load->view('email_templates/referral_code',$dataa,TRUE ))
                                    ->set_mailtype('html');
                                    
                                            // send email
                            $sent1 = $this->email->send(); 
                            
                        //End Send Mail

                        $sessiondata = array(
                            'id'    => $id,
                            'name'  => $this->input->post('first_name').' '.$this->input->post('last_name'),
                            'email' => $this->input->post('email'),
                            'wallet' => $sellerData->wallet,
                            'logged_in'   => TRUE,
                           );
                        $this->session->set_userdata('web_logged_in',$sessiondata);
                        // $this->session->set_flashdata('success', 'Thank you for registration.');
                        redirect('website/Auth');
                    }else{
                        $this->session->set_flashdata('error', 'Something Wrong');
                        redirect('website/Auth/signup');
                    }
                }else{
                    $this->session->set_flashdata('error', 'Confirm password not match');
                    redirect('website/Auth/signup');
                }
            }
            else
            {   
                $this->session->set_flashdata("error","Email already exists");
                redirect('website/Auth/signup');
            } 
        }
    }

    public function referral_code()
    {
        $referral_code = $this->input->get('id');
        redirect('website/Auth/signup?id='.$referral_code);
        // redirect('website/Auth/signup');
    }

    public function myAccount()
    {
        $this->web_logged();
        $session_value = $this->session->userdata('web_logged_in');
        $a = $this->CommonModel->selectRowDataByCondition(array("user_id" => $session_value['id']),'user');
        if (!empty($this->session->userdata('web_logged_in'))) {
            
            if (!empty($a->profile)) {
                $profile = base_url().'uploads/'.$a->profile;
            }else{
                $profile = '';
            }
            $arr['id']     = $session_value['id'];
            $arr['name']   = $session_value['name'];
            $arr['email']  = $session_value['email'];
            $arr['wallet']  = $a->wallet;
            $arr['unique_package_id']  = $a->unique_package_id;
            $arr['profile']  = $profile;
            // $arr = array(
            //                "id"     => $session_value['id'],
            //                "email"  => $session_value['email'],
            //                "name"   => $session_value['name'],
            //             );
            // print_r($session_value);exit;
        }else{
             $session_value = '';
             $arr['id']     = '';
             $arr['name']   = '';
             $arr['email']  = '';
             $arr['wallet']  = '';
             $arr['unique_package_id']  = '';
             $arr['profile']  = '';
        }
        $this->load->view('website/common_files/header',$arr);

        $rec = $this->CommonModel->selectRowDataByCondition(array("package_id" => $a->package_id),'package');
        if ($rec) {
           $ar  = array(
                            "package_id"    => $rec->package_id,
                            "package_name"  => $rec->package_name,
                            "description"   => $rec->description,
                            "price"         => $rec->price,
                            "image"         => base_url().'package/'.$rec->image,
                        ); 
        }else{
            $ar = array();
        }
        $packageRec = $this->CommonModel->selectAllResultData('package');
        $aa['data'] = $ar;
        $aa['package'] = $packageRec;
        $this->load->view('website/myAccount',$aa);
        $this->load->view('website/common_files/footer');
    }

    //logout
    public function logout()
    {
      $sessiondata = array(
                    'id'    => '',
                    'name'  => '',
                    'email' => '',
                    'logged_in'=> FALSE,
                   );

     $this->session->unset_userdata($sessiondata);
     $this->session->sess_destroy();
     redirect('website/Auth');
    }

    public function share_list()
    {
        $this->web_logged();
        $session_value  = $this->session->userdata('web_logged_in');
        $a              = $this->CommonModel->selectRowDataByCondition(array("user_id" => $session_value['id']),'user');
        $aa['data'] = $this->CommonModel->selectRowDataByCondition(array("user_id" => $session_value['id']),'user');
        if (!empty($this->session->userdata('web_logged_in'))) {
            
            if (!empty($a->profile)) {
                $profile = base_url().'uploads/'.$a->profile;
            }else{
                $profile = '';
            }
            $arr['id']     = $session_value['id'];
            $arr['name']   = $session_value['name'];
            $arr['email']  = $session_value['email'];
            $arr['wallet']  = $a->wallet;
            $arr['unique_package_id']  = $a->unique_package_id;
            $arr['profile']  = $profile;
            // $arr = array(
            //                "id"     => $session_value['id'],
            //                "email"  => $session_value['email'],
            //                "name"   => $session_value['name'],
            //             );
            // print_r($session_value);exit;
        }else{
             $session_value = '';
             $arr['id']     = '';
             $arr['name']   = '';
             $arr['email']  = '';
             $arr['wallet']  = '';
             $arr['unique_package_id']  = '';
             $arr['profile']  = '';
        }
        $this->load->view('website/common_files/header',$arr);
        if ($a) {
            $ref_code   = $a->referal_code;
            // $condition  = array (
            //                         "used_referal" => $ref_code,
            //                     );
            $condition  = array (
                                    "user_id" => $session_value['id'],
                                );
            // $data['refer']= $this->CommonModel->selectResultDataByCondition($condition,'user'); 
            $data['tableData']= $this->CommonModel->selectRowDataByCondition($condition,'user'); 
        }else{
            $data['tableData']= array();
        }
        $this->load->view('website/share_list', $data);
        $this->load->view('website/common_files/footer');
    }

    public function topup()
    {
        $this->web_logged();
        $session_value  = $this->session->userdata('web_logged_in');
        $user_id        = $session_value['id'];
        $data           = $this->CommonModel->selectRowDataByCondition(array("user_id" => $session_value['id']),'user'); 
        // print_r($data);
        if ($data) {
            $name   = $data->first_name.' '.$data->last_name;
            $mobile = $data->mobile;
            $email  = $data->email;
        }else{
            $name   = 'abc';
            $mobile = '1234567890';
            $email = 'test@test.com';
        }
        $top_up = explode(',',$this->input->post('top_up'));
        // if ($top_up == 1) {
        //     $amount = 1500;
        // }else if($top_up == 2){
        //     $amount = 5000;
        // }else if($top_up == 3){
        //     $amount = 15000;
        // }else if($top_up == 4){
        //     $amount = 25000;
        // }else if($top_up == 5){
        //     $amount = $this->input->post('amount');
        // }

        if ($top_up[1] == 'other') {
            $amount = $this->input->post('amount');
        }else{
            $amount = $top_up[1];
        }
        // print_r($top_up);exit;
        $api = new Instamojo\Instamojo('test_32abf059132b691bc4368e6fbc0', 'test_4804bdc4fdd0764b3aff48bdac7','https://test.instamojo.com/api/1.1/');
        try 
        {
            $response = $api->paymentRequestCreate(array(
                "purpose" => 'Purchase TopUp',
                "amount" => $amount,
                "buyer_name" => $name,
                "phone" => $mobile,
                "email" => $email,
                "send_email" => true,
                "send_sms" => true,
                'allow_repeated_payments' => false,
                "redirect_url" => base_url()."website/Auth/topupThankyou?id=".$user_id.'&a='.base64_encode($amount),
                // "webhook" => "https://studentstutorial.com/instamojo/webhook.php"
                ));
            $pay_ulr = $response['longurl'];
            /*end update producta quantity*/
            
            header("Location: $pay_ulr");
            exit();
        }
        catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }  
    }

    public function topupThankyou()
    {
        $user_id  = $this->input->get('id');
        $amount   = base64_decode($this->input->get('a'));
        $data     = $this->CommonModel->selectRowDataByCondition(array("user_id" => $user_id),'user'); 
        if ($data) {
            $wallet   = (int)$data->wallet + (int)$amount;
            $userUpdate = $this->CommonModel->updateRowByCondition(array("user_id" => $user_id),'user',array("wallet" => $wallet));
            if ($userUpdate) {
                $this->load->view('email_templates/topupThankyou');
            }else{
                $this->load->view('email_templates/fail');
            }
        }
    }

    public function packagePurchase()
    {
        $this->web_logged();
        $session_value  = $this->session->userdata('web_logged_in');
        $user_id        = $session_value['id'];
        $data           = $this->CommonModel->selectRowDataByCondition(array("user_id" => $session_value['id']),'user'); 
        // print_r($data);
        if ($data) {
            $name   = $data->first_name.' '.$data->last_name;
            $mobile = $data->mobile;
            $email  = $data->email;
        }else{
            $name   = 'abc';
            $mobile = '1234567890';
            $email  = 'test@test.com';
        }
        $package_id     = $this->input->get('id');
        
        $package_price  = $this->input->get('amount');

        $api = new Instamojo\Instamojo('test_32abf059132b691bc4368e6fbc0', 'test_4804bdc4fdd0764b3aff48bdac7','https://test.instamojo.com/api/1.1/');
        try 
        {
            $response = $api->paymentRequestCreate(array(
                "purpose" => 'Purchase TopUp',
                "amount" => $package_price,
                "buyer_name" => $name,
                "phone" => $mobile,
                "email" => $email,
                "send_email" => true,
                "send_sms" => true,
                'allow_repeated_payments' => false,
                "redirect_url" => base_url()."website/Auth/packageThankyou?id=".$user_id.'&a='.base64_encode($package_price).'&package_id='.$package_id,
                // "webhook" => "https://studentstutorial.com/instamojo/webhook.php"
                ));
            $pay_ulr = $response['longurl'];
            /*end update producta quantity*/
            
            header("Location: $pay_ulr");
            exit();
        }
        catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }  
    }

    public function packageThankyou()
    {
        $user_id    = $this->input->get('id');

        $condition = array(
            "user_id" => $user_id
        );
        
        $package_id = $this->input->get('package_id');
        $amount     = base64_decode($this->input->get('a'));
        $data       = $this->CommonModel->selectRowDataByCondition(array("user_id" => $user_id),'user'); 
        if ($data) {
        	$checkWal = $data->package_id;
            if ($checkWal == '' || $checkWal == 0) {
                $go = 1;
            }else{
                $go = 0;
            }
            // echo $go;exit;
            $wallet = (int)$data->wallet + ((int)$amount* 2);
            $userUpdate = $this->CommonModel->updateRowByCondition(array("user_id" => $user_id),'user',array("wallet" => $wallet,"package_id" => $package_id));
            if ($userUpdate) {
                if ($go == 1) {
                        if ($this->input->get('package_id') == 1) {
                            $money = '250';
                        }
                        if ($this->input->get('package_id') == 2) {
                            $money = '500';
                        }
                        if ($this->input->get('package_id') == 3) {
                            $money = '1000';
                        }
                        if ($this->input->get('package_id') == 4) {
                            $money = '2000';
                        }
                        if ($this->input->get('package_id') == 5) {
                            $money = '5000';
                        }
                        if ($this->input->get('package_id') == 6) {
                            $money = '10000';
                        }
                        // echo $money;exit;
                        //2nd level chain
                        $refData2        = $this->CommonModel->selectRowDataByCondition(array("referal_code" => $data->used_referal),'user');
                        if ($refData2) {
                            
                            $used_referal2   = (int)$refData2->wallet + (int)$money;
                            $updateData = $this->CommonModel->updateRowByCondition(array("referal_code" => $data->used_referal),'user',array("wallet" => $used_referal2));  
                        
                            //3rd level chain
                            if ($refData2->used_referal != '') {
                                
                                $refData3        = $this->CommonModel->selectRowDataByCondition(array("referal_code" => $refData2->used_referal,"package_id!="=> 0,'package_id>='=>$refData2->package_id),'user');
                                if ($refData3) {

                                    $used_referal3   = (int)$refData3->wallet + (int)$money;
                                    $updateData = $this->CommonModel->updateRowByCondition(array("referal_code" => $refData2->used_referal),'user',array("wallet" => $used_referal3));

                                    //4rth level chain
                                    if ($refData3->used_referal != '') {
                                        
                                        $refData4        = $this->CommonModel->selectRowDataByCondition(array("referal_code" => $refData3->used_referal,"package_id!="=> 0,'package_id>='=>$refData3->package_id),'user');
                                        if ($refData4) {

                                            $used_referal4   = (int)$refData4->wallet + (int)$money;
                                            $updateData = $this->CommonModel->updateRowByCondition(array("referal_code" => $refData3->used_referal),'user',array("wallet" => $used_referal4));

                                            //5th level chain
                                            if ($refData4->used_referal != '') {
                                                
                                                $refData5        = $this->CommonModel->selectRowDataByCondition(array("referal_code" => $refData4->used_referal,"package_id!="=> 0,'package_id>='=>$refData4->package_id),'user');
                                                if ($refData5) {

                                                    $used_referal5   = (int)$refData5->wallet + (int)$money;
                                                    $updateData = $this->CommonModel->updateRowByCondition(array("referal_code" => $refData4->used_referal),'user',array("wallet" => $used_referal5));
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                        }
                    }
                $this->load->view('email_templates/topupThankyou');
            }else{
                $this->load->view('email_templates/fail');
            }
        }
    }
}
