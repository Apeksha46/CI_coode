<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $sessionValue = $this->_adminLoginCheck();
	}
    public function do_resize($file_name){
        
        $this->load->library('image_lib');
            

            $config['image_library'] = 'gd2';
            $config['source_image'] = './product/'.$file_name;
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width']     = 100;
            $config['height']   = 100;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
             
            $data = $this->upload->data(); // Returns information about your uploaded file.
            $thumbnail = $data['raw_name'].'_thumb'.$data['file_ext']; // Here it is
            unlink('./product/'.$file_name);

            return $thumbnail;
    }
    //show products
    public function index()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $Data['tableData'] = $this->CommonModel->productData('product','product_id');
        // print_r($Data['tableData']);exit();
        $this->load->view('admin/product/product',$Data);
        $this->load->view('admin/common_files/footer');
    }

    //Add product page
    public function add_product()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array(
            "seller_id" => 0
        );
        $catData['tableData'] = $this->CommonModel->selectResultDataByCondition($condition,'category');
        // $catData['tableData'] = $this->CommonModel->selectResultData('category','category_id');
        $this->load->view('admin/product/add_product',$catData);
        $this->load->view('admin/common_files/footer');
    }

    //Edit product page
	public function edit_product()
	{
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $condition = array("product_id" => $this->uri->segment(4));
        $productData['tableData'] = $this->CommonModel->selectRowDataByCondition($condition,'product');
        $condition1 = array("product_id" => $this->uri->segment(4),"is_available" => '1');
        // $productData['sizeData'] = $this->CommonModel->selectResultDataByCondition($condition1,'sizes');
        $productData['colorData'] = $this->CommonModel->selectResultDataByCondition($condition1,'color');
        $productData['imageData'] = $this->CommonModel->selectResultDataByCondition($condition,'product_image');
        $catCondition = array("category_id" => $productData['tableData']->category_id);
        $productData['subCatData'] = $this->CommonModel->selectResultDataByCondition($catCondition,'sub_category');
        // print_r($productData['subCatData']);exit;
        $session_value = $this->session->userdata('ses_logged_in');
        $condition = array(
            "seller_id" => 0
        );
        $productData['catData'] = $this->CommonModel->selectResultDataByCondition($condition,'category');
        // $productData['catData'] = $this->CommonModel->selectResultData('category','category_id');
        // print_r($aboutUsData);exit;
        $this->load->view('admin/product/edit_product',$productData);
        $this->load->view('admin/common_files/footer');
	}

    public function insert_product1()
    {

        $product_id = 1;

        //multiple image insert into db
       
      
        $filesCount = count($_FILES['images']['name']);
           for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['images']['name'][$i];
                $_FILES['file']['type']     = $_FILES['images']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['images']['error'][$i];
                $_FILES['file']['size']     = $_FILES['images']['size'][$i];
                
                // File upload configuration
                $uploadPath = './product/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['encrypt_name'] = TRUE;
                
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                

                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $fileData = $this->upload->data();
                  

                    $result = $this->do_resize($fileData['file_name']);
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                }
            }

        // print_r($uploadData);
        // if(!empty($uploadData)){
        //     // Insert files data into the database
        //     $insert = $this->file->insert($uploadData);
            
        //     // Upload status message
        //     $statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
        //     $this->session->set_flashdata('statusMsg',$statusMsg);
        // }        
    }

    //Insert product.
    public function insert_product()
    {
        // print_r($this->input->post('product_description'));exit;
        // if ($this->input->post('category_id') == '0') {
        //     $this->session->set_flashdata('error', 'Please select Category ');
        //     redirect('admin/Product/add_product');
        // }
        
        // if ($this->input->post('type') == '0') {
        //     $this->session->set_flashdata('error', 'Please select Category Type ');
        //     redirect('admin/Product/add_product');
        // }
        // if ($this->input->post('city') == '0') {
        //     $this->session->set_flashdata('error', 'Please select City ');
        //     redirect('admin/Product/add_product');
        // }
        
        if ($this->input->post('product_name') == '') {
            $this->session->set_flashdata('error', 'Please enter Product Name ');
            redirect('admin/Product/add_product');
        }
        if (empty($this->input->post('product_description'))) {
            $this->session->set_flashdata('error', 'Please enter Product Description');
            // print_r($this->session->flashdata());
            redirect('admin/Product/add_product');
        }
        if (empty($this->input->post('price'))) {
            $this->session->set_flashdata('error', 'Please enter Price');
            redirect('admin/Product/add_product');
        }
        if (empty($this->input->post('gst'))) {
            $this->session->set_flashdata('error', 'Please enter GST');
            redirect('admin/Product/add_product');
        }
        if (empty($this->input->post('product_quantity'))) {
            $this->session->set_flashdata('error', 'Please enter Product Quantity');
            redirect('admin/Product/add_product');
        }
        $session_value = $this->session->userdata('ses_logged_in');
        if ($this->input->post('sub_category_id') == '' ) {
            $sub = '0';
        }else{
            $sub = $this->input->post('sub_category_id');
        }
        
        $data = array(
            "admin_id"              => $session_value['admin_id'],
            "product_name"          => $this->input->post('product_name'),
            "category_id"           => $this->input->post('category_id'),
            "product_available_in_city"=> $this->input->post('city'),
            "sub_category_id"       => $sub,
            "type"                  => 'rent',
            "rent_price_per_km"     => $this->input->post('rent_price_per_km'),
            "product_description"   => $this->input->post('product_description'),
            "price"                 => $this->input->post('price'),
            "gst"                   => $this->input->post('gst'),
            "remaining_qty"         => $this->input->post('product_quantity'),
            "product_quantity"      => $this->input->post('product_quantity'),
            "show_name"             => '0',
            "created_at"            => date('Y-m-d H:i:s')
        );
        
        // print_r($data);exit;
        $addData = $this->CommonModel->insertData($data,'product');  
        if ($addData) {
            $product_id = $this->db->insert_id();

            //multiple image insert into db
            $filesCount = count($_FILES['images']['name']);
            for($i = 0; $i < $filesCount; $i++){
                
                $targetFilePath = './product/' . $_FILES['images']['name'][$i];
                if(move_uploaded_file($_FILES["images"]["tmp_name"][$i], $targetFilePath)){
                    $uploadData = array(
                        "product_id" => $product_id,
                        "priority"   => $this->input->post('priority')[$i],
                        "image"      => $_FILES['images']['name'][$i]
                    );
                    $this->CommonModel->insertData($uploadData,'product_image');
                }
            }
            $this->session->set_flashdata('success','Product add Successfully');
            redirect('admin/Product/add_product');
        }else{
            $this->session->set_flashdata('error','Product not added');
            redirect('admin/Product/add_product');
        }
    }



    //Update product.
    public function update_product()
    {
        // if ($this->input->post('category_id') == '0') {
        //     $this->session->set_flashdata('error', 'Please select Category ');
        //     redirect('admin/Product/edit_Product/'.$this->input->post('product_id').'/'.$this->input->post('product_quantity'));
        // }
        
        // if ($this->input->post('type') == '0') {
        //     $this->session->set_flashdata('error', 'Please select Category Type ');
        //     redirect('admin/Product/edit_Product/'.$this->input->post('product_id').'/'.$this->input->post('product_quantity'));
        // }
        // if ($this->input->post('city') == '0') {
        //     $this->session->set_flashdata('error', 'Please select City ');
        //     redirect('admin/Product/edit_Product/'.$this->input->post('product_id').'/'.$this->input->post('product_quantity'));
        // }
        if ($this->input->post('product_name') == '') {
            $this->session->set_flashdata('error', 'Please enter Product Name ');
            redirect('admin/Product/edit_Product/'.$this->input->post('product_id').'/'.$this->input->post('product_quantity'));
        }
        
        if ($this->input->post('product_description') == '') {
            $this->session->set_flashdata('error', 'Please enter Product Description');
            redirect('admin/Product/edit_Product/'.$this->input->post('product_id').'/'.$this->input->post('product_quantity'));
        }
        if ($this->input->post('price') == '') {
            $this->session->set_flashdata('error', 'Please enter Price');
            redirect('admin/Product/edit_Product/'.$this->input->post('product_id').'/'.$this->input->post('product_quantity'));
        }
        if ($this->input->post('gst') == '') {
            $this->session->set_flashdata('error', 'Please enter GST');
            redirect('admin/Product/edit_Product/'.$this->input->post('product_id').'/'.$this->input->post('product_quantity'));
        }
        if ($this->input->post('product_quantity') == '') {
            $this->session->set_flashdata('error', 'Please enter Product Quantity');
            redirect('admin/Product/edit_Product/'.$this->input->post('product_id').'/'.$this->input->post('product_quantity'));
        }
        $condition = array(
            "product_id" => $this->input->post('product_id')
        );
        $productRecord = $this->CommonModel->selectRowDataByCondition($condition,'product');  
        if ($productRecord) {
            $remaining_qty      = $productRecord->remaining_qty;
            $product_quantity   = $productRecord->product_quantity;
        }
        if ($this->input->post('product_quantity') >= $product_quantity) {
            $qty_minus  = (int)$this->input->post('product_quantity') - (int)$product_quantity;
            $qty_sum    = (int)$product_quantity + (int)$qty_minus;
            $rem_sum    = (int)$remaining_qty + (int)$qty_minus;
        }else{
            $qty_minus  = (int)$product_quantity - (int)$this->input->post('product_quantity') ;
            $qty_sum    = (int)$product_quantity - (int)$qty_minus;
            $rem_sum    = (int)$remaining_qty - (int)$qty_minus;
        }

        $config['upload_path']   = './product/'; 
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);
            $data = array(
                "product_name"          => $this->input->post('product_name'),
                "category_id"           => $this->input->post('category_id'),
                "product_available_in_city"=> $this->input->post('city'),
                "type"                  => 'rent',
                "rent_price_per_km"     => $this->input->post('rent_price_per_km'),
                "product_description"   => $this->input->post('product_description'),
                "price"                 => $this->input->post('price'),
                "gst"                   => $this->input->post('gst'),
                "product_quantity"      => $qty_sum,
                "remaining_qty"         => $rem_sum,
                "show_name"             => '0',
                "created_at"            => date('Y-m-d H:i:s')
            );
        $updateData = $this->CommonModel->updateRowByCondition($condition,'product',$data);  
        if ($updateData) {
            $filesCount = count($_FILES['images']['name']);
            for($i = 0; $i < $filesCount; $i++){
                
                $targetFilePath = './product/' . $_FILES['images']['name'][$i];
                if(move_uploaded_file($_FILES["images"]["tmp_name"][$i], $targetFilePath)){
                    $uploadData = array(
                        "product_id" => $this->input->post('product_id'),
                        "priority"   => $this->input->post('priority')[$i],
                        "image"      => $_FILES['images']['name'][$i]
                    );
                    $this->CommonModel->insertData($uploadData,'product_image');
                }
            }
            $this->session->set_flashdata('success','Update Successfully');
            redirect('admin/Product/');
        }else{
            $this->session->set_flashdata('error','Not Update');
            redirect('admin/Product/edit_Product/'.$this->input->post('product_id').'/'.$this->input->post('product_quantity'));
        }
    }

    
    //Delete product.
    public function delete_product()
    {
        $condition = array(
            "product_id" => $this->input->post('product_id')
        );
        $productData = $this->CommonModel->delete($condition,'product');  
        if ($productData) {
            echo "1";
        }else{
            echo "0";
        }
    }

    //color list
    public function color_list()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $productData['colorData'] = $this->CommonModel->colorData();
        $this->load->view('admin/product/color',$productData);
        $this->load->view('admin/common_files/footer');
    }

    public function addColorSize(){
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $arr['productData'] = $this->CommonModel->selectAllResultData('product');
        $this->load->view('admin/product/addColorSize',$arr);
        $this->load->view('admin/common_files/footer');
    }

    //Insert product.
    public function manage_stock()
    {
        if ($this->input->post('product_id') == 0) {
            $this->session->set_flashdata('error', 'Please select Product ');
            redirect('admin/Product/addColorSize');
        }
        $product_id = explode(',', $this->input->post('product_id'));
        $sum = 0;
        $colorQtyCount = 0;
        $pData = $this->CommonModel->selectResultDataByCondition(array("product_id" => $product_id[0]),'color');  
        // print_r($pData);exit;
        if (count($pData) > 0) {
            for($jj = 0; $jj < count($pData); $jj++){
                $colorQtyCount = (int)$pData[$jj]['total_qty'] + (int)$colorQtyCount;
            }
        }else{
            $colorQtyCount = 0;
        }
        for($j = 0; $j < count($this->input->post('qty')); $j++){
            // echo "<pre>";
            // echo "J = ".$j .' qty = '.$this->input->post('qty')[$j];
            if(!empty($this->input->post('size_name')[$j])){
                $sum = (int)$sum + (int)$this->input->post('qty')[$j];
            }
        }
        $totalQty = (int)$colorQtyCount + (int)$sum;
        // echo "total qty is - ".$product_id[1]." color qty id = ".$colorQtyCount.' and sum of qty is = '.$sum." totalQty = ".(int)$totalQty;
        // exit;
        // echo "Product qty = ".$product_id[1] . ' $totalqty = '.$totalQty;
        // echo ($totalQty > $product_id[1]);
        // exit;
        if ($totalQty > $product_id[1])
        {
            $this->session->set_flashdata('error', 'Quantity exceded compare to your product total quantity');
            redirect('admin/Product/addColorSize');
        }
        $qty_sum = '';
        $session_value = $this->session->userdata('ses_logged_in');
        if(count($this->input->post('qty')) == 0){
            $qty_sum = array_sum($this->input->post('qty'));
        }else{
            $qty_sum = $product_id[1];
        }
        $data = array(
            "color"         => $this->input->post('color'),
            "total_qty"     => array_sum($this->input->post('qty')),
            "remaining_qty" => array_sum($this->input->post('qty')),
            "used_qty"      => 0,
            "is_available"  => '1',
            "product_id"    => $product_id[0]
        );
        
        // print_r($data);exit;
        $addData = $this->CommonModel->insertData($data,'color');  
        if ($addData) {
            $color_id = $this->db->insert_id();

            $size_name = $qty = 0 ;

            // print_r($this->input->post('size_name'));exit;
            for($i = 0; $i < count($this->input->post('size_name')); $i++){
                if(!empty($this->input->post('size_name')[$i])){
                    $maintain_data      = array(
                        "product_id"    => $product_id[0],
                        "color_id"      => $color_id,
                        "size_name"     => $this->input->post('size_name')[$i],
                        "qty"           => $this->input->post('qty')[$i],
                        "remaining_qty" => $this->input->post('qty')[$i],
                        "used_qty"      => '0',
                        "is_available"  => '1'
                    );
                    $maintainData = $this->CommonModel->insertData($maintain_data,'size'); 
                }
                // print_r($data);exit;    
            }

            $this->session->set_flashdata('success','Successfully added');
            redirect('admin/Product/addColorSize/');
        }else{
            $this->session->set_flashdata('error','Something goes wrong');
            redirect('admin/Product/addColorSize');
            // redirect('admin/Product/addColorSize');
        }
    }

    public function editColorSize(){
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $color_id  = $this->uri->segment(4);
        $condition = array(
            "color_id" => $this->uri->segment(4)
        );
        $productData['tableData'] = $this->CommonModel->selectRowDataByCondition($condition,'color');

        $productData['sizeData'] = $this->CommonModel->selectResultDataByCondition($condition,'size');
        $productData['productData'] = $this->CommonModel->selectAllResultData('product');

        $this->load->view('admin/product/editColorSize',$productData);
        $this->load->view('admin/common_files/footer');
    }

    //update product for maintain stock
    public function update_manage_stock()
    {
        $product_id = explode(',', $this->input->post('product_id'));
        $sum = 0;
        $colorQtyCount = 0;
        $pData = $this->CommonModel->selectResultDataByCondition(array("product_id" => $product_id[0]),'color');  
        // print_r($pData);exit;
        if (count($pData) > 0) {
            for($jj = 0; $jj < count($pData); $jj++){
                $colorQtyCount = (int)$pData[$jj]['total_qty'] + (int)$colorQtyCount;
            }
        }else{
            $colorQtyCount = 0;
        }
        for($j = 0; $j < count($this->input->post('qty')); $j++){
            // echo "<pre>";
            // echo "J = ".$j .' qty = '.$this->input->post('qty')[$j];
            if(!empty($this->input->post('size_name')[$i])){
                $sum = (int)$sum + (int)$this->input->post('qty')[$j];
            }
        }
        $totalQty = (int)$colorQtyCount + (int)$sum;
        // echo "total qty is - ".$product_id[1]." color qty id = ".$colorQtyCount.' and sum of qty is = '.$sum." totalQty = ".(int)$totalQty;
        // exit;
        // echo "Product qty = ".$product_id[1] . ' $totalqty = '.$totalQty;
        // echo ($totalQty > $product_id[1]);
        // exit;
        if ($totalQty > $product_id[1])
        {
            $this->session->set_flashdata('error', 'Quantity exceded compare to your product total quantity');
            redirect('admin/Product/addColorSize');
        }
        if (count($this->input->post('qty')) > 0) {
            $sum = array_sum($this->input->post('qty'));
        }else{
            $sum = 0;
        }
        $add = array_sum($this->input->post('qtyy'));
        $totalQtyy = (int)$sum + (int)$add;
        $condition = array(
            "color_id" => $this->input->post('color_id')
        );
        $data = array(
            "color"         => $this->input->post('color'),
            "total_qty"     => $totalQtyy,
            "remaining_qty" => $totalQtyy,
            "used_qty"      => '0',
            "is_available"  => '1',
            "product_id"    => $product_id[0]
        );
        $updateData = $this->CommonModel->updateRowByCondition($condition,'color',$data);  
        if ($updateData) {
            for($i = 0; $i < count($this->input->post('size_name')); $i++){
                if (!empty($this->input->post('size_name')[$i])) {
                    $maintain_data      = array(
                        "product_id"    => $product_id[0],
                        "color_id"      => $this->input->post('color_id'),
                        "size_name"     => $this->input->post('size_name')[$i],
                        "qty"           => $this->input->post('qty')[$i],
                        "remaining_qty" => $this->input->post('qty')[$i],
                        "used_qty"      => '0',
                        "is_available"  => '1'
                    );
                    // print_r($data);exit;    
                    $maintainData = $this->CommonModel->insertData($maintain_data,'size'); 
                }
            }

            $this->session->set_flashdata('success','Update Successfully');
            redirect('admin/Product/color_list');
        }else{
            $this->session->set_flashdata('error','Not Update');
            redirect('admin/Product/editColorSize/'.$this->input->post('color_id'));
        }
    }
    //Delete size.
    public function delete_size()
    {
        $condition = array(
            "size_id" => $this->input->post('sizes_id')
        );
        $size = $this->CommonModel->selectRowDataByCondition($condition,'size'); 
        if ($size) {
            $color_id       = $size->color_id;
            $qty            = $size->qty;
            $remaining_qty  = $size->remaining_qty;
        } 
        $color  = $this->CommonModel->selectRowDataByCondition(array("color_id" => $color_id),'color');
        $total  = (int)$color->total_qty - (int)$qty;
        $remain = (int)$color->remaining_qty - (int)$remaining_qty;
        $data   = array(
            "total_qty"     => $total,
            "remaining_qty" => $remain
        );
        $updateData = $this->CommonModel->updateRowByCondition(array("color_id" => $color_id),'color',$data); 
        $sizeData = $this->CommonModel->delete($condition,'size');  
        if ($sizeData) {
            echo "1";
        }else{
            echo "0";
        }
    }
    //edit size
    public function edit_size()
    {
        $updateCondition = array(
            "size_id" => $this->input->post('size_id')
        );
        $data = array(
            "size_name"     => $this->input->post('size_name'),
            "remaining_qty" => $this->input->post('remaining_qty')
        );
        // print_r($data);
        $updateData = $this->CommonModel->updateRowByCondition($updateCondition,'size',$data); 
        if ($updateData) {
            echo 1;
        }else{
            echo 0;
        }
    }
    //Delete color.
    public function delete_color()
    {
        $condition = array(
            "color_id" => $this->input->post('color_id')
        );
        // print_r($condition);
        $colorData = $this->CommonModel->delete($condition,'color');  
        if ($colorData) {
            $this->CommonModel->delete($condition,'size');
            echo "1";
        }else{
            echo "0";
        }
    }
    //Delete image.
    public function delete_image()
    {
        $condition = array(
            "product_image_id" => $this->input->post('image_id')
        );
        // print_r($condition);
        $imageData = $this->CommonModel->delete($condition,'product_image');  
        if ($imageData) {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function getSubCategory(){
        $condition  = array("category_id" => $this->input->post('cat_id'));
        $subCatData = $this->CommonModel->selectResultDataByCondition($condition,'sub_category');
        if (!empty($subCatData)) {
            echo json_encode($subCatData);
        }else{
            echo "0";
        }
    }

    //filter_product
    public function filter_product()
    {
        $type = $this->input->post('type');
        if ($type == 'buy' || $type == '0') {
            $condition = array(
                "type"          => 'sell',
                "is_sale"       => '0'
            );
        }else if ($type == 'rent') {
            $condition = array(
                "type"      => 'rent',
                "is_sale"   => '0'
            );
        }else{
            $condition = array(
                "is_sale"   => '1'
            );
        }
        $product = $this->CommonModel->selectResultDataByCondition($condition,'product' );
        if ($product == FALSE) {
            echo 0;
        }else{
            $arr = array();
            $img = array();
            for ($i=0; $i < count($product); $i++) { 
                $admin_name = '';
                $admin = array("admin_id" => $product[$i]['admin_id']);
                $adminData = $this->CommonModel->selectRowDataByCondition($admin,'admin' );
                if (count($adminData) > 0) {
                    $admin_name = $this->check_value($adminData->name);
                }
                $seller_name = '';
                $seller = array("seller_id" => $product[$i]['seller_id']);
                $sellerData = $this->CommonModel->selectRowDataByCondition($seller,'seller' );
                if (count($sellerData) > 0) {
                    $seller_name = $this->check_value($sellerData->seller_first_name.' '.$sellerData->seller_last_name);
                }
                $cat_name = '';
                $cat = array("category_id" => $product[$i]['category_id']);
                $category = $this->CommonModel->selectRowDataByCondition($cat,'category' );
                if (count($category) > 0) {
                    $cat_name = $this->check_value($category->category_name);
                }
                $sub_cat = array("sub_category_id" => $product[$i]['sub_category_id']);
                $sub_category = $this->CommonModel->selectRowDataByCondition($sub_cat,'sub_category' );
                $sub_name = '';
                if (count($sub_category) > 0) {
                    $sub_name = $this->check_value($sub_category->sub_category_name);
                }
                if ($product[$i]['is_sale'] != '0') {
                    $type = '<span class="btn btn-danger">Sale</span>';
                }else if ($product[$i]['is_sale'] == '0' && $product[$i]['type'] == 'sell')
                {
                    $type = '<span class="btn btn-primary">Normal</span>';
                }else{
                    $type = '<span class="btn btn-info">Rent</span>';
                    // $type = ucfirst($product[$i]['type']);
                }
                $arr[] = array(
                    "product_id"            => $product[$i]['product_id'],
                    "product_name"          => $this->check_value($product[$i]['product_name']),
                    "seller_name"           => $seller_name,
                    "admin_name"            => $admin_name,
                    "category_name"         => $cat_name,
                    "sub_category_name"     => $sub_name,
                    "type"                  => $type,
                    // "type"                  => $this->check_value($product[$i]['type']),
                    "product_description"   => $this->check_value($product[$i]['product_description']),
                    "product_quantity"      => $this->check_value($product[$i]['product_quantity']),
                    "remaining_qty"         => $this->check_value($product[$i]['remaining_qty']),
                    "used_qty"              => $this->check_value($product[$i]['used_qty']),
                    "price"                 => $this->check_value($product[$i]['price'])
                
                );
                $img = array();
            }
            // $data = array("product_list" => $arr , "product_image" => $img);
            // $data = array_merge($arr,$img);
            echo json_encode($arr);
        }
    }
    //-----------------------//-------------------------------------//----------------------------------------------//---------

    //show Seller
    public function seller()
    {
        $this->load->view('admin/common_files/header');
        $this->load->view('admin/common_files/sidebar');
        $Data['tableData'] = $this->CommonModel->selectResultData('seller','seller_id');
        $this->load->view('admin/product/seller',$Data);
        $this->load->view('admin/common_files/footer');
    }
    
    //Accept Seller.
    public function accept_seller()
    {
        $condition = array(
            "seller_id" => $this->input->post('seller_id')
        );
        $data = array("active_status" => '1');

        // print_r($data);exit;
        $updateData = $this->CommonModel->updateRowByCondition($condition,'seller',$data);  
        if ($updateData) {
            echo "1";
        }else{
            echo "0";
        }
    }

    //Reject Seller.
    public function reject_seller()
    {
        $condition = array(
            "seller_id" => $this->input->post('seller_id')
        );
        $data = array("active_status" => '0');

        // print_r($data);exit;
        $updateData = $this->CommonModel->updateRowByCondition($condition,'seller',$data);  
        if ($updateData) {
            echo "1";
        }else{
            echo "0";
        }
    }

}
