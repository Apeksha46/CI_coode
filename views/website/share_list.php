 <section>
         <div class="page-title-area">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="title-heading ">
                     <h1>Referal list</h1>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </section>

      <!-- demo 5 level -->
      <section class="refer-list-view">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <!-- Advanced Tables -->
                  <div class="card ">
                     <div class="card-heading">
                        Refer List
                     </div>
                     
                     <div class="card-body">
                        <ul class="list-group alt  ">
                           <div class="row">
                           <!-- Level 1 -->
                           <div class=" col-md-3 col-sm-6 ">
                              <section class="card card-default ">
                                 <div class="card-body ">
                                    <h4>Level 1</h4>
                                    <ul class="list-group-category scrollbar">
                                      <?php
                                                
                                                $levelOne = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $tableData->referal_code),'user');
                                                // print_r($levelOne);die;
                                                  $i = 1;  
                                                foreach ($levelOne as $key => $value) {
                                            ?>
                                       <li class="list-group-item">
                                          <div class="content-media">
                                             <div class="float-right  ">
                                                <i class="fa fa-circle"></i>
                                             </div>
                                             <div class="content-media-body">
                                                <div>
                                                    <?php echo $i; ?>
                                                    <a target="_blank" href="#"> 
                                                      <?php echo $value["first_name"]?> <?php echo $value["last_name"]?>
                                                    </a>
                                                </div>
                                                <small class="text-muted">Unique Id  : <?php echo $value["unique_package_id"]?></small>
                                             </div>
                                          </div>
                                       </li>
                                     <?php } ?>
                                    </ul>
                                 </div>
                              </section>
                           </div>
                           <!-- Level 2 -->
                           <div class=" col-md-3 col-sm-6 ">
                              <section class="card card-default ">
                                 <div class="card-body ">
                                    <h4>Level 2</h4>
                                    <ul class="list-group-category scrollbar">
                                      <?php
                                        $levelOne = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $tableData->referal_code),'user');

                                        foreach ($levelOne as $key => $value) 
                                        {
                                            $levelTwo = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $value['referal_code']),'user');
                                            foreach ($levelTwo as $key => $value) {
                                            $i = 1;  
                                      ?>
                                       <li class="list-group-item">
                                          <div class="content-media">
                                             <div class="float-right  ">
                                                <i class="fa fa-circle"></i>
                                             </div>
                                             <div class="content-media-body">
                                                <div>
                                                   <?php echo $i; ?>
                                                   <a target="_blank" href="#">
                                                    <?php echo $value["first_name"]?> <?php echo $value["last_name"]?>
                                                   </a>
                                                </div>
                                                <small class="text-muted">Unique Id  : <?php echo $value["unique_package_id"]?></small>
                                             </div>
                                          </div>
                                       </li>
                                     <?php } } ?>
                                    </ul>
                                 </div>
                              </section>
                           </div>
                           <!-- Level 3 -->
                            <div class=" col-md-3 col-sm-6 ">
                              <section class="card card-default ">
                                 <div class="card-body ">
                                    <h4>Level 3</h4>
                                    <ul class="list-group-category scrollbar">
                                      <?php
                                        $levelOne = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $tableData->referal_code),'user');

                                        foreach ($levelOne as $key => $value) 
                                        {
                                            $levelTwo = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $value['referal_code']),'user');
                                            foreach ($levelTwo as $key => $value) 
                                            {
                                                $levelThree = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $value['referal_code']),'user');

                                                foreach ($levelThree  as $key => $vTh) {
                                                    $i = 1;  
                                      ?>
                                       <li class="list-group-item">
                                          <div class="content-media">
                                             <div class="float-right  ">
                                                <i class="fa fa-circle"></i>
                                             </div>
                                             <div class="content-media-body">
                                                <div>
                                                   <?php echo $i; ?>
                                                   <a target="_blank" href="#">
                                                    <?php echo $vTh["first_name"]?> <?php echo $vTh["last_name"]?>
                                                   </a>
                                                </div>
                                                <small class="text-muted">Unique Id  : <?php echo $vTh["unique_package_id"]?></small>
                                             </div>
                                          </div>
                                       </li>
                                     <?php $i++; } } }?>
                                    </ul>
                                 </div>
                              </section>
                           </div>

                           <!-- Level 4 -->
                            <div class=" col-md-3 col-sm-6 ">
                              <section class="card card-default ">
                                 <div class="card-body ">
                                    <h4>Level 4</h4>
                                    <ul class="list-group-category scrollbar">
                                      <?php
                                        $levelOne = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $tableData->referal_code),'user');

                                        foreach ($levelOne as $key => $value) 
                                        {
                                            $levelTwo = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $value['referal_code']),'user');
                                            foreach ($levelTwo as $key => $value) 
                                            {
                                                $levelThree = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $value['referal_code']),'user');

                                                foreach ($levelThree  as $key => $vTh) {

                                                    $levelFour = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $vTh['referal_code']),'user');

                                                    foreach ($levelFour as $key => $vFo) {
                                                    $i = 1;  
                                      ?>
                                       <li class="list-group-item">
                                          <div class="content-media">
                                             <div class="float-right  ">
                                                <i class="fa fa-circle"></i>
                                             </div>
                                             <div class="content-media-body">
                                                <div>
                                                   <?php echo $i; ?>
                                                   <a target="_blank" href="#">
                                                    <?php echo $vFo["first_name"]?> <?php echo $vFo["last_name"]?>
                                                   </a>
                                                </div>
                                                <small class="text-muted">Unique Id  : <?php echo $vFo["unique_package_id"]?></small>
                                             </div>
                                          </div>
                                       </li>
                                    <?php $i++; } } } }?>
                                    </ul>
                                 </div>
                              </section>
                           </div>
                           <!-- Level 5 -->
                            <div class=" col-md-3 col-sm-6 ">
                              <section class="card card-default ">
                                 <div class="card-body ">
                                    <h4>Level 5</h4>
                                    <ul class="list-group-category scrollbar">
                                    <?php
                                      $levelOne = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $tableData->referal_code),'user');

                                      foreach ($levelOne as $key => $value) 
                                      {
                                          $levelTwo = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $value['referal_code']),'user');
                                          foreach ($levelTwo as $key => $value) 
                                          {
                                              $levelThree = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $value['referal_code']),'user');

                                              foreach ($levelThree  as $key => $vTh) {

                                                  $levelFour = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $vTh['referal_code']),'user');

                                                  foreach ($levelFour as $key => $vFo) {

                                                       $levelFive = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $vFo['referal_code']),'user');

                                                       foreach ($levelFive as $key => $vFi) {

                                                  $i = 1;  
                                    ?>
                                       <li class="list-group-item">
                                          <div class="content-media">
                                             <div class="float-right  ">
                                                <i class="fa fa-circle"></i>
                                             </div>
                                             <div class="content-media-body">
                                                <div>
                                                   <?php echo $i; ?>
                                                   <a target="_blank" href="#">
                                                    <?php echo $vFi["first_name"]?> <?php echo $vFi["last_name"]?>
                                                   </a>
                                                </div>
                                                <small class="text-muted">Unique Id  : <?php echo $vFi["unique_package_id"]?></small>
                                             </div>
                                          </div>
                                       </li>
                                     <?php $i++; } } } } }?>
                                    </ul>
                                 </div>
                              </section>
                           </div>
                           <!-- End Fetching Downline Of User-->
                           </div>
                        </ul>
                     </div>
                  </div>
                  <!--End Advanced Tables -->
               </div>
            </div>
         </div>
      </section>


      <!-- <section>
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
                                      <th class="product-thumbnail">Sno</th>
                                      <th class="product-name">Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                      $i = 0;
                                      if (!empty($refer)) {
                                        foreach ($refer as $key => $value) { 
                                          $i = $i+1;
                                      ?>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <?php echo $i; ?>
                                        </td>
                                        <td class="product-name"><?php echo $value['first_name'].' '.$value['last_name']; ?></td>
                                    </tr>
                                    <?php } } ?>
                                  </tbody>
                                </table>
                            </div>
                         </form>


                      </div>
                   </div>
                </div>
             </div>
          </div>
         </div>
      </section> -->
      <script type="text/javascript">
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
    function plus(i,cart_id)
    {
      var qty_val = $('#qty_'+i).text();
      var val = parseInt(qty_val) + parseInt(1)
      $('#qty_'+i).text(val);
      var price = parseInt(val) * parseInt($('#price_calculate_'+i).val());
      $('#price_'+i).text(price);
      $.ajax({
        url: '<?php echo site_url("website/CheckOut/update_qty_price"); ?>',
        type: "POST",
        data: {
            "cart_id" : cart_id,
            "qty"     : val,
            "price"   : price
        },
        success: function (response) {
            
        }
      });
      // alert(qty_val)
    }
    function minus(i,cart_id)
    {
      var qty_val = $('#qty_'+i).text();
      var val     = parseInt(qty_val) - parseInt(1);
      var price   = parseInt(val) * parseInt($('#price_calculate_'+i).val());
      if (val == 0) {
        alert('atleast 1 quantity is required ');
      }
      if (val > 0) {
        $('#qty_'+i).text(val);
        $('#price_'+i).text(price);
        $.ajax({
          url: '<?php echo site_url("website/CheckOut/update_qty_price"); ?>',
          type: "POST",
          data: {
              "cart_id" : cart_id,
              "qty"     : val,
              "price"   : price
          },
          success: function (response) {
              
          }
        });
      }
    }
    function delteFunction(val){
        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: '<?php echo site_url("website/CheckOut/delete_cart"); ?>',
                type: "POST",
                data: {
                    "cart_id" : val
                },
                success: function (response) {
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Category!</strong> delete successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Category!</strong> Not delete.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
</script>