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
     
      <link rel="stylesheet" href="css/style.css">
      <!-- responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css">
   </head>
   <body>

      <section class="mt-5">
        <div class="container">
          <div class="text-center row ">
            <div class="col-md-6 offset-md-3">
              <div>
                <!-- <h2>Welcome to Anandisha Ecommerce  </h2> -->
                <center><img src="<?php echo base_url(); ?>assets/img/thankyou.png" width="100px"></center>
                <!-- <h2>Thank You</h2> -->
                <center>
                    <div class="col-md-6" style="border: 1px black;">
                        <p>OOps! your payment is failed, please try again.</p>
                        
                            <a class="btn btn-primary" href="<?php echo base_url().'Website/Website/index'; ?>" class="btn"> Home</a>

                    </div>
                </center> 
                  
              </div>
            </div>
        
          </div>
        </div>
      </section>
   
      


   </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
        setInterval(function(){
         // window.location.href = "<?php echo base_url("Website/Website/index"); ?>";
        }, 3000);
    });

</script>