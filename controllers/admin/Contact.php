<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $sessionValue = $this->_adminLoginCheck();
	}
    
    //show Contact
    public function index()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $Data['tableData'] = $this->CommonModel->selectResultData('contact','contact_id');
        $this->load->view('admin/contact',$Data);
        $this->load->view('admin/common_files/footer');
    }
}
