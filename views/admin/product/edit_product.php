<div id="page-wrapper">
    <div class="header">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
            <li><a href="<?php echo site_url('admin/Product');?>">Product</a></li>
            <li class="active">Edit Product</li>
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
                            <div class="title">Edit Product</div>
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
                        <form class="" action="<?php echo site_url('admin/Product/update_product');?>" enctype="multipart/form-data" method="post">


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Category</label><span style="color: red">*</span>
                                    <select onchange="getSubCategory(this.value);" class="form-control" name="category_id">
                                        <?php
                                            foreach ($catData as $key) { ?>
                                                <option <?php if($key['category_id']==$tableData->category_id){ echo 'selected'; } ?> value="<?php echo $key['category_id']; ?>" ><?php echo $key['category_name']; ?></option>
                                            <?php }
                                        ?>
                                    </select>
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Sub-Category</label>
                                    <select class="form-control" id="sub_category_id" name="sub_category_id">
                                        <?php
                                            foreach ($subCatData as $key1) { 
                                                // print_r($key1['sub_category_id']);
                                                ?>
                                                <option <?php if($key1['sub_category_id']==$tableData->sub_category_id){ echo 'selected'; } ?> value="<?php echo $key1['sub_category_id']; ?>" ><?php echo $key1['sub_category_name']; ?></option>
                                            <?php }
                                        ?>
                                    </select>
                            </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Product Name</label><span style="color: red">*</span>
                                    <!-- <input type="hidden" name="size_id" value="<?php echo $sizeData->size_id; ?>"> -->
                                    <input type="hidden" name="product_id" value="<?php echo $tableData->product_id; ?>">
                                    <input type="text" name="product_name" class="form-control" id="inputEmail3" placeholder="Product Name" value="<?php echo $tableData->product_name; ?>">
                            </div>
                                </div>
                                <div class="col-sm-6">
                                   <div class="form-group">
                                <label for="inputEmail3" class="control-label">Quantity</label><span style="color: red">*</span>
                                    <input type="text" name="product_quantity" class="form-control" id="product_quantity" placeholder="Product Quantity" onkeypress="return isNumberKey(event)" value="<?php echo $tableData->product_quantity; ?>"  onkeyup ="getValueOfQuantity(this.value);">
                                    <input type="hidden" name="check_qty" value="<?php echo $tableData->product_quantity; ?>" id="check_qty">
                                    <input type="hidden" name="distributed_qty" value="0" id="distributed_qty">
                                </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Price</label><span style="color: red">*</span>
                                <!-- <div class="col-sm-1">
                                    <i class="fa fa-inr" style="font-size:30px;margin-top: 9px;"></i>
                                </div> -->
                                    <input type="text" name="price" class="form-control" id="inputEmail3" placeholder="Product Price" onkeypress="return isNumberKey(event)" value="<?php echo $tableData->price; ?>">
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Gst</label><span style="color: red">*</span>
                             
                                    <input type="text" name="gst" class="form-control" id="inputEmail3" onkeypress="return isNumberKey(event)" placeholder="Product Gst in %" value="<?php echo $tableData->gst; ?>">
                            </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                     <div class="form-group">
                                <label for="inputEmail3" class="control-label">Product Description</label><span style="color: red">*</span>
                                    <textarea class="form-control" rows="3" name="product_description"><?php echo $tableData->product_description; ?></textarea>
                            </div>
                                </div>
                            </div>

                            
                            <!-- <div class="form-group form-ui">
                                <label for="inputEmail3" class="control-label">Product Behaviour</label><span style="color: red">*</span>
                                <div class="row">
                                <div class="col-sm-2 ">
                                    <input type="radio" id="inputEmail3" name="behaviour" <?php if($tableData->is_fixed == '0'){ echo 'checked'; }else{ echo''; } ?> value="0" >&nbsp;&nbsp;Fixed
                                </div>
                                <div class="col-sm-4 ">
                                    <input type="radio" id="inputEmail3" name="behaviour" <?php if($tableData->is_fixed == '1'){ echo 'checked'; }else{ echo''; } ?> value="1">&nbsp;&nbsp;Bargaining
                                </div>
                            </div>
                            </div>
                             -->
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Product Images</label><span style="color: red">*</span>
                                        <div class="input_image_fields_wrap ">
                                            <div class="p-rel input-div">
                                                <input type="file" class="form-control" id="upload_file" name="images[]"  placeholder="Product Image">
                                                <input type="text" name = "priority[]"  placeholder="Priority">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            
                                <div class="form-group">
                            <div class="row">
                                    <?php
                                        for ($j=0;$j < count($imageData); $j++) { ?>
                                            <div class="col-sm-2 product-image"><img id="preview" src="<?php echo base_url().'product/'.$imageData[$j]['image']; ?> " alt="your image" width="100%" height="auto" />
                                            <a type="button" onclick="deleteImage('<?php echo $imageData[$j]['product_image_id']; ?>')" class="cross" value="Delete"> x
                                            </a>
                                            </div>
                                    <?php }
                                    ?>
                                    <div id="image_preview" width="150px" height="120px"></div>
                            </div>
                            </div>
                                <!-- <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Promo Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?php echo $tableData->promo_code; ?>" class="form-control" name="promo_code" placeholder="%">
                                    </div>
                                </div> -->
                                <!-- <div style="margin-left: 18%" class="checkbox3 checkbox-inline checkbox-check checkbox-light">
                                    <input value="1"  type="checkbox" name="show_name" id="checkbox-fa-light-1" <?php if($tableData->show_name == '1'){ echo "checked";}else{
                                        echo "";
                                    } ?> >
                                    <label for="checkbox-fa-light-1">
                                      Do you want to show your name on portal
                                    </label>
                                </div> -->

                                

<!-- 
                            <div class="form-group form-ui">
                                <label for="inputEmail3" class="control-label">Product Behaviour</label>
                            <div class="row">
                                <div class="col-sm-2 ">
                                      <div class="ui-check" id="group4">
                                        <input type="radio" id="fixed" name="behaviour" checked="">
                                    <label for="fixed">fixed</label>
                                    <div class="check"></div>
                                   
                                  </div>
                                </div>
                                <div class="col-sm-4 ">
                                     <div class="ui-check" id="group4">
                                   <input type="radio" id="Bargaining" name="behaviour" checked="">
                                    <label for="Bargaining">Bargaining</label>
                                    <div class="check"></div>
                                  </div>
                                </div>
                            </div>
                            </div> -->




                                <div class="">
                                    <input type="button" class="add_image_field_button btn btn-primary" value="Upload More">
                                    <button type="submit" onclick="return sumAllSizeQty();" name="add_Product" class="btn btn-primary">Update Product</button>
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
        //distribute quantity amount calculation
        
        //Add more Image
        var wrapper1         = $(".input_image_fields_wrap"); //Fields wrapper
        var add_button1      = $(".add_image_field_button"); //Add button ID
        
        var y = 1; //initlal text box count
        $(add_button1).click(function(e){ //on add input button click
            e.preventDefault();
            y++; //text box increment
            $(wrapper1).append('<div class="p-rel input-div"><input type="file" class="form-control" id="inputEmail3" name="images[]" placeholder="Product Images"><input type="text" name = "priority[]" placeholder="Priority"><a href="#" class="btn btn-danger remove_image_field" >X</a></div>'); //add input box
        });
        
        $(wrapper1).on("click",".remove_image_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); y--;
        })

        
        $('#image').change(function () {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
                readURL(this);
            else
                alert("Please select image file (jpg, jpeg, png).")
        });
        
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
            //$("#remove").val(0);
                };
            }
        }
        function removeImage() {
            $('#preview').attr('src', 'noimage.jpg');
            //$("#remove").val(1);
        }
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
                    // console.log(obj.length);
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
    
    function deleteImage(image_id){
        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: '<?php echo site_url("admin/Product/delete_image"); ?>',
                type: "POST",
                data: {
                    "image_id" : image_id
                },
                success: function (response) {
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Image!</strong> delete successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Image!</strong> Not delete.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
</script>