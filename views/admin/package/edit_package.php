<div id="page-wrapper">
    <div class="header">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
            <li><a href="<?php echo site_url('admin/Package');?>">Package</a></li>
            <li class="active">Edit Package</li>
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
                            <div class="title">Edit Package</div>
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
                        <form class="" action="<?php echo site_url('admin/Package/update_package');?>" enctype="multipart/form-data" method="post">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Package Name</label><span style="color: red">*</span>
                                        <input type="hidden" name="package_id" value="<?php echo $tableData->package_id; ?>">
                                        <input type="text" name="package_name" class="form-control" id="inputEmail3" placeholder="Package Name" value="<?php echo $tableData->package_name; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Price</label><span style="color: red">*</span>
                                        <input type="text" name="price" class="form-control" id="inputEmail3" placeholder="Price" onkeypress="return isNumberKey(event)" value="<?php echo $tableData->price; ?>">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                     <div class="form-group">
                                <label for="inputEmail3" class="control-label">Description</label><span style="color: red">*</span>
                                    <textarea class="form-control" rows="3" name="description"><?php echo $tableData->description; ?></textarea>
                            </div>
                                </div>
                            </div>

                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Images</label><span style="color: red">*</span>
                                        <div class="input_image_fields_wrap ">
                                            <div class="p-rel input-div">
                                                <input type="file" class="form-control" id="upload_file" name="image"  placeholder="Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2 product-image">
                                        <img id="preview" src="<?php echo base_url().'package/'.$tableData->image; ?> " alt="your image" width="100%" height="auto" />
                                        
                                    </div>
                                    <div id="image_preview" width="150px" height="120px"></div>
                                </div>
                            </div>

                            <div class="">
                                <button type="submit" name="add_Product" class="btn btn-primary">Update Package</button>
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
  
</script>