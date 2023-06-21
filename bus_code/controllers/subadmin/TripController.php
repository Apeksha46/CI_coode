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
        $data['title'] = "Trips";

        $client_user = $this->session->userdata('ses_subadmin_id');

        // $data['getAllStatus'] = $this->CommonModel->tripUserList($client_user);
        $data['getAllStatus'] = $this->CommonModel->tripListClient($client_user);
// print_r($data['getAllStatus'] );die;
        $data['trip_count'] = $this->CommonModel->select_single_row("Select count(*) as total from trip where client_user_id =".$this->session->userdata('ses_subadmin_id')."");

    	$this->loadSubAdminView('subadmin/trip/list',$data); 
    }
    
    public function check_tripId()
    {
        $condition = array(
            "trip_id" => $this->input->post('trip_id'),
            //  "is_delete" => 0
        );
        $busData = $this->CommonModel->selectRowDataByCondition($condition,'trip');
        if ($busData) {
            echo "1";
        }else{
            echo "0";
        }
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
        
        $data['getAllBus'] = $this->CommonModel->busTripData($client_user);

        $data['getAllDriver'] = $this->CommonModel->driverTripData($client_user);

        $data['getAllChaperone'] = $this->CommonModel->chaperoneTripData($client_user);
        
        // $data['getAllBus'] = $this->CommonModel->busTripData($client_user,$today_date);

        // $data['getAllDriver'] = $this->CommonModel->driverTripData($client_user,$today_date);

        // $data['getAllChaperone'] = $this->CommonModel->chaperoneTripData($client_user,$today_date);

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
        
         $data['getAllBus'] = $this->CommonModel->busTripData($client_user);

        $data['getAllDriver'] = $this->CommonModel->driverTripData($client_user);

        $data['getAllChaperone'] = $this->CommonModel->chaperoneTripData($client_user);
        
        
        // $data['getAllBus'] = $this->CommonModel->busTripData($client_user,$today_date);

        // $data['getAllDriver'] = $this->CommonModel->driverTripData($client_user,$today_date);

        // $data['getAllChaperone'] = $this->CommonModel->chaperoneTripData($client_user,$today_date);

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

        $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "bus_id"                =>  $this->input->post('bus_id'),
                    "driver_id"             =>  $this->input->post('driver_id'),
                    "chaperone_id"          =>  $this->input->post('chaperone_id'),
                    "trip_id"               =>  $this->input->post('trip_id'),
                    "trip_date"             =>  $this->input->post('trip_date'),
                    "trip_start"            =>  $this->input->post('trip_start'),
                    "trip_end"              =>  $this->input->post('trip_end'),
                    "note"                  =>  $this->input->post('note'),
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
        // $today_date = date('Y-m-d');
        $client_user = $this->session->userdata('ses_subadmin_id');

        $condition = array(
                'id' => $this->uri->segment(4)
        );
        $data['tripDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'trip');
        
        $today_date = $data['tripDetail']->trip_date;
        
        // $data['getAllParent'] = $this->CommonModel->parentTripData($client_user,$today_date);
        $data['getAllParent'] = $this->CommonModel->parentTripData($client_user);
// print_r( $data['getAllParent']);die;
        $this->loadSubAdminView('subadmin/trip/add_parents_trip',$data);
    }

    public function insert_trip_parentsOld()
    {
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
    
    public function insert_trip_parents()
    {
        // print_r($_POST);die;
        // echo "<br>";
        $ses_subadmin_id    =   $this->session->userdata('ses_subadmin_id');
        $trip_id            =   $this->input->post('trip_id');
        $parents_id         =   $this->input->post('parents_id');
        $note               =   $this->input->post('note');
        // $trip_date          =   $this->input->post('trip_date');
        $trip_parents_status  =   $this->input->post('trip_status');

        if(!empty($trip_id))
        {
            foreach ($parents_id as $key => $value) 
            {
                $where = array(
                        'parents_id'     => $value,
                        'trip_id'        => $trip_id,
                        'client_user_id' => $this->session->userdata('ses_subadmin_id')
                    );
                $checkParents = $this->CommonModel->getsingle('trip_add_parents',$where);
                // print_r($checkParents);
                if(empty($checkParents))
                {
                    $data = array (
                         "client_user_id"        =>  $ses_subadmin_id,
                        "trip_id"               =>  $trip_id,
                        "parents_id"            =>  $value,
                        "note"                  =>  $note[$key],
                        // "trip_date"             =>  $trip_date,
                        "trip_parents_status"   =>  $trip_parents_status,
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
                     $set = $this->CommonModel->insertData($data,'trip_add_parents');
                }else{
                     $condition = array('id'=>$checkParents->id);
    
                   $data = array (
                         "client_user_id"        =>  $ses_subadmin_id,
                        "trip_id"               =>  $trip_id,
                        "parents_id"            =>  $value,
                        "note"                  =>  $note[$key],
                        // "trip_date"             =>  $trip_date,
                        "trip_parents_status"   =>  $trip_parents_status,
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
    
                    $set = $this->CommonModel->updateRowByCondition($condition,'trip_add_parents',$data);
                }
                // $data = array(
                //     array(
                //         "client_user_id"        =>  $ses_subadmin_id,
                //         "trip_id"               =>  $trip_id,
                //         "parents_id"            =>  $value,
                //         "note"                  =>  $note[$key],
                //         // "trip_date"             =>  $trip_date,
                //         "trip_parents_status"   =>  $trip_parents_status,
                //         "created_at"            =>  date('Y-m-d H:i:s a'),
                //         "updated_at"            =>  date('Y-m-d H:i:s a'),
                //     )
                // );
                 // print_r($data);
                // $insertData =$this->db->insert_batch('trip_add_parents',$data);
            }
            //  die;
             
            if ($set) 
            {
                $this->session->set_flashdata('success',$this->lang->line('trip_parents_add_successfully'));
                redirect('subadmin/trip_view/'.$this->input->post('trip_id')); 
                // redirect('subadmin/chaperone_add'); 
            }else{

                $this->session->set_flashdata('error',$this->lang->line('trip_parents_not_add_successfully'));
                 redirect('subadmin/trip/add_parents/'.$this->input->post('trip_id')); 
                
            }


        }
    }


    public function delete_trip_parentsOld()
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
            redirect('subadmin/trip_view/'.$busData->trip_id);
        }else{
            $this->session->set_flashdata('error',$this->lang->line('trip_parents_not_delete_successfully'));
           redirect('subadmin/trip_view/'.$busData->trip_id);
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
        // echo "string";
        $data['title'] = $this->lang->line('edit_parent_trip');
        // $today_date = date('Y-m-d');
        $client_user = $this->session->userdata('ses_subadmin_id');

        $trip_add_parents_id = $this->uri->segment(4);

        $data['trip_add_parents'] = $this->CommonModel->tripAddParentsDetail($trip_add_parents_id);
        
        $today_date = $data['trip_add_parents']->trip_date;
        
        // $data['getAllParent'] = $this->CommonModel->parentTripData($client_user,$today_date);
                $data['getAllParent'] = $this->CommonModel->parentTripEditData($client_user);
        $this->loadSubAdminView('subadmin/trip/edit_parents_trip',$data);

    }

    public function update_trip_parents()
    {
        // print_r($_POST);
        // die;

        $condition = array(
            'id' => $this->input->post('trip_add_parents_id') 
        );
         $data = array(
                    // "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    // "trip_id"               =>  $this->input->post('trip_id'),
                    "parents_id"            =>  $this->input->post('parents_id'),
                    "note"                  =>  $this->input->post('note'),
                    // "trip_date"             =>  $this->input->post('trip_date'),
                    "trip_parents_status"   =>  $this->input->post('trip_status'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->updateRowByCondition($condition,'trip_add_parents',$data);  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('trip_parents_edit_successfully'));
            redirect('subadmin/trip_view/'.$this->input->post('trip_id')); 
            // redirect('subadmin/chaperone_add'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('trip_parents_not_edit_successfully'));
             redirect('subadmin/trip/edit_parents_trip/'.$this->input->post('trip_add_parents_id')); 
            
        }
    }
    public function exportTripParentsCSVOld()
    {
        $ids = $this->input->post('trip_add_parents_id');
        //get data 
        $usersData = $this->PdfModel->getTripParentsCsv($ids);
        // $filename = 'tripParents-'.time().'.xlsx';  
        $filename = 'tripParents-'.time().'.xls';  

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
    
    public function exportTripParentsCSV()
    {
        // $fileName = 'tripParents-'.time().'.xlsx';  
         $fileName = 'tripParents-'.time().'.xls';    

         $ids = $this->input->post('trip_add_parents_id');

        $this->load->library('excel');

        // $empInfo = $this->PdfModel->getBusExcel($ids);
        $empInfo = $this->PdfModel->getTripParentsExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('s_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('parents_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $this->lang->line('parent_number'));
         $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('modify'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('note'));    
        // set Row
        $rowCount = 2;
         $i = 1;
        foreach ($empInfo as $element) 
        {
            $date = date("d/m/Y", strtotime($element['updated_at']));

            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['parents_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['phone_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount,$date);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['note']);
            $rowCount++;
            $i++;
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Cutomer_Report.xls"');
        header('Content-Disposition: attachment;filename="'. $fileName .'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

    }
    
    public function import_trip_parents()
    {
        // print_r($_POST);die;
        // echo "string";die;
        $path = $_FILES["file"]["tmp_name"];
        // print_r($path);die;
        $object = PHPExcel_IOFactory::load($path);
        // print_r($object);die;
        foreach($object->getWorksheetIterator() as $worksheet)
        {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
    
            for($row=2; $row<=$highestRow; $row++)
            {
                $parents_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('parents')->row('id');
    
                $count_data= $parents_max+1;//autoincrement
    
                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $parents_code = 'Parent'.$rand; 
    
                $parent_name     =   $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $parent_mobile   =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                // $assign_bus         =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $parent_note     =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                // $secret_code        =   $worksheet->getCellByColumnAndRow(5, $row)->getValue();
    
                // print_r($chaperone_name);
                // print_r($chaperone_mobile);
                // print_r($assign_bus);
                // print_r($chaperone_note);
                // print_r($secret_code);
                // echo "<br>";
                 $parents_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('parents')->row('id');
    
                $count_data= $parents_max+1;//autoincrement
    
                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $parents_code = 'Parent'.$rand; 
    
                $where = array(
                    'phone_number'=>$parent_mobile,
                    'client_user_id' => $this->session->userdata('ses_subadmin_id')
                );
                $parentsDetail = $this->CommonModel->getsingle('parents',$where);
    
                if(!empty($parentsDetail))
                {
                    $parent_id = $parentsDetail->id;
                    
                }else{                   
                     $data = array(
                        "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                        "parents_unique_id"     =>  $parents_code,
                        "parents_name"          =>  $parent_name,
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
    
                    $parentInsert = $this->CommonModel->insertData($data,'parents'); 
                    $parent_id = $this->db->insert_id(); 
                }
    
                $where = array(
                    'parents_id'=>$parent_id,
                    'client_user_id' => $this->session->userdata('ses_subadmin_id')
                );
                
                $parentsTripDetail = $this->CommonModel->getsingle('trip_add_parents',$where);
    
                if(!empty($parentsTripDetail))
                {
                    // echo "hi";die;
                    // $condition = array('id'=>$parentsTripDetail->id);
    
                    // $data = array(
                    //     "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    //     "trip_id"               =>  $this->input->post('trip_id'),
                    //     "note"                  =>  $parent_note,
                    //     "parents_id"            =>  $parent_id,
                    //     "updated_at"            =>  date('Y-m-d H:i:s a'),
                    // );
    
                    // $set = $this->CommonModel->updateRowByCondition($condition,'trip_add_parents',$data); 
                    $tripId = $parentsTripDetail->trip_id;
                    $parentsId = $parent_id;

                    // $plateNumberString[] = $bus_plate_numb->er;
                    // $plateNumber = implode(",", $plateNumberString);

                    $notetring[] = $parent_note;
                    $busNote = implode(",", $notetring);

                    // $busNumbertring[] = $parentsTripDetail->parents_id;
                    // $parentsId = implode(",", $parent_id);

                    $comma_string[] = $parentsTripDetail->id;
                    $arr = implode(",", $comma_string);
                    // print_r($arr);

                    $set = $arr;

    
                }else{                   
                    // echo "hiood";die;
                    $data = array(
                        "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                        "trip_id"               =>  $this->input->post('trip_id'),
                        "note"                  =>  $parent_note,
                        "parents_id"            =>  $parent_id,
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
    
                    $set = $this->CommonModel->insertData($data,'trip_add_parents');  
                }
            }
            // die;
            if($set)
            {
                //echo "1";
                if (!empty($arr)) 
                {
                    $id = $arr;
                    $countParentsTrip = $this->CommonModel->countDuplicateTripsParents($id);
                    // print_r($countBus->busTotal);die;

                    $data = array(
                        'count'         =>  $countParentsTrip->parentsTripTotal,
                        'id'            =>  $arr,
                        // 'newData'       =>  $newData,
                        'tripId'    =>  $tripId,
                        'note'          =>  $busNote,
                        'parentsId'   =>  $parentsId,
                    );

                    echo json_encode($data);
                }else{
                    // echo "0";
                    echo "1";
                }
            }else{
                echo "0";
            }
    }   
}
    public function replaceDeuplicateData()
    {
        // print_r($_POST);
        $trip_Id = $this->input->post('bus_number');
        $id = explode(',',($this->input->post('id'))); 
        $tipId = explode(',',($this->input->post('bus_number'))); 
        $note       = explode(',',($this->input->post('note'))); 
        $parentsId = explode(',',($this->input->post('plateNumber'))); 
        
         foreach ($id as $key => $v) 
        {
            // print_r($v);
            $where = array('id'=>$v);
            $updateData = $this->CommonModel->delete($where,'trip_add_parents'); 
        }
        // die;

        for ($i=0; $i < count($parentsId); $i++) 
        { 
            $data = array(
                "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                "trip_id"               =>  $tipId[$i],
                "note"                  =>  $note[$i],
                "parents_id"            =>  $parentsId[$i],
                "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

            $set = $this->CommonModel->insertData($data,'trip_add_parents');
        }
       
        
        if ($set) 
        {
            $this->session->set_flashdata('success',$this->lang->line('trip_parents_edit_successfully'));
            redirect('subadmin/trip_view/'.$trip_Id); 
            // redirect('subadmin/chaperone_add'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('trip_parents_not_edit_successfully'));
             redirect('subadmin/trip/edit_parents_trip/'.$trip_Id); 
            
        }
    }
    
    public function import_trip_parentsOld()
    {
        // echo "string";die;
        $file_data = $this->csvimport->get_array($_FILES["file"]["tmp_name"]);
        foreach($file_data as $row)
        {
            $parent_name     =    $row["Parents Name"];
            $parent_mobile   =    $row["Mobile Numbe"];
            $parent_note     =    $row["Note"];
            $secret_code     =    $row["Security Code"];

            $parents_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('parents')->row('id');

            $count_data= $parents_max+1;//autoincrement

            $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
            $parents_code = 'Parent'.$rand; 


            $where = array('phone_number'=>$parent_mobile);
            $parentsDetail = $this->CommonModel->getsingle('parents',$where);

            if(!empty($parentsDetail))
            {
                $parent_id = $parentsDetail->id;
                
            }else{                   
                 $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "parents_unique_id"     =>  $parents_code,
                    "parents_name"          =>  $parent_name,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $parentInsert = $this->CommonModel->insertData($data,'parents'); 
                $parent_id = $this->db->insert_id(); 
            }

            $where = array('parents_id'=>$parent_id);
            $parentsTripDetail = $this->CommonModel->getsingle('trip_add_parents',$where);

            if(!empty($parentsTripDetail))
            {
                $condition = array('id'=>$parentsTripDetail->id);

                $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "trip_id"               =>  $this->input->post('trip_id'),
                    "note"                  =>  $parent_note,
                    "parents_id"            =>  $parent_id,
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $set = $this->CommonModel->updateRowByCondition($condition,'trip_add_parents',$data);  

            }else{                   

                $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "trip_id"               =>  $this->input->post('trip_id'),
                    "note"                  =>  $parent_note,
                    "parents_id"            =>  $parent_id,
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $set = $this->CommonModel->insertData($data,'trip_add_parents');  
            }
        }

        if($set)
        {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function import_parents_trip_view()
    {
        // $data['title'] = $this->lang->line('import_parents_trip_view');
        // $this->loadSubAdminView('subadmin/trip/import_parents_trip_view',$data);
        
        $data['title'] = $this->lang->line('import_parents_trip_view');
        $tripId = $this->uri->segment(3);

        // $data['getAllStatus'] = $this->CommonModel->tripUserList($client_user);
        $data['tripDetail'] = $this->CommonModel->tripEditDetail($tripId);
        // print_r($data['tripDetail']);die;
        $this->loadSubAdminView('subadmin/trip/import_parents_trip_view',$data); 
    }

    public function donwload_parents_import($fileName = NULL)
    {
        $this->load->helper('download');
        // $fileName = "parent.csv";
        // $fileName = "parent.xlsx";
        // $fileName = "parent.xls";
        $fileName = "trip_parents.xls";
        if ($fileName) 
        {
            $file = realpath ("download" ) . "/" . $fileName;
            // check file exists    
            if (file_exists ( $file )) 
            {
                // get file content
                $data = file_get_contents ( $file );
                //force download
                force_download ($fileName, $data );
            } else {
                redirect ( base_url () );
            }
        }
    }
    
    public function donwload_parentsTrip_import($fileName = NULL)
    {
        $this->load->helper('download');
        // $fileName = "parent.csv";
        // $fileName = "parent.xlsx";
        // $fileName = "parent.xls";
        $fileName = "trip_parents.xls";
        if ($fileName) 
        {
            $file = realpath ("download" ) . "/" . $fileName;
            // check file exists    
            if (file_exists ( $file )) 
            {
                // get file content
                $data = file_get_contents ( $file );
                //force download
                force_download ($fileName, $data );
            } else {
                redirect ( base_url () );
            }
        }
    }

    public function delete_trip()
    {
         $val = explode(',',($this->input->post('tripId')));
// print_r($val);die;
        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $value),'trip_add_parents');

            if($busData)
            {
                $condition = array('trip_id'=>$value);
                $updateDaata = $this->CommonModel->delete($where,'trip'); 
                $updaData = $this->CommonModel->delete($condition,'trip_add_parents'); 
            }
            else
            {
                $condition = array('trip_id'=>$value);
                $updateDaata = $this->CommonModel->delete($where,'trip'); 
                
                // $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                // redirect('subadmin/trip_view/'.$value);
            }
        }

        if($updateDaata)
        {
            $this->session->set_flashdata('success','Trip delete Successfully');
            redirect('subadmin/trip_list');
        }else{
            $this->session->set_flashdata('error','Trip delete Successfully');
           redirect('subadmin/trip_list');
        }

    }

    public function exportTripCSVOld()
    {
        // print_r($_POST);die;
        $ids = $this->input->post('tripId');
        //get data 
        $usersData = $this->PdfModel->getTripCsv($ids);

        // $filename = 'trip-'.time().'.csv';  
        // $filename = 'trip-'.time().'.xlsx';  
        $filename = 'trip-'.time().'.xls';  

        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
     
        // file creation 
        $file = fopen('php://output', 'w');

        $header = array("Bus Number","Chaperone Name","Driver Name","Trip Date","Trip Start","Trip End","Note"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
    }
    
    public function exportTripCSV()
    {
        // $fileName = 'trip-'.time().'.xlsx';  
        $fileName = 'trip-'.time().'.xls';  

        // $ids = $this->input->post('busId');

        $this->load->library('excel');

        // $empInfo = $this->PdfModel->getBusExcel($ids);
        
        $ids = $this->input->post('tripId');
        //get data 
        $empInfo = $this->PdfModel->getTripExcel($ids);
        
        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('trip_id'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $this->lang->line('bus_id'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('driver_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('chaperone'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('estimated_start_time'));
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', $this->lang->line('estimated_end_time'));
         $objPHPExcel->getActiveSheet()->SetCellValue('G1', $this->lang->line('modify'));  
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', $this->lang->line('note'));
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', $this->lang->line('parent'));    
        // set Row
        $rowCount = 2;
         $i = 1;
        foreach ($empInfo as $element) 
        {
            $parent_count = $this->CommonModel->select_single_row("Select count(*) as total from trip_add_parents where trip_id =".$element['tripId']."");

            if(empty($parent_count->total)){
                $parentCount = 0;
            }else{
                $parentCount = $parent_count->total;
            }
              
            $date = date("d/m/Y", strtotime($element['updated_at']));

            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['trip_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['bus_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['driver_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['chaperone_name']);
            
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['trip_start']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['trip_end']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount,$date);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['note']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount,$parentCount);
           
            $rowCount++;
            $i++;
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Cutomer_Report.xls"');
        header('Content-Disposition: attachment;filename="'. $fileName .'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

    }
    public function editTrip()
    {
        $ids = $this->input->post('tripId');

        redirect('subadmin/edit_trip/'.$ids);
    }

    public function edit_trip()
    {
        // echo "stringdsfd";die;
        $data['title'] = 'Edit Trip';

        $where = array(
            "is_delete"         =>  0,
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        $data['getAllBus'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'bus','bus.id');

        $client_user = $this->session->userdata('ses_subadmin_id');
        // $today_date = date('Y-m-d');
        $today_date = "";
        // $data['getAllBus'] = $this->CommonModel->busTripData($client_user,$today_date);

        // $data['getAllDriver'] = $this->CommonModel->driverTripData($client_user,$today_date);

        // $data['getAllChaperone'] = $this->CommonModel->chaperoneTripData($client_user,$today_date);
        
        // $data['getAllBus'] = $this->CommonModel->busTripData($client_user);

        // $data['getAllDriver'] = $this->CommonModel->driverTripData($client_user);

        // $data['getAllChaperone'] = $this->CommonModel->chaperoneTripData($client_user);
        
        $client_user = $this->session->userdata('ses_subadmin_id');
        $tripId = $this->uri->segment(3);
        
        
        $data['getAllBus'] = $this->CommonModel->busTripEditData($client_user,$tripId);

        $data['getAllDriver'] = $this->CommonModel->driverTripEditData($client_user,$tripId);

        $data['getAllChaperone'] = $this->CommonModel->chaperoneTripEditData($client_user,$tripId);
        
        // $data['getAllStatus'] = $this->CommonModel->tripUserList($client_user);
        $data['tripDetail'] = $this->CommonModel->tripEditDetail($tripId);
// print_r($tripId);die;
// print_r($data['tripDetail']);die;

        $this->loadSubAdminView('subadmin/trip/edit',$data); 
    }

    public function trip_update()
    {

            $condition = array(
                'id' =>  $this->input->post('tripId')
            );
          $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "bus_id"                =>  $this->input->post('bus_id'),
                    "driver_id"             =>  $this->input->post('driver_id'),
                    "chaperone_id"          =>  $this->input->post('chaperone_id'),
                    "trip_id"               =>  $this->input->post('trip_id'),
                    // "trip_date"             =>  $this->input->post('trip_date'),
                    "trip_start"            =>  $this->input->post('trip_start'),
                    "trip_end"              =>  $this->input->post('trip_end'),
                    "note"                  =>  $this->input->post('note'),
                    "complete_status"       =>  0,
                    "status"                =>  2,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->updateRowByCondition($condition,'trip',$data);  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('trip_update_successfully'));
            redirect('subadmin/trip_list'); 
            // redirect('subadmin/chaperone_add'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('trip_not_update_successfully'));
             redirect('subadmin/edit_trip/'.$this->input->post('tripId')); 
            
        }
    }
    
     public function import_trip_view()
    {
        // $data['title'] = $this->lang->line('import_parents_trip_view');
        // $this->loadSubAdminView('subadmin/trip/import_parents_trip_view',$data);
        
        $data['title'] = $this->lang->line('import_trip_view');
        $tripId = $this->uri->segment(3);

        // $data['getAllStatus'] = $this->CommonModel->tripUserList($client_user);
        $data['tripDetail'] = $this->CommonModel->tripEditDetail($tripId);
        // print_r($data['tripDetail']);die;
        $this->loadSubAdminView('subadmin/trip/import_trip_view',$data); 
    }

    public function import_trip()
    {
        // print_r($_POST);die;
        // echo "string";die;
        $path = $_FILES["file"]["tmp_name"];
        // print_r($path);die;
        $object = PHPExcel_IOFactory::load($path);
        // print_r($object);die;
        foreach($object->getWorksheetIterator() as $worksheet)
        {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
    
            for($row=2; $row<=$highestRow; $row++)
            {
    
                $trip_id          =   $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $bus_id           =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $driver_name      =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $chaperone_name   =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $note             =   $worksheet->getCellByColumnAndRow(6, $row)->getValue();
    
                // $start_time = PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME1($startTime->getCalculatedValue(), 'h:i a');

                //This way create a formatted string directly
                $startTime = $worksheet->getCellByColumnAndRow(4, $row)->getValue(); 
                $start_time = PHPExcel_Style_NumberFormat::toFormattedString($startTime, "h:mm a");

                $endTime = $worksheet->getCellByColumnAndRow(5, $row)->getValue(); 
                $end_time = PHPExcel_Style_NumberFormat::toFormattedString($endTime, "h:mm a");

                // print_r($chaperone_name);
                // print_r($chaperone_mobile);
                // print_r($assign_bus);
                // print_r($start_time);
                // print_r($end_time);
                // echo "<br>";

            //------------check bus----------------------   

                $busdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('bus')->row('id');

                $count_data= $busdata_max+1;//autoincrement

                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $bus_code = 'BUS'.$rand;

                  $busdata = array(
                        "bus_number"            =>  $bus_id,
                        "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                        "bus_unique_id"         =>  $bus_code,
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
                  
                $busInsert = $this->CommonModel->insertData($busdata,'bus');  
                $busId = $this->db->insert_id(); 

            //------------check driver---------------------- 
                $driverdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('driver')->row('id');

                $count_data= $driverdata_max+1;//autoincrement

                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $driver_code = 'Driver'.$rand; 

                $driverdata = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "driver_unique_id"      =>  $driver_code,
                    "driver_name"           =>  $driver_name,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $driverInsert = $this->CommonModel->insertData($driverdata,'driver');  
                $driver_id = $this->db->insert_id(); 

            //------------check chaperone----------------------    
                $chaperone_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('chaperone')->row('id');

                $count_data= $chaperone_max+1;//autoincrement

                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $chaperone_code = 'Chaperone'.$rand; 

                 $chapeonedata = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "chaperone_unique_id"   =>  $chaperone_code,
                    "chaperone_name"        =>  $chaperone_name,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );
 
                $chapeoneData = $this->CommonModel->insertData($chapeonedata,'chaperone');     
                $chaperone_id = $this->db->insert_id(); 

                $where = array(
                    'trip_id'=>$trip_id,
                    'client_user_id' => $this->session->userdata('ses_subadmin_id')
                );
                
                $tripDetail = $this->CommonModel->getsingle('trip',$where);
    
                if(!empty($tripDetail))
                {
                    $notetring[] = $start_time;
                    $start = implode(",", $notetring);

                    $busNumbertring[] = $end_time;
                    $end = implode(",", $busNumbertring);
                    
                     $noteString[] = $note;
                    $Note = implode(",", $noteString);
                    
                    // $busId = $busId;
                    // $driver_id = $driver_id;
                    // $chaperone_id = $chaperone_id;
                    // $parentsId = $parent_id;
                    $bus_Id = $busId;
                    $driverId = $driver_id;
                    $chaperoneId = $chaperone_id;
                    $tripId = $tripDetail->trip_id;

                    $comma_string[] = $tripDetail->id;
                    $arr = implode(",", $comma_string);
                    // print_r($arr);

                    $set = $arr;  
    
                }else{      

                     $data = array(
                            "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                            "bus_id"                =>  $busId,
                            "driver_id"             =>  $driver_id,
                            "chaperone_id"          =>  $chaperone_id,
                            "trip_id"               =>  $trip_id,
                            // "trip_date"             =>  $this->input->post('trip_date'),
                            "trip_start"            =>  $start_time,
                            "trip_end"              =>  $end_time,
                            "note"                  =>  $note,
                            "complete_status"       =>  0,
                            "status"                =>  2,
                            "created_at"            =>  date('Y-m-d H:i:s a'),
                            "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );

                    $set = $this->CommonModel->insertData($data,'trip');
                }
               
            }
            // die;
            if($set)
            {
                // echo "1";
                if (!empty($arr)) 
                {
                    $id = $arr;
                    $countTrip = $this->CommonModel->countDuplicateTrips($id);
                    // print_r($countBus->busTotal);die;

                    $data = array(
                        'count'         =>  $countTrip->tripTotal,
                        'id'            =>  $arr,
                        // 'newData'       =>  $newData,
                        'busId'    =>  $bus_Id,
                        'driver_id'          =>  $driverId,
                        'start'   =>  $start,
                        'end'   =>  $end,
                        'chaperone_id'   =>  $chaperoneId,
                        'tripId'   =>  $tripId,
                        'note'   =>  $Note,
                    );
                    echo json_encode($data);
                }else{
                    // echo "0";
                    echo "1";
                }
            }else{
                echo "0";
            }
        }
    } 

     public function replaceTripDeuplicateData()
    {
        // print_r($_POST);
    // $busId =$this->input->post('busId');
    
        $id = explode(',',($this->input->post('id'))); 
        $busId = explode(',',($this->input->post('busId'))); 
        $driver_id       = explode(',',($this->input->post('driver_id'))); 
        $start = explode(',',($this->input->post('start'))); 
        $end = explode(',',($this->input->post('end'))); 
        $chaperone_id = explode(',',($this->input->post('chaperone_id'))); 
        $tripId = explode(',',($this->input->post('tripId'))); 
        $note = explode(',',($this->input->post('note'))); 

        // print_r($busNumber);

        foreach ($id as $key => $v) 
        {
            // print_r($v);
            $where = array('id'=>$v);
            $updateData = $this->CommonModel->delete($where,'trip'); 
        }
        // die;

        for ($i=0; $i < count($start); $i++) 
        {
              $data = array(
                            "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                            "bus_id"                =>  $busId[$i],
                            "driver_id"             =>  $driver_id[$i],
                            "chaperone_id"          =>  $chaperone_id[$i],
                            "trip_id"               =>  $tripId[$i],
                            // "trip_date"             =>  $this->input->post('trip_date'),
                            "trip_start"            =>  $start[$i],
                            "trip_end"              =>  $end[$i],
                            "note"                  =>  $note[$i],
                            "complete_status"       =>  0,
                            "status"                =>  2,
                            "created_at"            =>  date('Y-m-d H:i:s a'),
                            "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
//  print_r($data);
                    $set = $this->CommonModel->insertData($data,'trip'); 
            
        }
        
    //   die;
        
        if ($set) 
        {
            $this->session->set_flashdata('success',$this->lang->line('trip_update_successfully'));
            redirect('subadmin/trip_list'); 
            // redirect('subadmin/chaperone_add'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('trip_not_update_successfully'));
             redirect('subadmin/import_trip_view'); 
            
        }

        
    }
    

    public function donwload_trip_import($fileName = NULL)
    {
        $this->load->helper('download');
        // $fileName = "trip.csv";
        // $fileName = "trip.xlsx";
        $fileName = "trip.xls";
        if ($fileName) 
        {
            $file = realpath ("download" ) . "/" . $fileName;
            // check file exists    
            if (file_exists ( $file )) 
            {
                // get file content
                $data = file_get_contents ( $file );
                //force download
                force_download ($fileName, $data );
            } else {
                redirect ( base_url () );
            }
        }
    }
}
