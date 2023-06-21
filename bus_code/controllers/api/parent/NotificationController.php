<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
class NotificationController extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( 'form_validation' );
		$this->load->language( 'english' );
		$this->form_validation->set_error_delimiters('', '');
	}
	
	public function notification_list_post()
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
        
        $timeWhere = array(
			"status" => 1,
			"type"  => 1,
			
		);

		$timeData = $this->CommonModel->selectResultDataByCondition($timeWhere,'parents_notification');
        if($timeData)
        {
        	foreach ($timeData as $key => $value) 
        	{
        		$time[] = array(
					'id' 	    =>  $value['id'],
					'name' 		=>  $value['name'],
				);
        	}
        	$arr['time'] = $time;
        }else
        {
			$arr['time'] = array();
        }
        
        $distanceWhere = array(
			"status" => 1,
			"type"  => 2,
			
		);

		$distanceData = $this->CommonModel->selectResultDataByCondition($distanceWhere,'parents_notification');
        if($distanceData)
        {
        	foreach ($distanceData as $key => $value) 
        	{
        		$distance[] = array(
					'id' 	    =>  $value['id'],
					'name' 		=>  $value['name'],
				);
        	}
        	$arr['distance'] = $distance;
        }else
        {
			$arr['time'] = array();
        }
        
// 		if(!empty($data))
// 		{
// 			foreach ($data as $key => $value)
// 			{
// 				$dataText[] = array(
// 					'id' 	    =>  $value['id'],
// 					'name' 		=>  $value['name'],
// 				);
// 			}
// 			$msg = 'All Setup Notification List';
// 		}
// 		else
// 		{
// 			$dataText = array();
// 			$msg = 'No Setup Notification Found';
// 		}

// 		$arr = $dataText;

		return $this->response(array(
			'status'	=> REST_Controller::HTTP_OK,
			'message' 	=> 'All Setup Notification List',
			'output'	=> $arr
		));

	}
	
	public function setupNotifiication_post()
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
        
         $this->form_validation->set_rules('notification_id', 'Notification Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $notification_id = $this->input->post('notification_id');
        
        $data = array(
                'notification_id' => $notification_id, 
        );
        
        $updateNotificationData = $this->CommonModel->updateRowByCondition($parentsWhere,'parents',$data); 
        
        
        if($updateNotificationData){
            return $this->response(array(
					'status'	=> REST_Controller::HTTP_OK,
					'message' 	=> 'You setup notification successfully',
				));
            
        }else{
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'Something went wrong',
			));
        }
        
        


	}
	
}