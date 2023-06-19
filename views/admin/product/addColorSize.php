<div id="page-wrapper">
    <div class="header">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('seller/Dashboard');?>">Home</a></li>
            <li><a href="<?php echo site_url('seller/Product/color_list');?>">Color</a></li>
            <li class="active">Add Product</li>
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
                            <div class="title">Add Color/Size</div>
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
                        <form class="" action="<?php echo site_url('seller/product/manage_stock');?>" enctype="multipart/form-data" method="post">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Product</label>
                                            <select name="product_id" class="form-control">
                                                <?php
                                                    for ($i=0; $i < count($productData); $i++) { ?>
                                                        <option value="<?php echo $productData[$i]['product_id'].','.$productData[$i]['remaining_qty'] ?> "> <?php echo $productData[$i]['product_name'] ?> 
                                                        </option>
                                                    <?php }
                                                ?>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="product_add_size">
                                <div class="form-group">
                                    <label for="inputEmail3" class="control-label">Color</label>
                                        <input type="text" class="form-control" placeholder="Enter Color eg.(Red)" name="color" id="color">
                                </div>
                                
                            </div>  
                                </div>
                            </div>

                            <div class="form-group" id="sizeDiv">
                                <div class="control-label">
                                     <label for="inputEmail3" class="">Size</label>
                                </div>
                                <div class="pr-size input_size_fields_wrap">
                                        <!-- <input type="hidden" name="xs" value="XS"> -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"  placeholder="Enter Size" name="size_name[]" id="xs_qty" >
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"  placeholder="Enter Quantity" name="qty[]" id="qty" onkeypress="return isNumberKey(event)" >
                                            </div>
                                        </div>
                                </div>
                        </div>


                            
                              
                                
                            <div class="form-group">
                                <input type="button" class="add_size_field_button btn btn-primary" value="Upload More">
                                <button type="submit" name="manage" class="btn btn-primary">Add</button>
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
    function skipFunction()
    {
        $('#msg').html('<div class="alert alert-success"><strong>Product!</strong> Add successful.</div>');
        setTimeout(function(){ 
            window.location.href = "<?php echo base_url(); ?>index.php/seller/product";
        }, 1000);
    }
</script>