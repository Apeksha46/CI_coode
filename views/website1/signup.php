<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Small-Bazar</title>
      <!-- <link rel="icon" type="<?php echo base_url(); ?>assets/website/image/png" sizes="32x32" href="img/favicon.png"> -->
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
   </head>
   <body>

      <div class="bg">
         <form class="registration form-ui mt-4" method="post" action="<?php echo site_url(); ?>website1/Auth/chainSignUp">

            <div class="registration-form">
             <?php if($this->session->flashdata('success')){ ?>
                   <div class="alert alert-info alert-dismissible" id="hideDivId">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Success!</strong> <?php echo $this->session->flashdata('success');?>
                   </div>
               <?php } if($this->session->flashdata('error')){  ?>
                    <div class="alert alert-danger alert-dismissible" id="hideDivId">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Error!</strong> <?php echo $this->session->flashdata('error');?>
                   </div>
            <?php }
               if (isset($_GET['id'])) {
                  $ref = $_GET['id'];
               }else{
                  $ref = '';
               }
            ?>
               <div class="row">
                <div class="col-md-12 text-center"> 
                  <a href="<?php echo base_url(); ?>website1/Auth/login" class="ml-2  text-drak">Login</a>
                  <h2>Sign Up</h2>
                </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" name="first_name" required="">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="last_name" required="">
                     </div>
                  </div>
               </div>
               <!-- <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="username">Bussiness Name</label>
                        <input type="text" class="form-control" id="username">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="number">Bussiness Type</label>
                        <select class="form-control">
                           <option selected="">Select Bussiness </option>
                           <option>Corporation </option>
                           <option>Nonprofit Organization</option>
                           <option>Cooperative</option>
                        </select>
                     </div>
                  </div>
               </div> -->
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="mobile">Mobile No</label>
                        <input type="tel"   class=" form-control  mb-2" maxlength="10" name="mobile" class="" id="number" required="">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="email">Email ID</label>
                        <input type="email" name="email"  class=" form-control mb-2"  class="" id="email" required="">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required="">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="re-password">Confirm Password</label>
                        <input type="password" class="form-control" name="re_password" id="re-password" required="">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="referral">Referral Code</label>
                        <input type="text" value="<?php echo $ref; ?>" class="form-control text-center refral mb-4" name="referal">
                     </div>
                  </div>
               </div>
               <button type="submit"  class="btn btn-w-theme-outline btn-m mb-2 w-100">Sign Up </button>
               <div class="d-flex justify-content-center links">
               <a href="<?php echo base_url(); ?>" class="ml-2  text-drak">
                  <img src="<?php echo base_url(); ?>assets/img/white-logo.png" width="360px;">
               </a>
               </div>
            </div>
         </form>
         
      </div>
      <!-- Email  -->
    <!--   <div class="modal fade sign-in" id="email-id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
               <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
               <span class="ti-close ic-close"></span>
               </button>
               <div class="modal-body">
                  <div class="d-box">
                     <div class="form-box">
                        <form>
                           <div class="form-group">
                              <h5 for="email" class="mb-4  mt-2">Email ID</h5>
                              <input type="email" class="form-control" placeholder=" Email id" id="mobile number" aria-describedby="emailHelp"> 
                           </div>
                           <button  type="button" onclick="javaScript:window.location.href='dashboard.html';" class="btn btn-w-theme btn-m">SUBMIT</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div> -->

      <!-- mobile No -->
      <div class="modal fade sign-in" id="mobile-number" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
               <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
               <span class="ti-close ic-close"></span>
               </button>
               <div class="modal-body">
                  <div class="d-box">
                     <div class="form-box">
                        <form>
                           <div class="form-group">
                              <h5 for="email" class="mb-4  mt-4"> Mobile Number</h5>
                              <input type="email" class="form-control" placeholder=" Mobile Number" id="mobile number" aria-describedby="emailHelp"> 
                              <h5 for="email" class="mb-4  mt-4">Enter Your OTP</h5>
                              <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                           </div>
                           <button  type="button" onclick="javaScript:window.location.href='dashboard.html';" class="btn btn-w-theme btn-m">SUBMIT</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>


      <!-- otp -->
      <!-- Optional JavaScript -->
      <!-- jquery plugins here-->
      <script src="<?php echo base_url(); ?>assets/website/js/jquery-1.12.1.min.js"></script>
      <!-- bootstrap js -->
      <script src="<?php echo base_url(); ?>assets/website/js/bootstrap.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/website/js/aos.js"></script>
      <!-- for select box start-->
      <script src="<?php echo base_url(); ?>assets/website/js/jquery.nice-select.min.js"></script>
      <!-- for select box end-->
      <!--  <script src="js/owl.carousel.min.js"></script> -->
      <script src="<?php echo base_url(); ?>assets/website/js/jquery.magnific-popup.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.0/assets/owl.carousel.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.0/owl.carousel.js"></script>
      <script src="<?php echo base_url(); ?>assets/website/js/custom.js"></script>

       <script type="text/javascript">
      setTimeout(function() { 
        $('.alert').hide(); 
      }, 3000);
      $('div.alert .close').on('click', function() {
        $(this).parent().alert('close'); 
      });
        $(document).ready(function() {
            $('.tableExport').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                     'excel',
                ]
            } );
        } );
    </script>
   </body>
</html>