<?php
class CommonModel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->library( 'Utility' );
	}

	//fetch all data api
	public function selectResultData($table,$fieldName)
	{
		$this->db->select('*')
		->from($table);
		$this->db->order_by($fieldName, "desc");
		return $this->db->get()->result_array();
	}

	//select all data asc
	public function selectAllResultData($table)
	{
		$this->db->select('*')
		->from($table);
		return $this->db->get()->result_array();
	}

	public function countData($table)
	{
		return $this->db->count_all_results($table);
	}
	public function countDataWithCondition($table,$condition)
	{
		return $this->db->where($condition)->from($table)->count_all_results();
	}

	//check condition api
	public function selectRowDataByCondition($condition,$table)
	{
		$this->db->select('*')
		->from($table);
		$this->db->where($condition);
		return $this->db->get()->row();
	}
	//get all data with where condition api
	public function selectResultDataByCondition($condition,$table)
	{
		$this->db->select('*')
		->from($table);
		$this->db->where($condition);
		return $this->db->get()->result_array();
	}

	public function selectResultDataByCondition1($condition,$table)
	{
		// print_r($condition);
		$this->db->select('*')
		->from($table);
		$this->db->where($condition);
		$data = $this->db->get();
		// print_r($data);
		if (!empty($data->result_array())) {
			return $data->result_array();
		}
	}
	//get all data with where condition api
	public function selectResultDataByConditionAndFieldName($condition,$table,$fieldName)
	{
		$this->db->select('*')
		->from($table);
		$this->db->order_by($fieldName, "desc");
		$this->db->where($condition);
		return $this->db->get()->result_array();
	}
    public function selectRowDataByConditionAndFieldName($condition,$table,$fieldName)
	{
		$this->db->select('*')
		->from($table);
		$this->db->order_by($fieldName, "desc");
		$this->db->where($condition);
		return $this->db->get()->row();
	}
	//insert api
	public function insertData($data,$table)
	{
		$result = $this->db->insert($table, $data);
		if( $result != FALSE )
		{
			return $data;
		}
		else
		{
			return FALSE;
		} 	
	}

	//update condition api
	public function updateRowByCondition($condition,$table,$data)
	{  
		//echo $this->email->print_debugger();
		return $this->db->update($table, $data , $condition);
	}
	//update condition api
	public function updateRow($table,$data)
	{  
		//echo $this->email->print_debugger();
		return $this->db->update($table, $data);
	}

   public function sendMail($data)
   {
   	// print_r($data);exit;
   	    $this->email->initialize(array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'smtp.sendgrid.net',
		  'smtp_user' => 'neeteshagrawal',
		  'smtp_pass' => 'neetesh@12345',
		  'smtp_port' => 587,
		  'crlf' => "\r\n",
		  'mailtype' => "html",
		  'charset' => "iso-8859-1",
		  'newline' => "\r\n"
		));

		$this->email->from('info@bright_future.com', 'Bright Future');
		$this->email->to($data['to']);
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');
		$this->email->subject($data['subject']);
		$this->email->message($data['message']);
		if($this->email->send())
		{
			return 1;
		}else{
			return 0;
		}
   }
	//delete api
	public function delete($condition,$table)
	{
		$this->db->where($condition);
		return $this->db->delete($table);
	}

	//bookingJoin
	public function bookingJoin($cus_id){
		$this->db->select("booking.*,seller.seller_first_name,seller.seller_last_name,product.product_name,product.price")
            ->from('booking'); 
	    $this->db->join('seller','seller.seller_id = booking.seller_id','left');
	    $this->db->join('product','product.product_id = booking.product_id','left');
	     $this->db->where(array("booking.customer_id" => $cus_id));
	    $this->db->order_by("booking_id", "desc");
	    return $this->db->get()->result_array();
	}
	//filter bookingJoin
	public function filterBookingJoin($cus_id,$start,$end){
		$this->db->select("booking.*,seller.seller_first_name,seller.seller_last_name,product.product_name,product.price")
            ->from('booking'); 
	    $this->db->join('seller','seller.seller_id = booking.seller_id','left');
	    $this->db->join('product','product.product_id = booking.product_id','left');
	    $this->db->where(array("booking.customer_id" => $cus_id,"booking.booking_date>=" => $start, "booking.booking_date<=" => $end));
	    $this->db->order_by("booking_id", "desc");
	    return $this->db->get()->result_array();
	}

	//bookingSaleJoin
	public function bookingSaleJoin($sale_id){
		$this->db->select("booking.*,customer.customer_first_name,customer.customer_last_name,product.product_name,product.price")
            ->from('booking'); 
	    $this->db->join('customer','customer.customer_id = booking.customer_id','left');
	    $this->db->join('product','product.product_id = booking.product_id','left');
	     $this->db->where(array("booking.seller_id" => $sale_id));
	    $this->db->order_by("booking_id", "desc");
	    return $this->db->get()->result_array();
	}
	//filter bookingSaleJoin
	public function filterBookingSaleJoin($sale_id,$start,$end){
		$this->db->select("booking.*,customer.customer_first_name,customer.customer_last_name,product.product_name,product.price")
            ->from('booking'); 
	    $this->db->join('customer','customer.customer_id = booking.customer_id','left');
	    $this->db->join('product','product.product_id = booking.product_id','left');
	    $this->db->where(array("booking.seller_id" => $sale_id,"booking.booking_date>=" => $start, "booking.booking_date<=" => $end));
	    $this->db->order_by("booking_id", "desc");
	    return $this->db->get()->result_array();
	}
	//complete booking
	public function completeBookingJoin($driver_id){
		$this->db->select("booking.*,driver_booking.driver_id")
            ->from('booking'); 
	    $this->db->join('driver_booking','driver_booking.booking_id = booking.booking_id','left');
	    $this->db->where(array("driver_booking.accept_status" => '1',"driver_booking.driver_id" => $driver_id, "booking.payment_status" => '1'));
	    $this->db->order_by("booking_id", "desc");
	    return $this->db->get()->result_array();
	}
	//runing booking
	public function runningBookingJoin($driver_id){
		$this->db->select("booking.*,driver_booking.driver_id")
            ->from('booking'); 
	    $this->db->join('driver_booking','driver_booking.booking_id = booking.booking_id','left');

	    $this->db->where("`driver_booking`.`accept_status` = '1' AND `driver_booking`.`driver_id` = '".$driver_id."' AND `booking`.`payment_status` != '1' AND `booking`.`payment_status` != '4'");
	    $this->db->order_by("booking_id", "desc");
	    return $this->db->get()->result_array();
	}
	//join
	public function joinOneTableRecord(){
		$this->db->select("sub_category.*,category.category_name")
            ->from('sub_category'); 
	    $this->db->join('category','category.category_id = sub_category.category_id','left');
	    $this->db->order_by("sub_category_id", "desc");
	    return $this->db->get()->result_array();
	}
	//join
	public function advert(){
		$this->db->select("advert.*,plan.plan_name,seller.seller_business_name,seller.seller_business_address")
            ->from('advert'); 
	    $this->db->join('plan','plan.plan_id = advert.plan_id','left');
	    $this->db->join('seller','seller.seller_id = advert.seller_id','left');
	    $this->db->order_by("advert_id", "desc");
	    return $this->db->get()->result_array();
	}
	public function productData(){
		$this->db->select("product.*,seller.seller_first_name,seller.seller_last_name,admin.name,category.category_name,sub_category.sub_category_name")
            ->from('product'); 
	    $this->db->join('admin','admin.admin_id = product.admin_id','left');
	    $this->db->join('seller','seller.seller_id = product.seller_id','left');
	    $this->db->join('category','category.category_id = product.category_id','left');
	    $this->db->join('sub_category','sub_category.sub_category_id = product.sub_category_id','left');
	    $this->db->order_by("product_id", "desc");
	    return $this->db->get()->result_array();
	}
	public function productDataAccToSeller($seller_id){
		$this->db->select("product.*,category.category_name,sub_category.sub_category_name")
            ->from('product'); 
	    $this->db->join('category','category.category_id = product.category_id','left');
	    $this->db->join('sub_category','sub_category.sub_category_id = product.sub_category_id','left');
	    $this->db->where(array("product.seller_id" => $seller_id, "product.is_sale" => 0 ));
	    $this->db->order_by("product_id", "desc");
	    return $this->db->get()->result_array();
	}
	public function productDataAccToSale($sale_id){
		$this->db->select("product.*,seller.*,category.category_name,sub_category.sub_category_name")
            ->from('product'); 
	    $this->db->join('seller','seller.seller_id = product.seller_id','left');
	    $this->db->join('category','category.category_id = product.category_id','left');
	    $this->db->join('sub_category','sub_category.sub_category_id = product.sub_category_id','left');
	    $this->db->where(array("product.sale_id" => $sale_id ));
	    $this->db->order_by("product_id", "desc");
	    return $this->db->get()->result_array();
	}
	public function colorData(){
	    $session_value = $this->session->userdata('ses_logged_in');
		$this->db->select("color.*,product.product_id,product.product_name")
            ->from('color'); 
	    $this->db->join('product','product.product_id = color.product_id','left');
	    
	    $this->db->where(array("product.admin_id" => $session_value['admin_id']));
	    
	    $this->db->order_by("color_id", "desc");
	    return $this->db->get()->result_array();
	}
	public function colorDataWhereCondition($is_sale){
		$session_value = $this->session->userdata('seller_logged_in');
		$this->db->select("color.*,product.product_id,product.product_name,product.seller_id")
            ->from('color'); 
	    $this->db->join('product','product.product_id = color.product_id','left');
	    $this->db->where(array("product.seller_id" => $session_value['seller_id'], "product.is_sale" => $is_sale));
	    // $this->db->order_by("product_id", "desc");
	    return $this->db->get()->result_array();
	}
	public function productDataWithCondition(){
		$session_value = $this->session->userdata('seller_logged_in');
		$this->db->select("product.*,category.category_name,sub_category.sub_category_name")
            ->from('product'); 
	    $this->db->join('category','category.category_id = product.category_id','left');
	    $this->db->join('sub_category','sub_category.sub_category_id = product.sub_category_id','left');
	    $this->db->where(array("product.seller_id" => $session_value['seller_id'] , "type" => "sell" , "is_sale" => '0'));
	    $this->db->order_by("product_id", "desc");
	    return $this->db->get()->result_array();
	}
	public function saleProductDataWithCondition(){
		$session_value = $this->session->userdata('seller_logged_in');
		$this->db->select("product.*,category.category_name,sub_category.sub_category_name")
            ->from('product'); 
	    $this->db->join('category','category.category_id = product.category_id','left');
	    $this->db->join('sub_category','sub_category.sub_category_id = product.sub_category_id','left');
	    $this->db->where(array("product.seller_id" => $session_value['seller_id'],"is_sale" => '1'));
	    $this->db->order_by("product_id", "desc");
	    return $this->db->get()->result_array();
	}
	public function distanceDriverCount($lat,$longi,$radius)
	{
		// echo $lat;
		// echo $longi;exit;
		$this->db->select(" *,
		ROUND(
		    (6353 * 2 * ASIN(
		    SQRT( 
		        POWER(
		           SIN(
		                (".$lat." - abs(driver_latitude)) 
		                * pi()/180 / 2),2) 
		                + COS(".$lat." * pi()/180 ) 
		                * COS(abs(driver_latitude) *  pi()/180) 
		                * POWER(SIN((".$longi. "- driver_longitude) 
		                *  pi()/180 / 2), 2) )
		            )
		        ), 
		    2
		) 
		AS total_distance")
					->from('delivery_man');
		$this->db->where(array("kyc_verified_status" => '1',"is_active" => '1'));
		$this->db->having('total_distance <= '.$radius);
		return $this->db->get()->result_array();
	}
}