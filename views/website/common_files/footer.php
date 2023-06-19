<!-- <script type="text/javascript">
	$( document ).ready(function() {
	    // console.log( "ready!" );

		var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
		// alert(isMobile);
		if (isMobile) {
			$('#Desktop').css('display','none');
		} else {
			$('#Desktop').css('display','block');
		}

	});
</script> -->
     <!--  <section class="newsletter">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <div class="content">
                     <form>
                        <p>Special Offers For Subscribers</p>
                        <h2>Ten Percent Member Discount</h2>
                        <p class="mb-5 clr-text-grey">Subscribe to our newsletters now and stay up to date with new collections, the latest lookbooks and exclusive offers.</p>
                        <div class="input-group">
                           <input type="email" class="form-control" placeholder="Enter your email address here...">
                           <span class="input-group-btn">
                           <button class="btn" type="submit">Subscribe </button>
                           </span>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section> -->
      <footer class="footer" id="Desktop">
         <div class="container-fluid">
            <div class="row pb-4">
               <div class="col-md-4 mb-3">
                  <div class="pl-4">
                     <div class="mb-4">
                        <a href="#" class="logo"> <img src="<?php echo base_url(); ?>assets/img/white-logo.png" width="300px"></a>
                 
                     </div>
                     <!-- <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
                     </p> -->
                  </div>
               </div>
               <div class="col-md-2 mb-3 text-center">
                  <h4 class=" foot-categories"> Information</h4>
                  <ul class="list-unstyled quick-links">
                     <li><a href="<?php echo base_url().'website/Auth/about_us';?>"></i>About Us</a></li>
                     <!-- <li><a href="#"></i>Delivery Information</a></li> -->
                     <li><a href="<?php echo base_url().'website/Auth/privacy_policy';?>"></i>Privacy Policy</a></li>
                     <!-- <li><a href="<?php echo base_url().'website/Auth/term_and_condition';?>"></i>Terms & Conditions</a></li> -->
                     <!-- <li><a href="#"></i>Information link</a></li> -->
                  </ul>
               </div>
               <div class="col-md-4 ">
                  <h4 class=" "> Contact Details</h4>
                  <div class="single-widget widget-contact">
                     <?php
                        $Data = $this->CommonModel->selectRowDataByCondition(array('general_setting_id' => '1'),'general_setting');
                        if ($Data) { ?>
                           <ul>
                              <li class="address">
                                 <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                                 <p><?php  echo $Data->address; ?></p>
                              </li>
                              <li class="address">
                                 <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                                 <p>Postal-Code : <?php  echo $Data->postal_code; ?></p>
                              </li>
                              <li class="phone">
                                 <span class="icon"><i class="fas fa-phone"></i></span>
                                 <p><a href="tel:(+91) <?php  echo $Data->mobile; ?>"> (+91) <?php  echo $Data->mobile; ?></a></p>
                              </li>
                              <li class="fax">
                                 <span class="icon"><i class="fas fa-fax"></i></span>
                                 <p><a href="tel:(+91) <?php  echo $Data->alt_mobile; ?>">(+91) <?php  echo $Data->alt_mobile; ?></a></p>
                              </li>
                              <li class="email">
                                 <span class="icon"><i class="fas fa-envelope"></i></span>
                                 <p>
                                  <a href="mailto:<?php echo $Data->email_1; ?>"><?php echo $Data->email_1; ?></a>
                                  
                                </p>
                              </li>
                              <li class="fax">
                                 <span class="icon"><i class="fas fa-envelope"></i></span>
                                 <p><a href="<?php  echo $Data->email_2; ?>" target="_blank" ><?php  echo $Data->email_2; ?></a><br/><a href="<?php  echo $Data->email_3; ?>" target="_blank"><?php  echo $Data->email_3; ?></a></p>
                              </li>
                           </ul>
                        <?php }else{ ?>
                           <ul>
                              <li class="address">
                                 <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                                 <p>190,Srinagar main, Indore.</p>
                              </li>
                              <li class="address">
                                 <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                                 <p>Postal-Code : 452001</p>
                              </li>
                              <li class="phone">
                                 <span class="icon"><i class="fas fa-phone"></i></span>
                                 <p><a href="#"> (+91) 9827522444</a></p>
                              </li>
                              <li class="fax">
                                 <span class="icon"><i class="fas fa-fax"></i></span>
                                 <p><a href="#">(+91) 8770786955</a></p>
                              </li>
                              <li class="email">
                                 <span class="icon"><i class="fas fa-envelope"></i></span>
                                 <p>smallbazariim@gmail.com<br/>smallbazar.in<br/>esmallbazar.com</p>
                              </li>
                           </ul>
                        <?php }
                     ?>
                     
                  </div>
               </div>

               <div class="col-md-2 text-center pt-5  ">
                  <ul class="social-network social-circle mr-5">
                     <li><a href="<?php  echo $Data->facebook; ?>" target="_blank" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                     <li><a href="<?php  echo $Data->twittter; ?>" target="_blank" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                    
                     <li><a href="<?php  echo $Data->instagram; ?>" target="_blank" class="icoLinkedin" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="row text-center">
            <div class="col-md-12">
               <div class="copyright">
                  <p>© 2019, Small Bazar, All rights reserved</p>
               </div>
            </div>
         </div>
      </footer>
      <!-- footer part end-->



      <!-- Button trigger modal -->

       

         <!-- Modal -->
      <div class="modal fade sign-in" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
               <div class="modal-body">
                  <div class="d-box">
                     <div class="form-box form-ui">
                        <!-- <p class="mt-4"> If you have forgotten your password you can reset it here.</p> -->
                        <form action="<?php echo base_url(); ?>forgot-password" method="post">
                          <fieldset class="mb-2" >
                            <legend>Forgot Password : </legend>
                           <div class="form-group">
                              <label for="email">Enter Your Email </label>
                              <input type="email" class="form-control mt-2" name="email" id="email"  placeholder="Enter  Email">
                           </div>
                          </fieldset> 
                           <button type="submit" class="btn theme-btn w-50 mt-2 d-block"> Forgot </button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->

    

      <!-- The scroll to top feature -->
    
      <!-- <div class="scroll-top-wrapper ">
        <span class="scroll-top-inner">
          <img src="<?php echo base_url(); ?>assets/website/img/back-top.png">
        </span>
      </div>
      </div> -->

      <!-- jquery plugins here-->
      <!-- <script src="<?php echo base_url(); ?>assets/website/js/jquery-1.12.1.min.js"></script> -->
      <!-- bootstrap js -->
      <script src="<?php echo base_url(); ?>assets/website/js/bootstrap.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/website/js/aos.js"></script>
      <!-- for select box start-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/website/js/jquery.nice-select.min.js"></script>
      <!-- for select box end-->
      <!--  <script src="js/owl.carousel.min.js"></script> -->
      <script src="<?php echo base_url(); ?>assets/website/js/jquery.magnific-popup.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.0/assets/owl.carousel.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.0/owl.carousel.js"></script>
      <script >
         // menu fixed js code
         $(window).scroll(function () {
         var window_top = $(window).scrollTop() + 1;
         if (window_top > 50) {
         $('.main_menu').addClass('menu_fixed animated fadeInDown');
         } else {
         $('.main_menu').removeClass('menu_fixed animated fadeInDown');
         }
         });
      </script>
      <script src="js/custom.js"></script>
      <script>
         AOS.init();
      </script>

       <script>
        
            $("#password-forget").on( "click", function() {
                    $('#login').modal('hide');  
            });
            
            $("#password-forget").on( "click", function() {
                    $('#forgot-password').modal('show');  
            });

            // $('.alert-danger').delay(7000).fadeOut();    
            // $('.alert').delay(5000).fadeOut();  
        </script>

        <script type="text/javascript">
        $('#split_start_price_range').val(50);
        $('#split_end_price_range').val(1200);
        $(".js-range-slider").ionRangeSlider({
            skin: "round",
            step: 50,
            type: "double",
            grid: true,
            min: 0,
            max: 10000,
            from: 50,
            to: 1200,
            prefix: "Rs.",
            onChange: function (vals) {
                        // console.log(vals['from']);
                        // console.log(vals['to']);
                        $('#split_start_price_range').val(vals['from']);
                        $('#split_end_price_range').val(vals['to']);
                    }
        });
        // $( document ).ready(function() {
        //   'use strict';

        //     // var init = function () {                

        //          var slider3 = new rSlider({
        //             target: '#slider3',
        //             values: {min: 0, max: 10000},
        //             step: 5 ,
        //             range: true,
        //             set: [10, 40],
        //             scale: true,
        //             labels: false,
        //             onChange: function (vals) {
        //                 console.log(vals);
        //                 var split = vals.split(",");
        //                 // alert(split[0]);
        //                 // alert(split[1]);
        //                 $('#split_start_price_range').val(split[0]);
        //                 $('#split_end_price_range').val(split[1]);
        //             }
        //         });
        //     // };
        // });
       
       function isNumberKey(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if ((charCode < 48 || charCode > 57))
              return false;

          return true;
       }

       function isAlphaNumberKey(evt) {
          var regex = new RegExp("^[a-zA-Z0-9]+$");
          var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
          if (!regex.test(key)) {
             event.preventDefault();
             return false;
          }
          return true;
       }
       function isAlphaNumberSpaceKey(evt) {
          var regex = new RegExp("^[a-zA-Z0-9 ]+$");
          var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
          if (!regex.test(key)) {
             event.preventDefault();
             return false;
          }
          return true;
       }
       function isAlphaKey(evt) {
          var regex = new RegExp("^[a-zA-Z ]+$");
          var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
          if (!regex.test(key)) {
             event.preventDefault();
             return false;
          }
          return true;
       }
    </script>

   </body>
</html>