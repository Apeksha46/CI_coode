<?php

class MY_Controller extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library( 'form_validation' );
        $this->lang->load( 'english' );
    }

    
    protected function _loadAdminView($template, $data = array())
    {    
        if(empty($data['title']))
        {
            $data['title'] = 'Tambula';
        }
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view($template,$data);
        $this->load->view('admin/common/footer');
    }
    protected function _loadManagerView($template, $data = array())
    {    
        if(empty($data['title']))
        { 
            $data['title'] = 'ConnectCare';
        }
        $this->load->view('manager/common/header');
        $this->load->view('manager/common/sidebar');
        $this->load->view($template,$data);
        $this->load->view('manager/common/footer');
    }    
        
   
    public function _adminLoginCheck()
    {
        if(!$this->session->userdata('ses_logged_in') )
        {
            // echo "string";exit;
            redirect( 'admin/Auth' );
        }
    }
    public function web_logged()
    {
        // var_dump($this->session->userdata('web_logged_in'));die;
        if($this->session->userdata('web_logged_in') == NULL )
        {
            // echo "string";die;
            redirect('website/Auth/');
        }
    }
   
    protected function _setFlash($type, $msg)
    {
        $this->session->set_flashdata( 'flashmessage_type', $type );
        $this->session->set_flashdata( 'flashmessage_msg', $msg );
    }

    protected function _getFlash()
    {
        if( $this->session->flashdata('flashmessage_type') != '' || $this->session->flashdata('flashmessage_msg') != '' )
        {
            return json_encode(array(
                'type'      => $this->session->flashdata('flashmessage_type'),
                'message'   => $this->session->flashdata('flashmessage_msg')
            ));
        }
         else 
        {
            return '';
        }
    }
   protected function _sendiOSNotification( $values )
    {
      

            if ( ENVIRONMENT === 'production' ) {
                $gateway = 'ssl://gateway.push.apple.com:2195';
                $pem = IOS_PEM . 'ConnectCare_Dev.pem';
            } else { 
                $gateway = 'ssl://gateway.sandbox.push.apple.com:2195';
                $pem = IOS_PEM . 'ConnectCare_Dev.pem';
            }
            
            // Create a Stream
            $ctx = stream_context_create();
            // Define the certificate to use 
            stream_context_set_option($ctx, 'ssl', 'local_cert', $pem);
            // Passphrase to the certificate
            stream_context_set_option($ctx, 'ssl', 'passphrase', '1234');
            
            // Open a connection to the APNS server
            $fp = stream_socket_client( $gateway, $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
            
            // Check that we've connected
            if (!$fp) {
                die("Failed to connect: $err $errstr");
            }
            
            // Ensure that blocking is disabled
            stream_set_blocking($fp, 0);

            $body['aps']            =  array(
                'alert'             => $values['message'],
                'badge'             => 1,
                'sound'             => 'default'
            );
            $body['connectcare']       =  array(
                'msg'           => $values['message'],
                'type'      => $values['type']
            );
            
            // Encode the payload as JSON
            $payload = json_encode($body);

            $notification = chr(0) . pack('n', 32) . pack('H*', $values['device_id']) . pack('n', strlen($payload)) . $payload;
            
            // Send it to the server
            $result = fwrite($fp, $notification, strlen($notification));
                      
            fclose($fp);       

        return $result;

    } 

    //check null value
    protected function check_value($values)
    {
        // print_r($values);exit;
        if($values == '' || $values == NULL ){
            return "";
        }else{
            return $values;
        }
    }

      /*******new code******/
    protected function _sendAndroidNotification( $values )
    {
        $url = 'https://android.googleapis.com/gcm/send';

        $message = array(
            'title'         => $values['title'],
            'message'       => $values['message'],
            'subject'       => $values['subject'],
            'subtitle'      => '',
            'tickerText'    => '',
            'msgcnt'        => 1,
            'type'          => $values['type'],
            'id'            => $values['id'],
            'vibrate'       => 1
        );

        $headers = array(
            'Authorization: key=AIzaSyAHY4ExlvwcM07bu3w9o79OcurxmolrB3s',
            'Content-Type: application/json'
        );

        if(is_array($values['device_id']))
        {
             $fields = array(
                'registration_ids'  => $values['device_id'] ,
                // 'notification'      => $message,
                'data'              => $message,
            ); 
        }
        else
        {
            $fields = array(
                'to'            => $values['device_id'] ,
                // 'notification'  => $message,
                'data'          => $message,
            );
        }
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        
        curl_close($ch);       

        return $result;

    }
    protected function sendNotificationToCustomers( $values )
    {
    

        $url = 'https://android.googleapis.com/gcm/send';

        $message = array(
            'title'         => $values['title'],
            'message'       => $values['message'],
            'subject'       => $values['subject'],
            'subtitle'      => '',
            'tickerText'    => '',
            'msgcnt'        => 1,
            'type'          => $values['type'],
            'chat_id'       => $values['chat_id'],
            'customer_id'   => $values['customer_id'],
            'seller_id'     => $values['seller_id'],
            'product_id'    => $values['product_id'],
            'bargain_amount'=> $values['bargain_amount'],
            'vibrate'       => 1
        );

        $headers = array(
            'Authorization: key=AIzaSyAHY4ExlvwcM07bu3w9o79OcurxmolrB3s',
            'Content-Type: application/json'
        );

        if(is_array($values['device_id']))
        {
             $fields = array(
                'registration_ids'  => $values['device_id'] ,
                // 'notification'      => $message,
                'data'              => $message,
            ); 
        }

        else
        {
            $fields = array(
                'to'            => $values['device_id'] ,
                // 'notification'  => $message,
                'data'          => $message,
            );
        }
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        
        curl_close($ch);       

        return $result;

    }
    // protected function _sendAndroidNotification( $values )
    // {


    //     $url = 'https://android.googleapis.com/gcm/send';

    //     $message = array(
    //         'title'         => $values['title'],
    //         'message'       => $values['message'],
    //         'subject'       => $values['subject'],
    //         'id'            => $values['id'],
    //         'subtitle'      => '',
    //         'tickerText'    => '',
    //         'msgcnt'        => 1,
    //         'type'          => $values['type'],
    //         'vibrate'       => 1
    //     );
    //     // AIzaSyAHY4ExlvwcM07bu3w9o79OcurxmolrB3s
    //     $headers = array(
    //         'Authorization: key=AIzaSyAHY4ExlvwcM07bu3w9o79OcurxmolrB3s',
    //         'Content-Type: application/json'
    //     );

    //     $fields = array(
    //         'registration_ids'  => array( $values['device_id'] ),
    //         'data'              => $message,
    //     );
        
    //     $ch = curl_init();
        
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
    //     $result = curl_exec($ch);
    //     if ($result === FALSE) {
    //         die('Curl failed: ' . curl_error($ch));
    //     }
        
    //     curl_close($ch);

    //     return $result;

    // }
    protected function _sendAndroidNotificationForDriver( $values )
    {


        $url = 'https://android.googleapis.com/gcm/send';

        $message = array(
            'title'         => $values['title'],
            'message'       => $values['message'],
            'subject'       => $values['subject'],
            'id'            => $values['id'],
            'subtitle'      => '',
            'tickerText'    => '',
            'msgcnt'        => 1,
            'type'          => $values['type'],
            'vibrate'       => 1
        );
        
        $headers = array(
            'Authorization: key=AIzaSyCwCiwtLsscpNPfzz0Q1xyVAJR8sZRZIEo',
            'Content-Type: application/json'
        );

        $fields = array(
            'registration_ids'  => array( $values['device_id'] ),
            'data'              => $message,
        );
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        
        curl_close($ch);

        return $result;

    }
    protected function sendNotificationFromAdminToCustomers( $values )
    {
    

        $url = 'https://android.googleapis.com/gcm/send';

        $message = array(
            'title'         => $values['title'],
            'message'       => $values['message'],
            'subject'       => $values['subject'],
            'subtitle'      => '',
            'tickerText'    => '',
            'msgcnt'        => 1,
            'type'          => $values['type'],
            'chat_id'       => $values['chat_id'],
            'customer_id'   => $values['customer_id'],
            'admin_id'      => $values['admin_id'],
            'product_id'    => $values['product_id'],
            'vibrate'       => 1
        );

        $headers = array(
            'Authorization: key=AIzaSyAHY4ExlvwcM07bu3w9o79OcurxmolrB3s',
            'Content-Type: application/json'
        );

        if(is_array($values['device_id']))
        {
             $fields = array(
                'registration_ids'  => $values['device_id'] ,
                // 'notification'      => $message,
                'data'              => $message,
            ); 
        }

        else
        {
            $fields = array(
                'to'            => $values['device_id'] ,
                // 'notification'  => $message,
                'data'          => $message,
            );
        }
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        
        curl_close($ch);       

        return $result;

    }

    // ccavenue payment gateway code
    protected function encrypt($plainText,$key)
    {
        $secretKey = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
        $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
        $plainPad = $this->pkcs5_pad($plainText, $blockSize);
        if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
        {
              $encryptedText = mcrypt_generic($openMode, $plainPad);
                  mcrypt_generic_deinit($openMode);
                        
        } 
        return bin2hex($encryptedText);
    }

    protected function decrypt($encryptedText,$key)
    {
        $secretKey = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText=$this->hextobin($encryptedText);
        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
        mcrypt_generic_init($openMode, $secretKey, $initVector);
        $decryptedText = mdecrypt_generic($openMode, $encryptedText);
        $decryptedText = rtrim($decryptedText, "\0");
        mcrypt_generic_deinit($openMode);
        return $decryptedText;
        
    }
    //*********** Padding Function *********************

    protected function pkcs5_pad ($plainText, $blockSize)
    {
        $pad = $blockSize - (strlen($plainText) % $blockSize);
        return $plainText . str_repeat(chr($pad), $pad);
    }

    //********** Hexadecimal to Binary function for php 4.0 version ********

    protected function hextobin($hexString) 
    { 
        $length = strlen($hexString); 
        $binString="";   
        $count=0; 
        while($count<$length) 
        {       
            $subString =substr($hexString,$count,2);           
            $packedString = pack("H*",$subString); 
            if ($count==0)
        {
            $binString=$packedString;
        } 
            
        else 
        {
            $binString.=$packedString;
        } 
            
        $count+=2; 
        } 
        return $binString; 
    } 
}    