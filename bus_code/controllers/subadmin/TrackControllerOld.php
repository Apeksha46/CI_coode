<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class TrackController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_subadminlogin();
        $this->load->library('excel');
        $this->load->library('pdf');
	}

    public function status_list()
    {	
    	// echo "string";die;
        $data['title'] = $this->lang->line('status');

        $client_user = $this->session->userdata('ses_subadmin_id');

        $data['getAllStatus'] = $this->CommonModel->statusUserList($client_user);

        $where = array(
            "is_delete"         =>  0,
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        $data['getAllBus'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'bus','bus.id');

        

        $data['getAllChaperone'] = $this->CommonModel->chaperoneData($client_user);



        $data['getAllDriver'] = $this->CommonModel->driverData($client_user);

        // print_r($data['getAllBus']);die;
    	$this->loadSubAdminView('subadmin/track/status',$data); 
    }


    public function getStatuUser()
    {
    	// print_r($_POST);die;
        $client_user = $this->session->userdata('ses_subadmin_id');
    	$bus_id = $this->input->post('bus_id');
    	$driver_id = $this->input->post('driver_id');
    	$status = $this->input->post('status');
    	$chaperone_id = $this->input->post('chaperone_id');

    	$clientuserData = $this->CommonModel->statusUser($bus_id,$driver_id,$status,$chaperone_id,$client_user);
    	// print_r($clientuserData);die;
    	if (!empty($clientuserData))
        {
            $k = 0;
            for ($i=0; $i < count($clientuserData); $i++) 
            { 
                $k = $k+1;
                // $k = "";

                	if($clientuserData[$i]['status'] == 1){
                		$status = '<button class="btn btn-sm btn-warning">Live</button>';
                	}else{
                		$status = '<button class="btn btn-sm btn-warning">No Live</button>';
                	}

                    $arr[] = array(
                        // $k,
                        $clientuserData[$i]['bus_number'],
                        $clientuserData[$i]['driver_name'],
                        $clientuserData[$i]['chaperone_name'],
                        $status,
                        $clientuserData[$i]['trip_start'],
                        $clientuserData[$i]['trip_end'],
                    );
            }

        }
// print_r($arr);die;
        if (!empty($arr)) {
            $arr2 = array("data" => $arr);
        }else{
            $arr2 = array("data" => []);
        }
        
        echo json_encode($arr2);
    	// $client_id = $this->input->post('client_id');
    }

    

}
