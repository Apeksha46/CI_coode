<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
class App_api_create extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( 'form_validation' );
		$this->load->language( 'english' );
        // $this->user = $this->_userLoginCheck( $token );
	}

	public function app_login_get()
    {
        // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        // $this->form_validation->set_rules('password', 'Password', 'trim|required');

        // if ($this->form_validation->run() == FALSE) 
        // {
        //     $dataText['status'] = 0;
        //     return $this->response(array(
        //             'status'    => REST_Controller::HTTP_BAD_REQUEST,
        //             'message'   => 'Please fill all field.',
        //             'object'    => $dataText
        //         ));
        // }
        // else
        // {
            $loginCondition = array(
                'email'     => $this->input->get('email'),                
                'password'  => md5($this->input->get('password'))
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
                    if ($data) {
                        $Condition1 = array(
                            'user_id'     => $adminData->user_id,                
                        );
                        $this->CommonModel->updateRowByCondition($Condition,'cart',$Condition1);
                    }

                } 

                $dataText['status'] = 1;
                $dataText['email'] = $this->input->get('email');
                // print_r($this->session->userdata('web_logged_in'));exit();
                // $this->session->set_flashdata('success', 'Login successfully');
                return $this->response(array(
                        'status'    => REST_Controller::HTTP_OK,
                        'message'   => 'Login successfully.',
                        'object'    => $dataText
                    ));
            }
            else
            {   
                $dataText['status'] = 0;
                $dataText['email'] = '';
                return $this->response(array(
                        'status'    => REST_Controller::HTTP_BAD_REQUEST,
                        'message'   => 'Wrong crediantial.',
                        'object'    => $dataText
                    ));
            } 
        // }
    }

    //Sign up with chain system
    public function app_chainSignUp_get()
    {
        // $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        // $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        // $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        // $this->form_validation->set_rules('password', 'Password', 'trim|required');
        // $this->form_validation->set_rules('re_password', 'Re-Password', 'trim|required');

        // if ($this->form_validation->run() == FALSE) 
        // {
        //     $this->load->view('website1/Auth/signup'); 
        // }
        // else
        // {

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
            if (!empty($this->input->get('referal'))) {
                $used_referal = $this->input->get('referal');
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
                'email'      => $this->input->get('email')
            );
            $sellerData = $this->CommonModel->selectRowDataByCondition($loginCondition,'user');
            if(empty($sellerData))
            {
                // print_r($sellerData);exit;
                if ($this->input->get('password') == $this->input->get('re_password')) 
                {
                    $data = array(
                        "first_name"         => $this->input->get('first_name'),
                        "last_name"          => $this->input->get('last_name'),
                        "mobile"             => $this->input->get('mobile'),
                        "email"              => $this->input->get('email'),
                        "password"           => md5($this->input->get('password')),
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
                        $userData = $this->CommonModel->selectRowDataByCondition(array("referal_code" => $used_referal),'user');
                        // print_r($userData);exit;
                        if (!empty($userData)) {

                            $userCond = array("user_id" => $userData->user_id);
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
                            // $userUpdate = $this->CommonModel->updateRowByCondition(array("referal_code" => $used_referal),'user',array("wallet" => $wallet));
                        }
                        $link           = base_url().'website1/Auth/referral_code?id='.$refe;
                        $dataa['ref']   = $refe;
                        $dataa['name']  = $this->input->get('first_name').' '.$this->input->get('last_name');
                        $dataa['link']  = $link;
                        //Start Send Mail
                            // $mail['to']         = $this->input->get('email');
                            // $mail['subject']    = 'Welcome in Small Bazar';
                            // $mail['message']    = 
                            // $this->load->view('email_templates1/referral_code',$dataa,TRUE );
                            // $sent = $this->CommonModel->sendMail($mail);
                            
                            
                            $this->email
                                    ->from('info@smallbazar.in', 'Small-Bazar.')
                                    ->to($this->input->get('email'))
                                    ->subject('Welcome in Small Bazar.')
                                    ->message($this->load->view('email_templates1/referral_code',$dataa,TRUE ))
                                    ->set_mailtype('html');
                                    
                                            // send email
                            $userInfo   = $this->CommonModel->selectRowDataByCondition(array("email" => $this->input->get('email')),'user');
                            $sent1 = $this->email->send(); 
                        //End Send Mail

                        $sessiondata = array(
                            'id'    => $id,
                            'name'  => $this->input->get('first_name').' '.$this->input->get('last_name'),
                            'email' => $this->input->get('email'),
                            'wallet' => $userInfo->wallet,
                            'logged_in'   => TRUE,
                           );
                        $dataText['status'] = 1;
                        $dataText['email'] = $this->input->get('email');
                        return $this->response(array(
                                'status'    => REST_Controller::HTTP_OK,
                                'message'   => 'Register successfully.',
                                'object'    => $dataText
                            ));
                        // $this->session->set_userdata('web_logged_in',$sessiondata);
                        // $this->session->set_flashdata('success', 'Thank you for registration.');
                        // redirect('website1/Auth');
                    }else{
                        $dataText['status'] = 1;
                        $dataText['email'] = '';
                        return $this->response(array(
                                'status'    => REST_Controller::HTTP_BAD_REQUEST,
                                'message'   => 'Failed to registered.',
                                'object'    => $dataText
                            ));
                    }
                }else{
                    $dataText['status'] = 0;
                    $dataText['email'] = '';
                    return $this->response(array(
                            'status'    => REST_Controller::HTTP_OK,
                            'message'   => 'Password and confirm password not match',
                            'object'    => $dataText
                        ));
                }
            }else{
                $dataText['status'] = 0;
                $dataText['email'] = '';
                return $this->response(array(
                        'status'    => REST_Controller::HTTP_OK,
                        'message'   => 'Email already exists.',
                        'object'    => $dataText
                    ));
            }
        // }
    }

    public function logout_get()
    {
      $sessiondata = array(
                    'id'    => '',
                    'name'  => '',
                    'email' => '',
                    'wallet' => '',
                    'logged_in'=> FALSE,
                   );

        $this->session->unset_userdata($sessiondata);
        $this->session->sess_destroy();
        $dataText['status'] = 0;
        return $this->response(array(
            'status'    => REST_Controller::HTTP_OK,
            'message'   => 'Logout successfully.',
            'object'    => $dataText
        ));
    }
}