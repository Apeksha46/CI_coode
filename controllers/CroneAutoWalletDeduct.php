<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CroneAutoWalletDeduct extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }
    
    public function check()
    {
        $user = $this->CommonModel->selectAllResultData('user');
        if ($user) {
            foreach ($user as $key => $userWallet) {
                $wallet     = (int)$userWallet['wallet']-151;
                $package_id = $userWallet['package_id'];
                //get all package
                $package = $this->CommonModel->selectAllResultData('package');
                if ($package) {
                    foreach ($package as $key => $packageValue) {
                        $price = (int)$packageValue['price']*2;
                        // echo $packageValue['package_id'];
                        // echo "<br/>";
                        if($package_id < $packageValue['package_id']){
                            // echo "string".$packageValue['package_id'];
                            // echo "<br/>";
                            // echo"price". $price;
                            // echo "<br/>";
                            // echo"wallet". $wallet;
                            // echo "<br/>";
                            if ($price <= $wallet) {
                                // echo "update package_id=".$packageValue['package_id'];
                                // echo "<br/>";
                                $update_price = $packageValue['price']*2;
                                $update_package_id = $packageValue['package_id'];
                                // echo"price". $update_price;
                                // echo "<br/>";
                                // echo"wallet". $wallet;
                                // echo "<br/>";
                                $amt = $wallet - $update_price;
                                // echo $amt;
                                // echo "<br/>";
                                // echo "update_package_id=".$update_package_id;
                                // echo "<br/>";
                                // echo $userWallet['user_id'];
                                // echo "<br/>";
                                if ($amt>=0) {
                                    $amt1 = (int)$amt + 151;
                                    // echo "total wallet balance = ".$amt1;
                                    // echo "<br/>";
                                    $this->CommonModel->updateRowByCondition(array('user_id' => $userWallet['user_id']),'user',array('wallet' => $amt1,'package_id' => $update_package_id ));

                                    $dta['name'] = $userWallet['first_name'].' '.$userWallet['last_name'];
                                    $this->email
                                        ->from('info@smallbazar.in', 'Small-Bazar.')
                                        ->to($userWallet['email'])
                                        ->subject('Your package is upgraded.')
                                        ->message($this->load->view('email_templates/upgrade',$dta,TRUE ))
                                        ->set_mailtype('html');
                                        
                                                // send email
                                    $sent1 = $this->email->send(); 
                                }
                            }
                        }
                    }
                }
                
            }
        }
    }

    public function check1()
    {
        $user = $this->CommonModel->insertData(array("name"=>"shreya"),'demo');
    }
}
