<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
class TripController extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( 'form_validation' );
		$this->load->language( 'english' );
		$this->form_validation->set_error_delimiters('', '');
	}
	
	public function tripList_post()
	{
	   // echo "hi";die;
	     $this->form_validation->set_rules('parent_id', 'Parent Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $parent_id = $this->input->post('parent_id');
        
        $parentsWhere = array('id' => $parent_id);
        
        $parentsData = $this->CommonModel->selectRowDataByCondition($parentsWhere,'parents');
            
        if(empty($parentsData))
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'No Parents found',
				'Data '	=> new stdClass()
			));
        }
        
        $parentId = $parentsData->id;
        $parentsTripData = $this->ApiModel->checkParentsTripList($parentId);
        // print_r($parentsTripData);die;
        
        if($parentsTripData)
        {
            $priority = 1;
            foreach ($parentsTripData as $key => $value) 
        	{
        		$dataText[] = array(
					'priority' 		        =>  $priority,
					'trip_id' 		        =>  $this->check_value($value['trip_id']),
					'trip_number' 		    =>  $this->check_value($value['tridID']),
					'bus_number' 			=>  $this->check_value($value['bus_number']),
					'driver_name' 			=>  $this->check_value($value['driver_name']),
					'drive_mobile_number' 	=>  $this->check_value($value['drive_mobile_number']),
					'chaperone_name' 	    =>  $this->check_value($value['chaperone_name']),
					'chaperone_phone' 	    =>  $this->check_value($value['chaperone_phone']),
					'chaperone_image' 		    =>  $this->check_value(base_url().'uploads/chaperone/default.png'),
				// 	'client_user_name' 		=>  $this->check_value($value['client_user_name']),
				// 	'client_name' 			=>  $this->check_value($value['client_name']),
				// 	'client_logo_image'     =>  $this->check_value(base_url().'uploads/client/'.$value['client_logo_image']),
					'pickup_address' 		=>  $this->check_value($value['pickup_address']),
					'pickup_latitude' 		=>  $this->check_value($value['pickup_latitude']),
					'pickup_longitude' 		=>  $this->check_value($value['pickup_longitude']),
					'drop_address' 			=>  $this->check_value($value['drop_address']),
					'drop_latitude' 		=>  $this->check_value($value['drop_latitude']),
					'drop_longitude' 		=>  $this->check_value($value['drop_longitude']),
					'trip_start' 			=>  $this->check_value($value['trip_start']),
					'trip_end' 			    =>  $this->check_value($value['trip_end']),
					'status' 			    =>  $this->check_value($value['status']),
					'complete_status' 		=>  $this->check_value($value['complete_status']),
				);
				
			$priority ++;
        	}
        	$msg = "All Parent Trip";
        }else{
            $msg = "No Parent Trip";
            $dataText = array();  
        }
        
        $arr = $dataText;
        
        return $this->response(array(
			'status'	=> REST_Controller::HTTP_OK,
			'message' 	=> $msg,
			'object'	=> $arr
		));
	}
	
	public function tripDetail_post()
	{
	     $this->form_validation->set_rules('parent_id', 'Parent Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $this->form_validation->set_rules('trip_id', 'Trip Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $parent_id = $this->input->post('parent_id');
        $trip_id = $this->input->post('trip_id');
        
        $parentsWhere = array('id' => $parent_id);
        
        $parentsData = $this->CommonModel->selectRowDataByCondition($parentsWhere,'parents');
            
        if(empty($parentsData))
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'No Parents found',
				'Data '	=> new stdClass()
			));
        }
        
        $parentId = $parentsData->id;
        $parentsTripData = $this->ApiModel->checkParentsTripDetail($trip_id,$parentId);
        // print_r($parentsTripData);die;
        if($parentsTripData){
        	$data['trip_id'] 		        = 	 $this->check_value($parentsTripData->trip_id);
        	$data['tridID'] 		        = 	 $this->check_value($parentsTripData->tridID);
        	$data['bus_number'] 		    = 	 $this->check_value($parentsTripData->bus_number);
        	$data['driver_name'] 		    = 	 $this->check_value($parentsTripData->driver_name);
        	$data['drive_mobile_number'] 	= 	 $this->check_value($parentsTripData->drive_mobile_number);
        	$data['chaperone_name'] 		= 	 $this->check_value($parentsTripData->chaperone_name);
        	$data['chaperone_phone'] 		= 	 $this->check_value($parentsTripData->chaperone_phone);
        	$data['client_user_name'] 		= 	 $this->check_value($parentsTripData->client_user_name);
        	$data['client_name'] 		    = 	 $this->check_value($parentsTripData->client_name);
        	$data['client_logo_image'] 		= 	 $this->check_value(base_url().'uploads/client/'.$parentsTripData->client_logo_image);
        	$data['pickup_address'] 		= 	 $this->check_value($parentsTripData->pickup_address);
        	$data['pickup_latitude'] 		= 	 $this->check_value($parentsTripData->pickup_latitude);
        	$data['pickup_longitude'] 		= 	 $this->check_value($parentsTripData->pickup_longitude);
        	$data['drop_address'] 		    = 	 $this->check_value($parentsTripData->drop_address);
        	$data['drop_latitude'] 		    = 	 $this->check_value($parentsTripData->drop_latitude);
        	$data['drop_longitude'] 		= 	 $this->check_value($parentsTripData->drop_longitude);
        	$data['trip_start'] 		    = 	 $this->check_value($parentsTripData->trip_start);
        	$data['trip_end'] 		        = 	 $this->check_value($parentsTripData->trip_end);
        	$data['status'] 		        = 	 $this->check_value($parentsTripData->status);
        	$data['complete_status'] 		= 	 $this->check_value($parentsTripData->complete_status);
        	
        	$msg = "Parent Trip";
        }else{
            $msg = "No Parent Trip";
            $data = array(); 
        }
        
        return $this->response(array(
			'status'	=> REST_Controller::HTTP_OK,
			'message' 	=> $msg,
			// 'count' 	=> $totalTip,
			'object'	=> $data
		));
            
	}
}