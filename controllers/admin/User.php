<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        // require_once base_url().'third_party/PHPExcel.php';
        // $this->excel = new PHPExcel();
        $sessionValue = $this->_adminLoginCheck();
	}
    
    //show Normal user
    public function index()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $Data['tableData'] = $this->CommonModel->selectResultDataByConditionAndFieldName(array("package_id" => 0),'user','user_id');
        $Data['package'] = $this->CommonModel->selectResultData('package','package_id');
        $this->load->view('admin/user/user',$Data);
        $this->load->view('admin/common_files/footer');
    }

    //show all user
    public function total_user()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $Data['tableData'] = $this->CommonModel->selectResultData('user','user_id');
        $Data['package'] = $this->CommonModel->selectResultData('package','package_id');
        $this->load->view('admin/user/user',$Data);
        $this->load->view('admin/common_files/footer');
    }
    
    //show Direct Customers
    public function direct_user()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $Data['tableData'] = $this->CommonModel->selectResultDataByConditionAndFieldName(array("used_referal" => ''),'user','user_id');
        $Data['package'] = $this->CommonModel->selectResultData('package','package_id');
        $this->load->view('admin/user/direct_user',$Data);
        $this->load->view('admin/common_files/footer');
    }
    
    public function paid()
    {
        $condition = array(
            "user_id" => $this->input->post('user_id')
        );
        $checkPackage = $this->CommonModel->selectRowDataByCondition($condition,'user');
        if ($checkPackage) {
            $checkWal = $checkPackage->package_id;
            if ($checkWal == '' || $checkWal == 0) {
                $go = 1;
            }else{
                $go = 0;
            }
        }else{
            $go = 0;
        }
        // echo $go;exit;
        $dataa = array("package_id" => $this->input->post('package_id'));

        // print_r($data);exit;
        $updateData = $this->CommonModel->updateRowByCondition($condition,'user',$dataa);  
        if ($updateData) {

            $data = $this->CommonModel->selectRowDataByCondition($condition,'user');
            
            if ($data) {

                $unique_package_id = $data->referal_code.'-'.rand(999,10000);
                if (empty($data->unique_package_id)) {
                    $updateData = $this->CommonModel->updateRowByCondition($condition,'user',array("unique_package_id" => $unique_package_id ) );  
                }
               
                $package = $this->CommonModel->selectRowDataByCondition($dataa,'package');

                if(!empty($data->used_referal))
                {
                    $wallet         = (int)$data->wallet + ((int)$package->price*2);

                    if ($go == 1) {

                        if ($this->input->post('package_id') == 1) {
                            $money = '250';
                        }
                        if ($this->input->post('package_id') == 2) {
                            $money = '500';
                        }
                        if ($this->input->post('package_id') == 3) {
                            $money = '1000';
                        }
                        if ($this->input->post('package_id') == 4) {
                            $money = '2000';
                        }
                        if ($this->input->post('package_id') == 5) {
                            $money = '5000';
                        }
                        if ($this->input->post('package_id') == 6) {
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
                }else{
                    $wallet = (int)$data->wallet + ((int)$package->price*2);
                }

                $updateData = $this->CommonModel->updateRowByCondition($condition,'user',array("wallet" => $wallet));

                if ($this->input->post('package_id') == 1) {
                    $pack_name = 'Bronze';
                }
                if ($this->input->post('package_id') == 2) {
                    $pack_name = 'Silver';
                }
                if ($this->input->post('package_id') == 3) {
                    $pack_name = 'Gold';
                }
                if ($this->input->post('package_id') == 4) {
                    $pack_name = 'Diamond';
                }
                if ($this->input->post('package_id') == 5) {
                    $pack_name = 'Platinum';
                }
                if ($this->input->post('package_id') == 6) {
                    $pack_name = 'Platinum+';
                }

                $msg = 'Hello '.$data->first_name.' '.$data->last_name.' admin assign a package named : '.$pack_name.' and your wallet acount is '.$wallet;
                $mobile = $data->mobile;
                $send_msg = $this->send_msg($msg,$mobile);
                
            } 
            // $data1['subject']   = 'Admin verify your account.';
            // $data1['msg']       = 'Your account is activated by admin,now you can login into your account.';
            // $data['message'] = $this->load->view('email_templates/activeByAdmin',$data1,TRUE );
            // $data['to']      = $Data->seller_email;
            // $data['subject'] = 'Admin verify your account.';
            // $sent = $this->CommonModel->sendMail($data);
            echo "1";
        }else{
            echo "0";
        }
    }

    //Reject Seller.
    public function reject_seller()
    {
        $condition = array(
            "seller_id" => $this->input->post('seller_id')
        );
        $data = array("active_status" => '0');

        // print_r($data);exit;
        $updateData = $this->CommonModel->updateRowByCondition($condition,'seller',$data);  
        if ($updateData) {
            $Data = $this->CommonModel->selectRowDataByCondition(array('seller_id' =>  $this->input->post('seller_id')),'seller');
            $data1['subject'] = 'Admin de-active your account.';
            $data1['msg']       = 'Your account is de-activated by admin.';
            $data['message'] = $this->load->view('email_templates/activeByAdmin',$data1,TRUE );
            $data['to']      = $Data->seller_email;
            $data['subject'] = 'Admin de-active your account.';
            $sent = $this->CommonModel->sendMail($data);
            echo "1";
        }else{
            echo "0";
        }
    }

    //show Customers
    public function refer_list()
    {
        // echo "string";die;
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("user_id" => $this->uri->segment(4));
        $userData['tableData'] = $this->CommonModel->selectRowDataByCondition($condition,'user');
        // print_r($userData);exit;
        $this->load->view('admin/user/user_refer_list',$userData);
        $this->load->view('admin/common_files/footer');
    }

    
}
