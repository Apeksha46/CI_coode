<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotificationController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        $this->load->library('excel');
                $this->load->library('pdf');

        
	}

    public function notification_list()
    {
        // echo "string";die;
        $data['title'] = $this->lang->line('notification');
        
        $data['notification_count'] = $this->CommonModel->select_single_row("Select count(*) as total from notifcation ");

        $data['getAllNotification'] = $this->CommonModel->notifcation_list();

        $this->loadAdminView('admin/notification/list',$data); 
    }

    public function notification_new()
    {
        $where = array(
            "delete" => 0,
            "status" => 1,
        );

        $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');

        $data['getAllApp'] = $this->CommonModel->app_list();
        // print_r($data['getAllApp']);die;
        $this->loadAdminView('admin/notification/new_nofity',$data); 
    }
    
    public function insert_nofication()
    {

        $data = array(
                    "client"      =>  $this->input->post('client'),
                    "app_user"     =>  $this->input->post('app_user'),
                    "based_app"    =>  $this->input->post('based_app'),
                    "version"        =>  $this->input->post('version'),
                    "platform"            =>  $this->input->post('platform'),
                    "msg"            =>  $this->input->post('msg'),
                    "created_at"       =>  date('Y-m-d H:i:s a'),
                    "updated_at"       =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,' notifcation');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('notification_send_successfully'));
            redirect('admin/notification'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('notification_not_send_successfully'));
            redirect('admin/notification_new'); 
            
        }
    }

    public function delete_nofication()
    {
        // print_r($_POST);die;
        $val = explode(',',($this->input->post('notificationId')));

        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $clientData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $value),'notifcation');

            if($clientData)
            {
                $updateData = $this->CommonModel->delete($where,'notifcation'); 
            }
            else{
                $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                redirect('admin/notification');
            }
        }

        if($updateData)
        {
            $this->session->set_flashdata('success',$this->lang->line('notification_delete_successfully'));
             redirect('admin/notification');
        }else{
            $this->session->set_flashdata('error',$this->lang->line('notification_not_delete_successfully'));
             redirect('admin/notification');
        }
    }

    public function excelNotificaitonList()
    {
        // echo "string";die;
        $fileName = 'notification-'.time().'.xls';  

        $ids = $this->input->post('notificationId');

        $this->load->library('excel');

        $empInfo = $this->PdfModel->getNotificationExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('s_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('date_time'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $this->lang->line('clients'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('user'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('based_on_app_version'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('all_app_version'));
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', $this->lang->line('platform'));
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', $this->lang->line('msg'));      
        // set Row
        $rowCount = 2;
         $i = 1;
        foreach ($empInfo as $element) 
        {
            $date = date("d/m/Y h:s A", strtotime($element['updated_at']));

            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount,$date);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['client']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['app_user']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['based_app']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['version']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['platform']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['msg']);
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

    public function pdfNotificaitonList()
    {
        // echo "string";die;
       $fileName = 'notification-'.time().'.pdf';  

        $ids = $this->input->post('notificationId');

        // print_r($ids);die;

        $html_content = '<h3 align="center">'.$this->lang->line('notification').'</h3>';

        $html_content .= $this->PdfModel->getNotificationPdf($ids);
        // print_r($html_content);die;
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        // $this->pdf->stream($fileName , array("Attachment"=>0));
        $this->pdf->stream($fileName);
        // $this->pdf->stream(array("Attachment"=>0));
    }



}
