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
      <script type="text/javascript">
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
      </script>
   </head>
   <body>
   	
      <!--::header part start::-->
      <!--::header part End::-->
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script type="text/javascript">
          $(document).ready(function () {
              setInterval(function(){ cartCount(); }, 1000);
          });
          function cartCount() {
              // console.log('Hello');
              $.ajax({
                  url: '<?php echo site_url("website1/CheckOut/count_cart"); ?>',
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
                    url: '<?php echo site_url("website1/CheckOut/delete_cart"); ?>',
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