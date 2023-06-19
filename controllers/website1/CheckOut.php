<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckOut extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        // $sessionValue = $this->web_logged();
        $this->load->library('WhatsAppAPI');
		// $this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');
		// $this->load->model( 'CommonModel' );
        
	}
	public function index()
	{
        
        $val = $this->add_To_Cart($this->input->post('p_id'));
        redirect('website1/CheckOut/checkout');
	}

    public function RandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            // echo $i;
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }

    public function thankyou()
    {
    	$booking_id = $this->input->get('id');
        $payment_id = $this->input->get('payment_id');
        if ($this->input->get('payment_status') == 'Failed') {
            $this->load->view('email_templates/fail');
        }else{
        	if ($this->input->get('payment_id') != '') {
                $payment_id = $this->input->get('payment_id');
                $payment_type = $this->input->get('payment_status');
                $payment_request_id = $this->input->get('payment_request_id');
    
                $this->CommonModel->updateRowByCondition(array("booking_id" => $booking_id),'tbl_booking',array("payment_id" => $payment_id,"payment_type" => $payment_type, "payment_request_id" => $payment_request_id));
            }
            $book = $this->CommonModel->selectRowDataByCondition(array("booking_id" => $booking_id),'tbl_booking');
    
            // print_r($book);
            if ($book) {
                // 
                //Start cart item update
                $cartids   = explode(',', $book->cart_id);
                // print_r($cartids);
                // print_r($cartids);
                for ($j=0; $j < count($cartids); $j++) { 
                    $conditionCart = array(
                        "cart_id"      => $cartids[$j],
                    ); 
                   $data = array("status" => 1);
                   $this->CommonModel->updateRowByCondition($conditionCart,'cart',$data);
                   $cart = $this->CommonModel->selectRowDataByCondition($conditionCart,'cart');
                   if ($cart) {
                       $arr[] = array(
                                        "product_name"  => $cart->product_name,
                                        "quantity"      => $cart->quantity,
                                        "price"         => $cart->price,
                                        );
                   }else{
                    $arr = array();
                   }
                }
                //End Cart update
                
                $dataText = array();
               
                $dataText['order_id']   = $book->order_id;    
                $dataText['first_name'] = $book->first_name;
                $dataText['last_name']  = $book->last_name;
                $dataText['email']      = $book->email;
                $dataText['mobile']     = $book->mobile;
                $dataText['address']    = $book->address;
                $dataText['country']    = $book->country;
                $dataText['state']      = $book->state;
                $dataText['city']       = $book->city;
                $dataText['pincode']    = $book->pincode;
                $dataText['total_price']= $book->total_price;
                $dataText['order_date'] = $book->created_at;
                $dataText['cart_item']  = $arr;


                //start product qty update
                $product_id = explode(',', $book->product_id);
                // print_r($product_id);
                // print_r($product_id);exit;
                if (!empty($product_id)) 
                {
	                for ($i=0; $i < count($product_id); $i++) { 
	                    
	                    $condition = array(
	                        "product_id"  => $product_id[$i],
	                    );
	                    $product_Detail = $this->CommonModel->selectRowDataByCondition($condition,'product');
	                    // print_r($product_Detail);
	                    $remain_quantity = (int)$product_Detail->remaining_qty;
	                    $used_quantity = (int)$product_Detail->used_qty;
	    
	    
	                    if($remain_quantity > 0)
	                    {
	                        $remain         = (int)$remain_quantity - (int) $book->quantity;
	                        $used           = (int)$used_quantity + (int) $book->quantity;
	    
	                        // print_r($used);die;
	                        $this->CommonModel->updateRowByCondition($condition,'product',array("remaining_qty" => $remain,"used_qty" => $used));
	                    }
	                }
	            }
            }
                // if (empty($data)) {
                //     $data = array();
                // }
                // print_r($data1);exit;

                //whatsapp msg

                $whatsapp_obj = new WhatsAppAPI();
                if ($whatsapp_obj) {
                    $apiResponse = $whatsapp_obj->sendText($country_code = '91', $to_mobile = '7777877080', $message = 'Hello');
                }
                // print_r($apiResponse);exit;
                //mail send start
                // print_r($dataText);
                    // $mail['to']         = 'smallbazariim@gmail.com';//infosmallbazar@gmail.com
                    // $mail['subject']    = 'New Order Request';
                    // $mail['message']    = 
                    // $this->load->view('email_templates/orderDetail',$dataText,TRUE );

                    // // print_r($mail['message']);die;
                    // $sent = $this->CommonModel->sendMail($mail);
                    
                    $this->email
                        ->from('info@smallbazar.in', 'Small-Bazar.')
                        ->to('smallbazariim@gmail.com')
                        ->subject('New Order Request.')
                        ->message($this->load->view('email_templates1/orderDetail',$dataText,TRUE ))
                        ->set_mailtype('html');
                        
                                // send email
                    $sent1 = $this->email->send(); 
                
                //mail send end 

                $this->load->view('email_templates1/thankyou');
                $status     = $this->instamojo->status($payment_id);
                // print_r($status) ;

        }
        // $status     = $this->instamojo->status($payment_id);
        // print_r($status) ;
        // $this->load->view('email_templates/thankyou');
    }
	public function getState()
	{
        $condition  = array("country_id" => $this->input->post('country_id'));
        $subCatData = $this->CommonModel->selectResultDataByCondition($condition,'states');

        // print_r($subCatData);die;
        if (!empty($subCatData)) {
            echo json_encode($subCatData);
        }else{
            echo "0";
        }
    }

    public function getCity()
	{
        $condition  = array("state_id" => $this->input->post('state_id'));
        $subCatData = $this->CommonModel->selectResultDataByCondition($condition,'cities');

        // print_r($subCatData);die;
        if (!empty($subCatData)) {
            echo json_encode($subCatData);
        }else{
            echo "0";
        }
    }

    public function getProduct()
    {
        $condition  = array("product_id" => $this->input->post('product_id'));

        //get product detail
        $subCatData = $this->CommonModel->selectRowDataByCondition($condition,'product');

        //get product multiple image
        $imageData = $this->CommonModel->selectResultDataByCondition($condition,'product_image');

        $subCatData->image = $imageData;

        if (!empty($subCatData)) {
            echo json_encode($subCatData);
        }else{
            echo "0";
        }
    }

    public function setCookiesOfEachUser()
    {
        $Cookiee = rand();
        $set_cookies = array(
                    'name'   => 'guest_id',
                    'value'  => $Cookiee,
                    'expire' => time()+3600,
                    'path'   => '/',
                    'secure' => FALSE
        );
        // print_r($set_cookies);
        $this->input->set_cookie($set_cookies);
        return $Cookiee;
    }

    public function addToCart()
    {   
        
        $product_id     = $this->input->post('product_id');

        if(!empty($this->session->userdata('web_logged_in')))
        {
            $ses_data   = $this->session->userdata('web_logged_in');
            $user_id    = $ses_data['id'];

        }else{
            if (empty($this->input->cookie('guest_id')) ) {
               $user_id =  $this->setCookiesOfEachUser();

            }else{
               // $user_id = get_cookie('guest_id');
               $user_id = $this->input->cookie('guest_id', TRUE);
            }
        }
        //check product exists
        $cond = 'status = "0" and user_id = "'.$user_id.'" and product_id = "'.$product_id.'" ';
        $dataCart = $this->CommonModel->selectRowDataByCondition($cond,'cart');
        if ($dataCart) {
            echo "2";
            exit;
        }

        $data = $this->CommonModel->selectRowDataByCondition(array("product_id" => $product_id),'product');
        if ($data) {
            $data_image = $this->CommonModel->selectRowDataByCondition(array("product_id" => $data->product_id,"priority" => 1),'product_image');

            // if ($data->discount == 0) {
            //     $discount_price = $data->price;
            //     $price          = $data->price;
            // }else{
            //     $price          = $data->discount_price;
            //     $discount_price = $data->discount_price;
            // }
            $price          = $data->price;
            $discount_price = $data->price;

            $product_image  = base_url().'product/'.$data_image->image;
            $product_id     = $data->product_id;
            $product_price  = $price;
            $product_name   = $data->product_name;
            $product_qty    = 1;

            $insertData =   array(
                                "product_id"    => $product_id,
                                "product_name"  => $product_name,
                                "user_id"       => $user_id,
                                "quantity"      => $product_qty,
                                "price"         => $discount_price,
                                "actual_price"  => $product_price,
                                "product_image" => $product_image,
                            );
            $data_insert = $this->CommonModel->insertData($insertData,'cart');
            if ($data_insert) {
                echo "1";
            }else{
                echo "0";
            }
        }else{
            echo "0";
        }
    }

    public function add_To_Cart($id)
    {   
        if (empty($id)) {
            $product_id     = $this->input->post('product_id');
        }else{
            $product_id     = $id;
        }

        if(!empty($this->session->userdata('web_logged_in')))
        {
            $ses_data   = $this->session->userdata('web_logged_in');
            $user_id    = $ses_data['id'];

        }else{
            if (empty($this->input->cookie('guest_id')) ) {
               $user_id =  $this->setCookiesOfEachUser();

            }else{
               // $user_id = get_cookie('guest_id');
               $user_id = $this->input->cookie('guest_id', TRUE);
            }
        }

        //check product exists
        $cond = 'status = "0" and user_id = "'.$user_id.'" and product_id = "'.$product_id.'"';
        $dataCart = $this->CommonModel->selectRowDataByCondition($cond,'cart');
        if ($dataCart) {
            redirect('website1/CheckOut/checkout');
        }
        $data = $this->CommonModel->selectRowDataByCondition(array("product_id" => $product_id),'product');
        if ($data) {
            $data_image = $this->CommonModel->selectRowDataByCondition(array("product_id" => $data->product_id,"priority" => 1),'product_image');

            if ($data->discount == 0) {
                $discount_price = $data->price;
                $price          = $data->price;
            }else{
                $price          = $data->discount_price;
                $discount_price = $data->discount_price;
            }
            $product_image  = base_url().'product/'.$data_image->image;
            $product_id     = $data->product_id;
            $product_price  = $price;
            $product_name   = $data->product_name;
            $product_qty    = 1;

            $insertData =   array(
                                "product_id"    => $product_id,
                                "product_name"  => $product_name,
                                "user_id"       => $user_id,
                                "quantity"      => $product_qty,
                                "price"         => $discount_price,
                                "actual_price"  => $product_price,
                                "product_image" => $product_image,
                            );
            $data_insert = $this->CommonModel->insertData($insertData,'cart');
            if ($data_insert) {
                echo "1";
            }else{
                echo "0";
            }
        }else{
            echo "0";
        }
    }

    public function cart_item()
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
        $this->load->view('website1/common_files/header',$arr);


        if(!empty($this->session->userdata('web_logged_in')))
        {
            $user_id    = $session_value['id'];

        }else{
            $user_id = $this->input->cookie('guest_id', TRUE);
        } 

        // echo $user_id;exit;
        $condition = array("user_id" => $user_id,"status" => 0);
        $data['cart'] = $this->CommonModel->selectResultDataByCondition($condition,'cart');
        // print_r($condition);die;

        $this->load->view('website1/cart',$data);
        $this->load->view('website1/common_files/footer');
    }

    public function delete_cart()
    {
        $condition = array(
            "cart_id" => $this->input->post('cart_id')
        );
        $categoryData = $this->CommonModel->delete($condition,'cart');  
        if ($categoryData) {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function checkout()
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

        if(!empty($this->session->userdata('web_logged_in')))
        {
            $ses_data   = $this->session->userdata('web_logged_in');
            $user_id    = $ses_data['id'];

        }else{
            if (empty($this->input->cookie('guest_id')) ) {
               $user_id =  $this->setCookiesOfEachUser();

            }else{
               // $user_id = get_cookie('guest_id');
               $user_id = $this->input->cookie('guest_id', TRUE);
            }
        }

        $this->load->view('website1/common_files/header',$arr);

        $condition = array("user_id" => $user_id,"status" => 0);
        // print_r($condition);die;

        $data['cart'] = $this->CommonModel->selectResultDataByCondition($condition,'cart');
        // print_r($data);die;


         
        $this->load->view('website1/check_out',$data);
        $this->load->view('website1/common_files/footer');
    }

    public function update_qty_price()
    {
        $data = array(
                    "price" => $this->input->post('price'),
                    "quantity" => $this->input->post('qty'),
                );
        $condition = array(
                    "cart_id" => $this->input->post('cart_id'),
                );
        $update = $this->CommonModel->updateRowByCondition($condition,'cart',$data);
        if ($update) {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function checkEmail()
    {
        $email = $this->input->post('email');
        $email = $this->CommonModel->selectRowDataByCondition(array("email" => $email ),'user');
        if ($email) {
            echo $email->id;
        }else{
            echo "0";
        }
    }

    public function proceed()
    {
        // echo $this->input->post('wallet');exit;
        $session_value = $this->session->userdata('web_logged_in');
        $user_id = $session_value['id'];
        $a = $this->CommonModel->selectRowDataByCondition(array("user_id" => $session_value['id']),'user');
        // print_r($a);exit;
        $api = new Instamojo\Instamojo('test_32abf059132b691bc4368e6fbc0', 'test_4804bdc4fdd0764b3aff48bdac7','https://test.instamojo.com/api/1.1/');

        // $user_id = $this->input->post('user_id');
        // $guest_id = $this->input->cookie('guest_id', TRUE);
        $total_amount = $this->input->post('total_amount');
        $city = explode(',', $this->input->post('city_id'));

            //Start get user id and update into cart table

                $data       = array("user_id" => $user_id);
                // $guest_id   = $this->input->cookie('guest_id', TRUE);
                // $condition  = array("user_id" => $guest_id);
                // $this->CommonModel->updateRowByCondition($condition,'cart',$data); 
                //Get data of cart 
                    $arr  = array();
                    $product  = array();
                    $cart = $this->CommonModel->selectResultDataByCondition($data,'cart'); 
                    foreach ($cart as $key => $value) {
                        array_push($arr, $value['cart_id']);
                        array_push($product, $value['product_id']);
                    }
                    $cart_ids       = implode(',', $arr);
                    $product_ids    = implode(',', $product);
            //End get user id and update into cart table

            // start check wallet amount
            if(!empty($this->input->post('wallet'))){
                if (!empty($a)) {
                	if ($a->wallet > 0) {
                        $wallet_amt = (int)$a->wallet - (int)151;
                        $wal = floor(($wallet_amt * 10)/100);
                        // echo "<br/>";
                        if((int)$total_amount >= (int)$wal )
                        {
                            $amt = (int)$total_amount - (int)$wal;
                            $amt1 = 0;
                            //wallet update = 0
                            // $wallet_amt -$wal;
                            $wal_amt = ($wallet_amt -$wal)+151;
                            // echo "<br/>";
                            $this->CommonModel->updateRowByCondition(array("user_id" => $user_id),'user',array('wallet' => $wal_amt));

                            //START insert into regular wallet table
                                if ($wal != 0) {
                                    $ins    = array(
                                                    "user_id" => $user_id,
                                                    "rem_wallet_amt" => $wal_amt,
                                                    "used_wallet_amt" => $wal,
                                                );
                                    
                                    $this->CommonModel->insertData($ins,'regular_wallet_used');
                                }
                            //END insert into regular wallet table
                        }else{
                            $amt = (int)$wal - (int)$total_amount;
                            // echo "<br/>";
                            $amt1 = 1;
                            $wal_amt = ($wallet_amt -$wal)+151+(int)$amt;
                            // echo "<br/>";
                            //wallet update = $amt
                            $this->CommonModel->updateRowByCondition(array("user_id" => $user_id),'user',array('wallet' => $wal_amt));
                            //START insert into regular wallet table
                                if ($wal != 0) {
                                    $ins    = array(
                                                    "user_id" => $user_id,
                                                    "rem_wallet_amt" => $wal_amt,
                                                    "used_wallet_amt" => $total_amount,
                                                );
                                    
                                    $this->CommonModel->insertData($ins,'regular_wallet_used');
                                }
                            //END insert into regular wallet table

                            $cartids   = explode(',', $cart_ids);
                            for ($j=0; $j < count($cartids); $j++) { 
                                $conditionCart = array(
                                    "cart_id"      => $cartids[$j],
                                ); 
                               $data = array("status" => 1);
                               $this->CommonModel->updateRowByCondition($conditionCart,'cart',$data);
                            }
                        }
                        // exit;
                    }else{
                        $amt = $total_amount;
                        $amt1 = 0;
                    }
                }else{
                	$amt = $total_amount;
                    $amt1 = 0;
                }
	        }else{
                $amt1 = 0;
                $amt = $total_amount;
            }        

            // end check wallet amount

            //Start make entry in booking

                $order_id = 'ORD-'.rand();

                $insertBooking = array(
                    "order_id"        => $order_id,
                    "user_id"         => $user_id,
                    "product_id"      => $product_ids,
                    "cart_id"         => $cart_ids,
                    "first_name"      => $this->input->post('first_name'),
                    "last_name"       => $this->input->post('last_name'),
                    "email"           => $this->input->post('email'),
                    "mobile"          => $this->input->post('phone'),
                    "address"         => $this->input->post('address'),
                    "country"         => $this->input->post('country'),
                    "state"           => $this->input->post('state_id'),
                    "city"            => $city[0],
                    "pincode"         => $this->input->post('postcode'),
                    "total_price"     => $amt,
                    "quantity"        => $this->input->post('quantity'),
                    "created_at"      => date('Y-m-d H:i:s'),
                    "updated_at"      => date('Y-m-d H:i:s')
                );

                //insert table
                $tblBooking = $this->CommonModel->insertData($insertBooking,'tbl_booking');
                $lastId = $this->db->insert_id();
            //End make entry in booking

            //Start make payment
                if ($amt1 == 0) {
                    try 
                    {
                        $response = $api->paymentRequestCreate(array(
                            "purpose" => 'Purchase Product',
                            "amount" => $amt,
                            "buyer_name" => $this->input->post('first_name').' '.$this->input->post('last_name'),
                            "phone" => $this->input->post('phone'),
                            "email" => $this->input->post('email'),
                            "send_email" => true,
                            "send_sms" => true,
                            'allow_repeated_payments' => false,
                            "redirect_url" => base_url()."website1/CheckOut/thankyou?id=".$lastId,
                            // "webhook" => "https://studentstutorial.com/instamojo/webhook.php"
                            ));
                        $pay_ulr = $response['longurl'];
                        // $this->session->set_flashdata('success','Package add Successfully');
                        // redirect('website1/website1/index');

                         /*start update producta quabntity*/
                            // $cartids   = explode(',', $cart_ids);
                            // for ($j=0; $j < count($cartids); $j++) { 
                            //     $conditionCart = array(
                            //         "cart_id"      => $cartids[$j],
                            //     ); 
                            //    $data = array("status" => 1);
                            //    $this->CommonModel->updateRowByCondition($conditionCart,'cart',$data);
                            // }


                            // $product_id = explode(',', $product_ids);
                            // for ($i=0; $i < count($product_id); $i++) { 
                                
                            //     $condition = array(
                            //         "product_id"      => $product_id[$i],
                            //     );
                            //     $product_Detail = $this->CommonModel->selectRowDataByCondition($condition,'product');

                            //     $remain_quantity = (int)$product_Detail->remaining_quantity;
                            //     $used_quantity = (int)$product_Detail->used_quantity;


                            //     if($remain_quantity > 0)
                            //     {
                            //         $remain         = (int)$remain_quantity - (int) 1;
                            //         $used           = (int)$used_quantity + (int) 1;

                            //         // print_r($used);die;

                            //         $this->CommonModel->updateRowByCondition($condition,'product',
                            //             array(
                            //                 "remaining_quantity" => $remain,
                            //                 "used_quantity" => $used
                            //             )
                            //         );
                            //     }
                            // }
                        /*end update producta quantity*/
                        
                        header("Location: $pay_ulr");
                        exit();
                    }
                    catch (Exception $e) {
                        print('Error: ' . $e->getMessage());
                    }  
                }else{
                    redirect("website1/CheckOut/thankyou?id=".$lastId);
                    // $this->load->view('email_templates/thankyou?id='.$lastId);
                }
            //End make payment
        // }
    }

    public function count_cart()
    {
        if(!empty($this->session->userdata('web_logged_in')))
        {
            $ses_data   = $this->session->userdata('web_logged_in');
            $user_id    = $ses_data['id'];

        }else{
            if (empty($this->input->cookie('guest_id')) ) {
               $user_id =  $this->setCookiesOfEachUser();

            }else{
               // $user_id = get_cookie('guest_id');
               $user_id = $this->input->cookie('guest_id', TRUE);
            }
        }
        $condition = array("user_id" => $user_id,"status" => 0);
        $data = $this->CommonModel->countDataWithCondition('cart',$condition);
        $cart = $this->CommonModel->selectResultDataByCondition($condition,'cart');
        // print_r($condition);exit;
        $li   = '<ul>';
        $add  = 0;
        if (!empty($cart)) {
            foreach ($cart as $key => $value) {
                $checkoutUrl    = base_url().'website1/CheckOut/checkout';
                $cartUrl        = base_url().'website1/CheckOut/cart_item';
                $add            = (int)$value["price"] + (int)$add;
                $li .='<li>
                        <div class="cart-img">
                            <a href="#"><img alt="" src="'.$value['product_image'].'"></a>
                        </div>
                        <div class="cart-info">
                            <h4><a href="#">'.$value['product_name'].'</a></h4>
                        <span><i class="fas fa-rupee-sign"></i>'.$value['price'].' <span>x '.$value['quantity'].'</span></span>
                        </div>
                        <div class="del-icon">
                            <a onclick = "delteFunction('.$value["cart_id"].')" ><i class="fa fa-times-circle"></i></a>
                        </div>
                    </li>';
            }
            $li .= '<li class="cart-border">
                        <div class="subtotal-text">Subtotal: </div>
                        <div class="subtotal-price"><i class="fas fa-rupee-sign"></i>'.$add.'</div>
                    </li>
                    <li>
                        <a class="cart-button" href="'.$cartUrl.'">view cart</a>
                        <a class="checkout" href="'.$checkoutUrl.'">checkout</a>
                    </li></ul>';
            $res['data']    = $data;
            $res['li']      = $li;
        }else{
            $res['data']    = 0;
            $res['li']      = '';
        }
        if (!empty($res)) {
            echo json_encode($res);
        }else{
            echo "0";
        }
    }

    public function getInfo()
    {
    	$total_amount 	= $this->input->post('total_amount');
    	$condition 		= array("user_id" => $this->input->post('session_id'));
    	$user = $this->CommonModel->selectRowDataByCondition($condition,'user');
    	if ($user) {
    		$package_id = $user->package_id;

    		$wallet 	= $user->wallet;
    		if ($package_id != 0 || $package_id!= '') {

    			if ((int)$wallet >= 151) {
					$package 	= $this->CommonModel->selectRowDataByCondition(array("package_id" => $package_id),'package');
					if($package)
					{
                        // print_r($package->price);exit;
			    		if ((int)$package->price <= 1500) {
			    			$calcValue = 3000;
			    			$discountAmount = 250;
			    		}else if ((int)$package->price <= 5000) {
			    			$calcValue = 5000;
			    			$discountAmount = 500;
			    		}else if ((int)$package->price <= 15000) {
			    			$calcValue = 10000;
			    			$discountAmount = 1000;
			    		}else if ((int)$package->price <= 25000) {
                            $calcValue = 25000;
                            $discountAmount = 2000;
                        }else if ((int)$package->price <= 50000) {
                            $calcValue = 50000;
                            $discountAmount = 5000;
                        }else{
			    			$calcValue = 100000;
			    			$discountAmount = 10000;
			    		}
			    		if ((int)$total_amount >= (int)$calcValue) {
	    					echo "3 ".$discountAmount;
	    				}else{
	    					echo "4";exit;
	    				}
			    	}else{
			    		echo "2";exit;
			    	}

    			}else{
    				echo "1";exit;
    			}
    		}else{
    			echo "0";exit;
    		}
    	}
    }
}
