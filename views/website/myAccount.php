<section class="find-normal-section  m-5">
   <div class="container-fluid">
      <div class="checkout-area ">
         <div style="margin: 0 0 0 278px;">
            <button type="button" class="btn btn-Warning btn-lg" data-toggle="modal" data-target="#myTopUpModal">Top Up</button>
         </div>
         <br/>
         <!-- Modal -->
         <div id="myTopUpModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Top Up</h4>
                  </div>
                  <form action="<?php echo base_url('website/Auth/topup'); ?>" method="POST" name="form1" >
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-12" style="line-height: 32px;font-size: 18px;">
                              <?php
                                 if (!empty($package)) {
                                   $i = 0;
                                   foreach ($package as $key => $packageOne) { 
                                     $i = $i+1; 
                                   ?>
                              <input type="radio" name="top_up" id="top_up<?php echo $i; ?>" value="<?php echo $i; ?>,<?php echo $packageOne['price']; ?>" onclick="openText(this.value);">&nbsp;&nbsp;<?php echo $packageOne['package_name']; ?>(Rs. <?php echo $packageOne['price']; ?>)<br/>
                              <?php }
                                 }
                                 ?>
                              <input type="radio" name="top_up" id="top_up5" value="5,other" onclick="openText(this.value);">&nbsp;&nbsp;Other<br/>
                              <div class="row" id="amount"  style="display: none;">
                                 <div class="col-md-12">
                                    <div class="col-md-6">
                                       <label>Enter Top-Up Amount</label>
                                    </div>
                                    <div class="col-md-6">
                                       <input type="text" class="form-control" name="amount" onkeypress="return isNumberKey(event)">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="row d-flex justify-content-center">
            <div class="col-lg-12 col-md-12 pt-4">
                <div class="p-2">
                    <?php 
                    
                        if (!empty($id)) {
                           $Dataa1 = $this->CommonModel->selectRowDataByCondition(array('user_id' => $id),'user');
                           if ($Dataa1) { 
                               if($Dataa1->package_id != '')
                                    $Dataa2 = $this->CommonModel->selectRowDataByCondition(array('package_id' => $Dataa1->package_id),'package');  
                                    if($Dataa2)
                                    {
                                        $package_name = $Dataa2->package_name;
                                    }else{
                                        $package_name = '';
                                    }
                               }else{
                                    $package_name = '';
                                }
                           }
                           if($package_name == ''){
                                $package_names = 'not any package ';
                            }else{
                                $package_names = $package_name;
                            }
                    ?>
                    <h2>
                        <strong>You're <span><?php echo $package_names; ?></span> card holder,Please click on card and upgrade your package.</strong></h2>
                </div>
            </div>

            <div class="container">
            <div class="row d-flex justify-content-center pb-4 mt-5">
               <div class=" col-lg-4 col-md-4  pt-4 ">
                   <div class="checkbox-form row justify-content-center">
                     <div class="col-md-12 col-sm-12 justify-content-center align-items-center d-flex">
                        <div class="flip-card">
                           <div class="flip-card-inner">
                              <div class="flip-card-front">
                                 <div class="package-one package-one-box">
                                    <!-- <a target="_blank" href="https://p-y.tm/FExY-8b"> -->
                                    <div class="d-flex">
                                       <div class="ml-auto text-right">
                                          <img width="170px" src="<?php echo base_url() ?>assets/img/logo.png">
                                          <span class="ml-auto w-100 float-right fontamazi"><b>Bronze  </b></span>
                                          <span class="d-block">Lifetime</span> 
                                       </div>
                                    </div>
                                    <!-- <div class="d-flex justify-content-center align-items-center pt-1 pb-1">
                                       <a href="#">  <img src="http://3.16.159.2/small_bazar/assets/website/img/bg-store.png" width="62px"></a>
                                       </div> -->
                                    <div class="d-flex mt-4 package-wallet-box ">
                                       <div class=" text-left">
                                          <div class="pt-2 package-txt-one">
                                             <span><strong>SHREYA JAIN</strong></span> 
                                          </div>
                                          <div class="d-flex wallet-point"><span style="font-size: 16px">SBSC-14239</span> </div>
                                       </div>
                                       <!-- <div class="front--bg--s1"></div> -->
                                       
                                    </div>

                                          <div class="wave"></div>
                                    
                                 </div>
                              </div>
                              <div class="flip-card-back">
                                 <div class="package-one package-one-box">
                                    <!-- <a target="_blank" href="https://p-y.tm/FExY-8b"> -->
                                    <div class="d-flex">
                                       <div class=" text-left">
                                          <span class="ml-auto w-100 float-right fontamazi"><b>Small Bazar </b></span> 
                                          <span class="ml-auto w-100 float-right fontamazi"><b>Shopping Card </b></span> 
                                          <span>Wallet Balance :</span> <b class="ml-2"><i class="fas fa-rupee-sign"></i> 31273</b>
                                          <!--  <div class="d-flex wallet-bal fontamazi">
                                             </div> -->
                                       </div>
                                       <div class="ml-auto text-right">
                                          <img width="100px" src="<?php echo base_url() ?>assets/img/logo.png">
                                          <span class="ml-auto w-100 float-right fontamazi"><b>Bronze </b></span>
                                          <span class="ml-auto">Lifetime</span> 
                                       </div>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center pt-1 pb-1">
                                       <a href="#">  <img src="http://3.16.159.2/small_bazar/assets/website/img/bg-store.png" width="62px"></a>
                                    </div>
                                    <div class="row" style="margin-top: -20px;">
                                       <div class="col text-left">
                                          <div class="pt-2 package-txt-one">
                                             <span>SHREYA JAIN</span> 
                                          </div>
                                          <div class="d-flex wallet-point"><span>SBSC-14239</span> </div>
                                          <div class="mt-0">
                                             <span>Wallet Balance :</span> <b class=""><i class="fas fa-rupee-sign"></i> 31273</b>
                                          </div>
                                       </div>
                                       <div class=" text-right col">
                                          <span class="w-100 float-right fontamazi">Package Price : <b class="ml-2"><i class="fas fa-rupee-sign"></i> 1500</b></span>
                                          <span> Special offer :</span> 20 % off<!--  <i class="fas fa-percent"></i> -->
                                       </div>
                                    </div>
                                    <!--  <div class=" qr-code">
                                       <img src="img/barcode.png" class="img-fluid">
                                       
                                       </div> -->
                                    <!-- <div class="qr-content">
                                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
                                       </div> -->
                                  
                                    <!-- </a> -->
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 col-sm-12 pt-3">
                        <div class="card_detail ">
                           <div class="text-right pb-2">
                              <img width="150px" src="<?php echo base_url() ?>assets/img/logo.png">
                           </div>
                           <div class="">
                              <span>Lorem Ipsum</span>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="row">
                     <div class="col-lg-12">
                        
                     </div>
                  </div> -->
                  
               </div>
            </div>
         </div>



            <div class=" col-lg-12 col-md-12 shadow pt-4">
               <div class="checkbox-form row">
                  <?php 
                     // print_r($data);exit;
                     if (!empty($data)) 
                     { 
                        if (!empty($package)) { 
                           // print_r($package);exit;
                           foreach ($package as $p => $packages) {

                              if ($packages['package_id'] <= $data['package_id']) { ?>
                                 <div class="col-md-4 col-sm-4 justify-content-center align-items-center d-flex">
                                    <div class="flip-card">
                                       <div class="flip-card-inner">
                                          <div class="flip-card-front">
                                             <div class="package-one package-one-box">
                                                <!-- <a target="_blank" href="https://p-y.tm/FExY-8b"> -->
                                                <div class="d-flex">
                                                  
                                                   <div class="ml-auto text-right">
                                                      <img width="200px" src="<?php echo base_url();?>assets/img/logo.png">
                                                      <span class="ml-auto w-100 float-right fontamazi"><b><?php echo $packages['package_name']; ?>  </b></span>
                                                      <span class="d-block">Lifetime</span> 
                                                   </div>
                                                </div>
                                                <!-- <div class="d-flex justify-content-center align-items-center pb-1">
                                                   <a href="#">  <img src="http://3.16.159.2/small_bazar/assets/website/img/bg-store.png" width="62px"></a>
                                                </div> -->
                                                <div class="d-flex mt-4 package-wallet-box">
                                                   <div class=" text-left">
                                                      <div class="pt-2 package-txt-one">
                                                         <span><strong><?php echo strtoupper($name); ?></strong></span> 
                                                      </div>
                                                      <div class="d-flex wallet-point"><span style="font-size: 16px"><?php echo $unique_package_id; ?></span> </div>
                                                   </div>
                                                  <!--  <div class="ml-auto text-right">
                                                      <span class="ml-auto w-100 float-right fontamazi"><b class="ml-2"><i class="fas fa-rupee-sign"></i> 1500</b></span>
                                                      <span>Wallet Balance :</span> <b class="ml-2"><i class="fas fa-rupee-sign"></i> 30000</b>
                                                   </div> -->
                                                </div>
                                                <div class="wave"></div>
                                                <!--  <div class=" qr-code">
                                                   <img src="img/barcode.png" class="img-fluid">
                                                   
                                                   </div> -->
                                                <!-- <div class="qr-content">
                                                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
                                                   </div> -->
                                                <div class="star" style="background: url(img/star1.png) repeat;"></div>
                                                <!-- </a> -->
                                             </div>
                                          </div>
                                          <div class="flip-card-back">
                                             <div class="package-one package-one-box">
                                                <!-- <a target="_blank" href="https://p-y.tm/FExY-8b"> -->
                                                <div class="d-flex">
                                                   <div class=" text-left">
                                                      <span class="ml-auto w-100 float-right fontamazi"><b>Small Bazar </b></span> 
                                                      <span class="ml-auto w-100 float-right fontamazi"><b>Shopping Card </b></span> 
                                                      <!--<span>Wallet Balance :</span> <b class="ml-2"><i class="fas fa-rupee-sign"></i> <?php echo $wallet; ?></b>-->
                                                      <!--  <div class="d-flex wallet-bal fontamazi">
                                                         </div> -->
                                                   </div>
                                                   <div class="ml-auto text-right">
                                                      <img width="100px" src="<?php echo base_url();?>assets/img/logo.png">
                                                      <span class="ml-auto w-100 float-right fontamazi"><b><?php echo $packages['package_name']; ?> </b></span>
                                                      <span class="ml-auto">Lifetime</span> 
                                                   </div>
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center  pb-1">
                                                   <a href="#">  <img src="<?php echo base_url(); ?>assets/website/img/bg-store.png" width="72px"></a>
                                                </div>
                                                <div class="d-flex">
                                                   <div class=" text-left">
                                                      <div class=" package-txt-one">
                                                         <span><?php echo strtoupper($name); ?></span> 
                                                      </div>
                                                      <div class="d-flex wallet-point"><span><?php echo $unique_package_id; ?></span> </div>
                                                   </div>
                                                   <div class="ml-auto text-right">
                                                      <span class="ml-auto w-100 float-right fontamazi">Package Price<b class="ml-2"> <?php echo $packages['price']; ?></b></span>
                                                      <span>Wallet Balance :</span> <b class="ml-2"> <?php echo $wallet; ?></b>
                                                   </div>
                                                </div>
                                                <!--  <div class=" qr-code">
                                                   <img src="img/barcode.png" class="img-fluid">
                                                   
                                                   </div> -->
                                                <!-- <div class="qr-content">
                                                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
                                                   </div> -->
                                                <div class="star" style="background: url(img/star1.png) repeat;"></div>
                                                <!-- </a> -->
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              <?php }else{ ?>
                                 <div class="col-md-4 col-sm-4 justify-content-center align-items-center d-flex">
                                    <div class="flip-card">
                                       <div class="flip-card-inner">
                                          <a href="<?php echo base_url().'website/Auth/packagePurchase?id='.$packages['package_id'].'&amount='.$packages['price']; ?>">
                                             <div class="flip-card-front">
                                                <div class="package-one package-one-box">
                                                   <!-- <a target="_blank" href="https://p-y.tm/FExY-8b"> -->
                                                   <div class="d-flex">
                                                     
                                                      <div class="ml-auto text-right">
                                                         <img width="200px" src="<?php echo base_url();?>assets/img/logo.png">
                                                         <span class="ml-auto w-100 float-right fontamazi"><b><?php echo $packages['package_name']; ?>  </b></span>
                                                         <span class="d-block">Lifetime</span> 
                                                      </div>
                                                   </div>
                                                   <!-- <div class="d-flex justify-content-center align-items-center  pb-1">
                                                      <a href="#">  <img src="http://3.16.159.2/small_bazar/assets/website/img/bg-store.png" width="62px"></a>
                                                   </div> -->
                                                   <div class="d-flex mt-4 package-wallet-box">
                                                      <div class=" text-left">
                                                         <div class="pt-2 package-txt-one">
                                                            <span><strong><?php echo strtoupper($name); ?></strong></span> 
                                                         </div>
                                                         <div class="d-flex wallet-point"><span style="font-size: 16px"><?php echo $unique_package_id; ?></span> </div>
                                                      </div>
                                                     <!--  <div class="ml-auto text-right">
                                                         <span class="ml-auto w-100 float-right fontamazi"><b class="ml-2"><i class="fas fa-rupee-sign"></i> 1500</b></span>
                                                         <span>Wallet Balance :</span> <b class="ml-2"><i class="fas fa-rupee-sign"></i> 30000</b>
                                                      </div> -->
                                                   </div>
                                                   <div class="wave"></div>
                                                   <!--  <div class=" qr-code">
                                                      <img src="img/barcode.png" class="img-fluid">
                                                      
                                                      </div> -->
                                                   <!-- <div class="qr-content">
                                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
                                                      </div> -->
                                                   <div class="star" style="background: url(img/star1.png) repeat;"></div>
                                                   <!-- </a> -->
                                                </div>
                                             </div>
                                             <div class="flip-card-back">
                                                <div class="package-one package-one-box">
                                                   <!-- <a target="_blank" href="https://p-y.tm/FExY-8b"> -->
                                                   <div class="d-flex">
                                                      <div class=" text-left">
                                                         <span class="ml-auto w-100 float-right fontamazi"><b>Small Bazar </b></span> 
                                                         <span class="ml-auto w-100 float-right fontamazi"><b>Shopping Card </b></span> 
                                                       <!--   <span>Wallet Balance :</span> <b class="ml-2"><i class="fas fa-rupee-sign"></i> <?php echo $wallet; ?></b> -->
                                                         <!--  <div class="d-flex wallet-bal fontamazi">
                                                            </div> -->
                                                      </div>
                                                      <div class="ml-auto text-right">
                                                         <img width="100px" src="<?php echo base_url();?>assets/img/logo.png">
                                                         <span class="ml-auto w-100 float-right fontamazi"><b><?php echo $packages['package_name']; ?> </b></span>
                                                         <span class="ml-auto">Lifetime</span> 
                                                      </div>
                                                   </div>
                                                   <div class="d-flex justify-content-center align-items-center  pb-1">
                                                      <a href="#">  <img src="<?php echo base_url(); ?>assets/website/img/bg-store.png" width="72px"></a>
                                                   </div>
                                                   <div class="d-flex">
                                                      <div class=" text-left">
                                                         <div class=" package-txt-one">
                                                            <span><?php echo strtoupper($name); ?></span> 
                                                         </div>
                                                         <div class="d-flex wallet-point"><span><?php echo $unique_package_id; ?></span> </div>
                                                      </div>
                                                      <div class="ml-auto text-right">
                                                         <span class="ml-auto w-100 float-right fontamazi"><b class="ml-2"><!-- <i class="fas fa-rupee-sign"></i> --> <?php echo $packages['price']; ?></b></span>
                                                         <span>Wallet Balance :</span> <b class="ml-2"><!-- <i class="fas fa-rupee-sign"></i> --> <?php echo $wallet; ?></b>
                                                      </div>
                                                   </div>
                                                   <div class="wave"></div>
                                                   <!--  <div class=" qr-code">
                                                      <img src="img/barcode.png" class="img-fluid">
                                                      
                                                      </div> -->
                                                   <!-- <div class="qr-content">
                                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
                                                      </div> -->
                                                   <div class="star" style="background: url(img/star1.png) repeat;"></div>
                                                   <!-- </a> -->
                                                </div>
                                             </div>
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              <?php }
                           } 
                        }
                     }else{
                        foreach ($package as $key => $value) { ?>
                           <div class="col-md-4 col-sm-4 justify-content-center align-items-center d-flex">
                                    <div class="flip-card">
                                       <div class="flip-card-inner">
                                          <a href="<?php echo base_url().'website/Auth/packagePurchase?id='.$value['package_id'].'&amount='.$value['price']; ?>">
                                             <div class="flip-card-front">
                                                <div class="package-one package-one-box">
                                                   <!-- <a target="_blank" href="https://p-y.tm/FExY-8b"> -->
                                                   <div class="d-flex">
                                                     
                                                      <div class="ml-auto text-right">
                                                         <img width="200px" src="<?php echo base_url();?>assets/img/logo.png">
                                                         <span class="ml-auto w-100 float-right fontamazi"><b><?php echo $value['package_name']; ?>  </b></span>
                                                         <span class="d-block">Lifetime</span> 
                                                      </div>
                                                   </div>
                                                   <!-- <div class="d-flex justify-content-center align-items-center  pb-1">
                                                      <a href="#">  <img src="http://3.16.159.2/small_bazar/assets/website/img/bg-store.png" width="62px"></a>
                                                   </div> -->
                                                   <div class="d-flex mt-4 package-wallet-box">
                                                      <div class=" text-left">
                                                         <div class="pt-2 package-txt-one">
                                                            <span><strong><?php echo strtoupper($name); ?></strong></span> 
                                                         </div>
                                                         <div class="d-flex wallet-point"><span style="font-size: 16px"><?php echo $unique_package_id; ?></span> </div>
                                                      </div>
                                                     <!--  <div class="ml-auto text-right">
                                                         <span class="ml-auto w-100 float-right fontamazi"><b class="ml-2"><i class="fas fa-rupee-sign"></i> 1500</b></span>
                                                         <span>Wallet Balance :</span> <b class="ml-2"><i class="fas fa-rupee-sign"></i> 30000</b>
                                                      </div> -->
                                                   </div>
                                                   <!--  <div class=" qr-code">
                                                      <img src="img/barcode.png" class="img-fluid">
                                                      
                                                      </div> -->
                                                   <!-- <div class="qr-content">
                                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
                                                      </div> -->
                                                   <div class="star" style="background: url(img/star1.png) repeat;"></div>
                                                   <!-- </a> -->
                                                </div>
                                             </div>
                                             <div class="flip-card-back">
                                                <div class="package-one package-one-box">
                                                   <!-- <a target="_blank" href="https://p-y.tm/FExY-8b"> -->
                                                   <div class="d-flex">
                                                      <div class=" text-left">
                                                         <span class="ml-auto w-100 float-right fontamazi"><b>Small Bazar </b></span> 
                                                         <span class="ml-auto w-100 float-right fontamazi"><b>Shopping Card </b></span> 
                                                         <!-- <span>Wallet Balance :</span> <b class="ml-2"><i class="fas fa-rupee-sign"></i> <?php echo $wallet; ?></b> -->
                                                         <!--  <div class="d-flex wallet-bal fontamazi">
                                                            </div> -->
                                                      </div>
                                                      <div class="ml-auto text-right">
                                                         <img width="100px" src="<?php echo base_url();?>assets/img/logo.png">
                                                         <span class="ml-auto w-100 float-right fontamazi"><b><?php echo $value['package_name']; ?> </b></span>
                                                         <span class="ml-auto">Lifetime</span> 
                                                      </div>
                                                   </div>
                                                   <div class="d-flex justify-content-center align-items-center  pb-1">
                                                      <a href="#">  <img src="<?php echo base_url(); ?>assets/website/img/bg-store.png" width="72px"></a>
                                                   </div>
                                                   <div class="d-flex">
                                                      <div class=" text-left">
                                                         <div class="pt-2 package-txt-one">
                                                            <span><?php echo strtoupper($name); ?></span> 
                                                         </div>
                                                         <div class="d-flex wallet-point"><span><?php echo $unique_package_id; ?></span> </div>
                                                      </div>
                                                      <div class="ml-auto text-right">
                                                         <span class="ml-auto w-100 float-right fontamazi"><b class="ml-2"><!-- 
                                                          --> <?php echo $value['price']; ?></b></span>
                                                         <span>Wallet Balance :</span> <b class="ml-2"><!-- 
                                                          --> <?php echo $wallet; ?></b>
                                                      </div>
                                                   </div>
                                                   <!--  <div class=" qr-code">
                                                      <img src="img/barcode.png" class="img-fluid">
                                                      
                                                      </div> -->
                                                   <!-- <div class="qr-content">
                                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
                                                      </div> -->
                                                   <div class="star" style="background: url(img/star1.png) repeat;"></div>
                                                   <!-- </a> -->
                                                </div>
                                             </div>
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                        <?php }
                     }
                  ?>
               </div>
            </div>
         </div>
      </div>
      </form>
   </div>
   </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
   function openText(value)
   {
     var res = value.split(",");
     // alert(res);
     // alert(res[1]);
     if (res[0] == '5') {
       $('#amount').css('display','block');
     }else{
       $('#amount').css('display','none');
     }
   }
   function isNumberKey(evt) {
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if ((charCode < 48 || charCode > 57))
             return false;
   
         return true;
     }
</script>

 <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script> -->