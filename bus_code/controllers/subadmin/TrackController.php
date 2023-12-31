<?php
error_reporting(0);
    defined('BASEPATH') OR exit('No direct script access allowed');

    class TrackController extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->common->check_subadminlogin();
        // $this->load->library('excel');
        // $this->load->library('pdf');
    }

    public function status_list()
    {   
        // echo "string";die;
        $data['title'] = $this->lang->line('status');

        // $client_user = $this->session->trackMap('ses_subadmin_id');
        $client_user = $this->session->userdata('ses_subadmin_id');

        // $data['getAllStatus'] = $this->CommonModel->statusUserList($client_user);
        $data['getAllStatus'] = $this->CommonModel->tripListClient($client_user);

        $where = array(
            // "is_delete"         =>  0,
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );
        $data['getAllBus'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'bus','bus.id');

        $data['getAllChaperone'] = $this->CommonModel->chaperoneData($client_user);


        $data['getAllDriver'] = $this->CommonModel->driverData($client_user);
        $data['getAllTrip'] = $this->CommonModel->selectResultDataByCondition($where,'trip');

        // print_r($data['getAllStatus']);die;
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
        // $trip_date = $this->input->post('trip_date');
        $trip_id = $this->input->post('trip_id');

        $clientuserData = $this->CommonModel->trackUser($trip_id,$bus_id,$driver_id,$status,$chaperone_id,$client_user);
        // print_r($clientuserData);die;
        if (!empty($clientuserData))
        {

            $k = 0;
            for ($i=0; $i < count($clientuserData); $i++) 
            { 
                
                    $checkBox = '<input id="'.$clientuserData[$i]['trip_id'].'" type="checkbox" value="'.$clientuserData[$i]['trip_id'].'" name="trip_id[]" class="form-control-custom"  data-id ="'.$clientuserData[$i]['trip_id'].'" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">
                      <label for="'.$clientuserData[$i]['trip_id'].'"></label><br>
                      <span id="errmsg" style="color: red;"></span>';



                    if($clientuserData[$i]['status'] == 1){
                        $status = '<button class="btn btn-sm btn-warning">Live</button>';
                    }else{
                        $status = '<button class="btn btn-sm btn-warning">No Live</button>';
                    }
                    
                    $arr[] = array(
                        $checkBox,
                        $clientuserData[$i]['tridID'],
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

    
    public function exportTrack()
    {
        // print_r($_POST);die;
          // $fileName = 'trip-'.time().'.xlsx';  
        $fileName = 'track-'.time().'.xls';  

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
         $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('status'));   
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', $this->lang->line('estimated_start_time'));
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', $this->lang->line('estimated_end_time'));
        //  $objPHPExcel->getActiveSheet()->SetCellValue('G1', $this->lang->line('modify'));  
        // $objPHPExcel->getActiveSheet()->SetCellValue('H1', $this->lang->line('note'));
        
        // set Row
        $rowCount = 2;
         $i = 1;
        foreach ($empInfo as $element) 
        {
            
            if($element['status'] == 1){
                $status = 'Live';
            }else{
                $status = 'No Live';
            }

            // $date = date("d/m/Y", strtotime($element['updated_at']));

            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['trip_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['bus_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['driver_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['chaperone_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount,$status);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['trip_start']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['trip_end']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['note']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount,$parentCount);
           
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

    public function pdfTrack()
    {
        // print_r($_POST);

        $fileName = 'track-'.time().'.pdf';  

        // echo "string";
        $ids = $this->input->post('tripId');

        // print_r($ids);die;

        $html_content = '<h3 align="center">'.$this->lang->line('track').'</h3>';
        $html_content .= $this->PdfModel->getTrackPdf($ids);
        // print_r($html_content);die;
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        // $this->pdf->stream($fileName , array("Attachment"=>0));
        $this->pdf->stream($fileName);
    }


    //  public function printTrack()
    // {
    //     // print_r($_POST);

    //     $fileName = 'track-'.time().'.pdf';  

    //     // echo "string";
    //     $ids = $this->input->post('tripId');

    //     // print_r($ids);die;

    //     $html_content = '<h3 align="center">'.$this->lang->line('track').'</h3>';
    //     $html_content .= $this->PdfModel->getTrackPdf($ids);
    //     // print_r($html_content);die;
    //     $this->pdf->loadHtml($html_content);
    //     $this->pdf->render();
    //     // $this->pdf->stream($fileName , array("Attachment"=>0));
    //     $this->pdf->stream($fileName);
    //     // $this->pdf->stream(array("Attachment"=>0));
    // }


}
