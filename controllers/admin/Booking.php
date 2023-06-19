<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        // $sessionValue = $this->_adminLoginCheck();
    }
    // public function cart_item(){
    //     $this->load->view('admin/common_files/header');
    //     $this->load->view('admin/common_files/sidebar');
    //     // $cart_id = explode(',', $this->input->get('ids'));
    //     // print_r($cart_id);exit;
    //     $arr = array();
    //     for ($i=0; $i < count($cart_id); $i++) { 
    //         $cartCondition      = array("cart_id" => $cart_id[$i]);
    //         $dataCart           = $this->CommonModel->selectRowDataByCondition($cartCondition,'cart');
    //         // print_r($dataCart);exit;
    //         if (!empty($dataCart)) {
    //             $productCondition   = array("product_id" => $dataCart->product_id);
    //             $productData        = $this->CommonModel->selectRowDataByCondition($productCondition,'product');

    //             $productImgCondition   = array("product_id" => $dataCart->product_id);
    //             $productImgData        = $this->CommonModel->selectResultDataByCondition($productImgCondition,'product_image');
    //             $img = '';
    //             if (count($productImgData) > 0) {
    //                 for ($j=0; $j < count($productImgData); $j++) { 
    //                     $img = $productImgData[0]['image'];
    //                 }
    //                 // print_r($productImgData[0]['image']);
    //             }
    //             $arr[] = array(
    //                 'quantity'              => $dataCart->quantity,
    //                 'actual_price'          => $dataCart->actual_price,
    //                 'total_price'           => $dataCart->total_price,
    //                 'product_name'          => $productData->product_name,
    //                 'product_description'   => $productData->product_description,
    //                 'product_image'         => base_url().'product/'.$img
    //             );
    //         }
    //     }
    //     $ArrayData['data'] = $arr;
    //     // print_r($arr);exit;
        
    //     $this->load->view('admin/booking/cart_item',$ArrayData);
    //     $this->load->view('admin/common_files/footer');
    // }
    //Dashboard
    public function index()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $completeCondition = array(
            "payment_status" => 1,
            "created_at"   => date('Y-m-d')
        );

        $pendingCondition = "payment_status!= '1' AND payment_status!= '4' AND payment_status!= '3' AND payment_status!= '2' AND created_at = '".date('Y-m-d')."' ";
        $returnCondition = "payment_status = '4' AND created_at = '".date('Y-m-d')."' ";
        // $pendingCondition = array(
        //     "payment_status!=" => 1,
        //     "created_at"   => date('Y-m-d')
        // );
        $cancelCondition = array(
            "payment_status" => 3,
            "created_at"   => date('Y-m-d')
        );
        $dispatchCondition = array(
            "payment_status" => 3,
            "created_at"   => date('Y-m-d')
        );
        $data       = $this->CommonModel->selectResultDataByConditionAndFieldName($pendingCondition,'tbl_booking','booking_id'); 
        $data1      = $this->CommonModel->selectResultDataByConditionAndFieldName($completeCondition,'tbl_booking','booking_id');
        $data2      = $this->CommonModel->selectResultDataByConditionAndFieldName($cancelCondition,'tbl_booking','booking_id'); 
        $data3      = $this->CommonModel->selectResultDataByConditionAndFieldName($returnCondition,'tbl_booking','booking_id'); 
        $data4      = $this->CommonModel->selectResultDataByConditionAndFieldName($dispatchCondition,'tbl_booking','booking_id'); 
        // print_r($data);
        // print_r($data1);exit;
        $arr = array();
        if (count($data) > 0) {
            for ($i=0; $i < count($data); $i++) { 
                
                $countryCondition = array("id" => $data[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (count($dataRow) > 0) {
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (count($dataRow1) > 0) {
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data[$i]['city']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (count($dataRow1) > 0) {
                    $city_name   = $dataRow1->city_name;
                }else{
                    $city_name   = '';
                }

                $arr[] = array(
                    "booking_id"        => $data[$i]['booking_id'],
                    "order_id"          => $data[$i]['order_id'],
                    "name"              => $data[$i]['first_name'].' '.$data[$i]['last_name'],
                    "email"             => $data[$i]['email'],
                    "mobile"            => $data[$i]['mobile'],
                    "address"           => $data[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data[$i]['pincode'],
                    "total_price"       => $data[$i]['total_price'],
                    "quantity"          => $data[$i]['quantity'],
                    "payment_id"        => $data[$i]['payment_id'],
                    "payment_type"      => $data[$i]['payment_type'],
                    "booking_date"      => $data[$i]['created_at'],
                    "payment_status"    => $data[$i]['payment_status'],
                );
            }
            // print_r($arr);exit;
        }

        $arr1 = array();
        if (count($data1) > 0) {
            for ($i=0; $i < count($data1); $i++) { 

                $countryCondition = array("id" => $data1[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (count($dataRow) > 0) {
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data1[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (count($dataRow1) > 0) {
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data1[$i]['city']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (count($dataRow1) > 0) {
                    $city_name   = $dataRow1->city_name;
                }else{
                    $city_name   = '';
                }

                $arr1[] = array(
                    "booking_id"        => $data1[$i]['booking_id'],
                    "order_id"          => $data1[$i]['order_id'],
                    "name"              => $data1[$i]['first_name'].' '.$data1[$i]['last_name'],
                    "email"             => $data1[$i]['email'],
                    "mobile"            => $data1[$i]['mobile'],
                    "address"           => $data1[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data1[$i]['pincode'],
                    "total_price"       => $data1[$i]['total_price'],
                    "quantity"          => $data1[$i]['quantity'],
                    "payment_id"        => $data1[$i]['payment_id'],
                    "payment_type"      => $data1[$i]['payment_type'],
                    "booking_date"      => $data1[$i]['created_at'],
                    "payment_status"    => $data1[$i]['payment_status'],
                );
            }
            // print_r($arr);exit;
        }
        $arr2 = array();
        if (count($data2) > 0) {
            for ($i=0; $i < count($data2); $i++) { 
                
                $countryCondition = array("id" => $data2[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (count($dataRow) > 0) {
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data2[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (count($dataRow1) > 0) {
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data2[$i]['city']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (count($dataRow1) > 0) {
                    $city_name   = $dataRow1->city_name;
                }else{
                    $city_name   = '';
                }

                $arr2[] = array(
                    "booking_id"        => $data2[$i]['booking_id'],
                    "order_id"          => $data2[$i]['order_id'],
                    "name"              => $data2[$i]['first_name'].' '.$data[$i]['last_name'],
                    "email"             => $data2[$i]['email'],
                    "mobile"            => $data2[$i]['mobile'],
                    "address"           => $data2[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data2[$i]['pincode'],
                    "total_price"       => $data2[$i]['total_price'],
                    "quantity"          => $data2[$i]['quantity'],
                    "payment_id"        => $data2[$i]['payment_id'],
                    "payment_type"      => $data2[$i]['payment_type'],
                    "booking_date"      => $data2[$i]['created_at'],
                    "payment_status"    => $data2[$i]['payment_status'],
                );
            }
            // print_r($arr2);exit;
        }
        $arr3 = array();
        if (count($data3) > 0) {
            for ($i=0; $i < count($data3); $i++) { 
                
                $countryCondition = array("id" => $data3[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (count($dataRow) > 0) {
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data3[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (count($dataRow1) > 0) {
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data3[$i]['city']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (count($dataRow1) > 0) {
                    $city_name   = $dataRow1->city_name;
                }else{
                    $city_name   = '';
                }

                $arr3[] = array(
                    "booking_id"        => $data3[$i]['booking_id'],
                    "order_id"          => $data3[$i]['order_id'],
                    "name"              => $data3[$i]['first_name'].' '.$data3[$i]['last_name'],
                    "email"             => $data3[$i]['email'],
                    "mobile"            => $data3[$i]['mobile'],
                    "address"           => $data3[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data3[$i]['pincode'],
                    "total_price"       => $data3[$i]['total_price'],
                    "quantity"          => $data3[$i]['quantity'],
                    "payment_id"        => $data3[$i]['payment_id'],
                    "payment_type"      => $data3[$i]['payment_type'],
                    "payment_status"    => $data3[$i]['payment_status'],
                );
            }
            // print_r($arr);exit;
        }
        $arr4 = array();
        if (count($data4) > 0) {
            for ($i=0; $i < count($data4); $i++) { 
                
                $countryCondition = array("id" => $data4[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (count($dataRow) > 0) {
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data4[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (count($dataRow1) > 0) {
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data4[$i]['city']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (count($dataRow1) > 0) {
                    $city_name   = $dataRow1->city_name;
                }else{
                    $city_name   = '';
                }

                $arr4[] = array(
                    "booking_id"        => $data4[$i]['booking_id'],
                    "order_id"          => $data4[$i]['order_id'],
                    "name"              => $data4[$i]['first_name'].' '.$data4[$i]['last_name'],
                    "email"             => $data4[$i]['email'],
                    "mobile"            => $data4[$i]['mobile'],
                    "address"           => $data4[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data4[$i]['pincode'],
                    "total_price"       => $data4[$i]['total_price'],
                    "quantity"          => $data4[$i]['quantity'],
                    "payment_id"        => $data4[$i]['payment_id'],
                    "payment_type"      => $data4[$i]['payment_type'],
                    "booking_date"      => $data4[$i]['created_at'],
                    "payment_status"    => $data4[$i]['payment_status'],
                );
            }
            // print_r($arr);exit;
        }
        if (empty($arr)) {
            $arr = array();
        }
        if (empty($arr1)) {
            $arr1 = array();
        }
        if (empty($arr2)) {
            $arr2 = array();
        }
        if (empty($arr3)) {
            $arr3 = array();
        }
        if (empty($arr4)) {
            $arr4 = array();
        }
        $parent_data['pending'] = $arr;
        $parent_data['complete']= $arr1;
        $parent_data['cancel']  = $arr2;
        $parent_data['return']  = $arr3;
        $parent_data['dispatch']= $arr4;
        $this->load->view('admin/booking/booking',$parent_data);
        $this->load->view('admin/common_files/footer');
    }
    public function past_booking()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $completeCondition = array(
            "payment_status" => 1,
            "created_at<"  => date('Y-m-d')
        );
        $pendingCondition = array(
            "payment_status" => 0,
            "created_at<"  => date('Y-m-d')
        );
        $returnCondition = array(
            "payment_status" => 4,
            "created_at<"  => date('Y-m-d')
        );
        $cancelCondition = array(
            "payment_status" => 3,
            "created_at<"  => date('Y-m-d')
        );
        $dispatchCondition = array(
            "payment_status" => 2,
            "created_at<"  => date('Y-m-d')
        );
        $data       = $this->CommonModel->selectResultDataByConditionAndFieldName($pendingCondition,'tbl_booking','booking_id'); 
        $data1      = $this->CommonModel->selectResultDataByConditionAndFieldName($completeCondition,'tbl_booking','booking_id');
        $data2      = $this->CommonModel->selectResultDataByConditionAndFieldName($cancelCondition,'tbl_booking','booking_id'); 
        $data3      = $this->CommonModel->selectResultDataByConditionAndFieldName($returnCondition,'tbl_booking','booking_id'); 
        $data4      = $this->CommonModel->selectResultDataByConditionAndFieldName($dispatchCondition,'tbl_booking','booking_id'); 
        // print_r($data);
        // print_r($data2);exit;
        $arr = array();
        if (count($data) > 0) {
            for ($i=0; $i < count($data); $i++) { 
                
                $countryCondition = array("id" => $data[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (!empty($dataRow)) {
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (!empty($dataRow1)) {
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data[$i]['city']);
                $dataRow2 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (!empty($dataRow2)) {
                    $city_name   = $dataRow2->city_name;
                }else{
                    $city_name   = '';
                }

                $arr[] = array(
                    "booking_id"        => $data[$i]['booking_id'],
                    "order_id"          => $data[$i]['order_id'],
                    "name"              => $data[$i]['first_name'].' '.$data[$i]['last_name'],
                    "email"             => $data[$i]['email'],
                    "mobile"            => $data[$i]['mobile'],
                    "address"           => $data[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data[$i]['pincode'],
                    "total_price"       => $data[$i]['total_price'],
                    "quantity"          => $data[$i]['quantity'],
                    "payment_id"        => $data[$i]['payment_id'],
                    "payment_type"      => $data[$i]['payment_type'],
                    "booking_date"      => $data[$i]['created_at'],
                    "payment_status"    => $data[$i]['payment_status'],
                );
            }
            // print_r($arr);exit;
        }

        $arr1 = array();
        if (count($data1) > 0) {
            for ($i=0; $i < count($data1); $i++) { 

                $countryCondition = array("id" => $data1[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (!empty($dataRow)){
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data1[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (!empty($dataRow1)){
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data1[$i]['city']);
                $dataRow2 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (!empty($dataRow2)){
                    $city_name   = $dataRow2->city_name;
                }else{
                    $city_name   = '';
                }

                $arr1[] = array(
                    "booking_id"        => $data1[$i]['booking_id'],
                    "order_id"          => $data1[$i]['order_id'],
                    "name"              => $data1[$i]['first_name'].' '.$data1[$i]['last_name'],
                    "email"             => $data1[$i]['email'],
                    "mobile"            => $data1[$i]['mobile'],
                    "address"           => $data1[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data1[$i]['pincode'],
                    "total_price"       => $data1[$i]['total_price'],
                    "quantity"          => $data1[$i]['quantity'],
                    "payment_id"        => $data1[$i]['payment_id'],
                    "payment_type"      => $data1[$i]['payment_type'],
                    "booking_date"      => $data1[$i]['created_at'],
                    "payment_status"    => $data1[$i]['payment_status'],
                );
            }
            // print_r($arr);exit;
        }
        $arr2 = array();
        if (count($data2) > 0) {
            for ($i=0; $i < count($data2); $i++) { 
                
                $countryCondition = array("id" => $data2[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (!empty($dataRow)) {
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data2[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (!empty($dataRow1)) {
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data2[$i]['city']);
                $dataRow2 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (!empty($dataRow2)) {
                    $city_name   = $dataRow2->city_name;
                }else{
                    $city_name   = '';
                }

                $arr2[] = array(
                    "booking_id"        => $data2[$i]['booking_id'],
                    "order_id"          => $data2[$i]['order_id'],
                    "name"              => $data2[$i]['first_name'].' '.$data[$i]['last_name'],
                    "email"             => $data2[$i]['email'],
                    "mobile"            => $data2[$i]['mobile'],
                    "address"           => $data2[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data2[$i]['pincode'],
                    "total_price"       => $data2[$i]['total_price'],
                    "quantity"          => $data2[$i]['quantity'],
                    "payment_id"        => $data2[$i]['payment_id'],
                    "payment_type"      => $data2[$i]['payment_type'],
                    "booking_date"      => $data2[$i]['created_at'],
                    "payment_status"    => $data2[$i]['payment_status'],
                );
            }
            // print_r($arr2);exit;
        }
        $arr3 = array();
        if (count($data3) > 0) {
            for ($i=0; $i < count($data3); $i++) { 
                
                $countryCondition = array("id" => $data3[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (!empty($dataRow)) {
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data3[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (!empty($dataRow1)) {
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data3[$i]['city']);
                $dataRow2 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (!empty($dataRow2)) {
                    $city_name   = $dataRow2->city_name;
                }else{
                    $city_name   = '';
                }

                $arr3[] = array(
                    "booking_id"        => $data3[$i]['booking_id'],
                    "order_id"          => $data3[$i]['order_id'],
                    "name"              => $data3[$i]['first_name'].' '.$data3[$i]['last_name'],
                    "email"             => $data3[$i]['email'],
                    "mobile"            => $data3[$i]['mobile'],
                    "address"           => $data3[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data3[$i]['pincode'],
                    "total_price"       => $data3[$i]['total_price'],
                    "quantity"          => $data3[$i]['quantity'],
                    "payment_id"        => $data3[$i]['payment_id'],
                    "payment_type"      => $data3[$i]['payment_type'],
                    "booking_date"      => $data3[$i]['created_at'],
                    "payment_status"    => $data3[$i]['payment_status'],
                );
            }
            // print_r($arr);exit;
        }
        $arr4 = array();
        if (count($data4) > 0) {
            for ($i=0; $i < count($data4); $i++) { 
                
                $countryCondition = array("id" => $data4[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (!empty($dataRow)) {
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data4[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (!empty($dataRow1)) {
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data4[$i]['city']);
                $dataRow2 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (!empty($dataRow1)) {
                    $city_name   = $dataRow2->city_name;
                }else{
                    $city_name   = '';
                }

                $arr4[] = array(
                    "booking_id"        => $data4[$i]['booking_id'],
                    "order_id"          => $data4[$i]['order_id'],
                    "name"              => $data4[$i]['first_name'].' '.$data4[$i]['last_name'],
                    "email"             => $data4[$i]['email'],
                    "mobile"            => $data4[$i]['mobile'],
                    "address"           => $data4[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data4[$i]['pincode'],
                    "total_price"       => $data4[$i]['total_price'],
                    "quantity"          => $data4[$i]['quantity'],
                    "payment_id"        => $data4[$i]['payment_id'],
                    "payment_type"      => $data4[$i]['payment_type'],
                    "payment_status"    => $data4[$i]['payment_status'],
                    "booking_date"      => $data4[$i]['created_at'],
                );
            }
            // print_r($arr);exit;
        }
        if (empty($arr)) {
            $arr = array();
        }
        if (empty($arr1)) {
            $arr1 = array();
        }
        if (empty($arr2)) {
            $arr2 = array();
        }
        if (empty($arr3)) {
            $arr3 = array();
        }
        if (empty($arr4)) {
            $arr4 = array();
        }
        $parent_data['pending'] = $arr;
        $parent_data['complete']= $arr1;
        $parent_data['cancel']  = $arr2;
        $parent_data['return']  = $arr3;
        $parent_data['dispatch']= $arr4;
        $this->load->view('admin/booking/past_booking',$parent_data);
        $this->load->view('admin/common_files/footer');
    }
    public function future_booking()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $completeCondition = array(
            "payment_status" => 1,
            "created_at>="  => date('Y-m-d')
        );
        $pendingCondition = array(
            "payment_status" => 0,
            "created_at>="  => date('Y-m-d')
        );
        $returnCondition = array(
            "payment_status" => 4,
            "created_at>"  => date('Y-m-d')
        );
        $cancelCondition = array(
            "payment_status" => 3,
            "created_at>="  => date('Y-m-d')
        );
        $dispatchCondition = array(
            "payment_status" => 2,
            "created_at>="  => date('Y-m-d')
        );
        $data       = $this->CommonModel->selectResultDataByConditionAndFieldName($pendingCondition,'tbl_booking','booking_id'); 
        $data1      = $this->CommonModel->selectResultDataByConditionAndFieldName($completeCondition,'tbl_booking','booking_id');
        $data2      = $this->CommonModel->selectResultDataByConditionAndFieldName($cancelCondition,'tbl_booking','booking_id'); 
        $data3      = $this->CommonModel->selectResultDataByConditionAndFieldName($returnCondition,'tbl_booking','booking_id'); 
        $data4      = $this->CommonModel->selectResultDataByConditionAndFieldName($dispatchCondition,'tbl_booking','booking_id'); 
        $arr = array();
        if (count($data) > 0) {
            for ($i=0; $i < count($data); $i++) { 
                
                $countryCondition = array("id" => $data[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (!empty($dataRow)) {
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (!empty($dataRow1)) {
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data[$i]['city']);
                $dataRow2 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (!empty($dataRow2)) {
                    $city_name   = $dataRow2->city_name;
                }else{
                    $city_name   = '';
                }

                $arr[] = array(
                    "booking_id"        => $data[$i]['booking_id'],
                    "order_id"          => $data[$i]['order_id'],
                    "name"              => $data[$i]['first_name'].' '.$data[$i]['last_name'],
                    "email"             => $data[$i]['email'],
                    "mobile"            => $data[$i]['mobile'],
                    "address"           => $data[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data[$i]['pincode'],
                    "total_price"       => $data[$i]['total_price'],
                    "quantity"          => $data[$i]['quantity'],
                    "payment_id"        => $data[$i]['payment_id'],
                    "payment_type"      => $data[$i]['payment_type'],
                    "booking_date"      => $data[$i]['created_at'],
                    "payment_status"    => $data[$i]['payment_status'],
                );
            }
            // print_r($arr);exit;
        }

        $arr1 = array();
        if (count($data1) > 0) {
            for ($i=0; $i < count($data1); $i++) { 

                $countryCondition = array("id" => $data1[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (count($dataRow) > 0) {
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data1[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (count($dataRow1) > 0) {
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data1[$i]['city']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (count($dataRow1) > 0) {
                    $city_name   = $dataRow1->city_name;
                }else{
                    $city_name   = '';
                }

                $arr1[] = array(
                    "booking_id"        => $data1[$i]['booking_id'],
                    "order_id"          => $data1[$i]['order_id'],
                    "name"              => $data1[$i]['first_name'].' '.$data1[$i]['last_name'],
                    "email"             => $data1[$i]['email'],
                    "mobile"            => $data1[$i]['mobile'],
                    "address"           => $data1[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data1[$i]['pincode'],
                    "total_price"       => $data1[$i]['total_price'],
                    "quantity"          => $data1[$i]['quantity'],
                    "payment_id"        => $data1[$i]['payment_id'],
                    "payment_type"      => $data1[$i]['payment_type'],
                    "booking_date"      => $data1[$i]['created_at'],
                    "payment_status"    => $data1[$i]['payment_status'],
                );
            }
            // print_r($arr);exit;
        }
        $arr2 = array();
        if (count($data2) > 0) {
            for ($i=0; $i < count($data2); $i++) { 
                
                $countryCondition = array("id" => $data2[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (count($dataRow) > 0) {
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data2[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (count($dataRow1) > 0) {
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data2[$i]['city']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (count($dataRow1) > 0) {
                    $city_name   = $dataRow1->city_name;
                }else{
                    $city_name   = '';
                }

                $arr2[] = array(
                    "booking_id"        => $data2[$i]['booking_id'],
                    "order_id"          => $data2[$i]['order_id'],
                    "name"              => $data2[$i]['first_name'].' '.$data[$i]['last_name'],
                    "email"             => $data2[$i]['email'],
                    "mobile"            => $data2[$i]['mobile'],
                    "address"           => $data2[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data2[$i]['pincode'],
                    "total_price"       => $data2[$i]['total_price'],
                    "quantity"          => $data2[$i]['quantity'],
                    "payment_id"        => $data2[$i]['payment_id'],
                    "payment_type"      => $data2[$i]['payment_type'],
                    "booking_date"      => $data2[$i]['created_at'],
                    "payment_status"    => $data2[$i]['payment_status'],
                );
            }
            // print_r($arr2);exit;
        }
        $arr3 = array();
        if (count($data3) > 0) {
            for ($i=0; $i < count($data3); $i++) { 
                
                $countryCondition = array("id" => $data3[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (count($dataRow) > 0) {
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data3[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (count($dataRow1) > 0) {
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data3[$i]['city']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (count($dataRow1) > 0) {
                    $city_name   = $dataRow1->city_name;
                }else{
                    $city_name   = '';
                }

                $arr3[] = array(
                    "booking_id"        => $data3[$i]['booking_id'],
                    "order_id"          => $data3[$i]['order_id'],
                    "name"              => $data3[$i]['first_name'].' '.$data3[$i]['last_name'],
                    "email"             => $data3[$i]['email'],
                    "mobile"            => $data3[$i]['mobile'],
                    "address"           => $data3[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data3[$i]['pincode'],
                    "total_price"       => $data3[$i]['total_price'],
                    "quantity"          => $data3[$i]['quantity'],
                    "payment_id"        => $data3[$i]['payment_id'],
                    "payment_type"      => $data3[$i]['payment_type'],
                    "booking_date"      => $data3[$i]['created_at'],
                    "payment_status"    => $data3[$i]['payment_status'],
                );
            }
            // print_r($arr);exit;
        }
        $arr4 = array();
        if (count($data4) > 0) {
            for ($i=0; $i < count($data4); $i++) { 
                
                $countryCondition = array("id" => $data4[$i]['country']);
                $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                if (count($dataRow) > 0) {
                    $country_name   = $dataRow->country_name;
                }else{
                    $country_name   = '';
                }
                
                $stateCondition = array("id" => $data4[$i]['state']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                if (count($dataRow1) > 0) {
                    $state_name   = $dataRow1->state_name;
                }else{
                    $state_name   = '';
                }

                $cityCondition = array("id" => $data4[$i]['city']);
                $dataRow1 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                if (count($dataRow1) > 0) {
                    $city_name   = $dataRow1->city_name;
                }else{
                    $city_name   = '';
                }

                $arr4[] = array(
                    "booking_id"        => $data4[$i]['booking_id'],
                    "order_id"          => $data4[$i]['order_id'],
                    "name"              => $data4[$i]['first_name'].' '.$data4[$i]['last_name'],
                    "email"             => $data4[$i]['email'],
                    "mobile"            => $data4[$i]['mobile'],
                    "address"           => $data4[$i]['address'],
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "pincode"           => $data4[$i]['pincode'],
                    "total_price"       => $data4[$i]['total_price'],
                    "quantity"          => $data4[$i]['quantity'],
                    "payment_id"        => $data4[$i]['payment_id'],
                    "payment_type"      => $data4[$i]['payment_type'],
                    "booking_date"      => $data4[$i]['created_at'],
                    "payment_status"      => $data4[$i]['payment_status'],
                );
            }
            // print_r($arr);exit;
        }
        if (empty($arr)) {
            $arr = array();
        }
        if (empty($arr1)) {
            $arr1 = array();
        }
        if (empty($arr2)) {
            $arr2 = array();
        }
        if (empty($arr3)) {
            $arr3 = array();
        }
        if (empty($arr4)) {
            $arr4 = array();
        }
        $parent_data['pending'] = $arr;
        $parent_data['complete']= $arr1;
        $parent_data['cancel']  = $arr2;
        $parent_data['return']  = $arr3;
        $parent_data['dispatch']= $arr4;
        $this->load->view('admin/booking/future_booking',$parent_data);
        $this->load->view('admin/common_files/footer');
    }
    public function filter_past_booking_history()
    {
        $payment_status = $this->input->post('status');
        $start          = $this->input->post('start');
        $end            = $this->input->post('end');
        if ($payment_status == 1) {
            $condition = array(
                "payment_status" => 1,
                "created_at>="  => $start,
                "created_at<="  => $end
            );
            $data1      = $this->CommonModel->selectResultDataByCondition($condition,'tbl_booking');
            $arr = array();
            if (count($data1) > 0) {
                for ($i=0; $i < count($data1); $i++) { 

                    $countryCondition = array("id" => $data1[$i]['country']);
                    $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                    if (!empty($dataRow)) {
                        $country_name   = $dataRow->country_name;
                    }else{
                        $country_name   = '';
                    }
                    
                    $stateCondition = array("id" => $data1[$i]['state']);
                    $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                    if (!empty($dataRow1)) {
                        $state_name   = $dataRow1->state_name;
                    }else{
                        $state_name   = '';
                    }

                    $cityCondition = array("id" => $data1[$i]['city']);
                    $dataRow2 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                    if (!empty($dataRow2)) {
                        $city_name   = $dataRow2->city_name;
                    }else{
                        $city_name   = '';
                    }
                    
                    $select = '<select class="form-control" onchange="changeStatus(this.value,'.$data1[$i]["booking_id"].'); " >
                                    <option value="0">Pending</option>
                                    <option value="2">Dispatch</option>
                                    <option value="1">Complete</option>
                                    <option value="3">Cancel</option>
                                    <option value="4">Return</option>
                                </select>';

                    $arr[] = array(
                        "booking_id"        => $data1[$i]['booking_id'],
                        "order_id"          => $data1[$i]['order_id'],
                        "name"              => $data1[$i]['first_name'].' '.$data1[$i]['last_name'],
                        "email"             => $data1[$i]['email'],
                        "mobile"            => $data1[$i]['mobile'],
                        "address"           => $data1[$i]['address'],
                        "country"           => $country_name,
                        "state"             => $state_name,
                        "city"              => $city_name,
                        "change_status"     => $select,
                        "pincode"           => $data1[$i]['pincode'],
                        "total_price"       => $data1[$i]['total_price'],
                        "quantity"          => $data1[$i]['quantity'],
                        "payment_id"        => $data1[$i]['payment_id'],
                        "payment_type"      => $data1[$i]['payment_type'],
                        "booking_date"      => $data1[$i]['created_at'],
                        "payment_status"    => $data1[$i]['payment_status'],
                    );
                }
                // print_r($arr1);exit;
            }
        }else if ($payment_status == 0) {
            $condition = array(
                "payment_status" => 0,
                "created_at>="  => $start,
                "created_at<="  => $end
            );
            $data       = $this->CommonModel->selectResultDataByCondition($condition,'tbl_booking'); 
            $arr = array();
            if (count($data) > 0) {
                for ($i=0; $i < count($data); $i++) { 
                
                    $countryCondition = array("id" => $data[$i]['country']);
                    $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                    if (!empty($dataRow)) {
                        $country_name   = $dataRow->country_name;
                    }else{
                        $country_name   = '';
                    }
                    
                    $stateCondition = array("id" => $data[$i]['state']);
                    $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                    if (!empty($dataRow1)) {
                        $state_name   = $dataRow1->state_name;
                    }else{
                        $state_name   = '';
                    }

                    $cityCondition = array("id" => $data[$i]['city']);
                    $dataRow2 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                    if (!empty($dataRow2)) {
                        $city_name   = $dataRow2->city_name;
                    }else{
                        $city_name   = '';
                    }

                    $select = '<select class="form-control" onchange="changeStatus(this.value,'.$data[$i]["booking_id"].'); " >
                                    <option value="0">Pending</option>
                                    <option value="2">Dispatch</option>
                                    <option value="1">Complete</option>
                                    <option value="3">Cancel</option>
                                    <option value="4">Return</option>
                                </select>';
                    $arr[] = array(
                        "booking_id"        => $data[$i]['booking_id'],
                        "order_id"          => $data[$i]['order_id'],
                        "name"              => $data[$i]['first_name'].' '.$data[$i]['last_name'],
                        "email"             => $data[$i]['email'],
                        "mobile"            => $data[$i]['mobile'],
                        "address"           => $data[$i]['address'],
                        "country"           => $country_name,
                        "state"             => $state_name,
                        "city"              => $city_name,
                        "change_status"     => $select,
                        "pincode"           => $data[$i]['pincode'],
                        "total_price"       => $data[$i]['total_price'],
                        "quantity"          => $data[$i]['quantity'],
                        "payment_id"        => $data[$i]['payment_id'],
                        "payment_type"      => $data[$i]['payment_type'],
                        "booking_date"      => $data[$i]['created_at'],
                        "payment_status"    => $data[$i]['payment_status'],
                    );
                }
                // print_r($arr);exit;
            }
        }else if ($payment_status == 2) {
            $condition = array(
                "payment_status" => 2,
                "created_at>="  => $start,
                "created_at<="  => $end
            );
            $data2       = $this->CommonModel->selectResultDataByCondition($condition,'tbl_booking'); 
            $arr = array();
            if (count($data2) > 0) {
                for ($i=0; $i < count($data2); $i++) { 
                
                    $countryCondition = array("id" => $data2[$i]['country']);
                    $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                    if (!empty($dataRow)) {
                        $country_name   = $dataRow->country_name;
                    }else{
                        $country_name   = '';
                    }
                    
                    $stateCondition = array("id" => $data2[$i]['state']);
                    $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                    if (!empty($dataRow1)) {
                        $state_name   = $dataRow1->state_name;
                    }else{
                        $state_name   = '';
                    }

                    $cityCondition = array("id" => $data2[$i]['city']);
                    $dataRow2 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                    if (!empty($dataRow2)) {
                        $city_name   = $dataRow2->city_name;
                    }else{
                        $city_name   = '';
                    }
                    $select = '<select class="form-control" onchange="changeStatus(this.value,'.$data2[$i]["booking_id"].'); " >
                                    <option value="0">Pending</option>
                                    <option value="2">Dispatch</option>
                                    <option value="1">Complete</option>
                                    <option value="3">Cancel</option>
                                    <option value="4">Return</option>
                                </select>';
                    $arr[] = array(
                        "booking_id"        => $data2[$i]['booking_id'],
                        "order_id"          => $data2[$i]['order_id'],
                        "name"              => $data2[$i]['first_name'].' '.$data[$i]['last_name'],
                        "email"             => $data2[$i]['email'],
                        "mobile"            => $data2[$i]['mobile'],
                        "address"           => $data2[$i]['address'],
                        "country"           => $country_name,
                        "state"             => $state_name,
                        "city"              => $city_name,
                        "change_status"     => $select,
                        "pincode"           => $data2[$i]['pincode'],
                        "total_price"       => $data2[$i]['total_price'],
                        "quantity"          => $data2[$i]['quantity'],
                        "payment_id"        => $data2[$i]['payment_id'],
                        "payment_type"      => $data2[$i]['payment_type'],
                        "booking_date"      => $data2[$i]['created_at'],
                        "payment_status"    => $data2[$i]['payment_status'],
                    );
                }
                // print_r($arr);exit;
            }
        }else if ($payment_status == 3) {
            $condition = array(
                "payment_status" => 3,
                "created_at>="  => $start,
                "created_at<="  => $end
            );
            $data3       = $this->CommonModel->selectResultDataByCondition($condition,'tbl_booking'); 
            $arr = array();
            if (count($data3) > 0) {
                for ($i=0; $i < count($data3); $i++) { 
                
                    $countryCondition = array("id" => $data3[$i]['country']);
                    $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                    if (!empty($dataRow)) {
                        $country_name   = $dataRow->country_name;
                    }else{
                        $country_name   = '';
                    }
                    
                    $stateCondition = array("id" => $data3[$i]['state']);
                    $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                    if (!empty($dataRow1)) {
                        $state_name   = $dataRow1->state_name;
                    }else{
                        $state_name   = '';
                    }

                    $cityCondition = array("id" => $data3[$i]['city']);
                    $dataRow2 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                    if (!empty($dataRow2)) {
                        $city_name   = $dataRow2->city_name;
                    }else{
                        $city_name   = '';
                    }
                    $select = '<select class="form-control" onchange="changeStatus(this.value,'.$data3[$i]["booking_id"].'); " >
                                    <option value="0">Pending</option>
                                    <option value="2">Dispatch</option>
                                    <option value="1">Complete</option>
                                    <option value="3">Cancel</option>
                                    <option value="4">Return</option>
                                </select>';
                    $arr[] = array(
                        "booking_id"        => $data3[$i]['booking_id'],
                        "order_id"          => $data3[$i]['order_id'],
                        "name"              => $data3[$i]['first_name'].' '.$data3[$i]['last_name'],
                        "email"             => $data3[$i]['email'],
                        "mobile"            => $data3[$i]['mobile'],
                        "address"           => $data3[$i]['address'],
                        "country"           => $country_name,
                        "state"             => $state_name,
                        "city"              => $city_name,
                        "change_status"     => $select,
                        "pincode"           => $data3[$i]['pincode'],
                        "total_price"       => $data3[$i]['total_price'],
                        "quantity"          => $data3[$i]['quantity'],
                        "payment_id"        => $data3[$i]['payment_id'],
                        "payment_type"      => $data3[$i]['payment_type'],
                        "booking_date"      => $data3[$i]['created_at'],
                        "payment_status"    => $data3[$i]['payment_status'],
                    );
                }
                // print_r($arr);exit;
            }
        }else{
            $condition = array(
                "payment_status" => 4,
                "created_at>="  => $start,
                "created_at<="  => $end
            );
            $data4      = $this->CommonModel->selectResultDataByCondition($condition,'tbl_booking'); 
            $arr = array();
            if (count($data4) > 0) {
                for ($i=0; $i < count($data4); $i++) { 
                
                    $countryCondition = array("id" => $data4[$i]['country']);
                    $dataRow = $this->CommonModel->selectRowDataByCondition($countryCondition,'country');
                    if (!empty($dataRow)) {
                        $country_name   = $dataRow->country_name;
                    }else{
                        $country_name   = '';
                    }
                    
                    $stateCondition = array("id" => $data4[$i]['state']);
                    $dataRow1 = $this->CommonModel->selectRowDataByCondition($stateCondition,'states');
                    if (!empty($dataRow1)) {
                        $state_name   = $dataRow1->state_name;
                    }else{
                        $state_name   = '';
                    }

                    $cityCondition = array("id" => $data4[$i]['city']);
                    $dataRow2 = $this->CommonModel->selectRowDataByCondition($cityCondition,'cities');
                    if (!empty($dataRow2)) {
                        $city_name   = $dataRow2->city_name;
                    }else{
                        $city_name   = '';
                    }

                    $select = '<select class="form-control" onchange="changeStatus(this.value,'.$data4[$i]["booking_id"].'); " >
                                    <option value="0">Pending</option>
                                    <option value="2">Dispatch</option>
                                    <option value="1">Complete</option>
                                    <option value="3">Cancel</option>
                                    <option value="4">Return</option>
                                </select>';

                    $arr[] = array(
                        "booking_id"        => $data4[$i]['booking_id'],
                        "order_id"          => $data4[$i]['order_id'],
                        "name"              => $data4[$i]['first_name'].' '.$data4[$i]['last_name'],
                        "email"             => $data4[$i]['email'],
                        "mobile"            => $data4[$i]['mobile'],
                        "address"           => $data4[$i]['address'],
                        "country"           => $country_name,
                        "state"             => $state_name,
                        "city"              => $city_name,
                        "change_status"     => $select,
                        "pincode"           => $data4[$i]['pincode'],
                        "total_price"       => $data4[$i]['total_price'],
                        "quantity"          => $data4[$i]['quantity'],
                        "payment_id"        => $data4[$i]['payment_id'],
                        "payment_type"      => $data4[$i]['payment_type'],
                        "booking_date"      => $data4[$i]['created_at'],
                        "payment_status"      => $data4[$i]['payment_status'],
                    );
                }
                // print_r($arr2);exit;
            }
        }
        echo json_encode($arr); 
    }

    public function changeStatus()
    {
        $data = array (
                        "payment_status" => $this->input->post('payment_status'),
                    );

        $condition  = array (
                                "booking_id" => $this->input->post('booking_id'),
                            );

        $result = $this->CommonModel->updateRowByCondition($condition,'tbl_booking',$data);
        if ($result) {
            echo "1";
        }else{
            echo "0";
        }
    }
}
