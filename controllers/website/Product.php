
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$session_value = $this->session->userdata('web_logged_in');
        $a = $this->CommonModel->selectRowDataByCondition(array("user_id" => $session_value['id']),'user');
        if (!empty($this->session->userdata('web_logged_in'))) {
            if (!empty($a->profile)) {
                $profile = base_url().'uploads/'.$a->profile;
            }else{
                $profile = '';
            }
            $arr['id']     = $session_value['id'];
            $arr['name']   = $session_value['name'];
            $arr['email']  = $session_value['email'];
            $arr['wallet']  = $a->wallet;
            $arr['unique_package_id']  = $a->unique_package_id;
            $arr['profile']  = $profile;
            // $arr = array(
            //                "id"     => $session_value['id'],
            //                "email"  => $session_value['email'],
            //                "name"   => $session_value['name'],
            //             );
            // print_r($session_value);exit;
        }else{
             $session_value = '';
             $arr['id']     = '';
             $arr['name']   = '';
             $arr['email']  = '';
             $arr['wallet']  = '';
             $arr['unique_package_id']  = '';
             $arr['profile']  = '';
        }
		$this->load->view('website/common_files/header',$arr);

		$category_id 		= $this->uri->segment(4);
		$sub_category_id 	= $this->uri->segment(5);
		
		if (!empty($category_id)) {
			$data['sub_category']  = $this->CommonModel->selectResultDataByCondition(array("category_id" => $category_id),'sub_category');
		}else{
			$data['sub_category']  = $this->CommonModel->selectAllResultData('sub_category');
		}

	
		//CONDITION
		$where =$where2 =$where3 = '';

		
		if (!empty($this->input->post('sub_cat'))) {
			$sub_cat = implode(',', $this->input->post('sub_cat'));
			$where2 .= ' and FIND_IN_SET(sub_category_id,"'.$sub_cat.'")';
		}else{
	    	$where2 .= '';
	    }

		if(!empty($this->input->post('search')))
		{
			$where3 .= ' and LOWER(product_name) LIKE "%'.$this->input->post('search').'%" ';
		}else{
	    	$where3 .= '';
	    }

	    if (!empty($where2)) {
	    	$where .= $where2;
	    }
	    if (!empty($where3)) {
	    	$where .= $where3;
	    }
	    // echo $this->input->post('split_start_price_range');
	    // print_r($where);
	    // echo $this->input->post('split_start_price_range');exit;
	    if ((empty($this->input->post('split_start_price_range')) && empty($this->input->post('split_end_price_range')))) {
	    	if (empty($this->uri->segment(5))) {
				$condition = 'category_id = '.$category_id.'';
			}else{
				$condition = 'category_id = '.$category_id.' and sub_category_id = '. $sub_category_id.' ';
			}
	    }else{
	    	// $wheres  = explode(" and ",$where);
	    	// print_r($where);exit;
	    	if (empty($where) ) {
	    		if (empty($this->uri->segment(5))) {
		    		// ORDER BY discount_price  '.$this->input->post('sort')
					$condition = "category_id = ".$category_id." and price >= ".$this->input->post('split_start_price_range')." and price <= ".$this->input->post('split_end_price_range'). " ORDER BY price ".$this->input->post("sort");
				}else{
					$condition = 'category_id = '.$category_id.' and sub_category_id = '. $sub_category_id.' and price >= '.$this->input->post('split_start_price_range').' and price <= '.$this->input->post('split_end_price_range').'  ORDER BY price '.$this->input->post("sort");
				}
	    	}else{
	    		if (empty($this->uri->segment(5))) {
		    		// ORDER BY discount_price  '.$this->input->post('sort')
					$condition = "category_id = ".$category_id." and price >= ".$this->input->post('split_start_price_range')." and price <= ".$this->input->post('split_end_price_range'). $where." ORDER BY price ".$this->input->post("sort");
				}else{
					$condition = 'category_id = '.$category_id.' and sub_category_id = '. $sub_category_id.' and price >= '.$this->input->post('split_start_price_range').' and price <= '.$this->input->post('split_end_price_range').' '.$where.' ORDER BY price '.$this->input->post("sort")/ $where." ORDER BY price ".$this->input->post("sort");
				}
	    	}
	    	
	    }
		// print_r($condition);exit;
		//END CONDITION
        $data['product']  = $this->CommonModel->demo($condition,'product');
        foreach ($data['product'] as $key => $value) 
        {
          	$condition = array("product_id" => $value['product_id'],"priority" => 1);

         	$imageData = $this->CommonModel->selectRowDataByCondition($condition,'product_image');
         	// print_r($imageData->image);die();
         	if(!empty($imageData))
         	{
         		$product_image = base_url().'product/'.$imageData->image; 
         	}else{
         		$product_image = '';
         	}
        	$data['product'][$key]['image'] = $product_image;
        }
        // print_r($data['product']);die;
        
        $this->load->view('website/product', $data);
        $this->load->view('website/common_files/footer');
	}
}
