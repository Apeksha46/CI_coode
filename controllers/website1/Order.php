
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $sessionValue = $this->web_logged();
		// $this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');
		// $this->load->model( 'CommonModel' );

		 // $sessionValue = $this->_webLoginCheck();


	}
	public function index()
	{
		// echo "string";
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

        $data['user_detail'] = $this->CommonModel->cartJoin($session_value['id']);

        $this->load->view('website1/order',$data);
        $this->load->view('website1/common_files/footer');
	}

	public function order_detail()
	{
		// echo "string";
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

		$arr = array();
		$booking_id = $this->uri->segment('4');
		$booking = $this->CommonModel->selectRowDataByCondition(array("booking_id" => $booking_id),'tbl_booking');
		if ($booking) {
			$cart_id = explode(',', $booking->cart_id);
			for ($i=0; $i < count($cart_id); $i++) { 
				
				$cart = $this->CommonModel->selectRowDataByCondition(array("cart_id" => $cart_id[$i]),'cart');
				$arr[]  = array(
									
									"cart_id" 		=> $cart->cart_id,
									"product_name" 	=> $cart->product_name,
									"product_image" => $cart->product_image,
									"quantity" 		=> $cart->quantity,
									"price" 		=> $cart->price,
								);
			}
		}else{
			$arr = array();
		}
		
		$data['order_id'] = $booking->order_id;
		$data['total_price'] = $booking->total_price;
		$data['payment_status'] = $booking->payment_status;
		$data['date'] =  date('d-M-Y',strtotime($booking->created_at));
		$data['cart'] = $arr;
		// print_r($data);exit;
		$this->load->view('website1/order_detail',$data);
        $this->load->view('website1/common_files/footer');
	}


}
