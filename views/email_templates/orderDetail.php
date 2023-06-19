<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Small Bazar</title>
   </head>
   <body>
     <section>
      <table style="width: 50%; background: #fff; max-width: 90%; margin: 0 auto; font-size: 14px; color: gray; padding-top: 0rem; box-shadow: 0 0 30px rgba(37,45,51,.1)!important;border-top: 11px solid #d9c090;">
      <tbody>
      <tr style="color: #000;">
         <td>
            <table style="width: 100%; padding: 2rem;">
               <tr>
                  <td width="" style="width: 100%; text-align:center;">
                 
                   <a href="<?php echo base_url(); ?>" class="logo"> <img src="<?php echo base_url(); ?>assets/img/logo.png" width="300px"></a>                    
                  </td>
               </tr>
            </table>    
         </td>
      </tr> 
      <tr style="color: #000;">
         <td style="text-align: center; background: rgb(109, 102, 102) none repeat scroll 0% 0%; color: rgb(255, 255, 255); font-size: 22px; font-family: sans-serif;">
            <p>Order Description</p>
         </td>
      </tr>
   <tr>
      <td style="font-family: sans-serif; width: 100%; padding: 0 2rem; color: #000; font-size: 16PX; text-align: left;">

         <p style="color: #666; font-size: 18px; text-align: left; float: right;">Order no.  <?php echo $order_id; ?></p><br>
         <address>
            <strong>Order Date:</strong><br>
            <?php echo date('M-d,Y',strtotime($order_date)); ?>
          </address>
<br>
<b><span style="color: #333;"><?php echo $first_name.' '.$last_name; ?></span></b>
  <address>
    <strong>Shipped To:</strong><br>
    <p> <?php echo $address; ?> </p>
     <?php echo $state; ?>,  <?php echo $city; ?><br>
     <?php echo $country; ?>,  <?php echo $pincode; ?>
  </address>
<br><br>
<br><br>

              <div class="table-responsive">
              <table class="table table-condensed" style="border: 1px solid #d0d0d0; padding: 4px;text-align: center;">
                <thead>
                  <tr style="margin-top: 10px;background: #ccc;">
                      <td style="width: 30px; padding: 11px;"><strong>Sno</strong></td>
                      <td style="width: 300px;"><strong>Product</strong></td>
                      <td style="width: 50px;"><strong>Quantity</strong></td>
                     <td style="width: 200px;"><strong>Price</strong></td>
                  </tr>
                </thead>
                <tbody style="line-height: 35px;">
                  <!-- foreach ($order->lineItems as $line) or some such thing here -->
                  <?php
                    if(!empty($cart_item))
                    {
                      $j = 0;
                      for ($i=0; $i < count($cart_item); $i++) { 
                          $j = $j + 1;
                    ?>
                      <tr>
                        <td><?php echo $j ; ?></td>
                        <td class="text-center"><?php echo $cart_item[$i]['product_name'] ; ?></td>
                        <td class="text-center"><?php echo $cart_item[$i]['quantity'] ; ?></td>
                        <td class="text-right"><?php echo $cart_item[$i]['price'] ; ?></td>
                      </tr>
                    <?php  }
                    }
                  ?>
              
                  <tr style="margin-top: 10px; background: #ccc;">

                    <td class="no-line"></td>
                    <td class="no-line"></td>

                    <td class="no-line text-center" style=" " ><strong>Total</strong></td><br>
                    <td class="no-line text-right" style=" margin-top: 15px; "><b>Rs.<?php echo $total_price; ?> </b></td>
                  </tr>
                </tbody>
              </table>
            </div>



         <p style="color: rgb(85, 85, 85); margin-bottom: 1px; font-size: 15px; margin-top: 29px;"><b> Best Regards,</b></p>

         <p style="font-weight: bold; color: rgb(0, 0, 0); font-size: 16px; margin-bottom: 0px; margin-top: 8px;">Small Bazar</p>

         <p style="font-size: 14px;"><b>Email:</b> info@smallbazar.com</p>

         <p style="font-size: 14px;"> <a target="_blank" href="<?php echo base_url(); ?>" style="color: rgb(238, 126, 44)">www.smallbazar.com</a></p>

 


</td>
   </tr>

   </tbody>       
   </table>
     </section>
   




        
   </body>
</html>