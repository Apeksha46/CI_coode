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
	     $this->form_validation->set_rules('chaperone_id', 'Chaperone Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $chaperone_id = $this->input->post('chaperone_id');
        
        $chaperoneWhere = array('id' => $chaperone_id);
        $chaperoneData = $this->CommonModel->selectRowDataByCondition($chaperoneWhere,'chaperone'); 
            
        if(empty($chaperoneData))
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'No chaperone found',
				'Data '	=> new stdClass()
			));
        }
        
        // $chaperoneTripData = $this->ApiModel->checkChaperoneTrip($chaperone_id);
        $chaperoneTripData = $this->CommonModel->checkChaperoneTrip($chaperone_id);
        // print_r($chaperoneTripData);die;
        if($chaperoneTripData){
            foreach ($chaperoneTripData as $key => $value) 
        	{
        		$dataText[] = array(
					'trip_id' 		        =>  $value['trip_id'],
					'trip_number' 		    =>  $value['tridID'],
					'bus_number' 			=>  $value['bus_number'],
					'driver_name' 			=>  $value['driver_name'],
					'chaperone_name' 	=>  $value['chaperone_name'],
					'chaperone_phone' 	=>  $value['chaperone_phone'],
					'drive_mobile_number' 	=>  $value['drive_mobile_number'],
					'client_user_name' 		=>  $value['client_user_name'],
					'client_name' 			=>  $value['client_name'],
					'pickup_address' 			=>  $this->check_value($value['pickup_address']),
					'pickup_latitude' 			=>  $this->check_value($value['pickup_latitude']),
					'pickup_longitude' 			=>  $this->check_value($value['pickup_longitude']),
				// 	'client_logo_image'     =>  $this->check_value(base_url().'uploads/client/'.$value['client_logo_image']),
					'drop_address' 			=>  $this->check_value($value['drop_address']),
					'drop_latitude' 			=>  $this->check_value($value['drop_latitude']),
					'drop_longitude' 			=>  $this->check_value($value['drop_longitude']),
					'trip_start' 			=>  $this->check_value($value['trip_start']),
					'trip_end' 			=>  $this->check_value($value['trip_end']),
					'status' 			=>  $this->check_value($value['status']),
					'complete_status' 			=>  $this->check_value($value['complete_status']),
				);
        	}
        	$msg = "All Chaperone Trip";
        // 	$arr['chaperone_trip'] = $chaperoneTrip;
        }else{
            $msg = "No Chaperone Trip";
            $dataText = array();  
        }
        
        $arr = $dataText;
        
        return $this->response(array(
			'status'	=> REST_Controller::HTTP_OK,
			'message' 	=> $msg,
			// 'count' 	=> $totalTip,
			'object'	=> $arr
		));
	}
	
	public function tripDetail_post()
	{
	     $this->form_validation->set_rules('chaperone_id', 'Chaperone Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $chaperone_id = $this->input->post('chaperone_id');
        
        $chaperoneWhere = array('id' => $chaperone_id);
        $chaperoneData = $this->CommonModel->selectRowDataByCondition($chaperoneWhere,'chaperone'); 
            
        if(empty($chaperoneData))
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'No chaperone found',
				'Data '	=> new stdClass()
			));
        }
        
        // $chaperoneTripData = $this->ApiModel->checkChaperoneTrip($chaperone_id);
        $chaperoneTripData = $this->CommonModel->checkChaperoneTripAvailable($chaperone_id);
        // print_r($chaperoneTripData);die;
        if($chaperoneTripData){
        	$data['trip_id'] 		= 	 $this->check_value($chaperoneTripData->trip_id);
        	$data['trip_number'] 		= 	 $this->check_value($chaperoneTripData->tridID);
        	$data['bus_number'] 		= 	 $this->check_value($chaperoneTripData->bus_number);
        	$data['driver_name'] 		= 	 $this->check_value($chaperoneTripData->driver_name);
        	$data['drive_mobile_number'] 		= 	 $this->check_value($chaperoneTripData->drive_mobile_number);
        	$data['chaperone_name'] 		= 	 $this->check_value($chaperoneTripData->chaperone_name);
        	$data['chaperone_phone'] 		= 	 $this->check_value($chaperoneTripData->chaperone_phone);
        // 	$data['client_user_name'] 		= 	 $this->check_value($chaperoneTripData->client_user_name);
        // 	$data['client_name'] 		= 	 $this->check_value($chaperoneTripData->client_name);
        // 	$data['client_logo_image'] 		= 	 $this->check_value(base_url().'uploads/client/'.$chaperoneTripData->client_logo_image);
        	$data['pickup_address'] 		= 	 $this->check_value($chaperoneTripData->pickup_address);
        	$data['pickup_latitude'] 		= 	 $this->check_value($chaperoneTripData->pickup_latitude);
        	$data['pickup_longitude'] 		= 	 $this->check_value($chaperoneTripData->pickup_longitude);
        	$data['drop_address'] 		= 	 $this->check_value($chaperoneTripData->drop_address);
        	$data['drop_latitude'] 		= 	 $this->check_value($chaperoneTripData->drop_latitude);
        	$data['drop_longitude'] 		= 	 $this->check_value($chaperoneTripData->drop_longitude);
        	$data['trip_start'] 		= 	 $this->check_value($chaperoneTripData->trip_start);
        	$data['trip_end'] 		= 	 $this->check_value($chaperoneTripData->trip_end);
        	$data['status'] 		= 	 $this->check_value($chaperoneTripData->status);
        	$data['complete_status'] 		= 	 $this->check_value($chaperoneTripData->complete_status);
        	$msg = "Chaperone Trip";
        // 	$arr['chaperone_trip'] = $chaperoneTrip;
        }else{
            $msg = "No Chaperone Trip";
            $data = array(); 
        }
        
        // $arr = $dataText;
        
        return $this->response(array(
			'status'	=> REST_Controller::HTTP_OK,
			'message' 	=> $msg,
			// 'count' 	=> $totalTip,
			'object'	=> $data
		));
            
	}
	
	public function tripStartStop_post()
	{
	    $this->form_validation->set_rules('chaperone_id', 'Chaperone Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $chaperone_id = $this->input->post('chaperone_id');
        
        $chaperoneWhere = array('id' => $chaperone_id);
        $chaperoneData = $this->CommonModel->selectRowDataByCondition($chaperoneWhere,'chaperone'); 
            
        if(empty($chaperoneData))
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'No chaperone found',
				'Data '	=> new stdClass()
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
        
        $this->form_validation->set_rules('status', 'status', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $trip_id	        =   $this->input->post('trip_id'); 
        $complete_status	=   $this->input->post('status'); 
        
        $whereTrip = array("id" =>  $trip_id,);
		$tripDetail = $this->CommonModel->selectRowDataByCondition($whereTrip,'trip');
		
		if(empty($tripDetail))
		{
		    return $this->response(array(
				'status'	=> REST_Controller::HTTP_OK,
				'message' 	=> 'No trip found',
				'object'	=> new stdClass()
			));
		}
		
		if($complete_status == 1){
			$status 	=  1;
		}else{
		    $status 	=  2;
		}
			
        $data = array(
        	"complete_status" 	=>  $complete_status,
        	"status" 	        =>  $status,
        );
		
		$updateData = $this->db->where('id',$trip_id)->update('trip', $data);
        
        if($updateData)
		{
		    if($complete_status == 1){
				$msg 	=  'Your trip start successfully';
			}else{
				$msg 	=  'Your trip stop successfully';
			}

			return $this->response(array(
				'status'	=> REST_Controller::HTTP_OK,
				'message' 	=> $msg,
				// 'object'	=> new stdClass()
			));
		}else
		{
			return $this->response(array(
				'status'	=> REST_Controller::HTTP_OK,
				'message' 	=> 'Somethings went wrong',
				// 'object'	=> new stdClass()
			));
		}
		
        
        
	}
	
	
	
}