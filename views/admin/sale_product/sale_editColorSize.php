<div id="page-wrapper">
    <div class="header">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('seller/Dashboard');?>">Home</a></li>
            <li><a href="<?php echo site_url('seller/Sale_Product/sale_color_list');?>">Color</a></li>
            <li class="active">Edit Color</li>
            <li></li>
        </ol>           
    </div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner"> 
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="card-title">
                            <div class="title">Edit Color/Size</div>
                        </div>
                    </div>
                    <div class="panel-body">
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
                        <?php } ?>
                        <div id="msg"></div>
                        <form class="" action="<?php echo site_url('seller/Sale_Product/update_manage_stock');?>" enctype="multipart/form-data" method="post">
                            

                            <input type="hidden" name="color_id" value="<?php echo $tableData->color_id; ?>">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class=" control-label">Product</label>
                                    <select name="product_id" class="form-control">
                                        <?php
                                            for ($i=0; $i < count($productData); $i++) { ?>
                                                <option <?php if($tableData->product_id == $productData[$i]['product_id']){ echo'selected'; }?> value="<?php echo $productData[$i]['product_id'].','.$productData[$i]['remaining_qty'] ?> "> <?php echo $productData[$i]['product_name'] ?> 
                                                </option>
                                            <?php }
                                        ?>
                                    </select>
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Color</label>
                                    <input type="text" value="<?php echo $tableData->color; ?>" class="form-control" placeholder="Enter Color eg.(Red)" name="color" id="color">
                            </div>
                                </div>
                            </div>

                            <div class="form-group" id="sizeDiv">
                                <label for="inputEmail3" class="control-label">Size</label>
                                    <div class="pr-size input_size_fields_wrap">
                                        <div class="row"> 
                                            <!-- <input type="hidden" name="xs" value="XS"> -->
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"  placeholder="Enter Size" name="size_name[]" id="xs_qty" >
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"  placeholder="Enter Quantity" name="qty[]" id="qty" onkeypress="return isNumberKey(event)" >
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            
                            
                            <?php
                               if(count($sizeData)>0){
                                    for ($i=0; $i < count($sizeData); $i++) { ?>
                                            <div class="form-group" id="sizeDiv">
                                                <div class="pr-size">
                                                    <div class="row"> 
                                                            <!-- <input type="hidden" name="xs" value="XS"> -->
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control"  placeholder="Enter Size" name="size_nam[]" id="ed_size" value="<?php echo $sizeData[$i]['size_name']; ?>">
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control"  placeholder="Enter Quantity" name="qtyy[]" id="ed_qty" value="<?php echo $sizeData[$i]['remaining_qty']; ?>" >
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <a onclick="editSizes('<?php echo $sizeData[$i]['size_id']; ?>')" class="cross btn btn-danger" value="Delete"> <i class="fa fa-pencil" style="font-size:18px"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        <?php 
                                    }
                                } ?>
                                
                            <div class="form-group">
                                <input type="button" class="add_size_field_button btn btn-primary" value="Add More">
                                <button type="submit" name="manage" class="btn btn-primary">Update Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {

        //Add size
        var wrapper2         = $(".input_size_fields_wrap"); //Fields wrapper
        var add_button2      = $(".add_size_field_button"); //Add button ID
        
        var y = 1; //initlal text box count
        $(add_button2).click(function(e){ //on add input button click
            e.preventDefault();
            y++; //text box increment
            $(wrapper2).append('<div class="row p-rel"><div class="col-sm-6"><input type="text" class="form-control"  placeholder="Enter Size" name="size_name[]" id="xs_qty"></div><div class="col-sm-6"><input type="text" class="form-control"  placeholder="Enter Quantity" name="qty[]" id="xs_qty" onkeypress="return isNumberKey(event)" ></div><a href="#" class="btn btn-danger remove_image_field" >X</a></div>'); //add input box
        });
        
        $(wrapper2).on("click",".remove_image_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); y--;
        })
    });
    function editSizes(size_id){
        var size = document.getElementById('ed_size').value;
        var qty  = document.getElementById('ed_qty').value;
        if (confirm('Are you sure you want to edit this?')) {
            $.ajax({
                url: '<?php echo site_url("seller/Product/edit_size"); ?>',
                type: "POST",
                data: {
                    "size_id"       : size_id,
                    "size_name"     : size,
                    "remaining_qty" : qty
                },
                success: function (response) {
                    console.log(response)
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Size!</strong> Edit successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Size!</strong> Not Edit.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
    function deleteSizes(size_id){
        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: '<?php echo site_url("seller/Sale_Product/delete_size"); ?>',
                type: "POST",
                data: {
                    "sizes_id" : size_id
                },
                success: function (response) {
                    console.log(response)
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Size!</strong> delete successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Size!</strong> Not delete.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
</script>   