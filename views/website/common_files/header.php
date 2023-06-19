<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Small-Bazar</title>
      <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/img/favicon.png">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/website/css/bootstrap.min.css">
      <!-- owl carousel CSS -->
      
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
      <!-- web font CSS -->
      <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Playfair+Display:400,400i,700,700i,900,900i&display=swap" rel="stylesheet">

        
      <!-- style CSS -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/website/css/style.css">
      <!-- responsive CSS -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/website/css/responsive.css">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>  
      <script src="<?php echo base_url(); ?>assets/website/js/jquery-1.12.1.min.js"></script>
       <!-- <script type="text/javascript">
        $( document ).ready(function() {
            // console.log( "ready!" );

          var isMobiles = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
          // alert(isMobiles);
          if (isMobiles) {
            $('#desktop').css('display','none');
          } else {
            $('#desktop').css('display','block');
          }

        });
      </script> -->
   </head>
   <body>
    
      <!--::header part start::-->
      <header id="desktop">
         <div class=" top-header">
            <div class="container-fluid">
               <div class=" main-menu-item justify-content-end " >
                  <ul class=" rotate-icon ml-2">
                     <li class="nav-item active">
                      <?php
                          $Dataa = $this->CommonModel->selectRowDataByCondition(array('general_setting_id' => '1'),'general_setting');
                          if ($Dataa) { ?>
                            <a class="nav-link" href="tel:+91-<?php echo $Dataa->mobile; ?>; ?>" ><i class="fas fa-phone"></i> Call +91-<?php echo $Dataa->mobile; ?>,</a>
                             <a class="nav-link" href="tel:<?php echo $Dataa->alt_mobile; ?>" ><!-- <i class="fas fa-phone"></i> --> <?php echo $Dataa->alt_mobile; ?>  </a>

                      <?php } ?>
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown_1"
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
                          <a class="dropdown-item" href="<?php echo base_url().'website/Auth/setting'; ?>">Change Setting</a>
                          <a class="dropdown-item" href="<?php echo base_url().'website/Auth/myAccount'; ?>">My Account</a>
                           <a class="dropdown-item" href="<?php echo base_url().'website/Auth/share_list'; ?>">Referal List</a>
                           <a href="#" class="dropdown-item" data-action="share/whatsapp/share" onclick="check()">Invite & earn</a>
                           <a class="dropdown-item" href="<?php echo base_url().'website/Order/index'; ?>" >  MY Order</a>
                           <a class="dropdown-item" href="<?php echo base_url().'website/Auth/logout'; ?>">Logout</a>
                        </div>
                        </li>
                       
                    <?php } else{ ?>
                        <li class="nav-item">
                          <a class="nav-link" href="<?php echo base_url(); ?>website/Auth/login" >  LOGIN</a>
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
                            <a href="https://api.whatsapp.com/send?phone= +91-<?php echo $Dataa->alt_mobile; ?>" target="_blank" data-action="share/whatsapp/share"><i class="fab fa-whatsapp"></i></a>
                          </li>
                       </ul>
                    </div>
                  </div>

                
               <nav class="navbar navbar-expand-lg navbar-light row">
                  <button class="navbar-toggler" type="button" data-toggle="collapse"
                     data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                     aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
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
                          <a class="nav-link" href="<?php echo base_url().'website/Auth/index'; ?>">Home </a>
                        </li>
                        <?php 
                    
                    if (!empty($id)) { ?>
                        <li class="nav-item active">
                          <a class="nav-link" href="<?php echo base_url().'website/Auth/invite'; ?>">Invite & Earn </a>
                        </li>
                        <?php }
                        if (!empty($cat)) {
                              // print_r($cat);die;
                          for ($i=0; $i < count($cat); $i++) { 
                        ?>
                        <li class="nav-item dropdown" >
                           <a class="nav-link " href="<?php echo base_url().'website/Product/index/'.$cat[$i]['category_id']; ?>">
                            <?php echo $cat[$i]['category_name']; ?>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                              if (!empty($cat[$i]['sub_menu'])) {
                                $arr = $cat[$i]['sub_menu'];
                                for ($j=0; $j < count($arr); $j++) { 
                                
                            ?>
                              <a class="dropdown-item" href="<?php echo base_url().'website/Product/index/'.$cat[$i]['category_id'].'/'.$arr[$j]['sub_category_id']; ?>"><?php echo $arr[$j]['sub_category_name']; ?></a>
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script type="text/javascript">
          $(document).ready(function () {
              setInterval(function(){ cartCount(); }, 1000);
          });
          function cartCount() {
              // console.log('Hello');
              $.ajax({
                  url: '<?php echo site_url("website/CheckOut/count_cart"); ?>',
                  type: "POST",
                  // data: {
                  //     "Notification_id" : val
                  // },
                  success: function (response) {
                      var obj = JSON.parse(response)
                      console.log(obj.data);
                      if (obj.data == 0) {
                        $('#notify').html('<span class="badge">0</span><i class="fa fa-shopping-cart"></i> ');
                        // $('#ul_li').html('');
                      }else{
                        $('#notify').html('<span class="badge">'+obj.data+'</span><i class="fa fa-shopping-cart"></i> ');
                        $('#ul_li').html(obj.li);
                      }
                  }
              });
          }
          function delteFunction(id){
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url: '<?php echo site_url("website/CheckOut/delete_cart"); ?>',
                    type: "POST",
                    data: {
                        "cart_id" : id
                    },
                    success: function (response) {
                      location.reload();
                    }
                });
            }
          }
        function check(){
            var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
            var referal_code = $('#referal_code').val();
            //  alert(referal_code);
            if (isMobile == true) {
                console.log('mobile');
                
                window.location.href = "whatsapp://send?text="+referal_code;
                $('#desktopId').css("display","none");
                $('#mobileId').css("display","block");
            } else {
                console.log('desktop');
                //  window.location.href = "https://web.whatsapp.com/send?text=textToshare";
                window.open("https://web.whatsapp.com/send?text="+referal_code);
                $('#desktopId').css("display","block");
                $('#mobileId').css("display","none");
                // $('#desktopId').show();
                // $('#mobileId').hide();
            }
        }
      </script>
      <!-- Header part end-->