 <section>
         <div class="page-title-area">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="title-heading ">
                     <h1>My Order</h1>
                     <p>We are a featured brand that calls itself fashion</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </section>
      <section>
         <div class="container">
            <div class="wishlist-area">
           <div class="container">
              <div class="row">
                 <div class="col-md-12 col-sm-12 ">
                    <div class="wishlist-content">
                       <form action="#">
                          <div class="wishlist-table table-responsive">
                             <table>
                                <thead>
                                  <tr>
                                    <th class="product-quantity">Order-Id</th>
                                    <th class="product-price">Address</th>
                                    <th class="product-price">Country</th>
                                    <th class="product-price">State</th>
                                    <th class="product-price">City</th>
                                    <th class="product-price"> Status</th>
                                    <th class="product-remove"> Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($user_detail as $key => $value) { ?>
                                  <tr>
                                      <td class="product-name"><?php echo $value['order_id']; ?></td>
                                      <td class="product-quantity"><?php echo $value['address']; ?></td>
                                      <td class="product-price"><?php echo $value['country_name']; ?></td>
                                      <td class="product-price"><?php echo $value['state_name']; ?></td>
                                      <td class="product-price"><?php echo $value['city_name']; ?></td>
                                      <td class="product-remove">
                                          <?php 

                                              if ($value['payment_status'] == 0) {
                                                  echo "Pending";
                                              } else if ($value['payment_status'] == 1) {
                                                  echo "Complete";
                                              }else if ($value['payment_status'] == 2) {
                                                  echo "Dispatch";
                                              } else {
                                                  echo "Cancel";
                                              }
                                              

                                          ?>
                                      </td>
                                      <td>
                                      <?php $url = site_url().'website1/Order/order_detail/'.$value["booking_id"]; ?>
                                        <a href="<?php echo $url; ?>">Detail</a>
                                      </td>
                                  </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                          </div>
                       </form>
                    </div>
                 </div>
              </div>

              <!-- <div class="row mt-5">
                  <div class="col-md-8 col-sm-7 col-xs-12">
                    <div class="buttons-cart">
                      <input type="submit" value="Update Cart">
                      <a href="#">Continue Shopping</a>
                    </div>
                    <div class="coupon">
                      <h3>Coupon</h3>
                      <p>Enter your coupon code if you have one.</p>
                      <input type="text" placeholder="Coupon code">
                      <input type="submit" value="Apply Coupon">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-5 col-xs-12">
                    <div class="cart_totals">
                      <h2>Cart Totals</h2>
                      <table>
                        <tbody>
                          <tr class="cart-subtotal">
                            <th>Subtotal</th>
                            <td><span class="amount">£215.00</span></td>
                          </tr>
                          <tr class="shipping">
                            <th>Shipping</th>
                            <td class="float-right">
                              <div class="segmented-control form-ui">
                                  <ul class="segmented-control-btn" id="group4">
                                     <li>
                                     <input type="radio" id="Confident" name="group4" checked="">
                                     <label for="Confident">Free Shipping</label>
                                     <div class="check"></div>
                                     </li>
                                     <li>
                                     <input type="radio" id="Romantic" name="group4">
                                     <label for="Romantic">Flat Rate: £7.00</label>
                                     <div class="check"><div class="inside"></div></div>
                                     </li>
                                    
                                  </ul>
                               </div>

                               
                              
                            </td>
                          </tr>
                          <tr class="order-total">
                            <th>Total</th>
                            <td>
                              <strong><span class="amount">£215.00</span></strong>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="wc-proceed-to-checkout">
                        <a href="#">Proceed to Checkout</a>
                      </div>
                    </div>
                  </div>
                </div> -->
           </div>
        </div>
         </div>
      </section>