<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Small-Bazar</title>
      <!-- <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/website/img/favicon.png"> -->
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
         <form class="registration form-ui mt-4" method="post" action="<?php echo base_url(); ?>website/Auth/send_mail">
            <div class="registration-form">
               
                <?php if($this->session->flashdata('success')){ ?>
                   <div class="alert alert-info alert-dismissible" id="hideDivId">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Success!</strong> <?php echo $this->session->flashdata('success');?>
                   </div>
               <?php } if($this->session->flashdata('_error_login')){  ?>
                    <div class="alert alert-danger alert-dismissible" id="hideDivId">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Error!</strong> <?php echo $this->session->flashdata('_error_login');?>
                   </div>
               <?php } ?>
               <div class="row">
                   <div class="col-md-12 text-center"> 
                     <a class="navbar-brand " href="<?php echo base_url(); ?>" data-aos="fade-up"> <img src="<?php echo base_url(); ?>assets/img/white-logo.png" alt="logo" width="360px"> </a>
                 <!--  <h2>Login</h2> -->
                </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="email">Email ID</label>
                        <input type="email" name="email" class=" form-control mb-2"  class="" id="number">
                     </div>
                  </div>
               </div>
               
               <div class="row">
                  <div class=" col-md-6">
                     <div class="d-flex justify-content-start links text-drak">
                        If you have an account  <a href="<?php echo base_url(); ?>website/Auth/login" class="ml-2  text-drak">Sign In</a>
                     </div>
               </div>
                <div class="d-flex justify-content-center mt-3 login_container col-md-12">
                  <button type="submit" name="button" class="btn login_btn">Forget Password</button>
               </div>
               <div class="d-flex justify-content-start links">
                  <a href="<?php echo base_url(); ?>" class="ml-2  text-drak">Home</a>
               </div>
            </div>
         </form>
      </div>
   
      <!-- Modal <-->
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
       
    </script>
   </body>
</html>

