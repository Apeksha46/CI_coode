<header id="desktop">
         <div class=" top-header">
            <div class="container-fluid">
               <div class=" main-menu-item justify-content-end " >
                  <ul class=" rotate-icon ml-2">
                     <li class="nav-item active">
                      <?php
                          $Dataa = $this->CommonModel->selectRowDataByCondition(array('general_setting_id' => '1'),'general_setting');
                          if ($Dataa) { ?>
                            <a class="nav-link" href="tel:+91-<?php echo $Dataa->mobile; ?> ?>" ><i class="fas fa-phone"></i> Call +91-<?php echo $Dataa->mobile; ?>,</a>
                             <a class="nav-link" href="tel:<?php echo $Dataa->alt_mobile; ?>" ><!-- <i class="fas fa-phone"></i> --> <?php echo $Dataa->alt_mobile; ?>  </a>

                      <?php 
                      } 
                      ?>
                     </li>
                  </ul>

                  <ul class="align-items-center welcome-box   navbar-right d-flex justify-content-end mr-4">
                  <?php 
                    
                    if (!empty($id)) { 
                        $Dataa1 = $this->CommonModel->selectRowDataByCondition(array('user_id' => $id),'user');
                      	if ($Dataa1) { ?>
                      		<input type="hidden" id="referal_code" value="<?php echo base_url().'website/Auth/signup?id='.$Dataa1->referal_code; ?>">
                      	<?php }
                    ?>
                       <li class="nav-item">
                          <a class="nav-link" href="#" > WELCOME <?php echo $name; ?>!  </a>
                       </li>
                       <li class="nav-item">
                          <a class="nav-link" href="#" > Wallet points: <?php echo $wallet; ?>  </a>
                       </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"
                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                                if (!empty($profile)) { ?>
                                  <img src="<?php echo $profile; ?>" height="20px" width="20px">
                                <?php }else{
                                  echo "Small Bazar Account ";
                                }
                           ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="<?php echo base_url().'website1/Auth/setting'; ?>">Change Setting</a>
                          <a class="dropdown-item" href="<?php echo base_url().'website1/Auth/myAccount'; ?>">My Account</a>
                           <a class="dropdown-item" href="<?php echo base_url().'website/Auth/share_list'; ?>">Referal List</a>
                           <a href="#" class="dropdown-item" data-action="share/whatsapp/share" onclick="check()">Share Referal Code</a>
                           <a class="dropdown-item" href="<?php echo base_url().'website1/Order/index'; ?>" >  MY Order</a>
                           <a class="dropdown-item" href="<?php echo base_url().'website1/Auth/logout'; ?>">Logout</a>
                        </div>
                        </li>
                       
                    <?php } else{ ?>
                        <li class="nav-item">
                          <a class="nav-link" href="<?php echo base_url(); ?>website1/Auth/login" >  LOGIN</a>
                       </li>
                      <?php } 
                  ?>
                  <li class="nav-item add-cart my-cart ">
                      <span id="notify">
                        
                      </span>
                    <!-- </a> -->
                    <div id="ul_li">
                    </div>
                  </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="main_menu home_menu  " >
            <div class="container-fluid">
              <div class="row">
                    <div class="col-md-4 col-sm-12">

                <!--  <div class="search-bar-content">
                         <input type="text" placeholder="Search...">
                <div class="search"></div>
              </div> -->
                    </div>
                    <div class="col-md-4 col-sm-12  text-center">
                       <a class="navbar-brand text-center" href="<?php echo base_url(); ?>" data-aos="fade-up"> <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="logo" width="360px"> </a>
                    </div>
                    <div class="col-md-4 col-sm-12 ">
                       <ul class="social-network social-circle mr-5 ">

                          <li><a href="<?php  echo $Dataa->facebook; ?>" target="_blank" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                          <li><a href="<?php  echo $Dataa->twittter; ?>" target="_blank" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                          <li><a href="<?php  echo $Dataa->instagram; ?>" target="_blank" class="icoLinkedin" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>

                          <li>
                            <a href="https://api.whatsapp.com/send?phone= +91-<?php echo $Dataa->mobile; ?>" target="_blank" data-action="share/whatsapp/share"><i class="fab fa-whatsapp"></i></a>
                          </li>
                       </ul>
                    </div>
                  </div>

                
               <nav class="navbar navbar-expand-lg navbar-light row">
                  <button class="navbar-toggler" type="button" data-toggle="collapse"
                     data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                     aria-expanded="false" aria-label="Toggle navigation">
                      <i class="fas fa-ellipsis-v ml-3"></i>
                  <!--<span class="navbar-toggler-icon"></span>-->
                  </button>
                  <?php
                  $menu = $this->CommonModel->selectAllResultData('category');

                    if(!empty($menu)){
                            foreach ($menu as $keys => $values) {
                                $sub = $this->CommonModel->selectResultDataByCondition(array('category_id' => $values['category_id']),'sub_category');
                                if (count($sub) > 0) {
                                    $a = array();
                                    foreach ($sub as $key => $value) {
                                        $a[] = array(
                                                        "sub_category_id" => $value['sub_category_id'],
                                                        "sub_category_name" => $value['sub_category_name'],
                                                    );
                                    }
                                }else{
                                    $a = array();
                                }
                                // print_r($a);die;
                                $cat[] = array(
                                                    "category_id"   => $values['category_id'],
                                                    "category_name" => $values['category_name'],
                                                    "sub_menu"      => $a,
                                                );
                            }
                            // $arr['menu'] = $cat;
                        }else{
                          $cat = array();
                        }
                          
                         ?>
                  <div class="collapse navbar-collapse main-menu-item justify-content-start  col-md-12 col-sm-12"
                       id="navbarSupportedContent" >
                     <ul class="navbar-nav align-items-left  ml-5 ">
                        <li class="nav-item active">
                           <a class="nav-link" href="<?php echo base_url().'website1/Auth/index'; ?>">Home </a>
                        </li>
                        <?php
                        if (!empty($cat)) {
                              // print_r($cat);die;
                          for ($i=0; $i < count($cat); $i++) { 
                        ?>
                        <li class="nav-item dropdown" >
                           <a class="nav-link " href="<?php echo base_url().'website1/Product/index/'.$cat[$i]['category_id']; ?>">
                            <?php echo $cat[$i]['category_name']; ?>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                              if (!empty($cat[$i]['sub_menu'])) {
                                $arr = $cat[$i]['sub_menu'];
                                for ($j=0; $j < count($arr); $j++) { 
                                
                            ?>
                              <a class="dropdown-item" href="<?php echo base_url().'website1/Product/index/'.$cat[$i]['category_id'].'/'.$arr[$j]['sub_category_id']; ?>"><?php echo $arr[$j]['sub_category_name']; ?></a>
                          <?php } } ?>
                            </div>
                        </li>

                      <?php 
                      } 
                    }  ?>
                     </ul>
                  </div>
               </nav>
            </div>
         </div>
      </header>