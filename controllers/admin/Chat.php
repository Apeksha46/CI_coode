<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $sessionValue = $this->_adminLoginCheck();
    }
    
    //Chat List
    public function index()
    {
        $session_value = $this->session->userdata('ses_logged_in');
        $val = $session_value['admin_id'];
        $this->load->view('admin/common_files/header');
        // print_r($msgCount);exit;
        $this->load->view('admin/common_files/sidebar');

        $condition  = array("admin_id" => $val);
        $data       = $this->CommonModel->selectResultDataByConditionAndFieldName($condition,'chat','chat_id');
        // print_r($dataCart);exit;
        if (!empty($data)) {
            for ($i=0; $i < count($data); $i++) { 
                $chat = array(
                    "chat_id"       => $data[$i]['chat_id'],
                    "send_to"       => 1,
                    "admin_id"      => $val,
                    "read_status"   => 0
                );
                $chatData = $this->CommonModel->selectResultDataByCondition($chat,'message');
                if (count($chatData) > 0) {
                    $Count = count($chatData);
                }else{
                    $Count = 0;
                } 

                $customerCondition   = array("customer_id" => $data[$i]['customer_id']);
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

                $productCondition   = array("product_id" => $data[$i]['product_id']);
                $productData        = $this->CommonModel->selectRowDataByCondition($productCondition,'product');

                $product_name = '';
                if (count($productData) > 0) {
                    $product_name = $productData->product_name;
                }
                $arr[] = array(
                    'chat_id'               => $data[$i]['chat_id'],
                    'customer_id'           => $data[$i]['customer_id'],
                    'product_id'            => $data[$i]['product_id'],
                    'customer_name'         => $customer_name,
                    'customer_profile'      => $customer_profile,
                    'count'                 => $Count,
                    'last_msg'              => $data[$i]['last_msg'],
                    'last_msg_time'         => $data[$i]['last_msg_time'],
                    'product_name'          => $product_name
                );
            }
        }
        if (empty($arr)) {
            $arr = array();
        }
        $chatData['chat'] = $arr;
        // print_r($chatData);exit;
        $this->load->view('admin/chat/chat_list',$chatData);
        $this->load->view('admin/common_files/footer');
    }
    public function chatting()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        //read_status = 1
        $chat_id = $this->uri->segment(4);

        $update_msg = array(
            "chat_id" => $chat_id
        );
        $record = $this->CommonModel->selectRowDataByCondition($update_msg,'chat');

        $customerCondition   = array("customer_id" => $record->customer_id);
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

        $update_msg1 = array(
            "chat_id"  => $chat_id,
            "send_to"  => 1
        );        
        $msg_update = array(
            "read_status" => 1
        );
        $msg_update1 = array(
            "is_read" => 1
        );
        $update = $this->CommonModel->updateRowByCondition($update_msg1,'message',$msg_update);
        $update1 = $this->CommonModel->updateRowByCondition($update_msg,'notification',$msg_update1);

        $data = $this->CommonModel->selectResultDataByCondition($update_msg,'message');
        if (!empty($data)) {
            for ($i=0; $i < count($data); $i++) { 
                $arr[] = array(
                    'send_to'               => $data[$i]['send_to'],
                    'text_message'          => $data[$i]['text_message'],
                    'message_time'          => $data[$i]['message_time'],
                    'message_date'          => $data[$i]['message_date']
                );
            }
        }else{
            $arr = array();
        }
        $chatData['chat']           = array(
            "customer_id"           => $record->customer_id,
            "customer_name"         => $customer_name,
            "customer_profile"      => $customer_profile,
            "chat"                  => $arr
        );
        // print_r($chatData);exit;
        $this->load->view('admin/chat/chatting',$chatData);
        $this->load->view('admin/common_files/footer');
    }

    public function message_count()
    {
        $session_value = $this->session->userdata('ses_logged_in');
        $val = $session_value['admin_id'];
        $msgCount = array();
        $sidebar = array(
            "admin_id"    => $val,
            "send_to!="   => 2,
            "send_to!="   => 4,
            "read_status" => 0
        );
        $sidebarData = $this->CommonModel->selectResultDataByCondition($sidebar,'message');
        if (count($sidebarData) > 0) {
            echo$msgCount = count($sidebarData);
        }else{
            echo$msgCount = '';
        } 
    }

    public function send_message()
    {

        $session_value  = $this->session->userdata('ses_logged_in');
        $chat_id        = $this->input->post('chat_id');
        $product_id     = $this->input->post('product_id');
        $customer_id    = $this->input->post('customer_id');
        $text_message   = $this->input->post('text_message');
        $admin_id       = $session_value['admin_id'];
        $data = array(
            "send_to"           => 4,
            "chat_id"           => $chat_id,
            "admin_id"          => $admin_id,
            "seller_id"         => 0,
            "customer_id"       => $customer_id,
            "product_id"        => $product_id,
            "text_message"      => $text_message,
            "message_time"      => date('H:i'),
            "message_date"      => date('Y-m-d')
        );
        // print_r($data);exit;
        $insertRecord = $this->CommonModel->insertData($data,'message');
        if ($insertRecord == FALSE) {
            echo 0;
        }else{
            $msg_id = $this->db->insert_id();

            //--------Start--chat update last message---//
            $updateCondition = array(
                "chat_id" => $chat_id
            );
            $updateData = array(
                "last_msg"              => $text_message,
                "last_msg_time"         => date('H:i'),
                "last_msg_date"         => date('Y-m-d')
            );
            $updateQuery = $this->CommonModel->updateRowByCondition($updateCondition,'chat',$updateData);  

            //--------End--chat update last message---//

            //--------Start--customer record---//
            $fetch              = array(
                "customer_id"   => $customer_id
            );
            $fetch1              = array(
                "admin_id"   => $admin_id
            );
            $customer_name          = '';
            $customer_device_type   = '';
            $customer_device_id     = '';
            $adminResult = $this->CommonModel->selectRowDataByCondition($fetch1,'admin' );
            if ($adminResult) {
                $admin_name              = $adminResult->name;
            }
            $customerResult = $this->CommonModel->selectRowDataByCondition($fetch,'customer' );
            if (!empty($customerResult)) {
                $customer_name              = $customerResult->customer_first_name.' '.$customerResult->customer_last_name;
                $customer_device_type   = $customerResult->customer_device_type;
                $customer_device_id     = $customerResult->customer_device_id;
            }
            //--------End--customer record---//

            $data1 = array(
                "title"             => 'New message arrived from '.$admin_name.'',
                "chat_id"           => $chat_id,
                "send_to"           => 4,
                "admin_id"          => $admin_id,
                "seller_id"         => 0,
                "customer_id"       => $customer_id,
                "product_id"        => $product_id,
                "text_message"      => $text_message,
                "message_id"        => $msg_id
            );
            $insertNotification = $this->CommonModel->insertData($data1,'notification');

            $values = array( 
                'title'     => 'New message arrived from '.$admin_name.' ',
                'message'   => $text_message,
                'subject'   => 'C',
                'type'      => '1',
                'id'        => $chat_id,
                'device_id' =>  $customer_device_id
            );
            $send_notification = $this->_sendAndroidNotification($values );
            // print_r($send_notification);
            echo 1;
        }
    }

    public function get_message(){
        $update_msg = array(
            "chat_id" => $this->input->post('chat_id')
        );
        $data = $this->CommonModel->selectResultDataByCondition($update_msg,'message');
        if (!empty($data)) {
            for ($i=0; $i < count($data); $i++) { 
                $arr[] = array(
                    'send_to'               => $data[$i]['send_to'],
                    'text_message'          => $data[$i]['text_message'],
                    'message_time'          => $data[$i]['message_time'],
                    'message_date'          => $data[$i]['message_date']
                );
            }
        }else{
            $arr = array();
        }
        echo json_encode($arr);
    }
}
