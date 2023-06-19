<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');	

class Common{

	public $CI;
	public function __construct()
    {
        $this->CI =& get_instance();
    }

	public function check_adminlogin()
	{
		$login = $this->CI->session->userdata('ses_admin_id');
		if($login)
		{
			return true;

		} 
		else 
		{
			redirect('admin/Auth/index');
		}
	}
	public function check_managerlogin()
	{
		$login = $this->CI->session->userdata('ses_manager_id');
		if($login)
		{
			return true;

		} 
		else 
		{
			redirect('manager/Auth/index');
		}
	}
}