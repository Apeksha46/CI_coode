<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		// $this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');
		// $this->load->model( 'CommonModel' );
	}
	public function index()
	{
		 $this->load->view('admin/login');
	}

	public function login(){
		// print_r($this->input->post('email'));exit;
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) 
        {
            $this->load->view('admin/login'); 
        }
        else
        {
            $loginCondition = array(
                'email' 	=> $this->input->post('email'),                
                'password'  => md5($this->input->post('password'))
            );
            
            $adminData = $this->CommonModel->selectRowDataByCondition($loginCondition,'admin');

            if(!empty($adminData))
            {
                $sessiondata = array(
                    'admin_id'    => $adminData->admin_id,
                    'admin_name'  => $adminData->name,
                    'admin_email' => $adminData->email,
                    'logged_in'   => TRUE,
                );
                // print_r($sessiondata);exit;
                $this->session->set_userdata('ses_logged_in',$sessiondata);

                if($this->session->userdata('ses_logged_in')!=true)
                {
                    // echo "session is not set";
                    //echo $this->session->set_userdata('user_id');
                } 
                else 
                {
                    // echo "session is set";
                }

                // die(var_dump($_SESSION));

                // print_r($this->session->userdata('ses_logged_in'));exit();
                $this->session->set_flashdata('success', 'Login successfully');
                return redirect('admin/Dashboard');
            }
            else
            {   
                $this->session->set_flashdata("error_login","Invalid crediantial");
                return redirect('admin/auth');
            } 
        }
	}

    public function forget_password()
    {
         $this->load->view('admin/forget_password');
    }

    public function send_mail(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE) 
        {
            $this->load->view('admin/forget_password'); 
        }
        else
        {   
            $to  = $this->input->post("email");
            $condition  = array('email' => $this->input->post("email"));
            $adminData = $this->CommonModel->selectRowDataByCondition($condition,'admin');        
            if ($adminData) {
                $randno   = rand(100000,999999);
                $md       = md5($randno);
                $data  = array("password" => $md,"pwd" => $md);
                $adminData = $this->CommonModel->updateRowByCondition($condition,'admin',$data); 

                $message = 'Hello Dear <br>Your forgot password is - '.$randno;

                // $sent = $this->CommonModel->sendMail($to,'Forgot password',$message); 

                $this->email
                    ->from('info@smallbazar.in', 'Small-Bazar.')
                    ->to($to)
                    ->subject('Forgot password.')
                    ->message('Hello Dear <br>Your forgot password is - '.$randno)
                    ->set_mailtype('html');
                    
                            // send email
                $sent1 = $this->email->send(); 
                // print_r($sent);
                // die();



                $this->session->set_flashdata("success","Email send on your email id");
                redirect('admin/Auth');
            }else{
                $this->session->set_flashdata("error_login","Invalid Email");
                $this->load->view('admin/forget_password');
            }
        }
    }
}
