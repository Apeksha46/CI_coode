<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class TripController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_subadminlogin();
        $this->load->library('excel');
        $this->load->library('pdf');
	}

    public function trip_list()
    {	
    	// echo "string";die;
        $data['title'] = $this->lang->line('status');

        $client_user = $this->session->userdata('ses_subadmin_id');

        // $data['getAllStatus'] = $this->CommonModel->tripUserList($client_user);
        $data['getAllStatus'] = $this->CommonModel->tripList($client_user);

        $data['trip_count'] = $this->CommonModel->select_single_row("Select count(*) as total from trip where client_user_id =".$this->session->userdata('ses_subadmin_id')."");

        // print_r($data['getAllStatus']);die;
    	$this->loadSubAdminView('subadmin/trip/list',$data); 
    }
    

    public function trip_add()
    {
        // echo "string";
        $data['title'] = 'Add Trip';

        $where = array(
            "is_delete"         =>  0,
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        $data['getAllBus'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'bus','bus.id');

        $client_user = $this->session->userdata('ses_subadmin_id');
        $today_date = date('Y-m-d');

        $data['getAllBus'] = $this->CommonModel->busTripData($client_user,$today_date);

        $data['getAllDriver'] = $this->CommonModel->driverTripData($client_user,$today_date);

        $data['getAllChaperone'] = $this->CommonModel->chaperoneTripData($client_user,$today_date);

        // $data['getAllChild'] = $this->CommonModel->childTripData($client_user,$today_date);

        // $data['getAllParent'] = $this->CommonModel->parentsData($client_user);
// print_r($data['getAllChild']);die;
        $this->loadSubAdminView('subadmin/trip/add',$data); 

    }
    
     public function addTripAjax()
    {

        $today_date = $this->input->post('date');
        $client_user = $this->session->userdata('ses_subadmin_id');
        // $today_date = date('Y-m-d');

        $data['getAllBus'] = $this->CommonModel->busTripData($client_user,$today_date);

        $data['getAllDriver'] = $this->CommonModel->driverTripData($client_user,$today_date);

        $data['getAllChaperone'] = $this->CommonModel->chaperoneTripData($client_user,$today_date);

        // $data['getAllChild'] = $this->CommonModel->childTripData($client_user,$today_date);

        // $data['getAllParent'] = $this->CommonModel->parentsData($client_user);

        $this->load->view('subadmin/trip/addTripAjax',$data); 
    }
    
    public function getParentName()
    {
        $condition  = array("id" => $this->input->post('child_id'));

        $childData = $this->CommonModel->selectRowDataByCondition($condition,'child');
        // print_r($childData);die;

        $where  = array("id" => $childData->parents_id);
        $parentData = $this->CommonModel->selectRowDataByCondition($where,'parents');

        // print_r($parentData);die;

        if (!empty($parentData)) {
            
            $arr = array(
                'parents_id'    => $parentData->id,
                'parents_name'  => $parentData->parents_name,
            );

            echo json_encode($arr);
        }else{
            echo "0";
        }

    }

    public function trip_insert()
    {
        // print_r($_POST);die;

        // $busdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('trip')->row('id');

        // $count_data= $busdata_max+1;//autoincrement

        // $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
        // $trip_code = 'Trip'.$rand; 


        $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "bus_id"                =>  $this->input->post('bus_id'),
                    "driver_id"             =>  $this->input->post('driver_id'),
                    "chaperone_id"          =>  $this->input->post('chaperone_id'),
                    "trip_id"               =>  $this->input->post('trip_id'),
                    "trip_date"             =>  $this->input->post('trip_date'),
                    "trip_start"            =>  $this->input->post('trip_start'),
                    "trip_end"              =>  $this->input->post('trip_end'),
                    "complete_status"       =>  0,
                    "status"                =>  2,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'trip');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('trip_add_successfully'));
            redirect('subadmin/trip_list'); 
            // redirect('subadmin/chaperone_add'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('trip_not_add_successfully'));
             redirect('subadmin/trip_list'); 
            
        }
    }


    public function view_trip()
    {

        $trip_id = $this->uri->segment(3);
        $data['title'] = $this->lang->line('view_trip');

        $client_user = $this->session->userdata('ses_subadmin_id');

        $data['getAllParent'] = $this->CommonModel->tripParentsList($trip_id);
// print_r($trip_id);die;
        $condition = array(
                'id' => $this->uri->segment(3)
        );
        $data['tripDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'trip');

         $data['tripDetail'] = $this->CommonModel->tripDetail($client_user);

        // print_r($data['getAllParent']);die;
        $this->loadSubAdminView('subadmin/trip/view_trip',$data); 
    }

    public function trip_add_parents()
    {
        // print_r($this->uri->segment(4));die;
        $data['title'] = $this->lang->line('add_parent_trip');
        $today_date = date('Y-m-d');
        $client_user = $this->session->userdata('ses_subadmin_id');

        $condition = array(
                'id' => $this->uri->segment(4)
        );
        $data['tripDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'trip');

        $data['getAllParent'] = $this->CommonModel->parentTripData($client_user,$today_date);
// print_r( $data['getAllParent']);die;
        $this->loadSubAdminView('subadmin/trip/add_parents_trip',$data);
    }

    public function insert_trip_parents()
    {
        // echo "string";die;
        // print_r($_POST);die;

        $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "trip_id"               =>  $this->input->post('trip_id'),
                    "parents_id"            =>  $this->input->post('parents_id'),
                    "note"                  =>  $this->input->post('note'),
                    "trip_date"             =>  $this->input->post('trip_date'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'trip_add_parents');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('trip_parents_add_successfully'));
            redirect('subadmin/trip_view/'.$this->input->post('trip_id')); 
            // redirect('subadmin/chaperone_add'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('trip_parents_not_add_successfully'));
             redirect('subadmin/trip/add_parents/'.$this->input->post('trip_id')); 
            
        }
    }


    public function delete_trip_parents()
    {
        $val = explode(',',($this->input->post('trip_add_parents_id')));

        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $value),'trip_add_parents');

            if($busData)
            {
                $updateData = $this->CommonModel->delete($where,'trip_add_parents'); 
            }
            else{
                $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                redirect('subadmin/trip_view/'.$value);
            }
        }

        if($updateData)
        {
            $this->session->set_flashdata('success',$this->lang->line('trip_parents_delete_successfully'));
            redirect('subadmin/trip_view/'.$value);
        }else{
            $this->session->set_flashdata('error',$this->lang->line('trip_parents_not_delete_successfully'));
           redirect('subadmin/trip_view/'.$value);
        }
           
    }

     public function editTripParents()
    {
        $ids = $this->input->post('trip_add_parents_id');
        // print_r($ids);die;

        redirect('subadmin/trip/edit_parents/'.$ids);
    }

    public function trip_edit_parents()
    {
        echo "string";
    }

    public function exportTripParentsCSV()
    {
        $ids = $this->input->post('trip_add_parents_id');
        //get data 
        $usersData = $this->PdfModel->getTripParentsCsv($ids);

        // print_r($usersData);die;

        $filename = 'tripParents-'.time().'.csv';  

        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
     
        // file creation 
        $file = fopen('php://output', 'w');
     
       // $header = array("Bus Number","Plate Number","Note","Modify"); 
        $header = array("Parent Name","Parent Mobile Numbe","Note"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
    }

    public function import_trip_parents()
    {
        // echo "string";die;
        $file_data = $this->csvimport->get_array($_FILES["file"]["tmp_name"]);
        print_r($file_data);die;


        foreach($file_data as $row)
        {

            $parents_name    =   $row["Parent Name"];
            $parents_mobile  =   $row["Parent Mobile Numbe"];
            // $assign_bus     =   $row["Client Name"];
            $parents_note    =   $row["Note"];

            $driverdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('driver')->row('id');
            $count_data= $driverdata_max+1;//autoincrement

            $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
            $driver_code = 'Driver'.$rand; 


            $where = array('phone_number'=>$parent_mobile);
            $parentsDetail = $this->CommonModel->getsingle('parents',$where);

            if(!empty($driverDetail))
            {
                $condition = array('id'=>$driverDetail->id);

                $data = array(
                    "driver_name"           =>  $driver_name,
                    "drive_mobile_number"   =>  $driver_mobile,
                    "note"                  =>  $driver_note,
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $set = $this->CommonModel->updateRowByCondition($condition,'driver',$data);  

            }else{                    
                $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "driver_unique_id"      =>  $driver_code,
                    "driver_name"           =>  $driver_name,
                    "drive_mobile_number"   =>  $driver_mobile,
                    "note"                  =>  $driver_note,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $set = $this->CommonModel->insertData($data,'driver');  
            }
        }

        if($set)
        {
            echo "1";
        }else{
            echo "0";
        }
    }
}
