<?php
// error_reporting(0);
    defined('BASEPATH') OR exit('No direct script access allowed');

    class checkMapController extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->common->check_subadminlogin();
        // $this->load->library('excel');
        // $this->load->library('pdf');
    }

    public function checkMap()
    {   
        // echo "string";die;
        $data['title'] = $this->lang->line('status');

        $client_user = $this->session->userdata('ses_subadmin_id');

        $data['getAllStatus'] = $this->CommonModel->trackStatus($client_user);

print_r($data['getAllStatus']);die();
        $where = array(
            // "is_delete"         =>  0,
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        $data['getAllBus'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'bus','bus.id');


        $data['getAllChaperone'] = $this->CommonModel->chaperoneData($client_user);

        $data['getAllParent'] = $this->CommonModel->parentsData($client_user);

        $data['getAllDriver'] = $this->CommonModel->driverData($client_user);
         $data['getAllTrip'] = $this->CommonModel->selectResultDataByCondition($where,'trip');
// print_r($data['getAllTrip']);die;
        $this->loadSubAdminView('subadmin/track/checkMap',$data); 

    }
}
