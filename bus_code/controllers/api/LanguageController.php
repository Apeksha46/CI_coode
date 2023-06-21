<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
class LanguageController extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( 'form_validation' );
		$this->load->language('english');
		// $this->load->language('arabic');
		$this->form_validation->set_error_delimiters('', '');
	}

	public function check_language_post()
	{
		$lang = $this->input->post('lang');
		$check_langauge = $this->switch_Lang($lang);
	   // print_r($check_langauge);

		// $this->form_validation->set_rules('email_id', 'lang:checking_ar', 'required');
		// $this->form_validation->set_message('required', 'lang:checking_ar');
		$this->form_validation->set_message('rule', 'lang:checking_ar'); 


	   // $this->form_validation->set_rules('email_id',$this->lang->line('checking_ar'), 'required');
	   // lang:pseudo
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'object'	=> new stdClass()
			));
            
        }

	    return $this->response(array(
			'status'	=> REST_Controller::HTTP_BAD_REQUEST,
			'message' 	=> $this->lang->line('checking'),
			'Data'	=> new stdClass()
		));

	}


}
