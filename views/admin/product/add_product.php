<div id="page-wrapper">
    <div class="header">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
            <li><a href="<?php echo site_url('admin/product');?>">Product</a></li>
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
                            <div class="title">Add Product</div>
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
                        <form class="" action="<?php echo site_url('admin/Product/insert_product');?>" enctype="multipart/form-data" method="post">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Category</label><span style="color: red">*</span>
                                    <select class="form-control" onchange="getSubCategory(this.value);" name="category_id">
                                        <option value="0">Select Category</option>
                                        <?php
                                            foreach ($tableData as $key) { ?>
                                                <option value="<?php echo $key['category_id']; ?>" ><?php echo $key['category_name']; ?></option>
                                            <?php }
                                        ?>
                                    </select>
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Sub-Category</label>
                                    <select class="form-control" id="sub_category_id" name="sub_category_id">
                                        <option value="0">Select Sub-Category</option>
                                    </select>
                            </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                     <div class="form-group">
                                <label for="inputEmail3" class="control-label">Product Name</label><span style="color: red">*</span>
                                    <input type="text" name="product_name" class="form-control" id="inputEmail3" placeholder="Product Name">
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Price</label><span style="color: red">*</span>
                               <!--  <div class="col-sm-1">
                                    <i class="fa fa-inr" style="font-size:30px;margin-top: 9px;"></i>
                                </div> -->
                                    <input type="text" name="price" class="form-control" id="inputEmail3" placeholder="Product Price" onkeypress="return isNumberKey(event)">
                            </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Gst</label><span style="color: red">*</span>
                                    <input type="text" onkeypress="return isNumberKey(event)" name="gst" class="form-control" id="inputEmail3" placeholder="Product Gst in %">
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Quantity</label><span style="color: red">*</span>
                                    <input type="text" name="product_quantity" class="form-control" id="product_quantity" placeholder="Product Quantity" onkeypress="return isNumberKey(event)" onkeyup ="getValueOfQuantity(this.value);">
                                    <input type="hidden" name="check_qty" value="0" id="check_qty">
                                    <input type="hidden" name="distributed_qty" value="0" id="distributed_qty">
                            </div>
                                </div>
                            </div>



                            
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label">Product Description</label><span style="color: red">*</span>
                                    <textarea class="form-control" rows="3" name="product_description"></textarea>
                            </div>

                           
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Product Images</label><span style="color: red">*</span>
                                        <div class="input_image_fields_wrap ">
                                            <div class="p-rel input-div"><input type="file" class="form-control" id="upload_file" required="" name="images[]"  placeholder="Product Image">

                                            <input type="text" name = "priority[]" required="" placeholder="Priority">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>


                            
                            
                            <!-- <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Product Images</label>
                                <div class="col-sm-6 input_image_fields_wrap ">
                                    <input type="file" class="form-control" id="upload_file" name="images[]"  placeholder="Product Image">
                                </div>
                                <div class="col-sm-4">
                                    <input type="button" class="add_image_field_button btn btn-primary" value="+">
                                </div>
                            </div> -->

                            
                               <!--  <div class="form-group form-ui">
                                <label for="inputEmail3" class="control-label">Product Behaviour</label><span style="color: red">*</span>
                           
                            </div> -->
                            
                            <!-- <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" onclick="return sumAllSizeQty();" name="add_Product" class="btn btn-primary">Add</button>
                                </div>
                            </div> -->

                            <div class="">
                                <input type="button" class="add_image_field_button btn btn-primary" value="Upload More">
                                <button type="submit" onclick="return sumAllSizeQty();" name="add_Product" class="btn btn-primary">Add Product</button>
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

        //Add more Image
        var wrapper1         = $(".input_image_fields_wrap"); //Fields wrapper
        var add_button1      = $(".add_image_field_button"); //Add button ID
        
        var y = 1; //initlal text box count
        $(add_button1).click(function(e){ //on add input button click
            e.preventDefault();
            y++; //text box increment
            $(wrapper1).append('<div class="p-rel "><input type="file" class="form-control" id="inputEmail3" name="images[]" placeholder="Product Images"><input type="text" name = "priority[]" placeholder="Priority"><a href="#" class="btn btn-danger remove_image_field" >X</a></div>'); //add input box
        });
        
        $(wrapper1).on("click",".remove_image_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); y--;
        })

        
    });
    
    function preview_image() 
    {
        var total_file=document.getElementById("upload_file").files.length;
        for(var i=0;i<total_file;i++)
        {
            $('#image_preview').append("<img width='80' src='"+URL.createObjectURL(event.target.files[i])+"'>");
        }
    }
    function getSubCategory(cat_id){
        $.ajax({
            url: '<?php echo site_url("admin/Product/getSubCategory"); ?>',
            type: "POST",
            data: {
                "cat_id" : cat_id
            },
            success: function (response) {

                if (response == '0') {
                    $('#sub_category_id').html('<option value="0">Select Sub-Category</option>');
                } else {
                    var obj = JSON.parse(response);
                    console.log(obj.length);
                    var html = '';
                    for(var i=0; i<obj.length; i++){
                        // console.log(obj[i]['sub_category_id']);
                        html += '<option value="'+obj[i]['sub_category_id']+'">'+obj[i]['sub_category_name']+'</option>'
                    }
                    $('#sub_category_id').html(html);
                }
            }
        });
    }
    
</script>