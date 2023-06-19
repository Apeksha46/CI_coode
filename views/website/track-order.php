<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Aananddisha</title>
      <link rel="icon" type="image/png" sizes="32x32" href="img/favicon.png">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- owl carousel CSS -->
      <!-- ----- -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
      <!-- web font CSS -->
      <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Playfair+Display:400,400i,700,700i,900,900i&display=swap" rel="stylesheet">
      <!-- style CSS -->
      <link rel="stylesheet" href="css/style.css">
      <!-- responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css">
   </head>
   <body>

      <div class="bg">
         <form class="registration form-ui mt-4">
            <div class="registration-form">

                <div class="row">
                   <div class="col-md-12 text-center"> 
                     <a class="navbar-brand " href="index.html" data-aos="fade-up"> <img src="img/white-logo.png" alt="logo" width="360px"> </a>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="order">Order ID *</label>
                        <input type="text" class="form-control" id="password">
                        <p>Enter the billing last name and email/ZIP as in the order billing address.</p>
                     </div>
                  </div>
                 
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="billing">Billing Last Name *</label>
                        <input type="text" class="form-control" id="password">
                     </div>
                  </div>
                 
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                           <label for="number">Find Order By</label>
                           <select class="form-control">
                              <option selected="">Select order </option>
                              <option>Email </option>
                              <option>Amozone</option>
                              <option>Cooperative</option>
                           </select>
                        </div>
                     </div>
                  </div>
               
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="email">Email ID</label>
                        <input type="button" data-toggle="modal" data-target="#email-id"  class=" form-control mb-2"  class="" id="number">
                     </div>
                  </div>
               </div>
               
               <div class="row">
                  <div class=" col-md-12">
                                 
                     <div class="d-flex justify-content-center mt-3 pl-0 pr-0 col-md-12">
                        <button type="button" name="button" class="btn login_btn w-100"> Continue </button>
                     </div>
              
            </div>
         </form>
      </div>
   
     
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
                        <form action="forgot-password" method="post">
                          <fieldset class="mb-2 text-drak" >
                            <legend>Forgot Password : </legend>
                           <div class="form-group">
                              <label for="email">Enter Your Email </label>
                              <input type="email" class="form-control mt-2" name="email" id="email"  placeholder="Enter  Email">
                           </div>
                          </fieldset> 
                           <button type="submit" class="btn "> Forgot </button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal <-->
      <!-- otp -->
      <!-- Optional JavaScript -->
      <!-- jquery plugins here-->
      <script src="js/jquery-1.12.1.min.js"></script>
      <!-- bootstrap js -->
      <script src="js/bootstrap.min.js"></script>
      <script src="js/aos.js"></script>
      <!-- for select box start-->
      <script src="js/jquery.nice-select.min.js"></script>
      <!-- for select box end-->
      <!--  <script src="js/owl.carousel.min.js"></script> -->
      <script src="js/jquery.magnific-popup.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.0/assets/owl.carousel.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.0/owl.carousel.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>